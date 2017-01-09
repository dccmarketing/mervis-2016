<?php
/**
 * Template part for displaying a metabox.
 *
 * @package TCCi
 */

wp_nonce_field( $this->theme_name, 'nonce_tcci_post_image' );

$atts 					= array();
$atts['class'] 			= 'widefat';
$atts['description'] 	= esc_html__( '', 'mervis-2016' );
$atts['id'] 			= 'post-image';
$atts['label-remove'] 	= esc_html__( 'Remove image', 'mervis-2016' );
$atts['label-upload'] 	= esc_html__( 'Choose/Upload image', 'mervis-2016' );
$atts['name'] 			= 'post-image';
$atts['placeholder'] 	= esc_html__( '', 'mervis-2016' );
$atts['type'] 			= 'url';
$atts['value'] 			= '';

if ( ! empty( $this->meta[$atts['id']][0] ) ) {

	$atts['value'] = $this->meta[$atts['id']][0];

}

$atts = apply_filters( 'tcci-field-' . $atts['id'], $atts );

?><p><?php

include( get_stylesheet_directory() . '/template-parts/fields/'file-upload.php' );

?></p><?php
