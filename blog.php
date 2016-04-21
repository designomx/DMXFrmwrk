<?php
//header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
require('../blog/wp-blog-header.php');

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
		<nav id="main-nav-bar">
			<div class="nav-wrapper" class="fix-ios-shadow">
				<a href="blog.html" class="logo-header magictime spaceInLeft hvr-grow"><img src="images/logo_eligefacil_blog.png" width="159" alt="" /></a>
				<a href="#" data-activates="mobile-demo" class="button-collapse right hvr-grow"><i class="material-icons">menu</i></a>
				<!--
				<ul class="right hide-on-med-and-down">
					<li>
						<a href="listado-comparador.html" class="magictime slideUpRetourn fix-pos-nav">Innovación</a>
						<span class="nav-mid-line"></span>
					</li>
					<li>
						<a href="blog.html"  target="_blank" class="magictime slideUpRetourn fix-pos-nav">Tecnologia</a>
						<span class="nav-mid-line"></span>
					</li>
					<li>
						<a href="contacto.html" class="magictime slideUpRetourn fix-pos-nav">Smartphones</a>
					</li>
					<li>
						<a href="http://twitter.com" class="magictime swashIn twitternav"><i class="fa fa-twitter"></i></a>
					</li>
					<li>
						<a href="http://facebook.com" class="magictime swashIn facebooknav"><i class="fa fa-facebook"></i></a>
					</li>
				</ul>
				-->
				<ul class="right hide-on-med-and-down">
				    
				</ul>
			</div>
		</nav>
		<!--
		<ul class="side-nav" id="mobile-demo">
			<li>
				<a href="listado-comparador.html"><i class="fa fa-search left"></i> Innovación</a>
			</li>
			<li>
				<a href="blog.html" target="_blank"><i class="fa fa-newspaper-o left"></i> Reseñas</a>
			</li>
			<li>
				<a href="contacto.html"><i class="fa fa-envelope-o left"></i> Smartphones</a>
			</li>
			<li>
				<a href="http://twitter.com"><i class="fa fa-twitter left blue-text text-lighten-1"></i> Twitter</a>
			</li>
			<li>
				<a href="http://facebook.com"><i class="fa fa-facebook left blue-text text-darken-4"></i> Facebook</a>
			</li>
		</ul>
		-->
		<ul class="right hide-on-med-and-down">
		    
		</ul>
		<div id="slideshow" class="home-hero"> 
				<!-- This is the last image in the slideshow -->
	          	<div class="hero-image" style="background-image: url('images/herox.jpg');"/></div>
		        <div class="hero-image" style="background-image: url('images/heroy.jpg');"/></div> <!-- This is the first image in the slideshow -->
		</div>
		<div class="clearfix"></div>
		<br />
		
		<div id="slider-txt-bx">
		<?php
		$args = array ( 'category__in' => array(40) );
		query_posts( $args );

		if ( have_posts() ):
		    while ( have_posts() ) :
		        the_post();

				$tituloPost=$post->post_title;
				$contenido=$post->post_content;
				$PostID=$post->ID;
				$the_excerpt=$post->post_excerpt;
		        // Do stuff with the post content.
		    ?>
		    <div class="slider-container">
				<div class="post-dest">
					<?php
					echo '<h1>'.$tituloPost.'</h1>
					<p>';
					the_excerpt();

					echo '</p>
					<a href="blog-post.php?p='.$PostID.'" class="waves-effect waves btn orange accent-4">Leer nota</a>
				</div>
			</div>';

		        
		    
		    endwhile;
		else:
		    // Insert any content or load a template for no posts found.
		endif;

		wp_reset_query();

		?>

			
			<div id="controlSlide" class="post-dest-selector">
				<a href="#!" class="active-post-bullet"></a>
				<a href="#!"></a>
				<a href="#!"></a>
			</div>
		</div>
		
		<div class="blog-module row grey lighten-5">
			<div id="blog-timeline" class="col m12 l8 blog-timeline-bx">
		<?php
		//$args = array ( 'category__in' => array(40) );
		query_posts(  );
		if ( have_posts() ):
		    while ( have_posts() ) :
		        the_post();
		    	$esvideo=false;
		    	foreach ( get_the_category( $post->ID ) as $category ) {
					$categoria=$category->term_id;
					if($categoria==4){
						$esYoutube=false;
						$esVimeo=false;
						$esvideo=true;
						$embed=0;
						$URLiframe = get_post_meta($post->ID, "youtube", $single = true);
						
						if (!empty($URLiframe)){
							$embed="youtube";
							//echo "<script>alert('".$URLiframe."')</script>";
						}else{
							$URLiframe =get_post_meta($post->ID, "vimeo", $single = true);
							//echo "<script>alert('".$URLiframe."')</script>";
							if(!empty($URLiframe)){
								$embed="vimeo";
							}
						}
					}
				}
				$tituloPost=$post->post_title;
				$contenido=$post->post_content;
				$PostID=$post->ID;
				$the_excerpt=$post->post_excerpt;
		        // Imagen thumbnail
		        if (function_exists('has_post_thumbnail')) {
				    if ( has_post_thumbnail() ) {
				         $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 5600,1000 ), false, '' );
				    }
				}
		    ?>
			<div class="col s12 post-box-wrapper">
				<div class="post-hero" style="background-image: url(<?php echo $src[0];?>);">
				<?php
					if($esvideo){
						//$contenido=$post_->post_content;
						echo '<h1><a onclick="VerVideo(this,'."'".$URLiframe."'".','."'".$embed."'".')" id="btnVerVideo" data-titulo="'.$tituloPost.'" data-id="'.$PostID.'" href="#modalVB" class="modal-trigger">'.$tituloPost.'</a></h1>
						<a onclick="VerVideo(this,'.$URLiframe.','.$embed.')" class="enter-post" id="btnVerVideo2" data-titulo="'.$tituloPost.'" data-id="'.$PostID.'" href="#modalVB" class="modal-trigger"><i class="fa fa-angle-right"></i></a>';

					}else{
						echo '<h1><a href="blog-post.php?p='.$PostID.'">'.$tituloPost.'</a></h1>
						<a class="enter-post" href="blog-post.php?p='.$PostID.'"><i class="fa fa-angle-right"></i></a>';
					}
				?>
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
		    endwhile;
		else:
		    // Insert any content or load a template for no posts found.
		endif;

		wp_reset_query();

		?>














				<div class="col s12 post-box-wrapper">
					<div class="post-hero" style="background-image: url('images/post-hero.jpg');">
						<h1><a href="#modalVB" class="modal-trigger">El Apple Watch a lo grande: 20 trucos y apps para ser  productivo</a></h1>
						<a class="enter-post modal-trigger" href="#modalVB"><i class="fa fa-angle-right"></i></a>
					</div>
					<p class="abstractr-post">
						Duis mollis, est non <a href="#!">commodo luctus</a>, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Maecenas faucibus mollis interdum. Maecenas sed diam eget risus varius blandit sit amet non magna. Sed posuere consectetur est at lobortis.
					</p>
					<div class="social-btn-row">
						<a href="https://twitter.com/share" class="twitter-share-button" data-via="toothmemx">Tweet</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
						<div class="fb-share-button" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button_count"></div>
					</div>
				</div>
				
				<div class="col s12 timeline-banner">
					<div class="video-container">
						<iframe id="embed01" width="560" height="315" src="https://www.youtube.com/embed/HGb1zrXkpRA?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
					</div>
				</div>
				
				<div class="col s12 post-box-wrapper">
					<div class="post-hero" style="background-image: url('images/post-hero.jpg');">
						<h1><a href="blog-post.html">El Apple Watch a lo grande: 20 trucos y apps para ser  productivo</a></h1>
						<a class="enter-post" href="blog-post.html"><i class="fa fa-angle-right"></i></a>
					</div>
					<p class="abstractr-post">
						Duis mollis, est non <a href="#!">commodo luctus</a>, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Maecenas faucibus mollis interdum. Maecenas sed diam eget risus varius blandit sit amet non magna. Sed posuere consectetur est at lobortis.
					</p>
					<div class="social-btn-row">
						<a href="https://twitter.com/share" class="twitter-share-button" data-via="toothmemx">Tweet</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
						<div class="fb-share-button" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button_count"></div>
					</div>
				</div>
				<div class="col s12 post-box-wrapper">
					<div class="post-hero" style="background-image: url('images/post-hero.jpg');">
						<h1><a href="blog-post.html">El Apple Watch a lo grande: 20 trucos y apps para ser  productivo</a></h1>
						<a class="enter-post" href="blog-post.html"><i class="fa fa-angle-right"></i></a>
					</div>
					<p class="abstractr-post">
						Duis mollis, est non <a href="#!">commodo luctus</a>, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Maecenas faucibus mollis interdum. Maecenas sed diam eget risus varius blandit sit amet non magna. Sed posuere consectetur est at lobortis.
					</p>
					<div class="social-btn-row">
						<a href="https://twitter.com/share" class="twitter-share-button" data-via="toothmemx">Tweet</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
						<div class="fb-share-button" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button_count"></div>
					</div>
				</div>
				<div class="reload-button-bx">
					<a href="#!" class="z-depth-1 hoverable"><i class="fa fa-refresh"></i> Cargar Más</a>
				</div>
				
			</div>
			<div class="col m4 grey lighten-3 side-bar-bx hide-on-med-and-down">
				<div class="side-bar-separator grey lighten-2"></div>
				<h5>Más leídos:</h5>
				<div class="post-promoted-bx">
					<div class="col s12 z-depth-1 hoverable">
						<img src="images/recomended.jpg" alt="" />
						<p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
						<a href="#!"></a>
					</div>
				</div>
				<div class="post-promoted-bx">
					<div class="col s12 z-depth-1 hoverable">
						<img src="images/recomended.jpg" alt="" />
						<p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
						<a href="#!"></a>
					</div>
				</div>
				<div class="post-promoted-bx">
					<div class="col s12 z-depth-1 hoverable">
						<img src="images/recomended.jpg" alt="" />
						<p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
						<a href="#!"></a>
					</div>
				</div>
				<div class="clearfix"></div>
				<br />
				<div class="add-promoted-bx">
					<div class="col s12">
						<a href="#!"><img class="responsive-img" src="images/side-add.jpg" alt="" /></a>
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
		

		
		<!-- MODALS - ALERTS - DROP DOWNS-->
		  
			<a class="cd-top btn-floating btn-large blue-grey darken-1">
				<i class="material-icons">keyboard_arrow_up</i>
			</a>
		  
		  <!--BANNER SLIDE DOWN-->
		  
		  <div id="slide-in-banner" class="z-depth-2">
		  	<a href="#!" target="_blank"><img src="images/banner-base.jpg" alt="" /></a>
		  	<div class="close-modal-btn"><i class="material-icons">close</i></div>
		  </div>
		  
		  <!-- Modal Video Blog -->
		    <div id="modalVB" class="modal modal-fixed-footer">
		      <div class="modal-content">
		        <h4 id="tituloVideo"> </h4>
		        <div id="contenedorVideo" class="video-container">
                	
                </div>
		      </div>
		      <div class="modal-footer">
		        <a href="#!" class="modal-action modal-close waves-effect btn-flat">Cerrar</a>
		        <div id="videoModalFooter"></div>
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
		<script type="text/javascript" src="js/fadeSlideShow.js"></script>

		<script>
			jQuery(function() {
		  	
		  		FRMWRK.main.init();
		  					
		  	});
		  	jQuery(document).ready(function(){
		  		jQuery('#slideshow').fadeSlideShow();
		  	});
		  	function VerVideo(element,url,source){
				alert("revisa videos")
				//console.log("verVideo: "+$(element).data("url"));
				//PostId
				var id=	$(element).data("id");
				//PostId
				var titulo=	$(element).data("titulo");
				if(source=="youtube"){
					console.log("youtube");
					$('#contenedorVideo').html('<iframe width="853" height="480" src="'+url+'" frameborder="0" allowfullscreen></iframe>';
				}
				if(source=="vimeo"){
					console.log("vimeo");
				}
				$('#videoModalFooter').html('<a href="blog-post.php?p='+id+'" class="waves-effect btn-flat">Más</a>');
				$("#tituloVideo").html(titulo);
			}
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