<?php
header('Content-Type: text/html; charset=utf-8');

	$duplicado=0;
	// Datos para la conexion
	$host = 'localhost';
	//$host = 'localhost:8889';
	$database = 'usuariosEligeFacil';
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

	$id_plan=htmlspecialchars($_POST['id_plan']);
	$query_verificar=("SELECT id_plan, cantidad_contrataciones FROM Contratar WHERE id_plan='".$id_plan."'");
	if($verificar=$mysqli->query($query_verificar)){
		$num_rows=$verificar->num_rows;
		$row = $verificar->fetch_array(MYSQLI_ASSOC);
		$cantidad_contrataciones=$row['cantidad_contrataciones'];
		//echo "num_rows=".$num_rows;
	}
	if($num_rows>0){
		//echo "cantidad de contrataciones ".$cantidad_contrataciones;
		$sql="UPDATE Contratar SET cantidad_contrataciones=cantidad_contrataciones+1 WHERE id_plan='".$id_plan."'";
		if ($mysqli->query($sql) === TRUE) {
		    //echo "New record created successfully";
		    echo true;
		} else {
		    //echo "Error: " . $query . "<br>" . $mysqli->error;
		}
	}else{
		$query=("	INSERT INTO Contratar (id_plan, cantidad_contrataciones)
					VALUES ('".$id_plan."', 1)");
		if ($mysqli->query($query) === TRUE) {
		    //echo "New record created successfully";
		    echo true;
		} else {
		    //echo "Error: " . $query . "<br>" . $mysqli->error;
		}
	}
	$mysqli->close();

?>