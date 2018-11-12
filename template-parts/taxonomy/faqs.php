<?php
  $term        = get_queried_object();
  $array       = (explode("_",$term->taxonomy));
  $parent_cat  = $array[0];
	$parent_term = get_term_by( 'slug', $parent_cat, 'faq_taxonomies', 'OBJECT', 'raw' );
	$args = array(
		'parent' => $parent_term->term_id,
		'orderby' => 'slug',
		'hide_empty' => false
	 );
	$child_terms = get_terms( 'faq_taxonomies', $args );
  
	foreach ($child_terms as $child) {
		if (strpos($child->slug, "-") !== false) {
		  $child_slug_array = explode("-", $child->slug);
			if (in_array("commercial",$child_slug_array,true) || in_array("residential",$child_slug_array,true) || in_array("automotive",$child_slug_array,true)) {
				$child_slug = $child_slug_array[0];
			}else{
			  $child_slug = $child->slug;
			}
		}else{
		  $child_slug = $child->slug;
		}
		if ($child_slug == $term->slug) {
			$child_cat_id = $child->term_id;
		}
	}
	// If child_cat_id doesn't exist, cat is safety-security
	if (!$child_cat_id) {
		$child_cat_id = 334;
	}
?>

<section class="taxonomy-faqs">
	<div class="grid-container">
		<div class="grid-x">
			<div class="small-10 large-8 small-offset-1 large-offset-2 text-center">
				<h2 class="blue"><?php the_field('taxonomy_faq_heading',$term); ?></h2>
				<aside class="yellow-underline center"></aside>
				<p class="subhead"><?php the_field('taxonomy_faq_subhead',$term); ?></p>
			</div>
		</div>
		<div class="grid-x">
			<div class="small-10 small-offset-1 cell">
			  <div class="grid-x grid-margin-x grid-margin-y">

			  	<taxonomy-faqs term-id="<?php echo $child_cat_id; ?>">

			  <!-- Query custom post type 'faq' filtered by taxonomy faq_taxonomies -->
				<?php
					// $args = array(
					// 	'post_type' => 'faq',
					// 	'tax_query' => array(
					// 		array(
					// 			'taxonomy' => 'faq_taxonomies',
					// 			'field'    => 'term_id',
					// 			'terms'    => $child_cat_id,
					// 		),
					// 	),
					// );
					// $query = new WP_Query( $args );
					// while ( $query->have_posts() ) : $query->the_post();
				?>
				
				<!-- <div class="medium-6 cell">
					<h5><?php //the_title(); ?></h5>
					<?php //the_content(); ?>
				</div> -->
				
				<?php //endwhile; wp_reset_postdata(); ?>
					
				</div>
			</div>
		</div>
	</div>
</section>