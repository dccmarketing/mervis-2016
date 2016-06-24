<?php
/**
 * The template for displaying all pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Mervis_2016
 */

get_header();

	?><div id="primary" class="content-area full-width">
		<main id="main" role="main"><?php

		/**
		 * The mervis_2016_while_before action hook
		 */
		do_action( 'mervis_2016_while_before' );

		while ( have_posts() ) : the_post();

			/**
			 * The mervis_2016_entry_before action hook
			 */
			do_action( 'mervis_2016_entry_before' );

			get_template_part( 'template-parts/content', 'page' );

			/**
			 * The mervis_2016_entry_after action hook
			 *
			 * @hooked 		comments 		10
			 */
			do_action( 'mervis_2016_entry_after' );

		endwhile; // End of the loop.

		/**
		 * The mervis_2016_while_after action hook
		 */
		do_action( 'mervis_2016_while_after' );

		?></main><!-- #main -->
	</div><!-- #primary --><?php

get_sidebar();
get_footer();