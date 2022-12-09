<?php
//Conexión a la base de datos
include '../config/config.php';
$mysql = mysqli_connect($host, $user, $pass, $db);

if (!$mysql) {
    die("Conexión fallida: " . mysqli_connect_error());
}

$salida = "";
$id = $_GET['id'];

if (isset($id) && !empty($id)) {
    $query = "SELECT usuarios.nombre, usuarios.apellido, usuarios.correo, usuarios.telefono, usuarios.id_rol, roles.rol, status, foto FROM usuarios INNER JOIN roles ON usuarios.id_rol = roles.id_rol WHERE id_usuario=".$id."";

    $result = mysqli_query($mysql, $query);

    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);

        $nombre = $row['nombre'];
        $apellido = $row['apellido'];
        $email = $row['correo'];
        $telefono = $row['telefono'];
        $id_rol = $row['id_rol'];
        $rol = $row['rol'];
        $status = $row['status'];
        $foto = $row['foto'];


        $salida.=
        "<div class='form-row'>
        <div class='form-group col-md-6'>
          <label>Nombre (s)</label>
          <input type='text' name='nombre' class=form-control id='nombre' placeholder='Lourdes Paulina' value='".$nombre."' required>
        </div>
        <div class='form-group col-md-6'>
          <label>Apellido (s)</label>
          <input type='text' name='apellido' class='form-control' id='apellido' placeholder='Pech' value='".$apellido."' required>
        </div>
      </div>
      <div class=form-row>
        <div class='form-group col-md-8'>
          <label>Correo Electrónico</label>
          <input type='text' name='correo' class='form-control' id='correo' placeholder='ejemplo@correo.com' value='".$email."' required>
        </div>
        <div class='form-group col-md-4'>
          <label>Telefono/Celular</label>
          <input type='text' name='telefono' class='form-control' id='telefono' placeholder='9991234567' value='".$telefono."' required>
        </div>
      </div>
      <div class='form-row'>
        <div class='form-group col-md-4'>
          <label>Rol</label>
          <select name='rol' id='rol' class='form-control' required style='color: white'>
          ";
          $rol_query = "SELECT * FROM roles ORDER BY id_rol";
          $resultado=$mysql->query($rol_query);
          while($row_rol = $resultado->fetch_assoc()) {
            $salida.="<option ";
            if($row_rol['id_rol'] == $id_rol){
              $salida.="selected ";
            }
            $salida.="value='".$row_rol['id_rol']."'>".$row_rol['rol']."</option>";
          }
          $salida.="
          </select>
        </div>
        <div class='form-group col-md-4'>
          <label>Estatus</label>
          <select name='status' id='status' class='form-control' style='color: white' required>";
            switch ($status){
                case 'Activo':
                  $salida.="<option selected>Activo</option>
                  <option>No Activo</option>
                  <option>En espera</option>";
                  break;
                case 'No Activo':
                  $salida.="<option>Activo</option>
                  <option selected>No Activo</option>
                  <option>En espera</option>";
                  break;
                case 'En espera':
                  $salida.="<option>Activo</option>
                  <option>No Activo</option>
                  <option selected>En espera</option>";
                  break;
            }
          $salida.="</select>
        </div>
        <div class='form-group col-md-4'>
          <label>Foto (opcional)</label>
          <input type='file' name='foto' class='form-control' id='foto' value='".$foto."' disabled style='background-color: black;'>
        </div>
      </div>";
    } else {

    }
} else {
    $salida .= "NO HAY DATOS :(";
}

echo $salida;

mysqli_close($mysql);