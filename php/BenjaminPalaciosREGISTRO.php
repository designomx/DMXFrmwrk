<?php
/*
Archivos PHP para el registro de usuario de la aplicacion de BenjaminPalacios
*/

require "dbConn.php"; 

//Variables del formulario de Registro
$nombre=$_POST['nombre'];
$password=$_POST['password'];
$email=$_POST['email'];

$queryRegistro="INSERT INTO usuarios (nombre,password,email,usuario_admin)VALUES('".$nombre."',MD5('".$password."'),'".$email."','0')";
//$queryRegistro="INSERT INTO usuarios (nombre,password,email,usuario_admin)VALUES('"prueba2"',MD5('"123"'),'"prueba2@prueba.com"','0')";
//$queryRegistro="INSERT INTO 'usuarios'('nombre', 'email', 'password', 'usuario_admin') VALUES ('emilio','emilio@emilio.com','123','0')";

$result = mysql_query($queryRegistro) or die(mysql_error());

//return $result;
?>