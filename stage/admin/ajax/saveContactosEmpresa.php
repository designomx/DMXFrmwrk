<?php

require_once('../../connection/dbConn.php');
require_once('../phpTools/utilities.php');

mysql_select_db($database, $dbConn);


function verificar_contacto($id_empresa,$estado)
{
	$hostname = "localhost";
	$database = "stage-db600436593UTF8";
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
						$sql=sprintf("INSERT INTO correo_contacto_empresa (id_contacto, correo, nombre_correo) VALUES (%s,%s,%s)",
								$id_contacto,
								GetSQLValueString($_POST['value'], "text"),
								GetSQLValueString($_POST['nombre'], "text"));
						//echo $sql;
						break;

					case 'telefono':
						# code...
						break;

					case 'enlace':
						# code...
						break;
					
					default:
						# code...
						break;
				}
				/*
				$sql = sprintf("INSERT INTO empresas(nombre, codigo_color) VALUES(%s, %s)",																																																																																
								 GetSQLValueString($_POST['nombre'], "text"),
								 GetSQLValueString($_POST['codigo_color'], "text"));
				
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
				
				$sqlID = "SELECT max(id_empresa) as id FROM empresas WHERE nombre='".$_POST['nombre']."'";
				$insert=true;
				break;
				*/
				
	case 'UPDATE':

				$sql = sprintf("UPDATE empresas SET nombre=%s, codigo_color=%s WHERE id_empresa=%s",																																																																																	
								 GetSQLValueString($_POST['nombre'], "text"),
								 GetSQLValueString($_POST['codigo_color'], "text"),
								 GetSQLValueString($_POST['id_empresa'], "int"));
				
				break;
}// switch
$hostname = "localhost";
$database = "stage-db600436593UTF8";
$username = "dbo600436593";
$password = "20eligefacil15#";
$dbConn = mysql_pconnect($hostname, $username, $password) or trigger_error(mysql_error(),E_USER_ERROR);
mysql_query("SET NAMES 'utf8'");
$result = mysql_query($sql, $dbConn) or die(mysql_error());
//$result2 = mysql_query($sql2, $dbConn) or die(mysql_error());
//Return id de la empresa recien creada
//$resultID = mysql_query($sqlID, $dbConn) or die(mysql_error());
//if($insert){
	//$id_guardado=mysql_fetch_assoc($resultID);
	//echo $id_guardado['id'];
//}
mysql_free_result($result);

?>