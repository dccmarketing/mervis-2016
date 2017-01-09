<?php

/**
 * Displays a metabox
 *
 * @link       http://slushman.com
 * @since      1.0.0
 *
 * @package    Mervis_2016
 */

wp_nonce_field( $this->theme_name, 'nonce_page_menus' );

$atts 					= array();
$atts['aria'] 			= esc_html__( 'Select main menu', 'mervis-2016' );
$atts['blank'] 			= esc_html__( ' - Select - ', 'mervis-2016' );
$atts['class'] 			= 'widefat';
$atts['description'] 	= esc_html__( 'Select the main menu to display on this page.', 'mervis-2016' );
$atts['id'] 			= 'main-menu';
$atts['label'] 			= esc_html__( 'Main Menu', 'mervis-2016' );
$atts['name'] 			= 'main-menu';
$atts['value'] 			= '';

if ( ! empty( $this->meta[$atts['id']][0] ) ) {

	$atts['value'] = $this->meta[$atts['id']][0];

}

$atts 			= apply_filters( $this->theme_name . '-field-' . $atts['id'], $atts );
$this->fields[] = array( $atts['name'], 'select', $atts['label'] );

?><p><?php

include( get_stylesheet_directory() . '/template-parts/fields/menu-select.php' );

?></p><?php



$atts 					= array();
$atts['aria'] 			= esc_html__( 'Select header menu', 'mervis-2016' );
$atts['blank'] 			= esc_html__( ' - Select - ', 'mervis-2016' );
$atts['class'] 			= 'widefat';
$atts['description'] 	= esc_html__( 'Select the header menu to display on this page.', 'mervis-2016' );
$atts['id'] 			= 'header-menu';
$atts['label'] 			= esc_html__( 'Header Menu', 'mervis-2016' );
$atts['name'] 			= 'header-menu';
$atts['value'] 			= '';

if ( ! empty( $this->meta[$atts['id']][0] ) ) {

	$atts['value'] = $this->meta[$atts['id']][0];

}

$atts 			= apply_filters( $this->theme_name . '-field-' . $atts['id'], $atts );
$this->fields[] = array( $atts['name'], 'select', $atts['label'] );

?><p><?php

include( get_stylesheet_directory() . '/template-parts/fields/menu-select.php' );

?></p>
