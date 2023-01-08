<?php


if(filter_var($_POST['c_email_address'],FILTER_VALIDATE_EMAIL)){
include './php/conexion.php';
if($conexion){
        $message=0;
        $nombre=htmlentities(addslashes($_POST['c_fname'].' '.$_POST['c_lname']));
        $direccion=htmlentities(addslashes($_POST['c_address']));
        $ciudad=htmlentities(addslashes($_POST['c_state_country']));
        $telefono=htmlentities(addslashes($_POST['c_phone']));
        $email=htmlentities(addslashes($_POST['c_email_address']));
        $password=htmlentities(addslashes($_POST['c_account_password']));
        $img_perfil='default.png';
        $nivel='cliente';

             if($nombre==""||$direccion==""||$ciudad==""||$telefono==""||$email==""||$password=""){
              $mensaje=2; 
              }else{
               $nbr=0;
         $sql="SELECT nombre FROM usuario WHERE email LIKE ? OR (nombre LIKE ?)";
           $resultado=mysqli_prepare($conexion,$sql);
         $ok=mysqli_stmt_bind_param($resultado,'ss',$email,$nombre);
         $ok=mysqli_stmt_execute($resultado);
         if($ok==FALSE){
         echo "Error de ejecucion de la consulta.<br/>";
         }else{
           $ok=mysqli_stmt_bind_result($resultado,$nombre);
          $ok=mysqli_stmt_store_result($resultado);
          $nbr=mysqli_stmt_num_rows($resultado);
          mysqli_stmt_free_result($resultado);
           mysqli_stmt_close($resultado);
          }
            if($nbr>0){
            $mensaje=3; 

             }else{
               //INICIO MAIL
                          $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                          $to=$email;
                          $subject='Gracias por suscribirte a Jpconstruye2022';
                          $header= 'From: administrador@jpconstruye2022.com'."\r\n";
                          $codigo=substr(str_shuffle($permitted_chars), 0, 6).uniqid();
                          $codigo0=sha1($codigo);

                          $message='    
                                    Gracias por suscribirte
                              tu nueva contrasena es la siguiente: 
                                        '.$codigo.'
                            Click aqui abajo para iniciar sesion 
                           https://jpconstruye2022.com/login.php
                             ';
                          mail($to, $subject, $message, $header);

                  //TERMINO MAIL
     
             $sql="insert into usuario (nombre,direccion,ciudad,telefono,email,password,img_perfil,nivel) values (?,?,?,?,?,?,?,?)";
             $resultado_insert=mysqli_prepare($conexion,$sql);
            
              $ok=mysqli_stmt_bind_param($resultado_insert,'ssssssss',$nombre,$direccion,$ciudad,$telefono,$email,$codigo0,$img_perfil,$nivel);
             $ok=mysqli_stmt_execute($resultado_insert);
             

             if($ok==FALSE){
              echo "Error de ejecucion de la consulta<br/>";
              $mensaje=0;
              }else{
               $mensaje=1; 
               }
              mysqli_stmt_close($resultado_insert);
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
    header("Location:suscribete.php?mensaje=".base64_encode($mensaje));
}
}else{
  header("Location:suscribete.php?mensaje0=".base64_encode('email_inexistente'));
}

?>


