<?php 
/* Template Name: Benefits */
get_header(); ?>

<div class="show-for-small-only">
	<?php get_template_part('template-parts/menus/commercial-header-menu'); ?>
</div>

<div style="background-color:#FFF">
	<div class="grid-container">
		<div class="grid-x">
			<div class="small-10 small-offset-1 large-12 large-offset-0 show-for-medium-only">
				<?php get_template_part('template-parts/menus/commercial-tablet-menu'); ?>
			</div>
			<div class="small-10 small-offset-1 large-12 large-offset-0 show-for-large">
				<?php get_template_part('template-parts/menus/commercial-header-menu'); ?>
			</div>
		</div>
	</div>
</div>

<section class="benefits-intro">
	<div class="grid-container">
		<div class="grid-x">
			<div class="small-10 small-offset-1 large-8 large-offset-2 cell text-center">
				<h1 class="blue"><?php the_field('benefits_intro_heading'); ?></h1>
				<aside class="yellow-underline center"></aside>
				<p><?php the_field('benefits_intro_subhead'); ?></p>
			</div>
		</div>
	</div>
</section>

<section class="benefits-energy" style="background-image: url(<?php the_field('benefits_energy_bg_image'); ?>);">
	<div class="grid-container">
		<div class="grid-x">
			<div class="medium-5 small-offset-1 small-10 large-3 cell">
				<h2 class="blue"><?php the_field('benefits_energy_heading'); ?></h2>
				<aside class="yellow-underline left"></aside>
				<p><?php the_field('benefits_energy_subhead'); ?></p>
			</div>
		</div>
	</div>
</section>

<section class="benefits-environment" style="background-image: url(<?php the_field('benefits_environment_bg_image'); ?>);">
	<div class="grid-container">
		<div class="grid-x">
			<div class="medium-6 small-10 small-offset-1 cell">
				<h2 class="white"><?php the_field('benefits_environment_heading'); ?></h2>
				<aside class="yellow-underline left"></aside>
				<p class="white"><?php the_field('benefits_environment_subhead'); ?></p>
			</div>
		</div>
	</div>
</section>

<section class="benefits-fade" style="background-image: url(<?php the_field('benefits_fade_bg_image'); ?>);">
	<div class="grid-container">
		<div class="grid-x">
			<div class="medium-7 medium-offset-4 small-10 small-offset-1 large-6 large-offset-5 cell text-right">
				<h2 class="white"><?php the_field('benefits_fade_heading'); ?></h2>
				<aside class="yellow-underline right"></aside>
				<p class="white"><?php the_field('benefits_fade_subhead'); ?></p>
			</div>
		</div>
	</div>
</section>

<section class="benefits-safety" style="background-image: url(<?php the_field('benefits_safety_bg_image'); ?>);">
	<div class="grid-container">
		<div class="grid-x">
			<div class="medium-5 small-10 small-offset-1 large-4 cell">
				<h2 class="blue"><?php the_field('benefits_safety_heading'); ?></h2>
				<aside class="yellow-underline left"></aside>
				<p><?php the_field('benefits_safety_subhead'); ?></p>
			</div>
		</div>
	</div>
</section>

<section class="benefits-appearance" style="background-image: url(<?php the_field('benefits_appearance_bg_image'); ?>);">
	<div class="grid-container">
		<div class="grid-x">
			<div class="medium-7 medium-offset-4 small-10 small-offset-1 large-6 large-offset-5 cell text-right">
				<h2 class="white"><?php the_field('benefits_appearance_heading'); ?></h2>
				<aside class="yellow-underline right"></aside>
				<p class="white"><?php the_field('benefits_appearance_subhead'); ?></p>
			</div>
		</div>
	</div>
</section>

<section class="taxonomy-testimonials">
	<div class="grid-container">
		<div class="grid-x">
			<div class="small-10 large-8 small-offset-1 large-offset-2 text-center">
				<h3 class="blue">Customer Testimonials</h3>
				<aside class="yellow-underline center"></aside>
				<!-- Foundation 6 Carousel/Orbit -->
				<div class="orbit" role="region" aria-label="Favorite Space Pictures" v-f-orbit>
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
						    			$args = array(
						    				'post_type' => 'testimonials',
						    				'posts_per_page' => 1,
						    				'tax_query' => array(
						    					array(
						    						'taxonomy' => 'testimonials_taxonomies',
						    						'field'    => 'slug',
						    						'terms'    => 'commercial',
						    					),
						    				),
						    			);
						    			$query = new WP_Query( $args );
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
		    		    						'terms'    => 'commercial',
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

<?php get_template_part('template-parts/top-level-page/find-dealer'); ?>

<?php get_footer();