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
$to = $_POST["emailTo"] . ', ';
$to .= $_POST["emailFrom"];
//$to = 'emilioo@designo.mx' . ', ';
//$to .= 'oemilio16@gmail.com';

// subject
$subject = $_POST["nombreFrom"].' te ha compartido una opcion en EligeFacil.com';

// message
$message = '
<html>
<head>
  <title>Compartido de EligeFácil.com</title>
</head>
<body>';

$message .= '<p>Hola '.$_POST["nombreTo"].',</p><p>'.$_POST["nombreFrom"].' quiere compartir estos planes que ha visto en <a href="http://www.eligefacil.com">eligefacil.com<a></p>';
$urlSingle="http://www.eligefacil.com/listado-comparador.php?l=".$_POST["estado"];
if (isset($_POST["celular"]) && $_POST["celular"]==1){
	$urlSingle.="&s[]=1";
}
if (isset($_POST["telefono"]) && $_POST["telefono"]==1){
	$urlSingle.="&s[]=2";
}
if (isset($_POST["internet"]) && $_POST["internet"]==1){
	$urlSingle.="&s[]=3";
}
if (isset($_POST["television"]) && $_POST["television"]==1){
	$urlSingle.="&s[]=4";
}
if (isset($_POST["streaming"]) && $_POST["streaming"]==1){
	$urlSingle.="&s[]=5";
}
if(isset($_POST["plan"])){
	$urlSingle.="&plan[]=".$_POST["plan"];
}
if(isset($_POST["planes"])){
	$planes=$_POST["planes"];
	foreach ($planes as $plan){
		$urlSingle.="&plan[]=".$plan;
	}
}

$url=urlencode($urlSingle);

$message.='<p>Este es el plan que quieren compartir contigo</p> <p><a href="'.$urlSingle.'">'.$urlSingle.'</a></p>
  
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
