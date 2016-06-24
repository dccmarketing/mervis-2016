<?php
/**
 * The sidebar for the Sidrbar Content page template
 *
 * @package Mervis_2016
 */

if ( ! is_active_sidebar( 'sidebar-left' ) ) { return; }

/**
 * The mervis_2016_sidebars_before action hook
 */
do_action( 'mervis_2016_sidebars_before' );

?><aside id="secondary" class="widget-area sidebar-left" role="complementary"><?php

	/**
	 * The mervis_2016_sidebar_top action hook
	 */
	do_action( 'mervis_2016_sidebar_top' );

	dynamic_sidebar( 'sidebar-left' );

	/**
	 * The mervis_2016_sidebar_bottom action hook
	 */
	do_action( 'mervis_2016_sidebar_bottom' );

?></aside><!-- #secondary --><?php

/**
 * The mervis_2016_sidebars_after action hook
 */
do_action( 'mervis_2016_sidebars_after' );