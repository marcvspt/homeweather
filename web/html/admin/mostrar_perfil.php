<?php
session_start();

//Conexión a la base de datos
include '../config/config.php';
$mysql = mysqli_connect($host, $user, $pass, $db);

if (!$mysql) {
  die("Conexión fallida: " . mysqli_connect_error());
}

$salida = "";
$id = $_SESSION['id'];

if (isset($id) && !empty($id)) {
  $query = "SELECT nombre, apellido, correo, telefono, foto FROM usuarios WHERE id_usuario=" . $id . "";

  $result = mysqli_query($mysql, $query);

  if ($result->num_rows > 0) {
    $row = mysqli_fetch_assoc($result);

    $nombre = $row['nombre'];
    $apellido = $row['apellido'];
    $email = $row['correo'];
    $telefono = $row['telefono'];
    $foto = $row['foto'];

    $salida .=
      "<div class='form-row'>
      <div class='form-group col-md-6'>
        <label>Nombre (s)</label>
        <input type='text' name='nombre' class=form-control id='nombre' placeholder='Lourdes Paulina' value='" . $nombre . "' required>
      </div>
      <div class='form-group col-md-6'>
        <label>Apellido (s)</label>
        <input type='text' name='apellido' class='form-control' id='apellido' placeholder='Pech' value='" . $apellido . "' required>
      </div>
    </div>
    <div class=form-row>
      <div class='form-group col-md-8'>
        <label>Correo Electrónico</label>
        <input type='text' name='correo' class='form-control' id='correo' placeholder='ejemplo@correo.com' value='" . $email . "' required>
      </div>
      <div class='form-group col-md-4'>
        <label>Telefono/Celular</label>
        <input type='text' name='telefono' class='form-control' id='telefono' placeholder='9991234567' value='" . $telefono . "' required>
      </div>
    </div>";
  } else {
  }
} else {
  $salida .= "NO HAY DATOS :(";
}

echo $salida;

mysqli_close($mysql);
