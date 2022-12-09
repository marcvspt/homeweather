<?php
//Conexión a la base de datos
include '../config/config.php';
session_start();

$mysql = mysqli_connect($host, $user, $pass, $db);

if (!$mysql) {
    die("Conexión fallida: " . mysqli_connect_error());
}

$id = $_SESSION['id'];
$old_pass = $_POST['oldpass'];
$new_pass = $_POST['newpass'];
$re_new_pass = $_POST['renewpass'];

$query = mysqli_prepare($mysql, "SELECT * FROM usuarios WHERE id_usuario = ?");

if($query){
    mysqli_stmt_bind_param($query, "i", $id);
    $stmt = mysqli_stmt_execute($query);

    if ($stmt) {
        $result = mysqli_stmt_get_result($query);

        if ($result->num_rows == 1) {
            $row = mysqli_fetch_assoc($result);
            $clave = $row['clave'];

            if (password_verify($old_pass, $clave)) {
                if ($new_pass == $re_new_pass) {
                    $passHash = password_hash($new_pass, PASSWORD_DEFAULT);
                    $clave = "UPDATE usuarios SET clave='$passHash' WHERE id_usuario='$id'";
                    $respuesta = mysqli_query($mysql, $clave);
                    if($respuesta){
                        echo json_encode(array('error' => false));
                    }else{
                        echo json_encode(array('error' => true));
                    }
                } else {
                    echo json_encode(array('error' => true, 'tipo' => "no igual"));
                }
            } else {
                echo json_encode(array('error' => true, 'tipo' => "igual"));
            }

        }else{
            echo json_encode(array('error' => true));
        }
    } else {
        echo json_encode(array('error' => true));
    }

}else{
    echo json_encode(array('error' => true));
}

mysqli_close($mysql);
