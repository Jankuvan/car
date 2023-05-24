<?php
/*
$servidor="localhost";
$nombreBd="";
$usuario="";
$pass="";*/
$nombreBd="";
$usuario="";
$pass="";
$conexion = new mysqli($servidor,$usuario,$pass,$nombreBd);
if($conexion -> connect_error){
    die("No se pudo conectar");
}
define("KEY","JPIJSJS94H");
define("COD","AES-128-ECB");
//LIVE PAYPAL 
/*define("LINKAPI","https://api-m.paypal.com");
define("CLIENTID","");
define("SECRET","");*/

//SANDBOX PAYPAL 
define("LINKAPI","https://api-m.sandbox.paypal.com");
define("CLIENTID","");
define("SECRET","");


//SANDBOX MERCADOPAGO 
$at='';
$public_key='';
$clientId='';
$clientSecret='';

//LIVE MERCADOPAGO
/*$at='';
$public_key='';
$clientId='';
$clientSecret='';*/




?>
