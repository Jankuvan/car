<?php
session_start();
include './php/conexion.php';

if(isset($_SESSION['carrito'])){
  if(isset($_GET['id'])){
    $arreglo=$_SESSION['carrito'];
    $encontro=false;
    $numero=0;
    for($i=0;$i<count($arreglo);$i++){
    if($arreglo[$i]['Id']==htmlentities(addslashes(base64_decode($_GET['id'])))){
        $encontro=true;
        $numero=$i;
      }
    }
    if($encontro==true){
      $arreglo[$numero]['Cantidad']=$arreglo[$numero]['Cantidad']+1;
      $_SESSION['carrito']=$arreglo;
    }else{
      $nombre="";
      $precio="";
      $imagen="";
 $res= $conexion ->query('select * from productos where id='.htmlentities(addslashes(base64_decode($_GET['id']))))or die($conexion->error);
      $fila= mysqli_fetch_row($res);
      $nombre=$fila[1];
      $precio=$fila[3];
      $imagen=$fila[4];
      $arregloNuevo=array(
        'Id'=> htmlentities(addslashes(base64_decode($_GET['id']))),
        'Nombre'=> $nombre,
        'Precio'=> $precio,
        'Imagen'=> $imagen,
        'Cantidad'=> 1
      );
      array_push($arreglo, $arregloNuevo);
      $_SESSION['carrito']=$arreglo;
    }
  }
}else{
  if(isset($_GET['id'])){
    $nombre="";
    $precio="";
    $imagen="";
 $res= $conexion ->query('select * from productos where id='.htmlentities(addslashes(base64_decode($_GET['id']))))or die($conexion->error);
    $fila= mysqli_fetch_row($res);
    $nombre=$fila[1];
    $precio=$fila[3];
    $imagen=$fila[4];
    $arreglo[]=array(
      'Id'=> htmlentities(addslashes(base64_decode($_GET['id']))),
      'Nombre'=> $nombre,
      'Precio'=> $precio,
      'Imagen'=> $imagen,
      'Cantidad'=> 1
    );
    $_SESSION['carrito']=$arreglo;
  }
}

?>

  <?php include("./layouts/header.php");

include './php/eliminarCarrito.php';

 ?> 

    <div class="site-section">
      <div class="container">
      
        <div class="row mb-5">
         
        <div class="site-blocks-table" style="margin: auto;">

              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th class="product-thumbnail">Imagen</th>
                    <th class="product-name">Producto</th>
                    <th class="product-price">Precio</th>
                    <th class="product-quantity">Cantidad</th>
                    <th class="product-total">Total</th>
                    <th class="product-remove">Eliminar</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $total = 0;
                  if(isset($_SESSION['carrito'])){
                    $arregloCarrito=$_SESSION['carrito'];
                    for($i=0;$i<count($arregloCarrito);$i++){
                       $total=$total + ($arregloCarrito[$i]['Precio']*$arregloCarrito[$i]['Cantidad']);
                      
                  ?>
                  <tr>
                    <td class="product-thumbnail">
                    <img src="<?php echo $arregloCarrito[$i]['Imagen']; ?>" alt="Image" class="img-fluid" width="50em" height="50em">


                    </td>
                    <td class="product-name">
                      <h2 class="h5 text-black"><?php echo $arregloCarrito[$i]['Nombre']; ?></h2>
                    </td>
                    <td>$<?php echo $arregloCarrito[$i]['Precio']; ?></td>
                    <td>
                    <?php echo $arregloCarrito[$i]['Cantidad']; ?>

                    </td>
                    <td>
                      $<?php echo $arregloCarrito[$i]['Precio']*$arregloCarrito[$i]['Cantidad']; ?></td>
                    <td><form action="" method="post">
               <input type="hidden" name="id2" id="id2" value="<?php echo openssl_encrypt($arregloCarrito[$i]['Id'],COD,KEY);?>">
               <button 
               class="btn btn-danger" 
               type="submit"
               name="btnAccion"
               value="Eliminar"
               >X</button>
               </form> </td>
                  </tr>
                  <?php }} ?>
                 
                </tbody>
              </table>
            </div>
        
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="row mb-5">
              <div class="col-md-6 mb-3 mb-md-0">
               
              </div>
              <div class="col-md-6">
                
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                
                
              </div>
              <div class="col-md-8 mb-3 mb-md-0">
                
              </div>
              <div class="col-md-4">
                
              </div>
            </div>
          </div>
         
          <div class="col-md-6 pl-5">
            <div class="row justify-content-end">
          
              <div class="col-md-7" style="margin: auto;">
                <div class="row">
                  <div class="col-md-12 text-right border-bottom mb-5">
                    <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                  </div>
                </div>


                <form action="checkout.php" name="form1">
                <div class="row mb-3">
                  <div class="col-md-6">
                    <span class="text-black">Subtotal</span>
                  </div>
                  <div class="col-md-6 text-right">
                    <strong class="text-black">$<?php echo $total; ?></strong>
                  </div>
                </div>
                <div class="row mb-5">
                  <div class="col-md-6">
                    <span class="text-black">Total</span>
                  </div>
                  <div class="col-md-6 text-right">
                    <strong class="text-black">$<?php echo $total; ?></strong>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <button class="btn btn-primary btn-lg py-3 btn-block" class="submit">Proceed To Checkout</button>
                  </div>
                </div>
                </form>
                 

              </div>
              </div>
            </div>
    
          </div>
        
        </div>
      </div>
    </div>

    <?php include("./layouts/footer.php"); ?> 
    
  
