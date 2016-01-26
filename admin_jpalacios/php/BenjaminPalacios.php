<?php
/*
Archivos PHP para el registro de usuario de la aplicacion de BenjaminPalacios
*/

require "dbConn.php"; 

//Variables del formulario de Registro
$password=$_POST['password'];
$email=$_POST['email'];

//Si no tiene nombre es por que es un login
if(!isset($_POST['nombre'])){
	//probar query para login 

	session_start();
	$password = md5($password);
	$queryLogin = "SELECT nombre, email, usuario_admin FROM usuarios WHERE email='".$email."' AND password='".$password."'";
	//$respuesta = mysql_query($queryLogin);
	$respuesta = mysqli_query($dbConn, $queryLogin);
	$num_row = mysqli_num_rows($respuesta);
	$row=mysqli_fetch_assoc($respuesta);
	if( $num_row == 1 ) {
		$_SESSION['user'] = $row['nombre'];
		if($row['usuario_admin']==1){
			echo "admin";
		}else{
			echo 'usuario';
		}
		//$_SESSION['email'] = $row['email'];
	}
	else {
	echo 'false';
	}

//Si no tiene nombre ni usuario_admin, es un registro desde usuario
}elseif(!isset($_POST['usuario_admin'])){
	//Probar query para Registro
	$nombre=$_POST['nombre'];
	$edad=$_POST['edad'];
	$sexo=$_POST['sexo'];
	$queryRegistro="INSERT INTO usuarios (nombre,password,email,usuario_admin,edad,sexo)VALUES('".$nombre."',MD5('".$password."'),'".$email."','0','".$edad."','".$sexo."')";
	//$queryRegistro="INSERT INTO usuarios (nombre,password,email,usuario_admin)VALUES('"prueba2"',MD5('"123"'),'"prueba2@prueba.com"','0')";
	$result = mysqli_query($dbConn, $queryRegistro);
	echo "Resgistro exitoso!";
	//return $respuesta;

//Si tiene los dos, es por que esta entrando desde el administrador	para realizar cualquiera de las acciones
}else{
	//Hacer querys para agregar, modificar o eliminar usuario desde el manejador con una variable que se llame $_POST('accion')
	$nombre=$_POST['nombre'];
	$edad=$_POST['edad'];
	$sexo=$_POST['sexo'];
	$usuario_admin=$_POST['usuario_admin'];
	$queryRegistroADMIN="INSERT INTO usuarios (nombre,password,email,usuario_admin,edad,sexo)VALUES('".$nombre."',MD5('".$password."'),'".$email."','".$usuario_admin."','".$edad."','".$sexo."')";
	//$queryRegistro="INSERT INTO usuarios (nombre,password,email,usuario_admin)VALUES('"prueba2"',MD5('"123"'),'"prueba2@prueba.com"','0')";
	$result = mysqli_query($dbConn, $queryRegistroADMIN);
	echo "Resgistro exitoso!";
	//return $respuesta;
}

?>