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
          <canvas id="sensor1_myChart" style="position: relative; height: 40vh; width: 80vw;"></canvas><br><br>
          <canvas id="sensor2_myChart" style="position: relative; height: 40vh; width: 80vw;"></canvas><br><br>
          <canvas id="sensor3_myChart" style="position: relative; height: 40vh; width: 80vw;"></canvas><br><br>
          <canvas id="sensor4_myChart" style="position: relative; height: 40vh; width: 80vw;"></canvas><br><br>
          <canvas id="sensor5_myChart" style="position: relative; height: 40vh; width: 80vw;"></canvas>

          <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

          <script>
            //SENSOR 1
            var sensor1_ctx = document.getElementById('sensor1_myChart')
            var sensor1_myChart = new Chart(sensor1_ctx, {
              type: 'line',
              data: {
                datasets: [{
                  label: 'SENSOR 1',
                  backgroundColor: ['#6bf1ab', '#63d69f', '#438c6c', '#509c7f', '#1f794e', '#34444c', '#90CAF9', '#64B5F6', '#42A5F5', '#2196F3', '#0D47A1'],
                  borderColor: ['black'],
                  borderWidth: 1
                }]
              },
              options: {
                scales: {
                  y: {
                    beginAtZero: true
                  }
                }
              }
            })

            let sensor1_url = 'http://localhost/api/sensor1.php?api_token=' + '<?php echo $_SESSION['api_token'] ?>';
            fetch(sensor1_url)
              .then(sensor1_response => sensor1_response.json())
              .then(sensor1_datos => sensor1_mostrar(sensor1_datos))
              .catch(sensor1_error => console.log(sensor1_error))


            const sensor1_mostrar = (sensor1_api) => {
              sensor1_api.forEach(element => {
                sensor1_myChart.data['labels'].push(element.fecha_hora)
                sensor1_myChart.data['datasets'][0].data.push(element.sensor1)
                sensor1_myChart.update()
              });
            }
          </script>
          <script>
            //SENSOR 2
            var sensor2_ctx = document.getElementById('sensor2_myChart')
            var sensor2_myChart = new Chart(sensor2_ctx, {
              type: 'line',
              data: {
                datasets: [{
                  label: 'SENSOR 2',
                  backgroundColor: ['#6bf1ab', '#63d69f', '#438c6c', '#509c7f', '#1f794e', '#34444c', '#90CAF9', '#64B5F6', '#42A5F5', '#2196F3', '#0D47A1'],
                  borderColor: ['black'],
                  borderWidth: 1
                }]
              },
              options: {
                scales: {
                  y: {
                    beginAtZero: true
                  }
                }
              }
            })

            let sensor2_url = 'http://localhost/api/sensor2.php?api_token=' + '<?php echo $_SESSION['api_token'] ?>';
            fetch(sensor2_url)
              .then(sensor2_response => sensor2_response.json())
              .then(sensor2_datos => sensor2_mostrar(sensor2_datos))
              .catch(sensor2_error => console.log(sensor2_error))


            const sensor2_mostrar = (sensor2_api) => {
              sensor2_api.forEach(element => {
                sensor2_myChart.data['labels'].push(element.fecha_hora)
                sensor2_myChart.data['datasets'][0].data.push(element.sensor2)
                sensor2_myChart.update()
              });
            }
          </script>
          <script>
            //SENSOR 3
            var sensor3_ctx = document.getElementById('sensor3_myChart')
            var sensor3_myChart = new Chart(sensor3_ctx, {
              type: 'line',
              data: {
                datasets: [{
                  label: 'SENSOR 3',
                  backgroundColor: ['#6bf1ab', '#63d69f', '#438c6c', '#509c7f', '#1f794e', '#34444c', '#90CAF9', '#64B5F6', '#42A5F5', '#2196F3', '#0D47A1'],
                  borderColor: ['black'],
                  borderWidth: 1
                }]
              },
              options: {
                scales: {
                  y: {
                    beginAtZero: true
                  }
                }
              }
            })

            let sensor3_url = 'http://localhost/api/sensor3.php?api_token=' + '<?php echo $_SESSION['api_token'] ?>';
            fetch(sensor3_url)
              .then(sensor3_response => sensor3_response.json())
              .then(sensor3_datos => sensor3_mostrar(sensor3_datos))
              .catch(sensor3_error => console.log(sensor3_error))


            const sensor3_mostrar = (sensor3_api) => {
              sensor3_api.forEach(element => {
                sensor3_myChart.data['labels'].push(element.fecha_hora)
                sensor3_myChart.data['datasets'][0].data.push(element.sensor3)
                sensor3_myChart.update()
              });
            }
          </script>
          <script>
            //SENSOR 4
            var sensor4_ctx = document.getElementById('sensor4_myChart')
            var sensor4_myChart = new Chart(sensor4_ctx, {
              type: 'line',
              data: {
                datasets: [{
                  label: 'SENSOR 4',
                  backgroundColor: ['#6bf1ab', '#63d69f', '#438c6c', '#509c7f', '#1f794e', '#34444c', '#90CAF9', '#64B5F6', '#42A5F5', '#2196F3', '#0D47A1'],
                  borderColor: ['black'],
                  borderWidth: 1
                }]
              },
              options: {
                scales: {
                  y: {
                    beginAtZero: true
                  }
                }
              }
            })

            let sensor4_url = 'http://localhost/api/sensor4.php?api_token=' + '<?php echo $_SESSION['api_token'] ?>';
            fetch(sensor4_url)
              .then(sensor4_response => sensor4_response.json())
              .then(sensor4_datos => sensor4_mostrar(sensor4_datos))
              .catch(sensor4_error => console.log(sensor4_error))


            const sensor4_mostrar = (sensor4_api) => {
              sensor4_api.forEach(element => {
                sensor4_myChart.data['labels'].push(element.fecha_hora)
                sensor4_myChart.data['datasets'][0].data.push(element.sensor4)
                sensor4_myChart.update()
              });
            }
          </script>
          <script>
            //SENSOR 5
            var sensor5_ctx = document.getElementById('sensor5_myChart')
            var sensor5_myChart = new Chart(sensor5_ctx, {
              type: 'line',
              data: {
                datasets: [{
                  label: 'SENSOR 5',
                  backgroundColor: ['#6bf1ab', '#63d69f', '#438c6c', '#509c7f', '#1f794e', '#34444c', '#90CAF9', '#64B5F6', '#42A5F5', '#2196F3', '#0D47A1'],
                  borderColor: ['black'],
                  borderWidth: 1
                }]
              },
              options: {
                scales: {
                  y: {
                    beginAtZero: true
                  }
                }
              }
            })

            let sensor5_url = 'http://localhost/api/sensor5.php?api_token=' + '<?php echo $_SESSION['api_token'] ?>';
            fetch(sensor5_url)
              .then(sensor5_response => sensor5_response.json())
              .then(sensor5_datos => sensor5_mostrar(sensor5_datos))
              .catch(sensor5_error => console.log(sensor5_error))


            const sensor5_mostrar = (sensor5_api) => {
              sensor5_api.forEach(element => {
                sensor5_myChart.data['labels'].push(element.fecha_hora)
                sensor5_myChart.data['datasets'][0].data.push(element.sensor5)
                sensor5_myChart.update()
              });
            }
          </script>
          <!--AQUI VA EL CONTENIDO-->
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
</body>

</html>
