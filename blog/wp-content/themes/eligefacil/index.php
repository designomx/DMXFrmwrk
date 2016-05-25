<!DOCTYPE html>
<?php
//header('Content-Type: application/json');
//header("Access-Control-Allow-Origin: *");

require('wp-blog-header.php');

class YourImagick extends Imagick
{
    public function colorize($color, $alpha = 1)
    {
        $draw = new ImagickDraw();

        $draw->setFillColor($color);

        if (is_float($alpha)) {
            $draw->setFillAlpha($alpha);
        }

        $geometry = $this->getImageGeometry();
        $width = $geometry['width'];
        $height = $geometry['height'];

        $draw->rectangle(0, 0, $width, $height);

        $this->drawImage($draw);
    }
}
?>

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
		<link href="../materialize/css/materialize.min.css" type="text/css" rel="stylesheet" media="all" />
		<link href="../css/iosOverlay.css" type="text/css" rel="stylesheet" media="all" />
		<link href="../css/animate.min.css" type="text/css" rel="stylesheet" media="all" />
		<link href="../css/magic.min.css" type="text/css" rel="stylesheet" media="all" />
		<link href="../css/jquery.mCustomScrollbar.css" type="text/css" rel="stylesheet" media="all" />
		<link href="../css/main.css" type="text/css" rel="stylesheet" media="all" />
		<!-- This is FontsAwesome 4.3.0-->
		<link href="../fawesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	</head>
	<body>
		<script src="../js/jquery-2.1.1.min.js"></script>

		<nav id="main-nav-bar">
			<div class="nav-wrapper" class="fix-ios-shadow">
				<a href="http://www.eligefacil.com/blog.php" class="logo-header magictime spaceInLeft hvr-grow"><img src="../images/logo_eligefacil_blog.png" width="159" alt="" /></a>
				<a href="#" data-activates="mobile-demo" class="button-collapse right hvr-grow"><i class="material-icons">menu</i></a>

				<ul class="right hide-on-med-and-down">
					<li>
						<a href="http://www.eligefacil.com" class="magictime slideUpRetourn fix-pos-nav">Comparador</a>
						<span class="nav-mid-line"></span>
					</li>
					<li>
						<a href="../blog.php?c=42" class="magictime slideUpRetourn fix-pos-nav">#Tecnología</a>
						<span class="nav-mid-line"></span>
					</li>
					<li>
						<a href="../blog.php?c=44" class="magictime slideUpRetourn fix-pos-nav">#Entretenimiento</a>
					</li>
					<li>
						<a href="http://www.twitter.com/EligeFacil" target="_blank" class="magictime swashIn twitternav"><i class="fa fa-twitter"></i></a>
					</li>
					<li>
						<a href="https://www.facebook.com/EligeFacil" target="_blank" class="magictime swashIn facebooknav"><i class="fa fa-facebook"></i></a>
					</li>
				</ul>

				<ul class="right hide-on-med-and-down">
				    
				</ul>
			</div>
		</nav>

		<ul class="side-nav" id="mobile-demo">
			<li>
				<a href="http://www.eligefacil.com"><i class="fa fa-search left"></i> Comparador</a>
			</li>
			<li>
				<a href="../blog.php?c=42" ><i class="fa fa-newspaper-o left"></i> #Tecnología</a>
			</li>
			<li>
				<a href="../blog.php?c=44"><i class="fa fa-envelope-o left"></i> #Entretenimiento</a>
			</li>
			<li>
				<a href="http://www.twitter.com/EligeFacil" target="_blank"><i class="fa fa-twitter left blue-text text-lighten-1"></i> Twitter</a>
			</li>
			<li>
				<a href="https://www.facebook.com/EligeFacil" target="_blank"><i class="fa fa-facebook left blue-text text-darken-4"></i> Facebook</a>
			</li>
		</ul>

		<ul class="right hide-on-med-and-down">
		    
		</ul>
		<div id="slideshow" class="home-hero"> 
				<!-- This is the last image in the slideshow -->
	          	 <!-- This is the first image in the slideshow -->
		</div>
		<div class="clearfix"></div>
		<br />
		
		<div id="slider-txt-bx">
			<?php
				$args = array ( 'category__in' => array(40),
							'posts_per_page' => 5);
				//query_posts( $args );
				$query1 = new WP_Query( $args );
				if ( $query1->have_posts() ):
					$i=0;
			    	while ( $query1->have_posts() ) :
			       		$query1->the_post();

						$tituloPost=  get_the_title( $query1->post->ID );
						$contenido=get_the_content($query1->post->ID);
						$PostID=$query1->post->ID;
						$the_excerpt=get_the_excerpt($query1->post->ID);
						$permalink = get_permalink($query1->post->ID);
						if (function_exists('has_post_thumbnail')) {
						    if ( has_post_thumbnail() ) {
						    	$nombre_fichero = "../images/HeaderPost/header_post_blog_".$PostID.".jpg";
								if (file_exists($nombre_fichero)) {
								  //echo "El fichero $nombre_fichero existe";
								  $fileDst="../images/HeaderPost/header_post_blog_".$PostID.".jpg";
								} else {
								 	$src = wp_get_attachment_image_src( get_post_thumbnail_id($query1->post->ID), array( 1280,800 ), false, '' );
								    $image = new YourImagick($src[0]);
								    $image->setImageFormat ("jpeg");
								    $image->colorize('#000000', 0.8);
								    $image->setimagecompressionquality(90); 
								    $fileDst="../images/HeaderPost/header_post_blog_".$PostID.".jpg";
									if($f=fopen($fileDst, "w")){ 
									  $image->writeImageFile($f);
									}else{
										$fileDst="../images/heroxxx.jpg";
									}
									$image->destroy();
								}
						    }

						}
				        // Do stuff with the post content.
		   
					    echo '
					    <div class="slider-container postHeaderALL postHeader'.$i.'">
							<div class="post-dest">
			
								<h1>'.$tituloPost.'</h1>
								<p>'.$the_excerpt.'</p>
								<a href="'.$permalink.'" class="waves-effect waves btn orange accent-4">Leer nota</a>
							</div>
						</div>
						<script>';

						if($i==0){
							echo 'jQuery("#slideshow").append("<div class=\'hero-image imageSlideShowBlog\' style=\'background-image: url('.$fileDst.'); \'/></div></div>")';
						}else{
							echo 'jQuery(".imageSlideShowBlog").first().before("<div class=\'hero-image imageSlideShowBlog\' style=\'background-image: url('.$fileDst.')\';/></div>")';
						}
						?>
							
						<?php echo '</script>';
						$i++;
	    			endwhile;
				else:
		    		// Insert any content or load a template for no posts found.
				endif;
			wp_reset_postdata();
		?>
			<div id="controlSlide" class="post-dest-selector">

			</div>
		</div>
		
		<div class="blog-module row grey lighten-5">
			<div id="blog-timeline" class="col m12 l8 blog-timeline-bx">
		<?php
		//$args = array ( 'category__in' => array(40) );
		if(isset($_GET["c"])){

				$args = array (  'cat='.$_GET["c"].'&posts_per_page=-1' );
				$query2 = new WP_Query( 'cat='.$_GET["c"].'&posts_per_page=-1' );
				//print_r($args);
			
		}else{
			$args = array ( 'posts_per_page=-1'  );
			$query2 = new WP_Query( 'posts_per_page=-1' );
		}
		$insertarVideo=0;
		$cargarmas=0;
		if ( $query2 -> have_posts() ):
		    while ( $query2 -> have_posts() ) :
		        $query2 -> the_post();
		    	$esvideo=false;
		    	$insertarVideo+=1;
		    	if(isset($_GET["c"])){
		    		$categoriaMostrar=$_GET["c"];
					$mostrar=0;
				}else{
					$mostrar=1;
				}
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
				if($mostrar==1){
					$tituloPost=  get_the_title( $query2->post->ID );
					$contenido=get_the_content($query2->post->ID);
					$PostID=$query2->post->ID;
					$permalink = get_permalink($query2->post->ID);
					$the_excerpt=get_the_excerpt($query2->post->ID);
			        // Imagen thumbnail
			        if (function_exists('has_post_thumbnail')) {
					    if ( has_post_thumbnail() ) {
					         $src = wp_get_attachment_image_src( get_post_thumbnail_id($query2->post->ID), array( 5600,1000 ), false, '' );
					    }
					}
		    ?>
		    	<?php
					echo '<div id="cargarmas'.$cargarmas.'"class="col s12 post-box-wrapper cargarmas">

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
		    	}
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
				<?php 
					if ( function_exists( 'tptn_show_daily_pop_posts' ) ) {
						tptn_show_daily_pop_posts(); 
					}
				?>		
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
					<li><a href="pdf/Terminos_y_Condiciones_de_Uso_y_Privacidad.pdf" target="_blank">Legales</a> / </li>
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
		  
		  <div id="slide-in-banner" class="z-depth-2 AnuncioComparadorCentro">

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
		<script src="../js/jquery.stayInWebApp.min.js"></script>
		<script src="../js/spin.js"></script>
		<script src="../js/iosOverlay.js"></script>
		<script src="../js/charCount.js"></script>
		<script src="../js/jquery.scrollUp.min.js"></script>
		<script src="../js/materialize.min.js"></script>
		<!--<script src="js/parallax.min.js"></script>-->
		<script src="../js/jquery.mCustomScrollbar.concat.min.js"></script>
		<script src="../js/init.config.js"></script>
		<script src="../js/init.js"></script>
		<!--INTERNET CHECK-->
		<script src="offline07/offline.min.js"></script>
		<link rel="stylesheet" href="offline07/themes/offline-theme-dark.css" />
		<link rel="stylesheet" href="offline07/themes/offline-language-spanish.css" />
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
		<script src="https://storage.googleapis.com/code.getmdl.io/1.0.6/material.min.js"></script>
		<script type="text/javascript" src="../js/fadeSlideShowBlog.js"></script>

		<script>
			jQuery(function() {
		  	
		  		FRMWRK.main.init();
		  					
		  	});
		  	jQuery(document).ready(function(){
		  		jQuery('#slideshow').fadeSlideShow();
		  		CargarAnuncio();
		  		cargarmas();
		  		$(".cargarmas").hide();
		  		//setTimeout(cargarmas, 3000);
		  	});
		</script>
		<script type="text/javascript">
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
			function CargarAnuncio(){
				/*
				if($('.AnuncioHomeDerecho').length){
					var data={
							CargarAnuncio:true,
							id_anuncio:3
						}
				
					jQuery.ajax({
						//dataType:"json",
						type: "POST",
						url: "http://www.eligefacil.com/listado.php",
						data: data
					})
				    .done(function(data){
				    	//$(".AnuncioDerechoHome").html("PruebaCargando")
						jQuery(".AnuncioHomeDerecho").append(data);
						jQuery(".AnuncioHomeDerecho").addClass("responsive-img")
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
						url: "http://www.eligefacil.com/listado.php",
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
				*/
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
		<script type="text/javascript">
			setTimeout(function(){var a=document.createElement("script");
			var b=document.getElementsByTagName("script")[0];
			a.src=document.location.protocol+"//script.crazyegg.com/pages/scripts/0048/8086.js?"+Math.floor(new Date().getTime()/3600000);
			a.async=true;a.type="text/javascript";b.parentNode.insertBefore(a,b)}, 1);
		</script>
	</body>

</html>