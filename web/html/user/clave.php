<?php
session_start();

if (isset($_SESSION['loggedin'])) {
  $now = time();
  if ($now > $_SESSION['expire']) {
    session_destroy();
    exit;
    header('Location:../index.html');
  } else {
    if ($_SESSION['status'] == "Activo") {
      $nombre = $_SESSION['nombre'];
      if ($_SESSION['rol'] == 1) { //User
        //aqui estamos
      } elseif ($_SESSION['rol'] == 2) { //Admin
        header('Location:../admin/index.php');
      }
    } elseif ($_SESSION['status'] == "No Activo") {
      session_destroy();
      header('Location:../index.html');
    } elseif ($_SESSION['status'] == "En espera") {
      session_destroy();
      header('Location:../index.html');
    }
  }
} else {
  session_destroy();
  header('Location:../index.html');
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>HomeWeather</title>
  <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../assets/vendors/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="../assets/css/style-2.css">
  <link rel="shortcut icon" href="../assets/images/favicon-1.png" />
</head>

<body>
  <div class="container-scroller">
    <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="index.php"><img src="../assets/images/logo-panel-user.png" alt="logo" /></a>
        <a class="navbar-brand brand-logo-mini" href="index.php"><img src="../assets/images/logo-panel-mini.png" alt="logo" /></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="mdi mdi-menu"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <div class="nav-profile-img">
                <img src="../assets/images/avatar.png" alt="image">
              </div>
              <div class="nav-profile-text">
                <p class="mb-1 text-black"><?php echo $nombre ?></p>
              </div>
            </a>
            <div class="dropdown-menu navbar-dropdown dropdown-menu-right p-0 border-0 font-size-sm" aria-labelledby="profileDropdown" data-x-placement="bottom-end">
              <div class="p-3 text-center bg-primary">
                <img class="img-avatar img-avatar48 img-avatar-thumb" src="../assets/images/avatar.png" alt="">
              </div>
              <div class="p-2">
                <h5 class="dropdown-header text-uppercase pl-2 text-dark">Opciones de Usuario</h5>
                <a class="dropdown-item py-1 d-flex align-items-center justify-content-between" href="perfil.php">
                  <span>Editar perfil</span>
                  <i class="mdi mdi-account"></i>
                </a>
                <a class="dropdown-item py-1 d-flex align-items-center justify-content-between" href="clave.php">
                  <span>Cambiar contraseña</span>
                  <i class="mdi mdi-key"></i>
                </a>
                <a class="dropdown-item py-1 d-flex align-items-center justify-content-between" href="configuracion.php">
                  <span>Configuraciones</span>
                  <i class="mdi mdi-settings"></i>
                </a>
                <a class="dropdown-item py-1 d-flex align-items-center justify-content-between" href="../login/logout.php">
                  <span>Cerrar Sesi&oacute;n</span>
                  <i class="mdi mdi-logout ml-1"></i>
                </a>
              </div>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <div class="container-fluid page-body-wrapper">
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-category">Main</li>
          <li class="nav-item">
            <a class="nav-link" href="index.php">
              <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="api.php">
              <span class="icon-bg"><i class="mdi mdi-web menu-icon"></i></span>
              <span class="menu-title">API</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="chars.php">
              <span class="icon-bg"><i class="mdi mdi-chart-bar menu-icon"></i></span>
              <span class="menu-title">Gr&aacute;ficas</span>
            </a>
          </li>
        </ul>
      </nav>
      <div class="main-panel">
        <div class="content-wrapper">
          <!--AQUI VA EL CONTENIDO-->
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-md-4 ">
                <br>
                <div class="card">
                  <div class="card-body">
                    <form action="" method="post" id="clave" name="clave">
                      <div class="form-group">
                        <label for="formGroupExampleInput">Contraseña actual</label>
                        <input type="text" class="form-control txt-clr" id="oldpass" name="oldpass" placeholder="*********">
                        <br>
                        <label for="formGroupExampleInput">Contraseña nueva:</label>
                        <input type="text" class="form-control txt-clr" id="newpass" name="newpass" placeholder="*********">
                        <br>
                        <label for="formGroupExampleInput">Repita la contraseña nueva:</label>
                        <input type="text" class="form-control txt-clr" id="renewpass" name="renewpass" placeholder="*********"><br>
                        <button type="submit" class="btn btn-block btn-info">Modificar</button>
                        <a class="btn btn-block btn-danger">Regresar</a>
                      </div>
                    </form>
                    <br>
                    <br>
                  </div>
                </div>
              </div>
            </div>
            <br>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
  <script src="../assets/js/off-canvas.js"></script>
  <script src="../assets/js/hoverable-collapse.js"></script>
  <script src="../assets/js/misc.js"></script>

  <script src="../assets/js/perfil.js"></script>
  <script src="../assets/js/jquery-3.1.1.js"></script>
</body>

</html>
