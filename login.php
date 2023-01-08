<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Jp | Conéctate</title>
  <link rel="icon" type="image/png" href="./images/users/default.png">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="./admin/dashboard/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="./admin/dashboard/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="./admin/dashboard/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="./index.php"><b><font color="blue">JP</font></b></a>
  </div>
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Inicia sesion con tu email registrado</p>

      <form action="./php/check.php" method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
         <br></br>
        <?php
           if(isset($_GET['error'])){
             echo '<div class="col-12 alert alert-danger">'.htmlentities(addslashes(base64_decode($_GET['error']))).'</div>';
           }
        ?>
        </div>
      </form>
      <p class="mb-1">
      </p>
      <p class="mb-0">
        <a href="suscribete.php" class="text-center">Click aqui si no se ha registrado</a>
      </p>
    </div>
  </div>
</div>

<script src="./admin/dashboard/plugins/jquery/jquery.min.js"></script>
<script src="./admin/dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="./admin/dashboard/dist/js/adminlte.min.js"></script>
</body>
</html>
