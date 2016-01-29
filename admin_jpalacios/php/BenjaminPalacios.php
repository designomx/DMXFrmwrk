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
	//Iniciamos sesión y comienza el control de sesiones con $_SESSION->autenntica para saber si de verdad pasó la conexión, ->user para saber que usuario es y ->tipo_usuario para saber si es administrador o no.
	$password = md5($password);
	$queryLogin = "SELECT nombre, email, usuario_admin FROM usuarios WHERE email='".$email."' AND password='".$password."'";
	//$respuesta = mysql_query($queryLogin);
	$respuesta = mysqli_query($dbConn, $queryLogin);
	$num_row = mysqli_num_rows($respuesta);
	$row=mysqli_fetch_assoc($respuesta);
	if( $num_row > 0 ) {
		session_start();
		$_SESSION['user'] = $row['nombre'];
		if($row['usuario_admin']==1){
			$_SESSION['tipo_usuario']="1";
			echo "admin";
		}else{
			$_SESSION['tipo_usuario']="0";
			echo 'usuario';
		}
		//Probablemente necesitemos el email que es la primary_key de la tabla usuarios para usos futuros;
		//$_SESSION['email'] = $row['email'];
	}
	else {
	echo 'false';
	}
	mysqli_close($dbConn);
//Si no tiene nombre ni usuario_admin, es un registro desde usuario
}elseif(!isset($_POST['usuario_admin'])){
	$nombre=$_POST['nombre'];
	$edad=$_POST['edad'];
	$sexo=$_POST['sexo'];
	//$queryRegistro="INSERT INTO usuarios (nombre,password,email,usuario_admin,edad,sexo,autorizado) VALUES ('".$nombre."',MD5('".$password."'),'".$email."','0','".$edad."','".$sexo."','0')";
	$queryRegistro="INSERT INTO usuarios (nombre,password,email,usuario_admin,edad,sexo,autorizado)VALUES('".$nombre."',MD5('".$password."'),'".$email."','0','".$edad."','".$sexo."','0')";

	if (mysqli_query($dbConn, $queryRegistro)=== TRUE) {
    	echo "exitoso";
	}else{
		$result = mysqli_query($dbConn, "SELECT email FROM usuarios WHERE email='".$email."'");
		if(mysqli_num_rows($result) == 0) {
		     // row not found
			echo "Error creando el registro!";	
		} else {
		    // do other stuff...
		    echo "Email ya registrado";
		}
	}
	mysqli_close($dbConn);
	//return $respuesta;

//Si tiene los dos, es por que esta entrando desde el administrador	para realizar cualquiera de las acciones
}else{
	//Hacer querys para agregar, modificar o eliminar usuario desde el manejador con una variable que se llame $_POST('accion')
	$nombre=$_POST['nombre'];
	$edad=$_POST['edad'];
	$sexo=$_POST['sexo'];
	$usuario_admin=$_POST['usuario_admin'];
	$autorizado=$_POST['autorizado'];
	//Si no está editar_usuario, es un Insert, viene de FormularioREgistroADMIN
	if(!isset($_POST['editar_usuario'])){
		$queryRegistroADMIN="INSERT INTO usuarios (nombre,password,email,usuario_admin,edad,sexo,autorizado)VALUES('".$nombre."',MD5('".$password."'),'".$email."','".$usuario_admin."','".$edad."','".$sexo."','".$autorizado."')";
	}else{
		$update_pass = mysqli_query($dbConn, "SELECT email FROM usuarios WHERE email='".$email."' AND password='".$password."'");
		//Revisar si ha modificado el password en el formulario de EditarRegistro, y actualizo o no el password
		if(mysqli_num_rows($update_pass) == 1) {
		    //No cambia el password
			$queryRegistroADMIN="UPDATE usuarios SET nombre='".$nombre."',password='".$password."',usuario_admin='".$usuario_admin."',edad='".$edad."',sexo='".$sexo."' WHERE email='".$email."'";
		}else{
			$queryRegistroADMIN="UPDATE usuarios SET nombre='".$nombre."',password=MD5('".$password."'),usuario_admin='".$usuario_admin."',edad='".$edad."',sexo='".$sexo."' WHERE email='".$email."'";
		}
	}
	if (mysqli_query($dbConn, $queryRegistroADMIN) === TRUE) {
    	printf("Resgistro exitoso!");
	}else{
		$result = mysqli_query($dbConn, "SELECT email FROM usuarios WHERE email='".$email."'" );
		if(mysqli_num_rows($result) == 0) {
		     // row not found, do stuff...
			print_r("Error creando el registro!");	
		} else {
		    // do other stuff...
		    print_r($queryRegistroADMIN);
		}
	}
	mysqli_close($dbConn);
	//return $respuesta;
}

?>