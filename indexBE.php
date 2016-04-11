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
		<link href="materialize/css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection" />
		<link href="css/iosOverlay.css" type="text/css" rel="stylesheet" media="screen,projection" />
		<link href="css/animate.min.css" type="text/css" rel="stylesheet" media="screen,projection" />
		<link href="css/magic.min.css" type="text/css" rel="stylesheet" media="screen,projection" />
		<link href="css/jquery.mCustomScrollbar.css" type="text/css" rel="stylesheet" media="screen,projection" />
		<link href="css/main.css" type="text/css" rel="stylesheet" media="screen,projection" />
		<!-- This is FontsAwesome 4.3.0-->
		<link href="fawesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	</head>
	<body>
		<nav id="main-nav-bar">
			<div class="nav-wrapper" class="fix-ios-shadow">
				<a href="indexBE.php" class="logo-header magictime spaceInLeft hvr-grow"><img src="images/logo_eligefacil.png" width="159" alt="" /></a>
				<a href="#" data-activates="mobile-demo" class="button-collapse right hvr-grow"><i class="material-icons">menu</i></a>
				<ul class="right hide-on-med-and-down">
					<li>
						<a id="descubreBTN" href="listado-comparador.php" class="magictime slideUpRetourn fix-pos-nav">Descubre</a>
						<span class="nav-mid-line"></span>
					</li>
					<li>
						<a href="#blog-module" class="magictime slideUpRetourn fix-pos-nav">Enterate</a>
						<span class="nav-mid-line"></span>
					</li>
					<li>
						<a href="contacto.html" class="magictime slideUpRetourn fix-pos-nav">Contacto</a>
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
						<a id="descubreBTN" href="listado-comparador.php"><i class="fa fa-search left"></i> Descubre</a>
					</li>
					<li>
						<a href="#blog-module"><i class="fa fa-newspaper-o left"></i> Enterate</a>
					</li>
					<li>
						<a href="contacto.html"><i class="fa fa-envelope-o left"></i> Contacto</a>
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
		<div class="clearfix"></div>
		<br />
		<div id="blog-module" class="row grey lighten-5">
			<div class="col m12 l8 blog-timeline-bx">
			<!--Loop Wordpress para mostrar las noticias-->
			<?php
				require('../blog/wp-blog-header.php');
				$i=0;
				while (have_posts()): the_post(); ?>
					<div class="col s12 post-box-wrapper">
						<?php
						if (function_exists('has_post_thumbnail')) {
						    if ( has_post_thumbnail() ) {
						         $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 5600,1000 ), false, '' );
						    }
						}
						?>
						<div class="post-hero" style="background-image: url(
							<?php
	                      		echo $src[0];
	                    	?>
	                    );">
							<h1><a href="<?php echo "blog-post.php?p=".get_the_ID(); ?>"><?php the_title();?></a></h1>
							<a class="enter-post" href="<?php echo "blog-post.php?p=".get_the_ID(); ?>"><i class="fa fa-angle-right"></i></a>
						</div>
						<p class="abstractr-post">
				    		<?php the_excerpt(); ?>
						</p>
						<div class="social-btn-row">
							<a href="https://twitter.com/share" class="twitter-share-button" data-via="toothmemx">Tweet</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
							<div class="fb-share-button" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button_count"></div>
						</div>
					</div>
				<?php
					if($i==0){
						$i+=1; 
						echo '	<div class="col s12 timeline-banner">
									<div class="video-container">
										<iframe id="embed01" width="560" height="315" src="https://www.youtube.com/embed/HGb1zrXkpRA?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
									</div>
								</div>';
					}
				endwhile; ?>

				

				<div class="reload-button-bx">
					<a href="#blog-module" class="z-depth-1 hoverable"><i class="fa fa-refresh"></i> Cargar Más</a>
				</div>
				
			</div>
			<div class="col m4 grey lighten-3 side-bar-bx hide-on-med-and-down">
				<div class="side-bar-separator grey lighten-2"></div>
				<h5>Recomendado:</h5>
				<!--Loop Wordpress para mostrar los destacados de la barra lateral -->
				<?php query_posts( 'category_name=Home&posts_per_page=3' ); ?>

					<?php while ( have_posts() ) : the_post(); ?>
						<!-- Do special_cat stuff... -->
						<?php
						if (function_exists('has_post_thumbnail')) {
						    if ( has_post_thumbnail() ) {
						         $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 5600,1000 ), false, '' );
						    }else{
						    	$src[0]="images/recomended.jpg";
						    }
						}
						?>
						<div class="post-promoted-bx">
							<div class="col s12 z-depth-1 hoverable">
								<img src="<?php echo $src[0];?>" alt="" style="display: block;max-width:126px;max-height:126px;width: auto;height: auto;" />
								
									<?php
										$rem_len=97;
										$trunc_ex = substr(get_the_excerpt(), 0, $rem_len); //truncate excerpt to fit remaining space
										if(strlen($trunc_ex) < strlen(get_the_excerpt())) $trunc_ex = $trunc_ex . " [...]";
										echo "<p>" . $trunc_ex . "</p>"; //display excerpt
									?>
								
								<a href="<?php echo "blog-post.php?p=".get_the_ID(); ?>"></a>
							</div>
						</div>
					<?php endwhile; ?>


				<div class="clearfix"></div>
				<br />
				<div class="add-promoted-bx">
					<div class="col s12 AnuncioHomeDerecho">
						
					</div>
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
			<div id="controlSlide" class="home-slide-bar">
				
			</div>
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
				<a id="btnBuscar" class="search-btn z-depth-1 hoverable">Buscar <i class="fa fa-angle-right right"></i></a>
				<a id="btnBuscarHidden" class="modal-trigger" href="#modalLocation" style="display: none;"></a>
			</div>
		</div>

		<!-- MODALS - ALERTS - DROP DOWNS-->
				
		  <!-- Modal Structure -->
		  <div id="modalLocation" class="modal">
		    <div class="modal-content">
		   	  <div class="input-field col s12">
		   	  	<h5>Elige tu estado:</h5>
		   	    <div id="SelectDeEstados">

		   	    </div>
		   	    <div class="clearfix"></div>
		   	    <br/>
		   	  </div>
		    </div>
		    <div class="modal-footer">
		      	<a id="btnSelecEstado" href="listado-comparador.php#filter-go" class=" modal-action waves-effect waves-grey btn-flat">Continuar</a>
		    	<a href="#!" class=" modal-action modal-close waves-effect waves-grey btn-flat">Cancelar</a>
		    </div>
		  </div>
		
		  <!--BANNER SLIDE DOWN-->
		  
		  <div id="slide-in-banner" class="z-depth-2 AnuncioComparadorCentro">
		  	<div class="close-modal-btn"><i class="material-icons">close</i></div>
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
		<script src="js/web.js"></script>
		<script type="text/javascript" src="js/fadeSlideShow.js"></script>
		
		<script>
			jQuery(function() {
		  	
		  		FRMWRK.main.init();
		  		FRMWRK.web.init();
			
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
				

		<script >

			$( "#btnSelecEstado" ).click(function() {
				if($( "#selectEstado" ).val()!=-1){
					//Funcion para revisar los SELECT del selector principal
					sessionStorage.setItem("estado",$( "#selectEstado" ).val());
					//console.log(sessionStorage.getItem("estado"));
					//window.location.href = "listado-comparador.php#filter-go";
					//Llamada ajax para servicio en listar.php
				}else{
					alert("Debe seleccionar un estado");
					return false;
				}
			});
			jQuery(document).ready(function(){
				CargarAnuncio();
				var data={
					SelectDeEstados:"true"
				}
				jQuery.ajax({
					//dataType:"json",
					type: "POST",
					url: "listado.php",
					data: data
				})
			    .done(function(data){
					jQuery("#SelectDeEstados").html(data);
			    })
			    .fail(function(data){
			    	console.log(data);
			    	window.location.href = "indexBE.php";
			    });

			    jQuery('#slideshow').fadeSlideShow();

			});

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
				    	window.location.href = "indexBE.php";
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
				    	window.location.href = "indexBE.php";
				    });
				}
			}

			$( "#descubreBTN" ).click(function() {
				if (sessionStorage.getItem("estado") === null) {
					return false;
				}else{
					if((sessionStorage.getItem("ServicioCelular") === null || sessionStorage.getItem("ServicioCelular")==0) && (sessionStorage.getItem("ServicioInternet") === null || sessionStorage.getItem("ServicioInternet")==0) && (sessionStorage.getItem("ServicioTelefono") === null || sessionStorage.getItem("ServicioTelefono")==0) && (sessionStorage.getItem("ServicioTelevision") === null || sessionStorage.getItem("ServicioTelevision")==0) && (sessionStorage.getItem("ServicioStreaming") === null || sessionStorage.getItem("ServicioStreaming")==0)   ){
								return false;
					}else{
						
					}
				}

			});
			$("#btnBuscar").click(function(){
				var contador=0,celular=0,internet=0,telefono=0,television=0,streaming=0;
				if($("#celular").hasClass( "active-selection" )){
					//alert("celular");
					celular=1;
					contador+=1;
					sessionStorage.setItem("ServicioCelular","1");			
				}else{
					sessionStorage.setItem("ServicioCelular","0");
				}
				if($("#internet").hasClass( "active-selection" )){
					//alert("internet");
					internet=1;
					contador+=1;
					sessionStorage.setItem("ServicioInternet","1");	
				}else{
					sessionStorage.setItem("ServicioInternet","0");
				}
				if($("#telefono").hasClass( "active-selection" )){
					//alert("telefono");
					telefono=1;
					contador+=1;
					sessionStorage.setItem("ServicioTelefono","1");	
				}else{
					sessionStorage.setItem("ServicioTelefono","0");
				}
				if($("#television").hasClass( "active-selection" )){
					//alert("television");
					television=1;
					contador+=1;
					sessionStorage.setItem("ServicioTelevision","1");
				}else{
					sessionStorage.setItem("ServicioTelevision","0");
				}
				if($("#streaming").hasClass( "active-selection" )){
					//alert("streaming");
					streaming=1;
					contador+=1;
					sessionStorage.setItem("ServicioStreaming","1");
				}else{
					sessionStorage.setItem("ServicioStreaming","0");
				}
				//Llamar directo a listado-comparador.php sin archivo de por medio (servicio)
				if(contador<1){
					alert("Debe seleccionar al menos un tipo de servicio");
					return false;
				}else{
					jQuery( "#btnBuscarHidden" ).trigger( "click" );
				}
			});

		</script>
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