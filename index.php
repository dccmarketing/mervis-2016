<?php
/**
 * The main template file.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Mervis_2016
 */

get_header();

	?><div id="primary" class="content-area content-sidebar">
		<main id="main" role="main"><?php

		if ( have_posts() ) :

			/**
			 * The mervis_2016_while_before action hook
			 *
			 * @hooked 		title_archive 			10
			 * @hooked 		title_single_post 		10
			 */
			do_action( 'mervis_2016_while_before' );

			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/**
				 * The mervis_2016_entry_before action hook
				 */
				do_action( 'mervis_2016_entry_before' );

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'excerpt' );

				/**
				 * The mervis_2016_entry_after action hook
				 */
				do_action( 'mervis_2016_entry_after' );

			endwhile;

			/**
			 * The mervis_2016_while_after action hook
			 *
			 * @hooked 		posts_nav
			 */
			do_action( 'mervis_2016_while_after' );

		else :

			/**
			 * The mervis_2016_entry_before action hook
			 */
			do_action( 'mervis_2016_entry_before' );

			get_template_part( 'template-parts/content', 'none' );

			/**
			 * The mervis_2016_entry_after action hook
			 */
			do_action( 'mervis_2016_entry_after' );

		endif;

		?></main><!-- main -->
	</div><!-- .content-area --><?php

get_footer();
