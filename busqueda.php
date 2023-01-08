<?php

include('./php/conexion.php');
if(isset($_GET['texto']) || isset($_GET['texto2'])){
?>
    <?php include("./layouts/header.php"); ?> 

    <div class="site-section">
      <div class="container">

        <div class="row mb-5">
          <div class="col-md-9 order-2">

            <div class="row">
              <div class="col-md-12 mb-5">
                <div class="float-md-left mb-4"><h2 class="text-black h5">Buscando resultados...</h2></div>
                <div class="d-flex">
                  <div class="dropdown mr-1 ml-md-auto">
      
                  </div>
                  <div class="btn-group">
               
                    
                  </div>
                </div>
              </div>
            </div>
            <div class="row mb-5">
            <?php 

            if(isset($_GET['texto2'])){
              $busca_lupa=htmlentities(addslashes($_GET['texto2']));
            }else{
              $busca_lupa=htmlentities(addslashes(base64_decode($_GET['texto'])));
            }
            
           
            $resultado = $conexion ->query("select productos.*, categorias.nombre as categoria from productos 
            inner join categorias on productos.id_categoria = categorias.id
            where 
            productos.nombre like '%".$busca_lupa."%' or
            productos.descripcion like '%".$busca_lupa."%' or
            categorias.id like '%".$busca_lupa."%'  
            order by id DESC limit 100")or die($conexion -> error);

            if(mysqli_num_rows($resultado)>0){   
              
              
            while($fila = mysqli_fetch_array($resultado)){
            
            ?>

            <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
                <div class="block-4 text-center border">
                  <figure class="block-4-image" >
                    <a href="shop-single.php?id=<?php echo base64_encode($fila['id']);?>">
                    <img title="<?php echo $fila['descripcion'];?>" data-bs-content="<?php echo $fila['verifica'];?>" alt="<?php echo $fila['nombre'];?>" class="card-img-top" src="<?php echo $fila['imagen'];?>" data-bs-toggle="popover" data-bs-trigger="hover focus" height="175px" ></a>
                  </figure>
                  <div class="block-4-text p-4">
                    <h3><a href="shop-single.php?id=<?php echo base64_encode($fila['id']);?>"><?php echo $fila['nombre'];?></a></h3>
                    
                    <p class="text-primary font-weight-bold">$<?php echo $fila['precio'];?></p>
                  </div>
                </div>
              </div>
            <?php }}else{
                echo '<h2>Sin resultados</h2>';
            } ?>
            </div>
            <div class="row" data-aos="fade-up">
              <div class="col-md-12 text-center">
                <div class="site-block-27">
                  <ul>
                 
                  
                  </ul>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-3 order-1 mb-5 mb-md-0">
            <div class="border p-4 rounded mb-4">
              <h3 class="mb-3 h6 text-uppercase text-black d-block">Categorias de archivos</h3>
              <ul class="list-unstyled mb-0">
              <?php 
              $re=$conexion->query("select * from categorias");
              while($f=mysqli_fetch_array($re)){
              ?>
              <div class="form-group">
              <li class="mb-1">
              <a href=./busqueda.php?texto=<?php echo base64_encode($f['id']);?> class="d-flex">
              <span><font color="blue"><?php echo $f['nombre'];?></font></span>
              <span class="text-black ml-auto">
              <?php
               $re2 = $conexion->query("select count(*) from productos where id_categoria = ".$f['id']);
              $fila = mysqli_fetch_row($re2);
              echo $fila[0];
               ?>
              </span>
               </a>
              </li>
              <?php }?>
              </div>
              </ul>
            </div>

            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="site-section site-blocks-2">
                <div class="row justify-content-center text-center mb-5">
                  <div class="col-md-7 site-section-heading pt-4">
                    <h2>CATEGORIAS</h2>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6 col-md-6 col-lg-4 mb-4 mb-lg-0" data-aos="fade" data-aos-delay="">
                    <a class="block-2-item" href="#">
                      <figure class="image">
                        <img src="images/acad.jpg" alt="" height="250px" class="card-img-top">
                      </figure>
                      <div class="text">
                        <span class="text-uppercase"></span>
                        <h3>AcadDWG</h3>
                      </div>
                    </a>
                  </div>
                  <div class="col-sm-6 col-md-6 col-lg-4 mb-5 mb-lg-0" data-aos="fade" data-aos-delay="100">
                    <a class="block-2-item" href="#">
                      <figure class="image">
                        <img src="images/murito.jpg" alt="" height="250px" class="card-img-top">
                      </figure>
                      <div class="text">
                        <span class="text-uppercase"></span>
                        <h3>Office</h3>
                      </div>
                    </a>
                  </div>
                  <div class="col-sm-6 col-md-6 col-lg-4 mb-5 mb-lg-0" data-aos="fade" data-aos-delay="200">
                    <a class="block-2-item" href="#">
                      <figure class="image">
                        <img src="images/tutos.jpg" alt="" height="250px" class="card-img-top">
                      </figure>
                      <div class="text">
                        <span class="text-uppercase"></span>
                        <h3>Tutoriales_videos</h3>
                      </div>
                    </a>
                  </div>
                </div>
              
            </div>
          </div>
        </div>
        
      </div>
    </div>
    
    <?php 
       }else{
        header("Location: ./index.php");}
       
    include("./layouts/footer.php"); 
    
   
    ?> 
<script> 
const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
</script>