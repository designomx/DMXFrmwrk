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
						echo '<img class="activator" src="images/'.the_post_thumbnail().'">';
	              	}else{
	              		echo '<img class="activator" src="http://www.eligefacil.com/blog/wp-content/plugins/top-10/default.png">';
	              	}
	          	?>	
					<span class="card-title"><?php the_title(); ?></span>
				</div>
				<div class="card-content">
					<p><?php the_excerpt(); ?></p>
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
