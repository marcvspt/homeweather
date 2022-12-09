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

//Creador de tokens
function generar_token_seguro($longitud) {
    if ($longitud < 4) {
        $longitud = 4;
    }
    return bin2hex(random_bytes(($longitud - ($longitud % 2)) / 2));
}

//Comprobación si ya existe el email
$checkEmail = "SELECT * FROM usuarios WHERE correo = '$_POST[email]' ";

$result = $mysql->query($checkEmail);
$count = mysqli_num_rows($result);

if ($count == 1) {
    echo json_encode(array('error' => true, 'tipo' => 'existe'));
} else {
    $name = scape_input($_POST['name']);
    $lastname = scape_input($_POST['lastname']);
    $email = scape_input($_POST['email']);
    $pass = $_POST['password'];
    $passHash = password_hash($pass, PASSWORD_DEFAULT);
    $telefono = scape_input($_POST['telefono']);
    $token = generar_token_seguro(64);
    $rol = $_POST['rol'];
    $status = scape_input($_POST['status']);

    $passHash = password_hash($pass, PASSWORD_DEFAULT);

    $query = "INSERT INTO usuarios (nombre, apellido, correo, clave, telefono, api_token, id_rol, status) VALUES ('$name', '$lastname', '$email', '$passHash', '$telefono', '$token', '$rol', '$status')";

    $result = mysqli_query($mysql, $query);

    if ($result) {
        echo json_encode(array('error' => false, 'status' => $status));
    } else {
        echo json_encode(array('error' => true));
    }
}

mysqli_close($mysql);
