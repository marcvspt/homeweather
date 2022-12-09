<?php
$salida = "";

//Conexión a la base de datos
include '../config/config.php';
$mysql = mysqli_connect($host, $user, $pass, $db);

if (!$mysql) {
	die("Conexión fallida: " . mysqli_connect_error());
}

$query = "SELECT usuarios.id_usuario, concat(usuarios.nombre, ' ', usuarios.apellido) as nom_com, usuarios.correo, usuarios.telefono, roles.rol, status FROM usuarios INNER JOIN roles ON usuarios.id_rol = roles.id_rol ORDER BY id_usuario ASC";

if (isset($_POST['consulta'])) {
    $q = $mysql->real_escape_string($_POST['consulta']);
    $query = "SELECT usuarios.id_usuario, concat(usuarios.nombre, ' ', usuarios.apellido) as nom_com, usuarios.correo, usuarios.telefono, roles.rol, status FROM usuarios INNER JOIN roles ON usuarios.id_rol = roles.id_rol WHERE id_usuario LIKE '%$q%' OR nombre LIKE '%$q%' OR apellido LIKE '%$q%' OR correo LIKE '%$q%' OR telefono LIKE '%$q%' OR status LIKE '%$q%' ORDER BY id_usuario ASC";
}

$resultado = $mysql->query($query);

if ($resultado->num_rows > 0) {
    $salida .= "<table class='table table-bordered table-striped'>
						<thead>
							<tr>
								<th>#</th>
								<th>Correo</th>
								<th>Rol</th>
								<th>Nombre Completo</th>
                                <th>telefono</th>
                                <th>Estatus</th>
								<th>Más</th>
							</tr>
						</thead>
					<tbody>";

    while ($row = $resultado->fetch_assoc()) {
        $salida .=    "<tr>
							<td>" . $row['id_usuario'] . "</td>
							<td>" . $row['correo'] . "</td>
							<td>" . $row['rol'] . "</td>
							<td>" . $row['nom_com'] . "</td>
                            <td>" . $row['telefono'] . "</td>
                            <td>" . $row['status'] . "</td>
							<td width=8%>
								<a href='editar_usuario.php?id=". $row['id_usuario'] ."' title='Más acciones' data-toggle='tooltip'><i class='gg-pen'></i></a>
							</td>
						</tr>";
    }
    $salida .= "</tbody></table>";
} else {
    $salida .= "NO HAY DATOS :(";
}


echo $salida;

$mysql->close();

?>
