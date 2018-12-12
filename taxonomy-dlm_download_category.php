<?php
/**
 * Custom Taxonomy page for Download Monitor Plugin on Madico Brand Hub Site
 *
 */
$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); 

$headline = "Madico Brand Hub";
$subhead = "Below you will be able to access everything from technical specs to marketing materials, relevant to you as a Madico dealer and to the products you purchase from Madico. Simply click on a top level folder to navigate and click on an individual file within to easily download it to your device.";

/*the_post_thumbnail_url( 'full' );*/
/*if ( the_post_thumbnail_url( 'full' ) != 'false' ) {
	$hero_path = the_post_thumbnail_url( 'full' ); 
} else {*/
$hero_path = get_template_directory_uri().'/dist/assets/images/Brand-Hub-Page-Header.jpg';
/*}*/

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
				<?php //if (function_exists('wordpress_tax_breadcrumbs')) wordpress_tax_breadcrumbs(); ?>

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

					$term_children = get_terms( array('parent' => $term->term_id, 'hide_empty' => 0, 'taxonomy' => $term->taxonomy) );

					if (!empty($term_children)) {
						echo '<div class="grid-x grid-padding-x small-up-2 medium-up-4 large-up-6 term-sibling-list">';
						foreach ( $term_children as $child ) {
							echo '<div class="cell term-sibling"><a href="' . get_term_link( $child, $term->taxonomy ) . '"><i class="fa fa-folder" aria-hidden="true"></i><p>' . $child->name . '</p></a></div>';
						}
						$shortcode = "[downloads category='$term->slug' category_include_children='false' template='brandhub' loop_start='' loop_end='' before='<div class=&quot;cell term-sibling&quot;>' after='</div>' ]";
						echo do_shortcode( $shortcode );
						echo '</div>';
					} else {
						$shortcode = "[downloads category='$term->slug' category_include_children='false' template='brandhub' loop_start='<div class=&quot;grid-x grid-padding-x small-up-2 medium-up-4 large-up-6 term-sibling-list&quot;>' loop_end='</div>' before='<div class=&quot;cell term-sibling&quot;>' after='</div>' ]";
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

<section class="page-content" style="display:none;">
	<div class="grid-container">
		<main class="grid-x grid-margin-y">
			<div <?php post_class('small-12'); ?>>
				<div class="brand-entry-content">

				<?php // PRIMARY BLOCK TO RENDER ALL DOWNLOADS
				$shortcode = "[downloads category='$term->slug' category_include_children='false' template='brandhub' loop_start='<div class=&quot;grid-x grid-padding-x small-up-2 medium-up-4 large-up-6 term-sibling-list&quot;>' loop_end='</div>' before='<div class=&quot;cell term-sibling&quot;>' after='</div>' ]";
				echo '<p class="breadcrumb-trail"> Current Folder - ' . single_term_title( '', false ) . '</p>';
				echo do_shortcode( $shortcode );
				?>

				</div>
			</div>
		</main>
	</div>
</section>

<?php get_footer();
