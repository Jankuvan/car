<?php
if(isset($_POST["btnAccion"])){
    switch($_POST["btnAccion"]){
               case "Eliminar":
                    if(is_numeric( openssl_decrypt($_POST['id2'],COD,KEY ))){  
                    $ID=openssl_decrypt($_POST['id2'],COD,KEY);
                    foreach($_SESSION['carrito'] as $indice=>$producto){
                        if($producto['Id']==$ID){
                         
                            unset($_SESSION['carrito'][$indice]);
                            $_SESSION['carrito']=array_values($_SESSION['carrito']); 
                        }
                    }
                }
                break;           
           }
        }
?>