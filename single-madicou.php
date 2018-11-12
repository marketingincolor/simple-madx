<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */
global $post;
get_header('madicou'); ?>

<?php get_template_part('template-parts/madicou/page-search'); ?>

<?php get_template_part('template-parts/madicou/submenu'); ?>

<?php get_template_part( 'template-parts/featured-image' ); ?>

<section class="page-content">
	<div class="grid-container">
		<div class="grid-x grid-margin-x grid-margin-y">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'template-parts/content-madicou', '' ); ?>
			<?php endwhile; ?>
		</div>
	</div>
</section>

<?php get_footer('madicou');
