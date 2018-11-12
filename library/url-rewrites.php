<?php
	// Change post url of custom post types to add custom taxonomies to url
	function custom_post_link( $post_link, $id = 0 ){
	  $current_post      = get_post();
	  $current_post_type = $current_post->post_type;
	  $terms             = wp_get_object_terms( get_the_ID(), $current_post_type.'_taxonomies');
	  $term_array        = array();

	if (!array_key_exists('errors', $terms)) {
	  if (count($terms > 2)) {
	  	// If post has three taxonomies
	  	foreach ($terms as $term) {
	  		if ($term->parent == 0) {
	  			$parent_tax_id = $term->term_id;
	  			array_unshift($term_array, $term->slug);
	  		}
	  	}

	  	foreach ($terms as $term) {
	  		if ($term->parent != 0) {
	  			if ($term->parent == $parent_tax_id) {
	  				array_push($term_array, $term->slug);
	  			}else{
	  				$last_child = $term->slug;
	  			}
	  		}
	  	}
	  	array_push($term_array, $last_child);
	  }else{
	  	// If post has 2 or less taxonomies
	  	foreach ($terms as $term) {
	  		if ($term->parent == 0) {
	  			array_unshift($term_array, strtolower($term->slug));
	  		}else{
	  			array_push($term_array, strtolower($term->slug));
	  		}
	  	}

	  }
	}
	  $tax_url = join('/',$term_array);
	  // Remove the trailing '/' from $tax_url
	  $tax_url = substr($tax_url, 0, -1);

	  // Replace slug with current taxonomies
	  if( count($term_array) > 0 ){
	    return str_replace( '%'.$current_post_type.'_taxonomies%' , $tax_url , $post_link );
	  }else{
	  	return str_replace( '%'.$current_post_type.'_taxonomies%' , '' , $post_link );
	  }

	  return $post_link;  
	}
	add_filter( 'post_type_link', 'custom_post_link', 1, 3 );
   
	// rewrite url structure to add taxonomies to url
	add_filter('rewrite_rules_array', 'mmp_rewrite_rules');
	function mmp_rewrite_rules($rules) {
	    $newRules  = array();
	    $newRules['commercial/(.+)/(.+)/(.+)/?$'] = 'index.php?commercial=$matches[3]';
	    $newRules['commercial/(.+)/(.+)/?$'] = 'index.php?commercial_taxonomies=$matches[2]';

	    $newRules['residential/(.+)/(.+)/(.+)/?$'] = 'index.php?residential=$matches[3]';
	    $newRules['residential/(.+)/(.+)/?$'] = 'index.php?residential_taxonomies=$matches[2]';

	    $newRules['specialty-solutions/(.+)/(.+)/(.+)/(.+)/?$'] = 'index.php?specialty=$matches[4]';
	    $newRules['specialty-solutions/(.+)/(.+)/?$'] = 'index.php?specialty_taxonomies=$matches[2]';

	    $newRules['automotive/(.+)/(.+)/?$'] = 'index.php?automotive=$matches[2]';
	    $newRules['automotive/(.+)/?$'] = 'index.php?automotive_taxonomies=$matches[1]';

	    $newRules['safety-security/(.+)/(.+)/?$'] = 'index.php?safety=$matches[2]';
	    $newRules['safety-security/(.+)/?$'] = 'index.php?safety_taxonomies=$matches[1]'; 

	    return array_merge($newRules, $rules);
	}

	// Filter request to allow for variable amount of taxonomies in 
	// residential custom post url
	function wpd_residential_request_filter( $request ){
	    if( array_key_exists( 'residential_taxonomies' , $request )
	        && ! get_term_by( 'slug', $request['residential_taxonomies'], 'residential_taxonomies' ) ){
	            $request['residential'] = $request['residential_taxonomies'];
	            $request['name'] = $request['residential_taxonomies'];
	            $request['post_type'] = 'residential';
	            unset( $request['residential_taxonomies'] );
	    }
	    return $request;
	}
	add_filter( 'request', 'wpd_residential_request_filter' );

	// Filter request to allow for variable amount of taxonomies in 
	// specialty custom post url
	function wpd_specialty_request_filter( $request ){
	    if( array_key_exists( 'specialty_taxonomies' , $request )
	        && ! get_term_by( 'slug', $request['specialty_taxonomies'], 'specialty_taxonomies' ) ){
	            $request['specialty'] = $request['specialty_taxonomies'];
	            $request['name'] = $request['specialty_taxonomies'];
	            $request['post_type'] = 'specialty';
	            unset( $request['specialty_taxonomies'] );
	    }
	    return $request;
	}
	add_filter( 'request', 'wpd_specialty_request_filter' );

	// Uncomment to see full request on page for debugging purposes

	// function filter_parse_request( $array ) {
	//     var_dump($array); 
	// }; 
	// add_filter( 'parse_request', 'filter_parse_request', 10, 1 );


  // Allow child pages to use same slug as custom post type
	add_filter( 'page_rewrite_rules', 'wpse16902_collect_page_rewrite_rules' );
	function wpse16902_collect_page_rewrite_rules( $page_rewrite_rules )
	{
	    $GLOBALS['wpse16902_page_rewrite_rules'] = $page_rewrite_rules;
	    return array();
	}

	add_filter( 'rewrite_rules_array', 'wspe16902_prepend_page_rewrite_rules' );
	function wspe16902_prepend_page_rewrite_rules( $rewrite_rules )
	{
	    return $GLOBALS['wpse16902_page_rewrite_rules'] + $rewrite_rules;
	}
?>