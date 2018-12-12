<?php
/**
 * The default template for displaying page content
 *
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
		</div>
	</div>

<?php if ( is_front_page() ) { ?>
	<div class="entry-content" style="margin-bottom:6%;">
	<?php // Check to see if user is LOGGED IN to show available downloads
    if ( is_user_logged_in() ) { ?>
        <p class="breadcrumb-trail">Home &raquo;</p>
        <div class="grid-x grid-padding-x small-up-2 medium-up-4 large-up-6 term-sibling-list">
        <?php
        $args = array(
            'taxonomy' => 'dlm_download_category',
            //'orderby' => 'parent',
            'orderby' => 'name',
            'hide_empty' => false,
            'parent' => 0
        );
        $categories = get_categories( $args );
        foreach ( $categories as $category ) {
            echo '<div class="cell term-sibling"><a href="' . get_category_link( $category->term_id ) . '"><i class="fa fa-folder" aria-hidden="true"></i><br><p>' . $category->name . '</p></a></div>';
        }
        ?>
        </div>
	<?php } else { ?>
	    <p class="breadcrumb-trail">To view all available downloads, please <a href="<?php echo site_url(); ?>/wp-login.php" title="Members Area Login" rel="home">log in now</a>!</p>
	<?php } ?>
	</div>

<?php } ?>

	<div class="brand-entry-content">
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