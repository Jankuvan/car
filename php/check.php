<?php 

session_start();
include "./conexion.php";
if(isset($_POST['email']) && isset($_POST['password'])){

$resultado = $conexion->query("select * from usuario where 
              email='".htmlentities(addslashes($_POST['email']))."' and 
              password='".sha1(htmlentities(addslashes($_POST['password'])))."'")or die($conexion->error);
    if(mysqli_num_rows($resultado)>0){
       $datos_usuario = mysqli_fetch_row($resultado);
       $nombre = $datos_usuario[1];
       $id_usuario = $datos_usuario[0];
       $email = $datos_usuario[5];
       $imagen_perfil = $datos_usuario[7];
       $nivel = $datos_usuario[8];

       $_SESSION['datos_login']= array(
           'nombre'=>$nombre,
           'id_usuario'=>$id_usuario,
           'email'=>$email,
           'imagen'=>$imagen_perfil,
           'nivel'=>$nivel
       );
       header("Location: ../admin/");
     }else{
     header("Location: ../login.php?error=".base64_encode('credenciales incorrectas'));
     unset($_SESSION['datos_login']);
     session_destroy();
     }

}else{
    header("../login.php");
}

?>