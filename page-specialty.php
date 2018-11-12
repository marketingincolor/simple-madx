<?php 
/* Template Name: Specialty Solutions */
get_header(); ?>

<section class="page-hero" style="background-image: url(<?php the_field('commercial_hero_background_image'); ?>);">

	<div class="show-for-small-only">
		<?php get_template_part('template-parts/menus/specialty-header-menu'); ?>
	</div>

	<div id="header-grid" class="grid-container">
		<div class="grid-x">
			<div class="small-10 small-offset-1 large-12 large-offset-0 show-for-medium-only">
				<?php get_template_part('template-parts/menus/specialty-tablet-menu'); ?>
			</div>
			<div class="small-10 small-offset-1 large-12 large-offset-0 show-for-large">
				<?php get_template_part('template-parts/menus/specialty-header-menu'); ?>
			</div>
		</div>
	</div>

	<div class="grid-container">
		<div class="grid-x">
			<div class="small-10 small-offset-1 cell text-center">
				<h1 class="blue"><?php the_field('commercial_hero_heading'); ?></h1>
				<aside class="yellow-underline center"></aside>
				<p class="subhead"><?php the_field('commercial_hero_subhead'); ?></p>
				<a href="<?php the_field('commercial_hero_button_link'); ?>" class="btn-yellow solid"><?php the_field('commercial_hero_button_text'); ?></a>
			</div>
		</div>
	</div>
</section>

<section class="capabilities">
	<div class="grid-container">
		<div class="grid-x grid-margin-x">
			<div class="small-10 small-offset-1 cell text-center">
				<h2 class="blue"><?php the_field('capabilities_heading'); ?></h2>
				<aside class="yellow-underline center"></aside>
				<p class="subhead"><?php the_field('capabilities_subhead'); ?></p>
			</div>
			<?php
			if( have_rows('capabilities') ):
			  while ( have_rows('capabilities') ) : the_row(); ?>

			    <div class="medium-4 cell module auto-height">
			    	<div class="module-bg" style="background-image:url(<?php the_sub_field('image'); ?>)"></div>
			    	<div class="meta">
			    		<h4 class="blue"><?php the_sub_field('heading'); ?></h4>
			    		<p><?php the_sub_field('copy'); ?></p>
			    	</div>
			    </div>

			<?php endwhile;endif; ?>
			
		</div>
	</div>
</section>

<!-- <section class="featured-products">
	<div class="grid-container">
		<div class="grid-x">
			<div class="small-10 small-offset-1 cell text-center">
				<h2 class="blue">Featured Products</h2>
				<aside class="yellow-underline center"></aside>
				<p class="subhead">All our speciality solutions are manufactured to meet or exceed the highest quality standards.</p>
			</div>
			<div class="small-10 small-offset-1 cell">
				<div class="taxonomy-products">

					<specialty-products-home></specialty-products-home>
					
				</div>
			</div>
		</div>
	</div>
</section> -->

<?php get_template_part('template-parts/taxonomy/specialty-solutions/contact'); ?>

<?php get_footer();