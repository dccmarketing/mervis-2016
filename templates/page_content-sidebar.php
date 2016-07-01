<?php
/**
 * Template Name: Content Sidebar
 *
 * Description: Page template with sidebar on the right-side
 *
 * @package Mervis_2016
 */

get_header();

	?><div id="primary" class="content-area content-sidebar">
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

				get_template_part( 'partials/template-parts/content', 'page' );

				/**
				 * The mervis_2016_entry_after action hook
				 *
				 * @hooked 		comments 		10
				 */
				do_action( 'mervis_2016_entry_after' );

			endwhile; // loop

			/**
			 * The mervis_2016_while_after action hook
			 */
			do_action( 'mervis_2016_while_after' );

		?></main><!-- #main -->
	</div><!-- #primary --><?php

get_sidebar();
get_footer();