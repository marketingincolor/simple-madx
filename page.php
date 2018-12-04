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
get_header(); ?>

<section class="page-content">
	<div class="grid-container">
        <?php if ( !is_front_page() ) { ?>
		<div class="grid-x grid-margin-y">
			<div class="small-10 small-offset-1 large-8 large-offset-2 cell columns">
				<?php if (function_exists('wordpress_breadcrumbs')) wordpress_breadcrumbs(); ?>
			</div>
		</div>
        <?php } ?>

		<main class="grid-x grid-margin-y">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'template-parts/content', 'page' ); ?>
			<?php endwhile; ?>
		</main>
		</div>
	</div>
</section>

<?php
get_footer();
