<?php
$term = get_queried_object();
if ($term->ID == 1258) {
	$slug = 'protectionpro';
}else{
	$slug = $term->slug;
}
$args = array(
	'post_type' => 'testimonials',
	'posts_per_page' => 1,
	'tax_query' => array(
		array(
			'taxonomy' => 'testimonials_taxonomies',
			'field'    => 'slug',
			'terms'    => $slug,
		),
	),
);
$query = new WP_Query( $args );
// if have testimonials then show section
if ($query->have_posts()) {
?>

<section class="taxonomy-testimonials">
	<div class="grid-container">
		<div class="grid-x">
			<div class="small-10 large-8 small-offset-1 large-offset-2 text-center">
				<h2 class="blue">Customer Testimonials</h2>
				<aside class="yellow-underline center"></aside>
				<!-- Foundation 6 Carousel/Orbit -->
				<div class="orbit" role="region" aria-label="Customer Testimonials" v-f-orbit>
				  <div class="orbit-wrapper">
				    <div class="orbit-controls">
				      <button class="orbit-previous"><span class="show-for-sr">Previous Slide</span><i class="fas fa-chevron-left"></i></button>
				      <button class="orbit-next"><span class="show-for-sr">Next Slide</span><i class="fas fa-chevron-right"></i></button>
				    </div>
				    <div class="grid-x">
				    	<div class="small-10 small-offset-1 medium-8 medium-offset-2 cell">
						    <ul class="orbit-container">

						    	  <!-- Query custom post type 'testimonials' filtered by taxonomy testimonials_taxonomies -->
						    		<?php
						    			while ( $query->have_posts() ) : $query->the_post();
						    		?>
						    		
								      <li class="is-active orbit-slide">
								        <div class="content"><?php the_content(); ?></div>
								        <address class="name"><?php the_field('testimonial_name'); ?></address>
								        <address class="location"><?php the_field('testimonial_location'); ?></address>
								      </li>

						    		
						    		<?php endwhile; wp_reset_postdata(); ?>

		    		    		<?php
		    		    			$args = array(
		    		    				'post_type' => 'testimonials',
		    		    				'posts_per_page' => 99,
		    		    				'offset' => 1,
		    		    				'tax_query' => array(
		    		    					array(
		    		    						'taxonomy' => 'testimonials_taxonomies',
		    		    						'field'    => 'slug',
		    		    						'terms'    => $term->slug,
		    		    					),
		    		    				),
		    		    			);
		    		    			$query = new WP_Query( $args );
		    		    			while ( $query->have_posts() ) : $query->the_post();
		    		    		?>
		    		    		
		    				      <li class="orbit-slide">
		    				        <div class="content"><?php the_content(); ?></div>
		    				        <address class="name"><?php the_field('testimonial_name'); ?></address>
		    				        <address class="location"><?php the_field('testimonial_location'); ?></address>
		    				      </li>

		    		    		
		    		    		<?php endwhile; wp_reset_postdata(); ?>
						      
						    </ul>
				    	</div>
				    </div>
				  </div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php } ?>