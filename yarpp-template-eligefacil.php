<?php 
/*
YARPP Template: EligeFacil.com
Author: Designo.mx (Emilio Osorio)
Description: A simple template to related post in eligefacil.com.
*/
?>
<div class="row">
<?php if (have_posts()):?>
	<?php while (have_posts()) : the_post(); ?>
		<div class="col s12 m6">
			<div class="card medium">
				<div class="card-image waves-effect waves-block waves-light">
				<?php
					$PostID=get_the_ID();
					if ( has_post_thumbnail() ) {
	                   //$src = wp_get_attachment_image_src( get_post_thumbnail_id($PostID), array( 5600,1000 ), false, '' );
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
						echo '<img class="activator" src="'.$fileDst.'">';
	              	}else{
	              		echo '<img class="activator" src="http://www.eligefacil.com/blog/wp-content/plugins/top-10/default.png">';
	              	}
	          	?>	
					<span class="card-title"><?php the_title(); ?></span>
				</div>
				<div class="card-content">
					<p><?php
										$rem_len=97;
										$trunc_ex = substr(get_the_excerpt(), 0, $rem_len); //truncate excerpt to fit remaining space
										if(strlen($trunc_ex) < strlen(get_the_excerpt())) $trunc_ex = $trunc_ex . " [...]";
										echo "<p>" . $trunc_ex . "</p>"; //display excerpt
									?></p>
				</div>
				<div class="card-action">
	                <a href="<?php the_permalink() ?>" class="btn orange accent-4 right">Leer nota</a>
	              </div>
			</div>
		</div>
	<?php endwhile; ?>


<?php else: ?>
<p>No related posts.</p>
<?php endif; ?>
</div>
