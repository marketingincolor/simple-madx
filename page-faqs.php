<?php 
/* Template Name: FAQs */
get_header();
if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<section class="page-hero" style="background-image: url(<?php the_field('about_hero_background_image'); ?>);">

	<div class="show-for-small-only">
		<?php get_template_part('template-parts/menus/about-header-menu'); ?>
	</div>

	<div id="header-grid" class="grid-container">
		<div class="grid-x">
			<div class="small-10 small-offset-1 large-12 large-offset-0 show-for-medium-only">
				<?php get_template_part('template-parts/menus/about-tablet-menu'); ?>
			</div>
			<div class="small-10 small-offset-1 large-12 large-offset-0 show-for-large">
				<?php get_template_part('template-parts/menus/about-header-menu'); ?>
			</div>
		</div>
	</div>
</section>

<section class="about-content">
	<div class="grid-container">
		<div class="grid-x">
			<div class="small-10 small-offset-1 large-12 large-offset-0 cell content-block">
				<div class="grid-x">
					<div class="small-10 small-offset-1 cell text-center">
						<h1 class="blue"><?php the_title(); ?></h1>
						<aside class="yellow-underline center"></aside>
						<div class="subhead"><?php the_content(); ?></div>
					</div>

					<faqs></faqs>
						
				</div>
			</div>
		</div>
	</div>
</section>

<?php 
endwhile;endif;
get_footer();