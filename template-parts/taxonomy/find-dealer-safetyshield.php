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
		echo $page_path;
		$the_page = get_page_by_path($path_path);
		$page_id  = $the_page->ID;
	}
	
 ?>
 
<section class="find-dealer" style="background-image: url(<?php the_field('find_dealer_background_image',$page_id); ?>);">
	<div class="grid-container">
		<div class="grid-x">
			<div class="small-10 small-offset-1 medium-9 large-7 large-offset-0 cell">
				<h2 class="white">Find a SafetyShield by Madico Premier Partner</h2>
				<aside class="yellow-underline left"></aside>
				<p class="white">Madico SafetyShield Premier Partners (MSPP) have the expertise to help reduce your risk of personal injury, property damage, and loss. To find the nearest MSPP, enter your information below. </p>
					
				<find-dealer-form></find-dealer-form>
					
			</div>
		</div>
	</div>
</section>