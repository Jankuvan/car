<?php

session_start();
$total = 0;
if(isset($_SESSION['carrito'])&&isset($_GET['id'])){
  $arregloCarrito=$_SESSION['carrito'];
  for($i=0;$i<count($arregloCarrito);$i++){
  $total=$total + ($arregloCarrito[$i]['Precio']*$arregloCarrito[$i]['Cantidad']);}
include 'php/conexion.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Tienda</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="./images/users/default.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  </head>
  <body>

  <div class="row">
  
<?php
$login = curl_init(LINKAPI."/v1/oauth2/token"); 
curl_setopt($login, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($login, CURLOPT_USERPWD, CLIENTID.':'.SECRET);
curl_setopt($login, CURLOPT_POSTFIELDS, 'grant_type=client_credentials');
$response = curl_exec($login);

$responseOBJ = json_decode($response);
$AccessToken = $responseOBJ->access_token;

$venta =curl_init(LINKAPI."/v2/checkout/orders/".htmlentities(addslashes($_GET['id'])));
curl_setopt($venta,CURLOPT_HTTPHEADER,array("Content-Type:application/json","Authorization: Bearer ".$AccessToken));
curl_setopt($venta, CURLOPT_RETURNTRANSFER, TRUE);

$RespuestaVenta=curl_exec($venta);
$objDatosTransaccion=json_decode($RespuestaVenta);

if(isset($objDatosTransaccion->status)&&$objDatosTransaccion->status=="COMPLETED"&&$total==$objDatosTransaccion->purchase_units[0]->amount->value){
$monto=$objDatosTransaccion->purchase_units[0]->amount->value;
$email=$objDatosTransaccion->payment_source->paypal->email_address;
$custom=$objDatosTransaccion->purchase_units[0]->custom_id;

$ids_Id_venta=explode("#",$custom);

$ids0=openssl_decrypt($ids_Id_venta[0],COD,KEY);
$id_venta=openssl_decrypt($ids_Id_venta[1],COD,KEY);

$ids1=explode("_",$ids0);

curl_close($venta);
curl_close($login);


  $conexion->query("update ventas set status = 'completado',email = '$email' where id_productos = '$ids0' and total = $monto and id = '$id_venta'")or die($conexion->error);
  
    foreach($ids1 as $val){
      $conexion->query("update productos_venta set status = 'completado',email = '$email' where id_producto = $val and id_venta = '$id_venta'")or die($conexion->error);
  
    $resultado = $conexion ->query("select * from productos where id=".$val)or die($conexion->error);
      $fila = mysqli_fetch_row($resultado);
    ?> 
              <div class="col-3">
                     <div class="card">
                     <img title="<?php echo $fila[2];?>" alt="<?php echo $fila[1];?>" class="card-img-top" src="<?php echo $fila[4];?>" data-bs-toggle="popover" data-bs-trigger="hover focus" height="175px">
                         <div class="card-body">
                         <h5 class="card-title"><?php echo $fila[1]; ?></h5>
                         <a href="<?php echo $fila[7];?>" class="btn btn-primary">DESCARGA AQUI</a>
                     </div>
              </div>
        </div>
    <?php 
   
                                                                    }
}else{
    echo '<h1><font color="red">OCURRIO UN PROBLEMA CON LA VERIFICACIÓN DE SU PAGO</font></h1>';
    unset($_SESSION);
    session_destroy();
}    
unset($_SESSION);
    



}else{
unset($_SESSION);
session_destroy();  
header('Location: ./index.php');

}
?>


  

</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
<script> 
const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
    </script>