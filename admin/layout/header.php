

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>| Panel de usuario</title>
  <link rel="icon" type="image/png" href="../images/users/default.png">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="./dashboard/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="./dashboard/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <link rel="stylesheet" href="./dashboard/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="./dashboard/plugins/jqvmap/jqvmap.min.css">
  <link rel="stylesheet" href="./dashboard/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="./dashboard/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="./dashboard/plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="./dashboard/plugins/summernote/summernote-bs4.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<body class="hold-transition sidebar-mini layout-fixed">

  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index3.html" class="brand-link">
      <img src="./dashboard/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">JP</span>
    </a>
    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../images/users/<?php echo $arregloUsuario['imagen']; ?>" class="img-circle elevation-2" 
          alt="<?php echo $arregloUsuario['imagen']; ?>">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $arregloUsuario['nombre']; ?></a>
        </div>
      </div>
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        
          <li class="nav-item">
            <a href="./index.php" class="nav-link">
              <i class="nav-icon fas	fa-folder-open"></i>
              <p>
               Productos
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./ventas.php" class="nav-link">
              <i class="nav-icon fas	fa-calculator"></i>
              <p>
               Ventas
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./retiro.php" class="nav-link">
              <i class="nav-icon fas fa-dollar-sign"></i>
              <p>
               Retiro
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../php/cerrar_sesion.php" class="nav-link">
              <i class="nav-icon fas fa-wind"></i>
              <p>
              Salir
              </p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>