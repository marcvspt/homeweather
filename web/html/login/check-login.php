<?php
session_start();

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

//Recopilar datos por medio de POST
$email = scape_input($_POST['email']);
$password = $_POST['password'];


$query = mysqli_prepare($mysql, "SELECT * FROM usuarios WHERE correo = ?");

if($query){
    mysqli_stmt_bind_param($query, "s", $email);
    $stmt = mysqli_stmt_execute($query);

    if($stmt){
        $result = mysqli_stmt_get_result($query);

        if(mysqli_num_rows($result) == 1){

            $row = $result->fetch_array(MYSQLI_ASSOC);
            $hash = $row['clave'];

            if (password_verify($password, $hash)) {
                $nombre = $row['nombre'] . ' ' . $row['apellido'];
                $_SESSION['loggedin'] = true;
                $_SESSION['id'] = $row['id_usuario'];
                $_SESSION['nombre'] = $nombre;
                $_SESSION['correo'] = $row['correo'];
                $_SESSION['telefono'] = $row['telefono'];
                $_SESSION['api_token'] = $row['api_token'];
                $_SESSION['rol'] = $row['id_rol'];
                $_SESSION['status'] = $row['status'];
                $_SESSION['start'] = time();
                $_SESSION['expire'] = $_SESSION['start'] + (60 * 60) ;

                echo json_encode(array('error' => false, 'status' => $row['status'], 'rol' => $row['id_rol']));

            } else {
                session_destroy();
                echo json_encode(array('error' => true));
            }
        }else{
            session_destroy();
            echo json_encode(array('error' => true));
        }
    }else{
        session_destroy();
        echo json_encode(array('error' => true));
    }
}else{
    echo json_encode(array('error' => true, 'status' => 'fallo'));
}

mysqli_close($mysql);
?>
