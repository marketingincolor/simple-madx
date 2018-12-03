<?php
	$url = $_SERVER['REQUEST_URI'];

	//if (strpos($url, 'mu-types') !== false) {
	//    get_header('madicou');
	//}else{
	  get_header();
	//}

	/*if (strpos($url, 'residential') !== false) {
	    $post_type = 'residential';
	}else if (strpos($url, 'commercial') !== false) {
	    $post_type = 'commercial';
	}else if (strpos($url, 'automotive') !== false) {
	    $post_type = 'automotive';
	}else if (strpos($url, 'safety') !== false) {
	    $post_type = 'safety';
	}else if (strpos($url, 'specialty') !== false) {
	    $post_type = 'specialty';
	}
	// madicoU
	else if (strpos($url, 'video') !== false) {
	    $post_type = 'video';
	}else if (strpos($url, 'article') !== false) {
	    $post_type = 'article';
	}else if (strpos($url, 'document') !== false) {
	    $post_type = 'document';
	}*/

	//get_template_part('template-parts/taxonomy/'.$post_type);
?>




<?php 
$page_terms = $_GET['dlm_download_category'];

/*$terms = get_terms( 'dlm_download_category' );
foreach ( $terms as $term ) {
	echo "<h2>" . $term->name . "</h2>";
	$slug = $term->slug;
	echo do_shortcode( "[downloads category='$slug']" );
}*/
echo '<h3>' . single_term_title( '', false ) . '</h3>';
echo do_shortcode( "[downloads category='$page_terms']" );
?>

<?php get_footer();