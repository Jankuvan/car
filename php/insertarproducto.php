<?php 
session_start();
include "./conexion.php";

if(isset($_POST['nombre'])&&isset($_POST['descripcion'])&&isset($_POST['precio'])
&&isset($_POST['imagen'])&&isset($_POST['categoria'])&&isset($_POST['color'])&&isset($_POST['inventario'])){
$arregloUsuario = $_SESSION['datos_login'];
$cuenta_prod = $conexion->query("select count(*) from producto_insertado where id_usuario = '".$arregloUsuario['id_usuario']."'")or die($conexion->error);
$fila = mysqli_fetch_row($cuenta_prod);

$enlace=htmlentities(addslashes($_POST['color']));
$imagen=htmlentities(addslashes($_POST['imagen']));
       if($fila[0]<5){
              if(preg_match("/google.com/",$enlace)&&(preg_match("/.jpg/",$imagen)||preg_match("/.png/",$imagen))){
                

                        $conexion->query("insert into productos 
                        (nombre,descripcion,precio,inventario,imagen,id_categoria,color) values
                        (
                          '".htmlentities(addslashes($_POST['nombre']))."',
                          '".htmlentities(addslashes($_POST['descripcion']))."',
                          '".htmlentities(addslashes($_POST['precio']))."',
                          '".htmlentities(addslashes($_POST['inventario']))."',
                          '$imagen',
                          '".openssl_decrypt($_POST['categoria'],COD,KEY)."',
                          '$enlace'
                        )
                      
                        ")or die($conexion->error);
                        

                        $consult_prod=$conexion->query("
                        select * from productos where nombre = '".htmlentities(addslashes($_POST['nombre']))."'
                        ")or die($conexion->error);
                        while($f3=mysqli_fetch_array($consult_prod)){
                          $ide=$f3['id'];
                        }

                        $conexion->query("insert into producto_insertado 
                        (id_usuario,id_producto) values
                        (
                          '".$arregloUsuario['id_usuario']."',
                          '".$ide."'
                        )
                      
                        ")or die($conexion->error);

                        header("Location: ../admin/index.php?mensaje=".base64_encode('Se ha insertado correctamente'));
                      
                                    
                      
        }else{
                            header("Location: ../admin/index.php?mensaje=".base64_encode('El enlace de descarga debe ser de google drive y debe existir una imagen png o jpg almanecada en una plataforma web'));
                          }

           }else{
            header("Location: ../admin/index.php?mensaje=".base64_encode('Usted ha llegado a su limite de productos'));
                        }


}else{
    header("Location: ../admin/index.php?mensaje=".base64_encode('Favor llenar todos los campos'));
}

?>