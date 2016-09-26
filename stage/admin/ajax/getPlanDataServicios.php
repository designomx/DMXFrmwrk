<?php

	require_once('../../connection/dbConn.php');
	require_once('../phpTools/utilities.php');
	
	$id = $_GET["id"];
		
	mysql_select_db($database, $dbConn);
	$query = sprintf("SELECT PTDS.id_planes_tipoDatosServicios, PTDS.id_plan, PTDS.id_tipoDato, PTDS.valor, TDS.tipo FROM planes_tipoDatosServicios PTDS INNER JOIN tipoDatosServicios TDS ON PTDS.id_tipoDato=TDS.id_tipoDato WHERE PTDS.id_plan=%s", $id);
	$result = mysql_query($query, $dbConn) or die(mysql_error());
	//$result = utf8_encode($result);
	echo recordSetToJson($result);	
		//echo json_encode(utf8json(mysql_fetch_assoc($result)));

	
	mysql_free_result($result);

?>