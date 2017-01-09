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

			/**
			 * The mervis_2016_content_bottom action hook
			 *
			 * @hooked 			sidebar_news 		50
			 */
			do_action( 'mervis_2016_content_bottom' );

		?></div><!-- #content --><?php

		/**
		 * The mervis_2016_content_after action hook
		 *
		 * @hooked 			sidebar_home 	`	50`
		 */
		do_action( 'mervis_2016_content_after' );

		/**
		 * The mervis_2016_footer_before action hook
		 *
		 * @hooked 			sidebar_footer 		10
		 */
		do_action( 'mervis_2016_footer_before' );

		?><footer id="colophon" role="contentinfo"><?php

			/**
			 * The mervis_2016_footer_top action hook
			 *
			 * @hooked 			footer_wrap_begin
			 */
			do_action( 'mervis_2016_footer_top' );

			/**
			 * The mervis_2016_footer_content action hook
			 *
			 * @hooked 		footer_content 		20
			 */
			do_action( 'mervis_2016_footer_content' );

			/**
			 * The mervis_2016_footer_bottom action hook
			 *
			 * @hooked 			footer_wrap_end
			 */
			do_action( 'mervis_2016_footer_bottom' );

		?></footer><!-- #colophon --><?php

	/**
	 * The mervis_2016_footer_after action hook
	 */
	do_action( 'mervis_2016_footer_after' );

	wp_footer();

	/**
	 * The mervis_2016_body_bottom action hook
	 */
	do_action( 'mervis_2016_body_bottom' );

	?></body>
</html>
