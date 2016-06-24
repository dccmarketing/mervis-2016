<?php
/**
 * Replace with Theme Name Customizer
 *
 * Contains methods for customizing the theme customization screen.
 *
 * @link 		https://codex.wordpress.org/Theme_Customization_API
 * @since 		1.0.0
 * @package  	Mervis_2016
 */
class Class_Names_Customizer {

	/**
	 * Constructor
	 */
	public function __construct() {}

	/**
	 * Registers custom panels for the Customizer
	 *
	 * @see			add_action( 'customize_register', $func )
	 * @link 		http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
	 * @since 		1.0.0
	 *
	 * @param 		WP_Customize_Manager 		$wp_customize 		Theme Customizer object.
	 */
	public function register_panels( $wp_customize ) {

		// Theme Options Panel
		$wp_customize->add_panel( 'theme_options',
			array(
				'capability'  		=> 'edit_theme_options',
				'description'  		=> esc_html__( 'Options for Replace with Theme Name', 'mervis-2016' ),
				'priority'  		=> 10,
				'theme_supports'  	=> '',
				'title'  			=> esc_html__( 'Theme Options', 'mervis-2016' ),
			)
		);

		/*
		// Theme Options Panel
		$wp_customize->add_panel( 'theme_options',
			array(
				'capability'  		=> 'edit_theme_options',
				'description'  		=> esc_html__( 'Options for Replace with Theme Name', 'mervis-2016' ),
				'priority'  		=> 10,
				'theme_supports'  	=> '',
				'title'  			=> esc_html__( 'Theme Options', 'mervis-2016' ),
			)
		);
		*/

	} // register_panels()

	/**
	 * Registers custom sections for the Customizer
	 *
	 * Existing sections:
	 *
	 * Slug 				Priority 		Title
	 *
	 * title_tagline 		20 				Site Identity
	 * colors 				40				Colors
	 * header_image 		60				Header Image
	 * background_image 	80				Background Image
	 * nav 					100 			Navigation
	 * widgets 				110 			Widgets
	 * static_front_page 	120 			Static Front Page
	 * default 				160 			all others
	 *
	 * @see			add_action( 'customize_register', $func )
	 * @link 		http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
	 * @since 		1.0.0
	 *
	 * @param 		WP_Customize_Manager 		$wp_customize 		Theme Customizer object.
	 */
	public function register_sections( $wp_customize ) {

		/*
		// New Section
		$wp_customize->add_section( 'new_section',
			array(
				'capability' 	=> 'edit_theme_options',
				'description' 	=> esc_html__( 'New Customizer Section', 'mervis-2016' ),
				'panel' 		=> 'theme_options',
				'priority' 		=> 10,
				'title' 		=> esc_html__( 'New Section', 'mervis-2016' )
			)
		);
		*/

	} // register_sections()

	/**
	 * Registers controls/fields for the Customizer
	 *
	 * Note: To enable instant preview, we have to actually write a bit of custom
	 * javascript. See live_preview() for more.
	 *
	 * Note: To use active_callbacks, don't add these to the selecting control, it apepars these conflict:
	 * 		'transport' => 'postMessage'
	 * 		$wp_customize->get_setting( 'field_name' )->transport = 'postMessage';
	 *
	 * @see			add_action( 'customize_register', $func )
	 * @link 		http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
	 * @since 		1.0.0
	 *
	 * @param 		WP_Customize_Manager 		$wp_customize 		Theme Customizer object.
	 */
	public function register_fields( $wp_customize ) {

		// Enable live preview JS for default fields
		$wp_customize->get_setting( 'blogname' )->transport 		= 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport 	= 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';



		// Site Identity Section Fields

		// Google Tag Manager Field
		$wp_customize->add_setting(
			'tag_manager',
			array(
				'default'  			=> '',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control(
			'tag_manager',
			array(
				'description' 		=> esc_html__( 'Paste in the Google Tag Manager code here. Do not include the comment tags!', 'mervis-2016' ),
				'label' 			=> esc_html__( 'Google Tag Manager', 'mervis-2016' ),
				'priority' 			=> 90,
				'section' 			=> 'title_tagline',
				'settings' 			=> 'tag_manager',
				'type' 				=> 'textarea'
			)
		);
		$wp_customize->get_setting( 'tag_manager' )->transport = 'postMessage';




		/*
		// Fields & Controls



		// Text Field
		$wp_customize->add_setting( 'text_field',
			array(
				'default'  			=> '',
				'sanitize_callback' => 'sanitize_text_field',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control( 'text_field',
			array(
				'description' 		=> esc_html__( '', 'mervis-2016' ),
				'label'  			=> esc_html__( 'Text Field', 'mervis-2016' ),
				'priority' 			=> 10,
				'section'  			=> 'new_section',
				'settings' 			=> 'text_field',
				'type' 				=> 'text'
			)
		);
		$wp_customize->get_setting( 'text_field' )->transport = 'postMessage';



		// URL Field
		$wp_customize->add_setting( 'url_field',
			array(
				'default'  			=> '',
				'sanitize_callback' => 'esc_url_raw',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control( 'url_field',
			array(
				'description' 		=> esc_html__( '', 'mervis-2016' ),
				'label' 			=> esc_html__( 'URL Field', 'mervis-2016' ),
				'priority' 			=> 10,
				'section' 			=> 'new_section',
				'settings' 			=> 'url_field',
				'type' 				=> 'url'
			)
		);
		$wp_customize->get_setting( 'url_field' )->transport = 'postMessage';



		// Email Field
		$wp_customize->add_setting( 'email_field',
			array(
				'default'  			=> '',
				'sanitize_callback' => 'sanitize_email',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control( 'email_field',
			array(
				'description' 		=> esc_html__( '', 'mervis-2016' ),
				'label' 			=> esc_html__( 'Email Field', 'mervis-2016' ),
				'priority' 			=> 10,
				'section' 			=> 'new_section',
				'settings' 			=> 'email_field',
				'type' 				=> 'email'
			)
		);
		$wp_customize->get_setting( 'email_field' )->transport = 'postMessage';

		// Date Field
		$wp_customize->add_setting( 'date_field',
			array(
				'default'  			=> '',
				'sanitize_callback' => '',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control( 'date_field',
			array(
				'description' 		=> esc_html__( '', 'mervis-2016' ),
				'label' 			=> esc_html__( 'Date Field', 'mervis-2016' ),
				'priority' 			=> 10,
				'section' 			=> 'new_section',
				'settings' 			=> 'date_field',
				'type' 				=> 'date'
			)
		);
		$wp_customize->get_setting( 'date_field' )->transport = 'postMessage';


		// Checkbox Field
		$wp_customize->add_setting( 'checkbox_field',
			array(
				'default'  			=> 'true',
				'sanitize_callback' => 'absint',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control( 'checkbox_field',
			array(
				'description' 		=> esc_html__( '', 'mervis-2016' ),
				'label' 			=> esc_html__( 'Checkbox Field', 'mervis-2016' ),
				'priority' 			=> 10,
				'section' 			=> 'new_section',
				'settings' 			=> 'checkbox_field',
				'type' 				=> 'checkbox'
			)
		);
		$wp_customize->get_setting( 'checkbox_field' )->transport = 'postMessage';




		// Password Field
		$wp_customize->add_setting( 'password_field',
			array(
				'default'  			=> '',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control( 'password_field',
			array(
				'description' 		=> esc_html__( '', 'mervis-2016' ),
				'label' 			=> esc_html__( 'Password Field', 'mervis-2016' ),
				'priority' 			=> 10,
				'section' 			=> 'new_section',
				'settings' 			=> 'password_field',
				'type' 				=> 'password'
			)
		);
		$wp_customize->get_setting( 'password_field' )->transport = 'postMessage';



		// Radio Field
		$wp_customize->add_setting( 'radio_field',
			array(
				'default'  			=> 'choice1',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control( 'radio_field',
			array(
				'choices' 			=> array(
					'choice1' 		=> esc_html__( 'Choice 1', 'mervis-2016' ),
					'choice2' 		=> esc_html__( 'Choice 2', 'mervis-2016' ),
					'choice3' 		=> esc_html__( 'Choice 3', 'mervis-2016' )
				),
				'description' 		=> esc_html__( '', 'mervis-2016' ),
				'label' 			=> esc_html__( 'Radio Field', 'mervis-2016' ),
				'priority' 			=> 10,
				'section' 			=> 'new_section',
				'settings' 			=> 'radio_field',
				'type' 				=> 'radio'
			)
		);
		$wp_customize->get_setting( 'radio_field' )->transport = 'postMessage';



		// Select Field
		$wp_customize->add_setting( 'select_field',
			array(
				'default'  			=> 'choice1',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control( 'select_field',
			array(
				'choices' 			=> array(
					'choice1' 		=> esc_html__( 'Choice 1', 'mervis-2016' ),
					'choice2' 		=> esc_html__( 'Choice 2', 'mervis-2016' ),
					'choice3' 		=> esc_html__( 'Choice 3', 'mervis-2016' )
				),
				'description' 		=> esc_html__( '', 'mervis-2016' ),
				'label' 			=> esc_html__( 'Select Field', 'mervis-2016' ),
				'priority' 			=> 10,
				'section' 			=> 'new_section',
				'settings' 			=> 'select_field',
				'type' 				=> 'select'
			)
		);
		$wp_customize->get_setting( 'select_field' )->transport = 'postMessage';



		// Textarea Field
		$wp_customize->add_setting( 'textarea_field',
			array(
				'default'  			=> '',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control( 'textarea_field',
			array(
				'description' 		=> esc_html__( '', 'mervis-2016' ),
				'label' 			=> esc_html__( 'Textarea Field', 'mervis-2016' ),
				'priority' 			=> 10,
				'section' 			=> 'new_section',
				'settings' 			=> 'textarea_field',
				'type'				=> 'textarea'
			)
		);
		$wp_customize->get_setting( 'textarea_field' )->transport = 'postMessage';



		// Range Field
		$wp_customize->add_setting( 'range_field',
			array(
				'default'  			=> '',
				'sanitize_callback' => ''
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control( 'range_field',
			array(
				'description' 		=> esc_html__( '', 'mervis-2016' ),
				'input_attrs' 		=> array(
					'class' 		=> 'range-field',
					'max' 			=> 100,
					'min' 			=> 0,
					'step' 			=> 1,
					'style' 		=> 'color: #020202'
				),
				'label' 			=> esc_html__( 'Range Field', 'mervis-2016' ),
				'priority' 			=> 10,
				'section' 			=> 'new_section',
				'settings' 			=> 'range_field',
				'type' 				=> 'range'
			)
		);
		$wp_customize->get_setting( 'range_field' )->transport = 'postMessage';



		// Page Select Field
		$wp_customize->add_setting( 'select_page_field',
			array(
				'default'  			=> '',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control( 'select_page_field',
			array(
				'description' 		=> esc_html__( '', 'mervis-2016' ),
				'label' 			=> esc_html__( 'Select Page', 'mervis-2016' ),
				'priority' 			=> 10,
				'section' 			=> 'new_section',
				'settings' 			=> 'select_page_field',
				'type' 				=> 'dropdown-pages'
			)
		);
		$wp_customize->get_setting( 'dropdown-pages' )->transport = 'postMessage';



		// Color Chooser Field
		$wp_customize->add_setting( 'color_field',
			array(
				'default'  			=> '#ffffff',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'color_field',
				array(
					'description' 	=> esc_html__( '', 'mervis-2016' ),
					'label' 		=> esc_html__( 'Color Field', 'mervis-2016' ),
					'priority' 		=> 10,
					'section' 		=> 'new_section',
					'settings' 		=> 'color_field'
				),
			)
		);
		$wp_customize->get_setting( 'color_field' )->transport = 'postMessage';



		// File Upload Field
		$wp_customize->add_setting( 'file_upload' );
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'file_upload',
				array(
					'description' 	=> esc_html__( '', 'mervis-2016' ),
					'label' 		=> esc_html__( 'File Upload', 'mervis-2016' ),
					'priority' 		=> 10,
					'section' 		=> 'new_section',
					'settings' 		=> 'file_upload'
				),
			)
		);



		// Image Upload Field
		$wp_customize->add_setting( 'image_upload',
			array(
				'default' 			=> '',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'image_upload',
				array(
					'description' 	=> esc_html__( '', 'mervis-2016' ),
					'label' 		=> esc_html__( 'Image Field', 'mervis-2016' ),
					'priority' 		=> 10,
					'section' 		=> 'new_section',
					'settings' 		=> 'image_upload'
				)
			)
		);
		$wp_customize->get_setting( 'image_upload' )->transport = 'postMessage';



		// Media Upload Field
		// Can be used for images
		// Returns the image ID, not a URL
		$wp_customize->add_setting( 'media_upload',
			array(
				'default' 			=> '',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Media_Control(
				$wp_customize,
				'media_upload',
				array(
					'description' 	=> esc_html__( '', 'mervis-2016' ),
					'label' 		=> esc_html__( 'Media Field', 'mervis-2016' ),
					'mime_type' 	=> '',
					'priority' 		=> 10,
					'section'		=> 'new_section',
					'settings' 		=> 'media_upload'
				)
			)
		);
		$wp_customize->get_setting( 'media_upload' )->transport = 'postMessage';




		// Cropped Image Field
		$wp_customize->add_setting( 'cropped_image',
			array(
				'default' 			=> '',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Cropped_Image_Control(
				$wp_customize,
				'cropped_image',
				array(
					'description' 	=> esc_html__( '', 'mervis-2016' ),
					'flex_height' 	=> '',
					'flex_width' 	=> '',
					'height' 		=> '1080',
					'priority' 		=> 10,
					'section' 		=> 'new_section',
					'settings' 		=> 'cropped_image',
					width' 			=> '1920'
				)
			)
		);
		$wp_customize->get_setting( 'cropped_image' )->transport = 'postMessage';


		// Country Select Field
		$wp_customize->add_setting( 'country',
			array(
				'default'  			=> '',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control( 'country',
			array(
				'choices' 			=> $this->country_list(),
				'description' 		=> esc_html__( '', 'mervis-2016' ),
				'label' 			=> esc_html__( 'Country', 'mervis-2016' ),
				'priority' 			=> 250,
				'section' 			=> 'contact_info',
				'settings' 			=> 'country',
				'type' 				=> 'select'
			)
		);
		$wp_customize->get_setting( 'country' )->transport = 'postMessage';


		// US States Select Field
		$wp_customize->add_setting( 'us_state',
			array(
				'default'  			=> '',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control( 'us_state',
			array(
				'choices' 			=> $this->states_list_unitedstates(),
				'description' 		=> esc_html__( '', 'mervis-2016' ),
				'label' 			=> esc_html__( 'State', 'mervis-2016' ),
				'priority' 			=> 230,
				'section' 			=> 'contact_info',
				'settings' 			=> 'us_state',
				'type' 				=> 'select'
			)
		);
		$wp_customize->get_setting( 'us_state' )->transport = 'postMessage';


		// Canadian States Select Field
		$wp_customize->add_setting( 'canada_state',
			array(
				'default'  			=> '',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control( 'canada_state',
			array(
				'choices' 			=> $this->states_list_canada(),
				'description' 		=> esc_html__( '', 'mervis-2016' ),
				'label' 			=> esc_html__( 'State', 'mervis-2016' ),
				'priority' 			=> 230,
				'section' 			=> 'contact_info',
				'settings' 			=> 'canada_state',
				'type' 				=> 'select'
			)
		);
		$wp_customize->get_setting( 'canada_state' )->transport = 'postMessage';


		// Australian States Select Field
		$wp_customize->add_setting( 'australia_state',
			array(
				'default'  			=> '',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control( 'australia_state',
			array(
				'choices' 			=> $this->states_list_australia(),
				'description' 		=> esc_html__( '', 'mervis-2016' ),
				'label' 			=> esc_html__( 'State', 'mervis-2016' ),
				'priority' 			=> 230,
				'section' 			=> 'contact_info',
				'settings' 			=> 'australia_state',
				'type' 				=> 'select'
			)
		);
		$wp_customize->get_setting( 'australia_state' )->transport = 'postMessage';


		*/

	} // register_fields()

	/**
	 * This will generate a line of CSS for use in header output. If the setting
	 * ($mod_name) has no defined value, the CSS will not be output.
	 *
	 * @access 		public
	 * @since 		1.0.0
	 *
	 * @param 		string 		$selector 		CSS selector
	 * @param 		string 		$style 			The name of the CSS *property* to modify
	 * @param 		string 		$mod_name 		The name of the 'theme_mod' option to fetch
	 * @param 		string 		$prefix 		Optional. Anything that needs to be output before the CSS property
	 * @param 		string 		$postfix 		Optional. Anything that needs to be output after the CSS property
	 * @param 		bool 		$echo 			Optional. Whether to print directly to the page (default: true).
	 *
	 * @return 		string 						Returns a single line of CSS with selectors and a property.
	 */
	public function generate_css( $selector, $style, $mod_name, $prefix = '', $postfix = '', $echo = true ) {

		$return = '';
		$mod 	= get_theme_mod( $mod_name );

		if ( ! empty( $mod ) ) {

			$return = sprintf('%s { %s:%s; }',
				$selector,
				$style,
				$prefix . $mod . $postfix
			);

			if ( $echo ) {

				echo $return;

			}

		}

		return $return;

	} // generate_css()

	/**
	 * This will output the custom WordPress settings to the live theme's WP head.
	 *
	 * Used by hook: 'wp_head'
	 *
	 * @access 		public
	 * @see 		add_action( 'wp_head', $func )
	 * @since 		1.0.0
	 */
	public function header_output() {

		?><!-- Customizer CSS -->
		<style type="text/css"><?php

			// pattern:
			// $this->generate_css( 'selector', 'style', 'mod_name', 'prefix', 'postfix', true );
			//
			// background-image example:
			// $this->generate_css( '.class', 'background-image', 'background_image_example', 'url(', ')' );


		?></style><!-- Customizer CSS --><?php

		/**
		 * Hides all but the first Soliloquy slide while using Customizer previewer.
		 */
		if ( is_customize_preview() ) {

			?><style type="text/css">

				li.soliloquy-item:not(:first-child) {
					display: none !important;
				}

			</style><!-- Customizer CSS --><?php

		}

	} // header_output()

	/**
	 * Returns TRUE based on which link type is selected, otherwise FALSE
	 *
	 * @param 	object 		$control 			The control object
	 * @return 	bool 							TRUE if conditions are met, otherwise FALSE
	 */
	public function states_of_country_callback( $control ) {

		$country_setting = $control->manager->get_setting('country')->value();

		if ( 'us_state' === $control->id && 'US' === $country_setting ) { return true; }
		if ( 'canada_state' === $control->id && 'CA' === $country_setting ) { return true; }
		if ( 'australia_state' === $control->id && 'AU' === $country_setting ) { return true; }
		if ( 'default_state' === $control->id && ! $this->custom_countries( $country_setting ) ) { return true; }

		return false;

	} // states_of_country_callback()

	/**
	 * Returns true if a country has a custom select menu
	 *
	 * @param 		string 		$country 			The country code to check
	 *
	 * @return 		bool 							TRUE if the code is in the array, FALSE otherwise
	 */
	public function custom_countries( $country ) {

		$countries = array( 'US', 'CA', 'AU' );

		return in_array( $country, $countries );

	} // custom_countries()

	/**
	 * Returns an array of countries or a country name.
	 *
	 * @param 		string 		$country 		Country code to return (optional)
	 *
	 * @return 		array|string 				Array of countries or a single country name
	 */
	public function country_list( $country = '' ) {

		$countries = array();

		$countries['AF'] = esc_html__( 'Afghanistan (‫افغانستان‬‎)', 'mervis-2016' );
		$countries['AX'] = esc_html__( 'Åland Islands (Åland)', 'mervis-2016' );
		$countries['AL'] = esc_html__( 'Albania (Shqipëri)', 'mervis-2016' );
		$countries['DZ'] = esc_html__( 'Algeria (‫الجزائر‬‎)', 'mervis-2016' );
		$countries['AS'] = esc_html__( 'American Samoa', 'mervis-2016' );
		$countries['AD'] = esc_html__( 'Andorra', 'mervis-2016' );
		$countries['AO'] = esc_html__( 'Angola', 'mervis-2016' );
		$countries['AI'] = esc_html__( 'Anguilla', 'mervis-2016' );
		$countries['AQ'] = esc_html__( 'Antarctica', 'mervis-2016' );
		$countries['AG'] = esc_html__( 'Antigua and Barbuda', 'mervis-2016' );
		$countries['AR'] = esc_html__( 'Argentina', 'mervis-2016' );
		$countries['AM'] = esc_html__( 'Armenia (Հայաստան)', 'mervis-2016' );
		$countries['AW'] = esc_html__( 'Aruba', 'mervis-2016' );
		$countries['AC'] = esc_html__( 'Ascension Island', 'mervis-2016' );
		$countries['AU'] = esc_html__( 'Australia', 'mervis-2016' );
		$countries['AT'] = esc_html__( 'Austria (Österreich)', 'mervis-2016' );
		$countries['AZ'] = esc_html__( 'Azerbaijan (Azərbaycan)', 'mervis-2016' );
		$countries['BS'] = esc_html__( 'Bahamas', 'mervis-2016' );
		$countries['BH'] = esc_html__( 'Bahrain (‫البحرين‬‎)', 'mervis-2016' );
		$countries['BD'] = esc_html__( 'Bangladesh (বাংলাদেশ)', 'mervis-2016' );
		$countries['BB'] = esc_html__( 'Barbados', 'mervis-2016' );
		$countries['BY'] = esc_html__( 'Belarus (Беларусь)', 'mervis-2016' );
		$countries['BE'] = esc_html__( 'Belgium (België)', 'mervis-2016' );
		$countries['BZ'] = esc_html__( 'Belize', 'mervis-2016' );
		$countries['BJ'] = esc_html__( 'Benin (Bénin)', 'mervis-2016' );
		$countries['BM'] = esc_html__( 'Bermuda', 'mervis-2016' );
		$countries['BT'] = esc_html__( 'Bhutan (འབྲུག)', 'mervis-2016' );
		$countries['BO'] = esc_html__( 'Bolivia', 'mervis-2016' );
		$countries['BA'] = esc_html__( 'Bosnia and Herzegovina (Босна и Херцеговина)', 'mervis-2016' );
		$countries['BW'] = esc_html__( 'Botswana', 'mervis-2016' );
		$countries['BV'] = esc_html__( 'Bouvet Island', 'mervis-2016' );
		$countries['BR'] = esc_html__( 'Brazil (Brasil)', 'mervis-2016' );
		$countries['IO'] = esc_html__( 'British Indian Ocean Territory', 'mervis-2016' );
		$countries['VG'] = esc_html__( 'British Virgin Islands', 'mervis-2016' );
		$countries['BN'] = esc_html__( 'Brunei', 'mervis-2016' );
		$countries['BG'] = esc_html__( 'Bulgaria (България)', 'mervis-2016' );
		$countries['BF'] = esc_html__( 'Burkina Faso', 'mervis-2016' );
		$countries['BI'] = esc_html__( 'Burundi (Uburundi)', 'mervis-2016' );
		$countries['KH'] = esc_html__( 'Cambodia (កម្ពុជា)', 'mervis-2016' );
		$countries['CM'] = esc_html__( 'Cameroon (Cameroun)', 'mervis-2016' );
		$countries['CA'] = esc_html__( 'Canada', 'mervis-2016' );
		$countries['IC'] = esc_html__( 'Canary Islands (islas Canarias)', 'mervis-2016' );
		$countries['CV'] = esc_html__( 'Cape Verde (Kabu Verdi)', 'mervis-2016' );
		$countries['BQ'] = esc_html__( 'Caribbean Netherlands', 'mervis-2016' );
		$countries['KY'] = esc_html__( 'Cayman Islands', 'mervis-2016' );
		$countries['CF'] = esc_html__( 'Central African Republic (République centrafricaine)', 'mervis-2016' );
		$countries['EA'] = esc_html__( 'Ceuta and Melilla (Ceuta y Melilla)', 'mervis-2016' );
		$countries['TD'] = esc_html__( 'Chad (Tchad)', 'mervis-2016' );
		$countries['CL'] = esc_html__( 'Chile', 'mervis-2016' );
		$countries['CN'] = esc_html__( 'China (中国)', 'mervis-2016' );
		$countries['CX'] = esc_html__( 'Christmas Island', 'mervis-2016' );
		$countries['CP'] = esc_html__( 'Clipperton Island', 'mervis-2016' );
		$countries['CC'] = esc_html__( 'Cocos (Keeling) Islands (Kepulauan Cocos (Keeling))', 'mervis-2016' );
		$countries['CO'] = esc_html__( 'Colombia', 'mervis-2016' );
		$countries['KM'] = esc_html__( 'Comoros (‫جزر القمر‬‎)', 'mervis-2016' );
		$countries['CD'] = esc_html__( 'Congo (DRC) (Jamhuri ya Kidemokrasia ya Kongo)', 'mervis-2016' );
		$countries['CG'] = esc_html__( 'Congo (Republic) (Congo-Brazzaville)', 'mervis-2016' );
		$countries['CK'] = esc_html__( 'Cook Islands', 'mervis-2016' );
		$countries['CR'] = esc_html__( 'Costa Rica', 'mervis-2016' );
		$countries['CI'] = esc_html__( 'Côte d’Ivoire', 'mervis-2016' );
		$countries['HR'] = esc_html__( 'Croatia (Hrvatska)', 'mervis-2016' );
		$countries['CU'] = esc_html__( 'Cuba', 'mervis-2016' );
		$countries['CW'] = esc_html__( 'Curaçao', 'mervis-2016' );
		$countries['CY'] = esc_html__( 'Cyprus (Κύπρος)', 'mervis-2016' );
		$countries['CZ'] = esc_html__( 'Czech Republic (Česká republika)', 'mervis-2016' );
		$countries['DK'] = esc_html__( 'Denmark (Danmark)', 'mervis-2016' );
		$countries['DG'] = esc_html__( 'Diego Garcia', 'mervis-2016' );
		$countries['DJ'] = esc_html__( 'Djibouti', 'mervis-2016' );
		$countries['DM'] = esc_html__( 'Dominica', 'mervis-2016' );
		$countries['DO'] = esc_html__( 'Dominican Republic (República Dominicana)', 'mervis-2016' );
		$countries['EC'] = esc_html__( 'Ecuador', 'mervis-2016' );
		$countries['EG'] = esc_html__( 'Egypt (‫مصر‬‎)', 'mervis-2016' );
		$countries['SV'] = esc_html__( 'El Salvador', 'mervis-2016' );
		$countries['GQ'] = esc_html__( 'Equatorial Guinea (Guinea Ecuatorial)', 'mervis-2016' );
		$countries['ER'] = esc_html__( 'Eritrea', 'mervis-2016' );
		$countries['EE'] = esc_html__( 'Estonia (Eesti)', 'mervis-2016' );
		$countries['ET'] = esc_html__( 'Ethiopia', 'mervis-2016' );
		$countries['FK'] = esc_html__( 'Falkland Islands (Islas Malvinas)', 'mervis-2016' );
		$countries['FO'] = esc_html__( 'Faroe Islands (Føroyar)', 'mervis-2016' );
		$countries['FJ'] = esc_html__( 'Fiji', 'mervis-2016' );
		$countries['FI'] = esc_html__( 'Finland (Suomi)', 'mervis-2016' );
		$countries['FR'] = esc_html__( 'France', 'mervis-2016' );
		$countries['GF'] = esc_html__( 'French Guiana (Guyane française)', 'mervis-2016' );
		$countries['PF'] = esc_html__( 'French Polynesia (Polynésie française)', 'mervis-2016' );
		$countries['TF'] = esc_html__( 'French Southern Territories (Terres australes françaises)', 'mervis-2016' );
		$countries['GA'] = esc_html__( 'Gabon', 'mervis-2016' );
		$countries['GM'] = esc_html__( 'Gambia', 'mervis-2016' );
		$countries['GE'] = esc_html__( 'Georgia (საქართველო)', 'mervis-2016' );
		$countries['DE'] = esc_html__( 'Germany (Deutschland)', 'mervis-2016' );
		$countries['GH'] = esc_html__( 'Ghana (Gaana)', 'mervis-2016' );
		$countries['GI'] = esc_html__( 'Gibraltar', 'mervis-2016' );
		$countries['GR'] = esc_html__( 'Greece (Ελλάδα)', 'mervis-2016' );
		$countries['GL'] = esc_html__( 'Greenland (Kalaallit Nunaat)', 'mervis-2016' );
		$countries['GD'] = esc_html__( 'Grenada', 'mervis-2016' );
		$countries['GP'] = esc_html__( 'Guadeloupe', 'mervis-2016' );
		$countries['GU'] = esc_html__( 'Guam', 'mervis-2016' );
		$countries['GT'] = esc_html__( 'Guatemala', 'mervis-2016' );
		$countries['GG'] = esc_html__( 'Guernsey', 'mervis-2016' );
		$countries['GN'] = esc_html__( 'Guinea (Guinée)', 'mervis-2016' );
		$countries['GW'] = esc_html__( 'Guinea-Bissau (Guiné Bissau)', 'mervis-2016' );
		$countries['GY'] = esc_html__( 'Guyana', 'mervis-2016' );
		$countries['HT'] = esc_html__( 'Haiti', 'mervis-2016' );
		$countries['HM'] = esc_html__( 'Heard & McDonald Islands', 'mervis-2016' );
		$countries['HN'] = esc_html__( 'Honduras', 'mervis-2016' );
		$countries['HK'] = esc_html__( 'Hong Kong (香港)', 'mervis-2016' );
		$countries['HU'] = esc_html__( 'Hungary (Magyarország)', 'mervis-2016' );
		$countries['IS'] = esc_html__( 'Iceland (Ísland)', 'mervis-2016' );
		$countries['IN'] = esc_html__( 'India (भारत)', 'mervis-2016' );
		$countries['ID'] = esc_html__( 'Indonesia', 'mervis-2016' );
		$countries['IR'] = esc_html__( 'Iran (‫ایران‬‎)', 'mervis-2016' );
		$countries['IQ'] = esc_html__( 'Iraq (‫العراق‬‎)', 'mervis-2016' );
		$countries['IE'] = esc_html__( 'Ireland', 'mervis-2016' );
		$countries['IM'] = esc_html__( 'Isle of Man', 'mervis-2016' );
		$countries['IL'] = esc_html__( 'Israel (‫ישראל‬‎)', 'mervis-2016' );
		$countries['IT'] = esc_html__( 'Italy (Italia)', 'mervis-2016' );
		$countries['JM'] = esc_html__( 'Jamaica', 'mervis-2016' );
		$countries['JP'] = esc_html__( 'Japan (日本)', 'mervis-2016' );
		$countries['JE'] = esc_html__( 'Jersey', 'mervis-2016' );
		$countries['JO'] = esc_html__( 'Jordan (‫الأردن‬‎)', 'mervis-2016' );
		$countries['KZ'] = esc_html__( 'Kazakhstan (Казахстан)', 'mervis-2016' );
		$countries['KE'] = esc_html__( 'Kenya', 'mervis-2016' );
		$countries['KI'] = esc_html__( 'Kiribati', 'mervis-2016' );
		$countries['XK'] = esc_html__( 'Kosovo (Kosovë)', 'mervis-2016' );
		$countries['KW'] = esc_html__( 'Kuwait (‫الكويت‬‎)', 'mervis-2016' );
		$countries['KG'] = esc_html__( 'Kyrgyzstan (Кыргызстан)', 'mervis-2016' );
		$countries['LA'] = esc_html__( 'Laos (ລາວ)', 'mervis-2016' );
		$countries['LV'] = esc_html__( 'Latvia (Latvija)', 'mervis-2016' );
		$countries['LB'] = esc_html__( 'Lebanon (‫لبنان‬‎)', 'mervis-2016' );
		$countries['LS'] = esc_html__( 'Lesotho', 'mervis-2016' );
		$countries['LR'] = esc_html__( 'Liberia', 'mervis-2016' );
		$countries['LY'] = esc_html__( 'Libya (‫ليبيا‬‎)', 'mervis-2016' );
		$countries['LI'] = esc_html__( 'Liechtenstein', 'mervis-2016' );
		$countries['LT'] = esc_html__( 'Lithuania (Lietuva)', 'mervis-2016' );
		$countries['LU'] = esc_html__( 'Luxembourg', 'mervis-2016' );
		$countries['MO'] = esc_html__( 'Macau (澳門)', 'mervis-2016' );
		$countries['MK'] = esc_html__( 'Macedonia (FYROM) (Македонија)', 'mervis-2016' );
		$countries['MG'] = esc_html__( 'Madagascar (Madagasikara)', 'mervis-2016' );
		$countries['MW'] = esc_html__( 'Malawi', 'mervis-2016' );
		$countries['MY'] = esc_html__( 'Malaysia', 'mervis-2016' );
		$countries['MV'] = esc_html__( 'Maldives', 'mervis-2016' );
		$countries['ML'] = esc_html__( 'Mali', 'mervis-2016' );
		$countries['MT'] = esc_html__( 'Malta', 'mervis-2016' );
		$countries['MH'] = esc_html__( 'Marshall Islands', 'mervis-2016' );
		$countries['MQ'] = esc_html__( 'Martinique', 'mervis-2016' );
		$countries['MR'] = esc_html__( 'Mauritania (‫موريتانيا‬‎)', 'mervis-2016' );
		$countries['MU'] = esc_html__( 'Mauritius (Moris)', 'mervis-2016' );
		$countries['YT'] = esc_html__( 'Mayotte', 'mervis-2016' );
		$countries['MX'] = esc_html__( 'Mexico (México)', 'mervis-2016' );
		$countries['FM'] = esc_html__( 'Micronesia', 'mervis-2016' );
		$countries['MD'] = esc_html__( 'Moldova (Republica Moldova)', 'mervis-2016' );
		$countries['MC'] = esc_html__( 'Monaco', 'mervis-2016' );
		$countries['MN'] = esc_html__( 'Mongolia (Монгол)', 'mervis-2016' );
		$countries['ME'] = esc_html__( 'Montenegro (Crna Gora)', 'mervis-2016' );
		$countries['MS'] = esc_html__( 'Montserrat', 'mervis-2016' );
		$countries['MA'] = esc_html__( 'Morocco (‫المغرب‬‎)', 'mervis-2016' );
		$countries['MZ'] = esc_html__( 'Mozambique (Moçambique)', 'mervis-2016' );
		$countries['MM'] = esc_html__( 'Myanmar (Burma) (မြန်မာ)', 'mervis-2016' );
		$countries['NA'] = esc_html__( 'Namibia (Namibië)', 'mervis-2016' );
		$countries['NR'] = esc_html__( 'Nauru', 'mervis-2016' );
		$countries['NP'] = esc_html__( 'Nepal (नेपाल)', 'mervis-2016' );
		$countries['NL'] = esc_html__( 'Netherlands (Nederland)', 'mervis-2016' );
		$countries['NC'] = esc_html__( 'New Caledonia (Nouvelle-Calédonie)', 'mervis-2016' );
		$countries['NZ'] = esc_html__( 'New Zealand', 'mervis-2016' );
		$countries['NI'] = esc_html__( 'Nicaragua', 'mervis-2016' );
		$countries['NE'] = esc_html__( 'Niger (Nijar)', 'mervis-2016' );
		$countries['NG'] = esc_html__( 'Nigeria', 'mervis-2016' );
		$countries['NU'] = esc_html__( 'Niue', 'mervis-2016' );
		$countries['NF'] = esc_html__( 'Norfolk Island', 'mervis-2016' );
		$countries['MP'] = esc_html__( 'Northern Mariana Islands', 'mervis-2016' );
		$countries['KP'] = esc_html__( 'North Korea (조선 민주주의 인민 공화국)', 'mervis-2016' );
		$countries['NO'] = esc_html__( 'Norway (Norge)', 'mervis-2016' );
		$countries['OM'] = esc_html__( 'Oman (‫عُمان‬‎)', 'mervis-2016' );
		$countries['PK'] = esc_html__( 'Pakistan (‫پاکستان‬‎)', 'mervis-2016' );
		$countries['PW'] = esc_html__( 'Palau', 'mervis-2016' );
		$countries['PS'] = esc_html__( 'Palestine (‫فلسطين‬‎)', 'mervis-2016' );
		$countries['PA'] = esc_html__( 'Panama (Panamá)', 'mervis-2016' );
		$countries['PG'] = esc_html__( 'Papua New Guinea', 'mervis-2016' );
		$countries['PY'] = esc_html__( 'Paraguay', 'mervis-2016' );
		$countries['PE'] = esc_html__( 'Peru (Perú)', 'mervis-2016' );
		$countries['PH'] = esc_html__( 'Philippines', 'mervis-2016' );
		$countries['PN'] = esc_html__( 'Pitcairn Islands', 'mervis-2016' );
		$countries['PL'] = esc_html__( 'Poland (Polska)', 'mervis-2016' );
		$countries['PT'] = esc_html__( 'Portugal', 'mervis-2016' );
		$countries['PR'] = esc_html__( 'Puerto Rico', 'mervis-2016' );
		$countries['QA'] = esc_html__( 'Qatar (‫قطر‬‎)', 'mervis-2016' );
		$countries['RE'] = esc_html__( 'Réunion (La Réunion)', 'mervis-2016' );
		$countries['RO'] = esc_html__( 'Romania (România)', 'mervis-2016' );
		$countries['RU'] = esc_html__( 'Russia (Россия)', 'mervis-2016' );
		$countries['RW'] = esc_html__( 'Rwanda', 'mervis-2016' );
		$countries['BL'] = esc_html__( 'Saint Barthélemy (Saint-Barthélemy)', 'mervis-2016' );
		$countries['SH'] = esc_html__( 'Saint Helena', 'mervis-2016' );
		$countries['KN'] = esc_html__( 'Saint Kitts and Nevis', 'mervis-2016' );
		$countries['LC'] = esc_html__( 'Saint Lucia', 'mervis-2016' );
		$countries['MF'] = esc_html__( 'Saint Martin (Saint-Martin (partie française))', 'mervis-2016' );
		$countries['PM'] = esc_html__( 'Saint Pierre and Miquelon (Saint-Pierre-et-Miquelon)', 'mervis-2016' );
		$countries['WS'] = esc_html__( 'Samoa', 'mervis-2016' );
		$countries['SM'] = esc_html__( 'San Marino', 'mervis-2016' );
		$countries['ST'] = esc_html__( 'São Tomé and Príncipe (São Tomé e Príncipe)', 'mervis-2016' );
		$countries['SA'] = esc_html__( 'Saudi Arabia (‫المملكة العربية السعودية‬‎)', 'mervis-2016' );
		$countries['SN'] = esc_html__( 'Senegal (Sénégal)', 'mervis-2016' );
		$countries['RS'] = esc_html__( 'Serbia (Србија)', 'mervis-2016' );
		$countries['SC'] = esc_html__( 'Seychelles', 'mervis-2016' );
		$countries['SL'] = esc_html__( 'Sierra Leone', 'mervis-2016' );
		$countries['SG'] = esc_html__( 'Singapore', 'mervis-2016' );
		$countries['SX'] = esc_html__( 'Sint Maarten', 'mervis-2016' );
		$countries['SK'] = esc_html__( 'Slovakia (Slovensko)', 'mervis-2016' );
		$countries['SI'] = esc_html__( 'Slovenia (Slovenija)', 'mervis-2016' );
		$countries['SB'] = esc_html__( 'Solomon Islands', 'mervis-2016' );
		$countries['SO'] = esc_html__( 'Somalia (Soomaaliya)', 'mervis-2016' );
		$countries['ZA'] = esc_html__( 'South Africa', 'mervis-2016' );
		$countries['GS'] = esc_html__( 'South Georgia & South Sandwich Islands', 'mervis-2016' );
		$countries['KR'] = esc_html__( 'South Korea (대한민국)', 'mervis-2016' );
		$countries['SS'] = esc_html__( 'South Sudan (‫جنوب السودان‬‎)', 'mervis-2016' );
		$countries['ES'] = esc_html__( 'Spain (España)', 'mervis-2016' );
		$countries['LK'] = esc_html__( 'Sri Lanka (ශ්‍රී ලංකාව)', 'mervis-2016' );
		$countries['VC'] = esc_html__( 'St. Vincent & Grenadines', 'mervis-2016' );
		$countries['SD'] = esc_html__( 'Sudan (‫السودان‬‎)', 'mervis-2016' );
		$countries['SR'] = esc_html__( 'Suriname', 'mervis-2016' );
		$countries['SJ'] = esc_html__( 'Svalbard and Jan Mayen (Svalbard og Jan Mayen)', 'mervis-2016' );
		$countries['SZ'] = esc_html__( 'Swaziland', 'mervis-2016' );
		$countries['SE'] = esc_html__( 'Sweden (Sverige)', 'mervis-2016' );
		$countries['CH'] = esc_html__( 'Switzerland (Schweiz)', 'mervis-2016' );
		$countries['SY'] = esc_html__( 'Syria (‫سوريا‬‎)', 'mervis-2016' );
		$countries['TW'] = esc_html__( 'Taiwan (台灣)', 'mervis-2016' );
		$countries['TJ'] = esc_html__( 'Tajikistan', 'mervis-2016' );
		$countries['TZ'] = esc_html__( 'Tanzania', 'mervis-2016' );
		$countries['TH'] = esc_html__( 'Thailand (ไทย)', 'mervis-2016' );
		$countries['TL'] = esc_html__( 'Timor-Leste', 'mervis-2016' );
		$countries['TG'] = esc_html__( 'Togo', 'mervis-2016' );
		$countries['TK'] = esc_html__( 'Tokelau', 'mervis-2016' );
		$countries['TO'] = esc_html__( 'Tonga', 'mervis-2016' );
		$countries['TT'] = esc_html__( 'Trinidad and Tobago', 'mervis-2016' );
		$countries['TA'] = esc_html__( 'Tristan da Cunha', 'mervis-2016' );
		$countries['TN'] = esc_html__( 'Tunisia (‫تونس‬‎)', 'mervis-2016' );
		$countries['TR'] = esc_html__( 'Turkey (Türkiye)', 'mervis-2016' );
		$countries['TM'] = esc_html__( 'Turkmenistan', 'mervis-2016' );
		$countries['TC'] = esc_html__( 'Turks and Caicos Islands', 'mervis-2016' );
		$countries['TV'] = esc_html__( 'Tuvalu', 'mervis-2016' );
		$countries['UM'] = esc_html__( 'U.S. Outlying Islands', 'mervis-2016' );
		$countries['VI'] = esc_html__( 'U.S. Virgin Islands', 'mervis-2016' );
		$countries['UG'] = esc_html__( 'Uganda', 'mervis-2016' );
		$countries['UA'] = esc_html__( 'Ukraine (Україна)', 'mervis-2016' );
		$countries['AE'] = esc_html__( 'United Arab Emirates (‫الإمارات العربية المتحدة‬‎)', 'mervis-2016' );
		$countries['GB'] = esc_html__( 'United Kingdom', 'mervis-2016' );
		$countries['US'] = esc_html__( 'United States', 'mervis-2016' );
		$countries['UY'] = esc_html__( 'Uruguay', 'mervis-2016' );
		$countries['UZ'] = esc_html__( 'Uzbekistan (Oʻzbekiston)', 'mervis-2016' );
		$countries['VU'] = esc_html__( 'Vanuatu', 'mervis-2016' );
		$countries['VA'] = esc_html__( 'Vatican City (Città del Vaticano)', 'mervis-2016' );
		$countries['VE'] = esc_html__( 'Venezuela', 'mervis-2016' );
		$countries['VN'] = esc_html__( 'Vietnam (Việt Nam)', 'mervis-2016' );
		$countries['WF'] = esc_html__( 'Wallis and Futuna', 'mervis-2016' );
		$countries['EH'] = esc_html__( 'Western Sahara (‫الصحراء الغربية‬‎)', 'mervis-2016' );
		$countries['YE'] = esc_html__( 'Yemen (‫اليمن‬‎)', 'mervis-2016' );
		$countries['ZM'] = esc_html__( 'Zambia', 'mervis-2016' );
		$countries['ZW'] = esc_html__( 'Zimbabwe', 'mervis-2016' );

		if ( ! empty( $country ) ) {

			return $countries[$country];

		}

		return $countries;

	} // country_list()

	/**
	 * Loads files for Custom Controls.
	 */
	public function load_customize_controls() {

		$files[] = 'control-editor.php';
		$files[] = 'control-layout-picker.php';
		$files[] = 'control-multiple-checkboxes.php';
		$files[] = 'control-select-category.php';
		$files[] = 'control-select-menu.php';
		$files[] = 'control-select-post.php';
		$files[] = 'control-select-post-type.php';
		//$files[] = 'control-select-recent-post.php';
		$files[] = 'control-select-tag.php';
		$files[] = 'control-select-taxonomy.php';
		$files[] = 'control-select-user.php';

		foreach ( $files as $file ) {

			require_once( trailingslashit( get_template_directory() ) . 'inc/customizer/' . $file );

		}

	} // load_customize_controls()

	/**
	 * Returns an array of the Australian states and Territories.
	 * The optional parameters allows for returning just one state.
	 *
	 * @param 		string 		$state 		The state to return.
	 * @return 		array 					An array containing states.
	 */
	private function states_list_australia( $state = '' ) {

		$states = array();

		$states['ACT'] = esc_html__( 'Australian Capital Territory', 'mervis-2016' );
		$states['NSW'] = esc_html__( 'New South Wales', 'mervis-2016' );
		$states['NT' ] = esc_html__( 'Northern Territory', 'mervis-2016' );
		$states['QLD'] = esc_html__( 'Queensland', 'mervis-2016' );
		$states['SA' ] = esc_html__( 'South Australia', 'mervis-2016' );
		$states['TAS'] = esc_html__( 'Tasmania', 'mervis-2016' );
		$states['VIC'] = esc_html__( 'Victoria', 'mervis-2016' );
		$states['WA' ] = esc_html__( 'Western Australia', 'mervis-2016' );

		if ( ! empty( $state ) ) {

			return $states[$state];

		}

		return $states;

	} // states_list_australia()



	/**
	 * Returns an array of the Canadian states and Territories.
	 * The optional parameters allows for returning just one state.
	 *
	 * @param 		string 		$state 		The state to return.
	 * @return 		array 					An array containing states.
	 */
	private function states_list_canada( $state = '' ) {

		$states = array();

		$states['AB'] = esc_html__( 'Alberta', 'mervis-2016' );
		$states['BC'] = esc_html__( 'British Columbia', 'mervis-2016' );
		$states['MB'] = esc_html__( 'Manitoba', 'mervis-2016' );
		$states['NB'] = esc_html__( 'New Brunswick', 'mervis-2016' );
		$states['NL'] = esc_html__( 'Newfoundland and Labrador', 'mervis-2016' );
		$states['NT'] = esc_html__( 'Northwest Territories', 'mervis-2016' );
		$states['NS'] = esc_html__( 'Nova Scotia', 'mervis-2016' );
		$states['NU'] = esc_html__( 'Nunavut', 'mervis-2016' );
		$states['ON'] = esc_html__( 'Ontario', 'mervis-2016' );
		$states['PE'] = esc_html__( 'Prince Edward Island', 'mervis-2016' );
		$states['QC'] = esc_html__( 'Quebec', 'mervis-2016' );
		$states['SK'] = esc_html__( 'Saskatchewan', 'mervis-2016' );
		$states['YT'] = esc_html__( 'Yukon', 'mervis-2016' );

		if ( ! empty( $state ) ) {

			return $states[$state];

		}

		return $states;

	} // states_list_canada()

	/**
	 * Returns an array of the US states and Territories.
	 * The optional parameters allows for returning just one state.
	 *
	 * @param 		string 		$state 		The state to return.
	 * @return 		array 					An array containing states.
	 */
	private function states_list_unitedstates( $state = '' ) {

		$states = array();

		$states['AL'] = esc_html__( 'Alabama', 'mervis-2016' );
		$states['AK'] = esc_html__( 'Alaska', 'mervis-2016' );
		$states['AZ'] = esc_html__( 'Arizona', 'mervis-2016' );
		$states['AR'] = esc_html__( 'Arkansas', 'mervis-2016' );
		$states['CA'] = esc_html__( 'California', 'mervis-2016' );
		$states['CO'] = esc_html__( 'Colorado', 'mervis-2016' );
		$states['CT'] = esc_html__( 'Connecticut', 'mervis-2016' );
		$states['DE'] = esc_html__( 'Delaware', 'mervis-2016' );
		$states['DC'] = esc_html__( 'District of Columbia', 'mervis-2016' );
		$states['FL'] = esc_html__( 'Florida', 'mervis-2016' );
		$states['GA'] = esc_html__( 'Georgia', 'mervis-2016' );
		$states['HI'] = esc_html__( 'Hawaii', 'mervis-2016' );
		$states['ID'] = esc_html__( 'Idaho', 'mervis-2016' );
		$states['IL'] = esc_html__( 'Illinois', 'mervis-2016' );
		$states['IN'] = esc_html__( 'Indiana', 'mervis-2016' );
		$states['IA'] = esc_html__( 'Iowa', 'mervis-2016' );
		$states['KS'] = esc_html__( 'Kansas', 'mervis-2016' );
		$states['KY'] = esc_html__( 'Kentucky', 'mervis-2016' );
		$states['LA'] = esc_html__( 'Louisiana', 'mervis-2016' );
		$states['ME'] = esc_html__( 'Maine', 'mervis-2016' );
		$states['MD'] = esc_html__( 'Maryland', 'mervis-2016' );
		$states['MA'] = esc_html__( 'Massachusetts', 'mervis-2016' );
		$states['MI'] = esc_html__( 'Michigan', 'mervis-2016' );
		$states['MN'] = esc_html__( 'Minnesota', 'mervis-2016' );
		$states['MS'] = esc_html__( 'Mississippi', 'mervis-2016' );
		$states['MO'] = esc_html__( 'Missouri', 'mervis-2016' );
		$states['MT'] = esc_html__( 'Montana', 'mervis-2016' );
		$states['NE'] = esc_html__( 'Nebraska', 'mervis-2016' );
		$states['NV'] = esc_html__( 'Nevada', 'mervis-2016' );
		$states['NH'] = esc_html__( 'New Hampshire', 'mervis-2016' );
		$states['NJ'] = esc_html__( 'New Jersey', 'mervis-2016' );
		$states['NM'] = esc_html__( 'New Mexico', 'mervis-2016' );
		$states['NY'] = esc_html__( 'New York', 'mervis-2016' );
		$states['NC'] = esc_html__( 'North Carolina', 'mervis-2016' );
		$states['ND'] = esc_html__( 'North Dakota', 'mervis-2016' );
		$states['OH'] = esc_html__( 'Ohio', 'mervis-2016' );
		$states['OK'] = esc_html__( 'Oklahoma', 'mervis-2016' );
		$states['OR'] = esc_html__( 'Oregon', 'mervis-2016' );
		$states['PA'] = esc_html__( 'Pennsylvania', 'mervis-2016' );
		$states['RI'] = esc_html__( 'Rhode Island', 'mervis-2016' );
		$states['SC'] = esc_html__( 'South Carolina', 'mervis-2016' );
		$states['SD'] = esc_html__( 'South Dakota', 'mervis-2016' );
		$states['TN'] = esc_html__( 'Tennessee', 'mervis-2016' );
		$states['TX'] = esc_html__( 'Texas', 'mervis-2016' );
		$states['UT'] = esc_html__( 'Utah', 'mervis-2016' );
		$states['VT'] = esc_html__( 'Vermont', 'mervis-2016' );
		$states['VA'] = esc_html__( 'Virginia', 'mervis-2016' );
		$states['WA'] = esc_html__( 'Washington', 'mervis-2016' );
		$states['WV'] = esc_html__( 'West Virginia', 'mervis-2016' );
		$states['WI'] = esc_html__( 'Wisconsin', 'mervis-2016' );
		$states['WY'] = esc_html__( 'Wyoming', 'mervis-2016' );
		$states['AS'] = esc_html__( 'American Samoa', 'mervis-2016' );
		$states['AA'] = esc_html__( 'Armed Forces America (except Canada)', 'mervis-2016' );
		$states['AE'] = esc_html__( 'Armed Forces Africa/Canada/Europe/Middle East', 'mervis-2016' );
		$states['AP'] = esc_html__( 'Armed Forces Pacific', 'mervis-2016' );
		$states['FM'] = esc_html__( 'Federated States of Micronesia', 'mervis-2016' );
		$states['GU'] = esc_html__( 'Guam', 'mervis-2016' );
		$states['MH'] = esc_html__( 'Marshall Islands', 'mervis-2016' );
		$states['MP'] = esc_html__( 'Northern Mariana Islands', 'mervis-2016' );
		$states['PR'] = esc_html__( 'Puerto Rico', 'mervis-2016' );
		$states['PW'] = esc_html__( 'Palau', 'mervis-2016' );
		$states['VI'] = esc_html__( 'Virgin Islands', 'mervis-2016' );

		if ( ! empty( $state ) ) {

			return $states[$state];

		}

		return $states;

	} // states_list_unitedstates()

} // class
