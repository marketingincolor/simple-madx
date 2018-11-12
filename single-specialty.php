<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header();
$terms = get_the_terms($post->ID, 'specialty_taxonomies');
if ($terms[0]->slug == 'case-studies') {
	get_template_part('/template-parts/single-templates/case-studies');
} 
?>

	

<?php get_footer();