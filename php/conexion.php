<?php
/*
$servidor="localhost";
$nombreBd="u532781815_proyectos";
$usuario="u532781815_janko";
$pass="Zg&9^jhn5";*/
$servidor="localhost";
$nombreBd="new_bd";
$usuario="root";
$pass="";
$conexion = new mysqli($servidor,$usuario,$pass,$nombreBd);
if($conexion -> connect_error){
    die("No se pudo conectar");
}
define("KEY","JPIJSJS94H");
define("COD","AES-128-ECB");
//LIVE PAYPAL 
/*define("LINKAPI","https://api-m.paypal.com");
define("CLIENTID","AYlnJvkgG9F_FJ-N0zjwFdlhVi19Oq2zmM__oddlVyBhP9kSNC58LGvv0NKuEbrBZIc5YL-EZE_MihTb");
define("SECRET","EN537eBwjkqxlssv5qVh3ruqLo_szyPOHoBLkTD0oTpv-64-C0k4uf4TqUWXOOHtw1CwPIOI2mOr81GF");*/

//SANDBOX PAYPAL 
define("LINKAPI","https://api-m.sandbox.paypal.com");
define("CLIENTID","Af5ElAVtPrfPvimCJCEfKiTiAFdWAI1RwVeTzzftfrFgP7Z9dJABonmVbdIzh-z9qen1YZjdbPDN_OnF");
define("SECRET","EB9DtdizgsD8ml84bxhCDyujHNDpd5F92wmPIKDyBuRTSAL05rBGYauffcFJEoyrlORm6HMk6XYHKCzb");


//SANDBOX MERCADOPAGO 
$at='APP_USR-7922036580407155-010410-9b0fc9f0c0c7fb76ff653eb34549b4fc-1275832654';
$public_key='APP_USR-bd3d24e9-4f14-45f2-b583-b2d2e2382bb4';
$clientId='7922036580407155';
$clientSecret='VxVDoX4UHVlm1qLceGrIEd2Flp9kwiHE';

//LIVE MERCADOPAGO
/*$at='APP_USR-8654922779511585-110419-71d6b78c70e61442a8f32bfcfdd2930e-1012664874';
$public_key='APP_USR-3f14d574-b25a-475d-b3fd-73bc856be98a';
$clientId='8654922779511585';
$clientSecret='WixlAt7qgvKo6U41EblGONjTRt5xf9Q2';*/




?>