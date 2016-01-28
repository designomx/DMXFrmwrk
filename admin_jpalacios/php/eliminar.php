<?php
require "dbConn.php"; 

//Variables del formulario de Registro

$queryEliminar="DELETE FROM usuarios WHERE email =".$email;

if (mysqli_query($dbConn, $queryEliminar) === TRUE) {
    	printf("Resgistro exitoso!");
	}else{
		$result = mysqli_query($dbConn, "SELECT email FROM usuarios WHERE email='".$_GET['email']."'";
		     // row not found, do stuff...
			print_r("Error creando el registro!");	
		} else {
		    // do other stuff...
		    print_r($queryRegistroADMIN);
		}

	mysqli_close($dbConn);


?>