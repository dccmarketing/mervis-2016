<?php
/**
 * Template Name: Android Pricing
 */

$date 	= '';
$metal 	= '';
$locID 	= '';
$prices = array();

if ( isset( $_POST['mode'] ) && 'pricing_search' == $_POST['mode'] && isset( $_POST['mervis_android_pricing_nonce'] ) && wp_verify_nonce( $_POST['mervis_android_pricing_nonce'], 'mervis_android_pricing' ) ) {

	$metal 	= esc_attr( $_POST['pricing_metal'] );
	$locID 	= esc_attr( $_POST['pricing_location'] );
	$loc 	= mervis_2016_get_posts( 'pricing', array( 'p' => $locID ) );
	$prices = get_field( $metal, $locID );

	if ( 1 == $loc->found_posts ) {

		$date = date( 'F j, Y ', strtotime( $loc->post->post_modified ) );

	}

}

get_header( 'android' );
$locations = mervis_2016_get_posts( 'pricing' );

?><section class="top-form">
	<form action="<?php echo get_permalink(); ?>" method="post">
	<div>
		<div class="location-select">
			<select name="pricing_location">
				<option>Select a location...</option><?php
				
			foreach ( $locations->posts as $location ) {

				?><option value="<?php echo $location->ID; ?>" <?php selected( $locID, $location->ID, true ); ?>><?php echo $location->post_title; ?></option><?php

			}

			?></select>
		</div>
	</div>
	<div class="magnetic">
		<input type="radio" name="pricing_metal" value="nonferrous" id="nonferrous" <?php if ( empty( $metal ) ) { echo 'checked'; } else { checked( $metal, 'nonferrous', true ); } ?>><label for="nonferrous">Non-Ferrous</label>
		<input type="radio" name="pricing_metal" value="ferrous" id="ferrous"<?php checked( $metal, 'ferrous', true ); ?>><label for="ferrous">Ferrous</label>
	</div><?php

	wp_nonce_field( 'mervis_android_pricing', 'mervis_android_pricing_nonce' );

	?>
	<input type="hidden" name="mode" value="pricing_search">
	<input class="btn-submit" type="submit" value="Get Prices">
	</form>
</section>
<p class="fine-print">These prices are based upon regional ranges and are subject to change without notice. Contact any Mervis location for custom quotes on large orunique loads.</p>
<section class="waistband"><?php

if ( ! empty( $date ) ) {

	?><p>Current Price as of <?php echo $date; ?></p><?php

}

?></section>
<section class="list">
	<ol><?php

	//pretty( $prices );

	foreach ( $prices as $price ) {

		?><li><span class="metal-name"><?php echo $price['metal']; ?></span><span class="metal-price"><?php echo $price['price']; ?></span></li><?php

	}

	?></ol>
</section><?php

get_footer( 'android' );
