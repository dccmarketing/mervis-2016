<?php
/**
 * Template Name: Accordion
 *
 * Description: A full-width template with no sidebar
 *
 * @package Mervis_2016
 */

get_header();

	?><div id="primary" class="content-area full-width">
		<main id="main" role="main"><?php

			/**
			 * The mervis_2016_while_before action hook
			 *
			 * @hooked 		title_archive 			10
			 * @hooked 		title_single_post 		10
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

			endwhile; // loop

			/**
			 * The mervis_2016_while_after action hook
			 *
			 * @hooked 			posts_nav
			 */
			do_action( 'mervis_2016_while_after' );

			?><div id="accordion"><?php

				if ( get_field( 'accordion' ) ) :

					while( has_sub_field( 'accordion' ) ) :

						?><h2><?php the_sub_field( 'title' ); ?></h2>
						<div class="accordion-content"><?php the_sub_field( 'content' ); ?></div><?php

					endwhile;

				endif;

			?></div><!-- #accordion -->
		</main><!-- #main -->
	</div><!-- #primary --><?php

get_footer();
