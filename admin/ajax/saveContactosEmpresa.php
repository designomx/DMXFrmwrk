<?php

require_once('../../connection/dbConn.php');
require_once('../phpTools/utilities.php');

mysql_select_db($database, $dbConn);


function verificar_contacto($id_empresa,$estado)
{
	$hostname = "localhost";
	$database = "db600436593UTF8";
	$username = "dbo600436593";
	$password = "20eligefacil15#";
	$dbConn = mysql_pconnect($hostname, $username, $password) or trigger_error(mysql_error(),E_USER_ERROR);
	mysql_query("SET NAMES 'utf8'");
	$sqlVerificar=sprintf("SELECT C.id_contacto FROM Contacto_empresas C INNER JOIN relacion_contacto_empresas R ON R.id_contacto=C.id_contacto WHERE R.id_empresa=%s AND C.estado=%s", $id_empresa, $estado);
	//echo $sqlVerificar;
	$resultVerificarContacto = mysql_query($sqlVerificar, $dbConn) or die(mysql_error());
	if (mysql_num_rows($resultVerificarContacto) == 0)  
	{  
		//"No existen registros en la base de datos." Insertar nuevo contacto
		$sqlInsertarContacto=sprintf("INSERT INTO Contacto_empresas (estado) VALUES (%s)",$estado);
		//echo $sqlInsertarContacto;
		$resultInsertContacto = mysql_query($sqlInsertarContacto, $dbConn) or die(mysql_error());
		mysql_free_result($resultInsertContacto);
		$sqlIDContactoInsert=sprintf("SELECT max(id_contacto) as id FROM Contacto_empresas WHERE estado=%s", $estado);
		$resultIDContactoInsert=mysql_query($sqlIDContactoInsert, $dbConn) or die(mysql_error());
		if (mysql_num_rows($resultIDContactoInsert) == 0)  
		{
			return "error";
		}else{
			$id_contacto=mysql_fetch_assoc($resultIDContactoInsert);
			$sqlRelacionContacto=sprintf("INSERT INTO relacion_contacto_empresas (id_empresa,id_contacto) VALUES (%s,%s)",$id_empresa,$id_contacto['id']);
			echo $sqlRelacionContacto;
			$resultRelacionContacto = mysql_query($sqlRelacionContacto, $dbConn) or die(mysql_error());
			mysql_free_result($resultRelacionContacto);
			return $id_contacto['id'];
		}
		mysql_free_result($resultIDContactoInsert);
	}else{
		//Existe, devolver id_contacto
		while ( $fila = mysql_fetch_assoc($resultVerificarContacto)) {
			# code...
			return $fila['id_contacto'];
			break;
		}	
	}
	mysql_free_result($resultVerificarContacto);
}
$delete=false;
$transaccion = $_POST['transaccion'];
switch($transaccion){

	case 'INSERT':
	
		$tipoContacto=$_POST['tipoContacto'];
		switch ($tipoContacto) {
			case 'contacto':

				break;

			case 'correo':
				# code...
				//echo "respuesta: ".$_POST['value'].",".$_POST['nombre'];
				$id_contacto=verificar_contacto($_POST['id_empresa'],$_POST['estado']);
				$sql="INSERT INTO correo_contacto_empresa (id_contacto, correo, nombre_correo) VALUES ('".$id_contacto."','".$_POST['value']."','".$_POST['nombre']."')";
				//echo $sql;
				break;

			case 'telefono':
				# code...
				$id_contacto=verificar_contacto($_POST['id_empresa'],$_POST['estado']);
				$sql="INSERT INTO telefono_contacto_empresa (id_contacto, telefono, nombre_telefono) VALUES ('".$id_contacto."','".$_POST['value']."','".$_POST['nombre']."')";
				//echo $sql;
				break;

			case 'enlace':
				# code...
				$id_contacto=verificar_contacto($_POST['id_empresa'],$_POST['estado']);
				$sql="INSERT INTO enlace_contacto_empresa (id_contacto, enlace, nombre_enlace) VALUES ('".$id_contacto."','".$_POST['value']."','".$_POST['nombre']."')";
				//echo $sql;
				break;
			
			default:
				# code...
				break;
		}
	break;
	case 'UPDATE':
		$tipoContacto=$_POST['tipoContacto'];
		switch ($tipoContacto) {
			
			case 'contacto':

				break;

			case 'correo':
				# code...
				//echo "respuesta: ".$_POST['value'].",".$_POST['nombre'];
				//$id_contacto=verificar_contacto($_POST['id_empresa'],$_POST['estado']);
				$sql="UPDATE correo_contacto_empresa SET correo='".$_POST['value']."', nombre_correo='".$_POST['nombre']."' WHERE id_correo_contacto='".$_POST['id']."'";
				break;

			case 'telefono':
				# code...
				$sql="UPDATE telefono_contacto_empresa SET telefono='".$_POST['value']."', nombre_telefono='".$_POST['nombre']."' WHERE id_telefono_contacto='".$_POST['id']."'";
				break;

			case 'enlace':
				# code...
				$sql="UPDATE enlace_contacto_empresa SET enlace='".$_POST['value']."', nombre_enlace='".$_POST['nombre']."' WHERE id_enlace_contacto='".$_POST['id']."'";
				break;
			
			default:
				# code...
				break;
		}
	break;
	case 'DELETE':
		$tipoContacto=$_POST['tipoContacto'];
		switch ($tipoContacto) {
			
			case 'contacto':
				$sql=sprintf("DELETE FROM Contacto_empresas WHERE id_contacto=%s",
						GetSQLValueString($_POST['id'], "text"));
				$sql2=sprintf("DELETE FROM correo_contacto_empresa WHERE id_contacto=%s",
						GetSQLValueString($_POST['id'], "text"));
				$sql3=sprintf("DELETE FROM telefono_contacto_empresa WHERE id_contacto=%s",
						GetSQLValueString($_POST['id'], "text"));
				$sql4=sprintf("DELETE FROM enlace_contacto_empresa WHERE id_contacto=%s",
						GetSQLValueString($_POST['id'], "text"));
				$delete=true;
			break;

			case 'correo':
				# code...
				$sql=sprintf("DELETE FROM correo_contacto_empresa WHERE id_correo_contacto=%s",
						GetSQLValueString($_POST['id'], "text"));
				break;

			case 'telefono':
				# code...
				$sql=sprintf("DELETE telefono_contacto_empresa WHERE id_telefono_contacto=%s",
						GetSQLValueString($_POST['id'], "text"));
				break;

			case 'enlace':
				# code...
				$sql=sprintf("DELETE enlace_contacto_empresa WHERE id_enlace_contacto=%s",
						GetSQLValueString($_POST['id'], "text"));
				break;
			
			default:
				# code...
				break;
		}
	break;
}// switch

$result = mysql_query($sql, $dbConn) or die(mysql_error());
//$result2 = mysql_query($sql2, $dbConn) or die(mysql_error());
//Return id de la empresa recien creada
//$resultID = mysql_query($sqlID, $dbConn) or die(mysql_error());
if($delete){
	$result2 = mysql_query($sql2, $dbConn) or die(mysql_error());
	$result3 = mysql_query($sql3, $dbConn) or die(mysql_error());
	$result4 = mysql_query($sql4, $dbConn) or die(mysql_error());
	//$id_guardado=mysql_fetch_assoc($resultID);
	//echo $id_guardado['id'];
}
mysql_free_result($result);

?>