<?php

/**
 * A class of helpful menu-related functions
 *
 * @package Mervis_2016
 * @author Slushman <chris@slushman.com>
 */
class Mervis_2016_Menukit {

	/**
	 * Constructor
	 */
	public function __construct() {} // __construct()

	public function add_search_to_menu( $items, $args ) {

		if ( 'header-tabs' !== $args->theme_location ) { return $items; }

		return $items . get_search_form();

	} // add_search_to_menu()

	/**
	 * Add an icon the menu item
	 *
	 * @link 	http://www.billerickson.net/customizing-wordpress-menus/
	 *
	 * @param 	string 		$item_output		//
	 * @param 	object 		$item				//
	 * @param 	int 		$depth 				//
	 * @param 	array 		$args 				//
	 *
	 * @return 	string 							modified menu
	 */
	public function header_tabs_menu( $item_output, $item, $depth, $args ) {

		if ( 'header-tabs' !== $args->theme_location ) { return $item_output; }

		$atts 		= $this->get_attributes( $item );
		$icon 		= $this->get_icon_info( $item->classes );
		$textpos 	= $this->get_text_pos( $item->classes );

		if ( empty( $icon ) && empty( $textpos ) ) { return $item_output; }

		$output = '';

		$output .= '<a href="' . $item->url . '" class="icon-menu" ' . $atts . '>';

		if ( 'right' === $textpos ) {

			$output .= $this->get_icon( $icon );

		}

		if ( 'hide' === $textpos ) {

			$output .= '<span class="screen-reader-text">' . $item->title . '</span>';
			$output .= $this->get_icon( $icon );

		} else {

			$output .= '<span class="menu-label">' . $item->title . '</span>';

		}

		if ( 'left' === $textpos ) {

			$output .= $this->get_icon( $icon );

		}

		$output .= '</a>';

		return $output;

	} // header_tabs_menu()

	/**
	 * Add an icon the menu item
	 *
	 * @link 	http://www.billerickson.net/customizing-wordpress-menus/
	 *
	 * @param 	string 		$item_output		//
	 * @param 	object 		$item				//
	 * @param 	int 		$depth 				//
	 * @param 	array 		$args 				//
	 *
	 * @return 	string 							modified menu
	 */
	public function android_menu( $item_output, $item, $depth, $args ) {

		if ( 'android-footer' !== $args->theme_location ) { return $item_output; }

		$atts 		= $this->get_attributes( $item );
		$icon 		= $this->get_icon_info( $item->classes );
		$textpos 	= $this->get_text_pos( $item->classes );

		if ( empty( $icon ) && empty( $textpos ) ) { return $item_output; }

		$output = '';

		$output .= '<a href="' . $item->url . '" class="icon-menu" ' . $atts . '>';

		if ( 'right' === $textpos ) {

			$output .= $this->get_icon( $icon );

		}

		if ( 'hide' === $textpos ) {

			$output .= '<span class="screen-reader-text">' . $item->title . '</span>';
			$output .= $this->get_icon( $icon );

		} else {

			$output .= '<span class="menu-label">' . $item->title . '</span>';

		}

		if ( 'left' === $textpos ) {

			$output .= $this->get_icon( $icon );

		}

		$output .= '</a>';

		return $output;

	} // android_menu()

	/**
	 * Add Plus ("+") expander to menus with children
	 *
	 * @param 		string 		$item_output		//
	 * @param 		object 		$item				//
	 * @param 		int 		$depth 				//
	 * @param 		array 		$args 				//
	 *
	 * @return 		string 							modified menu
	 */
	public function menu_show_hide( $item_output, $item, $depth, $args ) {

		if ( empty( $args ) || is_array( $args ) ) { return $item_output; }
		if ( 'belowslider' !== $args->theme_location ) { return $item_output; }
		if ( ! in_array( 'menu-item-has-children', $item->classes ) ) { return $item_output; }

		$atts 	= $this->get_attributes( $item );
		$output = '';

		$output .= '<a href="' . $item->url . '">';
		$output .= $item->title;
		$output .= '<span class="children">' . mervis_2016_get_svg( 'caret-down' ) . '</span>';
		$output .= '</a>';
		$output .= '<span class="show-hide flex-center">+</span>';

		return $output;

	} // menu_show_hide()

	/**
	 * Returns a string of HTML attributes for the menu item
	 *
	 * @param 	object 		$item 			The menu item object
	 * @return 	string 						A string of attributes
	 */
	public function get_attributes( $item ) {

		if ( empty( $item ) ) { return; }

		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';

		$attributes = '';

		foreach ( $atts as $attr => $value ) {

			if ( ! empty( $value ) ) {

				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';

			}

		}

		return $attributes;

	} // get_attributes()

	private function get_icon( $icon ) {

		if ( empty( $icon ) || ! is_array( $icon ) ) { return; }

		$return = '';

		if ( 'dashicons' === $icon['type'] ) {

			$return = '<span class="dashicons dashicons-' . $icon['name'] . '"></span>';

		}

		if ( 'fontawesome' === $icon['type'] ) {

			$return = '<span class="fa fa-' . $icon['name'] . '"></span>';

		}

		if ( 'svg' === $icon['type'] ) {

			$check = mervis_2016_get_svg( $icon['name'] );

			if ( ! is_null( $check ) ) {

				$return = $check;

			}

		}

		return $return;

	} // get_icon()

	private function get_icon_info( $classes ) {

		if ( empty( $classes ) ) { return; }

		$return = array();
		$checks = array( 'di-', 'fa-', 'svg-' );

		foreach ( $classes as $class ) {

			if ( stripos( $class, $checks[0] ) !== FALSE ) {

				$return['type'] = 'dashicons';
				$return['name'] = str_replace( $checks[0], '', $class );
				break;

			}

			if ( stripos( $class, $checks[1] ) !== FALSE ) {

				$return['type'] = 'fontawesome';
				$return['name'] = str_replace( $checks[1], '', $class );
				break;

			}

			if ( stripos( $class, $checks[2] ) !== FALSE ) {

				$return['type'] = 'svg';
				$return['name'] = str_replace( $checks[2], '', $class );
				break;

			}

		} // foreach

		return $return;

	} // get_icon_info()

	private function get_text_pos( $classes ) {

		if ( empty( $classes ) ) { return; }

		if ( in_array( 'no-text', $classes ) ) { return 'hide'; }
		if ( in_array( 'text-left', $classes ) ) { return 'left'; }
		if ( in_array( 'text-right', $classes ) ) { return 'right'; }

		return;

	} // get_text_pos()

} // class
