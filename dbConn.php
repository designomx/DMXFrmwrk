<?php
// Datos para la conexion
$host = 'localhost';
//$host = 'localhost:8889';
$database = 'db600436593UTF8';
$username= 'dbo600436593';
//$username = 'root';
$password = '20eligefacil15#';
//$password = 'root';

// Conectarse a MySQL
$mysqli = new mysqli($host, $username, $password, $database);

//Indicamos codificación UTF8
$mysqli->set_charset("utf8");	

/* verificar la conexión */
if (mysqli_connect_errno()) {
    printf("Falló la conexión failed: %s\n", $mysqli->connect_error);
    exit();
}else{
	//echo "conectado";
}
?>