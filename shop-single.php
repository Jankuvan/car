<?php

include("./layouts/header.php"); 
include 'php/conexion.php';

if(isset($_GET['id'])){
 $resultado = $conexion ->query("select * from productos where id='".htmlentities(addslashes(base64_decode($_GET['id'])))."'")or die($conexion->error);
       if(mysqli_num_rows($resultado)>0){
         $fila = mysqli_fetch_row($resultado);
       }else{
        header("Location: ./index.php");
            }
           }else{
              header("Location: ./index.php");
            }
            ?>
    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
          <img src="<?php echo $fila[4]; ?>" alt="<?php echo $fila[1]; ?>" class="card-img-top" style="height: 300px; width: 80%;">

          </div>
          <div class="col-md-8">
            <h2 class="text-black"><?php echo $fila[1]; ?></h2>
           <p><?php echo $fila[2]; ?></p>
            <p><strong class="text-primary h4">$<?php echo $fila[3]; ?></strong></p>
            <div class="mb-5">
              <div class="input-group mb-3" style="max-width: 120px;">
              <div class="input-group-prepend">
              </div>
            </div>
            <p><a href="cart.php?id=<?php echo base64_encode($fila[0]); ?>" class="buy-now btn btn-sm btn-primary">Add To Cart</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
   
    <?php include("./layouts/footer.php"); ?> 
  