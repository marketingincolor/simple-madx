<section class="taxonomy-intro">
	<div class="grid-container">
		<div class="grid-x">
			<div class="large-8 medium-10 medium-offset-1 large-offset-2 cell text-center">
				<h1 class="blue"><?php the_field('intro_heading',$term); ?></h1>
				<aside class="yellow-underline center"></aside>
				<p class="subhead"><?php the_field('intro_subhead',$term); ?></p>
			</div>
		</div>
	</div>
	<div class="case-studies">
		<div class="grid-container">
			<div class="grid-x grid-margin-y">

		  <!-- Query custom post type 'safety' filtered by taxonomy safety_taxonomies -> case-studies -->
			<?php
			  $term = get_queried_object();
				$args = array(
					'post_type' => get_post_type($post->ID),
					'tax_query' => array(
						array(
							'taxonomy' => get_post_type($post->ID).'_taxonomies',
							'field'    => 'slug',
							'terms'    => $term->slug,
						),
					),
				);
				$query = new WP_Query( $args );
				while ( $query->have_posts() ) : $query->the_post();
			?>

				<div class="medium-10 medium-offset-1 cell case-study-block">
					<div class="grid-x">
						<aside class="medium-5 cell case-study-img" style="background-image: url(<?php the_post_thumbnail_url(); ?>);"></aside>
						<article class="medium-7 cell">
							<p class="industry"><?php the_field('case_study_industry_type'); ?></p>
							<h2 class="blue"><?php the_title(); ?></h2>
							<p class="excerpt"><?php the_field('case_study_excerpt'); ?></p>
							<a href="<?php the_permalink(); ?>" class="btn-yellow border"><?php the_field('case_study_cta_text'); ?></a>
						</article>
					</div>
				</div>

			<?php endwhile; wp_reset_postdata(); ?>

			</div>
	  </div>
	</div>
</section>