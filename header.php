<?php
/**
 * The template for displaying the header
 */

?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?> >
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<!-- Google Tag Manager -->
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-KQ2BB3');</script>
		<!-- End Google Tag Manager -->
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KQ2BB3"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	<!-- #app is closed in footer.php -->
	<div id="app">

	<?php if ( get_theme_mod( 'wpt_mobile_menu_layout' ) === 'offcanvas' ) : ?>
		<?php get_template_part( 'template-parts/mobile-off-canvas' ); ?>
	<?php endif; ?>

	<div id="mobile-left-menu" class="mobile-left-menu absolute">
		<div class="menu-container relative">
			<button class="absolute" aria-label="<?php _e( 'Close Menu', 'madx' ); ?>" type="button" @click="mobileLeftMenuClose"><i class="fal fa-long-arrow-left"></i></button>
			<?php foundationpress_header_nav(); ?>
			</ul>
		</div>
	</div>

	<header id="top-header" class="site-header" role="banner">
		<div class="mobile-nav">
			<div class="hamburger-container">
				<button id="hamburger" aria-label="<?php _e( 'Open Menu', 'madx' ); ?>" class="menu-icon" type="button" @click="mobileLeftMenuOpen"></button>
			</div>
			<div class="site-mobile-title title-bar-title">
				<a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><img src="<?php bloginfo('template_directory'); ?>/dist/assets/images/madico-mobile-blue.png" alt="Madico"></a>
			</div>
			<div class="search-container">
				<a id="search-toggle" data-toggle="mobile-search" @click="mobileMenuSearch" aria-open="false"><i class="fal fa-times hide"></i><i class="far fa-search"></i></a>
			</div>
		</div>
    <div class="dropdown-pane right" id="mobile-search" v-drop-click>
			<?php get_template_part('template-parts/search/page-searchform'); ?>
    </div>
		<nav class="site-navigation top-bar" role="navigation">
			<div class="top-bar-left">
				<div class="site-desktop-title top-bar-title">
					<a href="https://madico.com" title="Madico Home" rel="home"><?php get_template_part('/template-parts/svg/madico-bug'); ?></a>
				</div>
				<ul class="dropdown menu" data-closing-time="0" v-dropdown>
		      <li>
		        <a id="nav-drop"><?php _e( 'Navigate Site', 'madx' ); ?> &nbsp;<i class="fas fa-chevron-down"></i></a>
		        <?php foundationpress_header_nav(); ?>
		      </li>
		    </ul>
			</div>
			<div class="top-bar-right">
				<ul class="menu">
				<?php if ( is_user_logged_in() ) { ?>
            		<li><a href="<?php echo site_url('/wp-admin/profile.php'); ?>"><i class="fas fa-user"></i>&nbsp; <?php _e( 'My Account', 'madx' ); ?></a></li>
            		<li><a href="<?php echo site_url('/wp-login.php?action=logout'); ?>"><i class="fas fa-user"></i>&nbsp; <?php _e( 'Logout', 'madx' ); ?></a></li>
          		<?php } else { ?>
					<li><a href="<?php echo site_url('/wp-login.php'); ?>"><i class="fas fa-user"></i>&nbsp; <?php _e( 'Login', 'madx' ); ?></a></li>
          		<?php } ?>
					<li><a href="https://madico.com/madicou"><i class="icon-madico-u-icon"></i>&nbsp; <?php _e( 'Madico U', 'madx' ); ?></a></li>
					<li><a href="https://madico.com/dealers"><i class="fas fa-id-badge"></i>&nbsp; <?php _e( 'Dealer Portal', 'madx' ); ?></a></li>
		      <li>
		        <a data-toggle="search-dropdown"><i class="fas fa-search"></i>&nbsp; <?php _e( 'Search', 'madx' ); ?></a>
		        <ul class="menu vertical">
		          <li class="dropdown-pane right" id="search-dropdown" data-position="bottom" v-drop-click>
								<?php get_template_part('template-parts/search/page-searchform'); ?>
		          </li>
		        </ul>
		      </li>
				</ul>
			</div>
		</nav>

	</header>
