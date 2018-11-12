<section class="taxonomy-intro">
	<div class="grid-container">
		<div class="grid-x">
			<div class="large-8 medium-10 medium-offset-1 large-offset-2 cell text-center">
				<h1 class="blue">Articles<?php //the_field('intro_heading',$term); ?></h1>
				<aside class="yellow-underline center"></aside>
				<p class="subhead"><?php //the_field('intro_subhead',$term); ?></p>
			</div>
		</div>
	</div>
	<div class="articles">
		<div class="grid-container">
			<div class="grid-x">
				<div class="small-10 small-offset-1 large-12 large-offset-0 cell">
					<div class="grid-x grid-margin-x grid-margin-y">
						<?php 
						$doc_args = array( 
							'posts_per_page'=>-1,
							'post_type' => 'madicou',
							'madicou-types' => 'article'
						);
						$doc_query = new WP_Query( $doc_args );
						if ( $doc_query->have_posts() ) : while ( $doc_query->have_posts() ) : $doc_query->the_post(); 
							?>
							<div class="medium-6 large-3 cell module auto-height">
								<a href="<?php echo get_permalink(); ?>"><div class="module-bg" style="background-image:url(<?php the_post_thumbnail_url(); ?>)"></div></a>
								<div class="meta">
									<a href="<?php echo get_permalink(); ?>"><h4 class="blue"><?php the_title() ;?></h4></a>
									<?php the_excerpt() ;?>
								</div>
							</div>
						<?php endwhile; else: ?> 
							<div class="cell">
								<p style="padding:1em;">Sorry, there are no <?php echo $post->post_title; ?> Articles to display</p>
							</div>
						<?php endif;wp_reset_postdata(); ?>
					</div>
				</div>
			</div>
	  </div>
	</div>
</section>