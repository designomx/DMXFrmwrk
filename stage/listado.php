<?php
 header('Access-Control-Allow-Origin: *');  

/*
Archivo que recibe las peticiones de listar los distintos planes, así como de los filtros si los tuviese la llamada, con las distintas formas de filtrar.

//Obtener IP del cliente
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}
*/

require('dbconn.php');


session_start();
setlocale(LC_MONETARY, 'en_US');
$_SESSION['Servicios'] = array();
if(isset($_POST['estado'])){
	$_SESSION['estado']=$_POST['estado'];
}
$Servicios = array();
if($_POST['celular']==1){
	//echo 'Query para planes celulares '.$ip;
	array_push($_SESSION['Servicios'], "1");
}
if($_POST['telefono']==1){
	//echo 'Query para planes celulares '.$ip;
	array_push($_SESSION['Servicios'], "2");
}
if($_POST['internet']==1){
	//echo 'Query para planes celulares '.$ip;
	array_push($_SESSION['Servicios'], "3");
}
if($_POST['television']==1){
	//echo 'Query para planes celulares '.$ip;
	array_push($_SESSION['Servicios'], "4");
}


if(isset($_POST['VerificarServicios'])){
	echo json_encode($_SESSION['Servicios']);
}

//Funcion para ordenar los arreglos que muestran los planes, ordena los planes y los planes sugeridos
function invenDescSort($item1,$item2)
{
    if ($item1['precio'] == $item2['precio']) return 0;
    return ($item1['precio'] < $item2['precio']) ? 1 : -1;
}
function invenAscSort($item1,$item2)
{
    if ($item1['precio'] == $item2['precio']) return 0;
    return ($item1['precio'] > $item2['precio']) ? 1 : -1;
}

if(isset($_POST['listadoSimple'])){
//Listado Simple para la pagina principal y para listar solo por tipo de servicio, y cargar los filtros
	session_start();
	if(isset($_POST['estado'])){
		$_SESSION['estado']=$_POST['estado'];
	}
	$_SESSION['Servicios'] = array();
	if($_POST['celular']==1){
		//echo 'Query para planes celulares '.$ip;
		array_push($_SESSION['Servicios'], "1");
	}
	if($_POST['telefono']==1){
		//echo 'Query para planes celulares '.$ip;
		array_push($_SESSION['Servicios'], "2");
	}
	if($_POST['internet']==1){
		//echo 'Query para planes celulares '.$ip;
		array_push($_SESSION['Servicios'], "3");
	}
	if($_POST['television']==1){
		//echo 'Query para planes celulares '.$ip;
		array_push($_SESSION['Servicios'], "4");
	}
	if(!isset($_SESSION['estado'])){
		$ERROR=1;
	}
	if(!isset($_SESSION['Servicios'])){
		$ERROR=1;
	}
	if(!$ERROR){
		//$respuesta = array();
		if(isset($_POST['CargarPlanes'])){

			$query=("SELECT 
						DISTINCT(P.id_plan),
							P.nombre, 
							P.precio, 
							P.mas_datos, P.visible, 
							E.nombre as empresa, 
							E.codigo_color as empresa_color
							FROM planes P
							INNER JOIN empresas E ON P.ID_EMPRESA=E.ID_EMPRESA
							INNER JOIN cobertura C ON P.ID_PLAN=C.ID_PLAN
							INNER JOIN planes_tipoServicios PT ON P.ID_PLAN=PT.ID_PLAN
							WHERE C.ID_ESTADO='".$_SESSION['estado']."' 
							AND PT.id_plan NOT IN (SELECT id_plan FROM planes_tipoServicios WHERE id_tipoServicio IN (SELECT id_tipoServicio from tipoServicios where id_tipoServicio NOT IN (".implode(', ', $_SESSION['Servicios']).") ) )
							AND visible=1
							GROUP BY P.id_plan HAVING count(*) >= ".count($_SESSION['Servicios'])."
				  	 ");
			//echo $query;


			$result = $mysqli->query($query);
			$_SESSION['numero_planes']=mysqli_num_rows($result);	
			$_SESSION['Preciomax']=0;
			$_SESSION['Preciomin']=-1;			

			$rows=array();
			while($row = $result->fetch_array())
			{
				//Los planes que cumplen las reglas de busqueda, son no sugeridos=0
				$row["sugerido"]=0;	
				array_push($rows, $row);
				if($_SESSION['Preciomin']==-1){
					$_SESSION['Preciomax']=$row['precio'];
					$_SESSION['Preciomin']=$row['precio'];
				}else{
					if($row['precio']>$_SESSION['Preciomax']){
						$_SESSION['Preciomax']=$row['precio'];
					}
					if($row['precio']<$_SESSION['Preciomin']){
						$_SESSION['Preciomin']=$row['precio'];
					}
				}
			}

			

			if($_POST["orden"]=="DESC"){
				usort($rows,'invenDescSort');
			}
			if($_POST["orden"]=="ASC"){
				usort($rows,'invenAscSort');
			}
			$i=0;
			$random=0;
			$publicidad=mt_rand(2,4);
			foreach($rows as $row)
			{	
				if($random==$publicidad){
					$respuesta=$respuesta.'	<div id="cargarmas'.$i.'" class="col s12 m6 l4 paq-list-bx cargarmas">
												<div class="paq-content-bx banner-ovrflw">
													<a href="http://www.eligefacil.com" target="_blank" class="go-banner"></a>
													<img src="images/promo-grid.jpg" alt="" class="banner-art" />
													<img src="images/promo-grid.jpg" alt="" class="banner-art" />
												</div>
											</div>';
					$i+=1;
				}
				$random+=1;
				if($random==5 ){
					$random=0;
					$publicidad=mt_rand(2,4);
				}
				$query_tipoServicio="SELECT id_tipoServicio FROM planes_tipoServicios WHERE id_plan=".$row["id_plan"];
				$result_tipoServicio = $mysqli->query($query_tipoServicio);
				$filas=array();
				$respuesta=$respuesta.'
					<div id="cargarmas'.$i.'" class="col s12 m6 l4 paq-list-bx cargarmas">
						<div class="paq-content-bx">
							<div class="comparando-icons">';
				while($fila = $result_tipoServicio->fetch_array())
				{
					//array_push($filas, $fila);
					if($fila["id_tipoServicio"]==1){
						$respuesta=$respuesta.'<i class="material-icons iconosPlanes">phone_android</i>';
					}
					if($fila["id_tipoServicio"]==2){
						$respuesta=$respuesta.'<i class="material-icons iconosPlanes">phone</i>';
					}
					if($fila["id_tipoServicio"]==3){
						$respuesta=$respuesta.'<i class="material-icons iconosPlanes">wifi</i>';
					}
					if($fila["id_tipoServicio"]==4){
						$respuesta=$respuesta.'<i class="material-icons iconosPlanes">tv</i>';
					}
				}

				$respuesta=$respuesta.'</div>
						<div class="brand-label" style="background-color:'.$row["empresa_color"].'">'.$row["empresa"].'</div>
						';
				$respuesta=$respuesta.'
						<div class="paq-bx">
							<h4 class="truncate">'.$row["nombre"].'</h4>
							<ul>';

				$query_atributos = 'SELECT 	PTDS.valor,
											PTDS.id_tipoDato,
											TDS.label as dato,
											TDS.tipo as tipoDato
									FROM planes_tipoDatosServicios PTDS
									LEFT JOIN tipoDatosServicios TDS ON PTDS.id_tipoDato = TDS.id_tipoDato 
									WHERE PTDS.id_plan='.$row["id_plan"].'
									ORDER BY TDS.orden';
				$result_atributos = $mysqli->query($query_atributos);
				$atributo=array();
				//Variable para saber si un plan es prepago o no, así mostrar los textos de 'sin recarga minima' o 'con recarga minima'
				$prepago=false;
				while($atributo = $result_atributos->fetch_array()){
					switch ($atributo['tipoDato']) {
					    case "texto":
					    	if($atributo['valor'] != NULL){
					    		$respuesta=$respuesta.'<li>'.$atributo["valor"].'</li>';
					    	}
					        break;
					    case "integer":
					    	if($atributo['valor'] != NULL && $atributo['valor'] != 0){
					    		$respuesta=$respuesta.'<li>'.$atributo["valor"].' '.$atributo["dato"].'</li>';	
					    	}else{
					    		$respuesta=$respuesta.'<li><del>'.$atributo["dato"].'</del></li>';
					    	}
					        break;
					    case "boolean":
					    	if($atributo['valor'] == 1){
					    		$respuesta=$respuesta.'<li>'.$atributo["dato"].'</li>';
					    		if($atributo['id_tipoDato']==2){
					    			$prepago=true;
					    		}
					    	}else{
					    		$respuesta=$respuesta.'<li><del>'.$atributo["dato"].'</del></li>';
					    		if($atributo['id_tipoDato']==2){
					    			$prepago=false;
					    		}
					    	}
					        break;
					}
				}
				/*

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
									*/
									if(isset($_POST["celular"])){
										if($_POST["celular"]==1){
											$query_redesSociales="SELECT PRS.id_redSocial,
												RS.nombre
												FROM planes_redesSociales PRS
												INNER JOIN redesSociales RS ON PRS.id_redSocial=RS.id_redSocial 
												WHERE PRS.id_plan=".$row["id_plan"];
											$result_redesSociales = $mysqli->query($query_redesSociales);
											$numero_filasRS = mysqli_num_rows($result_redesSociales);
											if($numero_filasRS>0){
												$respuesta=$respuesta.'<li>Redes Sociales</li>';
												while($rowRedSocial = $result_redesSociales->fetch_array())
												{
													$respuesta=$respuesta.'<li>('.$rowRedSocial["nombre"].')</li>';
												} 
											}
										}
									}
							$respuesta=$respuesta.'</ul>
						</div>'
						;
						if($prepago){
							if ($row["precio"]==0){
								if($row["sugerido"]==1){
									$respuesta.='<div class="paq-price sgrdo lngtxt">';
								}else{
									$respuesta.='<div class="paq-price lngtxt">';
								}
								$respuesta=$respuesta.'Sin Recarga Mínima';
							}else{
								if($row["sugerido"]==1){
									$respuesta.='<div class="paq-price sgrdo lngtxt">';
								}else{
									$respuesta.='<div class="paq-price lngtxt">';
								}
								$respuesta=$respuesta.'Recarga de $'.number_format($row["precio"]);
							}
						}else{
							if($row["sugerido"]==1){
								$respuesta.='<div class="paq-price sgrdo">';
							}else{
								$respuesta.='<div class="paq-price">';
							}
							$respuesta=$respuesta.'$'.number_format($row["precio"]);
						}
						if($row["sugerido"]==1){
							$respuesta=$respuesta."<p><span style='color: #FFF'>Sugerencia Elige Fácil</span></p>";
						}
						$respuesta=$respuesta.'</div>
						<div id="botonesPlan" class="more-actions-bx">
							<a id="verPlan" href="#deatilsModal" class="modal-trigger waves-effect verplan_'.$row["id_plan"].'" data-value="'.$row["id_plan"].'">Ver detalles</a>
							<a href="#!" class="compare-slct" id="plan_'.$row["id_plan"].'" onclick="Comparar(this,'.$row["id_plan"].','."'".$row["empresa_color"]."'".')">Comparar <i class="material-icons">done</i></a>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>';	
			$i+=1;	
			}//foreach

		}//$_POST['CargarPlanes']

		if(isset($_POST['CargarFiltrosSliders'])){
			$query= ("SELECT 	TDS.id_tipoDato, 
								TDS.id_tipoServicio, 
								TS.icono as icono_servicio, 
								TDS.label, 
								TDS.tipo 
								FROM tipoDatosServicios TDS 
								INNER JOIN  tipoServicios TS ON TDS.id_tipoServicio=TS.id_tipoServicio
								WHERE TDS.id_tipoServicio IN( 
									SELECT id_tipoServicio
									FROM planes_tipoServicios PTS
									INNER JOIN cobertura C ON PTS.id_plan=C.id_plan 
									WHERE PTS.id_tipoServicio IN (".implode(', ', $_SESSION['Servicios']).") 
									AND PTS.id_plan NOT IN(SELECT id_plan FROM planes_tipoServicios WHERE id_tipoServicio NOT IN (".implode(', ', $_SESSION['Servicios']).")) 
									AND C.id_estado=".$_SESSION['estado'].") 
								AND tipo='integer'");
//echo $query;


			$result = $mysqli->query($query);

			$rows=array();
			while($row = $result->fetch_array())
			{
				array_push($rows, $row);
			} 
			$Max= array();
			$Min= array();
			foreach($rows as $row)
			{
				$query_MaxMin=("SELECT MAX(CAST(dato_principal_1 as unsigned)) as maximo, MIN(CAST(dato_principal_1 as unsigned)) as minimo from planes where id_tipoDato_principal_1=".$row['id_tipoDato']);
				$result_MaxMin=$mysqli->query($query_MaxMin);
				$MaxMin=array();
				while($rowss = $result_MaxMin->fetch_array())
				{
					array_push($MaxMin, $rowss);
				}
				foreach($MaxMin as $rowMM)
				{
					if($rowMM['maximo']==NULL || empty($rowMM['maximo']) || $rowMM['maximo']=='' || !isset($rowMM['maximo']) ){
						$Max[$row['id_tipoDato']]=0;
					}else{
						$Max[$row['id_tipoDato']]=$rowMM['maximo'];
					}
					if($rowMM['minimo']==NULL || empty($rowMM['minimo']) || $rowMM['minimo']=='' || !isset($rowMM['minimo']) ){
						$Min[$row['id_tipoDato']]=0;
					}else{
						$Min[$row['id_tipoDato']]=$rowMM['minimo'];					
					}
				}
				$result_MaxMin->free();
				//echo "<br>".$query_MaxMin;
				$query_MaxMin=("SELECT MAX(CAST(dato_principal_2 as unsigned)) as maximo, MIN(CAST(dato_principal_2 as unsigned)) as minimo from planes where id_tipoDato_principal_2=".$row['id_tipoDato']);
				$result_MaxMin=$mysqli->query($query_MaxMin);
				$MaxMin=array();
				while($rowss = $result_MaxMin->fetch_array())
				{
					array_push($MaxMin, $rowss);
				}
				foreach($MaxMin as $rowMM)
				{
					if($Max[$row['id_tipoDato']]<$rowMM['maximo'] &&  $rowMM['maximo'] != NULL && !empty($rowMM['maximo']) &&  $rowMM['maximo'] != ''){
						$Max[$row['id_tipoDato']]=$rowMM['maximo'];
					}
					if($Min[$row['id_tipoDato']]>$rowMM['minimo'] &&  $rowMM['minimo'] != NULL && !empty($rowMM['minimo']) &&  $rowMM['minimo'] != ''){
						$Min[$row['id_tipoDato']]=$rowMM['minimo'];
					}
				}
				$result_MaxMin->free();
				$query_MaxMin=("SELECT MAX(CAST(dato_principal_3 as unsigned)) as maximo, MIN(CAST(dato_principal_3 as unsigned)) as minimo from planes where id_tipoDato_principal_3=".$row['id_tipoDato']);
				$result_MaxMin=$mysqli->query($query_MaxMin);
				$MaxMin=array();
				while($rowss = $result_MaxMin->fetch_array())
				{
					array_push($MaxMin, $rowss);
				}
				foreach($MaxMin as $rowMM)
				{
					if($Max[$row['id_tipoDato']]<$rowMM['maximo'] &&  $rowMM['maximo'] != NULL && !empty($rowMM['maximo']) &&  $rowMM['maximo'] != ''){
						$Max[$row['id_tipoDato']]=$rowMM['maximo'];
					}
					if($Min[$row['id_tipoDato']]>$rowMM['minimo'] &&  $rowMM['minimo'] != NULL && !empty($rowMM['minimo']) &&  $rowMM['minimo'] != ''){
						$Min[$row['id_tipoDato']]=$rowMM['minimo'];
					}
				}
				$result_MaxMin->free();
				$query_MaxMin=("SELECT MAX(CAST(dato_principal_4 as unsigned)) as maximo, MIN(CAST(dato_principal_4 as unsigned)) as minimo from planes where id_tipoDato_principal_4=".$row['id_tipoDato']);
				$result_MaxMin=$mysqli->query($query_MaxMin);
				$MaxMin=array();
				while($rowss = $result_MaxMin->fetch_array())
				{
					array_push($MaxMin, $rowss);
				}
				foreach($MaxMin as $rowMM)
				{
					if($Max[$row['id_tipoDato']]<$rowMM['maximo'] &&  $rowMM['maximo'] != NULL && !empty($rowMM['maximo']) &&  $rowMM['maximo'] != ''){
						$Max[$row['id_tipoDato']]=$rowMM['maximo'];
					}
					if($Min[$row['id_tipoDato']]>$rowMM['minimo'] &&  $rowMM['minimo'] != NULL && !empty($rowMM['minimo']) &&  $rowMM['minimo'] != ''){
						$Min[$row['id_tipoDato']]=$rowMM['minimo'];
					}
				}
				$result_MaxMin->free();

			}
			echo '	<div class="slider-bx">
						<p class="truncate">Rango de Precio</p>
						<div class="slide-bar-bx">
							<div id="slidertest"></div>
							<div class="slide-value-bx">
								<span class="left">$'.(empty($_SESSION["Preciomin"])? 0:number_format($_SESSION["Preciomin"])).'</span>
								<span class="right">$'.(empty($_SESSION["Preciomax"])? 3999:number_format($_SESSION["Preciomax"])).'+</span>
							</div>
						</div>
					</div>
				<script>
					var slider = document.getElementById("slidertest");

			 		noUiSlider.create(slidertest, {
			 		start: ['.(empty($_SESSION["Preciomin"])? 0:$_SESSION["Preciomin"]).', '.(empty($_SESSION["Preciomax"])? 3999:$_SESSION["Preciomax"]).'],
			 		connect: true,
			 		step: 10,
			 		range: {
			 		 "min": '.(empty($_SESSION["Preciomin"])? 0:$_SESSION["Preciomin"]).',
			 		 "max": '.(empty($_SESSION["Preciomax"])? 3999:$_SESSION["Preciomax"]).'
			 		},
			 		  format: wNumb({
			 			decimals: 0
			 		  })
			 		});
			 		slidertest.noUiSlider.on("change", function(){
						console.log("cambia precio");
						CargarPlanesConFiltros();
					})
				</script>
				';

			$i=0;
			foreach($rows as $row)
			{
				//print_r($row);
				$query_verificar_filtros=("SELECT 
								DISTINCT(P.id_plan) 
								FROM planes P 
								INNER JOIN cobertura C ON P.ID_PLAN=C.ID_PLAN 
								INNER JOIN planes_tipoServicios PT ON P.ID_PLAN=PT.ID_PLAN 
								WHERE C.ID_ESTADO=".$_SESSION['estado']." 
								AND PT.id_plan NOT IN (SELECT id_plan FROM planes_tipoServicios WHERE id_tipoServicio IN (SELECT id_tipoServicio from tipoServicios where id_tipoServicio NOT IN (".implode(', ', $_SESSION['Servicios']).") ) ) 
								AND P.visible=1
								AND(
									(P.id_tipoDato_principal_1=".$row['id_tipoDato'].") 
									OR (P.id_tipoDato_principal_2=".$row['id_tipoDato']." ) 
									OR (P.id_tipoDato_principal_3=".$row['id_tipoDato'].") 
									OR (P.id_tipoDato_principal_4=".$row['id_tipoDato']." ) 
									)
								GROUP BY id_plan HAVING count(*) >=".count($_SESSION['Servicios'])." ORDER BY P.precio ASC");
				$Verificar_filtros = $mysqli->query($query_verificar_filtros);
				$numero_filas = mysqli_num_rows($Verificar_filtros);
				//echo "Numero planes con el filtro= ".$numero_filas;
				//echo "Numero planes mostrados= ".$_SESSION['numero_planes'];
				//exit();
				if($numero_filas==$_SESSION['numero_planes'] || isset($_POST['CargaRapida'])){				
				//if(true){
					echo '	<div class="slider-bx">
								<p class="truncate">'.$row["label"].'</p>
								<div class="slide-bar-bx">
									<div id="slidertest'.$i.'"></div>
									<div class="slide-value-bx">
										<span class="left">0</span>
										<span class="right">'.$Max[$row['id_tipoDato']].'</span>
									</div>
								</div>
							</div>
					<script type="text/javascript">
						if(sessionStorage.filtros){
							var getFiltros= JSON.parse(sessionStorage.getItem("filtros"));
						}else{
							var getFiltros = new Array();
						}
						getFiltros.push({id_tipoDato:"'.$row["id_tipoDato"].'",value:"slidertest'.$i.'"});
						//console.log(getFiltros);
						//$.each(getFiltros, function( index, value ) {
							//console.log( value.id_tipoDato+":"+value.value );
						//});
						sessionStorage.setItem("filtros", JSON.stringify(getFiltros));

						var slider = document.getElementById("slidertest'.$i.'");

						noUiSlider.create(slidertest'.$i.', {
						 		start: [0, '.$Max[$row['id_tipoDato']].'],
						 		connect: true,
						 		step: 10,
						 		range: {
						 		 "min": 0,
						 		 "max": '.$Max[$row['id_tipoDato']].'
						 		},
						 		  format: wNumb({
						 			decimals: 0
						 		  })
						 		});
						slidertest'.$i.'.noUiSlider.on("change", function(){
							console.log("cambia slider filtro");
							CargarPlanesConFiltros();
						})
					</script>';
					$i+=1;
				}
			}//foreach
		echo '';
		}//$_POST['CargarFiltros'] Sliders
		if(isset($_POST['CargarFiltrosCheck'])){
			$query= ("SELECT TDS.id_tipoDato,
								TDS.id_tipoServicio, 
								TS.icono as icono_servicio, 
								TDS.label, 
								TDS.tipo,
								TDS.hijoDe,
								TDS.grupo
								FROM tipoDatosServicios TDS 
								INNER JOIN  tipoServicios TS ON TDS.id_tipoServicio=TS.id_tipoServicio
								WHERE TDS.id_tipoServicio IN( 
									SELECT id_tipoServicio
									FROM planes_tipoServicios PTS
									INNER JOIN cobertura C ON PTS.id_plan=C.id_plan 
									WHERE PTS.id_tipoServicio IN (".implode(', ', $_SESSION['Servicios']).") 
									AND PTS.id_plan NOT IN(SELECT id_plan FROM planes_tipoServicios WHERE id_tipoServicio NOT IN (".implode(', ', $_SESSION['Servicios']).")) 
									AND C.id_estado=".$_SESSION['estado'].") 
								AND tipo='boolean' ORDER BY orden ASC");	


			$result = $mysqli->query($query);

			$rows=array();
			while($row = $result->fetch_array())
			{
				array_push($rows, $row);
			}
			$i=1;
			foreach($rows as $row)
			{
				//print_r($row);
				$query_verificar_filtros=("SELECT 
								DISTINCT(P.id_plan) 
								FROM planes P 
								INNER JOIN cobertura C ON P.ID_PLAN=C.ID_PLAN 
								INNER JOIN planes_tipoServicios PT ON P.ID_PLAN=PT.ID_PLAN 
								WHERE C.ID_ESTADO=".$_SESSION['estado']." 
								AND PT.id_plan NOT IN (SELECT id_plan FROM planes_tipoServicios WHERE id_tipoServicio IN (SELECT id_tipoServicio from tipoServicios where id_tipoServicio NOT IN (".implode(', ', $_SESSION['Servicios']).") ) ) 
								AND P.visible=1
								AND(
									(P.id_tipoDato_principal_1=".$row['id_tipoDato'].") 
									OR (P.id_tipoDato_principal_2=".$row['id_tipoDato']." ) 
									OR (P.id_tipoDato_principal_3=".$row['id_tipoDato'].") 
									OR (P.id_tipoDato_principal_4=".$row['id_tipoDato']." ) 
									)
								GROUP BY id_plan HAVING count(*) >=".count($_SESSION['Servicios'])." ORDER BY P.precio ASC");
				$Verificar_filtros = $mysqli->query($query_verificar_filtros);
				$numero_filas = mysqli_num_rows($Verificar_filtros);
				if($numero_filas==$_SESSION['numero_planes'] || $row['id_tipoServicio']==1){
					if($row['hijoDe']==0 && $row['grupo']==0){
						echo '	<p class="truncate">
								<input type="checkbox" onchange="habilitar(this, this.checked);" id="checkbox'.$row["id_tipoDato"].'" />
								<label for="checkbox'.$row["id_tipoDato"].'">'.$row["label"].'</label>
								</p>
								<script type="text/javascript">
								if(sessionStorage.filtrosCheck){
									var getFiltrosCheck= JSON.parse(sessionStorage.getItem("filtrosCheck"));
								}else{
									var getFiltrosCheck = new Array();
								}
								getFiltrosCheck.push({id_tipoDato:"'.$row["id_tipoDato"].'",value:"checkbox'.$row["id_tipoDato"].'"});
								//console.log(getFiltros);
								$.each(getFiltrosCheck, function( index, value ) {
									//console.log( value.id_tipoDato+":"+value.value );
								});
								sessionStorage.setItem("filtrosCheck", JSON.stringify(getFiltrosCheck));
								</script>';
						}
						$i+=1;
				}
			}//END FOREACH
			if(isset($_POST['CargarRedes'])){
				echo '	<p class="truncate">
							<input type="checkbox" onchange="CargarPlanesConFiltros();" id="checkboxRedes" />
							<label for="checkboxRedes">Redes Sociales</label>
						</p>';
			}
		}//END if(isset($_POST['CargarFiltrosCheck']))

		if(isset($_POST['CargarFiltrosCheckCelulares'])){
			$query= ("SELECT TDS.id_tipoDato,
								TDS.id_tipoServicio, 
								TS.icono as icono_servicio, 
								TDS.label, 
								TDS.tipo,
								TDS.hijoDe,
								TDS.grupo
								FROM tipoDatosServicios TDS 
								INNER JOIN  tipoServicios TS ON TDS.id_tipoServicio=TS.id_tipoServicio
								WHERE TDS.id_tipoServicio IN( 
									SELECT id_tipoServicio
									FROM planes_tipoServicios PTS
									INNER JOIN cobertura C ON PTS.id_plan=C.id_plan 
									WHERE PTS.id_tipoServicio IN (".implode(', ', $_SESSION['Servicios']).") 
									AND PTS.id_plan NOT IN(SELECT id_plan FROM planes_tipoServicios WHERE id_tipoServicio NOT IN (".implode(', ', $_SESSION['Servicios']).")) 
									AND C.id_estado=".$_SESSION['estado'].") 
								AND tipo='boolean' ORDER BY orden ASC");

			$result = $mysqli->query($query);

			$rows=array();
			while($row = $result->fetch_array())
			{
				array_push($rows, $row);
			}
			$i=1;
			$respuesta2="";
			$grupo1='	<div class="slider-bx clear-pad-marg">
							<p class="truncate margin-btm-no">Modalidad</p>
								<div class="slide-bar-bx row">
									<div class="col s12">';
			$grupo2='	<div class="slider-bx clear-pad-marg">
							<p class="truncate margin-btm-no">Tipo de Plan</p>
								<div class="slide-bar-bx row">
									<div class="col s12">';
			$grupo3='	<div class="slider-bx clear-pad-marg">
							<p class="truncate margin-btm-no"> &nbsp</p>
								<div class="slide-bar-bx row">
									<div class="col s12">';
			$hayGrupo3=false;
			foreach($rows as $row)
			{
				//print_r($row);
				$query_verificar_filtros=("SELECT 
								DISTINCT(P.id_plan) 
								FROM planes P 
								INNER JOIN cobertura C ON P.ID_PLAN=C.ID_PLAN 
								INNER JOIN planes_tipoServicios PT ON P.ID_PLAN=PT.ID_PLAN 
								WHERE C.ID_ESTADO=".$_SESSION['estado']." 
								AND PT.id_plan NOT IN (SELECT id_plan FROM planes_tipoServicios WHERE id_tipoServicio IN (SELECT id_tipoServicio from tipoServicios where id_tipoServicio NOT IN (".implode(', ', $_SESSION['Servicios']).") ) ) 
								AND P.visible=1
								AND(
									(P.id_tipoDato_principal_1=".$row['id_tipoDato'].") 
									OR (P.id_tipoDato_principal_2=".$row['id_tipoDato']." ) 
									OR (P.id_tipoDato_principal_3=".$row['id_tipoDato'].") 
									OR (P.id_tipoDato_principal_4=".$row['id_tipoDato']." ) 
									)
								GROUP BY id_plan HAVING count(*) >=".count($_SESSION['Servicios'])." ORDER BY P.precio ASC");
				$Verificar_filtros = $mysqli->query($query_verificar_filtros);
				$numero_filas = mysqli_num_rows($Verificar_filtros);
				if($numero_filas==$_SESSION['numero_planes'] || $row['id_tipoServicio']==1){
					if($row['grupo']==1){
						$grupo1=$grupo1.'	
								<input onclick="habilitar(this, this.checked);" class="with-gap" name="group1" type="radio" id="checkbox'.$row["id_tipoDato"].'" />
								<label for="checkbox'.$row["id_tipoDato"].'">'.$row["label"].'</label>
								<script type="text/javascript">
								if(sessionStorage.filtrosCheck){
									var getFiltrosCheck= JSON.parse(sessionStorage.getItem("filtrosCheck"));
								}else{
									var getFiltrosCheck = new Array();
								}
								getFiltrosCheck.push({id_tipoDato:"'.$row["id_tipoDato"].'",value:"checkbox'.$row["id_tipoDato"].'"});
								//console.log(getFiltros);
								$.each(getFiltrosCheck, function( index, value ) {
									//console.log( value.id_tipoDato+":"+value.value );
								});
								sessionStorage.setItem("filtrosCheck", JSON.stringify(getFiltrosCheck));
								</script>';
						}
						if ($row['grupo']==2){
						$grupo2=$grupo2.'
											<input class="checkbox'.$row["hijoDe"].'" type="checkbox" id="checkbox'.$row["id_tipoDato"].'" onchange="CargarPlanesConFiltros();"/>
											<label for="checkbox'.$row["id_tipoDato"].'">'.$row["label"].'</label>
								<script type="text/javascript">
								if(sessionStorage.filtrosCheck){
									var getFiltrosCheck= JSON.parse(sessionStorage.getItem("filtrosCheck"));
								}else{
									var getFiltrosCheck = new Array();
								}
								getFiltrosCheck.push({id_tipoDato:"'.$row["id_tipoDato"].'",value:"checkbox'.$row["id_tipoDato"].'"});
								//console.log(getFiltros);
								$.each(getFiltrosCheck, function( index, value ) {
									//console.log( value.id_tipoDato+":"+value.value );
								});
								sessionStorage.setItem("filtrosCheck", JSON.stringify(getFiltrosCheck));
								</script>';
						}
						if ($row['grupo']==3){
							$hayGrupo3=true;
							$grupo3=$grupo3.'
											<input class="checkbox'.$row["hijoDe"].'" type="checkbox" id="checkbox'.$row["id_tipoDato"].'" onchange="CargarPlanesConFiltros();habilitar(this,this.checked)"/>
											<label for="checkbox'.$row["id_tipoDato"].'">'.$row["label"].'</label>
								<script type="text/javascript">
								if(sessionStorage.filtrosCheck){
									var getFiltrosCheck= JSON.parse(sessionStorage.getItem("filtrosCheck"));
								}else{
									var getFiltrosCheck = new Array();
								}
								getFiltrosCheck.push({id_tipoDato:"'.$row["id_tipoDato"].'",value:"checkbox'.$row["id_tipoDato"].'"});
								//console.log(getFiltros);
								$.each(getFiltrosCheck, function( index, value ) {
									//console.log( value.id_tipoDato+":"+value.value );
								});
								sessionStorage.setItem("filtrosCheck", JSON.stringify(getFiltrosCheck));</script>
							';
						}
						$i+=1;
				}
			}//END FOREACH
			$grupo1=$grupo1.'</div></div></div>';
			$grupo2=$grupo2.'</div></div></div>';
			$grupo3=$grupo3.'</div></div>';
			if($hayGrupo3){
				$respuesta2=$grupo1.$grupo2.$grupo3;
			}else{
				$respuesta2=$grupo1.$grupo2;
			}
			
			echo $respuesta2;
		}//END if(isset($_POST['CargarFiltrosCheckCelulares']))


		if(isset($_POST['CargarFiltrosCheckEmpresas'])){
			$query=("SELECT 
					DISTINCT(E.nombre) as empresa 
				  	FROM empresas E
				  	INNER JOIN planes P ON P.ID_EMPRESA=E.ID_EMPRESA
				  	INNER JOIN cobertura C ON P.ID_PLAN=C.ID_PLAN
				  	INNER JOIN planes_tipoServicios PT ON P.ID_PLAN=PT.ID_PLAN
				  	WHERE C.ID_ESTADO='".$_SESSION['estado']."' 
				  	AND PT.id_plan NOT IN (SELECT id_plan FROM planes_tipoServicios WHERE id_tipoServicio IN (SELECT id_tipoServicio from tipoServicios where id_tipoServicio NOT IN (".implode(', ', $_SESSION['Servicios']).") ) )
				  	AND visible=1
				  	GROUP BY P.id_plan HAVING count(*) >= ".count($_SESSION['Servicios'])." ORDER BY E.ID_EMPRESA
				  	");
			//echo $query;


			$result = $mysqli->query($query);

			$rows=array();
			while($row = $result->fetch_array())
			{
				array_push($rows, $row);
			}
			$i=1;
			foreach($rows as $row)
			{
					echo '	<p class="truncate">
							<input type="checkbox" id="checkboxEmpresas'.$i.'" onchange="CargarPlanesConFiltros();"/>
							<label for="checkboxEmpresas'.$i.'">'.$row["empresa"].'</label>
							</p>
							<script type="text/javascript">
							if(sessionStorage.filtrosCheckEmpresas){
								var getFiltrosCheckEmpresas= JSON.parse(sessionStorage.getItem("filtrosCheckEmpresas"));
							}else{
								var getFiltrosCheckEmpresas = new Array();
							}
							getFiltrosCheckEmpresas.push({empresa:"'.$row["empresa"].'",value:"checkboxEmpresas'.$i.'"});
							//console.log(getFiltros);
							$.each(getFiltrosCheckEmpresas, function( index, value ) {
								//console.log( value.id_tipoDato+":"+value.value );
							});
							sessionStorage.setItem("filtrosCheckEmpresas", JSON.stringify(getFiltrosCheckEmpresas));
						</script>';
						$i+=1;
			}//END FOREACH


		}//if(isset($_POST['CargarFiltrosCheckEmpresas'])){


		/* liberar la serie de resultados */
		$result->free();

	}//ERROR
	echo $respuesta;
}


if(isset($_POST['CargarFiltrosCheckEmpresasConFiltro'])){
	$dato=0;
	if($_POST['CelularPlan']==1){
		$dato=1;
	}
	if($_POST['CelularPrepago']==1){
		$dato=2;
	}
	$query=("SELECT 
			DISTINCT(E.nombre) as empresa
		  	FROM empresas E
		  	INNER JOIN planes P ON P.ID_EMPRESA=E.ID_EMPRESA
		  	INNER JOIN cobertura C ON P.ID_PLAN=C.ID_PLAN
		  	INNER JOIN planes_tipoServicios PT ON P.ID_PLAN=PT.ID_PLAN
		  	WHERE C.ID_ESTADO='".$_SESSION['estado']."'
		  	AND ((P.id_tipoDato_principal_1=".$dato." AND P.dato_principal_1=1) OR (P.id_tipoDato_principal_2=".$dato." AND P.dato_principal_2=1) OR (P.id_tipoDato_principal_3=".$dato." AND P.dato_principal_3=1) OR (P.id_tipoDato_principal_4=".$dato." AND P.dato_principal_4=1))
		  	AND PT.id_plan NOT IN (SELECT id_plan FROM planes_tipoServicios WHERE id_tipoServicio IN (SELECT id_tipoServicio from tipoServicios where id_tipoServicio NOT IN (".implode(', ', $_SESSION['Servicios']).") ) )
		  	AND visible=1
		  	GROUP BY P.id_plan HAVING count(*) >= ".count($_SESSION['Servicios'])." ORDER BY E.ID_EMPRESA
		  	");
	//echo $query;
	//exit();

	$result = $mysqli->query($query);

	$rows=array();
	while($row = $result->fetch_array())
	{
		array_push($rows, $row);
	}
	$i=1;
	foreach($rows as $row)
	{
			echo '	<p class="truncate">
					<input type="checkbox" id="checkboxEmpresas'.$i.'" onchange="CargarPlanesConFiltros();"/>
					<label for="checkboxEmpresas'.$i.'">'.$row["empresa"].'</label>
					</p>
					<script type="text/javascript">
					if(sessionStorage.filtrosCheckEmpresas){
						var getFiltrosCheckEmpresas= JSON.parse(sessionStorage.getItem("filtrosCheckEmpresas"));
					}else{
						var getFiltrosCheckEmpresas = new Array();
					}
					getFiltrosCheckEmpresas.push({empresa:"'.$row["empresa"].'",value:"checkboxEmpresas'.$i.'"});
					//console.log(getFiltros);
					$.each(getFiltrosCheckEmpresas, function( index, value ) {
						//console.log( value.id_tipoDato+":"+value.value );
					});
					sessionStorage.setItem("filtrosCheckEmpresas", JSON.stringify(getFiltrosCheckEmpresas));
				</script>';
				$i+=1;
	}//END FOREACH


}//if(isset($_POST['CargarFiltrosCheckEmpresasConFiltro'])){

if(isset($_POST['verDetalles'])){
	if(isset($_POST['id_plan'])){
		$query=("SELECT 
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
		P.pdf_canalesTV, 
		P.fecha_actualizacion,
		P.id_empresa,
		E.nombre as empresa, 
		E.codigo_color as empresa_color,
		TDS1.label as dato1,
		TDS1.tipo as tipoDato1,
		TDS2.label as dato2,
		TDS2.tipo as tipoDato2,
		TDS3.label as dato3,
		TDS3.tipo as tipoDato3,
		TDS4.label as dato4,
		TDS4.tipo as tipoDato4
	  	FROM planes P
	  	INNER JOIN empresas E ON P.ID_EMPRESA=E.ID_EMPRESA
	  	INNER JOIN cobertura C ON P.ID_PLAN=C.ID_PLAN
	  	INNER JOIN planes_tipoServicios PT ON P.ID_PLAN=PT.ID_PLAN
  		LEFT JOIN tipoDatosServicios TDS1 ON P.id_tipoDato_principal_1 = TDS1.id_tipoDato 
	  	LEFT JOIN tipoDatosServicios TDS2 ON P.id_tipoDato_principal_2 = TDS2.id_tipoDato 
	  	LEFT JOIN tipoDatosServicios TDS3 ON P.id_tipoDato_principal_3 = TDS3.id_tipoDato 
	  	LEFT JOIN tipoDatosServicios TDS4 ON P.id_tipoDato_principal_4 = TDS4.id_tipoDato 
	  	WHERE P.id_plan=".$_POST['id_plan']);


		$result = $mysqli->query($query);

		$rows=array();
		while($row = $result->fetch_array())
		{
			//array_push($rows, $row);
			$respuesta='<div id="plan_detalles" data-id="'.$row["id_plan"].'" class="brand-label" style="background-color:'.$row["empresa_color"].'">'.$row["empresa"].'</div>
				<h4>'.$row["nombre"].' - ';

			if($row['id_tipoDato_principal_1']==2 || $row['id_tipoDato_principal_2']==2 || $row['id_tipoDato_principal_3']==2 || $row['id_tipoDato_principal_4']==2){
				if ($row["precio"]==0){
					$respuesta=$respuesta.'Sin Recarga Mínima';
				}else{
					$respuesta=$respuesta.'Recarga de $'.number_format($row["precio"]);
				}
			}else{
				$respuesta=$respuesta.'$'.number_format($row["precio"]);
			}

			$respuesta=$respuesta.'
				</h4>
				<div class="plan-main-options row">';

				switch ($row['tipoDato1']) {
					//$respuesta=$respuesta.'<div class="col s6 m3">';
				    case "texto":
						$respuesta=$respuesta.'<div class="col s6 m3"><p>'.$row["dato_principal_1"].'</p></div>';

				        break;
				    case "integer":
						$respuesta=$respuesta.'<div class="col s6 m3"><p>'.$row["dato_principal_1"].' '.$row["dato1"].'</p></div>';
				        break;
				    case "boolean":
						$respuesta=$respuesta.'<div class="col s6 m3"><p>'.$row["dato1"].'</p></div>';
				        break;
				}
				switch ($row['tipoDato2']) {
				    case "texto":
						$respuesta=$respuesta.'<div class="col s6 m3"><p>'.$row["dato_principal_2"].'</p></div>';

				        break;
				    case "integer":
						$respuesta=$respuesta.'<div class="col s6 m3"><p>'.$row["dato_principal_2"].' '.$row["dato2"].'</p></div>';
				        break;
				    case "boolean":
						$respuesta=$respuesta.'<div class="col s6 m3"><p>'.$row["dato2"].'</p></div>';
				        break;
				}
				switch ($row['tipoDato3']) {
				    case "texto":
						$respuesta=$respuesta.'<div class="col s6 m3"><p>'.$row["dato_principal_3"].'</p></div>';

				        break;
				    case "integer":
						$respuesta=$respuesta.'<div class="col s6 m3"><p>'.$row["dato_principal_3"].' '.$row["dato3"].'</p></div>';
				        break;
				    case "boolean":
						$respuesta=$respuesta.'<div class="col s6 m3"><p>'.$row["dato3"].'</p></div>';
				        break;
				}
				switch ($row['tipoDato4']) {
				    case "texto":
						$respuesta=$respuesta.'<div class="col s6 m3"><p>'.$row["dato_principal_4"].'</p></div>';

				        break;
				    case "integer":
						$respuesta=$respuesta.'<div class="col s6 m3"><p>'.$row["dato_principal_4"].' '.$row["dato4"].'</p></div>';
				        break;
				    case "boolean":
						$respuesta=$respuesta.'<div class="col s6 m3"><p>'.$row["dato4"].'</p></div>';
				        break;
				}
				$respuesta=$respuesta.'
				</div>';
				if(isset($_POST["celular"])){
					if($_POST["celular"]==1){
						$query_redesSociales="SELECT PRS.id_redSocial,
							RS.nombre
							FROM planes_redesSociales PRS
							INNER JOIN redesSociales RS ON PRS.id_redSocial=RS.id_redSocial 
							WHERE PRS.id_plan=".$row["id_plan"];
						$result_redesSociales = $mysqli->query($query_redesSociales);
						$numero_filasRS = mysqli_num_rows($result_redesSociales);
						if($numero_filasRS>0){
							$respuesta=$respuesta.'<h5>Redes Sociales</h5>';
							while($rowRedSocial = $result_redesSociales->fetch_array())
							{
								$respuesta=$respuesta.'<li>'.$rowRedSocial["nombre"].'</li>';
							} 
						}
						$respuesta=$respuesta.'						
						<h5>Opciones y características adicionales</h5>
						<p>'.$row['mas_datos'].'</p>';

						//Buscar celulares en tabla planes_celulares para la vista de los equipos asociados al plan.
						$query_equipos=("SELECT PC.id_celular,
										PC.precio_12m,
				 						PC.precio_18m,
				 						PC.precio_24m,
				 						PC.precio_prepago,
				 						PC.orden,
				 						CEL.foto,
				 						CEL.nombre 
				 						FROM planes_celulares PC
				 						INNER JOIN celularesMasPopulares CEL ON PC.id_celular=CEL.id_celular
				 						WHERE id_plan=".$row["id_plan"]);
				 		//echo $query_equipos;
				 		$result_equipos = $mysqli->query($query_equipos);
						$numero_filasEquipos = mysqli_num_rows($result_equipos);
						if($numero_filasEquipos>0){
							$respuesta=$respuesta.'
							<h5>Equipos Recomendados:</h5>
							<ul class="collapsible popout info-collapsible acordionEquipos" data-collapsible="accordion">';
							while($rowEquipos = $result_equipos->fetch_array())
							{	
								$respuesta=$respuesta.'
								<li>
									<div class="collapsible-header active">
										<img class="phone-th z-depth-1" src="http://www.eligefacil.com/uploads/celulares_mas_populares/'.$rowEquipos["id_celular"].'/'.$rowEquipos["foto"].'" alt="" /> 
										<b class="phone-title">'.$rowEquipos["nombre"].'</b>
									</div>
									<div class="collapsible-body">
										<div class="row">
											<div class="col s3 hide-on-med-and-down">
												<img class="responsive-img" src="../../uploads/celulares_mas_populares/'.$rowEquipos["id_celular"].'/'.$rowEquipos["foto"].'" alt="" /> 
											</div>
											<div class="col s12 m9">
												<table class="responsive-table striped centered">
													<thead>
														<tr>
															<th data-field="id"><b>Plazo Forzoso</b></th>
															<th data-field="name"><b>Costo Equipo</b></th>
															<th data-field="price"><b>Total Acumulado</b></th>
														</tr>
													</thead>
													<tbody>';
													if($rowEquipos["precio_12m"]!=-1){
														$respuesta.='<tr>
															<td>12</td>';
															if($rowEquipos["precio_12m"]>0){
																$respuesta.='<td>$'.number_format($rowEquipos["precio_12m"]).'</td>';
															}else{
																$respuesta.='<td>GRATIS</td>';
															}
															$Acumulado_celular=($row["precio"]*12)+$rowEquipos["precio_12m"];
															$respuesta.='<td class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Costo del equipo + 12 Rentas">$'.number_format($Acumulado_celular).'</td>
														</tr>';
													}
													if($rowEquipos["precio_18m"]!=-1){
														$respuesta.='<tr>
															<td>18</td>';
															if($rowEquipos["precio_18m"]>0){
																$respuesta.='<td>$'.number_format($rowEquipos["precio_18m"]).'</td>';
															}else{
																$respuesta.='<td>GRATIS</td>';
															}
															$Acumulado_celular=($row["precio"]*18)+$rowEquipos["precio_18m"];
															$respuesta.='<td class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Costo del equipo + 18 Rentas">$'.number_format($Acumulado_celular).'</td>
														</tr>';
													}
													if($rowEquipos["precio_24m"]!=-1){
														$respuesta.='<tr>
															<td>24</td>';
															if($rowEquipos["precio_24m"]>0){
																$respuesta.='<td>$'.number_format($rowEquipos["precio_24m"]).'</td>';
															}else{
																$respuesta.='<td>GRATIS</td>';
															}
															$Acumulado_celular=($row["precio"]*24)+$rowEquipos["precio_24m"];
															$respuesta.='<td class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Costo del equipo + 24 Rentas">$'.number_format($Acumulado_celular).'</td>
														</tr>';
													}
														$respuesta.='<tr>
															<td>Prepago</td>';
															if($rowEquipos["precio_prepago"]>0){
																$respuesta.='<td class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Costo del equipo">$'.number_format($rowEquipos["precio_prepago"]).'</td>';
															}else{
																$respuesta.='<td class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Costo del equipo">GRATIS</td>';
															}
															$respuesta.='<td>No aplica</td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</li>';
							}
							/*
							$respuesta.='</ul>
							<div>
								<a href="#contractModal" onclick="contratar(\''.$row['id_plan'].'\',\''.$row["nombre"].'\',\''.$row["id_empresa"].'\',\''.$_POST["estado"].'\'),$(\'#deatilsModal\').closeModal()" class="waves-effect waves-light btn orange modal-trigger">Contratar <i class="material-icons">done</i>
								</a>
							</div>';
							*/
							$respuesta.='</ul>
							<form action="#">
								 <input id="MeGustariaContratar" type="checkbox" name="contratar" class="MeGustariaContratarClass" value="true" data-idPlan="'.$row['id_plan'].'"> <label for="MeGustariaContratar">Me gustaría contratar aquí</label>
							</form>';
						}else{
							/*
							$respuesta.='
								<div>
									<a href="#contractModal" onclick="contratar(\''.$row['id_plan'].'\',\''.$row["nombre"].'\',\''.$row["id_empresa"].'\',\''.$_POST["estado"].'\'),$(\'#deatilsModal\').closeModal()" class="waves-effect waves-light btn orange modal-trigger">Contratar <i class="material-icons">done</i>
									</a>
								</div>';
							*/
							$respuesta.='
							<form action="#">
								 <input id="MeGustariaContratar" type="checkbox" class="MeGustariaContratarClass" name="contratar" value="true" data-idPlan="'.$row['id_plan'].'"> <label for="MeGustariaContratar">Me gustaría contratar aquí</label>
							</form>';
						}
					}
				}else{
					/*
					$respuesta.='
						<h5>Opciones y características adicionales</h5>
						'.$row['mas_datos'].'
						<div>
							<a href="#contractModal" onclick="contratar(\''.$row['id_plan'].'\',\''.$row["nombre"].'\',\''.$row["id_empresa"].'\',\''.$_POST["estado"].'\'),$(\'#deatilsModal\').closeModal()" class="waves-effect waves-light btn orange modal-trigger">Contratar <i class="material-icons">done</i>
							</a>
						</div>
						';
					*/
					$respuesta.='
						<h5>Opciones y características adicionales</h5>
						'.$row['mas_datos'].'
						<form action="#">
							<input id="MeGustariaContratar" type="checkbox" class="MeGustariaContratarClass" name="contratar" value="true" data-idPlan="'.$row['id_plan'].'"> <label for="MeGustariaContratar">Me gustaría contratar aquí</label>
						</form>
						';
					//Pdf Canales
					if(!empty($row["pdf_canalesTV"])){
						$respuesta.='<a href="http://eligefacil.com/uploads/planes/'.$row["id_plan"].'/pdf_canalesTV/'.$row["pdf_canalesTV"].'" class="btn waves-effect orange accent-4" target="_blank">Ver lista de canales</a>
								<div class="clearfix"></div>
								<br />';
					}
				}
			$urlShare="http://www.eligefacil.com/listado-comparador.php?l=".$_POST["estado"];
			$urlFBShare="http://www.eligefacil.com/fb_details_share.php?l=".$_POST["estado"];
			if($_POST["celular"]==1){
				$urlShare.="&s[]=1";
				$urlFBShare.="&s[]=1";
			}
			if($_POST["telefono"]==1){
				$urlShare.="&s[]=2";
				$urlFBShare.="&s[]=2";
			}
			if($_POST["internet"]==1){
				$urlShare.="&s[]=3";
				$urlFBShare.="&s[]=3";
			}
			if($_POST["television"]==1){
				$urlShare.="&s[]=4";
				$urlFBShare.="&s[]=4";
			}
			$urlShare.="&plan[]=".$row["id_plan"];
			$urlFBShare.="&plan[]=".$row["id_plan"];
			$url=urlencode($urlShare);
			$urlFB=urlencode($urlFBShare);

			$footer.='
			<div class="modal-footer">
							<a href="#!" class="modal-action modal-close waves-effect btn-flat grey white-text" id="plan_'.$row["id_plan"].'" onclick="Comparar(this,'.$row["id_plan"].','."'".$row["empresa_color"]."'".'); $(\'.lean-overlay\').remove()">Comparar</a>
							<a href="#!" class="modal-action modal-close waves-effect btn-flat " onclick="$(\'.lean-overlay\').remove()">Cerrar</a>
						</div>
						<div class="fixed-action-btn" style="bottom: 10px; right: 10px;">
						<a class="btn-floating btn-large orange accent-4">
						 <i class="fa fa-share-alt"></i>
					   </a>
						<ul>
							<li>
								<a href="https://www.facebook.com/sharer/sharer.php?u='.$urlFB.'" target="_blank" class="btn-floating light-blue darken-4"><i class="fa fa-facebook"></i></a>
							</li>
							<li>
								<a href="https://twitter.com/home?status='.$urlFB.'" target="_blank" class="btn-floating light-blue lighten-2"><i class="fa fa-twitter"></i></a>
							</li>
							<li>
								<a onclick="ShareSingle('.$row["id_plan"].')" data-target="modalMailShare" class="btn-floating grey darken-1 btn modal-trigger" href="#modalMailShare"><i class="fa fa-envelope"></i></a>
							</li>
							<li id="btnImprimir">
								<a href="print-paq.php?plan='.$row["id_plan"].'" onclick="ImprimirPlan(this,'.$row["id_plan"].')" class="btn-floating red accent-4" target="_blank"><i class="fa fa-print"></i></a>
							</li>
						</ul>
					</div>
					<br><br>

					';
			$respuesta.='<br><br><div>Fecha de actualización: '.date('d/m/Y',strtotime($row['fecha_actualizacion'])).'</div><br><br>';
		}
		$miArray = array("contenido"=>$respuesta, "footer"=>$footer);
		echo json_encode($miArray);
		//echo $respuesta;

		/* liberar la serie de resultados */
		$result->free();
  	}
}//if(isset($_POST['verDetalles']))

if (isset($_POST['filtros'])) {
//CARGAR PLANES CON LOS FILTROS
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
			E.codigo_color as empresa_color,
			TDS1.label as dato1,
			TDS1.tipo as tipoDato1,
			TDS2.label as dato2,
			TDS2.tipo as tipoDato2,
			TDS3.label as dato3,
			TDS3.tipo as tipoDato3,
			TDS4.label as dato4,
			TDS4.tipo as tipoDato4
		  	FROM planes P
		  	INNER JOIN empresas E ON P.ID_EMPRESA=E.ID_EMPRESA ";
		  	if (isset($_POST["redesSociales"])){
		  		if($_POST["redesSociales"] == 1){
		  			$query_filtros=$query_filtros."INNER JOIN planes_redesSociales PRS ON P.id_plan=PRS.id_plan ";
		  		}
		  	}
		  	$query_filtros=$query_filtros."
		  	INNER JOIN cobertura C ON P.ID_PLAN=C.ID_PLAN
		  	INNER JOIN planes_tipoServicios PT ON P.ID_PLAN=PT.ID_PLAN
		  	LEFT JOIN tipoDatosServicios TDS1 ON P.id_tipoDato_principal_1 = TDS1.id_tipoDato 
		  	LEFT JOIN tipoDatosServicios TDS2 ON P.id_tipoDato_principal_2 = TDS2.id_tipoDato 
		  	LEFT JOIN tipoDatosServicios TDS3 ON P.id_tipoDato_principal_3 = TDS3.id_tipoDato 
		  	LEFT JOIN tipoDatosServicios TDS4 ON P.id_tipoDato_principal_4 = TDS4.id_tipoDato 
	  	WHERE C.ID_ESTADO=".$_SESSION['estado']."
	  	AND PT.id_plan NOT IN (SELECT id_plan FROM planes_tipoServicios WHERE id_tipoServicio IN (SELECT id_tipoServicio from tipoServicios where id_tipoServicio NOT IN (".implode(', ', $_SESSION['Servicios'])." ) ))
	  	AND P.visible=1
	";
    $Filtros = $_POST['filtros'];
    //print_r($_POST['filtros']);
    $contEmpresas=0;
    $queryEmpresas="";
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
        if($fil->tipo=='precio'){
        	$query_filtros=$query_filtros." AND (P.precio>=".$fil->Minimo." AND P.precio<=".$fil->Maximo.")";
        }
        if($fil->tipo=='checkEmpresas'){
        	if($contEmpresas==0){
        		$queryEmpresas=" AND (E.nombre = '".$fil->empresa."'";
        		$contEmpresas=1;
        	}else{
        		$queryEmpresas=$queryEmpresas." OR E.nombre = '".$fil->empresa."'";
        	}
        }
        //ChromePhp::log("Nome: " . $usr->nome . " - Idade: " . $usr->idade);
    }
    if($contEmpresas>0){
    	$query_filtros=$query_filtros.$queryEmpresas.") ";
    }
    $query_filtros=$query_filtros."GROUP BY P.id_plan HAVING count(*) >= ".count($_SESSION['Servicios']);
  	//echo $query_filtros;
  	//exit();
	//$result = $mysqli->query($query);
  	$result_filtros = $mysqli->query($query_filtros);
	//$_SESSION['numero_planes']=mysqli_num_rows($result_filtros);				
	$_SESSION['Preciomax']=0;
	$_SESSION['Preciomin']=-1;
	$rows=array();
	while($row = $result_filtros->fetch_array())
	{
		array_push($rows, $row);
		$row["sugerido"]=0;
		if($_SESSION['Preciomin']==-1){
			$_SESSION['Preciomax']=$row['precio'];
			$_SESSION['Preciomin']=$row['precio'];
		}else{
			if($row['precio']>$_SESSION['Preciomax']){
				$_SESSION['Preciomax']=$row['precio'];
			}
			if($row['precio']<$_SESSION['Preciomin']){
				$_SESSION['Preciomin']=$row['precio'];
			}
		}
	}
	//$_SESSION['Preciomax']=0;
	//$_SESSION['Preciomin']=-1;
	//Query y funcionalidad para meter planes sugeridos
	/*$query_filtros_sugeridos="SELECT 
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
			E.codigo_color as empresa_color,
			TDS1.label as dato1,
			TDS1.tipo as tipoDato1,
			TDS2.label as dato2,
			TDS2.tipo as tipoDato2,
			TDS3.label as dato3,
			TDS3.tipo as tipoDato3,
			TDS4.label as dato4,
			TDS4.tipo as tipoDato4
		  	FROM planes P
		  	INNER JOIN empresas E ON P.ID_EMPRESA=E.ID_EMPRESA
		  	INNER JOIN cobertura C ON P.ID_PLAN=C.ID_PLAN
		  	INNER JOIN planes_tipoServicios PT ON P.ID_PLAN=PT.ID_PLAN
		  	LEFT JOIN tipoDatosServicios TDS1 ON P.id_tipoDato_principal_1 = TDS1.id_tipoDato 
		  	LEFT JOIN tipoDatosServicios TDS2 ON P.id_tipoDato_principal_2 = TDS2.id_tipoDato 
		  	LEFT JOIN tipoDatosServicios TDS3 ON P.id_tipoDato_principal_3 = TDS3.id_tipoDato 
		  	LEFT JOIN tipoDatosServicios TDS4 ON P.id_tipoDato_principal_4 = TDS4.id_tipoDato 
	  	WHERE C.ID_ESTADO=".$_SESSION['estado']."
	  	AND PT.id_plan IN (SELECT id_plan FROM planes_tipoServicios WHERE id_tipoServicio IN (".implode(', ', $_SESSION['Servicios'])." ) )
	  	AND P.visible=1
	  	AND P.precio<".$_SESSION['Preciomax']."+80 
	";
    $Filtros = $_POST['filtros'];
    //print_r($_POST['filtros']);
    $contEmpresas=0;
    $queryEmpresas="";
    foreach ($Filtros as $filtro) {
        # code...
        $fil = json_decode($filtro);
        if($fil->tipo=='slider'){

        	$query_filtros_sugeridos=$query_filtros_sugeridos." AND ((P.id_tipoDato_principal_1=".$fil->id_tipoDato." AND P.dato_principal_1>=".$fil->Menor." AND P.dato_principal_1<=".$fil->Mayor.")
		  		OR (P.id_tipoDato_principal_2=".$fil->id_tipoDato." AND P.dato_principal_2>=".$fil->Menor." AND P.dato_principal_2<=".$fil->Mayor.")
		  		OR (P.id_tipoDato_principal_3=".$fil->id_tipoDato." AND P.dato_principal_3>=".$fil->Menor." AND P.dato_principal_3<=".$fil->Mayor.")
		  		OR (P.id_tipoDato_principal_4=".$fil->id_tipoDato." AND P.dato_principal_4>=".$fil->Menor." AND P.dato_principal_4<=".$fil->Mayor.")
	  		)";
        }
        if($fil->tipo=='check'){
        	$query_filtros_sugeridos=$query_filtros_sugeridos." AND ((P.id_tipoDato_principal_1=".$fil->id_tipoDato." AND P.dato_principal_1=1 )
	  		OR (P.id_tipoDato_principal_2=".$fil->id_tipoDato." AND P.dato_principal_2=1 )
	  		OR (P.id_tipoDato_principal_3=".$fil->id_tipoDato." AND P.dato_principal_3=1 )
	  		OR(P.id_tipoDato_principal_4=".$fil->id_tipoDato." AND P.dato_principal_4=1 )
	  		)";
        }

        if($fil->tipo=='checkEmpresas'){
        	if($contEmpresas==0){
        		$queryEmpresas=" AND (E.nombre = '".$fil->empresa."'";
        		$contEmpresas=1;
        	}else{
        		$queryEmpresas=$queryEmpresas." OR E.nombre = '".$fil->empresa."'";
        	}
        }
        //ChromePhp::log("Nome: " . $usr->nome . " - Idade: " . $usr->idade);
    }
    if($contEmpresas>0){
    	$query_filtros_sugeridos=$query_filtros_sugeridos.$queryEmpresas.") ";
    }
    $query_filtros_sugeridos=$query_filtros_sugeridos."GROUP BY P.id_plan HAVING count(*) >= ".count($_SESSION['Servicios'])."+1 LIMIT 0, 10
";

  	$result_filtros_sugeridos = $mysqli->query($query_filtros_sugeridos);

	while($row = $result_filtros_sugeridos->fetch_array())
	{		
		$row["sugerido"]=1;
		array_push($rows, $row);
	}
*/
	if($_POST["orden"]=="DESC"){
		usort($rows,'invenDescSort');
	}
	if($_POST["orden"]=="ASC"){
		usort($rows,'invenAscSort');
	}
	$i=0;
	$random=0;
	$publicidad=mt_rand(2,4);
	foreach($rows as $row)
	{	
		//print_r($row);
		/*
		if($_SESSION['Preciomin']==-1){
			$_SESSION['Preciomax']=$row['precio'];
			$_SESSION['Preciomin']=$row['precio'];
		}else{
			if($row['precio']>$_SESSION['Preciomax']){
				$_SESSION['Preciomax']=$row['precio'];
			}
			if($row['precio']<$_SESSION['Preciomin']){
				$_SESSION['Preciomin']=$row['precio'];
			}
		}
		*/	
		if($random==$publicidad){
			$respuesta=$respuesta.'	<div id="cargarmas'.$i.'" class="col s12 m6 l4 paq-list-bx cargarmas">
										<div class="paq-content-bx banner-ovrflw">
											<a href="http://www.eligefacil.com" target="_blank" class="go-banner"></a>
											<img src="images/promo-grid.jpg" alt="" class="banner-art" />
											<img src="images/promo-grid.jpg" alt="" class="banner-art" />
										</div>
									</div>';
			$i+=1;
		}
		$random+=1;
		if($random==5 ){
			$random=0;
			$publicidad=mt_rand(2,4);
		}	
	
		$query_tipoServicio="SELECT id_tipoServicio FROM planes_tipoServicios WHERE id_plan=".$row["id_plan"];
				$result_tipoServicio = $mysqli->query($query_tipoServicio);
				$filas=array();
				$respuesta=$respuesta.'
					<div id="cargarmas'.$i.'" class="col s12 m6 l4 paq-list-bx cargarmas">
						<div class="paq-content-bx">
							<div class="comparando-icons">';
				while($fila = $result_tipoServicio->fetch_array())
				{
					//array_push($filas, $fila);
					if($fila["id_tipoServicio"]==1){
						$respuesta=$respuesta.'<i class="material-icons iconosPlanes">phone_android</i>';
					}
					if($fila["id_tipoServicio"]==2){
						$respuesta=$respuesta.'<i class="material-icons iconosPlanes">phone</i>';
					}
					if($fila["id_tipoServicio"]==3){
						$respuesta=$respuesta.'<i class="material-icons iconosPlanes">wifi</i>';
					}
					if($fila["id_tipoServicio"]==4){
						$respuesta=$respuesta.'<i class="material-icons iconosPlanes">tv</i>';
					}
				}

				$respuesta=$respuesta.'</div>
						<div class="brand-label" style="background-color:'.$row["empresa_color"].'">'.$row["empresa"].'</div>
						';
				$respuesta=$respuesta.'
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
									if(isset($_POST["celular"])){
										if($_POST["celular"]==1){
											$query_redesSociales="SELECT PRS.id_redSocial,
												RS.nombre
												FROM planes_redesSociales PRS
												INNER JOIN redesSociales RS ON PRS.id_redSocial=RS.id_redSocial 
												WHERE PRS.id_plan=".$row["id_plan"];
											$result_redesSociales = $mysqli->query($query_redesSociales);
											$numero_filasRS = mysqli_num_rows($result_redesSociales);
											if($numero_filasRS>0){
												$respuesta=$respuesta.'<li>Redes Sociales</li>';
												while($rowRedSocial = $result_redesSociales->fetch_array())
												{
													$respuesta=$respuesta.'<li>('.$rowRedSocial["nombre"].')</li>';
												} 
											}
										}
									}
							$respuesta=$respuesta.'</ul>
						</div>';
						
						if($row['id_tipoDato_principal_1']==2 || $row['id_tipoDato_principal_2']==2 || $row['id_tipoDato_principal_3']==2 || $row['id_tipoDato_principal_4']==2){
							if ($row["precio"]==0){
								if($row["sugerido"]==1){
									$respuesta.='<div class="paq-price sgrdo lngtxt">';
								}else{
									$respuesta.='<div class="paq-price lngtxt">';
								}
								$respuesta=$respuesta.'Sin Recarga Mínima';
							}else{
								if($row["sugerido"]==1){
									$respuesta.='<div class="paq-price sgrdo lngtxt">';
								}else{
									$respuesta.='<div class="paq-price lngtxt">';
								}
								$respuesta=$respuesta.'Recarga de $'.number_format($row["precio"]);
							}
						}else{
							if($row["sugerido"]==1){
								$respuesta.='<div class="paq-price sgrdo">';
							}else{
								$respuesta.='<div class="paq-price">';
							}
							$respuesta=$respuesta.'$'.number_format($row["precio"]);
						}
						if($row["sugerido"]==1){
							$respuesta=$respuesta."<p><span style='color: #FFF'>Sugerencia Elige Fácil</span></p>";
						}
						$respuesta=$respuesta.'</div>
						<div id="botonesPlan" class="more-actions-bx">
							<a id="verPlan" href="#deatilsModal" class="modal-trigger waves-effect verpla_'.$row["id_plan"].'" data-value="'.$row["id_plan"].'">Ver detalles</a>
							<a href="#!" class="compare-slct" id="plan_'.$row["id_plan"].'" onclick="Comparar(this,'.$row["id_plan"].','."'".$row["empresa_color"]."'".')">Comparar <i class="material-icons">done</i></a>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>';	
	$i+=1;
	}//foreach
echo $respuesta;
}//if (isset($_POST['filtros']))

if(isset($_POST['SelectDeEstados'])){
	$query="SELECT * from estados";
				   	   

						$result = $mysqli->query($query);
						echo '<div id="SelectEstadosPHP" class="input-field col s12">
				   				<select id="selectEstado" class="browser-default">';
				   		if(!isset($_POST['estado'])){
		   	    			echo '<option value="-1" selected="selected">Seleccione un Estado</option>';
		   	    			$issetEstado=0;
				   		}else{
				   			$issetEstado=1;
				   		}
						while($row = $result->fetch_array())
						{
							$rows[] = $row;
						}

						foreach($rows as $row)
						{
							//print_r($row);
							if($issetEstado!=0){
								if($row['id_estado']==$_POST['estado']){
									echo "<option selected='selected' value=".$row['id_estado'].">".$row['nombre']."</option>";
								}else{
									echo "<option value=".$row['id_estado'].">".$row['nombre']."</option>";
								}
							}else{
								echo "<option value=".$row['id_estado'].">".$row['nombre']."</option>";
							}
						}
						echo "</select>";
						/* liberar la serie de resultados */
						$result->free();
}

if(isset($_POST['CompararPlanes'])){
	if(isset($_POST['id_plan'])){
		$query=("SELECT 
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
		E.codigo_color as empresa_color,
		TDS1.label as dato1,
		TDS1.tipo as tipoDato1,
		TDS2.label as dato2,
		TDS2.tipo as tipoDato2,
		TDS3.label as dato3,
		TDS3.tipo as tipoDato3,
		TDS4.label as dato4,
		TDS4.tipo as tipoDato4,
		P.id_empresa
	  	FROM planes P
	  	INNER JOIN empresas E ON P.ID_EMPRESA=E.ID_EMPRESA
	  	INNER JOIN cobertura C ON P.ID_PLAN=C.ID_PLAN
	  	INNER JOIN planes_tipoServicios PT ON P.ID_PLAN=PT.ID_PLAN
	  	LEFT JOIN tipoDatosServicios TDS1 ON P.id_tipoDato_principal_1 = TDS1.id_tipoDato 
	  	LEFT JOIN tipoDatosServicios TDS2 ON P.id_tipoDato_principal_2 = TDS2.id_tipoDato 
	  	LEFT JOIN tipoDatosServicios TDS3 ON P.id_tipoDato_principal_3 = TDS3.id_tipoDato 
	  	LEFT JOIN tipoDatosServicios TDS4 ON P.id_tipoDato_principal_4 = TDS4.id_tipoDato 
	  	WHERE P.id_plan=".$_POST['id_plan']);


		$result = $mysqli->query($query);

		$rows=array();
		while($row = $result->fetch_array())
		{
			//array_push($rows, $row);
			$respuesta='<div class="item" id="'.$row["id_plan"].'">
						<div class="col s12 paq-list-bx compare-status">
							<div class="paq-content-bx">
								<div class="brand-label" style="background-color:'.$row["empresa_color"].'">'.$row["empresa"].'</div>
								<div class="paq-bx paq-comparado paq-comparado'.$_POST["num_plan_comp"].'">
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
										$query_redesSociales="SELECT PRS.id_redSocial,
											RS.nombre
											FROM planes_redesSociales PRS
											INNER JOIN redesSociales RS ON PRS.id_redSocial=RS.id_redSocial 
											WHERE PRS.id_plan=".$row["id_plan"];
										$result_redesSociales = $mysqli->query($query_redesSociales);
										$numero_filasRS = mysqli_num_rows($result_redesSociales);
										if($numero_filasRS>0){
											$respuesta=$respuesta.'<li>Redes Sociales</li>';
											while($rowRedSocial = $result_redesSociales->fetch_array())
											{
												$respuesta=$respuesta.'<li>('.$rowRedSocial["nombre"].')</li>';
											} 
										}
			$respuesta=$respuesta.'</ul>'.$row["mas_datos"].'

								</div>
								<div style="padding-left:15px;padding-bottom:15px;">
									<form action="#">
										 <input id="MeGustariaContratar'.$row['id_plan'].'" type="checkbox" class="MeGustariaContratarClass" name="contratar" value="true" data-idPlan="'.$row['id_plan'].'"> <label for="MeGustariaContratar'.$row['id_plan'].'" style="font-size: ;">Me gustaría contratar</label>
									</form>
								</div>';
			if($row['id_tipoDato_principal_1']==2 || $row['id_tipoDato_principal_2']==2 || $row['id_tipoDato_principal_3']==2 || $row['id_tipoDato_principal_4']==2){
				if ($row["precio"]==0){
					$respuesta=$respuesta.'<div class="paq-price">Sin Recarga Mínima</div>';
				}else{
					$respuesta=$respuesta.'<div class="paq-price">Recarga de $'.number_format($row["precio"]).'</div>';
				}
			}else{
				$respuesta=$respuesta.'<div class="paq-price">$'.number_format($row["precio"]).'</div>';
			}
//<div class="paq-price">$'.$row["precio"].'</div>
			/*$respuesta=$respuesta.'	<div class="more-actions-bx comparetratation">
									<a href="#!" onclick="eliminarDelComparador('.$row["id_plan"].')" class="grey white-text text-white">Eliminar</a>
									<a href="#contractModal" onclick="contratar(\''.$row['id_plan'].'\',\''.$row["nombre"].'\',\''.$row["id_empresa"].'\',\''.$_POST["estado"].'\')" class="compare-slct orange accent-4 modal-trigger">Contratar <i class="material-icons">done</i></a>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
					</div>';
			*/
			$respuesta=$respuesta.'	
									<div class="more-actions-bx comparetratation">
									<a href="#!" class="grey"></a>
									<a href="#!" class="compare-slct grey"></a>
									<a href="#!" onclick="eliminarDelComparador('.$row["id_plan"].')" class="compare-delete">Eliminar</a>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
					</div>';	
		}
		echo $respuesta;


		/* liberar la serie de resultados */
		$result->free();
  	}
}//if(isset($_POST['CompararPlanes']))

if(isset($_POST['CargarPlanesStreaming'])){
	$query="SELECT 
			P.id_paquete,
			P.nombre,
			P.id_empresa,
			P.precio,
			P.dato_principal_1,
			P.dato_principal_2,
			P.dato_principal_3,
			P.dato_principal_4,
			P.mas_datos,
			E.nombre as nombre_empresa,
			E.logo as logo_empresa
			FROM paquetes_ott P
			INNER JOIN empresas_ott E ON P.id_empresa=E.id_empresa
			ORDER BY precio ".$_POST['orden'];

  	$result = $mysqli->query($query);

	$rows=array();
	while($row = $result->fetch_array())
	{
		array_push($rows, $row);
	}
$i=0;
	foreach($rows as $row)
	{		
		//Logo de la empresa, falta ruta <img src='.$row["logo_empresa"].'>
		$respuesta=$respuesta.'	<div id="cargarmas'.$i.'" class="col s12 m6 l4 paq-list-bx cargarmas">
			<div class="paq-content-bx">
				<div class="comparando-icons">
					<i class="material-icons">live_tv</i>
				</div>
				<div class="brand-label"  style="background-color: #ff671b">'.$row["nombre_empresa"].'</div>
				<div class="paq-bx">
					<h4 class="truncate">'.$row["nombre"].'</h4>
					<ul>
						<li>'.$row["dato_principal_1"].'</li>	
						<li>'.$row["dato_principal_2"].'</li>
						<li>'.$row["dato_principal_3"].'</li>
						<li>'.$row["dato_principal_4"].'</li>
					</ul>
				</div>
				<div class="paq-price">$'.number_format($row["precio"]).'</div>
						<div id="botonesPlan" class="more-actions-bx">
							<a id="verPlan" href="#deatilsModal" class="modal-trigger waves-effect verpla_'.$row["id_paquete"].'" data-value="'.$row["id_paquete"].'">Ver detalles</a>
							<a href="#!" class="compare-slct" id="plan_'.$row["id_paquete"].'" onclick="CompararPaqueteOTT(this,'.$row["id_paquete"].')">Comparar <i class="material-icons">done</i></a>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>';		
			$i+=1;
	}//foreach
echo $respuesta;
	/* liberar la serie de resultados */
	$result->free();
}//if(isset($_POST['CargarPlanesStreaming']))


//echo "ERROR  !!!!!!";
if(isset($_POST['CargarSliderStreaming'])){
	$query="SELECT MAX(precio) as maximo, MIN(precio) as minimo FROM paquetes_ott";
	$mysqli = new mysqli("localhost", "dbo600436593", "20eligefacil15#", "db600436593UTF8");
	$mysqli->set_charset("utf8");	

  	$result = $mysqli->query($query);

	$rows=array();
	while($row = $result->fetch_array())
	{
		array_push($rows, $row);
	}

	foreach($rows as $row)
	{
		echo '	<div class="slider-bx">
					<p class="truncate">Rango de Precio</p>
					<div class="slide-bar-bx">
						<div id="slidertest"></div>
						<div class="slide-value-bx">
							<span class="left">$'.$row["minimo"].'</span>
							<span class="right">$'.$row["maximo"].'+</span>
						</div>
					</div>
				</div>
				<script>
					var slider = document.getElementById("slidertest");

			 		noUiSlider.create(slidertest, {
			 		start: ['.$row["minimo"].', '.$row["maximo"].'],
			 		connect: true,
			 		step: 10,
			 		range: {
			 		 "min": '.$row["minimo"].',
			 		 "max": '.$row["maximo"].'
			 		},
			 		  format: wNumb({
			 			decimals: 0
			 		  })
			 		});
			 		slidertest.noUiSlider.on("change", function(){
						console.log("cambia precio");
						CargarPlanesConFiltros();
					})
				</script>
				';
	}

	/* liberar la serie de resultados */
	$result->free();

}//if(isset($_POST['CargarSliderStreaming'])){

if(isset($_POST['Streamingfiltros'])){
//Mostrar planes con los filtros
	$query_filtros="SELECT 
			P.id_paquete,
			P.nombre,
			P.id_empresa,
			P.precio,
			P.dato_principal_1,
			P.dato_principal_2,
			P.dato_principal_3,
			P.dato_principal_4,
			P.mas_datos,
			E.nombre as nombre_empresa,
			E.logo as logo_empresa
			FROM paquetes_ott P
			INNER JOIN empresas_ott E ON P.id_empresa=E.id_empresa
	  		WHERE ";

    $Filtros = $_POST['Streamingfiltros'];
    //print_r($_POST['filtros']);
    $contEmpresas=0;
    $queryEmpresas="";
    foreach ($Filtros as $filtro) {
        # code...
        $fil = json_decode($filtro);
        if($fil->tipo=='precio'){
        	$query_filtros=$query_filtros." (P.precio>=".$fil->Minimo." AND P.precio<=".$fil->Maximo.")";
        }
        if($fil->tipo=='checkEmpresas'){
        	if($contEmpresas==0){
        		$queryEmpresas="AND (P.nombre = '".$fil->empresa."'";
        		$contEmpresas=1;
        	}else{
        		$queryEmpresas=$queryEmpresas." OR P.nombre = '".$fil->empresa."'";
        	}
        }
        //ChromePhp::log("Nome: " . $usr->nome . " - Idade: " . $usr->idade);
    }
    if($contEmpresas>0){
    	$query_filtros=$query_filtros.$queryEmpresas.") ";
    }
    $query_filtros=$query_filtros."ORDER BY P.precio ".$_POST['orden'];
  	//echo $query_filtros;

	//$result = $mysqli->query($query);
  	$result_filtros = $mysqli->query($query_filtros);
	//echo mysqli_num_rows($result_filtros);				

	$rows=array();
	while($row = $result_filtros->fetch_array())
	{
		array_push($rows, $row);
	}

	foreach($rows as $row)
	{		
		//Logo de la empresa, falta ruta <img src='.$row["logo_empresa"].'>
		$respuesta=$respuesta.'<div class="col s12 m6 l4 paq-list-bx">
			<div class="paq-content-bx">
				<div class="comparando-icons">
					<i class="material-icons">live_tv</i>
				</div>
				<div class="brand-label" style="background-color: #ff671b">'.$row["nombre_empresa"].'</div>
				<div class="paq-bx">
					<h4 class="truncate">'.$row["nombre"].'</h4>
					<ul>
						<li>'.$row["dato_principal_1"].'</li>	
						<li>'.$row["dato_principal_2"].'</li>
						<li>'.$row["dato_principal_3"].'</li>
						<li>'.$row["dato_principal_4"].'</li>
					</ul>
				</div>
				<div class="paq-price">$'.number_format($row["precio"]).'</div>
						<div id="botonesPlan" class="more-actions-bx">
							<a id="verPlan" href="#deatilsModal" class="modal-trigger waves-effect verpla_'.$row["id_paquete"].'" data-value="'.$row["id_paquete"].'">Ver detalles</a>
							<a href="#!" class="compare-slct" id="plan_'.$row["id_paquete"].'" onclick="CompararPaqueteOTT(this,'.$row["id_paquete"].')">Comparar <i class="material-icons">done</i></a>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>';		
			
	}//foreach
echo $respuesta;
	/* liberar la serie de resultados */
	$result_filtros->free();

}

if(isset($_POST['CargarFiltrosCheckEmpresasStreaming'])){
	$query=("SELECT DISTINCT(nombre) as empresa FROM paquetes_ott");
			//echo $query;

	$result = $mysqli->query($query);

	$rows=array();
	while($row = $result->fetch_array())
	{
		array_push($rows, $row);
	}
	$i=1;
	foreach($rows as $row)
	{
			echo '	<p class="truncate">
					<input type="checkbox" id="checkboxEmpresas'.$i.'" onchange="CargarPlanesConFiltros();"/>
					<label for="checkboxEmpresas'.$i.'">'.$row["empresa"].'</label>
					</p>
					<script type="text/javascript">
					if(sessionStorage.filtrosCheckEmpresasStreaming){
						var getFiltrosCheckEmpresasStreaming= JSON.parse(sessionStorage.getItem("filtrosCheckEmpresasStreaming"));
					}else{
						var getFiltrosCheckEmpresasStreaming = new Array();
					}
					getFiltrosCheckEmpresasStreaming.push({empresa:"'.$row["empresa"].'",value:"checkboxEmpresas'.$i.'"});
					//console.log(getFiltros);
					$.each(getFiltrosCheckEmpresasStreaming, function( index, value ) {
						//console.log( value.id_tipoDato+":"+value.value );
					});
					sessionStorage.setItem("filtrosCheckEmpresasStreaming", JSON.stringify(getFiltrosCheckEmpresasStreaming));
				</script>';
				$i+=1;
	}//END FOREACH


	/* liberar la serie de resultados */
	$result->free();

}//if(isset($_POST['CargarFiltrosCheckEmpresas']))


if(isset($_POST['CompararPaqueteOTT'])){
	if(isset($_POST['id_paquete'])){
		$query="SELECT 
			P.id_paquete,
			P.nombre,
			P.id_empresa,
			P.precio,
			P.dato_principal_1,
			P.dato_principal_2,
			P.dato_principal_3,
			P.dato_principal_4,
			P.mas_datos,
			E.nombre as nombre_empresa,
			E.logo as logo_empresa
			FROM paquetes_ott P
			INNER JOIN empresas_ott E ON P.id_empresa=E.id_empresa
			WHERE P.id_paquete=".$_POST['id_paquete']."
			ORDER BY precio ".$_POST['orden'];

		$result = $mysqli->query($query);

		$rows=array();
		while($row = $result->fetch_array())
		{
			//array_push($rows, $row);
			$respuesta='<div class="item" id="'.$row["id_paquete"].'">
						<div class="col s12 paq-list-bx compare-status">
							<div class="paq-content-bx">
								<div class="brand-label" style="background-color: #ff671b">'.$row["nombre"].'</div>
								<div class="paq-bx paq-comparado paq-comparado'.$_POST["num_plan_comp"].'">
									<h4 class="truncate"></h4>
									<ul>
										<li>'.$row["dato_principal_1"].'</li>
										<li>'.$row["dato_principal_2"].'</li>
										<li>'.$row["dato_principal_3"].'</li>
										<li>'.$row["dato_principal_4"].'</li>
									</ul>'.$row["mas_datos"].'
								</div>
								<div style="padding-left:15px;padding-bottom:15px;">
									<form action="#">
										 <input id="MeGustariaContratar'.$row['id_paquete'].'" type="checkbox" class="MeGustariaContratarClass" name="contratar" value="true" data-idPlan="'.$row['id_paquete'].'"> <label for="MeGustariaContratar'.$row['id_paquete'].'" style="font-size: ;">Me gustaría contratar</label>
									</form>
								</div>
								<div class="paq-price">$'.number_format($row["precio"]).'</div>
								<div class="more-actions-bx">
									<a href="#!" class="grey"></a>
									<a href="#!" class="compare-slct grey"></a>
									<a href="#!" onclick="eliminarDelComparador('.$row["id_paquete"].')" class="compare-delete">Eliminar</a>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
					</div>';
		}
		echo $respuesta;


		/* liberar la serie de resultados */
		$result->free();

  	}
}//if(isset($_POST['CompararPaqueteOTT']))

if(isset($_POST['verDetallesStreaming'])){
	if(isset($_POST['id_paquete'])){
		$query="SELECT 
			P.id_paquete,
			P.nombre,
			P.id_empresa,
			P.precio,
			P.dato_principal_1,
			P.dato_principal_2,
			P.dato_principal_3,
			P.dato_principal_4,
			P.mas_datos,
			E.nombre as nombre_empresa,
			E.logo as logo_empresa
			FROM paquetes_ott P
			INNER JOIN empresas_ott E ON P.id_empresa=E.id_empresa
			WHERE P.id_paquete=".$_POST['id_paquete'];


		$result = $mysqli->query($query);

		//$rows=array();
		while($row = $result->fetch_array())
		{
			//array_push($rows, $row);
			$respuesta='<div class="brand-label" style="background-color: #ff671b">'.$row["nombre"].'</div>
				<h4>$'.number_format($row["precio"]).'</h4>
				<div class="plan-main-options row">
					<div class="col s6 m3"><p>'.$row["dato_principal_1"].'</p></div>
					<div class="col s6 m3"><p>'.$row["dato_principal_2"].'</p></div>
					<div class="col s6 m3"><p>'.$row["dato_principal_3"].'</p></div>
					<div class="col s6 m3"><p>'.$row["dato_principal_4"].'</p></div>
				</div>
				<h5>Opciones y características adicionales</h5>
				<p>'.$row['mas_datos'];
			$footer.='<div class="modal-footer">
						<a href="#!" class="modal-action modal-close waves-effect btn-flat grey white-text" id="plan_'.$row["id_paquete"].'" onclick="Comparar(this,'.$row["id_paquete"].','."'".$row["empresa_color"]."'".')">Comparar</a>
						<a href="#!" class="modal-action modal-close waves-effect btn-flat ">Cerrar</a>
					</div>';
		}
		$miArray = array("contenido"=>$respuesta, "footer"=>$footer);
		echo json_encode($miArray);
		//echo $respuesta;

		/* liberar la serie de resultados */
		$result->free();
  	}
}//if(isset($_POST['verDetalles']))

//Función que carga los anuncios dependiendo de los parámetros.
if(isset($_POST['CargarAnuncio'])){
	$id_anuncio=$_POST['id_anuncio'];
	$query="SELECT *
		FROM anuncios
		WHERE id_anuncio=".$id_anuncio;

		$result = $mysqli->query($query);

		$rows=array();
		while($row = $result->fetch_array())
		{
			//array_push($rows, $row);
			if($row['url'] != NULL){
				echo "<a href='" . $row['url'] . "' target='_blank'>";
			}
			
			echo "<img <img class='responsive-img' src='http://www.eligefacil.com/uploads/anuncios/" . $row['id_anuncio'] . "/" . $row['imagen'] . "' alt=''/>";
		
			if($row['url'] != NULL){
				echo "</a>";
			}
		}
		//echo $respuesta;

		/* liberar la serie de resultados */
		$result->free();

}

//Función que carga los datos de Contratacion.
if(isset($_POST['contratar'])){
	$mysqli = new mysqli("localhost", "dbo600436593", "20eligefacil15#", "db600436593UTF8");
	$mysqli->set_charset("utf8");
	$id_empresa=$_POST['id_empresa'];
	$estado=$_POST['estado'];
	$query="SELECT C.id_contacto
			FROM Contacto_empresas C
			INNER JOIN relacion_contacto_empresas RCE ON C.id_contacto = RCE.id_contacto
			WHERE RCE.id_empresa=".$id_empresa." AND (C.estado=".$estado." OR C.estado=-1)";

	
	if (!$mysqli->query($query)) {
    	printf("Errormessage: %s\n", $mysqli->error);
	}else{
		$resultadoContactoEmpresa = $mysqli->query($query);
	}
	$respuesta='';
	while($row = $resultadoContactoEmpresa->fetch_array())
	{
		//array_push($rows, $row);
		$queryCorreos="SELECT correo, nombre_correo FROM correo_contacto_empresa WHERE id_contacto=".$row["id_contacto"];
		//echo $queryCorreos;

		$resultCorreos = $mysqli->query($queryCorreos);
		while ($filaCorreos = $resultCorreos->fetch_array()) {
			# code...
			$respuesta .= "	<p>Vía mail:
	      						<a href='mailto:".$filaCorreosla['correo']."'>".$filaCorreos['correo']."</a>
	      					</p>";
		}
		$resultCorreos->free();

		$queryTelefonos="SELECT telefono, nombre_telefono FROM telefono_contacto_empresa WHERE id_contacto=".$row["id_contacto"];
		//echo $queryCorreos;

		$resultTelefonos = $mysqli->query($queryTelefonos);
		while ($filaTelefonos = $resultTelefonos->fetch_array()) {
			# code...
			$respuesta .= "	<p>".$filaTelefonos['nombre_telefono'].":
	      						<a href='tel:".$filaTelefonos['telefono']."'>".$filaTelefonos['telefono']."</a>
	      					</p>";
		}
		$resultTelefonos->free();

		$queryEnlaces="SELECT enlace, nombre_enlace, descripcion_enlace FROM enlace_contacto_empresa WHERE id_contacto=".$row["id_contacto"];
		$resultEnlaces = $mysqli->query($queryEnlaces);
		while ($filaEnlaces = $resultEnlaces->fetch_array()) {
			# code...
			$respuesta .= "	<p>".$filaEnlaces['descripcion_enlace'].":
	      						<a href='".$filaEnlaces['enlace']."'>".$filaEnlaces['nombre_enlace']."</a>
	      					</p>";
		}
		$resultEnlaces->free();

		
	}
	echo $respuesta;

	/* liberar la serie de resultados */
	$resultadoContactoEmpresa->free();
}

/* cerrar la conexión */

$mysqli->close();

?>