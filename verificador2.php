<?php
include 'layouts/header.php';
include 'php/conexion.php';

session_start();
$total = 0;
if(isset($_SESSION['carrito'])&&isset($_GET['payment_id'])){
  $arregloCarrito=$_SESSION['carrito'];
  for($i=0;$i<count($arregloCarrito);$i++){
  $total=$total + ($arregloCarrito[$i]['Precio']*$arregloCarrito[$i]['Cantidad']);}

$payment_id = filter_input(INPUT_GET, 'payment_id', FILTER_SANITIZE_NUMBER_INT);
  if (!$payment_id) {
    header('Location: index.php');
    exit;
  }
  $auth_request = array(
    'client_id' => $clientId,
    'client_secret' => $clientSecret,
    'grant_type' => 'client_credentials'
  );
  $ch = curl_init("https://api.mercadopago.com/oauth/token");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $auth_request);
  $response = curl_exec($ch);
  $auth_response = json_decode($response);
  if (isset($auth_response->access_token)) {
    $access_token = $auth_response->access_token;
    $payment_request = array(
      "uri" => "/v1/payments/{$payment_id}",
      "method" => "GET",
      "headers" => array(
        "Authorization: Bearer {$access_token}",
        "Content-Type: application/json"
      )
    );
    $ch = curl_init("https://api.mercadopago.com{$payment_request['uri']}");
    curl_setopt($ch, CURLOPT_HTTPHEADER, $payment_request['headers']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $response = curl_exec($ch);
    $objDatosTransaccion = json_decode($response);}
    //print_r($objDatosTransaccion);
    if (isset($objDatosTransaccion->status) && $objDatosTransaccion->status == "approved" && $total*4 == $objDatosTransaccion->additional_info->items[0]->unit_price) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
   <style>
  .info-box {
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 20px;
  }

  .info-box label {
    font-weight: bold;
  }
</style>
</head>
<body>
  
<div class="row">


   <?php 
  $id = $objDatosTransaccion->additional_info->items[0]->id;
  $email = $objDatosTransaccion->payer->email;
  $monto = $objDatosTransaccion->additional_info->items[0]->unit_price/4;
  $ids_Id_venta=explode("#",$id);
  $ids0=$ids_Id_venta[0];
  $id_venta=$ids_Id_venta[1];
  $ids1=explode("_",$ids0);
  curl_close($ch);

  $conexion->query("update ventas set status = 'completado',email = '$email' where id_productos = '$ids0' and total = $monto and id = '$id_venta'")or die($conexion->error);
  foreach($ids1 as $val){
    $conexion->query("update productos_venta set status = 'completado',email = '$email' where id_producto = $val and id_venta = '$id_venta'")
    or die($conexion->error);
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





  ?>
 
  

</div>

</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
<script> 
const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
    </script>

<?php 
unset($_SESSION);
include 'layouts/footer.php';
}else{
    unset($_SESSION);
    session_destroy();
    header("Location: /failure.php");
}
}else{
  unset($_SESSION);
  session_destroy();  
  header('Location: ./index.php');
  
  }  ?>

