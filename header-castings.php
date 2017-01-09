<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Mervis_2016
 */

/**
 * The mervis_2016_html_before action hook
 */
do_action( 'mervis_2016_html_before' );

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head><?php

		/**
		 * The mervis_2016_head_top action hook
		 */
		do_action( 'mervis_2016_head_top' );

		?><meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"><?php

		wp_head();

		/**
		 * The mervis_2016_head_bottom action hook
		 */
		do_action( 'mervis_2016_head_bottom' );

	?></head>

	<body <?php body_class(); ?>><?php

		/**
		 * The mervis_2016_body_top action hook
		 *
		 * @hooked 		analytics_code 			10
		 * @hooked 		skip_link 				20
		 */
		do_action( 'mervis_2016_body_top' );

		/**
		 * The mervis_2016_header_before action hook
		 */
		do_action( 'mervis_2016_header_before' );

		?><header role="banner"><?php

			/**
			 * The castings_header_top action hook
			 *
			 * @hooked 		header_wrap_begin 		10
			 * @hooked 		site_branding_begin 	15
			 */
			do_action( 'castings_header_top' );

			/**
			 * The castings_header_content action hook
			 *
			 * @hooked 		title_site 					10
			 * @hooked 		text_logo 					15
			 * @hooked 		site_branding_end 			20
			 * @hooked 		header_menus_wrap_begin 	25
			 * @hooked 		menu_castings_header 		35
			 */
			do_action( 'castings_header_content' );

			/**
			 * The castings_header_bottom action hook
			 *
			 * @hooked 		header_menus_wrap_end 		75
			 * @hooked 		header_wrap_end 			90
			 */
			do_action( 'castings_header_bottom' );

		?></header><?php

		/**
		 * The castings_header_after action hook
		 *
		 * @hooked 			featured_image 			10
		 * @hooked 			menu_castings_main 		15
		 */
		do_action( 'castings_header_after' );

		/**
		 * The mervis_2016_content_before action hook
		 */
		do_action( 'mervis_2016_content_before' );

		?><div id="content" class="site-content"><?php

			/**
			 * The mervis_2016_content_top action hook
			 *
			 * @hooked 			breadcrumbs 			10
			 * @hooked 			menubox_wrap_begin 		19
			 * @hooked 			menu_menubox1 			20
			 * @hooked 			menu_menubox2 			25
			 * @hooked 			menu_menubox3 			30
			 * @hooked 			menu_menubox4 			40
			 * @hooked 			menubox_wrap_end 		41
			 */
			do_action( 'mervis_2016_content_top' );
