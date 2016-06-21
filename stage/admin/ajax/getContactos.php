<?php
	require_once('../../connection/dbConn.php');
	require_once('../phpTools/utilities.php');
	mysql_select_db($database, $dbConn);
	if(isset($_POST['id_empresa'])){
		$query = "
			SELECT DISTINCT(C.id_contacto), C.estado,CCE.correo,CCE.nombre_correo,TCE.telefono,TCE.nombre_telefono, CCE.id_correo_contacto, TCE.id_telefono_contacto,ECE.nombre_enlace, ECE.enlace,ECE.id_enlace_contacto
			FROM Contacto_empresas C
			LEFT JOIN relacion_contacto_empresas RCE ON C.id_contacto = RCE.id_contacto
			LEFT JOIN telefono_contacto_empresa TCE ON C.id_contacto = TCE.id_contacto
			LEFT JOIN correo_contacto_empresa CCE ON C.id_contacto = CCE.id_contacto
			LEFT JOIN enlace_contacto_empresa ECE ON C.id_contacto = ECE.id_contacto
			WHERE RCE.id_empresa=".$_POST['id_empresa']." ORDER BY C.estado ASC";
			//echo $query;
		//$result = mysqli_query($query, $dbConn) or die(mysql_error());
		//echo json_encode(utf8json(mysql_fetch_assoc($result)));
		$primero=true;
		$contactos= array();
		$estado=null;

		$queryCorreos="SELECT C.id_contacto,C.estado,CCE.correo,CCE.nombre_correo,CCE.id_correo_contacto FROM Contacto_empresas C INNER JOIN correo_contacto_empresa CCE ON C.id_contacto=CCE.id_contacto INNER JOIN relacion_contacto_empresas RCE ON C.id_contacto = RCE.id_contacto WHERE RCE.id_empresa=".$_POST['id_empresa']." ORDER BY C.estado ASC";
		//echo $queryCorreos;

		$resultCorreos = mysql_query($queryCorreos, $dbConn) or die(mysql_error());
		while ($filaCorreos = mysql_fetch_assoc($resultCorreos)) {
			# code...
			$array_cont= array();
			if(!empty($filaCorreos['correo'])){
				$array_cont= array();
				$array_cont=array(	'estado' => $filaCorreos["estado"],
									"tipo"=> "correo", 
									"value"=>$filaCorreos["correo"], 
									"nombre"=>$filaCorreos["nombre_correo"],
									"id"=>$filaCorreos['id_correo_contacto'],
									"id_contacto"=>$filaCorreos['id_contacto']
						);
				$contactos['contactos'][$filaCorreos['estado']][]=$array_cont;
			}
		}
		mysql_free_result($resultCorreos);

		$queryTelefonos = "SELECT C.id_contacto,C.estado,TCE.telefono,TCE.nombre_telefono,TCE.id_telefono_contacto FROM Contacto_empresas C INNER JOIN telefono_contacto_empresa TCE ON C.id_contacto=TCE.id_contacto INNER JOIN relacion_contacto_empresas RCE ON C.id_contacto = RCE.id_contacto WHERE RCE.id_empresa=".$_POST['id_empresa']." ORDER BY C.estado ASC";
		$resultTelefonos = mysql_query($queryTelefonos, $dbConn) or die(mysql_error());
		while ($filaTelefonos = mysql_fetch_assoc($resultTelefonos)) {
			# code...
			if(!empty($filaTelefonos['telefono'])){
				$array_cont= array();
				$array_cont=array(	'estado' => $filaTelefonos["estado"],
									"tipo"=> "telefono", 
									"value"=>$filaTelefonos["telefono"], 
									"nombre"=>$filaTelefonos["nombre_telefono"],
									"id"=>$filaTelefonos['id_telefono_contacto'],
									"id_contacto"=>$filaTelefonos['id_contacto']
						);
				$contactos['contactos'][$filaTelefonos['estado']][]=$array_cont;
			}			
		}
		mysql_free_result($resultTelefonos);

		$queryEnlaces = "SELECT C.id_contacto,C.estado,ECE.enlace,ECE.nombre_enlace,ECE.id_enlace_contacto,ECE.descripcion_enlace FROM Contacto_empresas C INNER JOIN enlace_contacto_empresa ECE ON C.id_contacto=ECE.id_contacto INNER JOIN relacion_contacto_empresas RCE ON C.id_contacto = RCE.id_contacto WHERE RCE.id_empresa=".$_POST['id_empresa']." ORDER BY C.estado ASC";
		$resultEnlaces = mysql_query($queryEnlaces, $dbConn) or die(mysql_error());
		while ($filaEnlaces = mysql_fetch_assoc($resultEnlaces)) {
			# code...
			if(!empty($filaEnlaces['enlace'])){
				$array_cont= array();
				$array_cont=array(	'estado' => $filaEnlaces["estado"],
									"tipo"=> "enlace", 
									"value"=>$filaEnlaces["enlace"], 
									"nombre"=>$filaEnlaces["nombre_enlace"],
									"id"=>$filaEnlaces['id_enlace_contacto'],
									"id_contacto"=>$filaEnlaces['id_contacto'],
									"descripcion"=>$filaEnlaces['descripcion_enlace']
						);
				$contactos['contactos'][$filaEnlaces['estado']][]=$array_cont;
			}
		}
		mysql_free_result($resultEnlaces);
		echo json_encode(utf8json($contactos));

		/* liberar la serie de resultados */
		//mysql_free_result($result);
	}
?>