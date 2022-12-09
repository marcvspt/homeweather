<?php
//Conexión a la base de datos
include '../config/config.php';
session_start();

$mysql = mysqli_connect($host, $user, $pass, $db);

if (!$mysql) {
    die("Conexión fallida: " . mysqli_connect_error());
}

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['correo'];
$telefono = $_POST['telefono'];

$query = "UPDATE usuarios SET nombre='$nombre', apellido='$apellido', correo='$email', telefono='$telefono' WHERE id_usuario='$id'";
$result = mysqli_query($mysql, $query);

if ($result) {
    $login = mysqli_prepare($mysql, "SELECT * FROM usuarios WHERE id_usuario = ?");

    if($login){
        mysqli_stmt_bind_param($login, "i", $id);
        $stmt = mysqli_stmt_execute($login);

        if($stmt){
            $result = mysqli_stmt_get_result($login);

            if ($result->num_rows == 1) {
                $row = $result->fetch_array(MYSQLI_ASSOC);

                $nombre = $row['nombre'] . ' ' . $row['apellido'];
                $_SESSION['id'] = $row['id_usuario'];
                $_SESSION['nombre'] = $nombre;
                $_SESSION['correo'] = $row['correo'];
                $_SESSION['telefono'] = $row['telefono'];
                $_SESSION['api_token'] = $row['api_token'];
                $_SESSION['rol'] = $row['id_rol'];
                $_SESSION['status'] = $row['status'];

                echo json_encode(array('error' => false));
            }else{
                echo json_encode(array('error' => true));
            }
        }else{
            echo json_encode(array('error' => false));
        }
    }else{
        echo json_encode(array('error' => true));
    }
} else {
    echo json_encode(array('error' => true));
}

mysqli_close($mysql);
