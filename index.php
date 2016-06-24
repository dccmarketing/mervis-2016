<?php
/**
 * The main template file.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package DocBlock
 */

get_header();

	?><div id="primary" class="content-area">
		<main id="main" role="main"><?php

		if ( have_posts() ) :

			/**
			 * The function_names_while_before action hook
			 *
			 * @hooked 		single_post_title
			 */
			do_action( 'function_names_while_before' );

			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/**
				 * The function_names_entry_before action hook
				 */
				do_action( 'function_names_entry_before' );

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

				/**
				 * The function_names_entry_after action hook
				 */
				do_action( 'function_names_entry_after' );

			endwhile;

			/**
			 * The function_names_while_after action hook
			 *
			 * @hooked 		posts_nav
			 */
			do_action( 'function_names_while_after' );

		else :

			/**
			 * The function_names_entry_before action hook
			 */
			do_action( 'function_names_entry_before' );

			get_template_part( 'template-parts/content', 'none' );

			/**
			 * The function_names_entry_after action hook
			 */
			do_action( 'function_names_entry_after' );

		endif;

		?></main><!-- main -->
	</div><!-- .content-area --><?php

get_sidebar();
get_footer();
