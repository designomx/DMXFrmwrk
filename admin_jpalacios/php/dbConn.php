<?php
/*
	Conexion a la base de datos para la aplicacion de Benjamin Palacios
*/
$hostname = "localhost";
$database = "designom_benjaminpalacios";
$username = "designom_BPapp";
$password = "B3nj4m1n";

$dbConn = mysqli_connect($hostname, $username, $password, $database);

/* comprobar la conexión */
if (mysqli_connect_errno()) {
    printf("Falló la conexión: %s\n", mysqli_connect_error());
    exit();
}

?>