<?php
header('Content-Type: text/html; charset=utf-8');

if(isset($_POST['email'])){
	$email = $_POST["email"];
}
$regex = '/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/D';

if(isset($_POST['nombre'])){
	$nombre = $_POST["nombre"];
}

$regexNombre = '/^[a-z A-z A-z A-z ñáéíóúÑÁÉÍÓÚ]{2,40}$/D';
$email=htmlspecialchars($email);
$nombre=htmlspecialchars($nombre);
//htmlspecialchars_decode

if (preg_match($regex, $email) && preg_match($regexNombre, $nombre)) {
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

	$nombre = $mysqli->real_escape_string($nombre);
	$email = $mysqli->real_escape_string($email);
	$query_verificar=("SELECT correo FROM Usuarios WHERE correo='".$email."'");
	if($verificar_email=$mysqli->query($query_verificar)){
		$num_rows=$verificar_email->num_rows;
		//echo "num_rows=".$num_rows;
	}
	if($num_rows>0){
		$duplicado=1;
	}else{
		$query=("	INSERT INTO Usuarios (nombre, correo)
					VALUES ('".$nombre."', '".$email."')");


		if ($mysqli->query($query) === TRUE) {
		    //echo "New record created successfully";
		    $duplicado=0;
		} else {
		    //echo "Error: " . $query . "<br>" . $mysqli->error;
		    //echo "duplicado";
		    $duplicado=-1;
		}
	}

	$mysqli->close();
    //echo 'El texto es válido';
	/*
	$_POST["nombre"];
	$_POST["email"];
	$_POST["estado"];
	$_POST["asunto"];
	$_POST["comentario"];
	*/
	// multiple recipients
	//$to  = 'aidan@example.com' . ', '; // note the comma
	//$to = 'contacto@eligefacil.com';


	$to = 'contacto@eligefacil.com' . ', ';
	$to .= $email;
	//$to = 'emilioo@designo.mx' . ', ';
	//$to .= 'oemilio16@gmail.com';

	// subject
	$subject = 'Bienvenido a EligeFacil.com';

	// message
	$message = '
	<html>
	<head>
	  <title>eligefacil.com ¡Decidir nunca fue tan simple!</title>
	</head>
	<body>';
	//e988b5526b6a9a91911f83ca1cc737c7 = md5(eligefacil)
	$message .= '<p><h3>!Decidir nunca fue tan simple!</h3> </p><p>Hola, '.$nombre.'</p>
	  <p>Gracias por visitar Elige Fácil, para acceder antes que nadie te generamos el siguiente enlace:</p>
	  <p><a href="http://www.eligefacil.com/index.php?ll=e988b5526b6a9a91911f83ca1cc737c7"> - Presiona este link para obtener acceso exclusivo -</a> </p>';
	$message.='
	</body>
	</html>
	';

	// To send HTML mail, the Content-type header must be set
	$headers  = 'MIME-Version: 1.0' .PHP_EOL;
	$headers .= 'Content-type: text/html; charset=utf-8' .PHP_EOL;

	// Additional headers
	//$headers .= 'To: Designo <emilioo@designo.mx>, Gmail <oemilio16@gmail.com>' . "\r\n";
	$headers .= 'From: Eligefacil <contacto@eligefacil.com>' . "\r\n";
	//$headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
	//$headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";

	// Mail it
	//mail($to, $subject, $message, $headers);
	if (mail($to, $subject, $message, $headers)){
		if ($duplicado==0){
			echo true;
		}
		if($duplicado==1){
			echo "duplicado";
		}
		if($duplicado==-1){
			echo "error";
		}
	}else{
		echo false;
	}
} else {
    echo 'error';
}
?>