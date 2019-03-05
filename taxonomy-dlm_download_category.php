<?php
/**
 * Custom Taxonomy page for Download Monitor Plugin on Madico Brand Hub Site
 *
 */
$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); 
$exclude = '';
$shortcode_exclude = '';

// START CUSTOM RESTRICTIONS 
// Based on Current User abilities via User Roles (as defined by Members Plugin)
// TODO: Create a "CUSTOM RESTRICTIONS" ACF REPEATER entry for "User Can" and "Tax Slug", and convert the LIST below to a looped function! 
if ( current_user_can( 'view_international' ) ) {
	$warranty_omit = get_term_by( 'slug', 'mmm-warranties', 'dlm_download_category' );
	$exclude = $warranty_omit->term_id; //This CAN be a comma-seperated list of MULTIPLE VALUES
	$shortcode_exclude = " exclude='" . $warranty_omit->term_id . "' ";
}
if ( current_user_can( 'view_protectionpro' ) ) {
	// Add code for term restriction here
}
if ( current_user_can( 'view_protectionpro_sales' ) ) {
	// Add code for term restriction here
}
if ( current_user_can( 'view_safetyshield' ) ) {
	// Add code for term restriction here
}
if ( current_user_can( 'view_sunscape' ) ) {
	// Add code for term restriction here
}
// END CUSTOM RESTRICTIONS

$hero_path = get_template_directory_uri().'/dist/assets/images/Brand-Hub-Page-Header.jpg';
$headline = "Madico Brand Hub";
$subhead = "Below you will be able to access everything from technical specs to marketing materials, relevant to you as a Madico dealer and to the products you purchase from Madico. Simply click on a top level folder to navigate and click on an individual file within to easily download it to your device.";
get_header();
?>
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
		<main class="grid-x grid-margin-y">
			<div <?php post_class('small-12'); ?>>

				<div class="grid-x">
					<div class="small-12 cell text-center">
						<h1 class="blue"><?php echo $headline; ?></h1>
						<aside class="yellow-underline center"></aside>
					</div>
					<div class="small-10 small-offset-1 cell text-center">
						<p><?php echo $subhead; ?></p>
					</div>
				</div>

				<div class="brand-entry-content">
			<?php // Check to see if user is LOGGED IN to show available downloads
		    if ( is_user_logged_in() ) { ?>

				<?php
				if ( ( is_tax() || is_category() || is_tag() ) ) {
				    $trail     = '';
				    $home      = '<a href="' . get_home_url() . '">Home</a>';
				    $query_obj = get_queried_object();
				    $crumb_term_id   = $query_obj->term_id;
				    $crumb_taxonomy  = get_taxonomy( $query_obj->taxonomy );
				 
				    if ( $crumb_term_id && $crumb_taxonomy ) {
				        $trail .= '&nbsp;&nbsp;&raquo;&nbsp;&nbsp;' . get_term_parents_list( $crumb_term_id, $crumb_taxonomy->name, array( 'inclusive' => false, 'separator' => '&nbsp;&nbsp;&raquo;&nbsp;&nbsp;' ) );
				    }
				    // Print trail and add current term name at the end.
				    echo '<p class="breadcrumb-trail">' . $home . $trail . $query_obj->name . '&nbsp;&nbsp;<i class="fa fa-folder-open" aria-hidden="true"></i></p>';

				    // Modified $ARGS Array to include EXCLUSIONS as defined above
					$term_children = get_terms( array('parent' => $term->term_id, 'hide_empty' => 1, 'taxonomy' => $term->taxonomy, 'exclude' => $exclude ) );

					if (!empty($term_children)) {
						echo '<div class="grid-x grid-padding-x small-up-2 medium-up-4 large-up-6 term-sibling-list">';
						foreach ( $term_children as $child ) {
							echo '<div class="cell term-sibling"><a href="' . get_term_link( $child, $term->taxonomy ) . '"><i class="fa fa-folder" aria-hidden="true"></i><p>' . $child->name . '</p></a></div>';
						}
						$shortcode = "[downloads " . $shortcode_exclude . " category='$term->slug' category_include_children='false' template='brandhub' loop_start='' loop_end='' before='<div class=&quot;cell term-sibling&quot;>' after='</div>' ]";
						echo do_shortcode( $shortcode );
						echo '</div>';
					} else {
						$shortcode = "[downloads " . $shortcode_exclude . " category='$term->slug' category_include_children='false' template='brandhub' loop_start='<div class=&quot;grid-x grid-padding-x small-up-2 medium-up-4 large-up-6 term-sibling-list&quot;>' loop_end='</div>' before='<div class=&quot;cell term-sibling&quot;>' after='</div>' ]";
						echo do_shortcode( $shortcode );
					}
				}
				?>

			<?php } else { ?>
			    <p class="breadcrumb-trail">To view all available downloads, please <a href="<?php echo site_url(); ?>/wp-login.php" title="Members Area Login" rel="home">log in now</a>!</p>
			<?php } ?>
				</div>
			</div>
		</main>
	</div>
</section>

<?php get_footer();
