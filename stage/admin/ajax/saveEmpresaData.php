<?php

require_once('../../connection/dbConn.php');
require_once('../phpTools/utilities.php');

mysql_select_db($database, $dbConn);

$transaccion = $_POST['transaccion'];

switch($transaccion){

	case 'INSERT':

				$sql = sprintf("INSERT INTO empresas(nombre, codigo_color) VALUES(%s, %s)",																																																																																
								 GetSQLValueString($_POST['nombre'], "text"),
								 GetSQLValueString($_POST['codigo_color'], "text"));
				/*
				$sql2 = sprintf("INSERT INTO Contacto_empresas( direccion_web, correo, telefono, calle, numero_exterior, numero_interior, colonia, delegacion, codigo_postal) VALUES(%s, %s, %s, %s, %s, %s, %s, %s, %s)",																																																																																
								 GetSQLValueString($_POST['direccion_web_empresa'], "text"),
								 GetSQLValueString($_POST['correo_electronico_empresa'], "text"),
								 GetSQLValueString($_POST['telefono_empresa'], "text"),
								 GetSQLValueString($_POST['calle_empresa'], "text"),
								 GetSQLValueString($_POST['numero_ext_empresa'], "text"),
								 GetSQLValueString($_POST['numero_int_empresa'], "text"),
								 GetSQLValueString($_POST['colonia_empresa'], "text"),
								 GetSQLValueString($_POST['delegacion_empresa'], "text"),
								
								 GetSQLValueString($_POST['codigo_postal_empresa'], "text"));
				*/
				$sqlID = "SELECT max(id_empresa) as id FROM empresas WHERE nombre='".$_POST['nombre']."'";
				$insert=true;
				break;
				
	case 'UPDATE':

				$sql = sprintf("UPDATE empresas SET nombre=%s, codigo_color=%s WHERE id_empresa=%s",																																																																																	
								 GetSQLValueString($_POST['nombre'], "text"),
								 GetSQLValueString($_POST['codigo_color'], "text"),
								 GetSQLValueString($_POST['id_empresa'], "int"));
				
				break;
}// switch

$result = mysql_query($sql, $dbConn) or die(mysql_error());
//$result2 = mysql_query($sql2, $dbConn) or die(mysql_error());
//Return id de la empresa recien creada
$resultID = mysql_query($sqlID, $dbConn) or die(mysql_error());
if($insert){
	$id_guardado=mysql_fetch_assoc($resultID);
	echo $id_guardado['id'];
}
mysql_free_result($result);

?>