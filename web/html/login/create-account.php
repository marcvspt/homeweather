<?php

//Conexión a la base de datos
include '../config/config.php';
$mysql = mysqli_connect($host, $user, $pass, $db);

if (!$mysql) {
    die("Conexión fallida: " . mysqli_connect_error());
}

//Creador de tokens
function generar_token_seguro($longitud){
    if ($longitud < 4) {
        $longitud = 4;
    }
    return bin2hex(random_bytes(($longitud - ($longitud % 2)) / 2));
}

function scape_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
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
    $repass = scape_input($_POST['repassword']);
    $passHash = password_hash($pass, PASSWORD_DEFAULT);
    $telefono = scape_input($_POST['telefono']);
    $token = generar_token_seguro(64);
    $rol = 1;
    $status = "Activo"; //En espera

    $query = "INSERT INTO usuarios (nombre, apellido, correo, clave, telefono, api_token, id_rol, status) VALUES ('$name', '$lastname', '$email', '$passHash', '$telefono', '$token', '$rol', '$status')";

    if ($pass == $repass && mysqli_query($mysql, $query)) {
        $select = mysqli_prepare($mysql, "SELECT * FROM usuarios WHERE correo = ?");

        if($select){
            mysqli_stmt_bind_param($select, "s", $correo);
            $result = mysqli_stmt_execute($select);

            if ($result) {
                echo json_encode(array('error' => false, 'status' => $status));
            } else {
                echo json_encode(array('error' => true, 'status' => 'fallo'));
            }
        }else{
            echo json_encode(array('error' => true, 'status' => 'fallo'));
        }
    } else {
        echo json_encode(array('error' => true, 'tipo' => 'no igual'));
    }
}

mysqli_close($mysql);
?>
