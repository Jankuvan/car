
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
<?php include "./layout/header.php";
?>
<div class="wrapper">
  <div class="preloader flex-column justify-content-center align-items-center">
   
  </div>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Tus productos</h1>
          </div>
          <div class="col-sm-6 text-right">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
           <i class="fa fa-plus"></i> Insertar producto
          </button>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
      <?php
      if(isset($_GET['mensaje'])){
      $mensaje=htmlentities(addslashes(base64_decode($_GET['mensaje'])));
      

       if($mensaje == 'Favor llenar todos los campos'){
      ?>
      <div class="alert alert-danger" role="alert">
      <?php echo $mensaje;?>
       </div>

      <?php  }?>
      <?php
       if($mensaje == 'Se ha insertado correctamente'){
      ?>
      <div class="alert alert-success" role="alert">
      Se ha insertado correctamente.
       </div>

      <?php  }?>
      <?php
        if($mensaje == 'El enlace de descarga debe ser de google drive y debe existir una imagen png o jpg almanecada en una plataforma web'){
      ?>
      <div class="alert alert-danger" role="alert">
      El enlace de descarga debe ser de google drive y debe existir una imagen png o jpg almanecada en una plataforma web
       </div>

      <?php  }?>
      <?php
       if($mensaje == 'Usted ha llegado a su limite de productos'){
      ?>
      <div class="alert alert-danger" role="alert">
      Usted ha llegado a su limite de productos
       </div>

      <?php } }?>
      <table class="table">
       <thead>
         <tr>
         <th>Nombre</th>
         <th>Imagen</th>
         <th>Descripción</th>
         </tr>
       </thead>
       <tbody>
       
         <?php while($f=mysqli_fetch_array($resultado)){
              $prod=$f['id_producto'];
      
         $resultado2=$conexion->query("
         select * from productos where id = '".$prod."'
         ")or die($conexion->error);
         while($f2=mysqli_fetch_array($resultado2)){
         ?>
         </tr>
         <td><?php echo $f2['nombre'];?></td>
         <td><img src="<?php echo $f2['imagen'];?>" width="20px" height="20px" alt=""></td>
         <td><?php echo $f2['descripcion'];?></td>
         <td>
           <button class="btn btn-danger btn-small btnEliminar" 
           data-id="<?php echo openssl_encrypt($f2['id'],COD,KEY); ?>"
           data-toggle="modal" data-target="#modalEliminar">
             <i class="fa fa-trash"></i>
           </button>
         </td>
         </tr>
         <?php    }} ?>
       </tbody>
       </table>
      </div>
    </section>
  </div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="../php/insertarproducto.php" method="POST" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Insertar producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="nombre">Nombre</label>
          <input type="text" name="nombre" placeholder="nombre" id="nombre" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="descripcion">Descripcion</label>
          <input type="text" name="descripcion" placeholder="descripcion" id="descripcion" class="form-control" required>
      </div>
      <div class="form-group">
          <label for="imagen">Imagen</label>
          <input type="text" name="imagen" placeholder="https://...." id="imagen" class="form-control" required>
      </div>
      <div class="form-group">
          <label for="precio">Precio</label>
          <input type="number" min="0" name="precio" placeholder="precio" id="precio" class="form-control" required>
      </div>
      <div class="form-group">
          <label for="precio">Inventario</label>
          <input type="number" min="0" name="inventario" placeholder="cantidad" id="inventario" class="form-control" required>
      </div>
      <div class="form-group">
          <label for="categoria">Categoria</label>
          <select name="categoria" id="categoria" class="form-control" required>
            <?php 
            $res= $conexion->query("select * from categorias");
            while($f=mysqli_fetch_array($res)){
              echo '<option value="'.openssl_encrypt($f['id'],COD,KEY).'">'.$f['nombre'].'</option>';
            }
            ?>
            </select>
      </div>
      <div class="form-group">
          <label for="color">Enlace de descarga</label>
          <input type="text" name="color" placeholder="https://...." id="color" class="form-control" required>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
      </form>
    </div>
  </div>
</div>
  <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="modalEliminarLabel">Eliminar producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      ¿Desea eliminar el producto?...
      Debe tener en cuenta que se borrara el registro de sus ventas de este producto,
      si es que llego a venderlo. Si no vendio nada de este producto que desea eliminar,
      puede proceder con la eliminación.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-danger eliminar" data-dismiss="modal">Eliminar</button>
      </div>
      
    </div>
  </div>
</div>
<?php include "./layout/footer.php";?>
<script>
  $(document).ready(function(){
    var idEliminar= -1;
    var fila;
    $(".btnEliminar").click(function(){
      idEliminar=$(this).data('id');
      fila=$(this).parent('td').parent('tr');
    })
    $(".eliminar").click(function(){
      $.ajax({
        url: '../php/eliminarproducto.php',
        method: 'POST',
        data: {
          id:idEliminar
        }
      }).done(function(res){
        alert(res);
        $(fila).fadeOut(1000);
      });
      $(fila).fadeOut(1000);
    })
  });
</script>


