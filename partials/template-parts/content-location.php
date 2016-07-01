<?php
/**
 * @package Mervis
 */

global $mervis_themekit;

$fields = get_fields( get_the_ID() );

the_title( '<h2 class="loc-name">', '</h2>' );

?><div class="wrap-location">
	<div class="flex">
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

		?><div class="loc-map">
			<script>
				var map = null;
				function initialize() {
					var map_canvas = document.getElementById('<?php echo "map_canvas_" . get_the_ID(); ?>');
					var myLoc = new google.maps.LatLng(<?php echo $fields['lat']; ?>,<?php echo $fields['long']; ?>);
					var map_options = {
						center: myLoc,
						zoom: 12,
						mapTypeId: google.maps.MapTypeId.ROADMAP,
						disableDefaultUI: true
					}
					map = new google.maps.Map(map_canvas, map_options)

					var marker = new google.maps.Marker({
						position: myLoc,
						map: map,
						animation: google.maps.Animation.DROP,
					});
				}
				google.maps.event.addDomListener(window, 'load', initialize);
			</script>
			<div id="map_canvas_<?php echo get_the_ID(); ?>" class="map_canvas"></div><?php

			$query_args['saddr'] 	= urlencode( get_the_title() );
			$query_args['daddr'] 	= urlencode( $fields['lat'] . ','. $fields['long'] );
			$url 					= add_query_arg( $query_args, 'http://www.google.com/maps/' );

			?><a class="track" href="<?php echo esc_url( $url ); ?>" target="_blank"><?php esc_html_e( 'Map It', 'mervis' ); ?></a>
		</div><!-- .loc-map -->
	</div><!-- .flex -->
</div><!-- .wrap-location -->
