<?php
/**
 * @package Mervis
 */

get_header();

$fields = get_fields( get_the_ID() );

?><div id="primary" class="content-area full-width">
	<main id="main" role="main"><?php
	
		the_title( '<h1 class="page-title">', '</h1>' );
	
		?><div class="flex">
			<div class="loc-info">
				<ul class="loc-contact"><?php

			if ( ! empty( $fields['address1'] ) ) {

				?><li><?php echo esc_html( $fields['address1'] ); ?></li><?php

			}

			if ( ! empty( $fields['address2'] ) ) {

				?><li><?php echo esc_html( $fields['address2'] ); ?></li><?php

			}

			?><li><?php echo $fields['city']; ?>, <?php echo $fields['state']; ?> <?php echo $fields['zip']; ?></li>
			<li><?php esc_html_e( 'Phone: ', 'mervis' ); echo mervis_2016_make_phone_link( $fields['phone'] ); ?></li><?php

			if ( ! empty( $fields['fax'] ) ) {

				?><li><?php esc_html_e( 'Fax: ', 'mervis' ); echo esc_html( $fields['fax'] ); ?></li><?php

			}

			if ( ! empty( $fields['email'] ) ) {

				?><li><?php esc_html_e( 'Email: ', 'mervis' ); ?><a class="track" href="mailto:<?php echo sanitize_email( $fields['email'] ); ?>"><?php echo sanitize_email( $fields['email'] ); ?></a></li><?php

			}
			
			?></ul><?php

			if ( ! empty( $fields['hours'] ) ) {

				?><h3><?php esc_html_e( 'Hours', 'mervis' ); ?></h3>
				<p><?php echo $fields['hours']; ?></p><?php

			}

			if ( ! empty( $fields['description'] ) ) {

				?><p><?php echo $fields['description']; ?></p><?php

			}

			if ( ! empty( $fields['servicearea'] ) ) {

				?><p><?php echo $fields['servicearea']; ?></p><?php

			}

			if ( ! empty( $fields['principalservices'] ) ) {

				?><h3><?php esc_html_e( 'Principal Services', 'mervis' ); ?></h3>
				<p><?php echo $fields['principalservices']; ?></p><?php

			}

			?></div><!-- .loc-info -->
			<div class="loc-map"><?php
			
				$list = Mappress_Map::get_post_map_list( get_the_ID() );
			
				//echo '<pre>'; print_r( $list ); echo '</pre>';
			
				//echo '<pre>'; print_r( $list[0]->mapid ); echo '</pre>';
			
				echo do_shortcode( '[mappress width=100%]' );
			
			?></div><!-- .loc-map -->
		</div><!-- .flex -->
	</main><!-- #main -->
</div><!-- #primary --><?php

get_footer();
