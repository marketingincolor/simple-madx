<?php 
	$current_post = get_queried_object();
	
	if ($current_post->ID && $current_post->post_parent == 0) {
		$page_id = $current_post->ID;
	}else if($current_post->ID && $current_post->post_parent != 0){
		$page_id = $current_post->post_parent;
	}else{
		$array    = (explode("_",$current_post->taxonomy));
		if ($array[0] == 'specialty') {
			$path_path = 'specialty-solutions';
		}else if ($array[0] == 'safety') {
			$path_path = 'safety-security';
		}else{
			$path_path = $array[0];
		}
		$the_page = get_page_by_path($path_path);
		$page_id  = $the_page->ID;
	}
	
 ?>

<section class="find-dealer" style="background-image: url(<?php the_field('specialty_contact_background_image',$page_id); ?>);">
	<div class="grid-container">
		<div class="grid-x">
			<div class="small-10 small-offset-1 medium-7 large-6 large-offset-0 cell">
				<h2 class="white"><?php the_field('specialty_contact_heading',$page_id); ?></h2>
				<aside class="yellow-underline left"></aside>
				<p class="white"><?php the_field('specialty_contact_subhead',$page_id); ?></p>
				<a href="<?php the_field('specialty_contact_button_link',$page_id); ?>" class="btn-yellow solid"><?php the_field('specialty_contact_button_text',$page_id); ?></a>
			</div>
		</div>
	</div>
</section>
