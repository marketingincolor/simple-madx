<?php
/**
 * Register Menus
 *
 * @link http://codex.wordpress.org/Function_Reference/register_nav_menus#Examples
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

register_nav_menus(
	array(
		'top-bar-r'  => esc_html__( 'Right Top Bar', 'foundationpress' ),
		'mobile-nav' => esc_html__( 'Mobile', 'foundationpress' ),
		'commercial-top-nav' => esc_html__( 'Commercial Top Nav', 'foundationpress' ),
		'residential-top-nav' => esc_html__( 'Residential Top Nav', 'foundationpress' ),
		'auto-top-nav' => esc_html__( 'Auto Top Nav', 'foundationpress' ),
		'safety-top-nav' => esc_html__( 'Safety Top Nav', 'foundationpress' ),
		'about-top-nav' => esc_html__( 'About Top Nav', 'foundationpress' ),
		'specialty-top-nav' => esc_html__( 'Specialty Top Nav', 'foundationpress' ),
		'protectionpro-top-nav' => esc_html__( 'ProtectionPro Top Nav', 'foundationpress' ),
		'header-top-nav' => esc_html__( 'Header Top Nav', 'foundationpress' ),
	)
);


/**
 * Desktop navigation - right top bar
 *
 * @link http://codex.wordpress.org/Function_Reference/wp_nav_menu
 */
if ( ! function_exists( 'foundationpress_top_bar_r' ) ) {
	function foundationpress_top_bar_r() {
		wp_nav_menu(
			array(
				'container'      => false,
				'menu_class'     => 'dropdown menu',
				'items_wrap'     => '<ul id="%1$s" class="%2$s desktop-menu" data-dropdown-menu>%3$s</ul>',
				'theme_location' => 'top-bar-r',
				'depth'          => 3,
				'fallback_cb'    => false,
				'walker'         => new Foundationpress_Top_Bar_Walker(),
			)
		);
	}
}


/**
 * Mobile navigation - topbar (default) or offcanvas
 */
if ( ! function_exists( 'foundationpress_mobile_nav' ) ) {
	function foundationpress_mobile_nav() {
		wp_nav_menu(
			array(
				'container'      => false,   // Remove nav container
				'menu'           => __( 'mobile-nav', 'foundationpress' ),
				'menu_class'     => 'vertical menu',
				'theme_location' => 'mobile-nav',
				'items_wrap'     => '<ul id="%1$s" class="%2$s" data-accordion-menu data-submenu-toggle="true">%3$s</ul>',
				'fallback_cb'    => false,
				'walker'         => new Foundationpress_Mobile_Walker(),
			)
		);
	}
}

/**
 * Commercial navigation - top nav
 */
if ( ! function_exists( 'foundationpress_commercial_nav' ) ) {
	function foundationpress_commercial_nav() {
		wp_nav_menu(
			array(
				'container'      => false, // Remove nav container
				'menu'           => __( 'commercial-top-nav', 'foundationpress' ),
				'menu_class'     => 'menu',
				'theme_location' => 'commercial-top-nav',
				'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
				'fallback_cb'    => false,
			)
		);
	}
}

/**
 * Residential navigation - top nav
 */
if ( ! function_exists( 'foundationpress_residential_nav' ) ) {
	function foundationpress_residential_nav() {
		wp_nav_menu(
			array(
				'container'      => false,  // Remove nav container
				'menu'           => __( 'residential-top-nav', 'foundationpress' ),
				'menu_class'     => 'menu',
				'theme_location' => 'residential-top-nav',
				'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
				'fallback_cb'    => false,
			)
		);
	}
}
/**
 * Auto navigation - top nav
 */
if ( ! function_exists( 'foundationpress_auto_nav' ) ) {
	function foundationpress_auto_nav() {
		wp_nav_menu(
			array(
				'container'      => false,   // Remove nav container
				'menu'           => __( 'auto-top-nav', 'foundationpress' ),
				'menu_class'     => 'menu',
				'theme_location' => 'auto-top-nav',
				'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
				'fallback_cb'    => false,
			)
		);
	}
}

/**
 * Safety navigation - top nav
 */
if ( ! function_exists( 'foundationpress_safety_nav' ) ) {
	function foundationpress_safety_nav() {
		wp_nav_menu(
			array(
				'container'      => false,   // Remove nav container
				'menu'           => __( 'safety-top-nav', 'foundationpress' ),
				'menu_class'     => 'menu',
				'theme_location' => 'safety-top-nav',
				'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
				'fallback_cb'    => false,
			)
		);
	}
}

/**
 * ProtectionPro navigation - top nav
 */
if ( ! function_exists( 'foundationpress_protectionpro_nav' ) ) {
	function foundationpress_protectionpro_nav() {
		wp_nav_menu(
			array(
				'container'      => false,   // Remove nav container
				'menu'           => __( 'protectionpro-top-nav', 'foundationpress' ),
				'menu_class'     => 'menu',
				'theme_location' => 'protectionpro-top-nav',
				'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
				'fallback_cb'    => false,
			)
		);
	}
}

/**
 * About navigation - top nav
 */
if ( ! function_exists( 'foundationpress_about_nav' ) ) {
	function foundationpress_about_nav() {
		wp_nav_menu(
			array(
				'container'      => false,   // Remove nav container
				'menu'           => __( 'about-top-nav', 'foundationpress' ),
				'menu_class'     => 'menu',
				'theme_location' => 'about-top-nav',
				'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
				'fallback_cb'    => false,
			)
		);
	}
}

/**
 * Specialty navigation - top nav
 */
if ( ! function_exists( 'foundationpress_specialty_nav' ) ) {
	function foundationpress_specialty_nav() {
		wp_nav_menu(
			array(
				'container'      => false,   // Remove nav container
				'menu'           => __( 'specialty-top-nav', 'foundationpress' ),
				'menu_class'     => 'menu',
				'theme_location' => 'specialty-top-nav',
				'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
				'fallback_cb'    => false,
			)
		);
	}
}

/**
 * Header Top Navigation - top nav
 */
if ( ! function_exists( 'foundationpress_header_nav' ) ) {
	function foundationpress_header_nav() {
		wp_nav_menu(
			array(
				'container'      => false,   // Remove nav container
				'menu'           => __( 'header-top-nav', 'foundationpress' ),
				'menu_class'     => 'menu',
				'theme_location' => 'header-top-nav',
				'items_wrap'     => '<ul id="%1$s" class="%2$s vertical">%3$s</ul>',
				'fallback_cb'    => false,
			)
		);
	}
}


/**
 * Add support for buttons in the top-bar menu:
 * 1) In WordPress admin, go to Apperance -> Menus.
 * 2) Click 'Screen Options' from the top panel and enable 'CSS CLasses' and 'Link Relationship (XFN)'
 * 3) On your menu item, type 'has-form' in the CSS-classes field. Type 'button' in the XFN field
 * 4) Save Menu. Your menu item will now appear as a button in your top-menu
*/
if ( ! function_exists( 'foundationpress_add_menuclass' ) ) {
	function foundationpress_add_menuclass( $ulclass ) {
		$find    = array( '/<a rel="button"/', '/<a title=".*?" rel="button"/' );
		$replace = array( '<a rel="button" class="button"', '<a rel="button" class="button"' );

		return preg_replace( $find, $replace, $ulclass, 1 );
	}
	add_filter( 'wp_nav_menu', 'foundationpress_add_menuclass' );
}
