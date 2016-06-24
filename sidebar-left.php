<?php
/**
 * The sidebar for the Sidrbar Content page template
 *
 * @package Mervis_2016
 */

if ( ! is_active_sidebar( 'sidebar-left' ) ) { return; }

/**
 * The function_names_sidebars_before action hook
 */
do_action( 'function_names_sidebars_before' );

?><aside id="secondary" class="widget-area sidebar-left" role="complementary"><?php

	/**
	 * The function_names_sidebar_top action hook
	 */
	do_action( 'function_names_sidebar_top' );

	dynamic_sidebar( 'sidebar-left' );

	/**
	 * The function_names_sidebar_bottom action hook
	 */
	do_action( 'function_names_sidebar_bottom' );

?></aside><!-- #secondary --><?php

/**
 * The function_names_sidebars_after action hook
 */
do_action( 'function_names_sidebars_after' );