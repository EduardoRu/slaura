<?php
$config = include 'config.php';
$usuario = $_POST['usuario'];
$password = $_POST['password'];
session_start();

$_SESSION['usuario']=$usuario;

$conexion=mysqli_connect("localhost", "root", "", "shopping_cart");


$consulta="SELECT * FROM usuarios where usuario='$usuario' and password='$password'";

$resultado=mysqli_query($conexion,$consulta);

$filas=mysqli_fetch_array($resultado);

if($usuario != '' && $password != '' && $filas){
    if ($filas['id_cargo']  == 1){//Administrador
        $_SESSION['user_id'] = $filas['id'];
        header("location:aindex.html");
    }else 
    if ($filas['id_cargo']  == 2){//Cliente
        $_SESSION['user_id'] = $filas['id'];
        header("location:index.html");
    }
    else{
        ?>
        <?php
        include("index.html")
        ?>
        <h1 class="bad">ERROR EN LA authentication</h1>
        <?php
    }
}else{
    header('Location: login.php');
}
mysqli_free_result($resultado);
mysqli_close($config);