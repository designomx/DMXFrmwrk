<?php

	require_once('../../connection/dbConn.php');
	require_once('../phpTools/utilities.php');
	mysql_select_db($database, $dbConn);
	if(isset($_POST['id_empresa'])){
		$query = "
			SELECT C. id_contacto 
			FROM `Contacto_empresas` C
			INNER JOIN relacion_contacto_empresas RCE ON C.id_contacto = RCE.id_contacto
			INNER JOIN telefono_contacto_empresa TCE ON C.id_contacto = TCE.id_contacto
			INNER JOIN correo_contacto_empresa CCE ON C.id_contacto = CCE.id_contacto
			WHERE RCE.id_empresa=".$_POST['id_empresa'];

		$result = mysql_query($query, $dbConn) or die(mysql_error());
		echo json_encode(utf8json(mysql_fetch_assoc($result)));

		
		/* liberar la serie de resultados */
		mysql_free_result($result);
	}
?>