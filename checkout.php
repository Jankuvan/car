
  <?php
session_start();
if(!isset($_SESSION['carrito'])){
  header('Location: ./index.php');
}
$arreglo=$_SESSION['carrito'];

include 'php/conexion.php';
?>

<script src="https://www.paypal.com/sdk/js?client-id=<?php echo CLIENTID;?>"></script>
<script src="https://sdk.mercadopago.com/js/v2"></script>

    <?php include("./layouts/header.php"); ?> 
    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="row mb-5">
              <div class="col-md-12">
                <h2 class="h3 mb-3 text-black">Su orden de compra</h2>
                <div class="p-3 p-lg-5 border">
                  <table class="table site-block-order-table mb-5">
                    <thead>
                      <th>Producto</th>
                      <th>Total</th>
                    </thead>
                    <tbody>
                    <?php
                   date_default_timezone_set('America/Lima');
                   $fecha = date('Y-m-d H:i:s');
                   

                     $total=0;
                     for($i=0;$i<count($arreglo);$i++){
                     $total=$total+($arreglo[$i]['Precio']*$arreglo[$i]['Cantidad']); ?>
                      <tr>
                        <td><?php echo $arreglo[$i]['Nombre']; ?></td>
                        <td>$<?php echo number_format($arreglo[$i]['Precio'], 2, '.', '');  $var[$i]=$arreglo[$i]['Id'];
                     
                       }
                       $var2=implode('_', $var);

                        ?></td>
                      </tr>    
                      <tr>
                        <td class="text-black font-weight-bold"><strong>Orden Total</strong></td>
                        <td class="text-black font-weight-bold"><strong>$<?php echo number_format($total, 2, '.', '');
                        
                       $conexion->query("insert into ventas(id_productos,total,fecha,status) values('$var2',$total,'$fecha','checkout')")or die($conexion->error);
                       $id_venta = $conexion->insert_id; 
                       
                       
                       for($i=0;$i<count($arreglo);$i++){
                       $conexion->query("insert into productos_venta(id_venta,id_producto,cantidad,precio,subtotal,status)
                        values($id_venta,
                      '".$arreglo[$i]['Id']."',
                         1,
                      '".$arreglo[$i]['Precio']."',
                      '".$arreglo[$i]['Precio']."',
                       'checkout'
                         )")or die($conexion->error);}
      

                                            // SDK de Mercado Pago
                                            require __DIR__ .  '/vendor/autoload.php';
                                            // Agrega credenciales
                                            MercadoPago\SDK::setAccessToken($at);
                                            // Crea un objeto de preferencia
                                            $preference = new MercadoPago\Preference();
                                            $item = new MercadoPago\Item();
                                            $item->id = $var2.'#'.$id_venta;
                                            $item->title = 'Precio';
                                            $item->quantity = 1;
                                            $item->unit_price = $total*4;
                                            $item->currency_id = "PEN";
                                            $preference->items = array($item);
                                            $preference->back_urls = array(
                                              "success" => "http://localhost/carrito2/verificador2.php",
                                              "pending" => "http://localhost/carrito2/pending.php",
                                              "failure" => "http://localhost/carrito2/failure.php");
                                            $preference->auto_return = "approved";
                                            $preference->save();
                         
                         
                         
                         ?></strong></td>
                       
                      </tr>
                    </tbody>
                  </table>
                  <div class="border p-3 mb-5">
                    <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse" href="#collapsepaypal" role="button" aria-expanded="false" aria-controls="collapsepaypal">Pagar con Paypal</a></h3>
                    <div class="collapse" id="collapsepaypal">
                      <div class="py-2">
                        <p class="mb-0">Paga de manera segura y sencilla a través de Paypal. No olvides utilizar tu ID de pedido como referencia. Una vez acreditado el pago seras redirigido a nueva pestaña en donde podras descargar tu pedido.</p>
                      </div>
                      <div id="paypal-button-container"></div>
                    </div>
                  </div>


                  <div class="border p-3 mb-5">
                    <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse" href="#collapsemercadopago" role="button" aria-expanded="false" aria-controls="collapsemercadopago">Pagar con MercadoPago</a></h3>
                    <div class="collapse" id="collapsemercadopago">
                      <div class="py-2">
                        <p class="mb-0">Paga de manera segura y sencilla a través de Mercadopago. Una vez acreditado el pago no olvides darle click al boton volver al sitio y te redirigira a una pestaña donde se encuentra tu pedido listo para descarga.</p>
                      </div>
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
                                    label: 'DESCARGA AQUI CON MERCADOPAGO',
                                  }
                                });
                              </script>
                    </div>
                  </div>




                </div>
              </div>
            </div>

          </div>
        </div>
 
      </div>
    </div>

  <script>
      paypal.Buttons({
   
        createOrder: (data, actions) => {
          return actions.order.create({
            purchase_units: [{
              custom_id: '<?php echo openssl_encrypt($var2,COD,KEY);?>#<?php echo openssl_encrypt($id_venta,COD,KEY);?>',
              amount: {
                value: '<?php echo $total;?>' 
              }
              
            }]
          });
        },
        onApprove: (data, actions) => {
          return actions.order.capture().then(function(orderData) {
            console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
            const transaction = orderData.purchase_units[0].payments.captures[0];
             const element = document.getElementById('paypal-button-container');
             window.location.href="verificador.php?id="+orderData.id;
          });
        }
      }).render('#paypal-button-container');
    </script>
    <?php include("./layouts/footer.php"); ?>   