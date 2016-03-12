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
		<meta name="application-name" content="Perfil by tooth.me®" />
		<meta name="msapplication-TileColor" content=" #00b0ff" />
		<meta name="msapplication-square70x70logo" content="/img/profile/smalltile.png" />
		<meta name="msapplication-square150x150logo" content="/img/profile/mediumtile.png" />
		<meta name="msapplication-wide310x150logo" content="/img/profile/widetile.png" />
		<meta name="msapplication-square310x310logo" content="/img/profile/largetile.png" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Framework 0.1.b | designo.mx®</title>
		<!-- CSS -->
		<link href="materialize/css/materialize.min.css" type="text/css" rel="stylesheet" />
		<link href="css/iosOverlay.css" type="text/css" rel="stylesheet" media="screen,projection" />
		<link href="css/animate.min.css" type="text/css" rel="stylesheet" media="screen,projection" />
		<link href="css/magic.min.css" type="text/css" rel="stylesheet" media="screen,projection" />
		<link href="css/jquery.mCustomScrollbar.css" type="text/css" rel="stylesheet" />
		<link href="css/nouislider.min.css" type="text/css" rel="stylesheet" />
		<link href="css/main.css" type="text/css" rel="stylesheet" media="screen,projection" />
		<!-- This is FontsAwesome 4.3.0-->
		<link href="fawesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	</head>
	<body>
	<script src="js/nouislider.min.js"></script>
	<script src="js/jquery-2.1.1.min.js"></script>

	<script type="text/javascript">
		//Iniciar un arreglo que contiene los id de los filtros que hay, para poder consultar los valores cuando hago la llamada, dichos filtros se guardan en una variable localStorage para poder acceder en las distintas partes del codigo.
		var filtros = new Array();
		localStorage.removeItem("filtros");
		localStorage.removeItem("filtrosCheck");
		//filtros.push("texto");
		//filtros.push("texto2");
		//localStorage.setItem("filtros", JSON.stringify(filtros));
		//var getFiltros= JSON.parse(localStorage.getItem("filtros"));
		//getFiltros.push("texto3");
		//console.log(getFiltros);
		//$.each(getFiltros, function( index, value ) {
		//	console.log( value );
		//});
	</script>
		<nav id="main-nav-bar" class="fix-ios-shadow">
			<div class="nav-wrapper">
				<a href="index.html" class="logo-header magictime spaceInLeft hvr-grow"><img src="images/logo_eligefacil.png" width="159" alt="" /></a>
				<a href="#" data-activates="mobile-demo" class="button-collapse right hvr-grow"><i class="material-icons">menu</i></a>
				<ul class="right hide-on-med-and-down">
					<li>
						<a href="sass.html" class="magictime slideUpRetourn fix-pos-nav">Descubre</a>
						<span class="nav-mid-line"></span>
					</li>
					<li>
						<a href="badges.html" class="magictime slideUpRetourn fix-pos-nav">Enterate</a>
						<span class="nav-mid-line"></span>
					</li>
					<li>
						<a href="collapsible.html" class="magictime slideUpRetourn fix-pos-nav">Contacto</a>
					</li>
					<li>
						<a href="mobile.html" class="magictime swashIn twitternav"><i class="fa fa-twitter"></i></a>
					</li>
					<li>
						<a href="mobile.html" class="magictime swashIn facebooknav"><i class="fa fa-facebook"></i></a>
					</li>
				</ul>
				<ul class="side-nav" id="mobile-demo">
					<li>
						<a href="sass.html"><i class="fa fa-search left"></i> Descubre</a>
					</li>
					<li>
						<a href="badges.html"><i class="fa fa-newspaper-o left"></i> Enterate</a>
					</li>
					<li>
						<a href="collapsible.html"><i class="fa fa-envelope-o left"></i> Contacto</a>
					</li>
					<li>
						<a href="mobile.html"><i class="fa fa-twitter left"></i> Twitter</a>
					</li>
					<li>
						<a href="mobile.html"><i class="fa fa-facebook left"></i> Facebook</a>
					</li>
				</ul>
			</div>
		</nav>
		<div class="filter-mid-bar row">
			<div class="col s6 sliders-scroll-bx">
				<div class="sliders-wrapp">
					<div id="filtros">
						
					</div>
					<div class="clearfix"></div>
				</div>	
			</div>
			<div class="col s6 z-depth-1 fix-ios-shadow checks-scroll-bx">
				<form action="#">
				<div id="filtrosCheck"></div>

				 </form>
				 <a id="btnComparar" class="search-btn filterBtn z-depth-1 hoverable hide-on-med-and-down" href="#!">Comparar <i class="fa fa-angle-right right"></i></a>
				 <a class="search-btn filterBtn cBtn z-depth-1 hoverable hide-on-med-and-up" href="#!"><i class="fa fa-angle-right right"></i></a>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
		<br />
		<div id="blog-module" class="row grey lighten-5">
			<div class="col s12 blog-timeline-bx">
				<div id="planes">
					

				</div>
				<div class="reload-button-bx">
					<a href="#!" class="z-depth-1 hoverable"><i class="fa fa-refresh"></i> Cargar Más</a>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="footer-bx">
				<ul>
					<li>
						<a href="#!">Quiénes somos</a>/</li>
					<li>
						<a href="#!">Mapa del sitio</a>/</li>
					<li>
						<a href="#!">Aviso de privacidad</a>/</li>
					<li>
						<a href="#!">Anúnciate con nosotros</a>/</li>
					<li>
						<a href="#!">Ayuda</a>
					</li>
				</ul>
				<p class="copy-foot">Todos los derechos reservados 2016®</p>
			</div>
		</div>
		<div class="home-hero">
			<div class="hero-image active-slide" style="background-image: url('images/hero1.jpg');"></div>
			<div class="hero-image" style="background-image: url('images/hero2.jpg');"></div>
		</div>
		<div class="slide-widget animated slideInUp">
			<div class="widget-wrapper">
				<div class="discover-title">!DESCUBRE TU PLAN!</div>
				<div class="scroll-box">
					<div class="alignr-box">
						<div class="products-box">
							<?php
								if(isset($_POST['celular']) && $_POST['celular'] == 1){
									//echo 'Query para planes celulares '.$ip;
									echo '<div id="celular" class="plan-box cellplan">';

								}else{
									echo '<div id="celular" class="plan-box cellplan">';
								} ?>
									<div class="content-bx hvr-grow">
										<div class="valigny">
											<i class="material-icons">phone_android</i>
											<p>celular</p>
										</div>
									</div>
									<div class="check-plan">
										<i class="fa fa-check"></i>
									</div>
									<div class="cancel-plan">
										<i class="fa fa-times-circle"></i>
									</div>
								</div>
							<?php
								if(isset($_POST['internet']) && $_POST['internet'] == 1 ){
									//echo 'Query para planes celulares '.$ip;
									echo '<div id="internet" class="plan-box nocell nostreaming tripleplay3">
';

								}else{
									echo '<div id="internet" class="plan-box nocell nostreaming tripleplay3">
';
								} ?>
										<div class="content-bx hvr-grow">
										<div class="valigny">
											<i class="material-icons">wifi</i>
											<p>internet</p>
										</div>
									</div>
									<div class="check-plan">
										<i class="fa fa-check"></i>
									</div>
									<div class="cancel-plan">
										<i class="fa fa-times-circle"></i>
									</div>
								</div>
							<?php
								if(isset($_POST['telefono']) && $_POST['telefono'] == 1){
									//echo 'Query para planes celulares '.$ip;
									echo '<div id="telefono" class="plan-box nocell nostreaming tripleplay1">';

								}else{
									echo '<div id="telefono" class="plan-box nocell nostreaming tripleplay1">';
								} ?>					
									<div class="content-bx hvr-grow">
										<div class="valigny">
											<i class="material-icons">phone</i>
											<p>tel. fijo</p>
										</div>
									</div>
									<div class="check-plan">
										<i class="fa fa-check"></i>
									</div>
									<div class="cancel-plan">
										<i class="fa fa-times-circle"></i>
									</div>
								</div>
							<?php
								if(isset($_POST['television']) && $_POST['television'] == 1){
									//echo 'Query para planes celulares '.$ip;
									echo '<div id="television" class="plan-box nocell nostreaming tripleplay2">';

								}else{
									echo '<div id="television" class="plan-box nocell nostreaming tripleplay2">';
								} ?>	
									<div class="content-bx hvr-grow">
										<div class="valigny">
											<i class="material-icons">tv</i>
											<p>tv</p>
										</div>
									</div>
									<div class="check-plan">
										<i class="fa fa-check"></i>
									</div>
									<div class="cancel-plan">
										<i class="fa fa-times-circle"></i>
									</div>
								</div>
							<?php
								if(isset($_POST['streaming']) && $_POST['streaming'] == 1) {
									//echo 'Query para planes celulares '.$ip;
									echo '<div id="streaming" class="plan-box nocell streaming">';

								}else{
									echo '<div id="streaming" class="plan-box nocell streaming">';
								} ?>
									<div class="content-bx hvr-grow">
										<div class="valigny">
											<i class="material-icons">live_tv</i>
											<p>Streaming</p>
										</div>
									</div>
									<div class="check-plan">
										<i class="fa fa-check"></i>
									</div>
									<div class="cancel-plan">
										<i class="fa fa-times-circle"></i>
									</div>
								</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		  <!-- Modal Structure -->
		  <div id="deatilsModal" class="modal modal-fixed-footer">
		    <div id="ContenidoModal" class="modal-content">
		    </div>
		    <div class="modal-footer">
		      <a href="#!" class="modal-action modal-close waves-effect btn-flat ">Cerrar</a>
		    </div>
		  </div>
		<!--[if IE]>
			<script src="js/html5.js"></script>
			<script type="text/javascript" src="js/respond.js"></script>
		<![endif]-->
		<!-- Scripts-->
		<script src="js/jquery.stayInWebApp.min.js"></script>
		<script src="js/spin.js"></script>
		<script src="js/iosOverlay.js"></script>
		<script src="js/charCount.js"></script>
		<script src="js/backtotop.js"></script>
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
		<!--PERFIL-->
		<script src="js/comparador.js"></script>

		<div id="fb-root"></div>
		<script type="text/javascript">
			(function(d, s, id) {
					  var js, fjs = d.getElementsByTagName(s)[0];
					  if (d.getElementById(id)) return;
					  js = d.createElement(s); js.id = id;
					  js.src = "//connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v2.5&appId=327135760765560";
					  fjs.parentNode.insertBefore(js, fjs);
					}(document, 'script', 'facebook-jssdk'));
		</script>
		<script>
		function botones(){
			$( "#verPlan" ).click(function() {
				alert("BOTONES");
				var id_plan=$(this).data("value");
				$("#ContenidoModal").append('');
				var url = "#deatilsModal";
				//console.log(i);
				//window.location('#deatilsModal');
				var data={
					verDetalles:"true",
					id_plan:id_plan
				}
				$.ajax({
					dataType:"json",
					type: "POST",
					url: "listado.php",
					data: data
				})
			    .done(function(data){
			    	//console.log(data);
			    	// similar behavior as an HTTP redirect
					//window.location.replace("http://stackoverflow.com");
					// similar behavior as clicking on a link
					//window.location.href = "listado-comparador.php";
					console.log(data[0].id_plan)
					//$("#ContenidoModal").children("div").remove();
					$("#ContenidoModal").html('<div class="brand-label">'+data[0].empresa+'</div><h4>'+data[0].nombre+'</h4><div class="plan-main-options row"><div class="col s6 m3"><p>.512 Mbps de Velocidad</p></div><div class="col s6 m3"><p>Llamadas ilimitadas loc./nal.</p></div><div class="col s6 m3"><p>LD EU/CAN</p></div><div class="col s6 m3"><p>1000 Minutos a celular</p></div>	</div><h5>Opciones y características adicionales</h5><p>Nullam id dolor id nibh ultricies vehicula ut id elit. Donec id elit non mi porta gravida at eget metus. Donec id elit non mi porta gravida at eget metus. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p><br><br><br><br><br><br>'+data[0].mas_datos+'<p>Maecenas faucibus mollis interdum. Nulla vitae elit libero, a pharetra augue. Etiam porta sem malesuada magna mollis euismod. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Etiam porta sem malesuada magna mollis euismod. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p><ul><li>Tristique Inceptos Vehicula</li><li>Tristique Inceptos</li><li>Tristique Inceptos Vehicula Ligula</li><li>Tristique Inceptos Vehicula</li><li>Tristique Inceptos:<ul><li>Tristique Vehicula Ligula Tortor</li><li>Tristique Vehicula Tortor</li><li>Tristique Vehicula Ligula</li><li>Tristique Vehicula Tortor</li></ul></li></ul><ol><li>Tristique Inceptos Vehicula</li><li>Tristique Inceptos</li><li>Tristique Inceptos Vehicula Ligula</li><li>Tristique Inceptos Vehicula</li><li>Tristique Inceptos:<ol><li>Tristique Vehicula Ligula Tortor</li><li>Tristique Vehicula Tortor</li><li>Tristique Vehicula Ligula</li><li>Tristique Vehicula Tortor<ul><li>Tristique Vehicula Ligula Tortor</li><li>Tristique Vehicula Tortor</li><li>Tristique Vehicula Ligula</li><li>Tristique Vehicula Tortor</li></ul></li></ol></li> </ol><h5>Letras chiquitas:</h5><ul><li>Tristique Vehicula Ligula Tortor</li><li>Tristique Vehicula Tortor</li><li>Tristique Vehicula Ligula</li><li>Tristique Vehicula Tortor</li></ul>');

			    })
			    .fail(function(data){
			    	console.log(data);
			    });
			})
		}
			$( "#btnComparar" ).click(function() {
				//alert("Comparar!");
				var getFiltros= JSON.parse(localStorage.getItem("filtros"));
				var getFiltrosCheck= JSON.parse(localStorage.getItem("filtrosCheck"));
				var Filtros = [];
				//getFiltros.push("texto3");
				//console.log(getFiltros);
				var get1 = window["slidertest"]["noUiSlider"]["get"]();
				console.log("get: "+get1[0]);
				console.log("get: "+get1[1]);
				newFiltro = {};
        		newFiltro['tipo'] = 'precio';
        		newFiltro['Maximo'] = get1[1];
        		newFiltro['Minimo'] = get1[0];
        		Filtros.push(JSON.stringify(newFiltro));
        		if (!(getFiltros === null))
				{
				    // items is null or []
				    $.each(getFiltros, function( index, value ) {
					//console.log("id_tipoDato: "+value.id_tipoDato+" id del div: "+ value.value );
					var sliderActual=value.value;
					var get1 = window[value.value]["noUiSlider"]["get"]();
					//console.log("get: "+get1[0]);
					//console.log("get: "+get1[1]);
					newFiltro = {};
	        		newFiltro['tipo'] = 'slider';
	        		newFiltro["id_tipoDato"] = value.id_tipoDato;
	        		newFiltro['Mayor'] = get1[1];
	        		newFiltro['Menor'] = get1[0];
	        		Filtros.push(JSON.stringify(newFiltro));				
					});
				}
				
				//getFiltros.push("texto3");
				//console.log(getFiltros);
				if (!(getFiltrosCheck === null) || !(getFiltrosCheck.length === 0))
				{
					$.each(getFiltrosCheck, function( index, value ) {
						//console.log("id_tipoDato: "+value.id_tipoDato+" id del div: "+ value.value );
						var temp='#'+value.value;
						if ($(temp).is(":checked"))
						{
							//console.log("valorCheck");
							newFiltro = {};
		        			newFiltro['tipo'] = 'check';
		        			newFiltro["id_tipoDato"] = value.id_tipoDato;	
			        		Filtros.push(JSON.stringify(newFiltro));						
						}
					});
				}

				var data=	{
						'filtros[]':Filtros
				}
				//console.log(data);
				$.ajax({
					//dataType:"json",
					type: "POST",
					url: "listado.php",
					data: data
				})
			    .done(function(data){
					$("#planes").html(data);

			    })

			})
		$(document).ready(function(){

			CargarPlanes();
			CargarFiltrosSliders();
			CargarFiltrosCheck();
			jQuery(function() {
		  	
		  		FRMWRK.main.init();
		  		FRMWRK.comparador.init();
		  		
		  	});
			function CargarPlanes(){
				var data={
					listadoSimple:"true",
					CargarPlanes:"true"
				}
				$.ajax({
					//dataType:"json",
					type: "POST",
					url: "listado.php",
					data: data
				})
			    .done(function(data){
			    	//console.log(data);
			    	// similar behavior as an HTTP redirect
					//window.location.replace("http://stackoverflow.com");
					// similar behavior as clicking on a link
					//window.location.href = "listado-comparador.php";
					//console.log(data[0].id_plan)
					//$("#ContenidoModal").children("div").remove();
					$("#planes").html(data);

			    })
			    .fail(function(data){
			    	console.log(data);
			    	window.location.href = "indexBE.php";
			    });
			}

			function CargarFiltrosSliders(){
				var data={
					listadoSimple:"true",
					CargarFiltrosSliders:"true"
				}
				$.ajax({
					//dataType:"json",
					type: "POST",
					url: "listado.php",
					data: data
				})
			    .done(function(data){
			    	//console.log(data);
			    	// similar behavior as an HTTP redirect
					//window.location.replace("http://stackoverflow.com");
					// similar behavior as clicking on a link
					//window.location.href = "listado-comparador.php";
					//console.log(data[0].id_plan)
					//$("#ContenidoModal").children("div").remove();
					$("#filtros").html(data);
					botones();
					var _widthSlides = 0;
			 		$('.sliders-wrapp .slider-bx').each(function() {
			 		    _widthSlides += $(this).outerWidth( true );
			 		});
			 		$('.sliders-wrapp').css('width', _widthSlides);
			 	
			 		if (isMobile.any == false) {
			 			$(".sliders-scroll-bx").mCustomScrollbar({
							axis: "x",
							theme: "dark-thin",
							autoHideScrollbar: true,
							updateOnContentResize: true
						});
						$(".checks-scroll-bx form").mCustomScrollbar({
							axis: "y",
							theme: "dark-thin",
							autoHideScrollbar: true,
							updateOnContentResize: true
						});
			 		}else {
			 			$(".sliders-scroll-bx, .checks-scroll-bx form").addClass('ismobilescroll');
			 		}

			    })
			    .fail(function(data){
			    	console.log(data);
			    });
			}

			function CargarFiltrosCheck(){
				var data={
					listadoSimple:"true",
					CargarFiltrosCheck:"true"
				}
				$.ajax({
					//dataType:"json",
					type: "POST",
					url: "listado.php",
					data: data
				})
			    .done(function(data){
			    	//console.log(data);
			    	// similar behavior as an HTTP redirect
					//window.location.replace("http://stackoverflow.com");
					// similar behavior as clicking on a link
					//window.location.href = "listado-comparador.php";
					//console.log(data[0].id_plan)
					//$("#ContenidoModal").children("div").remove();
					$("#filtrosCheck").html(data);

			    })
			    .fail(function(data){
			    	console.log(data);
			    });
			}

			

		});

		</script>
		<script>

		</script>
	</body>

</html>