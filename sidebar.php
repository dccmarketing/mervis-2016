<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Mervis_2016
 */

if ( ! is_active_sidebar( 'sidebar' ) ) { return; }

/**
 * The mervis_2016_sidebars_before action hook
 */
do_action( 'mervis_2016_sidebars_before' );

?><aside id="secondary" class="widget-area" role="complementary"><?php

	/**
	 * The mervis_2016_sidebar_top action hook
	 */
	do_action( 'mervis_2016_sidebar_top' );

	dynamic_sidebar( 'sidebar-1' );

	/**
	 * The mervis_2016_sidebar_bottom action hook
	 */
	do_action( 'mervis_2016_sidebar_bottom' );

?></aside><!-- #secondary --><?php

/**
 * The mervis_2016_sidebars_after action hook
 */
do_action( 'mervis_2016_sidebars_after' );
