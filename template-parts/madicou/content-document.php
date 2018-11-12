<?php 
if ( $doc_query->have_posts() ) : while ( $doc_query->have_posts() ) : $doc_query->the_post(); 
	$doc_attachment = get_field('doc_attachment'); // Requires ACF Field for 'doc_attachment'
	?>
	<div class="cell medium-3">
		<div class="meta">
		<?php if ( $doc_attchment != '' ) { ?>
			<a href="<?php echo $doc_attchment; ?>" class="doc-link"><i class="fal fa-file-pdf"></i></a>
			<h4 class="blue"><a href="<?php echo $doc_attchment; ?>" class="doc-link"><?php the_title() ;?></a></h4>
		<?php } else { ?>
			<span class="doc-link blue"><i class="fal fa-file-pdf"></i></span>
			<h4 class="blue"><span class="doc-link blue"><?php the_title() ;?></span></h4>
		<?php } ?>
			<?php the_excerpt() ;?>
		</div>
	</div>
<?php endwhile; else: ?> 
	<div class="cell">
		<p style="padding:1em;">There are no <?php echo $post->post_title; ?> Documents to display</p>
	</div>
<?php endif;wp_reset_postdata(); ?>