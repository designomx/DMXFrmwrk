<?php
//header('Content-Type: application/json');
require('blog/wp-blog-header.php');
//header("Access-Control-Allow-Origin: *");
?>
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
		<!-- Facebook meta -->
		<meta property="og:title" content="Elige Fácil | ¡Decidir nunca fue tan simple!">
		<meta property="og:site_name" content="Elige Fácil | ¡Decidir nunca fue tan simple!">
		<meta property="og:url" content="http://www.eligefacil.com">
		<meta property="og:description" content="Elige, filtra y compara Planes de telefonía móvil, fija, Internet, televisión, etc. Informate antes de tomar una decisión, con nuestra plataforma lo haces fácil y en segundos.">
		<meta property="og:image"              content="http://www.eligefacil.com/images/home-card-fb.jpg" />
		<meta property="fb:app_id" content="1167858986565708">
		<meta property="og:type" content="website">
		<!--Twitter meta-->
		<meta name="twitter:card" content="summary_large_image">
		<meta name="twitter:site" content="@EligeFacil">
		<meta name="twitter:title" content="¡Decidir nunca fue tan simple!">
		<meta name="twitter:description" content="Elige, filtra y compara Planes de telefonía móvil, fija, Internet, televisión, etc. Informate antes de tomar una decisión, con nuestra plataforma lo haces fácil y en segundos.">
		<meta name="twitter:image" content="http://www.eligefacil.com/images/home-card-tw.jpg.jpg">

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
	<script>
	  window.fbAsyncInit = function() {
	    FB.init({
	      appId      : '1167858986565708',
	      xfbml      : true,
	      version    : 'v2.6'
	    }, {scope: 'email'});
	  };

	  (function(d, s, id){
	     var js, fjs = d.getElementsByTagName(s)[0];
	     if (d.getElementById(id)) {return;}
	     js = d.createElement(s); js.id = id;
	     js.src = "//connect.facebook.net/en_US/sdk.js";
	     fjs.parentNode.insertBefore(js, fjs);
	   }(document, 'script', 'facebook-jssdk'));
	</script>
	<body class="preViewB">
		<nav id="main-nav-bar">
			<div class="nav-wrapper" class="fix-ios-shadow">
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
		<div class="clearfix"></div>
		<br />
		<div id="blog-module" class=" blog-module row grey lighten-5">
			<div class="col m12 l8 blog-timeline-bx">
			<!--Loop Wordpress para mostrar las noticias-->
			<?php
				$i=0;
				$query2 = new WP_Query( 'posts_per_page=-1' );
				$insertarVideo=0;
				$cargarmas=0;
				if ( $query2 -> have_posts() ):
		   			while ( $query2 -> have_posts() ) :
		   				$query2 -> the_post();
				    	$esvideo=false;
				    	$insertarVideo+=1;
						foreach ( get_the_category( $query2 ->post->ID ) as $category ) {
							$categoria=$category->term_id;
							if($mostrar==0){
								if($categoria==$categoriaMostrar){
									$mostrar=1;
								}
							}
							if($categoria==4){
								$esYoutube=false;
								$esVimeo=false;
								$esvideo=true;
								$embed=0;
								$URLiframe = get_post_meta($query2->post->ID, "youtube", $single = true);
								
								if (!empty($URLiframe)){
									$embed="youtube";
									//echo "<script>alert('".$URLiframe."')</script>";
								}else{
									$URLiframe =get_post_meta($query2->post->ID, "vimeo", $single = true);
									//echo "<script>alert('".$URLiframe."')</script>";
									if(!empty($URLiframe)){
										$embed="vimeo";
									}
								}
							}
						}
						$tituloPost=  get_the_title( $query2->post->ID );
						$contenido=get_the_content($query2->post->ID);
						$PostID=$query2->post->ID;
						$permalink = get_permalink($query2->post->ID);
						$the_excerpt=get_the_excerpt($query2->post->ID);
				        // Imagen thumbnail
				        if (function_exists('has_post_thumbnail')) {
						    if ( has_post_thumbnail() ) {
						         $src = wp_get_attachment_image_src( get_post_thumbnail_id($query2->post->ID), array( 1280,800 ), false, '' );
						    }
						}
						echo '<div id="cargarmas'.$cargarmas.'"class="col s12 post-box-wrapper cargarmas" style=" display: none;">
								<div class="post-hero" style="background-image: url('.$src[0].');">';

						if($esvideo){
							//$contenido=$post_->post_content;
							echo '<h1><a id="btnVerVideo" onclick="VerVideo(this,'."'".$URLiframe."','".$embed."'".')" data-titulo="'.$tituloPost.'" data-id="'.$PostID.'" href="#modalVB" class="modal-trigger">'.$tituloPost.'</a></h1>
							<a onclick="VerVideo(this,'."'".$URLiframe."','".$embed."'".')" class="enter-post modal-trigger" id="btnVerVideo2" data-titulo="'.$tituloPost.'" data-id="'.$PostID.'" href="#modalVB"><i class="fa fa-angle-right"></i></a>';

						}else{
							echo '<h1><a href="'.$permalink.'">'.$tituloPost.'</a></h1>
							<a class="enter-post" href="'.$permalink.'"><i class="fa fa-angle-right"></i></a>';
						}
							?>
							</div>
							<p class="abstractr-post">
								<?php echo $the_excerpt; ?>
							</p>
							<div class="social-btn-row">
								<a href="https://twitter.com/share" data-url="<?php echo $permalink;?>" class="twitter-share-button" data-via="EligeFácil.com" data-hashtags="eligefácil">Tweet</a> 
								
								<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
								
								<div class="fb-share-button" data-href="<?php echo $permalink;?>" data-layout="button_count"></div>
							</div>
						</div>
					<?php
			    	if($insertarVideo==2){
			    		/*
			    		echo '<div class="col s12 timeline-banner">
								<div class="video-container">
									<iframe id="embed01" width="560" height="315" src="https://www.youtube.com/embed/HGb1zrXkpRA?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
								</div>
							</div>';
						*/
			    	}
		    		$cargarmas+=1;
		    endwhile;
		else:
		    // Insert any content or load a template for no posts found.
		endif;

		wp_reset_postdata();
		//echo '<script>cargarmas()</script>'

		?>
		

				<div class="reload-button-bx">
					<a href="#!" id="btnCargarMas" onclick="cargarmas()" class="z-depth-1 hoverable"><i class="fa fa-refresh"></i> Cargar Más</a>
				</div>
				
			</div>
			<div class="col m4 grey lighten-3 side-bar-bx hide-on-med-and-down">
				<div class="side-bar-separator grey lighten-2"></div>
				<h5>Recomendado:</h5>
				<!--Loop Wordpress para mostrar los destacados de la barra lateral -->
				<?php query_posts( 'category_name=Home&posts_per_page=3' ); ?>

					<?php while ( have_posts() ) : the_post(); 

						$permalink = get_permalink();
					?>
						<!-- Do special_cat stuff... -->
						
						<?php
						if (function_exists('has_post_thumbnail')) {
						    if ( has_post_thumbnail() ) {
						         $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 1280,800 ), false, '' );
						    }else{
						    	$src[0]="images/recomended.jpg";
						    }
						}
						?>
						<div class="post-promoted-bx">
							<div class="col s12 z-depth-1 hoverable">
								<img src="<?php echo $src[0];?>" alt="" height="126" width="126"/>
								
									<?php
										$rem_len=97;
										$trunc_ex = substr(get_the_title(), 0, $rem_len); //truncate excerpt to fit remaining space
										if(strlen($trunc_ex) < strlen( get_the_title())) $trunc_ex = $trunc_ex . " [...]";
										echo "<p>" . $trunc_ex . "</p>"; //display excerpt
									?>
								
								<a href="<?php echo $permalink; ?>"></a>
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

		  <!-- Modal Video Blog -->
		    <div id="modalVB" class="modal modal-fixed-footer">
		      <div class="modal-content">
		        <h5 id="tituloVideo"></h5>
		        <div id="contenedorVideo" class="video-container">
                	
                </div>
		      </div>
		      <div class="modal-footer">
		      	<div id="videoModalFooter">
		        </div>
		        <a href="#!" class="modal-action modal-close waves-effect btn-flat">Cerrar</a>
		      </div>
		    </div>
			<!-- Modal Preregistro -->
			<div id="modalPreview" class="modal">
			  <div class="modal-content">
			  	<img class="centerlogo" src="images/logo_eligefacil.png" width="159" alt="" />
			  	<br />
			    <p class="center centerlogo" style="max-width: 300px;">Pre-regístrate y obtén antes que nadie acceso exclusivo a nuestra plataforma.</p>
			    <div class="clearfix"></div>
			    <br />
			    <form class="col s12" id="RegistrarUsuario">
		          <div class="row">
		            <div class="input-field col s12 m6 centerput">
		              <i class="material-icons prefix grey-text text-darken-1">account_circle</i>
		              <input id="nombreUsuario" type="text" class="validate" data-required="true" autofocus = "autofocus" pattern="[a-z A-z A-z A-z ñáéíóúÑÁÉÍÓÚ]{2,40}$" required = "required">
		              <label for="icon_prefix">Nombre</label>
		            </div>
		            <div class="input-field col s12 m6 centerput">
		              <i class="material-icons prefix grey-text text-darken-1">email</i>
		              <input id="emailUsuario" type="email" class="validate" data-required="true" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required = "required">
		              <label for="icon_telephone">Correo</label>
		            </div>
		            <div class="input-field col m6 centerput">
		              <button type="submit"  class="widebtn orange accent-4 waves-effect btn centerput">Registrar</button>
		            </div>
		            <div class="input-field col m6 centerput">
		             <a href="#!" onclick="fbLogin();" class="light-blue darken-4 waves-effect btn centerput">Facebook LogIn</a>
		            </div>
		          </div>
		        </form>
			  </div>
			</div>
		<!--[if IE]>
			<script src="js/html5.js"></script>
			<script type="text/javascript" src="js/respond.js"></script>
		<![endif]-->

		<!-- Scripts-->
		<script src="js/jquery-2.2.3.min.js"></script>
		<script src="js/jquery.stayInWebApp.min.js"></script>
		<script src="js/spin.js"></script>
		<script src="js/iosOverlay.js"></script>
		<script src="js/charCount.js"></script>
		<script src="js/backtotop.js"></script>
		<script src="js/materialize.min.js"></script>
		<script src="js/jquery-validate.js"></script>
		<!--<script src="js/parallax.min.js"></script>-->
		<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
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
		<script src="js/web.js"></script>
		<script type="text/javascript" src="js/fadeSlideShow.js"></script>
		
		<script>
			jQuery(function() {
		  	
		  		FRMWRK.main.init();
		  		FRMWRK.web.init();
			
		  	});
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
		</script>
		<div id="fb-root"></div>

				

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
				cargarmas();
		  		$(".cargarmas").hide();
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
			    	window.location.href = "index.php";
			    });

			    jQuery('#slideshow').fadeSlideShow();
			    $('#modalPreview').openModal({dismissible: false});
			    var urlGet=decodeURIComponent(window.location.href);
			    if((urlGet.indexOf("ll=e988b5526b6a9a91911f83ca1cc737c7") > -1) || (localStorage.getItem("usuarioInvitado") !== null)) {
			    	localStorage.setItem("usuarioInvitado", true)
			    	$('#modalPreview').closeModal();
			    	$('body').removeClass("preViewB");
			    }


			});

			function CargarAnuncio(){
				if($('.AnuncioHomeDerecho').length){
					/*
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
				    */
				}
				if($('.AnuncioComparadorCentro').length){
					/*
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
				    */
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
			function VerVideo(element,url,source){
				//alert("revisa videos")
				//console.log("verVideo: "+$(element).data("url"));
				//PostId
				var id=	$(element).data("id");
				//PostId
				var titulo=	$(element).data("titulo");
				if(source=="youtube"){
					//console.log("youtube");
					$('#contenedorVideo').html('<iframe width="853" height="480" src="'+url+'" frameborder="0" allowfullscreen></iframe>');
				}
				if(source=="vimeo"){
					//console.log("vimeo");
					$('#contenedorVideo').html('<iframe src="'+url+'" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>');
				}
				$('#videoModalFooter').html('<a href="http://www.eligefacil.com/blog/?p='+id+'" class="waves-effect btn-flat">Más</a>');
				$("#tituloVideo").html(titulo);
			}
			function cargarmas(){
				//console.log("cargar mas")
				//console.log($(".cargarmas").length);

				if($(".cargarmas").length<5){
					var j=$(".cargarmas").length;
				}else{
					var j=5;
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
			/*
			$('#btnVerVideo2').on('click', function() {
				jQuery( "#btnVerVideo" ).trigger( "click" );
			});
			$('#btnVerVideo').on('click', function() {
	 			
			});
			*/
			$("#RegistrarUsuario").submit(function(ev){
				ev.preventDefault();
				RegistrarUsuario();
			})
			function RegistrarUsuario(){
					var nombreUsuario=$( "#nombreUsuario" ).val();
					var emailUsuario=$( "#emailUsuario" ).val();
					console.log(nombreUsuario);
					console.log(emailUsuario);
					enviarCorreo(nombreUsuario,emailUsuario);

					
			};
			
			function enviarCorreo(nombre,email){
			  	console.log("function enviarCorreo nombre: "+nombre);
			  	console.log("function enviarCorreo email: "+email);
			  	console.log("Enviando correo..");
			  	$.blockUI({ message: null }); 
				var target = document.createElement("div");
				document.body.appendChild(target);
				var spinner = new Spinner(opts).spin(target);
				var overlay = iosOverlay({
					text: "Cargando",
					spinner: spinner
				});
				var nombre_enviar=nombre;
				var email_enviar=email;
				var data={
						nombre:nombre_enviar,
						email:email_enviar
					}
				jQuery.ajax({
					//dataType:"json",
					type: "POST",
					url: "register.php",
					data: data
				})
			    .done(function(data){
			    	console.log(data)
			    	if(data==true){
			    		//console.log(data)
			    		//alert("true");
			    		alert("!Hemos envíado a tu correo un enlace para acceder al sitio!");
			    		$( "#nombreUsuario" ).val("");
						$( "#emailUsuario" ).val("");
			    		window.setTimeout(function() {
							overlay.update({
								icon: "//cdn.tooth.me/assets/v3/assets/img/check.png",
								text: "Listo revisa tu correo!"
							});
						}, 1000);
						window.setTimeout(function() {
							overlay.hide();
						}, 2000);
						setTimeout($.unblockUI, 3000);

			    	}else{
			    		if(data=="duplicado"){
			    			alert("Correo ya registrado, se reenvío enlace");
			    			$( "#nombreUsuario" ).val("");
							$( "#emailUsuario" ).val("");
							//console.log(data);
				    		//alert("false");
				    		window.setTimeout(function() {
								overlay.update({
									icon: "//cdn.tooth.me/assets/v3/assets/img/check.png",
									text: "Listo"
								});
							}, 1000);
							window.setTimeout(function() {
								overlay.hide();
							}, 2000);
							setTimeout($.unblockUI, 3000);
			    		}else{
			    			if(data=="error"){
				    			//alert("Correo ya registrado, se reenvío enlace");
				    			$( "#nombreUsuario" ).val("");
								$( "#emailUsuario" ).val("");
								//console.log(data);
					    		//alert("false");
					    		window.setTimeout(function() {
									overlay.update({
										icon: "//cdn.tooth.me/assets/v3/assets/img/cross.png",
										text: "Error en DB"
									});
								}, 1000);
								window.setTimeout(function() {
									overlay.hide();
								}, 2000);
								setTimeout($.unblockUI, 3000);
							}else{
								//console.log(data);
					    		//alert("false");
					    		window.setTimeout(function() {
									overlay.update({
										icon: "//cdn.tooth.me/assets/v3/assets/img/cross.png",
										text: "Error"
									});
								}, 1000);
								window.setTimeout(function() {
									overlay.hide();
								}, 2000);
								setTimeout($.unblockUI, 3000);
							}
						}
			    	}
			    	//console.log(data)
			    })
			    .fail(function(data){
			    	console.log(data);
			    	//window.location.href = "indexBE.php";
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
		<script>
	  	function checkLoginState() {
			FB.getLoginStatus(function(response) {
			if (response.status === 'connected') {
			// the user is logged in and has authenticated your
			// app, and response.authResponse supplies
			// the user's ID, a valid access token, a signed
			// request, and the time the access token 
			// and signed request each expire
			var uid = response.authResponse.userID;
			var accessToken = response.authResponse.accessToken;
			//console.log(response);
			FacebookAPI();
			} else if (response.status === 'not_authorized') {
			// the user is logged in to Facebook, 
			// but has not authenticated your app
				console.log("not authorized facebook APP");
			} else {
			// the user isn't logged in to Facebook.
				console.log("not Facebook Login");
				fbLogin();
			}
			});
		}

		  // Here we run a very simple test of the Graph API after login is
		  // successful.  See statusChangeCallback() for when this call is made.
		  function FacebookAPI() {
		    console.log('Welcome!  Fetching your information.... ');
		    FB.api('/me', {fields: 'name, email' },function(response) {
		      //console.log('Successful login for: ' + response.name);
		      enviarCorreo(response.name,response.email);
		    });
		  }
		  function fbLogin() {
		  	console.log("entra a fblogin");
		    FB.login(function(response) {
		   	  //console.log(response.authResponse);
		      	if (response.status === 'connected') {
			        //user is logged in, reload page
			        //window.location.reload(true);
			        //console.log(response);
			        FacebookAPI();
			        return 0;
		      	}else if (response.status === 'not_authorized') {
				// the user is logged in to Facebook, 
				// but has not authenticated your app
					console.log("not authorized facebook APP");
				} else {
				// the user isn't logged in to Facebook.
					console.log("not Facebook Login");
					fbLogin();
				}
		    }, {scope: 'email'});
		  }

		</script>
	</body>

</html>