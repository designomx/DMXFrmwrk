<?php
/*
	Conexion a la base de datos para la aplicacion de Benjamin Palacios

$hostname = "localhost:8889";
$database = "benjamin_palacios";
$username = "root";
$password = "root";

$dbConn = mysql_pconnect($hostname, $username, $password) or trigger_error(mysql_error(),E_USER_ERROR);
*/
$user = 'root';
$password = 'root';
$db = 'inventory';
$socket = 'localhost:/Applications/MAMP/tmp/mysql/mysql.sock';

$link = mysql_connect(
   $socket, 
   $user, 
   $password
);
$db_selected = mysql_select_db(
   $db, 
   $link
);
?>