<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

?>

<section class="page-hero" style="<?php the_post_thumbnail_url( 'full' ); ?>">

	<?php get_template_part('template-parts/menus/blog-header-menu'); ?>

	<div class="grid-container">
		<div class="grid-x">
			<div class="large-8 medium-10 cell">
				<h1 class="blue"><?php the_field('page_hero_title'); ?></h1>
				<aside class="yellow-underline left"></aside>
				<p class="subhead"><?php the_field('page_hero_subhead'); ?></p>
				<a href="<?php the_field('page_hero_left_button_link'); ?>" class="btn-yellow solid"><?php the_field('page_hero_left_button_text'); ?></a>&nbsp;&nbsp;&nbsp;<a href="<?php the_field('page_hero_right_button_link'); ?>" class="btn-yellow border"><?php the_field('page_hero_right_button_text'); ?></a>
			</div>
		</div>
	</div>
</section>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header>
	<?php
		if ( is_single() ) {
			the_title( '<h1 class="entry-title">', '</h1>' );
		} else {
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		}
	?>
		<?php foundationpress_entry_meta(); ?>
	</header>
	<div class="entry-content">
		<?php the_content(); ?>
		<?php edit_post_link( __( '(Edit)', 'foundationpress' ), '<span class="edit-link">', '</span>' ); ?>
	</div>
	<footer>
		<?php
			wp_link_pages(
				array(
					'before' => '<nav id="page-nav"><p>' . __( 'Pages:', 'foundationpress' ),
					'after'  => '</p></nav>',
				)
			);
		?>
		<?php $tag = get_the_tags(); if ( $tag ) { ?><p><?php the_tags(); ?></p><?php } ?>
	</footer>
</article>
