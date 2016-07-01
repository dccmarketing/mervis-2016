<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Mervis_2016
 */

	?><footer class="footer-android"><?php

	if ( has_nav_menu( 'android-footer' ) ) {

		$menu['theme_location']		= 'android-footer';
		$menu['container'] 			= 'div';
		$menu['container_id']    	= 'menu-android';
		$menu['container_class'] 	= 'menu nav-android';
		$menu['menu_id']         	= 'menu-android-items';
		$menu['menu_class']      	= 'menu-items';
		$menu['depth']           	= 1;
		$menu['fallback_cb']     	= '';

		wp_nav_menu( $menu );

	}

	?></footer><?php

	wp_footer();

?></body>
</html>
