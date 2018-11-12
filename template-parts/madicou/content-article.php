<?php 
if ( $article_query->have_posts() ) : while ( $article_query->have_posts() ) : $article_query->the_post(); 
	?>
	<div class="cell medium-3 module auto-height">
		<a href="<?php echo get_permalink(); ?>"><?php the_post_thumbnail( 'large', array( 'alt' => get_the_title() ) ); ?></a>
		<div class="meta">
			<a href="<?php echo get_permalink(); ?>"><h4 class="blue"><?php the_title() ;?></h4></a>
			<?php the_excerpt() ;?>
		</div>
	</div>
<?php endwhile; else: ?> 
	<div class="cell">
		<p style="padding:1em;">There are no <?php echo $post->post_title; ?> Articles to display</p>
	</div>
<?php endif;wp_reset_postdata(); ?>