<?php
/**
 * Template Name: Android Alerts
 */

get_header( 'android' );

?><section class="top-form">
	<a href="<?php echo site_url( '/texting' ); ?>" class="signup-button text-alerts"><span class="dashicons dashicons-smartphone"></span> Get Text Alerts</a>
	<a href="<?php echo site_url( '/get-email-alerts' ); ?>" class="signup-button email-alerts"><span class="dashicons dashicons-email-alt"></span> Get Email Alerts</a>
</section>
<section class="waistband"></section>
<section class="list">
	<ol class="alerts"><?php

	$alerts = mervis_2016_get_posts( 'notifications' );

	foreach ( $alerts->posts as $alert ) {

		?><li class="alert"><a href="<?php echo get_permalink( $alert->ID ); ?>"><?php echo $alert->post_title; ?></a></li><?php

	} // foreach

	?></ol>
</section><?php

get_footer( 'android' );
