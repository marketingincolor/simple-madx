<section class="taxonomy-intro">
	<div class="grid-container">
		<div class="grid-x">
			<div class="large-8 medium-10 medium-offset-1 large-offset-2 cell text-center">
				<h1 class="blue">Documents<?php //the_field('intro_heading',$term); ?></h1>
				<aside class="yellow-underline center"></aside>
				<p class="subhead"><?php //the_field('intro_subhead',$term); ?></p>
			</div>
		</div>
	</div>
	<div class="documents">
		<div class="grid-container">
			<div class="grid-x">
				<div class="small-10 small-offset-1 large-12 large-offset-0 cell">
					<div class="grid-x grid-margin-x grid-margin-y">
						<?php 
						$doc_args = array( 
							'posts_per_page'=>-1,
							'post_type' => 'madicou',
							'madicou-types' => 'document'
						);
						$doc_query = new WP_Query( $doc_args );
						if ( $doc_query->have_posts() ) : while ( $doc_query->have_posts() ) : $doc_query->the_post(); 
							$doc_attachment = get_field('doc_attachment'); // Requires ACF Field for 'doc_attachment'
							?>
							<div class="medium-6 large-3 cell module auto-height">
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
								<p style="padding:1em;">Sorry, there are no Documents to display</p>
							</div>
						<?php endif;wp_reset_postdata(); ?>
					</div>
				</div>
			</div>
	  </div>
	</div>
</section>