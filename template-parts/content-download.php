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
				
				<h5>List of CATS from DLM post type</h5>
				<?php 
				$new_cats = get_categories( array(
					'taxonomy' => 'dlm_download_category',
					'orderby' => 'parent',
					'hierarchical' => true,
					'parent'  => 0
				) ); 
				echo "<ul class='get-cat-list'>";
				foreach ( $new_cats as $single_cat ) {
				    printf( '<li><a href="%1$s" class="cat-folder"><i class="fa fa-folder" aria-hidden="true"></i>%2$s</a></li>',
				        //esc_url( '/downloads/'. $single_cat->category_nicename /*get_category_link( $single_cat->term_id )*/ ),
				    	esc_url( site_url('/downloads/'. $single_cat->category_nicename) ),
				        esc_html( $single_cat->name )
				    );
				}
				echo "</ul>";
				?>

				<h5>wp_list_categories method for DLM post type</h5>

				<?php
				$taxonomy     = 'dlm_download_category';
				$orderby      = 'name'; 
				$show_count   = false;
				$pad_counts   = false;
				$hierarchical = true;
				$title        = '';
				$args = array(
				  'taxonomy'     => $taxonomy,
				  'orderby'      => $orderby,
				  'show_count'   => $show_count,
				  'pad_counts'   => $pad_counts,
				  'hierarchical' => $hierarchical,
				  'title_li'     => $title
				);
				//echo "<ul class='wp-list-cat-list'>";
				//wp_list_categories( $args );
				//echo "</ul>";

				//echo do_shortcode("[list]");
				?>

				<?php
				$args = array(
				  'taxonomy'     => 'dlm_download_category',
				  'orderby'      => 'name',
				  'show_count'   => false,
				  'pad_counts'   => false,
				  'hierarchical' => true,
				  'parent'       => 0,
				  'title_li'     => ''
				);
				//echo "<ul class='wp-list-cat-list'>";
				//wp_list_categories( $args );
				//echo "</ul>";

				?>


			<h5>get_categories method for DLM post type!! This is the ONE</h5>

				<ul class="list-items categories term-sibling-list">
				<?php
				$args = array(
					'taxonomy' => 'dlm_download_category',
					'hide_empty' => false,
					'parent' => 0
				);
				$categories = get_categories( $args );
				foreach ( $categories as $category ) {
					echo '<li class="term-sibling"><a href="' . get_category_link( $category->term_id ) . '"><i class="fa fa-folder" aria-hidden="true"></i> ' . $category->name . '</a></li>';
				}
				?>
				</ul>





				<h5>wp_list_categories method for DLM post type using custom walker</h5>

				<?php
	            $args = array(
                    'show_option_all' => '',
                    'show_option_none'   => __('No categories'),
                    'orderby'         => 'name',
                    'order'           => 'ASC',
                    'show_last_update'   => 0,
                    'style'           => 'list', // Output in the front-end as the elements of a list <li></li>
                    'show_count'      => 0,
                    'hide_empty'      => 0,
                    'use_desc_for_title' => 1,
                    'child_of'        => 0,
                    'feed'            => '',
                    'feed_type'       => '',
                    'feed_image'         => '',
                    //'exclude'         => '18',
                    'exclude_tree'    => '',
                    'include'         => '',
                    //'hierarchical'    => true,
                    'hierarchical'    => true,
                    'title_li'        => '',
                    'number'          => NULL,
                    'echo'            => 1,
                    'depth'           => 0,
                    'current_category'   => 0,
                    'pad_counts'      => 0,
                    'taxonomy'        => 'dlm_download_category',
                    'walker'          => 'Walker_Category',
                    'hide_title_if_empty' => false,
                    'separator'       => '<br />',
	            );
	            echo '<ul class="walker-category-list">';
	                            wp_list_categories( $args );          
	            echo '</ul>';
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
