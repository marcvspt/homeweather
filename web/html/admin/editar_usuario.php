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
        header('Location:../user/index.php');
      } elseif ($_SESSION['rol'] == 2) { //Admin
        //aqui estamos
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
  <title>HomeWeather | Admin</title>
  <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="../assets/css/style-1.css">
  <link rel="shortcut icon" href="../assets/images/favicon-1.png" />
</head>

<body>
  <div class="container-scroller">
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
        <a class="sidebar-brand brand-logo" href="index.php"><img src="../assets/images/logo-panel-admin.png" alt="logo" /></a>
        <a class="sidebar-brand brand-logo-mini" href="index.php"><img src="../assets/images/logo-panel-mini.png" alt="logo" /></a>
      </div>
      <ul class="nav">
        <li class="nav-item nav-category">
          <span class="nav-link">Men&uacute;</span>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" href="index.php">
            <span class="menu-icon">
              <i class="mdi mdi-speedometer"></i>
            </span>
            <span class="menu-title">Dashboard</span>
          </a>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" href="users.php">
            <span class="menu-icon">
              <i class="mdi mdi-account"></i>
            </span>
            <span class="menu-title">Usuarios</span>
          </a>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" href="chars.php">
            <span class="menu-icon">
              <i class="mdi mdi-chart-bar"></i>
            </span>
            <span class="menu-title">Gr&aacute;ficas</span>
          </a>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" href="api.php">
            <span class="menu-icon">
              <i class="mdi mdi-web"></i>
            </span>
            <span class="menu-title">API</span>
          </a>
        </li>
    </nav>
    <div class="container-fluid page-body-wrapper">
      <nav class="navbar p-0 fixed-top d-flex flex-row">
        <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
          <a class="navbar-brand brand-logo-mini" href="index.php"><img src="../assets/images/logo-mini.svg" alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item dropdown">
              <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
                <div class="navbar-profile">
                  <img class="img-xs rounded-circle" src="../assets/images/avatar.png" alt="">
                  <p class="mb-0 d-none d-sm-block navbar-profile-name"><?php echo $nombre ?></p>
                  <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
                <h6 class="p-3 mb-0">Perfil</h6>
                <div class="dropdown-divider"></div>
                <a href="perfil.php" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-account text-success"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject mb-1">Editar perfil</p>
                  </div>
                </a>
                <a href="clave.php" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-key text-success"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject mb-1">Cambiar contraseña</p>
                  </div>
                </a>
                <a href="configuracion.php" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-settings text-success"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject mb-1">Configuraciones</p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a href="../login/logout.php" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-logout text-danger"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject mb-1">Cerrar Sesi&oacute;n</p>
                  </div>
                </a>
              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-format-line-spacing"></span>
          </button>
        </div>
      </nav>
      <div class="main-panel">
        <div class="content-wrapper">
          <!--AQUI VA EL CONTENIDO-->
          <div class='row'>
            <div class='col-lg-12'>
              <form id="usuarios" name="usuarios" action="" method="post" enctype="multipart/form-data">
                <div class="form-group col-md-12">
                  <h2 class="pull-left"><b>Acciones</b></h2>
                </div>
                <div id="datos">
                  <br>
                </div>
                <center>
                  <div class="form-row">
                    <input type="hidden" name="id" id="id" value="<?php echo $_GET['id'] ?>" />
                    <div class="form-group col-md-4">
                      <button name="actualizar" id="actualizar" type="submit" class="btn btn-info btn-block" onclick="enviar('actualizar')">Actualizar</button>
                    </div>
                    <div class="form-group col-md-4">
                      <button name="eliminar" id="eliminar" type="submit" class="btn btn-danger btn-block" onclick="enviar('eliminar')">Eliminar</button>
                    </div>
                    <div class="form-group col-md-4">
                      <button name="regresar" id="regresar" type="button" class="btn btn-warning btn-block" onclick="location.href = 'users.php';">Regresar</button>
                    </div>
                  </div>
                </center>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
  <script src="../assets/js/off-canvas.js"></script>
  <script src="../assets/js/hoverable-collapse.js"></script>
  <script src="../assets/js/misc.js"></script>
  <script src="../assets/js/settings.js"></script>
  <script src="../assets/js/todolist.js"></script>

  <script src="../assets/js/usuario.js"></script>
  <script src="../assets/js/jquery-3.1.1.js"></script>

  <script>
    $(buscar_datos());

    function buscar_datos(consulta) {
      $.ajax({
          url: 'mostrar.php?id=' + <?php echo $_GET['id'] ?>,
          type: 'GET',
          dataType: 'html',
          data: {
            consulta: consulta
          },
        })
        .done(function(respuesta) {
          $("#datos").html(respuesta);
        })
        .fail(function() {
          console.log("error");
        });
    }
  </script>
</body>

</html>
