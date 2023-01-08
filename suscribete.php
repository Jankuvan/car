
 
    <?php include("./layouts/header.php"); ?> 
<form action="thankyou.php" method="post" name="form1">
    <div class="site-section">
      <div class="container">
      
        <div class="row">
          <div class="col-md-6 mb-5 mb-md-0">
            <h2 class="h3 mb-3 text-black">Enviar información de usuario</h2>
            <div class="p-3 p-lg-5 border">
              
              <div class="form-group">
                <label for="c_country" class="text-black">Pais<span class="text-danger">*</span></label>
                <select id="c_country" class="form-control" name="country" required>
                  <option value="1">Selecciona pais</option>    
                  <option value="2">Argentina</option>    
                  <option value="3">Bolivia</option>    
                  <option value="4">Colombia</option>    
                  <option value="5">Chile</option>    
                  <option value="6">Ecuador</option>    
                  <option value="7">Perú</option>    
                  <option value="8">Uruguay</option>    
                  <option value="9">Otros</option>    
                </select>
              </div>
              <div class="form-group row">
                <div class="col-md-6">
                  <label for="c_fname" class="text-black" id="c_fname">Nombre <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="c_fname" name="c_fname" required>
                </div>
                <div class="col-md-6">
                  <label for="c_lname" class="text-black">Apellidos <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="c_lname" name="c_lname" required>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <label for="c_companyname" class="text-black">Compañia </label>
                  <input type="text" class="form-control" id="c_companyname" name="c_companyname">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <label for="c_address" class="text-black">Dirección <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="c_address" name="c_address" placeholder="Street address" required>
                </div>
              </div>

              <div class="form-group">
                <input type="text" class="form-control" placeholder="Apartment, suite, unit etc. (optional)">
              </div>

              <div class="form-group row">
                <div class="col-md-6">
                  <label for="c_state_country" class="text-black">Ciudad <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="c_state_country" name="c_state_country" required>
                </div>
                <div class="col-md-6">
                  <label for="c_postal_zip" class="text-black">Codigo postal<span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="c_postal_zip" name="c_postal_zip">
                </div>
              </div>

              <div class="form-group row mb-5">
                <div class="col-md-6">
                  <label for="c_email_address" class="text-black">Dirección de email<span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="c_email_address" name="c_email_address" required>
                </div>
                <div class="col-md-6">
                  <label for="c_phone" class="text-black">Telefono<span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="c_phone" name="c_phone" placeholder="Phone Number" required>
                </div>
              </div>

              <div class="form-group">
                <label for="c_create_account" class="text-black" data-toggle="collapse" href="#create_an_account" role="button" aria-expanded="false" aria-controls="create_an_account"><input type="checkbox" value="1" id="c_create_account"> Crea un password de acceso</label>
                <div class="collapse" id="create_an_account">
                  <div class="py-2">
                    <p class="mb-3">Cree una cuenta con su email de registro y un nuevo password</p>
                    <div class="form-group">
                      <label for="c_account_password" class="text-black">Password</label>
                      <input type="password" class="form-control" id="c_account_password" name="c_account_password" placeholder="" required>
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="c_order_notes" class="text-black">Notas</label>
                <textarea name="c_order_notes" id="c_order_notes" cols="30" rows="5" class="form-control" placeholder="Write your notes here..."></textarea>
              </div>

            </div>
          </div>
          <div class="col-md-6">

            
            
            <div class="row mb-5">
              <div class="col-md-12">
                <h2 class="h3 mb-3 text-black">Confirmación de envio</h2>
                <div class="p-3 p-lg-5 border">
                
                  <div class="form-group">
                  <tr><td align="right"><input type="checkbox" name="aceptacion" id="case1" onclick="verif_check()" required/></td><td>
Acepto las condiciones, accesibles en <a href="images/jp_building.pdf" style="color:blue" onclick="maj_check()" target="_blanck">este enlace</a>.</td></tr>
                  <br><br>
                    <button class="btn btn-primary btn-lg py-3 btn-block" type="submit">Suscribirme</button>
                  </div>
 
                  <?php
if(isset($_GET['mensaje'])&&base64_decode($_GET['mensaje'])==1){
    echo '<font color="blue" size="5"><strong>Su inscripcion se ha registrado,<br/>verifique su email para inicio de sesión</strong></font>';
}
if(isset($_GET['mensaje'])&&base64_decode($_GET['mensaje'])==2){
    echo '<font color="green" size="5"><strong>Uno de los campos esta vacio.<br/></strong></font>';
}
if(isset($_GET['mensaje'])&&base64_decode($_GET['mensaje'])==3){
    echo '<font color="red" size="5"><strong>Ya ha realizado la solicitud.<br/></strong></font>';
}
if(isset($_GET['mensaje0'])==base64_decode('email_inexistente')){
  echo '<font color="red" size="5"><strong>Su correo electrónico no existe,<br/>por favor introdusca un correo valido</strong></font>';
}
?>
                </div>
              </div>
            </div>

          </div>
        </div>
  
      </div>
    </div>
    </form>

    <?php include("./layouts/footer.php"); ?> 
 
<script>
function verif(){
  if(document.form1.aceptacion.checked==false){
    alert("Debe aceptar las condiciones.");
    return false;
  }else{
    if(document.form1.c_fname.value==""
    || document.form1.c_lname.value==""
    || document.form1.c_address.value==""
    || document.form1.c_state_country.value==""
    || document.form1.c_email_address.value==""
    || document.form1.c_phone.value==""
    || document.form1.c_account_password.value==""
    
    ){
      alert("Todos los campos son obligatorios.");
      return false;
    }else{
      return true;
    }}}
var check_ok=0;
function verif_check(){
  if(check_ok==0){
    document.form1.aceptacion.checked=false;
    alert("Debe leer las condiciones.");
  }
}
function maj_check(){
  check_ok=1; 
}
</script>