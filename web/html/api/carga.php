<?php

include '../config/config.php';
$mysql = mysqli_connect($host, $user, $pass, $db);
if (!$mysql) {
    die("Conexión fallida: " . mysqli_connect_error());
}

header('Content-Type: application/json; charset=utf-8');

$sensor1 = $_GET['sensor1'];
$sensor2 = $_GET['sensor2'];
$sensor3 = $_GET['sensor3'];
$sensor4 = $_GET['sensor4'];
$sensor5 = $_GET['sensor5'];
$token = $_GET['api_token'];

date_default_timezone_set('America/Mexico_City');
$datetime=date('y-m-d H:i:s');

$query = "INSERT INTO sensores (sensor1, sensor2, sensor3, sensor4, sensor5, api_token, fecha_hora) VALUES ('$sensor1', '$sensor2', '$sensor3', '$sensor4', '$sensor5', '$token', '$datetime')";

$result = mysqli_query( $mysql, $query);

if($result){
    $json = json_encode("Datos cargados");
    echo $json;
}else{
    $json = json_encode("Datos No Cargados");
    echo $json;
}

?>