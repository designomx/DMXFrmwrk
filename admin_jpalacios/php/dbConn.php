<?php
/*
	Conexion a la base de datos para la aplicacion de Benjamin Palacios
*/
$hostname = "localhost";
$database = "benjaminpalacios";
$username = "root";
$password = "";

$dbConn = mysqli_connect($hostname, $username, $password, $database);

/* comprobar la conexión */
if (mysqli_connect_errno()) {
    printf("Falló la conexión: %s\n", mysqli_connect_error());
    exit();
}

?>