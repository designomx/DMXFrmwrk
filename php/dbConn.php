<?php
/*
	Conexion a la base de datos para la aplicacion de Benjamin Palacios
*/
$hostname = "localhost";
$database = "benjaminpalacios";
$username = "root";
$password = "";

$dbConn = mysql_pconnect($hostname, $username, $password) or trigger_error(mysql_error(),E_USER_ERROR);
mysql_select_db($database) ;


?>