<?php
$salida = "";

session_start();
//Conexión a la base de datos
include '../config/config.php';
$mysql = mysqli_connect($host, $user, $pass, $db);

if (!$mysql) {
    die("Conexión fallida: " . mysqli_connect_error());
}

$token = $_SESSION['api_token'];
$query = "SELECT id_sensor, sensor1, sensor2, sensor3, sensor4, sensor5, fecha_hora FROM sensores WHERE api_token='$token'";

if (isset($_POST['consulta'])) {
    $q = $mysql->real_escape_string($_POST['consulta']);
    $query = "SELECT id_sensor, sensor1, sensor2, sensor3, sensor4, sensor5, fecha_hora FROM sensores WHERE api_token='$token' AND fecha_hora LIKE '%$q%' ORDER BY fecha_hora ASC";
}

$resultado = $mysql->query($query);

if ($resultado->num_rows > 0) {
    $salida .= "<table class='table table-bordered table-striped'>
						<thead>
							<tr>
								<th>#</th>
								<th>Sensor 1</th>
								<th>Sensor 2</th>
								<th>Sensor 3</th>
                                <th>Sensor 4</th>
                                <th>Sensor 5</th>
								<th>Fecha y hora</th>
							</tr>
						</thead>
					<tbody>";

    while ($row = $resultado->fetch_assoc()) {
        $salida .=    "<tr>
                            <td>" . $row['id_sensor'] . "</td>
							<td>" . $row['sensor1'] . "</td>
							<td>" . $row['sensor2'] . "</td>
							<td>" . $row['sensor3'] . "</td>
							<td>" . $row['sensor4'] . "</td>
                            <td>" . $row['sensor5'] . "</td>
                            <td>" . $row['fecha_hora'] . "</td>
						</tr>";
    }
    $salida .= "</tbody></table>";
} else {
    $salida .= "NO HAY DATOS :(";
}

echo $salida;
mysqli_close($mysql);
