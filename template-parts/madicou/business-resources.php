<section class="business-resources">
	<div class="grid-container">
		<div class="grid-x">
			<div class="small-10 small-offset-1 large-12 large-offset-0 cell">
			<h3 class="section-h3">Employee Resources <a href="/madicou/business/employee" class="see-more">See More &nbsp;<i class="fal fa-long-arrow-right"></i></a></h3>
			</div>
			<div class="small-10 small-offset-1 large-12 large-offset-0 cell">
				<div class="grid-x grid-margin-x grid-margin-y">

					<?php
						$args = array(
							'post_type' => 'madicou',
							'posts_per_page' => 3,
							'tax_query' => array(
								array(
									'taxonomy' => 'madicou_taxonomies',
									'field'    => 'slug',
									'terms'    => 'employee',
								),
							),
						);
						$query = new WP_Query( $args );
						if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
							$post_link = get_the_permalink();
							if (has_post_format('video')) {
								$video_url = get_field('video_url'); // Requires ACF Field for 'video_url'
								$video_meta = get_field('video_meta'); // Requires ACF Field for 'video_meta'
								$video_file = get_field('video_attachment'); // Requires ACF Field for 'video_meta'
								$post_link = '#!'; // Change post_link if it's a video
							}
					?>

					<div class="medium-6 large-4 cell module auto-height">
						<div class="image-link" data-videotitle="Title of Video">
						  <a href="<?php echo $post_link; ?>" <?php if (has_post_format('video')) {echo 'data-open="video-modal"';} ?> class="videolink" data-videourl="<?php echo $video_url; ?>" data-videotitle="<?php the_title() ;?>" data-videometa="<?php echo $video_meta; ?>" data-attach="<?php echo $video_file; ?>" data-videotxt="<?php the_content() ;?>"><div class="module-bg small" style="background-image: url(<?php the_post_thumbnail_url(); ?>);"></div></a>
						</div>
						<div class="meta">
							<a href="<?php echo $post_link; ?>" <?php if (has_post_format('video')) {echo 'data-open="video-modal"';} ?> class="videolink" data-videourl="<?php echo $video_url; ?>" data-videotitle="<?php the_title() ;?>" data-videometa="<?php echo $video_meta; ?>" data-attach="<?php echo $video_file; ?>" data-videotxt="<?php the_content() ;?>"><h4 class="blue"><?php the_title(); ?></h4></a>
							<?php the_content(); ?>
							<?php if(has_post_format('video')) { ?>
								<p><i class="fal fa-clock"></i> &nbsp;<?php echo $video_meta; ?></p>
							<?php }else{ ?>
							  <a href="<?php echo $post_link; ?>" class="blue read-more">Learn More &nbsp;<i class="fal fa-long-arrow-right"></i></a>
						  <?php } ?>
						</div>
					</div>

					<?php endwhile;endif;wp_reset_postdata(); ?>

				</div>
			</div>
		</div>
	</div>
</section>