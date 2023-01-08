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
            <h1 class="m-0">Solicita retiro de saldo</h1>
          </div>
          <div class="col-sm-6 text-right">
       
          </div>
        </div>
      </div>
    </div>
    <div class="container">
  <div class="row">
    <div class="col">
    <form action="compRetiro.php" method="POST">
    <div class="card">
  <div class="card-header">
    Ingresa el monto de tu retiro junto con el link de recepción de pagos de su cuenta personal de Paypal
  </div>
 
  <div class="card-body">
  <div class="mb-3 row">
    <label class="col-sm-3 col-form-label">Monto</label>
    <div class="col-sm-10">
      <input type="number" class="form-control" name="monto" required>
    </div>
  </div>
  <div class="mb-3 row">
    <label class="col-sm-3 col-form-label">Link Paypal</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="link" required>
    </div>
  </div>
  <button type="submit" class="btn btn-primary mb-3">Enviar solicitud de retiro</button>
</form>

  </div>
</div>
    </div>
    <div class="col">

      <?php 
     if(isset($_GET['mensaje'])&&htmlentities(addslashes(base64_decode($_GET['mensaje'])))==1){
        echo '<font color="blue" size="5"><strong>Su solicitud a sido registrada.</strong></font>';
    }
    if(isset($_GET['mensaje'])&&htmlentities(addslashes(base64_decode($_GET['mensaje'])))==2){
        echo '<font color="green" size="5"><strong>Uno de los campos esta vacio.<br/></strong></font>';
    }
    if(isset($_GET['mensaje'])&&htmlentities(addslashes(base64_decode($_GET['mensaje'])))==4){
      echo '<font color="red" size="5"><strong>El monto solicitado es mayor a su saldo actual o su saldo es menor que $30 <br/></strong></font>';
  }
      
      ?>
    </div>
  </div>
</div>

  </div>
 

<?php include "./layout/footer.php";?>