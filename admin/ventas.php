<?php
session_start();
include "../php/conexion.php";
if(!isset($_SESSION['datos_login'])){
header("Location: ../index.php");
}
$arregloUsuario = $_SESSION['datos_login'];
$resultado=$conexion->query("
select * from producto_insertado where id_usuario = '".$arregloUsuario['id_usuario']."'
")or die($conexion->error);
?>
<?php include "./layout/header.php";?>

<div class="wrapper">
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="./dashboard/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>
  <div class="content-wrapper">

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Tus ventas</h1>
          </div>
          <div class="col-sm-6 text-right">
       
          </div>
        </div>
      </div>
    </div>
    <section class="content">
      <div class="container-fluid">
      
      <table class="table">
       <thead>
         <tr>
         <th>Nombre</th>
         <th>cantidad</th>
         <th>precio</th>
         <th>fecha</th>
         </tr>
       </thead>
       <tbody>
           <?php $suma=0;?>
         <?php while($f=mysqli_fetch_array($resultado)){
            
              $prod=$f['id_producto'];
        
        $resultado2=$conexion->query("
        SELECT * FROM `productos_venta` 
        INNER JOIN productos ON productos_venta.id_producto = productos.id 
        INNER JOIN ventas ON productos_venta.id_venta = ventas.id 
        WHERE productos_venta.status = 'completado' AND productos_venta.id_producto = '".$prod."'
         ")or die($conexion->error);

         while($f2=mysqli_fetch_row($resultado2)){
         ?>
         </tr>
         <td><?php echo $f2[9];?></td>
         <td><?php echo $f2[3];?></td>
         <td><?php echo $f2[4];?></td>
         <td><?php echo $f2[20];?></td>
         </tr>
         
         <?php $suma=$suma+$f2[4];  }}
        $resultado4=$conexion->query("select * from solicitudes where id_usuario = '".$arregloUsuario['id_usuario']."'");
        $retiro=0;
        while($f4=mysqli_fetch_row($resultado4)){
        $retiro=$retiro+$f4[3];
        }
         $descuento=$suma*0.15;
         $neto=$suma-$descuento-$retiro;
         echo '<font color="green">&nbsp <strong>Saldo neto: $'.$neto.'</font></stron>';
         ?>
       </tbody>
       </table>
      </div>
    </section>
  </div>

<?php include "./layout/footer.php";?>