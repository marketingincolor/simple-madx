<?php
/**
 * The default template for displaying page content
 *
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */
$key_term_id_one = get_term_by( 'name', 'sunscape', 'dlm_download_category' );
$sctermid = $key_term_id_one->term_id; // should be 4
$key_term_id_two = get_term_by( 'name', 'safetyshield', 'dlm_download_category' );
$sstermid = $key_term_id_two->term_id; // should be 3
$exclude = '';
if ( !current_user_can( 'view_sunscape' ) ) {
	$exclude = $sctermid;
} if ( !current_user_can( 'view_safetyshield' ) ) {
	$exclude = $sstermid;
} if ( !current_user_can( 'view_sunscape' ) && !current_user_can( 'view_safetyshield' ) ) {
	$exclude = array($sctermid, $sstermid);
}
if ( is_user_logged_in() ) { 
	$headline = "Madico Brand Hub";
	$subhead = "Below you will be able to access everything from technical specs to marketing materials, relevant to you as a Madico dealer and to the products you purchase from Madico. Simply click on a top level folder to navigate and click on an individual file within to easily download it to your device.";
} else {
	$headline = get_the_title();
	//$subhead = get_the_content();
	$subhead = "This is your one-stop location for all files and downloads that have been made available to you as an Authorized Madico Dealer.";
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('small-12'); ?>>
	<div class="grid-x">
		<div class="small-12 cell text-center">
			<h1 class="blue"><?php echo $headline;//the_title(); ?></h1>
			<aside class="yellow-underline center"></aside>
		</div>
		<div class="small-10 small-offset-1 cell text-center">
			<p><?php echo $subhead;//the_content(); ?></p>
		</div>
	</div>

<?php if ( is_front_page() ) { ?>
	<div class="brand-entry-content">

		<?php if ( is_user_logged_in() ) { ?>

	        <p class="breadcrumb-trail">Home&nbsp;&nbsp;&raquo;</p>
	        <div class="grid-x grid-padding-x small-up-2 medium-up-4 large-up-6 term-sibling-list">
	        <?php
	        $args = array(
	            'taxonomy' => 'dlm_download_category',
	            //'orderby' => 'parent',
	            'orderby' => 'name',
	        	'exclude' => $exclude,
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
		    <p class="breadcrumb-trail" style="text-align:center;"><a href="<?php echo site_url(); ?>/wp-login.php" title="Members Area Login" rel="home" class="orange-button">LOG IN NOW</a></p>
		<?php } ?>

	</div>
<?php } else { ?>

<div class="brand-entry-content">
	<?php the_content(); ?>
	<?php edit_post_link( __( '(Edit)', 'foundationpress' ), '<span class="edit-link">', '</span>' ); ?>
</div>

<?php } ?>

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
