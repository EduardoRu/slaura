<?php
session_start();
?>
<?php
include 'funciones.php';

$config = include 'config.php';

$resultado = [
  'error' => false,
  'mensaje' => ''
];

if (!isset($_GET['id'])) {
  $resultado['error'] = true;
  $resultado['mensaje'] = ' No existe';
}

if (isset($_POST['submit'])) {
  try {
    $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
    $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

    $prenda = [
      "id"  => $_GET['id'],
      "name"    => $_POST['name'],
      "code"  => $_POST['code']
      
    ];
    
    $consultaSQL = "UPDATE tbl_product SET
        name = :name,
        code = :code,
        update_at = NOW()
        WHERE id = :id";
    
    $consulta = $conexion->prepare($consultaSQL);
    $consulta->execute($prenda);

  } catch(PDOException $error) {
    $resultado['error'] = true;
    $resultado['mensaje'] = $error->getMessage();
  }
}

try {
  $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
  $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);
    
  $id = $_GET['id'];
  $consultaSQL = "SELECT * FROM tbl_product WHERE id =" . $id;

  $sentencia = $conexion->prepare($consultaSQL);
  $sentencia->execute();

  $prenda = $sentencia->fetch(PDO::FETCH_ASSOC);

  if (!$prenda) {
    $resultado['error'] = true;
    $resultado['mensaje'] = 'No se ha encontrado';
  }

} catch(PDOException $error) {
  $resultado['error'] = true;
  $resultado['mensaje'] = $error->getMessage();
}
?>

<?php include "./templases/header.php" ?>

<?php
if ($resultado['error']) {
  ?>
  <div class="container mt-2">
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-danger" role="alert">
          <?= $resultado['mensaje'] ?>
        </div>
      </div>
    </div>
  </div>
  <?php
}
?>

<?php
if (isset($_POST['submit']) && !$resultado['error']) {
  ?>
  <div class="container mt-2">
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-success" role="alert">
        Ha sido actualizado correctamente
        </div>
      </div>
    </div>
  </div>
  <?php
}
?>

<?php
if (isset($prenda) && $prenda) {
  ?>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2 class="mt-4">Editando el Articulo <?= escapar($prenda['name']) . ' ' . escapar($prenda['code'])  ?></h2>
        <hr>
        <form method="post">
          <div class="form-group">
            <label for="name">Prenda</label>
            <input type="text" name="name" id="name" value="<?= escapar($prenda['name']) ?>" class="form-control">
          </div>
          <div class="form-group">
            <label for="code">Codigo</label>
            <input type="text" name="code" id="code" value="<?= escapar($prenda['code']) ?>" class="form-control">
          </div>
          
          <div class="form-group">
            <input type="submit" name="submit" class="btn btn-primary" value="Actualizar">
            <a class="btn btn-primary" href="index.php">Regresar al inicio</a>
          </div>
        </form>
      </div>
    </div>
  </div>
  <?php
}
?>

<?php include "./templases/footer.php" ?>