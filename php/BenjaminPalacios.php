<?php
/*
Archivos PHP para el registro de usuario de la aplicacion de BenjaminPalacios
*/

require "dbConn.php"; 

//Variables del formulario de Registro
$password=$_POST['password'];
$email=$_POST['email'];

//Si no tiene nombre es por que es un login
if(!isset($nombre=$_POST['nombre'])){
	//probar query para login 

	session_start();
	$password = md5($password);
	$queryLogin = "SELECT nombre, email FROM usuarios WHERE email='".$email."' AND password='".$password."'";
	$respuesta = mysql_query($qry);
	$num_row = mysql_num_rows($res);
	$row=mysql_fetch_assoc($res);
	if( $num_row == 1 ) {
		echo 'true';
		$_SESSION['user'] = $row['nombre'];
		//$_SESSION['email'] = $row['email'];
	}
	else {
	echo 'false';
	}

//Si no tiene nombre ni usuario_admin, es un registro desde usuario
}elseif(!isset($nombre=$_POST['usuario_admin'])){
	//Probar query para Registro
	$queryRegistro="INSERT INTO usuarios (nombre,password,email,usuario_admin)VALUES('".$nombre."',MD5('".$password."'),'".$email."','0')";
	//$queryRegistro="INSERT INTO usuarios (nombre,password,email,usuario_admin)VALUES('"prueba2"',MD5('"123"'),'"prueba2@prueba.com"','0')";
	$result = mysql_query($queryRegistro, $dbConn) or die(mysql_error());

//Si tiene los dos, es por que esta entrando desde el administrador	para realizar cualquiera de las acciones
}else{

	//Hacer querys para agregar, modificar o eliminar usuario desde el manejador con una variable que se llame $_POST('accion')
}

?>