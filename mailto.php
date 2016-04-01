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
//$to .= 'wez@example.com';
$to = 'emilioo@designo.mx' . ', ';
$to .= 'oemilio16@gmail.com';

// subject
$subject = 'Comentario de usuario en stage.eligefacil.com/NewSite/contacto.html';

// message
$message = '
<html>
<head>
  <title>Comentario usuario EligeFácil.com</title>
</head>
<body>
  <h1>'.$_POST["asunto"].'</h1>
  <p>Nombre: '.$_POST["nombre"].'</p>
  <p>Email: '.$_POST["email"].'</p>
  <p>Estado: '.$_POST["estado"].'<br><br>
  <p>'.$_POST["comentario"].'</p>
  
</body>
</html>
';

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' .PHP_EOL;
$headers .= 'Content-type: text/html; charset=iso-8859-1' .PHP_EOL;

// Additional headers
$headers .= 'To: Designo <emilioo@designo.mx>, Gmail <oemilio16@gmail.com>' . "\r\n";
//$headers .= 'From: Birthday Reminder <birthday@example.com>' . "\r\n";
//$headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
//$headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";

// Mail it
mail($to, $subject, $message, $headers);
?>
