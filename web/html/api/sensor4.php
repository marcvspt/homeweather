<?php

include '../config/config.php';
$mysql = mysqli_connect($host, $user, $pass, $db);
if (!$mysql) {
    die("Conexión fallida: " . mysqli_connect_error());
}

header('Content-Type: application/json; charset=utf-8');

$token = $_GET['api_token'];

if (!empty($token)) {
    $query = mysqli_prepare($mysql, "SELECT id_sensor, sensor4, fecha_hora FROM sensores WHERE api_token = ?");

    if($query){
        mysqli_stmt_bind_param($query, "s", $token);
        $result = mysqli_stmt_execute($query);

        if ($result) {
            $fetch = mysqli_stmt_get_result($query);
            $data = array(); //creamos un array

            while ($row = $fetch->fetch_assoc()) {
                $id = (int) $row['id_sensor'];
                $sensor4 = (int) $row['sensor4'];
                $datetime = $row['fecha_hora'];


                $data[] = array(
                    'id' => $id, 'sensor4' => $sensor4, 'fecha_hora' => $datetime
                );
            }

            if($data){
                $json_string = json_encode($data);
                echo $json_string;
            }else{
                $json_string = json_encode("Ha ocurrido un error");
                echo $json_string;
            }
        } else {
            $json_string = json_encode("Ha ocurrido un error");
            echo $json_string;
        }
    } else {
        $json_string = json_encode("Ha ocurrido un error");
        echo $json_string;
    }
} else {
    $json_string = json_encode("Ha ocurrido un error");
    echo $json_string;
}

