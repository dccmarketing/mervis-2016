<?php
/**
 * Template Name: Android Locator
 */

get_header( 'android' );

// get all locations
$locations 	= mervis_2016_get_posts( 'locations' );
$locmetas 	= array();
$options 	= array();

// get all meta for each post
foreach ( $locations->posts as $location ) {

	$locmetas[$location->ID] = get_post_custom( $location->ID );

}

?><section class="list">
	<ol><?php

	foreach ( $locations->posts as $location ) {

		?><li class="location">
			<span class="location-name"><?php echo $location->post_title; ?></span>
			<span class="location-address"><?php
				echo $locmetas[$location->ID]['address1'][0] . ' ' .
				$locmetas[$location->ID]['address2'][0] . ' ' .
				$locmetas[$location->ID]['city'][0] . ', ' .
				mervis_get_state_abbreviation( $locmetas[$location->ID]['state'][0] ) . ' ' .
				$locmetas[$location->ID]['zip'][0];
			?></span>
			<a class="show-info" href="#"><span class="show-button">+</span></a>
			<div class="loc-info" id="info-<?php echo $location->ID; ?>">
				<a class="loc-button" href="tel:<?php echo mervis_get_tel_phone( $locmetas[$location->ID]['phone'][0] ); ?>"><span class="dashicons dashicons-phone"></span> Call</a>
				<a class="loc-button" href="mailto:<?php echo $locmetas[$location->ID]['email'][0] ?>"><span class="dashicons dashicons-email-alt"></span> Email</a>
				<a class="loc-button" href="https://www.google.com/maps?saddr=<?php echo $location->post_title; ?>&daddr=<?php echo $locmetas[$location->ID]['lat'][0]; ?>,<?php echo $locmetas[$location->ID]['long'][0]; ?>" target="_blank"><span class="dashicons dashicons-location"></span> Map</a>
			</div>
		</li><?php

	}

	?></ol>
</section><?php

get_footer( 'android' );
