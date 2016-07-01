<?php
/**
 * Template Name: Android Calculator
 */

$estimate 	= '';
$pounds		= '';
$prices 	= array();
$metals 	= array();
$ferrous 	= array();
$unit 		= 'LB';
$thismetal 	= '';
$locations 	= mervis_2016_get_posts( 'pricing' );

get_header( 'android' );

if ( ! isset( $_POST['mode'] ) ) {

	?><section class="top-form">
		<form action="<?php echo get_permalink(); ?>" method="post">
			<div>
				<div class="location-select">
					<select name="calc_location1" id="calcLocs1">
						<option>Select a location...</option><?php

					foreach ( $locations->posts as $location ) {

						$prices[$location->ID] = get_post_custom( $location->ID );

						?><option value="<?php echo $location->ID; ?>"><?php echo $location->post_title; ?></option><?php

					}

					?></select>
				</div>
			</div><?php

			wp_nonce_field( 'mervis_android_metals', 'mervis_android_metals_nonce' );

			?><input type="hidden" name="mode" value="setLoc">
			<input class="btn-submit" type="submit" value="Get Metals">
		</form>
	</section><?php

} else {

	if ( 'setLoc' == $_POST['mode']
		&& isset( $_POST['mervis_android_metals_nonce'] )
		&& wp_verify_nonce( $_POST['mervis_android_metals_nonce'], 'mervis_android_metals' )
	) {

		$locID 	= esc_attr( $_POST['calc_location1'] );
		$fers 	= get_field( 'ferrous', $locID );
		$nons 	= get_field( 'nonferrous', $locID );

		foreach ( $fers as $fer ) {

			$metals[$fer['metal']] = $fer['price'];

		}

		foreach ( $nons as $non ) {

			$metals[$non['metal']] = $non['price'];

		}

		//pretty( $metals );

	} elseif ( 'calc' == $_POST['mode']
		&& isset( $_POST['mervis_android_calc_nonce'] )
		&& wp_verify_nonce( $_POST['mervis_android_calc_nonce'], 'mervis_android_calc' )
	) {

		$thismetal 	= esc_attr( $_POST['calc_metal'] );
		$pounds 	= absint( $_POST['calc_pounds'] );
		$locID 		= esc_attr( $_POST['calc_location2'] );
		$fers 		= get_field( 'ferrous', $locID );
		$nons 		= get_field( 'nonferrous', $locID );

		foreach ( $fers as $fer ) {

			$metals[$fer['metal']] 	= $fer['price'];
			$ferrous[$fer['metal']] = $fer['price'];

		}

		foreach ( $nons as $non ) {

			$metals[$non['metal']] = $non['price'];

		}

		$estimate = $pounds * $metals[$thismetal];

		if ( array_key_exists( $thismetal, $ferrous ) ) {

			$estimate 	= $estimate / 2000;
			$unit 		= 'Net Ton';

		}

	}

	//;pretty( $metals );

	?><section class="top-form">
		<form action="<?php echo get_permalink(); ?>" method="post">
			<div>
				<div class="location-select">
					<select name="calc_location2" id="calcLocs2">
						<option>Select a location...</option><?php

					foreach ( $locations->posts as $location ) {

						$prices[$location->ID] = get_post_custom( $location->ID );

						?><option value="<?php echo $location->ID; ?>" <?php selected( $locID, $location->ID, true ); ?>><?php echo $location->post_title; ?></option><?php

					}

					?></select>
				</div>
			</div>
			<div>
				<div class="metal-select">
					<select name="calc_metal" id="calcMetal">
						<option>Select a metal...</option><?php

						foreach ( $metals as $metal => $price ) {

							?><option value="<?php echo $metal; ?>" <?php selected( $thismetal, $metal, true ); ?>><?php echo $metal; ?></option><?php

						}

					?></select>
				</div>
			</div>
			<div>
				<input type="number" placeholder="Enter estimated pounds" name="calc_pounds" class="pounds" value="<?php echo $pounds; ?>" />
			</div>

	</section>
	<section class="calc-middle"><?php

			wp_nonce_field( 'mervis_android_calc', 'mervis_android_calc_nonce' );

			?><input type="hidden" name="mode" value="calc">
			<input class="btn-submit" type="submit" value="Estimate">
		</form><?php

		if ( ! empty( $thismetal ) ) {

			?><p class="waistband">Current Price: $<?php echo esc_attr( number_format( $metals[$thismetal], 2 ) ); ?><span class="calc-unit"> <?php echo $unit; ?></span></p>
			<p class="estimate"><span class="dollar">$</span><span class="estimate"><?php echo number_format( $estimate, 2 ); ?></span></p>
			<p class="fine-print">These prices are based upon regional ranges and are subject to change without notice. Contact any Mervis location for custom quotes on large orunique loads.</p><?php

		}

	?></section><?php

}

get_footer( 'android' );
