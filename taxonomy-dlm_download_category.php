<?php
$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); 
get_header();
?>

<section class="page-content">
	<div class="grid-container">
		<main class="grid-x grid-margin-y">
			<div <?php post_class('small-10 small-offset-1 large-8 large-offset-2'); ?>>

				<div class="grid-x">
					<div class="small-12 cell text-center">
						<h1 class="blue">Downloads</h1>
						<aside class="yellow-underline center"></aside>
					</div>
				</div>

				<div class="entry-content">

				<?php //if (function_exists('wordpress_tax_breadcrumbs')) wordpress_tax_breadcrumbs(); ?>

				<?php
				if ( ( is_tax() || is_category() || is_tag() ) ) {
				    $trail     = '';
				    $home      = '<a href="' . get_home_url() . '">Home</a>';
				    $query_obj = get_queried_object();
				    $crumb_term_id   = $query_obj->term_id;
				    $crumb_taxonomy  = get_taxonomy( $query_obj->taxonomy );
				 
				    if ( $crumb_term_id && $crumb_taxonomy ) {
				        // Add taxonomy label name to the trail.
				        //$trail .=  '/' . $taxonomy->labels->menu_name;
				        // Add term parents to the trail.
				        $trail .= ' &raquo; ' . get_term_parents_list( $crumb_term_id, $crumb_taxonomy->name, array( 'inclusive' => false, 'separator' => ' &raquo; ' ) );
				    }
				 
				    // Print trail and add current term name at the end.
				    echo '<p class="breadcrumb-trail">' . $home . $trail . $query_obj->name . '</p>';


					//$term_children = get_term_children( $term->term_id, $term->taxonomy );
					$term_children = get_terms( array('parent' => $term->term_id, 'hide_empty' => 0, 'taxonomy' => $term->taxonomy) );
					if (!empty($term_children)) {


						//echo '<ul class="term-sibling-list">';
						foreach ( $term_children as $child ) {
							//$sibling_term = get_term_by( 'id', $child, $term->taxonomy );
							//$sibling_term = get_terms( array( 'child_of' => $term->term_id, /*'parent' => $term->parent,*/ 'taxonomy' => $term->taxonomy ) );

							//echo '<li class="term-sibling"><a href="' . get_term_link( $child, $term->taxonomy ) . '"><i class="fa fa-folder" aria-hidden="true"></i>&nbsp;' . $child->name . '</a></li>';
						}
						//echo '</ul>';


						echo '<div class="grid-x grid-padding-x small-up-2 medium-up-4 large-up-6 term-sibling-list">';
						foreach ( $term_children as $child ) {
							echo '<div class="cell term-sibling"><a href="' . get_term_link( $child, $term->taxonomy ) . '"><i class="fa fa-folder" aria-hidden="true"></i><br><p>' . $child->name . '</p></a></div>';
						}
						echo '</div>';


					}

				}
				?>

				</div>
			</div>
		</main>
	</div>
</section>

<section class="page-content">
	<div class="grid-container">
		<main class="grid-x grid-margin-y">
			<div <?php post_class('small-10 small-offset-1 large-8 large-offset-2'); ?>>
				<div class="entry-content">


<?php //echo do_shortcode('[members_access role="editor"]Hide this content from everyone but editors.[/members_access]'); ?>
<?php //echo do_shortcode('[members_access role="subscriber"]Hide this content from everyone but subscribers.[/members_access]'); ?>
<?php //echo do_shortcode('[members_access role="subscriber_safetyshield"]Visible to SAFETYSHIELD subscribers ONLY!![/members_access]'); ?>
<?php //echo do_shortcode('[members_access role="subscriber_sunscape"]Visible to SUNSCAPE subscribers ONLY!![/members_access]'); ?>


				<?php 
				echo '<div class="callout warning" style="font-size:10px; display:none;">Taxonomy / Term VAR data: <br>';
				echo 'id:' . $term->term_id; // will show the name
				echo '<br>';
				echo 'name:' . $term->name; // will show the name
				echo '<br>';
				echo 'slug:' . $term->slug; // will show the name
				echo '<br>';
				echo 'group:' . $term->term_group; // will show the name
				echo '<br>';
				echo 'tax id:' . $term->term_taxonomy_id; // will show the name
				echo '<br>';
				echo 'tax:' . $term->taxonomy; // will show the name
				echo '<br>';
				echo 'description:' . $term->description; // will show the name
				echo '<br>';
				echo 'parent:' . $term->parent; // will show the name
				echo '<br>';
				echo 'count:' . $term->count; // will show the name
				echo '<br></div>';
				?>


<?php 
if ( members_current_user_has_role( 'subscriber_safetyshield' ) || current_user_can( 'manage_options' ) ) {
	//echo ':SAFETYSHIELD USER ROLE:'; 
} elseif ( members_current_user_has_role( 'subscriber_sunscape' ) || current_user_can( 'manage_options' ) ) {
	//echo ':SUNSCAPE USER ROLE:'; 
} else {
	//echo ':WRONG USER ROLE:'; 
} 
?>	

				<?php // PRIMARY BLOCK TO RENDER ALL DOWNLOADS
				echo '<h3> Current Folder - ' . single_term_title( '', false ) . '</h3>';
				echo do_shortcode( "[downloads category='$term->slug' category_include_children='false']" );
				?>

				</div>
			</div>
		</main>
	</div>
</section>


<?php
//$catpage_walker = new Walker_Category_Custom();
//wp_list_categories( array( 'walker'=>$catpage_walker,'orderby'=>'name','hide_empty'=>0 ) );
?>

<?php get_footer();
