<?php
include 'global/config.php';
include 'global/conexion.php';
include 'carrito.php';
include 'templates/cabecera.php';
?>

<?php
if($_POST){
    $total=0;
    $cantidad = 0;
    $titulo = 0;
    $ID = 0;
    $SID=session_id();
    foreach($_SESSION['CARRITO'] as $indice=>$producto){
    $total = $total + ($producto['PRECIO']*$producto['CANTIDAD']);
    $titulo .= $producto['NOMBRE'] . '_';
    $ID .= $producto['ID'] . '_';
    }
      // SDK de Mercado Pago
      require __DIR__ .  '/vendor/autoload.php';
      // Agrega credenciales
      MercadoPago\SDK::setAccessToken($at);
      // Crea un objeto de preferencia
      $preference = new MercadoPago\Preference();
      $item = new MercadoPago\Item();
      $item->id = $ID;
      $item->title = $titulo;
      $item->description = 'Dispositivo móvil de Tienda e-commerce';
      $item->quantity = 1;
      $item->unit_price = $total;
      $item->currency_id = "PEN";
      $preference->items = array($item);
      $preference->back_urls = array(
        "success" => "https://jpconstruye2022.com/verificador.php",
        "failure" => "https://jpconstruye2022.com/failure.php");
      $preference->auto_return = "approved";
      $preference->binary_mode = true;
      $preference->save();
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<script src="https://sdk.mercadopago.com/js/v2"></script>
</head>
<body>

    <br></br>

<div class="cho-container"></div>
<script>
  const mp = new MercadoPago('<?php echo $public_key;?>', {
    locale: 'es-PE'
  });
  mp.checkout({
    preference: {
      id: '<?php echo $preference->id; ?>'
    },
    render: {
      container: '.cho-container',
      label: 'PAGA CON MERCADO PAGO',
    }
  });
</script>

</body>
</html>