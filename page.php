<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

/*the_post_thumbnail_url( 'full' );*/

/*if ( the_post_thumbnail_url( 'full' ) != 'false' ) {
$hero_path = the_post_thumbnail_url( 'full' ); 
} else {*/
$hero_path = get_template_directory_uri().'/dist/assets/images/Brand-Hub-Page-Header.jpg';
/*}*/

get_header(); ?>
<section class="page-hero relative" style="background-image: url(<?php echo $hero_path; ?>);">
	<div class="overlay absolute"></div>
	<div class="grid-container" id='header-grid'>
		<div class="grid-x">
			<div class="small-10 small-offset-1 large-12 large-offset-0 cell">
				<?php //if(get_post_type() == 'post') { ?>
				  <?php get_template_part('template-parts/menus/hub-header-menu'); ?>
				<?php //} ?>
			</div>
		</div>
	</div>
</section>
<section class="page-content">
	<div class="grid-container">
        <?php if ( !is_front_page() ) { ?>
		<div class="grid-x grid-margin-y">
			<div class="small-10 small-offset-1 cell columns">
				<?php if (function_exists('wordpress_breadcrumbs')) wordpress_breadcrumbs(); ?>
			</div>
		</div>
        <?php } ?>

		<main class="grid-x grid-margin-y">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php if ( !is_front_page() ) { ?>
				<?php get_template_part( 'template-parts/content', 'page' ); ?>
				<?php } else { ?>
				<?php get_template_part( 'template-parts/content', 'frontpage' ); ?>
				<?php } ?>


			<?php endwhile; ?>
		</main>
		</div>
	</div>
</section>

<?php
get_footer();
