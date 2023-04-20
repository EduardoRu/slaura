<?php include "./templases/header.php"?>
<?php
session_start();
?>
<?php
if (isset($_POST['submit'])) {
    $resultado = [
        'error' => false,
        'mensaje' => 'El articulo '. $_POST ['name']. ' ha sido agregado con exito'
    ];

   //Conexion con la base de datos//
    $config = include 'config.php';
    try {
        $dsn = 'mysql:host=' . $config['db']['host'] . ';
        dbname=' . $config['db']['name'];
        $conexion = new PDO ($dsn, $config['db']['user'], $config
        ['db']['pass'], $config['db']['options']);
        

       // Obtener la imagen
       $dir = "./storage/catalogo";
       $fileDestiantion = "";
        if(is_dir($dir)){
          $file = $_FILES['image'];
          $fileName = $_FILES['image']['name'];
          $fileTempName = $_FILES['image']['tmp_name'];
          $fileSize = $_FILES['image']['size'];
          $fileError = $_FILES['image']['error'];
          $fileType = $_FILES['image']['type'];

          $fileExt = explode('.', $fileName);
          $fileActualExt = strtolower(end($fileExt));

          $extPermititdas = array('jpg', 'jpeg', 'png');
          if (in_array($fileActualExt, $extPermititdas)) {
              if ($fileError == 0) {
                  if ($fileSize < 1000000) {
                      $fileNameNew = uniqid('', true) . "." . $fileActualExt;

                      $fileDestiantion = $dir . "/" . $fileNameNew;

                      move_uploaded_file($fileTempName, $fileDestiantion);
                  }
              }
          }
        }else{
          mkdir($dir, 0777, true);
        }

       //Variables de la base de datos//
        $tbl_product = array(
            "name" => $_POST['name'],
            "image" => $fileDestiantion,
            "code" => $_POST['code'],
           
            "price" => $_POST['price'],
           
            
        );

        //carga de datos en base de datos
        $consultaSQL = "INSERT INTO tbl_product(name,image,code,price)";
        $consultaSQL .= "values (:" . implode(", :", array_keys
        ($tbl_product)) . ")";
        
        $sentencia = $conexion->prepare($consultaSQL);
        $sentencia->execute($tbl_product);
        




        
    } catch(PDOException $error) {
        $resultado['error'] = true;
        $resultado['mensaje'] = $error->getMessage();

    }
}
?>
<?php include "./templases/header.php"?>

<?php
if (isset($resultado)) {

}
?>


<?php
if (isset($resultado)) {
  ?>
  <!--Alerta conectada con la base de datos que muestra mensaje de datos guardados correctamente -->
  <div class="container mt-3">
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-<?= $resultado['error'] ? 'danger' : 'success' ?>" role="alert">
          <?= $resultado['mensaje'] ?>
        </div>
      </div>
    </div>
  </div>
  <?php
}
?>

<!-- Creacion de formulario ADD -->
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2 class="mt-4">Agrega un nuevo articulo</h2>
      <hr>
      <form method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="name">Prenda</label>
          <input type="text" name="name" id="name" class="form-control">
        </div>
        <div class="form-group">
          <label for="name">Selecciona imagen</label>
        <input type="file" name="image"/>
        
        </div>
        <div class="form-group">
          <label for="number">Codigo</label>
          <input type="text" name="code" id="code" class="form-control">
        </div>
       
        
        <div class="form-group">
          <label for="number">Precio</label>
          <input type="text" name="price" id="price" class="form-control">
        </div>
      
        <!-- Boton enviar -->
        <div class="form-group">
          <input type="submit" name="submit" class="btn btn-primary" value="Guardar">
         <!-- Boton que Regresar al inicio -->
          <a class="btn btn-primary" href="aindex.html">Regresar al inicio</a>
        </div>
      </form>
    </div>
  </div>
</div>

<?php include "./templases/footer.php"?>