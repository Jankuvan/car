<?php
session_start();
include "../php/conexion.php";

$arregloUsuario = $_SESSION['datos_login'];

$resultado3=$conexion->query("SELECT * FROM producto_insertado 
INNER JOIN productos_venta ON producto_insertado.id_producto = productos_venta.id_producto 
INNER JOIN productos ON productos_venta.id_producto = productos.id 
WHERE productos_venta.status = 'completado' 
AND producto_insertado.id_usuario = '".$arregloUsuario['id_usuario']."'")or die($conexion->error);
$suma=0;
while($f3=mysqli_fetch_row($resultado3)){
    $suma=$suma+($f3[7]-0.15*$f3[7]);
    
}
$resultado4=$conexion->query("select * from solicitudes where id_usuario = '".$arregloUsuario['id_usuario']."' 
");
$retiro=0;
while($f4=mysqli_fetch_row($resultado4)){
    $retiro=$retiro+$f4[3];
}


if($conexion){
    $message=0;
    $monto=htmlentities(addslashes($_POST['monto']));
    $link=htmlentities(addslashes($_POST['link']));
    date_default_timezone_set('America/Lima');
    $fecha = date('Y-m-d h:m:s');

         if($monto==""||$link==""){
          $mensaje=2; 
          }else{
         if($monto <= ($suma-$retiro) && $monto >= 30){
         $sql="insert into solicitudes(id_usuario,nombre,monto,email,link,fecha) values (?,?,?,?,?,?)";
         $resultado_insert=mysqli_prepare($conexion,$sql);
          $ok=mysqli_stmt_bind_param($resultado_insert,'ssssss',$arregloUsuario['id_usuario'],$arregloUsuario['nombre'],
          $monto,$arregloUsuario['email'],$link,$fecha);
         $ok=mysqli_stmt_execute($resultado_insert);
         if($ok==FALSE){
          echo "Error de ejecucion de la consulta<br/>";
          $mensaje=0;
          }else{
           $mensaje=1; //echo datos añadidos
           }
          mysqli_stmt_close($resultado_insert);
         }else{
             $mensaje=4;
         }
         }
         if(mysqli_close($conexion)==false){
          echo 'Error de conexion';
          $mensaje=0; 
           }
             }
else{
printf('Error %d : %s.<br/>',mysqli_connect_errno(),mysqli_connect_error());
}
if($mensaje!=0){
header("Location:retiro.php?mensaje=".base64_encode($mensaje));
}
?>


