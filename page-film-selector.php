<?php 
/* Template Name: Film Selector */
get_header();
$parent_id = wp_get_post_parent_id($post->ID);
$the_post = get_post($parent_id);
$post_type = $the_post->post_name;
get_template_part('template-parts/film-selector/'. $post_type);
?>



<?php get_footer();