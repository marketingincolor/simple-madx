<?php 
if ( $doc_query->have_posts() ) : while ( $doc_query->have_posts() ) : $doc_query->the_post(); 
	?>

	<div class="cell">
		<div class="meta">
			<h4 class="blue"><?php the_title() ;?></h4>
			<?php the_content() ;?>
		</div>
	</div>

<?php endwhile; else: ?> 
	<div class="cell">
		<p style="padding:1em;">There are no <?php echo $post->post_title; ?> FAQs to display</p>
	</div>
<?php endif;wp_reset_postdata(); ?>