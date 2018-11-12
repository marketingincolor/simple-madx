<?php 
/* Template Name: Safety Security */
get_header(); ?>

<section class="page-hero" style="background-image: url(<?php the_field('commercial_hero_background_image'); ?>);">

	<div class="show-for-small-only">
		<?php get_template_part('template-parts/menus/safety-header-menu'); ?>
	</div>

	<div id="header-grid" class="grid-container">
		<div class="grid-x">
			<div class="small-10 small-offset-1 large-12 large-offset-0 show-for-medium-only">
				<?php get_template_part('template-parts/menus/safety-tablet-menu'); ?>
			</div>
			<div class="small-10 small-offset-1 large-12 large-offset-0 show-for-large">
				<?php get_template_part('template-parts/menus/safety-header-menu'); ?>
			</div>
		</div>
	</div>

	<div class="grid-container">
		<div class="grid-x">
			<div class="medium-10 medium-offset-1 cell text-center">
				<h1 class="blue"><?php the_field('commercial_hero_heading'); ?></h1>
				<aside class="yellow-underline center"></aside>
				<p class="subhead"><?php the_field('commercial_hero_subhead'); ?></p>
				<a href="<?php the_field('commercial_hero_button_link'); ?>" class="btn-yellow solid"><?php the_field('commercial_hero_button_text'); ?></a>
			</div>
		</div>
	</div>
</section>

<?php get_template_part('template-parts/top-level-page/film-benefits') ?>

<?php get_template_part('template-parts/top-level-page/warranty-information'); ?>

<section class="film-type">
	<div class="grid-container">
		<div class="grid-x">
			<div class="medium-8 large-6 medium-offset-2 large-offset-3 cell text-center">
				<h3 class="blue"><?php the_field('safety_film_heading'); ?></h3>
				<aside class="yellow-underline center"></aside>
				<p class="subhead"><?php the_field('safety_film_subhead'); ?></p>
			</div>
		</div>
	</div>
	<div class="grid-container">
		
		<safety-film-types></safety-film-types>
		
	</div>
</section>

<?php get_template_part('template-parts/top-level-page/film-tips'); ?>

<?php get_template_part('template-parts/top-level-page/find-dealer'); ?>

<?php get_footer();