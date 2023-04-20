<?php include "./templases/header.php"?>
<?php
session_start();
?>
<?php
if (isset($_POST['submit'])) {
    $resultado = [
        'error' => false,
        'mensaje' => 'Hola, '. $_POST ['nombre']. ' tu cuenta ha sido creada con exito'
    ];

   //Conexion con la base de datos//
    $config = include 'config.php';
    try {
        $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
        $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);
        
        

       //Variables de la base de datos//
        $usuario = array(
            "nombre" => $_POST['nombre'],
            "usuario" => $_POST['usuario'],
            "password" => $_POST['password'],
            "id_cargo" => $_POST['cargo']
            
        );

        //carga de datos en base de datos
        $consultaSQL = "INSERT INTO usuarios (nombre, usuario,
        password,id_cargo)";
        $consultaSQL .= "values (:" . implode(", :", array_keys
        ($usuario)) . ")";
        
        $sentencia = $conexion->prepare($consultaSQL);
        $sentencia->execute($usuario);




        
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

<!-- Creacion de formulario -->
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2 class="mt-5">Registrate</h2>
      <hr>
      <form method="post">
        <div class="form-group">
          <label for="nombre">Nombre Completo</label>
          <input type="text" name="nombre" id="nombre" class="form-control">
        </div>
        <div class="form-group">
          <label for="number">Usuario</label>
          <input type="text" name="usuario" id="usuario" class="form-control">
        </div>
        <div class="form-group">
          <label for="password">Contraseña</label>
          <input type="text" name="password" id="password" class="form-control">
        </div>
        <input type="hidden" name="cargo" id="cargo"  value="1"class="form-control">
        
        
        
        <br><br>
<!-- Boton enviar -->
        <div class="form-group">
          <input type="submit" name="submit" class="btn btn-primary" value="Enviar">
         <!-- Boton que Regresar al inicio -->
          <a class="btn btn-primary" href="aindex.html">Regresar al inicio</a>
        </div>
      </form>
    </div>
  </div>
</div>

<?php include "./templases/footer.php"?>