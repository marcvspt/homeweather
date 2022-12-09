<?php
//Conexión a la base de datos
include '../config/config.php';
$mysql = mysqli_connect($host, $user, $pass, $db);

if (!$mysql) {
    die("Conexión fallida: " . mysqli_connect_error());
}

function scape_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$id = $_POST['id'];
$path = '../assets/images/';
$file = $path . basename(($_FILES['foto']['name']));

$nombre = scape_input($_POST['nombre']);
$apellido = scape_input($_POST['apellido']);
$email = scape_input($_POST['correo']);
$telefono = scape_input($_POST['telefono']);
$rol = scape_input($_POST['rol']);
$status = scape_input($_POST['status']);

if (isset($_FILES['foto']['name'])) {
    if (basename($_FILES['foto']['name']) != "") {
        $foto = "images/" . basename($_FILES['foto']['name']);
    } else {
        $foto = "";
    }
} else {
    $foto = "";
}

if ($foto != "") {
    unlink($fotoElimiar);
    $file = $path . basename($_FILES['foto']['name']);
    move_uploaded_file($_FILES['foto']['tmp_name'], $file);
    $query = "UPDATE usuarios SET nombre='$nombre', apellido='$apellido', correo='$autor',correo='$email', telefono='$telefono', id_rol='$rol', status='$status', foto='$foto' WHERE id_usuario='$id'";
} else {
    $query = "UPDATE usuarios SET nombre='$nombre', apellido='$apellido', correo='$autor',correo='$email', telefono='$telefono', id_rol='$rol', status='$status' WHERE id_usuario='$id'";
}


if (isset($id) && !empty($id)) {
    $result = mysqli_query($mysql, $query);
    if($result){
        echo json_encode(array('error' => false));
    }else{
        echo json_encode(array('error' => true));
    }
} else {
    echo json_encode(array('error' => true));
}

mysqli_close($mysql);
