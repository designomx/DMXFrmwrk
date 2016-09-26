<!DOCTYPE html>
<html lang="es">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta name="viewport" content="minimal-ui, width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
	    <meta name="description" content="Elige, filtra y compara Planes de Telefonía, Teléfono, Internet, etc. Informate antes de tomar una decisión, con nuestra plataforma lo haces fácil y en segundos.">
	    <meta name="keywords" content="Comparador, Telefonía fija, telefonía móvil, planes celulares, planes internet, planes telcel, planes movistar, planes virgin, planes at&amp;t, planes axtel, planes iizzi, planes total play, telecomunicaciones">
	    <meta name="author" content=“designo.mx”>
		<title>Elige Fácil | ¡Decidir nunca fue tan simple!</title>
		<!-- CSS -->
		<link href="materialize/css/materialize.min.css" type="text/css" rel="stylesheet" />
		<link href="css/iosOverlay.css" type="text/css" rel="stylesheet" media="all" />
		<link href="css/animate.min.css" type="text/css" rel="stylesheet" media="all" />
		<link href="css/magic.min.css" type="text/css" rel="stylesheet" media="all" />
		<link href="css/jquery.mCustomScrollbar.css" type="text/css" rel="stylesheet" />
		<link href="css/nouislider.min.css" type="text/css" rel="stylesheet" />
		<link rel="stylesheet" href="owl-carousel/owl.carousel.css">
		<link rel="stylesheet" href="owl-carousel/owl.theme.css">
		<link href="css/main.css" type="text/css" rel="stylesheet" media="all" />
		<!-- This is FontsAwesome 4.3.0-->
		<link href="fawesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<link href="css/dev.css" type="text/css" rel="stylesheet" media="all" />

	</head>
	<body>
	<script src="js/nouislider.min.js"></script>
	<script src="js/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="js/fadeSlideShow.js"></script>


	<script type="text/javascript">
		//Iniciar un arreglo que contiene los id de los filtros que hay, para poder consultar los valores cuando hago la llamada, dichos filtros se guardan en una variable sessionStorage para poder acceder en las distintas partes del codigo.
		var filtros = new Array();
		sessionStorage.removeItem("filtros");
		sessionStorage.removeItem("filtrosCheck");
		sessionStorage.removeItem("filtrosCheckEmpresas");
		sessionStorage.removeItem("filtrosCheckEmpresasStreaming");
	</script>
		<nav id="main-nav-bar" class="fix-ios-shadow">
			<div class="nav-wrapper">
				<a href="index.php" class="logo-header magictime spaceInLeft hvr-grow"><img src="images/logo_eligefacil.png" width="159" alt="" /></a>
				<a href="#" data-activates="mobile-demo" class="button-collapse right hvr-grow"><i class="material-icons">menu</i></a>
				<ul class="right hide-on-med-and-down">
					<li>
						<a href="index.php" class="magictime slideUpRetourn fix-pos-nav">Descubre</a>
						<span class="nav-mid-line"></span>
					</li>
					<li>
						<a href="blog" class="magictime slideUpRetourn fix-pos-nav">Entérate</a>
						<span class="nav-mid-line"></span>
					</li>
					<li>
						<a href="contacto.html" class="magictime slideUpRetourn fix-pos-nav">Contacto</a>
					</li>
					<li>
						<a href="http://www.twitter.com/EligeFacil" target="_blank" class="magictime swashIn twitternav"><i class="fa fa-twitter"></i></a>
					</li>
					<li>
						<a href="https://www.facebook.com/EligeFacil" target="_blank" class="magictime swashIn facebooknav"><i class="fa fa-facebook"></i></a>
					</li>
				</ul>
			</div>
		</nav>
		<ul class="side-nav" id="mobile-demo">
			<li>
				<a href="index.php"><i class="fa fa-search left"></i> Descubre</a>
			</li>
			<li>
				<a href="blog"><i class="fa fa-newspaper-o left"></i> Entérate</a>
			</li>
			<li>
				<a href="contacto.html"><i class="fa fa-envelope-o left"></i> Contacto</a>
			</li>
			<li>
				<a href="http://www.twitter.com/EligeFacil" target="_blank"><i class="fa fa-twitter left blue-text text-lighten-1"></i> Twitter</a>
			</li>
			<li>
				<a href="https://www.facebook.com/EligeFacil" target="_blank"><i class="fa fa-facebook left blue-text text-darken-4"></i> Facebook</a>
			</li>
		</ul>
		<div id="filter-go" class="filter-mid-bar row">
			<div class="col s6 m8 sliders-scroll-bx">
				<div class="sliders-wrapp">
					<div class="slider-bx clear-pad-marg">
						<p class="truncate">Estado</p>
						<div class="slide-bar-bx">
							<div class="input-field col s12">
								<div id="SelectDeEstados">

				   				</div>
							</div>
						</div>
					</div>
					<div class="slider-bx clear-pad-marg">
						<p class="truncate">Orden precio</p>
						<div class="slide-bar-bx">
							<div class="switch">
								<label>
									<em>-</em>
							      	<input id="ordenAscDesc" type="checkbox">
									<span class="lever"></span>
									<em>+</em>
								</label>
							</div>
						</div>
					</div>
					
					<div id="filtrosCheckCelulares"></div>
					<div id="filtros">
						
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<div class="col s6 m4 z-depth-1 fix-ios-shadow checks-scroll-bx">
				<form action="#">
					<div id="filtrosCheck"></div>
					<div id="filtrosCheckEmpresas"></div>
				</form>
			</div>
			<div class="clearfix"></div>
		</div>
		<div id="compare-tools" class="row">
			<div class="col s12 m4 elige-six-bx">
				<p>Elige hasta 6 planes para comparar:</p>
			</div>
			<div class="col s12 m4 comparando-six-bx">
				<div id="planes-seleccionados">
					<span id="span-bx1" class="span-bx"><i class="material-icons">done</i></span>
					<span id="span-bx2" class="span-bx"><i class="material-icons">done</i></span>
					<span id="span-bx3" class="span-bx"><i class="material-icons">done</i></span>
					<span id="span-bx4" class="span-bx"><i class="material-icons">done</i></span>
					<span id="span-bx5" class="span-bx"><i class="material-icons">done</i></span>
					<span id="span-bx6" class="span-bx"><i class="material-icons">done</i></span>
				</div>
			</div>
			<div class="col s12 m4">
				<a id="btnComparar" class="search-btn filterBtn z-depth-1 hoverable noCompare" href="#!">Comparar <i class="fa fa-angle-right right"></i></a>
			</div>
		</div>
		<div class="clearfix"></div>
		<br />
		<div id="blog-module" class="row grey lighten-5">
			<div class="col s12 blog-timeline-bx compare-tools">
				<div id="planes">
					

				</div>
				<div class="reload-button-bx">
					<a id="btnCargarMas" onclick="cargarmas()" href="#!" class="z-depth-1 hoverable"><i class="fa fa-refresh"></i> Cargar Más</a>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="footer-bx">
				<ul>
					<li><a href="quienes-somos.html">Quiénes somos</a> / </li>
					<li><a href="pdf/Terminos_y_Condiciones_de_Uso_y_Privacidad.pdf" target="_blank">Legales</a> / </li>
					<li><a href="contacto.html">Anúnciate con nosotros</a> / </li>
					<li><a href="#!">Ayuda</a></li>
				</ul>
				<p class="copy-foot">2016 Todos los derechos reservados © ELIGE FÁCIL</p>
			</div>
		</div>
		<div id="slideshow" class="home-hero"> 
				<!-- This is the last image in the slideshow -->
	          	<div class="hero-image" style="background-image: url('images/hero4.jpg');"/></div>
	            <div class="hero-image" style="background-image: url('images/hero2.jpg');"/></div>
		        <div class="hero-image" style="background-image: url('images/hero1.jpg');"/></div> <!-- This is the first image in the slideshow -->
		        <div class="frases">¡Elige los servicios a contratar!</div>
		        <div class="frases">¡Sin filas, sin rollos!</div>
		        <div class="frases">¡Decidir nunca fue tan simple!</div>
		</div>
		<div class="slide-widget animated slideInUp">
			<div class="widget-wrapper">
				<div class="discover-title">¡Decidir nunca fue tan simple!</div>
				<div class="panelServicios">
					<div class="scroll-box1 desktopSelect">
						<div class="alignr-box">
							<div class="products-box">
								<div id="celular" class="plan-box cellplan">
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
								<div id="internet" class="plan-box nocell nostreaming tripleplay3">
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
								<div id="telefono" class="plan-box nocell nostreaming tripleplay1">
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
								<div id="television" class="plan-box nocell nostreaming tripleplay2">
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
								<div id="streaming" class="plan-box nocell streaming">
									<div class="content-bx hvr-grow">
										<div class="valigny">
											<i class="material-icons">live_tv</i>
											<p>streaming</p>
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
					<div class="scroll-box1 mobileSelect">
						<div class="alignr-box-mobile">
							<div class="row">
								<div class="row s12 btnServicioMobile servicioCelular">
									<div class="col s2 offset-s1 iconServicios">
										<i class="material-icons">phone_android</i>
									</div>	
									<div class="col s7 nameServicios">
										Celular
									</div>
									<div class="col s2 check-plan-mobile ">
										<i class="fa fa-check"></i>
									</div>
								</div>
								<div class="row s12 btnServicioMobile triplePlay servicioInternet">
									<div class="col s2 offset-s1 iconServicios">
										<i class="material-icons">wifi</i>
									</div>
									<div class="col s7 nameServicios">
										Internet
									</div>
									<div class="check-plan-mobile col s2">
										<i class="fa fa-check"></i>
									</div>
								</div>
								<div class="row s12 btnServicioMobile triplePlay servicioTelefono">
									<div class="col s2 offset-s1 iconServicios">
										<i class="material-icons">phone</i>	
									</div>
									<div class="col s7 nameServicios">
										Tel. fijo	
									</div>
									<div class="check-plan-mobile col s2">
										<i class="fa fa-check"></i>
									</div>
								</div>
								<div class="row m12 btnServicioMobile triplePlay servicioTelevision">
									<div class="col s2 offset-s1 iconServicios">
										<i class="material-icons">tv</i>	
									</div>
									<div class="col s7 nameServicios">
										Tv
									</div>
									<div class="check-plan-mobile col s2">
										<i class="fa fa-check"></i>
									</div>
								</div>
								<div class="row m12 btnServicioMobile btnServicioMobile-bottom servicioStreaming">
									<div class="col s2 offset-s1 iconServicios">
										<i class="material-icons">live_tv</i>	
									</div>
									<div class="col s7 nameServicios">
										Streaming	
									</div>
									<div class="check-plan-mobile col s2">
										<i class="fa fa-check"></i>
									</div>
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
		    <div id="footerBotonesModal">

		    </div>
		    
		  </div>
		<a class="cd-top btn-floating btn-large blue-grey darken-1">
		  	<i class="material-icons">keyboard_arrow_up</i>
		  </a>
		<!--COMPARADOR MODAL-->
		<div id="modal-comparador">
			<div class="close-modal-btn">
				<i class="material-icons">close</i>
			</div>
			<div class="fixed-action-btn" style="bottom: 10px; right: 10px;">
				<a class="btn-floating btn-large orange accent-4">
				 <i class="fa fa-share-alt"></i>
			   </a>
				<ul>
					<li>
						<a onclick="CompartirComparacionFacebook()" href="#!" class="btn-floating light-blue darken-4"><i class="fa fa-facebook"></i></a>
					</li>
					<li>
						<a onclick="CompartirComparacionTwitter()" href="#!" class="btn-floating light-blue lighten-2"><i class="fa fa-twitter"></i></a>
					</li>
					<li>
						<a class="btn-floating grey darken-1 modal-trigger" href="#modalMailShare"><i class="fa fa-envelope"></i></a>
					</li>
					<li> 
						<a onclick="ImprimirComparacion()" class="btn-floating red accent-4" href="#!"><i class="fa fa-print"></i></a>
					</li>
					
				</ul>
			</div>
			<div class="slider-container">
				<div id="owl-demo" class="owl-carousel owl-theme">				
					
				</div>
			</div>
		</div>
		<!-- Modal Mail Share -->
		  <div id="modalMailShare" class="modal modal-fixed-footer">
			<div class="modal-content">
				<h4>Enviar a Mail</h4>
				<div class="row">
					<form class="col s12">
						<p>Escribe tu nombre y correo:</p>
						<div class="row">
							<div class="input-field col s12 m6">
								<input id="CompareFromName" type="text" class="validate">
								<label for="CompareFromName">Tu Nombre</label>
							</div>
							<div class="input-field col s12 m6">
								<input id="CompareFromEmail" type="email" class="validate">
								<label for="CompareFromEmail">Tu Email</label>
							</div>
						</div>
						<p>Escribe el nombre y correo para compartir:</p>
						<div class="row">
							<div class="input-field col s12 m6">
								<input id="CompareToName" type="text" class="validate">
								<label for="CompareToName">Nombre</label>
							</div>
							<div class="input-field col s12 m6">
								<input id="CompareToEmail" type="email" class="validate">
								<label for="CompareToEmail">Email</label>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="modal-footer">
				<a href="#!" class="modal-action modal-close waves-effect btn-flat">Cancelar</a>
				<a onclick="ShareComparacion()" href="#!" class="modal-action modal-close waves-effect btn-flat">Enviar</a>
			</div>
		</div>
		<!-- Modal Mail Share Single plan -->
		<div id="modalMailShareSingle" class="modal modal-fixed-footer">
			<div class="modal-content">
				<h4>Enviar a Mail</h4>
				<div class="row">
					<form class="col s12">
						<p>Escribe tu nombre y correo:</p>
						<div class="row">
							<div class="input-field col s12 m6">
								<input id="SingleFromNombre" type="text" class="validate">
								<label for="SingleFromNombre">Tu Nombre</label>
							</div>
							<div class="input-field col s12 m6">
								<input id="SingleFromEmail" type="email" class="validate">
								<label for="SingleFromEmail">Tu Email</label>
							</div>
						</div>
						<p>Escribe el nombre y correo para compartir:</p>
						<div class="row">
							<div class="input-field col s12 m6">
								<input id="SingleToNombre" type="text" class="validate">
								<label for="SingleToNombre">Nombre</label>
							</div>
							<div class="input-field col s12 m6">
								<input id="SingleToEmail" type="email" class="validate">
								<label for="SingleToEmail">Email</label>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="modal-footer">
				<a href="#!" class="modal-action modal-close waves-effect btn-flat">Cancelar</a>
				<a onclick="SendMailSingle()" href="#!" class="modal-action modal-close waves-effect btn-flat">Enviar</a>
			</div>
		</div>
		<!-- Modal Contratacion -->
		<div id="contractModal" class="modal" style="width: 300px;">
			<div class="modal-content">
				<h4>Contratación</h4>
				<p>Contrata este servicio ahora:</p>
				<hr />
				<div class="contenedorContactos">
					<div id="contenedor_telefonos_contratacion">	
						<p>Teléfono:
							<a href="tel:018001205000">01 800 120 5000</a>
						</p>
						<p>CDMX y Area metro.:
							<a href="tel:018001205000">5520 5000</a>
						</p>
					</div>
					<div id="contenedor_enlaces_contratacion">
						<p>Chat:
							<a href="http://www.izzi.mx/webApps/chat" target="_blank">Iniciar Chat ahora</a>
						</p>	
					</div>
					<div id="contenedor_correos_contratacion">
						<p>Vía mail:
							<a href="mailto:ventas@izzi.mx">ventas@izzi.mx</a>
						</p>
					</div>
				</div>
				<!--
				<form class="col s12">
					<div class="row">
						<hr />
						<h5>Quiero que me llamen</h5>
						<div class="input-field col s12">
							<input id="EnviarNombreContratacion" type="text" class="validate">
							<label for="EnviarNombreContratacion">Nombre</label>
						</div>
						<div class="input-field col s12">
							<input id="EnviarCorreoContratacion" type="email" class="validate">
							<label for="EnviarCorreoContratacion">Correo</label>
						</div>
						<div class="input-field col s12">
							<input id="EnviarTelefonoContratacion" type="tel" class="validate">
							<label for="EnviarTelefonoContratacion">Tel. Fijo</label>
						</div>
						<div class="input-field col s12">
							<input id="EnviarMovilContratacion" type="tel" class="validate">
							<label for="EnviarMovilContratacion">Tel. Móvil</label>
						</div>
					</div>
					<a href="#!" id="BtnEnviarContratacion" class="btn orange accent-4" style="width: 100%;">Enviar</a>
				</form>
				-->
			</div>
			<div class="modal-footer">
			  <a href="#!" class="contractModadClose modal-action modal-close waves-effect waves-green btn-flat">Cerrar</a>
			</div>
		</div>

		<!-- Modal Structure Alerta servicios incompatibles -->
		<div id="modalIncompatibles" class="modal">
			<div class="modal-content">
				<h4></h4>
				<p>Lo sentimos, este servicio no se puede comparar con su selección actual.</p>
			</div>
			<div class="modal-footer">
				<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Aceptar</a>
			</div>
		</div>


		<!--BANNER SLIDE DOWN-->
		<div id="slide-in-banner" class="z-depth-2 AnuncioComparadorCentro">
			<div class="close-modal-btn">
				<i class="material-icons">close</i>
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
		<script src="owl-carousel/owl.carousel.min.js"></script>

		<script src="js/init.config.js"></script>
		<script src="js/init.js"></script>
		<script src="js/blockUI.js"></script>
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
		<script src="js/listado-comparador.js"></script>
		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		
		  ga('create', 'UA-70371933-1', 'auto');
		  ga('send', 'pageview');
		
		</script>
		<script type="text/javascript">
			setTimeout(function(){var a=document.createElement("script");
			var b=document.getElementsByTagName("script")[0];
			a.src=document.location.protocol+"//script.crazyegg.com/pages/scripts/0048/8086.js?"+Math.floor(new Date().getTime()/3600000);
			a.async=true;a.type="text/javascript";b.parentNode.insertBefore(a,b)}, 1);
		</script>
	</body>

</html>