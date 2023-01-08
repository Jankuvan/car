<?php
session_start();
include '../global/config.php';

$arreglo = $_SESSION['carrito'];

for($i=0; $i< count($arreglo); $i++){
    if($arreglo[$i]['Id'] == $_POST['id']){
       $arreglo[$i]['Cantidad'] = $_POST['cantidad'];
        $_SESSION['carrito'] = $arreglo;
        break;
    }
}
?>