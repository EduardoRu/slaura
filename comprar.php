<?php
session_start();
if($_SESSION['user_id']){

    //Mandar a llamar los articulos de los usuarios que no se hayan comprado y esten en el carrito

    $consulta = 'SELECT * FROM  tbl_cart';

}else{
    header('Location: login.php');
}
?>