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
		<title>Elige Fácil | designo.mx®</title>
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
				<a href="index.html" class="logo-header magictime spaceInLeft hvr-grow"><img src="images/logo_eligefacil.png" width="159" alt="" /></a>
				<a href="#" data-activates="mobile-demo" class="button-collapse right hvr-grow"><i class="material-icons">menu</i></a>
				<ul class="right hide-on-med-and-down">
					<li>
						<a href="listado-comparador.html" class="magictime slideUpRetourn fix-pos-nav">Descubre</a>
						<span class="nav-mid-line"></span>
					</li>
					<li>
						<a href="#blog-timeline" class="magictime slideUpRetourn fix-pos-nav">Entérate</a>
						<span class="nav-mid-line"></span>
					</li>
					<li>
						<a href="contacto.html" class="magictime slideUpRetourn fix-pos-nav">Contacto</a>
					</li>
					<li>
						<a href="http://twitter.com" class="magictime swashIn twitternav"><i class="fa fa-twitter"></i></a>
					</li>
					<li>
						<a href="http://facebook.com" class="magictime swashIn facebooknav"><i class="fa fa-facebook"></i></a>
					</li>
				</ul>
			</div>
		</nav>
		<ul class="side-nav" id="mobile-demo">
			<li>
				<a href="listado-comparador.html"><i class="fa fa-search left"></i> Descubre</a>
			</li>
			<li>
				<a href="index.html#blog-timeline"><i class="fa fa-newspaper-o left"></i> Entérate</a>
			</li>
			<li>
				<a href="contacto.html"><i class="fa fa-envelope-o left"></i> Contacto</a>
			</li>
			<li>
				<a href="http://twitter.com"><i class="fa fa-twitter left blue-text text-lighten-1"></i> Twitter</a>
			</li>
			<li>
				<a href="http://facebook.com"><i class="fa fa-facebook left blue-text text-darken-4"></i> Facebook</a>
			</li>
		</ul>
		<div class="clearfix"></div>
		<br />
		<?php
				require('../blog/wp-blog-header.php');
				if (isset($_GET["p"])){
					$post_ = get_post( $_GET["p"] ); 
					$title = $post_->post_title;
					$excerpt = $post_->post_excerpt;
					
					
				}
				
		?>
		<div id="contact-module" class="row grey lighten-5">
			<div class="post-page-bx row">
				<h1><?php echo $title;?></h1>
				<?php
					if ( has_post_thumbnail() ) {
					    //the_post_thumbnail();
					    $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 5600,1000 ), false, '' );
						echo '<img class="responsive-img" src="'.$src[0].'">';

					} 
				?>
				<!--<img class="responsive-img" src="images/post-hero.jpg">-->

				<div class="social-btn-row">
					<a href="https://twitter.com/share" class="twitter-share-button" data-via="toothmemx">Tweet</a>
					<script>
						!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');
					</script>
					<div class="fb-share-button" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button_count"></div>
				</div>
				<?php
					echo "<p class='responsive-img'>";
					$contenido=$post_->post_content;
					echo $contenido;
					echo "</p>";
				?>
				
				<div class="backblog-button-bx">
					<a href="indexBE.php#blog-timeline" class="z-depth-1 hoverable"><i class="fa fa-angle-double-left"></i> Regresar</a>
				</div>
				
				<div class="clearfix"></div>
				<br />
			</div>
			<div class="clearfix"></div>
			<div class="footer-bx">
				<ul>
					<li>
						<a href="#!">Quiénes somos</a>/</li>
					<li>
						<a href="#!">Legales</a>/</li>
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
		<!-- MODALS - ALERTS - DROP DOWNS-->
		<!-- Modal Structure -->
		<div id="modalLocation" class="modal">
			<div class="modal-content">
				<div class="input-field col s12">
					<h5>Elige tu estado:</h5>
					<select class="browser-default">
						<option value="1">Option 1</option>
						<option value="2">Option 2</option>
						<option value="3">Option 3</option>
						<option value="4">Option 4</option>
						<option value="5">Option 5</option>
						<option value="6">Option 6</option>
						<option value="7">Option 7</option>
						<option value="8">Option 8</option>
					</select>
					<div class="clearfix"></div>
					<br />
				</div>
			</div>
			<div class="modal-footer">
				<a href="listado-comparador.html" class=" modal-action waves-effect waves-grey btn-flat">Continuar</a>
				<a href="#!" class=" modal-action modal-close waves-effect waves-grey btn-flat">Cancelar</a>
			</div>
		</div>
		<a class="cd-top btn-floating btn-large blue-grey darken-1">
				<i class="material-icons">keyboard_arrow_up</i>
			</a>
		<!--BANNER SLIDE DOWN-->
		<div id="slide-in-banner" class="z-depth-2">
			<a href="#!" target="_blank"><img src="images/banner-base.jpg" alt="" /></a>
			<div class="close-modal-btn">
				<i class="material-icons">close</i>
			</div>
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
		<script>
			(function(d, s, id) {
					  var js, fjs = d.getElementsByTagName(s)[0];
					  if (d.getElementById(id)) return;
					  js = d.createElement(s); js.id = id;
					  js.src = "//connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v2.5&appId=327135760765560";
					  fjs.parentNode.insertBefore(js, fjs);
					}(document, 'script', 'facebook-jssdk'));
		</script>
	</body>

</html>