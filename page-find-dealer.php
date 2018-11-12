<?php 
/* Template Name: Find Dealer */
get_header(); ?>

<section class="page-hero" style="background-image: url(<?php the_post_thumbnail_url($post->ID); ?>);">

	<div class="show-for-small-only">
		<?php get_template_part('template-parts/menus/residential-header-menu'); ?>
	</div>

	<div id="header-grid" class="grid-container">
		<div class="grid-x">
			<div class="small-10 small-offset-1 large-12 large-offset-0 show-for-medium-only">
				<?php get_template_part('template-parts/menus/residential-tablet-menu'); ?>
			</div>
			<div class="small-10 small-offset-1 large-12 large-offset-0 show-for-large">
				<?php get_template_part('template-parts/menus/residential-header-menu'); ?>
			</div>
		</div>
	</div>

	<div class="grid-container">
		<div class="grid-x">
			<div class="large-8 medium-10 small-offset-1 small-10 large-offset-0 cell">
				<h1 class="blue"><?php the_field('find_dealer_heading'); ?></h1>
				<aside class="yellow-underline left"></aside>
				<p class="subhead"><?php the_field('find_dealer_subhead'); ?></p>
			</div>
			<div class="small-10 small-offset-1 large-12 large-offset-0 cell">
				<div class="grid-x">
					
					<find-dealer-page></find-dealer-page>

				</div>
			</div>
		</div>
	</div>
</section>

<section class="home-modules">
	<div class="grid-container">
		<div class="grid-x grid-margin-x grid-margin-y">
			<div class="small-10 small-offset-1 large-12 large-offset-0">
				<div class="grid-x grid-margin-x grid-margin-y">

					<?php if( have_rows('home_modules_small') ):
					    while ( have_rows('home_modules_small') ) : the_row(); ?>

					  <div class="medium-6 large-3 cell module">
					  	<a href="<?php the_sub_field('link_url'); ?>"><div class="module-bg small" style="background-image: url(<?php the_sub_field('image'); ?>);"></div></a>
					  	<div class="meta">
					  		<a href="<?php the_sub_field('link_url'); ?>"><h4 class="blue"><?php the_sub_field('icon'); ?>&nbsp; <?php the_sub_field('heading'); ?></h4></a>
					  		<p><?php the_sub_field('body'); ?></p>
					  	</div>
					  </div>

					<?php endwhile;endif; ?>

				</div>
			</div>
		</div>
	</div>
</section>

<?php get_footer();