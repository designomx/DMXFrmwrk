<?php
//Reanudamos la sesión 
@session_start(); 
//Validamos si existe realmente una sesión activa o no 
if($_SESSION['tipo_usuario']!="1" && $_SESSION['tipo_usuario']!="0")
{ 
  //Si no hay sesión activa, lo direccionamos al index.php (inicio de sesión) 
  header("Location: index.php"); 
  exit(); 
}elseif ($_SESSION['tipo_usuario']==0) {
	//Redireccionar a sesion de usuario
}
?>