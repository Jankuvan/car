<?php
include "./conexion.php";


$conexion->query('delete from productos where id='.openssl_decrypt($_POST['id'],COD,KEY));
$conexion->query('delete from producto_insertado where id_producto='.openssl_decrypt($_POST['id'],COD,KEY));
 echo 'listo';

?>