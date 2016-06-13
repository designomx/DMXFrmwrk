<?php

  /**
  *@desc A single blog post See page.php is for a page layout.
  */

	get_header();

  if (have_posts()) : while (have_posts()) : the_post();
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
    <div id="contact-module" class="row grey lighten-5">
      <div class="post-page-bx row">


	<article class="postWrapper" id="post-<?php the_ID(); ?>">

      <header>
          <div class="postTitle">
            <span class="diamond">&diams;</span>
            <span class="diamond">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <?php the_title(); ?>
            <span class="diamond">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <span class="diamond">&diams;</span>
          </div>
          <!--div class="postDate"><?php the_date(); ?></div-->
      </header>

      <section class="post"><?php the_content(__('(more...)')); ?></section>
      <!--footer class="postMeta">Category: < ?php the_category(', ') . " " . the_tags(__('Tags: '), ', ', ' | ') . edit_post_link(__('Edit'), ''); ? ></footer-->

			<div class="clearfix"></div>
			<div id="sharing"></div>
      
	</article>




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
  <?php /*
   
  <div id="relatedPosts">
  
    <h2>ART&Iacute;CULOS RELACIONADOS</h2>
		<?php
    
    $postId = get_the_ID();

    / *$categsNotToInclude = array();
    if ( get_category_by_slug( 'sube-tu-columna' ) ) {
      array_push( $categsNotToInclude, get_category_by_slug( "sube-tu-columna" )->term_id );
    }* /
    
    $postTagsIds = wp_get_post_tags( $postId, array( 'fields' => 'ids' ) );

    // Si hay tags, entonces creamos 2 queries:
    // 1 con máximo 4 posts relacionados por los tags
    // y otro con máximo 4 posts relacionados por las categorias
    // Y al final hacemos un merge de los 2 resultsets y sólo mostramos los 4 primeros,
    // así, si no hay 4 posts relacionados por tags, se completan con los relacionados por las categorias
    if ( sizeof( $postTagsIds ) > 0 ) {

      $args = array(
        'tag__in'          => $postTagsIds,
        'post__not_in'     => array( $postId ),
        / *'category__not_in' => $categsNotToInclude,* /
        'showposts'        => 8
      );

      $my_query = new WP_Query( $args );

      $postCatsIds = array();
      foreach ( get_the_category( $postId ) as $category ) {
        array_push( $postCatsIds, $category->term_id );
      }

      $args2 = array(
        'category__in'     => $postCatsIds,
        'post__not_in'     => array( $postId ),
        / *'category__not_in' => $categsNotToInclude,* /
        'showposts'        => 8
      );

      $my_query2 = new WP_Query( $args2 );

      / * Hacemos el merge de los 2 resultsets * /

      //create new empty query and populate it with the other two
      $wp_query        = new WP_Query();
      $wp_query->posts = array_merge( $my_query->posts, $my_query2->posts );

      //populate post_count count for the loop to work correctly
      $wp_query->post_count = $my_query->post_count + $my_query2->post_count;

    } else { // Si no hay tags para encontrar los posts relacionados, buscamos por categoria únicamente.

      $postCatsIds = array();
      foreach ( get_the_category( $postId ) as $category ) {
        array_push( $postCatsIds, $category->term_id );
      }

      $args2 = array(
        'category__in'     => $postCatsIds,
        'post__not_in'     => array( $postId ),
        / *'category__not_in' => $categsNotToInclude,* /
        'showposts'        => 8
      );

      $wp_query = new WP_Query( $args2 );

    }

    $postNum = 1;

    while ( $wp_query->have_posts() && $postNum < 8 ) : $wp_query->the_post(); ?>
    
      <a href="<?php the_permalink(); ?>">
        <div class="relatedPost">
          <?php
            if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
              the_post_thumbnail();
            } 
          ?>
        </div>
      </a>
      
    <?php
      $postNum++;
    
    endwhile;

    wp_reset_query();

    ?>
    <div class="clearfix"></div>
    
  </div><!-- #relatedPosts --> */ ?>

	<?php

  endwhile; else: ?>

		<p>Sorry, no posts matched your criteria.</p>

<?php
	endif;
	
  get_footer();
	
?>