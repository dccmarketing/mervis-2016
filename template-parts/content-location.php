<?php
/**
 * @package Mervis
 */

global $mervis_themekit;

$fields = get_fields( get_the_ID() );

the_title( '<h2 class="loc-name">', '</h2>' );

?><div class="wrap-location">
	<div class="flex">
		<div class="locations-info">
			<ul class="locations-contact"><?php

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

		?></div><!-- .loc-info --><?php

		if ( is_single() ) {

			?><div class="locationform"><?php

				echo FrmFormsController::get_form_shortcode( array( 'id' => 3, 'title' => false, 'description' => false ) );

			?></div><!-- .locationform --><?php

		}

		?><div class="locations-map">
			<iframe id="map_canvas_<?php echo get_the_ID(); ?>" class="map_canvas" width="325" height="280" frameborder="0" style="border:0" src="<?php

			$query_args['key'] 		= urlencode( 'AIzaSyAGcYxP0VLf9HPExuN_-4YtvsTqbsh_Tl0' );
			$query_args['zoom'] 	= urlencode( 12 );
			$query_args['center'] 	= urlencode( $fields['lat'] . ',' . $fields['long'] );
			$query_args['q'] 		= urlencode( get_the_title() );
			$url 					= add_query_arg( $query_args, 'https://www.google.com/maps/embed/v1/place' );

			echo esc_url( $url ); ?>"></iframe><?php

			$query_args['saddr'] 	= urlencode( get_the_title() );
			$query_args['daddr'] 	= urlencode( $fields['lat'] . ','. $fields['long'] );
			$url 					= add_query_arg( $query_args, 'http://www.google.com/maps/' );

			?><a class="track locations-link" href="<?php echo esc_url( $url ); ?>" target="_blank"><?php esc_html_e( 'Map It', 'mervis' ); ?></a>
		</div><!-- .loc-map -->
	</div><!-- .flex -->
</div><!-- .wrap-location -->
