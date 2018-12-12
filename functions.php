<?php
/**
 * Author: Ole Fredrik Lie
 * URL: http://olefredrik.com
 *
 * FoundationPress functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

// This enables the orderby=menu_order for Posts
add_filter( 'rest_post_collection_params', 'filter_add_rest_orderby_params', 10, 1 );
// And this for a custom post type called 'portfolio'
add_filter( 'rest_portfolio_collection_params', 'filter_add_rest_orderby_params', 10, 1 );
/**
 * Add menu_order to the list of permitted orderby values
 */
function filter_add_rest_orderby_params( $params ) {
  $params['orderby']['enum'][] = 'menu_order';
  return $params;
}

function list_distributors($country_array){
	$count = 0;
  foreach ($country_array as $country) {
  	$count++;
		$dist_company  = get_post_meta($country->ID,'company_name',true);
		$dist_street   = get_post_meta($country->ID,'street',true);
		$dist_zip      = get_post_meta($country->ID,'zip',true);
		$dist_city     = get_post_meta($country->ID,'city',true);
		$dist_state    = get_post_meta($country->ID,'state',true);
		$dist_phone    = get_post_meta($country->ID,'phone_number',true);
		$dist_altphone = get_post_meta($country->ID,'alt_phone_number',true);
		$dist_fax      = get_post_meta($country->ID,'fax',true);
		$dist_email    = get_post_meta($country->ID,'email',true);
		$dist_website  = get_post_meta($country->ID,'website',true);
		$dist_markets  = get_post_meta($country->ID,'markets',true);
		$dist_name     = $country->post_title;
		$comp_name     = get_post_meta($country->ID,'compnay_name',true);
		$website_nohttp = preg_replace('/(http:\/\/|https:\/\/|www.)/', '', $dist_website);

		echo "<div class='medium-6 large-3 cell module auto-height'>";
  	echo "<h5 class='blue'>{$dist_name}</h5>";
  	echo "<ul class='dealer-meta'>";
  	echo "<li><address><i class='fas fa-map-marker-alt'></i> &nbsp;";
  	if($dist_company) {
  		echo "{$dist_company}<br>";
  	}
  	if($dist_street) {
  	  echo "{$dist_street}<br> {$dist_city}, {$dist_state} {$dist_zip}</address></li>";
    }
  	if($dist_phone) {
  		echo "<li><address><i class='fas fa-phone'></i> &nbsp;{$dist_phone}";
	  	if($dist_altphone) {
	  		echo "<br>{$dist_altphone}";
	  	}
  		echo "</address></li>";
  	}
  	if($dist_fax) {
  		echo "<li><address><i class='fas fa-fax'></i> &nbsp;{$dist_fax}</address></li>";
  	}
		if($dist_email) {
		  echo "<li class='email'><address><i class='fas fa-envelope'></i> &nbsp;{$dist_email}</address></li>";
		}
		if($dist_website) {
		  echo "<li class='email website'><address><i class='fas fa-globe'></i> &nbsp;<a href='{$dist_website}' target='_blank'>{$website_nohttp}</a></address></li>";
		}
  	echo "</ul>";
		if($dist_markets) {
		  echo "<a href='#!' class='info-icon' v-tooltip tabindex='{$count}' title='{$dist_markets}'><i class='fal fa-info-circle'></i></a>";
	  }
	  echo "</div>";
	}
}

// Fix pagination 404 errors on blog category pages
function bamboo_request($query_string ){
  	if( isset( $query_string['page'] ) ) {
  	  if( ''!=$query_string['page'] ) {
  	    if( isset( $query_string['name'] ) ) {
  	        unset( $query_string['name'] );
  	    }
  	  }
  	}
  	return $query_string;
}
add_filter('request', 'bamboo_request');

add_action('pre_get_posts','bamboo_pre_get_posts');
function bamboo_pre_get_posts( $query ) {
	// Only for pagination on category pages
  if (is_category()) {
   	if( $query->is_main_query() && !$query->is_feed() && !is_admin() ) { 
   	  $query->set( 'paged', str_replace( '/', '', get_query_var( 'page' ) ) ); 
   	}
  } 
}

/** Various URL rewrite functions to add taxonomies to url */
require_once( 'library/url-rewrites.php' );

/** Various clean up functions */
require_once( 'library/cleanup.php' );

/** Required for Foundation to work properly */
require_once( 'library/foundation.php' );

/** Format comments */
require_once( 'library/class-foundationpress-comments.php' );

/** Register all navigation menus */
require_once( 'library/navigation.php' );

/** Add menu walkers for top-bar and off-canvas */
require_once( 'library/class-foundationpress-top-bar-walker.php' );
require_once( 'library/class-foundationpress-mobile-walker.php' );

/** Create widget areas in sidebar and footer */
require_once( 'library/widget-areas.php' );

/** Return entry meta information for posts */
require_once( 'library/entry-meta.php' );

/** Enqueue scripts */
require_once( 'library/enqueue-scripts.php' );

/** Add theme support */
require_once( 'library/theme-support.php' );

/** Add Nav Options to Customer */
require_once( 'library/custom-nav.php' );

/** Change WP's sticky post class */
require_once( 'library/sticky-posts.php' );

/** Configure responsive image sizes */
require_once( 'library/responsive-images.php' );

/** Add custom shortcodes */
require_once( 'library/shortcodes.php' );

/** If your site requires protocol relative url's for theme assets, uncomment the line below */
// require_once( 'library/class-foundationpress-protocol-relative-theme-assets.php' );


//////////////////////////////////////////////////////////
// ADDITIONAL FUNCTIONS FOR MINIMAL THEME CUSTOMIZATION //
//////////////////////////////////////////////////////////

// Add breadcrumbs to page via PHP embed: if (function_exists('wordpress_breadcrumbs')) wordpress_breadcrumbs();
function wordpress_breadcrumbs() {
  $delimiter = '&raquo;';
  $name = 'Home'; //text for the 'Home' link
  $currentBefore = '<span class="current">';
  $currentAfter = '</span>';
  if ( !is_home() && !is_front_page() || is_paged() ) {
    echo '<div id="crumbs">';
    global $post;
    $home = get_bloginfo('url');
    echo '<a href="' . $home . '">' . $name . '</a> ' . $delimiter . ' ';
    if ( is_category() ) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
      echo $currentBefore . 'Archive by category &#39;';
      single_cat_title();
      echo '&#39;' . $currentAfter;
    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo $currentBefore . get_the_time('d') . $currentAfter;
    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo $currentBefore . get_the_time('F') . $currentAfter;
    } elseif ( is_year() ) {
      echo $currentBefore . get_the_time('Y') . $currentAfter;
    } elseif ( is_single() ) {
      $cat = get_the_category(); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo $currentBefore;
      the_title();
      echo $currentAfter;
    } elseif ( is_page() && !$post->post_parent ) {
      echo $currentBefore;
      the_title();
      echo $currentAfter;
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
      echo $currentBefore;
      the_title();
      echo $currentAfter;
    } elseif ( is_search() ) {
      echo $currentBefore . 'Search results for &#39;' . get_search_query() . '&#39;' . $currentAfter;
    } elseif ( is_tag() ) {
      echo $currentBefore . 'Posts tagged &#39;';
      single_tag_title();
      echo '&#39;' . $currentAfter;
    } elseif ( is_author() ) {
      global $author;
      $userdata = get_userdata($author);
      echo $currentBefore . 'Articles posted by ' . $userdata->display_name . $currentAfter;
    } elseif ( is_404() ) {
      echo $currentBefore . 'Error 404' . $currentAfter;
    }
    if ( get_query_var('paged') ) {
    if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page') . ' ' . get_query_var('paged');
    if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
    echo '</div>';
  }
}






///////////////////////////////////////////////////////////////////////////////
// THIS IS ONLY TEMPORARY FOR SPECIFIC TESTING - MAY NOT END UP GETTING USED //
///////////////////////////////////////////////////////////////////////////////

// Add breadcrumbs to page via PHP embed: if (function_exists('wordpress_tax_breadcrumbs')) wordpress_tax_breadcrumbs();
function wordpress_tax_breadcrumbs() {
  $delimiter = '&nbsp;&nbsp;&raquo;&nbsp;&nbsp;';
  $name = 'Home'; //text for the 'Home' link
  $currentBefore = '<span class="current">';
  $currentAfter = '</span>';
  if ( !is_home() && !is_front_page() || is_paged() ) {
    echo '<div id="crumbs">';
    global $post;
    $home = get_bloginfo('url');
    echo '<a href="' . $home . '">' . $name . '</a> ' . $delimiter . ' ';
    if ( is_category() ) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
      echo $currentBefore . 'Archive by category &#39;';
      single_cat_title();
      echo '&#39;' . $currentAfter;
    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo $currentBefore . get_the_time('d') . $currentAfter;
    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo $currentBefore . get_the_time('F') . $currentAfter;
    } elseif ( is_year() ) {
      echo $currentBefore . get_the_time('Y') . $currentAfter;
    } elseif ( is_single() ) {
      $cat = get_the_category(); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo $currentBefore;
      the_title();
      echo $currentAfter;
    } elseif ( is_page() && !$post->post_parent ) {
      echo $currentBefore;
      the_title();
      echo $currentAfter;
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
      echo $currentBefore;
      the_title();
      echo $currentAfter;
    } elseif ( is_search() ) {
      echo $currentBefore . 'Search results for &#39;' . get_search_query() . '&#39;' . $currentAfter;
    } elseif ( is_tag() ) {
      echo $currentBefore . 'Posts tagged &#39;';
      single_tag_title();
      echo '&#39;' . $currentAfter;
    } elseif ( is_author() ) {
      global $author;
      $userdata = get_userdata($author);
      echo $currentBefore . 'Articles posted by ' . $userdata->display_name . $currentAfter;
    } elseif ( is_404() ) {
      echo $currentBefore . 'Error 404' . $currentAfter;
    } 



    elseif ( is_tax() ) {
      global $wp_query;
      $lvl_1 = '';
      $lvl_2 = '';
      $lvl_3 = '';
      $lvl_4 = '';
      $lvl_5 = '';
      $tax_obj = $wp_query->get_queried_object();
      $useTerm = $tax_obj->term_id;
      $useTax = 'dlm_download_category';
      $taxTerm = get_term($useTerm, $useTax);
      $ttp_lvl_1_id = $taxTerm->parent;
      $ttp_lvl_1_term = get_term($ttp_lvl_1_id, $useTax);
      $lvl_1 = isset($ttp_lvl_1_term->name) ? '<a href="?dlm_download_category='.$ttp_lvl_1_term->slug.' ">'.$ttp_lvl_1_term->name.'</a>&nbsp;&nbsp;&raquo;&nbsp;&nbsp;' : '';

      $ttp_lvl_2_id = $ttp_lvl_1_term->parent;
      $ttp_lvl_2_term = get_term($ttp_lvl_2_id, $useTax);
      $lvl_2 = isset($ttp_lvl_2_term->name) ? '<a href="?dlm_download_category='.$ttp_lvl_2_term->slug.' ">'.$ttp_lvl_2_term->name.'</a>&nbsp;&nbsp;&raquo;&nbsp;&nbsp;' : '';

      $ttp_lvl_3_id = $ttp_lvl_2_term->parent;
      $ttp_lvl_3_term = get_term($ttp_lvl_3_id, $useTax);
      $lvl_3 = isset($ttp_lvl_3_term->name) ? '<a href="?dlm_download_category='.$ttp_lvl_3_term->slug.' ">'.$ttp_lvl_3_term->name.'</a>&nbsp;&nbsp;&raquo;&nbsp;&nbsp;' : '';

      echo $currentBefore . $lvl_5 . $lvl_4 . $lvl_3 . $lvl_2 . $lvl_1 . $taxTerm->name . $currentAfter;

    }



    if ( get_query_var('paged') ) {
    if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page') . ' ' . get_query_var('paged');
    if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
    echo '</div>';
  }
}








//////////////////////////
// CUSTOM WALKER TEST 1 //
//////////////////////////

class My_Custom_Walker extends Walker
{
   public $tree_type = 'category';
   public $db_fields = array ('parent' => 'parent', 'id' => 'term_id');
   public $max_pages = 10;
   public function start_lvl( &$output, $depth = 0, $args = array() ) {
      $output .= "<ul class='children'>\n";
   }
   public function end_lvl( &$output, $depth = 0, $args = array() ) {
      $output .= "</ul>\n";
   }
   public function start_el( &$output, $category, $depth = 0, $args = array(), $current_object_id = 0 ) {
      $output .= "<li>" . $category->name . "\n";
   }
   public function end_el( &$output, $category, $depth = 0, $args = array() ) {
      $output .= "</li>\n";
   }
}
function my_init() {
   add_shortcode( 'categorylist', 'my_list' );
}
add_action('init', 'my_init');

function my_list( $atts ){
   $list = wp_list_categories( array( 'echo' => 0, 'walker' => new My_Custom_Walker() ) );
   return $list;
}




//////////////////////////
// CUSTOM WALKER TEST 2 //
//////////////////////////

class Walker_Category_Custom extends Walker_Category {
  function start_lvl(&$output, $depth=0, $args=array()) {
    $output .= " <ul> ";
  }
  function end_lvl(&$output, $depth=0, $args=array()) {
    $output .= " </ul> ";
  }
  function start_el(&$output, $item, $depth=0, $args=array(),$current_object_id = 0) {
    $output.= '<li><a href="'.home_url('category/'.$item->slug).' "><img src="http://some_path_here/images/'.($item->slug).'.jpg">'.esc_attr($item->name);
    //in this case you should create images with names of category slugs
  }
  function end_el(&$output, $item, $depth=0, $args=array()) {
    $output .= "</a></li>";
  }
}


////////////////////////////////////
// SHOW ADMIN BAR ONLY FOR ADMINS //
////////////////////////////////////
if (!current_user_can('manage_options')) {
  add_filter('show_admin_bar', '__return_false');
}

/////////////////////////////////////////
// REDIRECT USER TO HOME PAGE ON LOGIN //
/////////////////////////////////////////
function brandhub_login_redirect( $url, $request, $user ){
    if( $user && is_object( $user ) && is_a( $user, 'WP_User' ) ) {
        if( $user->has_cap( 'administrator' ) ) {
            $url = admin_url();
        } else {
            $url = home_url();
        }
    }
    return $url;
}
add_filter('login_redirect', 'brandhub_login_redirect', 10, 3 );


////////////////////////////////
// REGISTER CUSTOM QUERY VARS //
////////////////////////////////
