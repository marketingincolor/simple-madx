<?php 
/* Template Name: About */
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

	<div class="grid-container">
		<div class="grid-x">
			<div class="small-10 small-offset-1 medium-8 large-offset-0 cell">
				<h1 class="blue"><?php the_field('about_hero_heading'); ?></h1>
				<aside class="yellow-underline left"></aside>
				<p class="subhead"><?php the_field('about_hero_subhead'); ?></p></a>
			</div>
		</div>
	</div>
</section>

<section class="about-types">
	<div class="grid-container">
	  <div class="grid-x grid-margin-x grid-margin-y">
			<div class="small-10 small-offset-1 medium-8 medium-offset-2 text-center">
				<h2 class="blue"><?php the_field('about_what_heading'); ?></h2>
				<aside class="yellow-underline center"></aside>
				<p class="subhead"><?php the_field('about_what_subhead'); ?></p></a>
			</div>
			<div class="small-10 small-offset-1 cell">
				<div class="grid-x grid-margin-x grid-margin-y">
					
					<?php

					// check if the repeater field has rows of data
					if( have_rows('about_types') ):
					  while ( have_rows('about_types') ) : the_row(); ?>
							
						<div class="medium-6 cell">
							<?php the_sub_field('icon'); ?>
							<h5 class="blue"><?php the_sub_field('heading'); ?></h5>
							<p><?php the_sub_field('subhead'); ?></p>
						</div>

					<?php endwhile;endif; ?>
					
				</div>
			</div>
		</div>
	</div>
</section>

<section class="about-next" style="background-image: url(<?php the_field('about_next_background_image') ?>);">
	<div class="grid-container">
		<div class="grid-x">
			<div class="small-10 small-offset-1 medium-8 large-6 large-offset-0">
				<h2 class="white"><?php the_field('about_next_heading') ?></h2>
				<aside class="yellow-underline left"></aside>
				<div class="white"><?php the_field('about_next_subhead') ?></div>
			</div>
		</div>
	</div>
</section>

<section class="about-content">
	<div class="grid-container">
		<div class="grid-x">
			<div class="small-12 cell content-block">
				<div class="grid-x">
					<div class="small-10 small-offset-1 medium-8 medium-offset-2">
						<?php the_content(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php 
endwhile;endif;
get_footer();