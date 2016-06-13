<?php
require('dbconn.php');
if(isset($_GET['plan'])){
	//Saber si es $Servicio_celular o no, para mostrar los celulares
	$query_tipo_servicio=("SELECT * FROM planes_tipoServicios WHERE id_plan=".$_GET['plan']);
	$result_tipo_servicio = $mysqli->query($query_tipo_servicio);
	$Servicio_celular=0;
	while($row_tipo_servicio = $result_tipo_servicio->fetch_array())
	{
		if($row_tipo_servicio["id_tipoServicio"]==1){
			$Servicio_celular=1;
		}
	}
	$result_tipo_servicio->free();
	//echo $Servicio_celular;

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
	TDS4.tipo as tipoDato4
  	FROM planes P
  	INNER JOIN empresas E ON P.ID_EMPRESA=E.ID_EMPRESA
  	INNER JOIN cobertura C ON P.ID_PLAN=C.ID_PLAN
  	INNER JOIN planes_tipoServicios PT ON P.ID_PLAN=PT.ID_PLAN
		LEFT JOIN tipoDatosServicios TDS1 ON P.id_tipoDato_principal_1 = TDS1.id_tipoDato 
  	LEFT JOIN tipoDatosServicios TDS2 ON P.id_tipoDato_principal_2 = TDS2.id_tipoDato 
  	LEFT JOIN tipoDatosServicios TDS3 ON P.id_tipoDato_principal_3 = TDS3.id_tipoDato 
  	LEFT JOIN tipoDatosServicios TDS4 ON P.id_tipoDato_principal_4 = TDS4.id_tipoDato 
  	WHERE P.id_plan=".$_GET['plan']);


	$result = $mysqli->query($query);
}else{
	echo "<script> alert('Vuelva a elegir su plan, gracias.');
		window.location.assign('http://www.eligefacil.com')
		</script>";
}
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta name="viewport" content="minimal-ui, width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
		<link href="img/profile/apple-touch-icon.png" rel="apple-touch-icon" />
		<link href="img/profile/apple-touch-icon-76x76.png" rel="apple-touch-icon" sizes="76x76" />
		<link href="img/profile/apple-touch-icon-120x120.png" rel="apple-touch-icon" sizes="120x120" />
		<link href="img/profile/apple-touch-icon-152x152.png" rel="apple-touch-icon" sizes="152x152" />
		<link rel="icon" sizes="192x192" href="img/profile/android-touch-icon-192x192.png">
		<link rel="icon" sizes="128x128" href="img/profile/android-touch-icon-128x128.png">
		<link rel="icon" type="image/png" href="img/profile/favicon.png" />
		<!--WINDOWS PHONE 8.1-->
		<meta name="application-name" content="EligeFacil" />
		<meta name="msapplication-TileColor" content=" #00b0ff" />
		<meta name="msapplication-square70x70logo" content="/img/profile/smalltile.png" />
		<meta name="msapplication-square150x150logo" content="/img/profile/mediumtile.png" />
		<meta name="msapplication-wide310x150logo" content="/img/profile/widetile.png" />
		<meta name="msapplication-square310x310logo" content="/img/profile/largetile.png" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Elige Fácil | ¡Decidir nunca fue tan simple!</title>
		<!-- CSS -->
		<link href="materialize/css/materialize.min.css" type="text/css" rel="stylesheet" media="all" />
		<link href="css/iosOverlay.css" type="text/css" rel="stylesheet" media="all" />
		<link href="css/animate.min.css" type="text/css" rel="stylesheet" media="all" />
		<link href="css/magic.min.css" type="text/css" rel="stylesheet" media="all" />
		<link href="css/jquery.mCustomScrollbar.css" type="text/css" rel="stylesheet" media="all" />
		<link href="css/main.css" type="text/css" rel="stylesheet" media="all" />
		<!-- This is FontsAwesome 4.3.0-->
		<link href="fawesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	</head>
	<body>
		<div id="print-details-bx" class="row">
			<div id="deatilsModal" class="col s10 m8">
				<div class="modal-content">
					<a href="index.html" class="logo-header"><img src="images/logo_eligefacil.png" width="159" alt=""  style="margin: 0 auto; position: relative; display: block;"/></a>
					<div class="clearfix"></div>
					<br />
					<?php
					while($row = $result->fetch_array())
					{
						echo '<div class="brand-label" style="background-color:'.$row["empresa_color"].'">'.$row["empresa"].'</div>
							<h4>'.$row["nombre"].' - $'.$row["precio"].'</h4>
							<div class="plan-main-options row">';
						switch ($row['tipoDato1']) {
							//$respuesta=$respuesta.'<div class="col s6 m3">';
						    case "texto":
								echo '<div class="col s6 m3"><p>'.$row["dato_principal_1"].'</p></div>';

						        break;
						    case "integer":
								echo '<div class="col s6 m3"><p>'.$row["dato_principal_1"].' '.$row["dato1"].'</p></div>';
						        break;
						    case "boolean":
								echo '<div class="col s6 m3"><p>'.$row["dato1"].'</p></div>';
						        break;
						}
						switch ($row['tipoDato2']) {
						    case "texto":
								echo '<div class="col s6 m3"><p>'.$row["dato_principal_2"].'</p></div>';

						        break;
						    case "integer":
								echo '<div class="col s6 m3"><p>'.$row["dato_principal_2"].' '.$row["dato2"].'</p></div>';
						        break;
						    case "boolean":
								echo '<div class="col s6 m3"><p>'.$row["dato2"].'</p></div>';
						        break;
						}
						switch ($row['tipoDato3']) {
						    case "texto":
								echo '<div class="col s6 m3"><p>'.$row["dato_principal_3"].'</p></div>';

						        break;
						    case "integer":
								echo '<div class="col s6 m3"><p>'.$row["dato_principal_3"].' '.$row["dato3"].'</p></div>';
						        break;
						    case "boolean":
								echo '<div class="col s6 m3"><p>'.$row["dato3"].'</p></div>';
						        break;
						}
						switch ($row['tipoDato4']) {
						    case "texto":
								echo '<div class="col s6 m3"><p>'.$row["dato_principal_4"].'</p></div>';

						        break;
						    case "integer":
								echo '<div class="col s6 m3"><p>'.$row["dato_principal_4"].' '.$row["dato4"].'</p></div>';
						        break;
						    case "boolean":
								echo '<div class="col s6 m3"><p>'.$row["dato4"].'</p></div>';
						        break;
						}
						echo "</div>";

						if($Servicio_celular==1){
							$query_redesSociales="SELECT PRS.id_redSocial,
								RS.nombre
								FROM planes_redesSociales PRS
								INNER JOIN redesSociales RS ON PRS.id_redSocial=RS.id_redSocial 
								WHERE PRS.id_plan=".$row["id_plan"];
							$result_redesSociales = $mysqli->query($query_redesSociales);
							$numero_filasRS = mysqli_num_rows($result_redesSociales);
							if($numero_filasRS>0){
								echo '<h5>Redes Sociales</h5>';
								while($rowRedSocial = $result_redesSociales->fetch_array())
								{
									echo '<li>'.$rowRedSocial["nombre"].'</li>';
								} 
							}
							echo '						
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
								echo '
								<h5>Equipos Recomendados:</h5>
								<ul class="collapsible popout info-collapsible acordionEquipos" data-collapsible="accordion">';
								while($rowEquipos = $result_equipos->fetch_array())
								{	
									echo '
									<li>
										<div class="collapsible-header active">
											<img class="phone-th z-depth-1" src="http://www.eligefacil.com/uploads/celulares_mas_populares/'.$rowEquipos["id_celular"].'/'.$rowEquipos["foto"].'" alt="" /> 
											<b class="phone-title">'.$rowEquipos["nombre"].'</b>
										</div>
										<div class="collapsible-body">
											<div class="row">
												<div class="col s3">
													<img class="responsive-img" src="../../uploads/celulares_mas_populares/'.$rowEquipos["id_celular"].'/'.$rowEquipos["foto"].'" alt="" /> 
												</div>
												<div class="col s9">
													<table class="responsive-table striped centered">
														<thead>
															<tr>
																<th data-field="id"><b>Plazo Forzoso</b></th>
																<th data-field="name"><b>Costo Equipo</b></th>
																<th data-field="price"><b>Total Acumulado</b></th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td>12</td>';
																if($rowEquipos["precio_12m"]>0){
																	echo '<td>$'.$rowEquipos["precio_12m"].'</td>';
																}else{
																	echo '<td>GRATIS</td>';
																}
																$Acumulado_celular=($row["precio"]*12)+$rowEquipos["precio_12m"];
																echo '<td>$'.$Acumulado_celular.'</td>
															</tr>
															<tr>
																<td>18</td>';
																if($rowEquipos["precio_18m"]>0){
																	echo '<td>$'.$rowEquipos["precio_18m"].'</td>';
																}else{
																	echo '<td>GRATIS</td>';
																}
																$Acumulado_celular=($row["precio"]*18)+$rowEquipos["precio_18m"];
																echo '<td>$'.$Acumulado_celular.'</td>
															</tr>
															<tr>
																<td>24</td>';
																if($rowEquipos["precio_24m"]>0){
																	echo '<td>$'.$rowEquipos["precio_24m"].'</td>';
																}else{
																	echo '<td>GRATIS</td>';
																}
																$Acumulado_celular=($row["precio"]*24)+$rowEquipos["precio_24m"];
																echo '<td>$'.$Acumulado_celular.'</td>
															</tr>
															<tr>
																<td>Prepago</td>';
																if($rowEquipos["precio_prepago"]>0){
																	echo '<td>$'.$rowEquipos["precio_prepago"].'</td>';
																}else{
																	echo '<td>GRATIS</td>';
																}
																echo '<td>$'.$rowEquipos["precio_prepago"].'</td>
															</tr>
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</li>';
								}
							echo '</ul>';
							}	
						}else{
							echo '
								<h5>Opciones y características adicionales</h5>
								'.$row['mas_datos'];
						}
					}
				?>	
				</div>
			</div>
		</div>
		
		<!-- MODALS - ALERTS - DROP DOWNS-->
		  
		  <div class="fixed-action-btn" style="bottom: 10px; right: 10px;">
		  	<a class="btn-floating btn-large red accent-4" href="javascript:window.print()" alt="print this page"><i class="fa fa-print"></i></a>
		  </div>
		
		<!--[if IE]>
			<script src="js/html5.js"></script>
			<script type="text/javascript" src="js/respond.js"></script>
		<![endif]-->
		<!-- Scripts-->
		<script src="js/jquery-2.1.1.min.js"></script>
		<script src="js/jquery.stayInWebApp.min.js"></script>
		<script src="js/spin.js"></script>
		<script src="js/iosOverlay.js"></script>
		<script src="js/charCount.js"></script>
		<script src="js/jquery.scrollUp.min.js"></script>
		<script src="js/materialize.min.js"></script>
		<!--<script src="js/parallax.min.js"></script>-->
		<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
		<script src="js/init.config.js"></script>
		<script src="js/init.js"></script>
		<!--INTERNET CHECK-->
		<script src="offline07/offline.min.js"></script>
		<link rel="stylesheet" href="offline07/themes/offline-theme-dark.css" />
		<link rel="stylesheet" href="offline07/themes/offline-language-spanish.css" />
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
		<script src="https://storage.googleapis.com/code.getmdl.io/1.0.6/material.min.js"></script>

		<script>
			jQuery(function() {
		  	
		  		FRMWRK.main.init();
		  					
		  	});
		</script>
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v2.5&appId=327135760765560";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		
		  ga('create', 'UA-70371933-1', 'auto');
		  ga('send', 'pageview');
		
		</script>
	</body>

</html>