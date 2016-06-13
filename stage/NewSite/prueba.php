<?php

	if (isset($_POST['filtros'])) {
				//FILTRAR CON LOS FILTROS
			$query_filtros="SELECT
				DISTINCT(P.id_plan),
			 	P.nombre, 
			 	P.precio, 
			 	P.dato_principal_1,
			 	P.id_tipoDato_principal_1, 
			 	P.dato_principal_2, 
			 	P.id_tipoDato_principal_2, 
				P.dato_principal_3, 
				P.id_tipoDato_principal_3, 
				P.dato_principal_4,
				P.id_tipoDato_principal_4, 
				P.mas_datos, P.visible, 
				E.nombre as empresa, 
				E.codigo_color as empresa_color
			  	FROM planes P
			  	INNER JOIN empresas E ON P.ID_EMPRESA=E.ID_EMPRESA
			  	INNER JOIN cobertura C ON P.ID_PLAN=C.ID_PLAN
			  	INNER JOIN planes_tipoServicios PT ON P.ID_PLAN=PT.ID_PLAN
			  	WHERE C.ID_ESTADO=".$_SESSION['estado']."
			  	AND PT.id_plan NOT IN (SELECT id_plan FROM planes_tipoServicios WHERE id_tipoServicio IN (SELECT id_tipoServicio from tipoServicios where id_tipoServicio NOT IN (".implode(', ', $_SESSION['Servicios'])." ) ))
			  	AND P.visible=1
			";
		    $Filtros = $_POST['filtros'];
		    //print_r($_POST['filtros']);
		    foreach ($Filtros as $filtro) {
		        # code...
		        $fil = json_decode($filtro);
		        if($fil->tipo=='slider'){
		        	/*echo "Sliders:<br>";
		        	echo $fil->id_tipoDato."<br>";
		        	echo $fil->Mayor."<br>";
		        	echo $fil->Menor."<br>";
		        	*/
		        	$query_filtros=$query_filtros." AND ((P.id_tipoDato_principal_1=".$fil->id_tipoDato." AND P.dato_principal_1>=".$fil->Menor." AND P.dato_principal_1<=".$fil->Mayor.")
		  		OR (P.id_tipoDato_principal_2=".$fil->id_tipoDato." AND P.dato_principal_2>=".$fil->Menor." AND P.dato_principal_2<=".$fil->Mayor.")
		  		OR (P.id_tipoDato_principal_3=".$fil->id_tipoDato." AND P.dato_principal_3>=".$fil->Menor." AND P.dato_principal_3<=".$fil->Mayor.")
		  		OR (P.id_tipoDato_principal_4=".$fil->id_tipoDato." AND P.dato_principal_4>=".$fil->Menor." AND P.dato_principal_4<=".$fil->Mayor.")
		  		)";
		        }
		        if($fil->tipo=='check'){
		        	/*
		        	echo "CheckBoxes: <br>";
		        	echo $fil->id_tipoDato."<br>";
		        	*/
		        	$query_filtros=$query_filtros." AND ((P.id_tipoDato_principal_1=".$fil->id_tipoDato." AND P.dato_principal_1=1 )
		  		OR (P.id_tipoDato_principal_2=".$fil->id_tipoDato." AND P.dato_principal_2=1 )
		  		OR (P.id_tipoDato_principal_3=".$fil->id_tipoDato." AND P.dato_principal_3=1 )
		  		OR(P.id_tipoDato_principal_4=".$fil->id_tipoDato." AND P.dato_principal_4=1 )
		  		)";
		        }
		        //ChromePhp::log("Nome: " . $usr->nome . " - Idade: " . $usr->idade);
		    }
		    $query_filtros=$query_filtros."GROUP BY id_plan HAVING count(*) >= ".count($_SESSION['Servicios'])."
		  	ORDER BY P.precio ASC";
		  	//echo $query_filtros;
		  	$mysqli = new mysqli("localhost", "dbo600436593", "20eligefacil15#", "db600436593UTF8");
			$mysqli->set_charset("utf8");	

			/* verificar la conexión */
			if (mysqli_connect_errno()) {
			    printf("Falló la conexión failed: %s\n", $mysqli->connect_error);
			    exit();
			}

			//$result = $mysqli->query($query);
		  	$result_filtros = $mysqli->query($query_filtros);
			//$_SESSION['numero_planes']=mysqli_num_rows($result_filtros);				
			echo $query_filtros;
			exit();
			$rows=array();
			while($row = $result_filtros->fetch_array())
			{
				array_push($rows, $row);
			}
			//$_SESSION['Preciomax']=0;
			//$_SESSION['Preciomin']=-1;
			foreach($rows as $row)
			{	
				//print_r($row);		
			
				$respuesta=$respuesta.'<div class="col s12 m6 l4 paq-list-bx">
					<div class="paq-content-bx">
						<div class="brand-label" style="background-color:'.$row["empresa_color"].'">'.$row["empresa"].'</div>
						<div class="paq-bx">
							<h4 class="truncate">'.$row["nombre"].'</h4>
							<ul>';


									switch ($row['tipoDato1']) {
									    case "texto":
											$respuesta=$respuesta.'<li>'.$row["dato_principal_1"].'</li>';
									        break;
									    case "integer":
											$respuesta=$respuesta.'<li>'.$row["dato_principal_1"].' '.$row["dato1"].'</li>';
									        break;
									    case "boolean":
											$respuesta=$respuesta.'<li>'.$row["dato1"].'</li>';
									        break;
									}
									switch ($row['tipoDato2']) {
									    case "texto":
											$respuesta=$respuesta.'<li>'.$row["dato_principal_2"].'</li>';
									        break;
									    case "integer":
											$respuesta=$respuesta.'<li>'.$row["dato_principal_2"].' '.$row["dato2"].'</li>';
									        break;
									    case "boolean":
											$respuesta=$respuesta.'<li>'.$row["dato2"].'</li>';
									        break;
									}
									switch ($row['tipoDato3']) {
									    case "texto":
											$respuesta=$respuesta.'<li>'.$row["dato_principal_3"].'</li>';
									        break;
									    case "integer":
											$respuesta=$respuesta.'<li>'.$row["dato_principal_3"].' '.$row["dato3"].'</li>';
									        break;
									    case "boolean":
											$respuesta=$respuesta.'<li>'.$row["dato3"].'</li>';
									        break;
									}
									switch ($row['tipoDato4']) {
									    case "texto":
											$respuesta=$respuesta.'<li>'.$row["dato_principal_4"].'</li>';
									        break;
									    case "integer":
											$respuesta=$respuesta.'<li>'.$row["dato_principal_4"].' '.$row["dato4"].'</li>';
									        break;
									    case "boolean":
											$respuesta=$respuesta.'<li>'.$row["dato4"].'</li>';
									        break;
									}
							$respuesta=$respuesta.'</ul>
						</div>
						<div class="paq-price">$'.$row["precio"].'</div>
						<div id="botonesPlan" class="more-actions-bx">
							<a id="verPlan" href="#deatilsModal" class="modal-trigger waves-effect" data-value="'.$row["id_plan"].'">Ver detalles</a>
							<a href="#!" class="compare-slct slctd-plan">Comparar <i class="material-icons">done</i></a>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>';	
					
			}//foreach
		echo $respuesta;
	}else{
		echo "ERROR!!";
	}

?>