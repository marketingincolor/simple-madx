<?php
/**
 * The template for displaying search form
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */
	$obj = get_queried_object();
 	
 	if (is_single()) {
 		$obj = get_the_category();
 		$name = $obj[0]->cat_name;
 	}else{
 	  $obj = get_queried_object();
 	  if ($obj->term_id) {
 	  	$name = $obj->cat_name;
 	  }else{
 	  	$name = 'Blog';
 	  }
 	}
?>

<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
	<div class="input-group relative">
		<input type="text" class="input-group-field" value="" name="s" id="s" placeholder="<?php esc_attr_e( "{$name}", 'foundationpress' ); ?>">
		<?php if($name != 'Blog') { ?>
		  <input type="hidden" value="<?php echo $name ?>" name="category_name">
		<?php } ?>
		<button type="submit" class="absolute">
		   <i class="fas fa-search"></i>
		</button>
	</div>
</form>
