<?php
/* 	if (is_single()) {
 		$obj = get_the_category();
 		$slug = $obj[0]->category_nicename;
 		$cat_name = $obj[0]->cat_name;
 	}else{
 	  $obj = get_queried_object();
 	  $slug = $obj->category_nicename;
 	  $cat_name = $obj->cat_name;
 	}*/
?>
<header id="page-header" class="site-header" role="banner">
	<div class="site-title-bar title-bar" <?php foundationpress_title_bar_responsive_toggle(); ?>>
		<div class="title-bar-left">
			<button aria-label="<?php _e( 'Main Menu', 'foundationpress' ); ?>" class="menu-icon" type="button" data-toggle="<?php foundationpress_mobile_menu_id(); ?>"></button>
			<span class="site-mobile-title title-bar-title">
				<a href="<?php echo site_url(); ?>" rel="home"><img src="<?php bloginfo( 'template_directory' ); ?>/dist/assets/images/Madico-Brand-Hub-Logo-Horizontal.svg" alt="Madico The Clear Choice"></a>
			</span>
		</div>
	</div>

	<nav class="site-navigation top-bar" role="navigation">
		<div class="top-bar-left">
			<div class="site-desktop-title top-bar-title">
				<a href="<?php echo site_url(); ?>" rel="home"><img src="<?php bloginfo( 'template_directory' ); ?>/dist/assets/images/Madico-Brand-Hub-Logo-Horizontal.svg" alt="Madico The Clear Choice"></a>
			</div>
		</div>
		<div class="top-bar-right">
			
			<?php //get_template_part('template-parts/search/searchform'); ?>

		</div>
	</nav>

</header>
