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

<article id="post-<?php the_ID(); ?>" <?php post_class('small-10 small-offset-1 large-8 large-offset-2'); ?>>
	<div class="grid-x">
		<div class="small-12 cell text-center">
			<h1 class="blue"><?php the_title(); ?></h1>
			<aside class="yellow-underline center"></aside>
			<div class="subhead">
				<?php 
				$new_cats = get_categories( array(
					'taxonomy' => 'dlm_download_category',
					'orderby' => 'name',
					'parent'  => 0
				) ); 
				foreach ( $new_cats as $single_cat ) {
				    printf( '<li><a href="%1$s" class="cat-folder"><i class="fa fa-folder" aria-hidden="true"></i>%2$s</a></li>',
				        //esc_url( '/downloads/'. $single_cat->category_nicename /*get_category_link( $single_cat->term_id )*/ ),
				    	esc_url( site_url('/downloads/'. $single_cat->category_nicename) ),
				        esc_html( $single_cat->name )
				    );
				}
				?>

			</div>
		</div>
	</div>

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
