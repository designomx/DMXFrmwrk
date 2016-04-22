<?php
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
$to .= 'emilioo@designo.mx';
//$to = 'emilioo@designo.mx' . ', ';
//$to .= 'oemilio16@gmail.com';

// subject
$subject = 'Comentario de usuario en EligeFacil.com';

// message
$message = '
<html>
<head>
  <title>Comentario usuario EligeFácil.com</title>
</head>
<body>';
switch ($_POST["tema"]) {
	case '1':
		# code...
		$message.='<h1>Mensaje sin tema:</h1>';
		break;
	case '2':
		$message.='<h1>Sugerencia</h1>';
		break;
	case '3':
		$message.='<h1>Queja</h1>';
		break;
	case '4':
		$message.='<h1>Comentario</h1>';
		break;
	case '5':
		$message.='<h1>Agregar Plan</h1>';
		break;
	case '6':
		$message.='<h1>Reportar Plan</h1>';
		break;	
	case '7':
		$message.='<h1>Otro</h1>';
		break;

	default:
		$message.='<h1>Mensaje sin tema</h1>';
		break;
}
$message .= '<p>Nombre: '.$_POST["nombre"].'</p>
  <p>Email: '.$_POST["email"].'</p>';

//Por seguridad, para no acceder a la Base de datos, cargo estados manuales
switch ($_POST["estado"]) {
	case '1':
		# code...
		$message.='<p>Estado: Aguascalientes<br><br>';
		break;
	case '2':
		$message.='<p>Estado: Baja California<br><br>';
		break;
	case '3':
		$message.='<p>Estado: Baja California Sur<br><br>';
		break;
	case '4':
		$message.='<p>Estado: Campeche<br><br>';
		break;
	case '5':
		$message.='<p>Estado: Chiapas<br><br>';
		break;
	case '6':
		$message.='<p>Estado: Chihuahua<br><br>';
		break;
	case '7':
		$message.='<p>Estado: Coahuila<br><br>';
		break;
	case '8':
		$message.='<p>Estado: Colima<br><br>';
		break;
	case '9':
		$message.='<p>Estado: Ciudad de México<br><br>';
		break;
	case '10':
		$message.='<p>Estado: Durango<br><br>';
		break;
	case '11':
		$message.='<p>Estado: Estado de México<br><br>';
		break;
	case '12':
		$message.='<p>Estado: Guanajuato<br><br>';
		break;
	case '13':
		$message.='<p>Estado: Guerrero<br><br>';
		break;
	case '14':
		$message.='<p>Estado: Hidalgo<br><br>';
		break;
	case '15':
		$message.='<p>Estado: Jalisco<br><br>';
		break;
	case '16':
		$message.='<p>Estado: Michoacán<br><br>';
		break;
	case '17':
		$message.='<p>Estado: Morelos<br><br>';
		break;
	case '18':
		$message.='<p>Estado: Nayarit<br><br>';
		break;
	case '19':
		$message.='<p>Estado: Nuevo León<br><br>';
		break;
	case '20':
		$message.='<p>Estado: Oaxaca<br><br>';
		break;
	case '21':
		$message.='<p>Estado: Puebla<br><br>';
		break;
	case '22':
		$message.='<p>Estado: Querétaro<br><br>';
		break;
	case '23':
		$message.='<p>Estado: Quintana Roo<br><br>';
		break;
	case '24':
		$message.='<p>Estado: San Luis Potosí<br><br>';
		break;
	case '25':
		$message.='<p>Estado: Sinaloa<br><br>';
		break;
	case '26':
		$message.='<p>Estado: Sonora<br><br>';
		break;
	case '27':
		$message.='<p>Estado: Tabasco<br><br>';
		break;
	case '28':
		$message.='<p>Estado: Tamaulipas<br><br>';
		break;
	case '29':
		$message.='<p>Estado: Tlaxcala<br><br>';
		break;
	case '30':
		$message.='<p>Estado: Veracruz<br><br>';
		break;
	case '31':
		$message.='<p>Estado: Yucatán<br><br>';
		break;
	case '32':
		$message.='<p>Estado: Zacatecas<br><br>';
		break;

	
	default:
		# code...
		$message.='<p>Estado: '.$_POST["estado"].'<br><br>';
		break;
}
$message.='<p>Comentario:</p><p>'.$_POST["comentario"].'</p>
  
</body>
</html>
';

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' .PHP_EOL;
$headers .= 'Content-type: text/html; charset=iso-8859-1' .PHP_EOL;

// Additional headers
//$headers .= 'To: Designo <emilioo@designo.mx>, Gmail <oemilio16@gmail.com>' . "\r\n";
$headers .= 'From: Eligefacil <contacto@eligefacil.com>' . "\r\n";
//$headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
//$headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";

// Mail it
//mail($to, $subject, $message, $headers);
if (mail($to, $subject, $message, $headers)){
	echo true;
}else{
	echo false;
}

?>
