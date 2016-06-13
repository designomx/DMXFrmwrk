<?php

	require_once('../../connection/dbConn.php');
	require_once('../phpTools/utilities.php');
	mysql_select_db($database, $dbConn);
	$query = sprintf("SELECT id_estado, nombre FROM estados");
	$result = mysql_query($query, $dbConn) or die(mysql_error());

	echo '<div id="SelectEstadosPHP" class="input-field col s12">
				<select id="selectEstado" class="browser-default">';
				echo '<option value="-1" selected="selected">Todos los estados</option>';
	while($row = mysql_fetch_assoc($result))
	{
		$rows[] = $row;
	}

	foreach($rows as $row)
	{
		//print_r($row);
				echo "<option value=".$row['id_estado'].">".$row['nombre']."</option>";
	}
	echo "</select>";
	/* liberar la serie de resultados */
	mysql_free_result($result);

	/*
	mysql_select_db($database, $dbConn);
	$query = sprintf("SELECT id_estado, nombre FROM estados");
	$result = mysql_query($query, $dbConn) or die(mysql_error());
	$recordSet = array();
	while ($row = mysql_fetch_assoc($result)) {
	    $recordSet[]=$row;
	}

	//echo recordSetToJson($result);	
	echo utf8_encode(json_encode($recordSet));

	mysql_free_result($result);
	*/

?>