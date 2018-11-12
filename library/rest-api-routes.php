<?php

  class all_terms
{
    public function __construct()
    {
        $version = '2';
        $namespace = 'wp/v' . $version;
        $base = 'all-terms';
        register_rest_route($namespace, '/' . $base, array(
            'methods' => 'GET',
            'callback' => array($this, 'get_all_terms'),
        ));
    }

    public function get_all_terms($object)
    {
        $return = array();
        // $return['categories'] = get_terms('category');
 //        $return['tags'] = get_terms('post_tag');
        // Get taxonomies
        $args = array(
            'public' => true,
            '_builtin' => false
        );
        $output = 'names'; // or objects
        $operator = 'and'; // 'and' or 'or'
        $taxonomies = get_taxonomies($args, $output, $operator);
        foreach ($taxonomies as $key => $taxonomy_name) {
            if($taxonomy_name = $_GET['term']){
            $return = get_terms($taxonomy_name);
        }
        }
        return new WP_REST_Response($return, 200);
    }
}

function get_id_by_slug($params) {
    $page = get_page_by_path($slug);
    if ($page) {
        return $page->ID;
    } else {
        return null;
    }
}

function get_current_taxonomy_slug($params) {
    $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
    return $term->slug;
}

add_action('rest_api_init', function () {
    $all_terms = new all_terms;

    register_rest_route( 'wp/v2/', 'pages', array(
      'methods' => 'GET',
      'callback' => 'get_id_by_slug',
    ) );

    register_rest_route( 'wp/v2/', 'get-current-taxonomy', array(
      'methods' => 'GET',
      'callback' => 'get_current_taxonomy_slug',
    ) );
});
