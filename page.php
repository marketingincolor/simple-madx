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

get_header();
global $post; ?>

<?php
	if ( is_page() && $post->post_parent ) {
	  $parent_page = get_post($post->post_parent);
	  $parent_name = $parent_page->post_name;
	
	if ($parent_page->post_name == 'specialty-solutions') {
		$parent_name = 'specialty';
	}else if ($parent_page->post_name == 'safety-security') {
		$parent_name = 'safety';
	}
?>

<section class="page-header" style="padding-bottom: 0">
	<div class="show-for-small-only">
		<?php get_template_part('template-parts/menus/'. $parent_name .'-header-menu'); ?>
	</div>

	<div id="header-grid" class="grid-container">
		<div class="grid-x">
			<div class="small-10 small-offset-1 large-12 large-offset-0 show-for-medium-only">
				<?php get_template_part('template-parts/menus/'. $parent_name .'-tablet-menu'); ?>
			</div>
			<div class="small-10 small-offset-1 large-12 large-offset-0 show-for-large">
				<?php get_template_part('template-parts/menus/'. $parent_name .'-header-menu'); ?>
			</div>
		</div>
	</div>

</section>

<?php } ?>

<section class="page-content">
	<div class="grid-container">
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
