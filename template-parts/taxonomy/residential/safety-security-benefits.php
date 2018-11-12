<div class="small-10 small-offset-1 large-12 large-offset-0 cell">
	<div class="grid-x grid-margin-x grid-margin-y">
		<?php
		  $parent_tax = get_post_type($post->ID);
		  $child_tax  = get_queried_object()->slug;
			$args = array(
				'post_type' => 'benefits',
				'tax_query' => array(
					array(
						'taxonomy' => 'benefits_taxonomies',
						'field'    => 'slug',
						'terms'    => $child_tax.'-'.$parent_tax,
					),
				),
			);
			$query = new WP_Query( $args );
			while ( $query->have_posts() ) : $query->the_post();
		?>

		<div class="medium-4 cell text-center">
			<?php the_field('benefit_icon'); ?>
			<h5 class="blue"><?php the_title(); ?></h5>
			<?php the_content(); ?>
		</div>

		<?php endwhile; wp_reset_postdata(); ?>
	</div>
</div>