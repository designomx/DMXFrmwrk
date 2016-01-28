<?php
require "dbConn.php"; 

//Variables del formulario de Registro
$email=$_GET['email'];

$queryEliminar="DELETE FROM usuarios WHERE email ='".$email."'";

$dbConn->exec($queryEliminar);

$dbConn=null;

?>