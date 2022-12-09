<?php
//Conexión a la base de datos
include '../config/config.php';
$mysql = mysqli_connect($host, $user, $pass, $db);

if (!$mysql) {
    die("Conexión fallida: " . mysqli_connect_error());
}

$id = $_POST['id'];

if (isset($id) && !empty($id)) {
    $query = "DELETE FROM usuarios WHERE id_usuario=".$id."";

    $result = mysqli_query($mysql, $query);

    if ($result) {
        echo json_encode(array('error' => false));
    } else {
        echo json_encode(array('error' => true));
    }
} else {
    echo json_encode(array('error' => true));
}

mysqli_close($mysql);