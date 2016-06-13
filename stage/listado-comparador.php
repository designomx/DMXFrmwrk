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
					<li><a href="pdf/legal1.pdf" target="_blank">Legales</a> / </li>
					<li><a href="#!">Anúnciate con nosotros</a> / </li>
					<li><a href="#!">Ayuda</a></li>
				</ul>
				<p class="copy-foot">Todos los derechos reservados 2016®</p>
			</div>
		</div>
		<div id="slideshow" class="home-hero"> 
				<!-- This is the last image in the slideshow -->
	          	<div class="hero-image" style="background-image: url('images/hero4.jpg');"/></div>
	            <div class="hero-image" style="background-image: url('images/hero2.jpg');"/></div>
		        <div class="hero-image" style="background-image: url('images/hero1.jpg');"/></div> <!-- This is the first image in the slideshow -->
		</div>
		<div class="slide-widget animated slideInUp">
			<div class="widget-wrapper">
				<div class="discover-title">¡Decidir nunca fue tan simple!</div>
				<div class="scroll-box">
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
		<script>
			function botones(){
				jQuery( "#planes #verPlan" ).click(function() {
					//console.log("botones");
					var id_plan=$(this).data("value");
					jQuery("#ContenidoModal").empty();
					var url = "#deatilsModal";
					//window.location('#deatilsModal');
					if(sessionStorage.getItem("ServicioStreaming")==1){
						$( "#selectEstado" ).prop('disabled', 'disabled');
						var data={
							verDetallesStreaming:"true",
							id_paquete:id_plan,
							async:false
						}
					}else{
						$( "#selectEstado" ).removeAttr("disabled");
						if(sessionStorage.getItem("ServicioCelular")==1){
							var data={
								estado:sessionStorage.getItem("estado"),
								celular:"1",
								verDetalles:"true",
								id_plan:id_plan,
								async:false
							}	
						}else{
							var data={
								estado:sessionStorage.getItem("estado"),
								
								telefono:sessionStorage.getItem("ServicioTelefono"),
								internet:sessionStorage.getItem("ServicioInternet"),
								television:sessionStorage.getItem("ServicioTelevision"),
								verDetalles:"true",
								id_plan:id_plan,
								async:false
							}	
						}
					}
					jQuery.ajax({
						type: "POST",
						url: "listado.php",
						async : false,
						data: data,

					})
				    .done(function(data){
				    	//data downloaded so we call parseJSON function 
                        //and pass downloaded data
                        var json = $.parseJSON(data);
                        //now json variable contains data in json format
                        //let's display a few items
                        //$('#results').html('Plugin name: ' + json.name + '<br />Author: ' + json.author.name);
						jQuery("#ContenidoModal").html(json.contenido);
						jQuery("#footerBotonesModal").html(json.footer);

						if($('#ContenidoModal table').length) {
					        $('#ContenidoModal table').addClass('responsive-table striped');
					    }
				     	$('.acordionEquipos').collapsible({
					      	accordion : false // A setting that changes the collapsible behavior to expandable instead of the default accordion style
					    });
				    })
				    .fail(function(data){
				    	console.log(data);
				    });
				})
			}
			jQuery( "#btnComparar" ).click(function() {
				if($(".span-bx-selected").length<2 || $(".span-bx-selected").length==null){
					alert("Debe seleccionar más de un plan para comparar");
				}else{
					jQuery("#owl-demo").empty();
					$("#owl-demo").data('owlCarousel').destroy();
					var i=0;
					$(".span-bx-selected").each(function() {
					    // ...
					    //.empty()
					    //.append()
					    //$(this).attr(value);
					    //alert($(this).attr("value"))
					    if(sessionStorage.getItem("ServicioStreaming")==1){
					    	$( "#selectEstado" ).prop('disabled', 'disabled');
					    	var data=	{
								CompararPaqueteOTT:true,
								id_paquete:$(this).attr("value"),
								num_plan_comp:i
							}
					    }else{
					    	$( "#selectEstado" ).removeAttr("disabled");
					    	var data=	{
								CompararPlanes:true,
								id_plan:$(this).attr("value"),
								num_plan_comp:i

							}
					    }					    
						//CargarPlanes();
						jQuery.ajax({
							type: "POST",
							url: "listado.php",
							async : false,
							data: data
						})
					    .done(function(data){
					    	//console.log(data);
							jQuery("#owl-demo").append(data);
							//botones();
							$(".paq-comparado0").scroll(function(){
		                    	$(".paq-comparado").scrollTop($(".paq-comparado0").scrollTop());
			                });
			                $(".paq-comparado1").scroll(function(){
		                    	$(".paq-comparado").scrollTop($(".paq-comparado1").scrollTop());
			                });
			                $(".paq-comparado2").scroll(function(){
		                    	$(".paq-comparado").scrollTop($(".paq-comparado2").scrollTop());
			                });
			                $(".paq-comparado3").scroll(function(){
		                    	$(".paq-comparado").scrollTop($(".paq-comparado3").scrollTop());
			                });
			                $(".paq-comparado4").scroll(function(){
		                    	$(".paq-comparado").scrollTop($(".paq-comparado4").scrollTop());
			                });
			                $(".paq-comparado5").scroll(function(){
		                    	$(".paq-comparado").scrollTop($(".paq-comparado5").scrollTop());
			                });
					    })
						i+=1;
					});
					$('#modal-comparador').show(function(){
						if($(".item").length>0){
							if($(".item").length=1){
								var primero=1,
									segundo=1,
									tercero=1
							}
							if($(".item").length==2){
								var primero=2,
									segundo=2,
									tercero=2
							}
							if($(".item").length>2){
								var primero=3,
									segundo=3,
									tercero=2
							}
							$("#owl-demo").owlCarousel({
					  		  	items : primero,
					  		  	itemsDesktop : [980,segundo],
					  		  	itemsDesktopSmall : [980,tercero],
					  		  	itemsTablet: [768,1],
					  			navigation: true,
					  			mouseDrag: false,
					  			touchDrag: false,
					  			navigationText: [
					  			  "<i class='material-icons'>navigate_before</i>",
					  			  "<i class='material-icons'>navigate_next</i>"
					  			  ],
					  			beforeInit : function(elem){
					  			  //Parameter elem pointing to $("#owl-demo")
					  			}
							});
						}
					}).animate({
					    top: 0
					},1000);
				}
			})

			function eliminarDelComparador(id_plan){
			//Funcion para eliminar planes dentro de la vista del comparador
				jQuery("#"+id_plan).remove();
				var id_plan="plan_"+id_plan;
				var VaciarComparador='<i class="material-icons">done</i>';
					$("."+id_plan).html(VaciarComparador);
					$( "#" + id_plan ).removeClass( "slctd-plan" );
					$( "." + id_plan ).removeClass( "span-bx-selected" );
					$( "." + id_plan ).removeClass( "slctd-plan" );
					$( "." + id_plan ).removeClass( id_plan );
				if($(".item").length>1){
					$("#owl-demo").data('owlCarousel').destroy();
					if($(".item").length==2){
						var primero=2,
							segundo=2,
							tercero=2
					}
					if($(".item").length>2){
						var primero=3,
							segundo=3,
							tercero=2
					}
					$("#owl-demo").owlCarousel({
			  		  	items : primero,
			  		  	itemsDesktop : [980,segundo],
			  		  	itemsDesktopSmall : [980,tercero],
			  		  	itemsTablet: [768,1],
			  			navigation: true,
			  			mouseDrag: false,
			  			touchDrag: false,
			  			navigationText: [
			  			  "<i class='material-icons'>navigate_before</i>",
			  			  "<i class='material-icons'>navigate_next</i>"
			  			  ],
			  			beforeInit : function(elem){
			  			  //Parameter elem pointing to $("#owl-demo")
			  			}
					});
				}else{
					jQuery( ".close-modal-btn" ).trigger( "click" );
				}		
			}

		//$.noConflict();
		jQuery(function() {
	  		FRMWRK.main.init();
	  		FRMWRK.comparador.init();
	  		function random(owlSelector){
	  			owlSelector.children().sort(function(){
	  				return Math.round(Math.random()) - 0.5;
	  			}).each(function(){
	  			  $(this).appendTo(owlSelector);
	  			});
	  		  }
	  		 $("#owl-demo").owlCarousel({
	  		  	items : 3,
	  		  	itemsDesktop : [980,3],
	  		  	itemsDesktopSmall : [980,2],
	  		  	itemsTablet: [768,1],
	  			navigation: true,
	  			mouseDrag: false,
	  			touchDrag: false,
	  			navigationText: [
	  			  "<i class='material-icons'>navigate_before</i>",
	  			  "<i class='material-icons'>navigate_next</i>"
	  			  ],
	  			beforeInit : function(elem){
	  			  //Parameter elem pointing to $("#owl-demo")
	  			}
			});
	  	});

	  	function CargarPlanesConFiltros(){
	  		//alert("Comparar!");
				//Funcion para revisar los SELECT del selector principal
				$.blockUI({ message: null });
				var target = document.createElement("div");
				document.body.appendChild(target);
				var spinner = new Spinner(opts).spin(target);
				var overlay = iosOverlay({
					text: "Cargando",
					spinner: spinner
				});
				var celular=0,internet=0,telefono=0,television=0,streaming=0;
				if(jQuery("#celular").hasClass( "active-selection" )){
					//alert("celular");
					celular=1;
					//console.log("celular");				
					sessionStorage.setItem("ServicioCelular","1");			
				}else{
					sessionStorage.setItem("ServicioCelular","0");
				}
				if(jQuery("#internet").hasClass( "active-selection" )){
					//alert("internet");
					internet=1;
					//console.log("internet");
					sessionStorage.setItem("ServicioInternet","1");	
				}else{
					sessionStorage.setItem("ServicioInternet","0");
				}
				if(jQuery("#telefono").hasClass( "active-selection" )){
					//alert("telefono");
					telefono=1;
					//console.log("telefono");
					sessionStorage.setItem("ServicioTelefono","1");	
				}else{
					sessionStorage.setItem("ServicioTelefono","0");
				}
				if(jQuery("#television").hasClass( "active-selection" )){
					//alert("television");
					television=1;
					sessionStorage.setItem("ServicioTelevision","1");
				}else{
					sessionStorage.setItem("ServicioTelevision","0");
				}
				if(jQuery("#streaming").hasClass( "active-selection" )){
					//alert("streaming");
					streaming=1;
					//console.log(streaming);
					sessionStorage.setItem("ServicioStreaming","1");
				}else{
					sessionStorage.setItem("ServicioStreaming","0");
				}

				if(sessionStorage.getItem("ServicioStreaming")==1){
					$( "#selectEstado" ).prop('disabled', 'disabled');
					var Filtros = [];
					var getFiltrosCheckEmpresasStreaming=JSON.parse(sessionStorage.getItem("filtrosCheckEmpresasStreaming"));
					var get1 = window["slidertest"]["noUiSlider"]["get"]();
					newFiltro = {};
	        		newFiltro['tipo'] = 'precio';
	        		newFiltro['Maximo'] = get1[1];
	        		newFiltro['Minimo'] = get1[0];
	        		//console.log(get1[0]);
	        		//console.log(get1[1]);
	        		Filtros.push(JSON.stringify(newFiltro));
	        		if (!(getFiltrosCheckEmpresasStreaming === null) )
					{	//console.log("filtros empresas")
						jQuery.each(getFiltrosCheckEmpresasStreaming, function( index, value ) {
							//console.log("id_tipoDato: "+value.empresa+" id del div: "+ value.value );
							var temp='#'+value.value;
							if (jQuery(temp).is(":checked"))
							{
								//console.log("valorCheck");
								newFiltro = {};
			        			newFiltro['tipo'] = 'checkEmpresas';
			        			newFiltro["empresa"] = value.empresa;	
				        		Filtros.push(JSON.stringify(newFiltro));						
							}
						});
					}
					if($('#ordenAscDesc').is(':checked')){
						var orden="DESC";
					}else{
						var orden="ASC";
					}
					var data=	{
							'Streamingfiltros[]':Filtros,
							orden:orden
					}
					//console.log(Filtros);
					//CargarPlanes();
					jQuery.ajax({
						type: "POST",
						url: "listado.php",
						async : false,
						data: data
					})
				    .done(function(data){
						jQuery("#planes").html(data);
						botones();
						VaciarComparador()
						jQuery('.modal-trigger').leanModal();
						window.setTimeout(function() {
							overlay.update({
								icon: "//cdn.tooth.me//assets/v3/assets/img/check.png",
								text: "Listo"
							});
						}, 1000);
						$(".cargarmas").hide();
						cargarmas();
						window.setTimeout(function() {
							overlay.hide();
						}, 2000);
						document.querySelector('#filter-go').scrollIntoView();
						setTimeout($.unblockUI, 3000);
				    })
				}else{
					$( "#selectEstado" ).removeAttr("disabled");
					var getFiltros= JSON.parse(sessionStorage.getItem("filtros"));
					var getFiltrosCheck= JSON.parse(sessionStorage.getItem("filtrosCheck"));
					var getFiltrosCheckEmpresas=JSON.parse(sessionStorage.getItem("filtrosCheckEmpresas"));
					var Filtros = [];
					//getFiltros.push("texto3");
					//console.log(getFiltros);
					var get1 = window["slidertest"]["noUiSlider"]["get"]();
					//console.log("get: "+get1[0]);
					//console.log("get: "+get1[1]);
					newFiltro = {};
	        		newFiltro['tipo'] = 'precio';
	        		newFiltro['Maximo'] = get1[1];
	        		newFiltro['Minimo'] = get1[0];
	        		Filtros.push(JSON.stringify(newFiltro));
	        		if (!(getFiltros === null))
					{
					    // items is null or []
					    jQuery.each(getFiltros, function( index, value ) {
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
					if (!(getFiltrosCheck === null) )
					{
						jQuery.each(getFiltrosCheck, function( index, value ) {
							//console.log("id_tipoDato: "+value.id_tipoDato+" id del div: "+ value.value );
							var temp='#'+value.value;
							if (jQuery(temp).is(":checked"))
							{
								//console.log("valorCheck");
								newFiltro = {};
			        			newFiltro['tipo'] = 'check';
			        			newFiltro["id_tipoDato"] = value.id_tipoDato;	
				        		Filtros.push(JSON.stringify(newFiltro));						
							}
						});
					}

					if (!(getFiltrosCheckEmpresas === null) )
					{	//console.log("filtros empresas")
						jQuery.each(getFiltrosCheckEmpresas, function( index, value ) {
							//console.log("id_tipoDato: "+value.empresa+" id del div: "+ value.value );
							var temp='#'+value.value;
							if (jQuery(temp).is(":checked"))
							{
								//console.log("valorCheck");
								newFiltro = {};
			        			newFiltro['tipo'] = 'checkEmpresas';
			        			newFiltro["empresa"] = value.empresa;	
				        		Filtros.push(JSON.stringify(newFiltro));						
							}
						});
					}
					if($('#ordenAscDesc').is(':checked')){
						var orden="DESC";
					}else{
						var orden="ASC";
					}
					if($('#checkboxRedes').is(':checked')){
						//console.log("checkboxRedes");
						var redesSociales= 1;
					}else{
						var redesSociales= 0;
					}
					var data=	{
							'filtros[]':Filtros,
							celular:sessionStorage.getItem("ServicioCelular"),
							internet:sessionStorage.getItem("ServicioInternet"),
							telefono:sessionStorage.getItem("ServicioTelefono"),
							television:sessionStorage.getItem("ServicioTelevision"),
							streaming:sessionStorage.getItem("ServicioStreaming"),
							estado:$( "#selectEstado" ).val(),
							orden:orden,
							redesSociales: redesSociales
					}
					//CargarPlanes();
					jQuery.ajax({
						type: "POST",
						url: "listado.php",
						data: data,
						async: false
					})
				    .done(function(data){
				    	if(sessionStorage.getItem("ServicioCelular")==1){
				    	}
						jQuery("#planes").html(data);
						if($(".cargarmas").length<1){
							jQuery("#planes").html('<h1 class="nocriteria center">No hay resultados que mostrar con los criterios seleccionados.</h1>');
							//location.reload();
						}
						botones();
						VaciarComparador();
						jQuery('.modal-trigger').leanModal();
						$(".cargarmas").hide();
						cargarmas();
						window.setTimeout(function() {
							overlay.update({
								icon: "//cdn.tooth.me//assets/v3/assets/img/check.png",
								text: "Listo"
							});
						}, 1000);

						window.setTimeout(function() {
							overlay.hide();
						}, 2000);
						//document.querySelector('.discover-title').scrollIntoView();
						document.querySelector('#filter-go').scrollIntoView();
						setTimeout($.unblockUI, 3000);
				    })
				    .fail(function(data){
				    	setTimeout($.unblockUI, 1000);
				    	window.setTimeout(function() {
							overlay.update({
								icon: "//cdn.tooth.me//assets/v3/assets/img/check.png",
								text: "ERROR"
							});
						}, 1000);
						window.setTimeout(function() {
							overlay.hide();
						}, 2000);
						document.querySelector('#filter-go').scrollIntoView();
						setTimeout($.unblockUI, 3000);
						window.location.href = "index.php";
				    })
				}
				checkMobile();
	  	}//function CargarPlanesConFiltros()
	  	function habilitar(item,value) {
			CargarFiltrosCheckEmpresasConFiltro();
			if($('#checkbox1').is(':checked')){
		    	$('input.checkbox1').removeAttr("disabled");

			}
			if(!$('#checkbox1').is(':checked')){
		    	$( "input.checkbox1" ).prop( "checked", false );
		    	$('input.checkbox1').attr("disabled", true);
		    }
			CargarPlanesConFiltros();
		}
		
		$("#ordenAscDesc").change(function(){
			//alert($( "#selectEstado" ).val());
			CargarPlanesConFiltros();
		})
		 
		$("#SelectDeEstados").change(function(){
			//alert($( "#selectEstado" ).val());
			sessionStorage.setItem("estado",$( "#selectEstado" ).val());	
			$.when(
				CargarPlanes()
			).then(function(){
			   //alert('All AJAX Methods Have Completed!');
			   if($(".cargarmas").length>1 || $(".planmostrado").length>1){
				   	CargarFiltrosCheckEmpresas();
				   	if(sessionStorage.getItem("ServicioCelular")==1){
						CargarFiltrosCheck();
					}else{
						jQuery("#filtrosCheckCelulares").html("");		

					}
					CargarFiltrosSliders();
				}else{
					jQuery("#filtrosCheck").html("");
					jQuery("#filtrosCheckEmpresas").html("");
					jQuery("#filtros").html("");	
					jQuery("#filtrosCheckCelulares").html("");		
	
				}
			});
		})

		jQuery(document).ready(function(){
			var urlGet=decodeURIComponent(window.location.href);
			if((urlGet.indexOf("plan") > -1) && (urlGet.indexOf("l=") > -1) && (urlGet.indexOf("s") > -1) ) {
		       //alert("your url contains plan");

		       	var getUrlParameterPlan = function getUrlParameterPlan(sParam) {
				    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
				        sURLVariables = sPageURL.split('&'),
				        sParameterName,
				        i;
		        	var cantidadURL=0;
		        	var ids= new Array();
				    for (i = 0; i < sURLVariables.length; i++) {
				        sParameterName = sURLVariables[i].split('=');

				        if (sParameterName[0].indexOf(sParam) > -1) {
				            //return sParameterName[1] === undefined ? true : alert(sParameterName[1]);
				            if (sParameterName[1] !== undefined){
				            	jQuery( "#plan_"+sParameterName[1] ).trigger( "click" );
				            	cantidadURL+=1;
				            	ids.push(sParameterName[1]);
				            }
				        }
				    }
				    if(cantidadURL==1){
				        	//alert("Seleccionar ver detalles");
				        	jQuery( ".verplan_"+ids[0] ).trigger( "click" );
				    }else{
				    	jQuery( "#btnComparar" ).trigger( "click" );
				    }
				};
				var getUrlParameterServicio = function getUrlParameterServicio(sParam) {
				    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
				        sURLVariables = sPageURL.split('&'),
				        sParameterName,
				        i;
					sessionStorage.setItem("ServicioCelular","0");			
					sessionStorage.setItem("ServicioTelefono","0");
					sessionStorage.setItem("ServicioInternet","0");
					sessionStorage.setItem("ServicioTelevision","0");
					sessionStorage.setItem("ServicioStreaming","0");
				    for (i = 0; i < sURLVariables.length; i++) {
				        sParameterName = sURLVariables[i].split('=');


				        if (sParameterName[0].indexOf(sParam) > -1) {
				            //return sParameterName[1] === undefined ? true : alert(sParameterName[1]);

				            if (sParameterName[1] !== undefined){
				            	if(sParameterName[1]==1){
									sessionStorage.setItem("ServicioCelular","1");
									//console.log("Celular URL")			
								}
								if(sParameterName[1]==2){
									sessionStorage.setItem("ServicioTelefono","1");	
								}
								if(sParameterName[1]==3){
									sessionStorage.setItem("ServicioInternet","1");	
								}
								if(sParameterName[1]==4){
									sessionStorage.setItem("ServicioTelevision","1");
								}
								if(sParameterName[1]==5){
									sessionStorage.setItem("ServicioStreaming","1");
								}
				            }
				        }
				    }
				};
				var getUrlParameterLocation = function getUrlParameterLocation(sParam) {
				    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
				        sURLVariables = sPageURL.split('&'),
				        sParameterName,
				        i;

				    for (i = 0; i < sURLVariables.length; i++) {
				        sParameterName = sURLVariables[i].split('=');

				        if (sParameterName[0] === sParam) {
				            //return sParameterName[1] === undefined ? true : alert(sParameterName[1]);
				            if (sParameterName[1] !== undefined){
				            	sessionStorage.setItem("estado",sParameterName[1]);
				            }
				        }
				    }
				};
				//alert(getUrlParameter("plan[]"));
				getUrlParameterLocation("l");
				getUrlParameterServicio("s");
				//console.log(sessionStorage.getItem("CargaInicial"))
				$.when(
	   			CargarEstados(),
				VerificarServicios(),
				Seleccion()
			
				).then(function(){
				   //alert('All AJAX Methods Have Completed!');
				   sessionStorage.setItem("CargaInicial", "0");
				   CargarPlanes();
				   getUrlParameterPlan("plan");
				   CargarFiltrosSliders();
				});
				CargarAnuncio();
				document.querySelector('#filter-go').scrollIntoView();
				jQuery('#slideshow').fadeSlideShow();

		    }else{
		    	$.when(
	   			CargarEstados(),
				VerificarServicios(),
				Seleccion()
			
				).then(function(){
				   //alert('All AJAX Methods Have Completed!');
				   sessionStorage.setItem("CargaInicial", "0");
				   CargarPlanes();
				   CargarFiltrosSliders();
				});
				CargarAnuncio();
				document.querySelector('#filter-go').scrollIntoView();
				jQuery('#slideshow').fadeSlideShow();
		    }
		});//document ready
		jQuery('.products-box').click(function() {
			var celular=0,internet=0,telefono=0,television=0,streaming=0,CambioEnServicio=0;
			var contador=0;
			sessionStorage.removeItem("filtros");
			sessionStorage.removeItem("filtrosCheck");
			sessionStorage.removeItem("filtrosCheckEmpresas");
			if(jQuery("#celular").hasClass( "active-selection" )){
				celular=1;
				contador+=1;
				if(sessionStorage.getItem("ServicioCelular")!=1){
					CambioEnServicio=1;
					sessionStorage.setItem("ServicioCelular","1");
					//console.log("CELULAR");			
				}
			}else{
				if(sessionStorage.getItem("ServicioCelular")!=0){
					CambioEnServicio=1;
					sessionStorage.setItem("ServicioCelular","0");
				}
			}
			if(jQuery("#internet").hasClass( "active-selection" )){
				internet=1;
				contador+=1;
				if(sessionStorage.getItem("ServicioInternet")!=1){
					CambioEnServicio=1;
					sessionStorage.setItem("ServicioInternet","1");	
					//console.log("INTERNET");		
				}	
			}else{
				if(sessionStorage.getItem("ServicioInternet")!=0){
					CambioEnServicio=1;
					sessionStorage.setItem("ServicioInternet","0");	
					//console.log("INTERNET");		
				}	
			}
			if(jQuery("#telefono").hasClass( "active-selection" )){
				telefono=1;
				contador+=1;
				if(sessionStorage.getItem("ServicioTelefono")!=1){
					CambioEnServicio=1;
					sessionStorage.setItem("ServicioTelefono","1");	
					//console.log("INTERNET");		
				}	
				//console.log("TELEFONO");	
			}else{
				if(sessionStorage.getItem("ServicioTelefono")!=0){
					CambioEnServicio=1;
					sessionStorage.setItem("ServicioTelefono","0");	
					//console.log("INTERNET");		
				}	
			}
			if(jQuery("#television").hasClass( "active-selection" )){
				television=1;
				contador+=1;
				if(sessionStorage.getItem("ServicioTelevision")!=1){
					CambioEnServicio=1;
					sessionStorage.setItem("ServicioTelevision","1");	
					//console.log("INTERNET");		
				}	
			}else{
				if(sessionStorage.getItem("ServicioTelevision")!=0){
					CambioEnServicio=1;
					sessionStorage.setItem("ServicioTelevision","0");	
					//console.log("INTERNET");		
				}	
			}
			if(jQuery("#streaming").hasClass( "active-selection" )){
				contador+=1;
				if(sessionStorage.getItem("ServicioStreaming")!=1){
					CambioEnServicio=1;
					sessionStorage.setItem("ServicioStreaming","1");	
					//console.log("INTERNET");		
				}	
			}else{
				if(sessionStorage.getItem("ServicioStreaming")!=0){
					CambioEnServicio=1;
					sessionStorage.setItem("ServicioStreaming","0");	
					//console.log("INTERNET");		
				}	
			}

			var celular=sessionStorage.getItem("ServicioCelular");
		    var telefono=sessionStorage.getItem("ServicioTelefono");
		    var internet=sessionStorage.getItem("ServicioInternet");
		    var television=sessionStorage.getItem("ServicioTelevision");
		    var streaming=sessionStorage.getItem("ServicioStreaming");
		    //console.log("contador: "+contador);
			if(sessionStorage.getItem("ServicioStreaming")==1){
				$( "#selectEstado" ).prop('disabled', 'disabled');
			}else{
				$( "#selectEstado" ).removeAttr("disabled");
			}
			if(contador>0 && CambioEnServicio==1){
			    CargarPlanes();
			    if($(".cargarmas").length>1 || $(".planmostrado").length>1){
					CargarFiltrosCheckEmpresas();
					if(sessionStorage.getItem("ServicioCelular")==1){
						CargarFiltrosCheck();
					}else{
						jQuery("#filtrosCheckCelulares").html("");		
					}
					CargarFiltrosSliders();
				}else{
					jQuery("#filtrosCheck").html("");
					jQuery("#filtrosCheckEmpresas").html("");
					jQuery("#filtros").html("");
					jQuery("#filtrosCheckCelulares").html("");		

				}
			}
		});

		function CargarPlanes(){
			if($('#ordenAscDesc').is(':checked')){
				var orden="DESC";
			}else{
				var orden="ASC";
			}
			//console.log(orden);
        	$.blockUI({ message: null }); 

			var target = document.createElement("div");
			document.body.appendChild(target);
			var spinner = new Spinner(opts).spin(target);
			var overlay = iosOverlay({
				text: "Cargando",
				spinner: spinner
			});
			if(sessionStorage.getItem("ServicioStreaming")==1){
				$( "#selectEstado" ).prop('disabled', 'disabled');
				//alert("Streaming");
				var data={
					CargarPlanesStreaming:"true",
					orden:orden
				}
			}else{
				$( "#selectEstado" ).removeAttr("disabled");
				var data={
					listadoSimple:"true",
					CargarPlanes:"true",
					celular:sessionStorage.getItem("ServicioCelular"),
					internet:sessionStorage.getItem("ServicioInternet"),
					telefono:sessionStorage.getItem("ServicioTelefono"),
					television:sessionStorage.getItem("ServicioTelevision"),
					streaming:sessionStorage.getItem("ServicioStreaming"),
					estado:sessionStorage.getItem("estado"),
					orden:orden
				}
			}
			jQuery.ajax({
				type: "POST",
				url: "listado.php",
				data: data,
				async : false

			})
		    .done(function(data){
				jQuery("#planes").html(data);
				if($(".cargarmas").length<1){
					jQuery("#planes").html('<h1 class="nocriteria center">No hay resultados que mostrar con los criterios seleccionados.</h1>');
					jQuery("#filtrosCheck").html("");
					jQuery("#filtrosCheckEmpresas").html("");
					jQuery("#filtros").html("");
					jQuery("#filtrosCheckCelulares").html("");
					//location.reload();		
				}
				if($(".cargarmas").length==1){
					jQuery("#filtrosCheck").html("");
					jQuery("#filtrosCheckEmpresas").html("");
					jQuery("#filtros").html("");
					jQuery("#filtrosCheckCelulares").html("");
				}
				botones();
				VaciarComparador();
				jQuery('.modal-trigger').leanModal();
				$(".cargarmas").hide();
				cargarmas();
				window.setTimeout(function() {
					overlay.update({
						icon: "//cdn.tooth.me//assets/v3/assets/img/check.png",
						text: "Listo"
					});
				}, 1000);
				window.setTimeout(function() {
					overlay.hide();
				}, 2000);
				//document.querySelector('.discover-title').scrollIntoView();
				document.querySelector('#filter-go').scrollIntoView();
				setTimeout($.unblockUI, 3000);
				/*
				if(sessionStorage.getItem("ServicioCelular")==1){
					jQuery( "#checkbox1" ).trigger( "click" );
					habilitar();
				}
				*/


		    })
		    .fail(function(data){
		    	console.log(data);
		    	setTimeout($.unblockUI, 1000);
				window.setTimeout(function() {
					overlay.update({
						icon: "//cdn.tooth.me//assets/v3/assets/img/check.png",
						text: "Listo"
					});
				}, 1000);
				window.setTimeout(function() {
					overlay.hide();
				}, 2000);
				window.setTimeout(function() {
					overlay.hide();
				}, 2000);
				document.querySelector('#filter-go').scrollIntoView();
				setTimeout($.unblockUI, 3000);
				window.location.href = "index.php";
		    });
		    checkMobile();
		}//function CargarPlanes()

		function CargarFiltrosSliders(){
			if(sessionStorage.getItem("ServicioStreaming")==1){
				$( "#selectEstado" ).prop('disabled', 'disabled');
				var data={
					CargarSliderStreaming:"true"
				}
				jQuery.ajax({
					type: "POST",
					url: "listado.php",
					async : false,
					data: data
				})
			    .done(function(data){
					jQuery("#filtros").html(data);	 	
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
			 		$('.sliders-scroll-bx').mCustomScrollbar("update");
			    })
			    .fail(function(data){
			    	console.log(data);
			    	//console.log("Error llamada en llamada Streaming a CargarFiltrosSliders");
			    });
			}else{
				$( "#selectEstado" ).removeAttr("disabled");
				var data={
					listadoSimple:"true",
					CargarFiltrosSliders:"true",
					celular:sessionStorage.getItem("ServicioCelular"),
					internet:sessionStorage.getItem("ServicioInternet"),
					telefono:sessionStorage.getItem("ServicioTelefono"),
					television:sessionStorage.getItem("ServicioTelevision"),
					streaming:sessionStorage.getItem("ServicioStreaming"),
					estado:sessionStorage.getItem("estado")
				}
				jQuery.ajax({
					type: "POST",
					url: "listado.php",
					async : false,
					data: data
				})
			    .done(function(data){
					jQuery("#filtros").html(data);
					var _widthSlides = 0;
			 		jQuery('.sliders-wrapp .slider-bx').each(function() {
			 		    _widthSlides += jQuery(this).outerWidth( true );
			 		});
			 		jQuery('#filtros').css('width', _widthSlides);
			 		if (isMobile.any == false) {
			 			jQuery(".sliders-scroll-bx").mCustomScrollbar({
							axis: "x",
							theme: "dark-thin",
							autoHideScrollbar: true,
							updateOnContentResize: true
						});
						jQuery(".checks-scroll-bx form").mCustomScrollbar({
							axis: "y",
							theme: "dark-thin",
							autoHideScrollbar: true,
							updateOnContentResize: true
						});
						/*
						$(".slide-bar-bx").mouseup(function() {
						    CargarPlanesConFiltros();
						})
						*/
						$(".sliders-scroll-bx .sliders-wrapp").mCustomScrollbar("update");

			 		}else {
			 			jQuery(".sliders-scroll-bx, .checks-scroll-bx form .sliders-wrapp").addClass('ismobilescroll');
			 		}
			 		$('.sliders-scroll-bx').mCustomScrollbar("update");
			    })
			    .fail(function(data){
			    	console.log(data);
			    	//console.log("Error llamada en llamada cargo CargarFiltrosSliders");
			    });
			}
			//_fixedFiltersBx();
		}

		function CargarFiltrosCheck(){
			if(sessionStorage.getItem("ServicioStreaming")!=1){
				if(sessionStorage.getItem("ServicioCelular")==1){
					var data={
						listadoSimple:"true",
						CargarFiltrosCheckCelulares:"true",
						celular:sessionStorage.getItem("ServicioCelular"),
						internet:sessionStorage.getItem("ServicioInternet"),
						telefono:sessionStorage.getItem("ServicioTelefono"),
						television:sessionStorage.getItem("ServicioTelevision"),
						streaming:sessionStorage.getItem("ServicioStreaming"),
						estado:sessionStorage.getItem("estado")
					}
					jQuery.ajax({
						type: "POST",
						url: "listado.php",
						async : false,
						data: data
					})
				    .done(function(data){
						jQuery("#filtrosCheckCelulares").html(data);
						if(document.getElementsByClassName("input.checkbox1")){
							$('input.checkbox1').attr("disabled", true);
						}
						var _widthSlides = 0;
				 		jQuery('.sliders-wrapp .slider-bx').each(function() {
				 		    _widthSlides += jQuery(this).outerWidth( true );
				 		});
				 		jQuery('.sliders-wrapp').css('width', _widthSlides);
				 	
				 		if (isMobile.any == false) {
				 			jQuery(".sliders-scroll-bx").mCustomScrollbar({
								axis: "x",
								theme: "dark-thin",
								autoHideScrollbar: true,
								updateOnContentResize: true
							});
							jQuery(".checks-scroll-bx form").mCustomScrollbar({
								axis: "y",
								theme: "dark-thin",
								autoHideScrollbar: true,
								updateOnContentResize: true
							});
				 		}else {
				 			jQuery(".sliders-scroll-bx, .checks-scroll-bx form").addClass('ismobilescroll');
				 		}
				    })
				    .fail(function(data){
				    	console.log(data);
				    });
				    /* No cargar filtros Check
				    var data={
						listadoSimple:"true",
						CargarFiltrosCheck:"true",
						CargarRedes:true,
						celular:sessionStorage.getItem("ServicioCelular"),
						internet:sessionStorage.getItem("ServicioInternet"),
						telefono:sessionStorage.getItem("ServicioTelefono"),
						television:sessionStorage.getItem("ServicioTelevision"),
						streaming:sessionStorage.getItem("ServicioStreaming"),
						estado:$( "#selectEstado" ).val()
					}
					jQuery.ajax({
						type: "POST",
						url: "listado.php",
						async : false,
						data: data
					})
				    .done(function(data){
						jQuery("#filtrosCheck").html(data);
						if(document.getElementsByClassName("input.checkbox1")){
							$('input.checkbox1').attr("disabled", true);
						}
				    })
				    .fail(function(data){
				    	console.log(data);
				    });
				    */

				}else{
					/* No cargar filtros Check
					var data={
						listadoSimple:"true",
						CargarFiltrosCheck:"true",
						celular:sessionStorage.getItem("ServicioCelular"),
						internet:sessionStorage.getItem("ServicioInternet"),
						telefono:sessionStorage.getItem("ServicioTelefono"),
						television:sessionStorage.getItem("ServicioTelevision"),
						streaming:sessionStorage.getItem("ServicioStreaming"),
						estado:$( "#selectEstado" ).val()
					}
					jQuery.ajax({
						type: "POST",
						url: "listado.php",
						async : false,
						data: data
					})
				    .done(function(data){
						jQuery("#filtrosCheck").html(data);
						jQuery("#filtrosCheckCelulares").html("");
						if(document.getElementsByClassName("input.checkbox1")){
							$('input.checkbox1').attr("disabled", true);
						}
				    })
				    .fail(function(data){
				    	console.log(data);
				    });
				    */
				}
			}
		}
		function CargarFiltrosCheckEmpresas(){
			if(sessionStorage.getItem("ServicioStreaming")==1){
				$( "#selectEstado" ).prop('disabled', 'disabled');
				var data={
					CargarFiltrosCheckEmpresasStreaming:"true"
				}
				jQuery.ajax({
					type: "POST",
					url: "listado.php",
					async : false,
					data: data
				})
			    .done(function(data){
					jQuery("#filtrosCheckEmpresas").html(data);

			    })
			    .fail(function(data){
			    	console.log(data);
			    });

			}else{
				$( "#selectEstado" ).removeAttr("disabled");
				var data={
					listadoSimple:"true",
					CargarFiltrosCheckEmpresas:"true",
					celular:sessionStorage.getItem("ServicioCelular"),
					internet:sessionStorage.getItem("ServicioInternet"),
					telefono:sessionStorage.getItem("ServicioTelefono"),
					television:sessionStorage.getItem("ServicioTelevision"),
					streaming:sessionStorage.getItem("ServicioStreaming"),
					estado:$( "#selectEstado" ).val()
				}
				jQuery.ajax({
					type: "POST",
					url: "listado.php",
					async : false,
					data: data
				})
			    .done(function(data){
					jQuery("#filtrosCheckEmpresas").html(data);

			    })
			    .fail(function(data){
			    	console.log(data);
			    });
		  	}
		}
		function VerificarServicios(){
		    var celular=sessionStorage.getItem("ServicioCelular");
		    var telefono=sessionStorage.getItem("ServicioTelefono");
		    var internet=sessionStorage.getItem("ServicioInternet");
		    var television=sessionStorage.getItem("ServicioTelevision");
		    var streaming=sessionStorage.getItem("ServicioStreaming");
		    if(celular=="1"){
		    	jQuery( "#celular, .cellplan" ).trigger( "click" );
		    	//console.log("celular");
		    }
		    if(telefono=="1"){
		    	jQuery( "#telefono" ).trigger( "click" );
		    	//console.log("telefono");
		    	//console.log(jQuery( "#telefono" ));
		    }
		    if(internet=="1"){
		    	jQuery( "#internet, .tripleplay3" ).trigger( "click" );
		    	//console.log("internet");
		    }
		    if(television=="1"){
		    	jQuery( "#television, .tripleplay2" ).trigger( "click" );
		    	//console.log("television");
		    }
		    if(streaming=="1"){
		    	jQuery( "#streaming, .streaming" ).trigger( "click" );
		    	//console.log("streaming");
		    }
		    sessionStorage.setItem("CargaInicial", "1");

		}

		function Seleccion(){
			var CargaInicial= sessionStorage.getItem("CargaInicial");
			var celular=0,internet=0,telefono=0,television=0,streaming=0;
			var contador=0;
			//console.log("carga inicial: "+CargaInicial);
			if (CargaInicial == 1)
			{
				//console.log("seleccion()");
					if(jQuery("#celular").hasClass( "active-selection" )){
						celular=1;
						contador+=1;
						sessionStorage.setItem("ServicioCelular","1");
						//console.log("CELULAR");			
					}else{
						sessionStorage.setItem("ServicioCelular","0");
					}
					if(jQuery("#internet").hasClass( "active-selection" )){
						internet=1;
						contador+=1;
						sessionStorage.setItem("ServicioInternet","1");	
						//console.log("INTERNET");			
					}else{
						sessionStorage.setItem("ServicioInternet","0");
					}
					if(jQuery("#telefono").hasClass( "active-selection" )){
						telefono=1;
						contador+=1;
						sessionStorage.setItem("ServicioTelefono","1");
						//console.log("TELEFONO");	
					}else{
						sessionStorage.setItem("ServicioTelefono","0");
					}
					if(jQuery("#television").hasClass( "active-selection" )){
						television=1;
						contador+=1;
						//sessionStorage.setItem("ServicioTelevision","1");
					}else{
						sessionStorage.setItem("ServicioTelevision","0");
					}
					if(jQuery("#streaming").hasClass( "active-selection" )){
						contador+=1;
						sessionStorage.setItem("ServicioStreaming","1");
					}else{
						sessionStorage.setItem("ServicioStreaming","0");
					}


					//CargarFiltrosSliders();
					if(sessionStorage.getItem("ServicioCelular")==1){
						CargarFiltrosCheck();
					}
					CargarFiltrosCheckEmpresas();
					VaciarComparador();
			}
		}
		function CargarEstados(){
			var data={
				SelectDeEstados:"true",
				estado:sessionStorage.getItem("estado")
			}
			jQuery.ajax({
				type: "POST",
				url: "listado.php",
				data: data
			})
		    .done(function(data){
				jQuery("#SelectDeEstados").html(data);
		    })
		    .fail(function(data){
		    	console.log(data);
		    	window.location.href = "index.php";
		    });
		}
		function VaciarComparador(){
			var VaciarComparador='<i class="material-icons">done</i>';
			$( "#span-bx1" ).html(VaciarComparador);
			$( "#span-bx1" ).removeClass( "slctd-plan" );
			$( "#span-bx1" ).removeClass( "span-bx-selected" );
			$( "#span-bx1" ).removeClass( "slctd-plan" );
			$( "#span-bx2" ).html(VaciarComparador);
			$( "#span-bx2" ).removeClass( "slctd-plan" );
			$( "#span-bx2" ).removeClass( "span-bx-selected" );
			$( "#span-bx2" ).removeClass( "slctd-plan" );
			$( "#span-bx3" ).html(VaciarComparador);
			$( "#span-bx3" ).removeClass( "slctd-plan" );
			$( "#span-bx3" ).removeClass( "span-bx-selected" );
			$( "#span-bx3" ).removeClass( "slctd-plan" );
			$( "#span-bx4" ).html(VaciarComparador);
			$( "#span-bx4" ).removeClass( "slctd-plan" );
			$( "#span-bx4" ).removeClass( "span-bx-selected" );
			$( "#span-bx4" ).removeClass( "slctd-plan" );
			$( "#span-bx5" ).html(VaciarComparador);
			$( "#span-bx5" ).removeClass( "slctd-plan" );
			$( "#span-bx5" ).removeClass( "span-bx-selected" );
			$( "#span-bx5" ).removeClass( "slctd-plan" );
			$( "#span-bx6" ).html(VaciarComparador);
			$( "#span-bx6" ).removeClass( "slctd-plan" );
			$( "#span-bx6" ).removeClass( "span-bx-selected" );
			$( "#span-bx6" ).removeClass( "slctd-plan" );
		}
		function Comparar(item,id_plan,color){
			var plan="#plan_"+id_plan;
			var itemid="'"+item.id+"'";
			if($(".span-bx-selected").length<6 || $(".span-bx-selected").length==null || $( "."+item.id ).hasClass( item.id ) ){
				if($( "#"+item.id ).hasClass( "slctd-plan" )){
					var VaciarComparador='<i class="material-icons">done</i>';
					$("."+item.id).html(VaciarComparador);
					$( "#" + item.id ).removeClass( "slctd-plan" );
					$( "." + item.id ).removeClass( "span-bx-selected" );
					$( "." + item.id ).removeClass( "slctd-plan" );
					$( "." + item.id ).removeClass( item.id );
				}else{
					$("#"+ item.id ).addClass( "slctd-plan" );
					if(!$( "#span-bx1" ).hasClass( "slctd-plan" )){
						var planSeleccionado='<span style="background-color:'+color+';"></span><i id="span-bx1" onclick="RemoverSeleccionado(this,'+itemid+')" class="material-icons selected-check">done</i>';
						$("#span-bx1" ).addClass( "slctd-plan" );
						$("#span-bx1" ).addClass( "span-bx-selected" );
						$("#span-bx1" ).addClass( item.id );
						$("#span-bx1" ).attr("value",id_plan);
						$("#span-bx1").html(planSeleccionado);
					}else{
						if(!$( "#span-bx2" ).hasClass( "slctd-plan" )){
							var planSeleccionado='<span style="background-color:'+color+';"></span><i id="span-bx2" onclick="RemoverSeleccionado(this,'+itemid+')" class="material-icons selected-check">done</i>';
							$("#span-bx2" ).addClass( "slctd-plan" );
							$("#span-bx2" ).addClass( "span-bx-selected" );
							$("#span-bx2" ).addClass( item.id );
							$("#span-bx2" ).attr("value",id_plan);
							$("#span-bx2").html(planSeleccionado);
						}else{
							if(!$( "#span-bx3" ).hasClass( "slctd-plan" )){
								var planSeleccionado='<span style="background-color:'+color+';"></span><i id="span-bx3" onclick="RemoverSeleccionado(this,'+itemid+')" class="material-icons selected-check">done</i>';
								$("#span-bx3" ).addClass( "slctd-plan" );
								$("#span-bx3" ).addClass( "span-bx-selected" );
								$("#span-bx3" ).addClass( item.id );
								$("#span-bx3" ).attr("value",id_plan);
								$("#span-bx3").html(planSeleccionado);
							}else{
								if(!$( "#span-bx4" ).hasClass( "slctd-plan" )){
									var planSeleccionado='<span style="background-color:'+color+';"></span><i id="span-bx4" onclick="RemoverSeleccionado(this,'+itemid+')" class="material-icons selected-check">done</i>';
									$("#span-bx4" ).addClass( "slctd-plan" );
									$("#span-bx4" ).addClass( "span-bx-selected" );
									$("#span-bx4" ).addClass( item.id );
									$("#span-bx4" ).attr("value",id_plan);
									$("#span-bx4").html(planSeleccionado);
								}else{
									if(!$( "#span-bx5" ).hasClass( "slctd-plan" )){
										var planSeleccionado='<span style="background-color:'+color+';"></span><i id="span-bx5" onclick="RemoverSeleccionado(this,'+itemid+')" class="material-icons selected-check">done</i>';
										$("#span-bx5" ).addClass( "slctd-plan" );
										$("#span-bx5" ).addClass( "span-bx-selected" );	
										$("#span-bx5" ).addClass( item.id );
										$("#span-bx5" ).attr("value",id_plan);			
										$("#span-bx5").html(planSeleccionado);
									}else{
										if(!$("#span-bx6" ).hasClass( "slctd-plan" )){
											var planSeleccionado='<span style="background-color:'+color+';"></span><i id="span-bx6" onclick="RemoverSeleccionado(this,'+itemid+')" class="material-icons selected-check">done</i>';
											$("#span-bx6" ).addClass( "slctd-plan" );
											$("#span-bx6" ).addClass( "span-bx-selected" );
											$("#span-bx6" ).addClass( item.id );
											$("#span-bx6" ).attr("value",id_plan);
											$("#span-bx6").html(planSeleccionado);
										}
									}
								}
							}
						}
					}
				}
			}else{
				alert("Debe seleccionar máximo 6 planes para comparar");
			}
			if(($(".span-bx-selected").length<2 || $(".span-bx-selected").length==null)){
				$("#btnComparar" ).addClass( "noCompare" );
			}else{
				$("#btnComparar" ).removeClass( "noCompare" );
			}
			return false;
		}
		function RemoverSeleccionado(item,plan){
			var VaciarComparador='<i class="material-icons">done</i>';
			var idplan="plan_"+plan;
			$("#"+item.id).html(VaciarComparador);
			$("#"+item.id ).removeClass( "slctd-plan" );
			$("#"+item.id ).removeClass( "span-bx-selected" );
			$("#"+item.id ).removeClass( idplan );
			$("#"+ plan ).removeClass( "slctd-plan" );	
			if(($(".span-bx-selected").length<2 || $(".span-bx-selected").length==null)){
				$("#btnComparar" ).addClass( "noCompare" );
			}else{
				$("#btnComparar" ).removeClass( "noCompare" );
			}
		}

		function CompararPaqueteOTT(item,id_plan){
			var plan="#plan_"+id_plan;
			var itemid="'"+item.id+"'";
			var color="#000";
			if($(".span-bx-selected").length<6 || $(".span-bx-selected").length==null){
				if($( "#"+item.id ).hasClass( "slctd-plan" )){
					var VaciarComparador='<i class="material-icons">done</i>';
					$("."+item.id).html(VaciarComparador);
					$( "#" + item.id ).removeClass( "slctd-plan" );
					$( "." + item.id ).removeClass( "span-bx-selected" );
					$( "." + item.id ).removeClass( "slctd-plan" );
					$( "." + item.id ).removeClass( item.id );
				}else{
					$("#"+ item.id ).addClass( "slctd-plan" );
					if(!$( "#span-bx1" ).hasClass( "slctd-plan" )){
						var planSeleccionado='<span style="background-color:'+color+';"></span><i id="span-bx1" onclick="RemoverSeleccionado(this,'+itemid+')" class="material-icons selected-check">done</i>';
						$("#span-bx1" ).addClass( "slctd-plan" );
						$("#span-bx1" ).addClass( "span-bx-selected" );
						$("#span-bx1" ).addClass( item.id );
						$("#span-bx1" ).attr("value",id_plan);
						$("#span-bx1").html(planSeleccionado);
					}else{
						if(!$( "#span-bx2" ).hasClass( "slctd-plan" )){
							var planSeleccionado='<span style="background-color:'+color+';"></span><i id="span-bx2" onclick="RemoverSeleccionado(this,'+itemid+')" class="material-icons selected-check">done</i>';
							$("#span-bx2" ).addClass( "slctd-plan" );
							$("#span-bx2" ).addClass( "span-bx-selected" );
							$("#span-bx2" ).addClass( item.id );
							$("#span-bx2" ).attr("value",id_plan);
							$("#span-bx2").html(planSeleccionado);
						}else{
							if(!$( "#span-bx3" ).hasClass( "slctd-plan" )){
								var planSeleccionado='<span style="background-color:'+color+';"></span><i id="span-bx3" onclick="RemoverSeleccionado(this,'+itemid+')" class="material-icons selected-check">done</i>';
								$("#span-bx3" ).addClass( "slctd-plan" );
								$("#span-bx3" ).addClass( "span-bx-selected" );
								$("#span-bx3" ).addClass( item.id );
								$("#span-bx3" ).attr("value",id_plan);
								$("#span-bx3").html(planSeleccionado);
							}else{
								if(!$( "#span-bx4" ).hasClass( "slctd-plan" )){
									var planSeleccionado='<span style="background-color:'+color+';"></span><i id="span-bx4" onclick="RemoverSeleccionado(this,'+itemid+')" class="material-icons selected-check">done</i>';
									$("#span-bx4" ).addClass( "slctd-plan" );
									$("#span-bx4" ).addClass( "span-bx-selected" );
									$("#span-bx4" ).addClass( item.id );
									$("#span-bx4" ).attr("value",id_plan);
									$("#span-bx4").html(planSeleccionado);
								}else{
									if(!$( "#span-bx5" ).hasClass( "slctd-plan" )){
										var planSeleccionado='<span style="background-color:'+color+';"></span><i id="span-bx5" onclick="RemoverSeleccionado(this,'+itemid+')" class="material-icons selected-check">done</i>';
										$("#span-bx5" ).addClass( "slctd-plan" );
										$("#span-bx5" ).addClass( "span-bx-selected" );	
										$("#span-bx5" ).addClass( item.id );
										$("#span-bx5" ).attr("value",id_plan);			
										$("#span-bx5").html(planSeleccionado);
									}else{
										if(!$("#span-bx6" ).hasClass( "slctd-plan" )){
											var planSeleccionado='<span style="background-color:'+color+';"></span><i id="span-bx6" onclick="RemoverSeleccionado(this,'+itemid+')" class="material-icons selected-check">done</i>';
											$("#span-bx6" ).addClass( "slctd-plan" );
											$("#span-bx6" ).addClass( "span-bx-selected" );
											$("#span-bx6" ).addClass( item.id );
											$("#span-bx6" ).attr("value",id_plan);
											$("#span-bx6").html(planSeleccionado);
										}
									}
								}
							}
						}
					}
				}
			}else{
				alert("Debe seleccionar máximo 6 planes para comparar");
			}
			if(($(".span-bx-selected").length<2 || $(".span-bx-selected").length==null)){
				$("#btnComparar" ).addClass( "noCompare" );
			}else{
				$("#btnComparar" ).removeClass( "noCompare" );
			}
		}

		function CargarAnuncio(){
			if($('.AnuncioHomeDerecho').length){
				var data={
						CargarAnuncio:true,
						id_anuncio:3
					}
			
				jQuery.ajax({
					//dataType:"json",
					type: "POST",
					url: "listado.php",
					data: data
				})
			    .done(function(data){
			    	//$(".AnuncioDerechoHome").html("PruebaCargando")
					jQuery(".AnuncioHomeDerecho").append(data);
			    })
			    .fail(function(data){
			    	console.log(data);
			    	window.location.href = "index.php";
			    });
			}
			if($('.AnuncioComparadorCentro').length){
				var data={
						CargarAnuncio:true,
						id_anuncio:5
					}
			
				jQuery.ajax({
					//dataType:"json",
					type: "POST",
					url: "listado.php",
					data: data
				})
			    .done(function(data){
			    	//$(".AnuncioDerechoHome").html("PruebaCargando")
					jQuery(".AnuncioComparadorCentro").append(data);
			    })
			    .fail(function(data){
			    	console.log(data);
			    	window.location.href = "index.php";
			    });
			}
		}
		function cargarmas(){
			//console.log("cargar mas")
			//console.log($(".cargarmas").length);

			if($(".cargarmas").length<18){
				var j=$(".cargarmas").length;
			}else{
				var j=18;
			}
			var k=$(".planmostrado").length;
			//console.log(k);
			for(var i=k; i<k+j;i++){
				$("#cargarmas"+i).removeClass("cargarmas");
				$("#cargarmas"+i).addClass("planmostrado");
			}
			$(".planmostrado").show();
			if($(".cargarmas").length<1){
				$("#btnCargarMas").hide();
				//$( "#btnCargarMas" ).prop( "disabled", true );
			}else{
				$("#btnCargarMas").show();
			}
		}
		var opts = {
			lines: 9,
			length: 12,
			width: 8,
			radius: 18,
			corners: 1,
			rotate: 0,
			direction: 1,
			color: '#ffffff',
			speed: 1.2,
			trail: 60,
			shadow: false,
			hwaccel: false,
			className: 'loadingSpinner',
			zIndex: 2e9,
			top: '40%',
			left: '50%'
		};

		function checkMobile(){
			if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
	 			// some code..
			 	$(".iconosPlanes").hide();
			}
		}
		function CargarFiltrosCheckEmpresasConFiltro(){
			sessionStorage.removeItem("filtrosCheckEmpresas");
			if($('#checkbox1').is(':checked')){
				//console.log("plan: 1");
				//console.log("prepago: 0");
				var plan=1,prepago=0;
			}
			if($('#checkbox2').is(':checked')){
				//console.log("plan: 0");
				//console.log("prepago: 1");
				var plan=0;prepago=1;
			}
			$( "#selectEstado" ).removeAttr("disabled");
			var data={
				//listadoSimple:"true",
				CargarFiltrosCheckEmpresasConFiltro:"true",
				celular:sessionStorage.getItem("ServicioCelular"),
				internet:sessionStorage.getItem("ServicioInternet"),
				telefono:sessionStorage.getItem("ServicioTelefono"),
				television:sessionStorage.getItem("ServicioTelevision"),
				streaming:sessionStorage.getItem("ServicioStreaming"),
				estado:$( "#selectEstado" ).val(),
				CelularPlan:plan,
				CelularPrepago:prepago
			}
			jQuery.ajax({
				type: "POST",
				url: "listado.php",
				async : false,
				data: data
			})
		    .done(function(data){
				jQuery("#filtrosCheckEmpresas").html(data);

		    })
		    .fail(function(data){
		    	console.log(data);
		    });
		    
		}
		function ImprimirPlan(plan,id){
			//alert(id);
		}
		function ImprimirComparacion(){
			//alert("ImprimirComparacion")
			var url="print-paqs.php?";
			var i=0;
			$( ".span-bx-selected" ).each(function( index ) {
			  //console.log( $( this ).attr("value") );
			  if (i==0){
			  	url+="plan[]="+$( this ).attr("value");
			  	i=1;
			  }else{
			  	url+="&plan[]="+$( this ).attr("value");
			  }
			});
			window.open(url,'_blank');
			//window.location=url;
			return false;
		}

		function ShareSingle(id){
			sessionStorage.setItem("CompartirSingle",id);
			$('#modalMailShareSingle').openModal();
		}
		function SendMailSingle(){
			//console.log($( "#SingleFromNombre" ).val());
			//console.log($( "#SingleFromEmail" ).val());
			//console.log($( "#SingleToNombre" ).val());
			//console.log($( "#SingleToEmail" ).val());
			//console.log(sessionStorage.getItem("CompartirSingle"));	
				
			$.blockUI({ message: null }); 
			var target = document.createElement("div");
			document.body.appendChild(target);
			var spinner = new Spinner(opts).spin(target);
			var overlay = iosOverlay({
				text: "Cargando",
				spinner: spinner
			});
			var data={
					celular:sessionStorage.getItem("ServicioCelular"),
					telefono:sessionStorage.getItem("ServicioTelefono"),
					television:sessionStorage.getItem("ServicioTelevision"),
					internet:sessionStorage.getItem("ServicioInternet"),
					streaming:sessionStorage.getItem("ServicioStreaming"),
					nombreFrom:$( "#SingleFromNombre" ).val(),
					emailFrom:$( "#SingleFromEmail" ).val(),
					nombreTo:$( "#SingleToNombre" ).val(),
					emailTo:$( "#SingleToEmail" ).val(),
					estado:$( "#selectEstado" ).val(),
					plan:sessionStorage.getItem("CompartirSingle")
				}
			jQuery.ajax({
				//dataType:"json",
				type: "POST",
				url: "sharemail.php",
				data: data
			})
		    .done(function(data){

		    	if(data==true){
		    		//alert("true");
		    		$( "#SingleFromNombre" ).val("");
					$( "#SingleFromEmail" ).val("");
					$( "#SingleToNombre" ).val("");
					$( "#SingleToEmail" ).val("");
		    		window.setTimeout(function() {
						overlay.update({
							icon: "//cdn.tooth.me//assets/v3/assets/img/check.png",
							text: "Listo"
						});
					}, 1000);
					window.setTimeout(function() {
						overlay.hide();
					}, 2000);
					setTimeout($.unblockUI, 3000);

		    	}else{
		    		//alert("false");
		    		window.setTimeout(function() {
						overlay.update({
							icon: "//cdn.tooth.me//assets/v3/assets/img/check.png",
							text: "ERROR"
						});
					}, 1000);
					window.setTimeout(function() {
						overlay.hide();
					}, 2000);
					setTimeout($.unblockUI, 3000);

		    	}
		    	//console.log(data)
		    })
		    .fail(function(data){
		    	console.log(data);
		    	//window.location.href = "indexBE.php";
		    });
		    
		}

		function ShareComparacion(){
			var i=0;
			var planes= new Array();
			$( ".span-bx-selected" ).each(function( index ) {
			  //console.log( $( this ).attr("value") );
			  planes.push($( this ).attr("value"));
			  //JSON.stringify(newFiltro)
			});
			//console.log(planes[0]);
			//console.log(planes[1]);
			$.blockUI({ message: null }); 
			var target = document.createElement("div");
			document.body.appendChild(target);
			var spinner = new Spinner(opts).spin(target);
			var overlay = iosOverlay({
				text: "Cargando",
				spinner: spinner
			});
			var data={
					celular:sessionStorage.getItem("ServicioCelular"),
					telefono:sessionStorage.getItem("ServicioTelefono"),
					television:sessionStorage.getItem("ServicioTelevision"),
					internet:sessionStorage.getItem("ServicioInternet"),
					streaming:sessionStorage.getItem("ServicioStreaming"),
					nombreFrom:$( "#CompareFromName" ).val(),
					emailFrom:$( "#CompareFromEmail" ).val(),
					nombreTo:$( "#CompareToName" ).val(),
					emailTo:$( "#CompareToEmail" ).val(),
					estado:$( "#selectEstado" ).val(),
					planes:planes
				}
			jQuery.ajax({
				//dataType:"json",
				type: "POST",
				url: "sharemail.php",
				data: data
			})
		    .done(function(data){

		    	if(data==true){
		    		//alert("true");
		    		$( "#CompareFromName" ).val("");
					$( "#CompareFromEmail" ).val("");
					$( "#CompareToName" ).val("");
					$( "#CompareToEmail" ).val("");
		    		window.setTimeout(function() {
						overlay.update({
							icon: "//cdn.tooth.me//assets/v3/assets/img/check.png",
							text: "Listo"
						});
					}, 1000);
					window.setTimeout(function() {
						overlay.hide();
					}, 2000);
					setTimeout($.unblockUI, 3000);

		    	}else{
		    		//alert("false");
		    		window.setTimeout(function() {
						overlay.update({
							icon: "//cdn.tooth.me//assets/v3/assets/img/check.png",
							text: "ERROR"
						});
					}, 1000);
					window.setTimeout(function() {
						overlay.hide();
					}, 2000);
					setTimeout($.unblockUI, 3000);

		    	}
		    	//console.log(data)
		    })
		    .fail(function(data){
		    	console.log(data);
		    	window.setTimeout(function() {
						overlay.update({
							icon: "//cdn.tooth.me//assets/v3/assets/img/check.png",
							text: "ERROR"
						});
					}, 1000);
					window.setTimeout(function() {
						overlay.hide();
					}, 2000);
					setTimeout($.unblockUI, 3000);
		    	//window.location.href = "indexBE.php";
		    });
		}

		function CompartirComparacionFacebook(){
			//ev.preventDefault();
			var urlFacebook="https://www.facebook.com/sharer/sharer.php?u=";
			var url="http://www.eligefacil.com/fb_compare_share.php?";
			var i=0;
			url=url+"l="+$( "#selectEstado" ).val();
			if(sessionStorage.getItem("ServicioCelular")==1){
				url=url+"&s[]=1";
			}
			if(sessionStorage.getItem("ServicioTelefono")==1){
				url=url+"&s[]=2";
			}
			if(sessionStorage.getItem("ServicioTelevision")==1){
				url=url+"&s[]=4";
			}
			if(sessionStorage.getItem("ServicioInternet")==1){
				url=url+"&s[]=3";
			}
			if(sessionStorage.getItem("ServicioStreaming")==1){				
				url=url+"&s[]=5";
			}

			$( ".span-bx-selected" ).each(function( index ) {
			  //console.log( $( this ).attr("value") );
			  	url+="&plan[]="+$( this ).attr("value");
			});
			var res = encodeURIComponent(url);
			res=urlFacebook+res;
			//window.open(res,'_blank');
			console.log(res);
			window.open(res,'_blank');
			//window.location=url;
			return false;
		}

		function CompartirComparacionTwitter(){
			var urlTwitter="https://twitter.com/home?status=";
			var url="http://www.eligefacil.com/fb_compare_share.php?";
			$( ".span-bx-selected" ).each(function( index ) {
			  //console.log( $( this ).attr("value") );
			  url=url+"l="+$( "#selectEstado" ).val();
			if(sessionStorage.getItem("ServicioCelular")==1){
				url=url+"&s[]=1";
			}
			if(sessionStorage.getItem("ServicioTelefono")==1){
				url=url+"&s[]=2";
			}
			if(sessionStorage.getItem("ServicioTelevision")==1){
				url=url+"&s[]=4";
			}
			if(sessionStorage.getItem("ServicioInternet")==1){
				url=url+"&s[]=3";
			}
			if(sessionStorage.getItem("ServicioStreaming")==1){				
				url=url+"&s[]=5";
			}
			$( ".span-bx-selected" ).each(function( index ) {
			  //console.log( $( this ).attr("value") );
			  	url+="&plan[]="+$( this ).attr("value");
			});
			//console.log(url);
			var res = encodeURIComponent(url);
			//console.log(res);
			res=urlTwitter+res;
			window.open(res,'_blank');
			//window.location=url;
			return false;
			});
		}
		</script>
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