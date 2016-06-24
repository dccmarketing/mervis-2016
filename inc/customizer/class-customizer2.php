<?php
/**
 * Replace with Theme Name Customizer
 *
 * Contains methods for customizing the theme customization screen.
 *
 * @link 		https://codex.wordpress.org/Theme_Customization_API
 * @since 		1.0.0
 * @package  	DocBlock
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
		$panel = array();
		$panel['capability'] 		= 'edit_theme_options';
		$panel['description'] 		= esc_html__( 'Options for Replace with Theme Name', 'text-domain' );
		$panel['priority'] 			= 10;
		$panel['theme_supports'] 	= '';
		$panel['title'] 			= esc_html__( 'Theme Options', 'text-domain' );

		$wp_customize->add_panel( 'theme_options', $panel );

		/*
		// Theme Options Panel
		// Theme Options Panel
		$panel = array();
		$panel['capability'] 		= 'edit_theme_options';
		$panel['description'] 		= esc_html__( 'Options for Replace with Theme Name', 'text-domain' );
		$panel['priority'] 			= 10;
		$panel['theme_supports'] 	= '';
		$panel['title'] 			= esc_html__( 'Theme Options', 'text-domain' );

		$wp_customize->add_panel( 'theme_options', $panel );
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
		$section = array();
		$section['capability'] 	= 'edit_theme_options';
		$section['description'] = esc_html__( 'New Customizer Section', 'text-domain' );
		$section['panel'] 		= 'theme_options';
		$section['priority'] 	= 10;
		$section['title'] 		= esc_html__( 'New Section', 'text-domain' );

		$wp_customize->add_section( 'new_section', $section );
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
		$setting = $control = array();
		$setting['default'] 	= '';
		$setting['transport'] 	= 'postMessage';
		$control['description'] = esc_html__( 'Paste in the Google Tag Manager code here. Do not include the comment tags!', 'text-domain' );
		$control['label'] 		= esc_html__( 'Google Tag Manager', 'text-domain' );
		$control['priority'] 	= 90;
		$control['section'] 	= 'title_tagline';
		$control['settings'] 	= 'tag_manager';
		$control['type'] 		= 'textarea';

		$wp_customize->add_setting( 'tag_manager', $setting );
		$wp_customize->add_control( 'tag_manager', $control );
		$wp_customize->get_setting( 'tag_manager' )->transport = 'postMessage';



		/*
		// Fields & Controls

		// Text Field
		$settings = $controls = array();
		$settings['default'] 			= '';
		$settings['sanitize_callback'] 	= 'sanitize_text_field';
		$settings['transport'] 			= 'postMessage';
		$controls['description'] 		= esc_html__( '', 'text-domain' );
		$controls['label'] 				= esc_html__( 'Text Field', 'text-domain' );
		$controls['priority'] 			= 10;
		$controls['section'] 			= 'new_section';
		$controls['settings'] 			= 'text_field';
		$controls['type'] 				= 'text';

		$wp_customize->add_setting( 'text_field', $settings );
		$wp_customize->add_control( 'text_field', $controls );
		$wp_customize->get_setting( 'text_field' )->transport = 'postMessage';



		// URL Field
		$settings = $controls = array();
		$settings['default'] 			= '';
		$settings['sanitize_callback'] 	= 'esc_url_raw';
		$settings['transport'] 			= 'postMessage';
		$controls['description'] 		= esc_html__( '', 'text-domain' );
		$controls['label'] 				= esc_html__( 'URL Field', 'text-domain' );
		$controls['priority'] 			= 10;
		$controls['section'] 			= 'new_section';
		$controls['settings'] 			= 'url_field';
		$controls['type'] 				= 'url';

		$wp_customize->add_setting( 'url_field', $settings );
		$wp_customize->add_control( 'url_field', $controls );
		$wp_customize->get_setting( 'url_field' )->transport = 'postMessage';



		// Email Field
		$settings = $controls = array();
		$settings['default'] 			= '';
		$settings['sanitize_callback'] 	= 'sanitize_email';
		$settings['transport'] 			= 'postMessage';
		$controls['description'] 		= esc_html__( '', 'text-domain' );
		$controls['label'] 				= esc_html__( 'Email Field', 'text-domain' );
		$controls['priority'] 			= 10;
		$controls['section'] 			= 'new_section';
		$controls['settings'] 			= 'email_field';
		$controls['type'] 				= 'email';

		$wp_customize->add_setting( 'email_field', $settings );
		$wp_customize->add_control( 'email_field', $controls );
		$wp_customize->get_setting( 'email_field' )->transport = 'postMessage';



		// Date Field
		$settings = $controls = array();
		$settings['default'] 			= '';
		$settings['sanitize_callback'] 	= '';
		$settings['transport'] 			= 'postMessage';
		$controls['description'] 		= esc_html__( '', 'text-domain' );
		$controls['label'] 				= esc_html__( 'Date Field', 'text-domain' );
		$controls['priority'] 			= 10;
		$controls['section'] 			= 'new_section';
		$controls['settings'] 			= 'date_field';
		$controls['type'] 				= 'date';

		$wp_customize->add_setting( 'date_field', $settings );
		$wp_customize->add_control( 'date_field', $controls );
		$wp_customize->get_setting( 'date_field' )->transport = 'postMessage';


		// Checkbox Field
		$settings = $controls = array();
		$settings['default'] 			= 'true';
		$settings['sanitize_callback'] 	= '';
		$settings['transport'] 			= 'postMessage';
		$controls['description'] 		= esc_html__( '', 'text-domain' );
		$controls['label'] 				= esc_html__( 'Checkbox Field', 'text-domain' );
		$controls['priority'] 			= 10;
		$controls['section'] 			= 'new_section';
		$controls['settings'] 			= 'checkbox_field';
		$controls['type'] 				= 'checkbox';

		$wp_customize->add_setting( 'checkbox_field', $settings );
		$wp_customize->add_control( 'checkbox_field', $controls );
		$wp_customize->get_setting( 'checkbox_field' )->transport = 'postMessage';



		// Multiple Checkbox Field
		$settings = $controls = array();
		$settings['default'] 			= 'true';
		$settings['sanitize_callback'] 	= '';
		$settings['transport'] 			= 'postMessage';
		$choices['choice1'] 			= esc_html__( 'Choice 1', 'text-domain' );
		$choices['choice2'] 			= esc_html__( 'Choice 2', 'text-domain' );
		$choices['choice3'] 			= esc_html__( 'Choice 3', 'text-domain' );
		$controls['choices'] 			= $choices;
		$controls['description'] 		= esc_html__( '', 'text-domain' );
		$controls['label'] 				= esc_html__( 'Multi-Checkbox Field', 'text-domain' );
		$controls['priority'] 			= 10;
		$controls['section'] 			= 'new_section';
		$controls['settings'] 			= 'multicheckbox_field';
		$controls['type'] 				= 'checkbox-multiple';

		$wp_customize->add_setting( 'multicheckbox_field', $settings );
		$wp_customize->add_control( 'multicheckbox_field',
			new Customize_Control_Checkbox_Multiple( $wp_customize, 'multicheckbox_field', $controls )
		);
		$wp_customize->get_setting( 'multicheckbox_field' )->transport = 'postMessage';




		// Password Field
		$settings = $controls = array();
		$settings['default'] 			= '';
		$settings['sanitize_callback'] 	= '';
		$settings['transport'] 			= 'postMessage';
		$controls['description'] 		= esc_html__( '', 'text-domain' );
		$controls['label'] 				= esc_html__( 'Password Field', 'text-domain' );
		$controls['priority'] 			= 10;
		$controls['section'] 			= 'new_section';
		$controls['settings'] 			= 'password_field';
		$controls['type'] 				= 'password';

		$wp_customize->add_setting( 'password_field', $settings );
		$wp_customize->add_control( 'password_field', $controls );
		$wp_customize->get_setting( 'password_field' )->transport = 'postMessage';



		// Radio Field
		$settings = $controls = array();
		$settings['default'] 			= 'choice1';
		$settings['sanitize_callback'] 	= '';
		$settings['transport'] 			= 'postMessage';
		$choices['choice1'] 			= esc_html__( 'Choice 1', 'text-domain' );
		$choices['choice2'] 			= esc_html__( 'Choice 2', 'text-domain' );
		$choices['choice3'] 			= esc_html__( 'Choice 3', 'text-domain' );
		$controls['choices'] 			= $choices;
		$controls['description'] 		= esc_html__( '', 'text-domain' );
		$controls['label'] 				= esc_html__( 'Radio Field', 'text-domain' );
		$controls['priority'] 			= 10;
		$controls['section'] 			= 'new_section';
		$controls['settings'] 			= 'radio_field';
		$controls['type'] 				= 'radio';

		$wp_customize->add_setting( 'radio_field', $settings );
		$wp_customize->add_control( 'radio_field', $controls );
		$wp_customize->get_setting( 'radio_field' )->transport = 'postMessage';



		// Select Field
		$settings = $controls = array();
		$settings['default'] 			= 'choice1';
		$settings['sanitize_callback'] 	= '';
		$settings['transport'] 			= 'postMessage';
		$choices['choice1'] 			= esc_html__( 'Choice 1', 'text-domain' );
		$choices['choice2'] 			= esc_html__( 'Choice 2', 'text-domain' );
		$choices['choice3'] 			= esc_html__( 'Choice 3', 'text-domain' );
		$controls['choices'] 			= $choices;
		$controls['description'] 		= esc_html__( '', 'text-domain' );
		$controls['label'] 				= esc_html__( 'Select Field', 'text-domain' );
		$controls['priority'] 			= 10;
		$controls['section'] 			= 'new_section';
		$controls['settings'] 			= 'select_field';
		$controls['type'] 				= 'select';

		$wp_customize->add_setting( 'select_field', $settings );
		$wp_customize->add_control( 'select_field', $controls );
		$wp_customize->get_setting( 'select_field' )->transport = 'postMessage';



		// Textarea Field
		$setting = $control = array();
		$setting['default'] 	= '';
		$setting['transport'] 	= 'postMessage';
		$control['description'] = esc_html__( '', 'text-domain' );
		$control['label'] 		= esc_html__( 'Textarea Manager', 'text-domain' );
		$control['priority'] 	= 10;
		$control['section'] 	= 'new_section';
		$control['settings'] 	= 'textarea_field';
		$control['type'] 		= 'textarea';

		$wp_customize->add_setting( 'textarea_field', $setting );
		$wp_customize->add_control( 'textarea_field', $control );
		$wp_customize->get_setting( 'textarea_field' )->transport = 'postMessage';



		// Range Field
		$settings = $controls = array();
		$settings['default'] 			= '';
		$settings['sanitize_callback'] 	= '';
		$settings['transport'] 			= 'postMessage';
		$inputattrs['class'] 			= 'range-field';
		$inputattrs['max'] 				= 100;
		$inputattrs['min'] 				= 0;
		$inputattrs['step'] 			= 1;
		$inputattrs['style'] 			= 'color: #020202';
		$controls['description'] 		= esc_html__( '', 'text-domain' );
		$controls['input_attrs'] 		= $inputattrs;
		$controls['label'] 				= esc_html__( 'Range Field', 'text-domain' );
		$controls['priority'] 			= 10;
		$controls['section'] 			= 'new_section';
		$controls['settings'] 			= 'range_field';
		$controls['type'] 				= 'range';

		$wp_customize->add_setting( 'range_field', $settings );
		$wp_customize->add_control( 'range_field', $controls );
		$wp_customize->get_setting( 'range_field' )->transport = 'postMessage';



		// Page Select Field
		$settings = $controls = array();
		$settings['default'] 			= '';
		$settings['sanitize_callback'] 	= '';
		$settings['transport'] 			= 'postMessage';
		$controls['description'] 		= esc_html__( '', 'text-domain' );
		$controls['label'] 				= esc_html__( 'Select Page', 'text-domain' );
		$controls['priority'] 			= 10;
		$controls['section'] 			= 'new_section';
		$controls['settings'] 			= 'select_page_field';
		$controls['type'] 				= 'dropdown-pages';

		$wp_customize->add_setting( 'select_page_field', $settings );
		$wp_customize->add_control( 'select_page_field', $controls );
		$wp_customize->get_setting( 'dropdown-pages' )->transport = 'postMessage';



		// Color Chooser Field
		$settings = $controls = array();
		$settings['default'] 			= '#ffffff';
		$settings['sanitize_callback'] 	= 'sanitize_hex_color';
		$settings['transport'] 			= 'postMessage';
		$controls['description'] 		= esc_html__( '', 'text-domain' );
		$controls['label'] 				= esc_html__( 'Color Field', 'text-domain' );
		$controls['priority'] 			= 10;
		$controls['section'] 			= 'new_section';
		$controls['settings'] 			= 'color_field';

		$wp_customize->add_setting( 'color_field', $settings );
		$wp_customize->add_control(
			new WP_Customize_Color_Control( $wp_customize, 'color_field', $controls )
		);
		$wp_customize->get_setting( 'color_field' )->transport = 'postMessage';



		// File Upload Field
		$controls 					= array();
		$controls['description'] 	= esc_html__( '', 'text-domain' );
		$controls['label'] 			= esc_html__( 'File Upload', 'text-domain' );
		$controls['priority'] 		= 10;
		$controls['section'] 		= 'new_section';
		$controls['settings'] 		= 'file_upload';

		$wp_customize->add_setting( 'file_upload' );
		$wp_customize->add_control(
			new WP_Customize_Image_Control( $wp_customize, 'file_upload', $controls )
		);



		// Image Upload Field
		$settings = $controls = array();
		$settings['default'] 			= '';
		$settings['transport'] 			= 'postMessage';
		$controls['description'] 		= esc_html__( '', 'text-domain' );
		$controls['label'] 				= esc_html__( 'Image Field', 'text-domain' );
		$controls['priority'] 			= 10;
		$controls['section'] 			= 'new_section';
		$controls['settings'] 			= 'image_upload';

		$wp_customize->add_setting( 'image_upload', $settings );
		$wp_customize->add_control(
			new WP_Customize_Image_Control( $wp_customize, 'image_upload', $controls )
		);
		$wp_customize->get_setting( 'image_upload' )->transport = 'postMessage';



		// Media Upload Field
		// Can be used for images
		// Returns the image ID, not a URL
		$settings = $controls = array();
		$settings['default'] 			= '';
		$settings['transport'] 			= 'postMessage';
		$controls['description'] 		= esc_html__( '', 'text-domain' );
		$controls['label'] 				= esc_html__( 'Media Field', 'text-domain' );
		$controls['priority'] 			= 10;
		$controls['section'] 			= 'new_section';
		$controls['settings'] 			= 'media_upload';

		$wp_customize->add_setting( 'media_upload', $settings );
		$wp_customize->add_control(
			new WP_Customize_Media_Control( $wp_customize, 'media_upload', $controls )
		);
		$wp_customize->get_setting( 'media_upload' )->transport = 'postMessage';



		// Cropped Image Field
		$settings = $controls = array();
		$settings['default'] 			= '';
		$settings['transport'] 			= 'postMessage';
		$controls['description'] 		= esc_html__( '', 'text-domain' );
		$controls['flex_height'] 		= '';
		$controls['flex_width'] 		= '';
		$controls['height'] 			= '1080';
		$controls['label'] 				= esc_html__( 'Media Field', 'text-domain' );
		$controls['priority'] 			= 10;
		$controls['section'] 			= 'new_section';
		$controls['settings'] 			= 'cropped_image';
		$controls['width'] 				= '1920';

		$wp_customize->add_setting( 'cropped_image', $settings );
		$wp_customize->add_control(
			new WP_Customize_Cropped_Image_Control( $wp_customize, 'cropped_image', $controls )
		);
		$wp_customize->get_setting( 'cropped_image' )->transport = 'postMessage';


		// Country Select Field
		$settings = $controls = array();
		$settings['default'] 			= '';
		$settings['sanitize_callback'] 	= '';
		$settings['transport'] 			= 'postMessage';
		$controls['choices'] 			= $this->country_list();
		$controls['description'] 		= esc_html__( '', 'text-domain' );
		$controls['label'] 				= esc_html__( 'Select Country', 'text-domain' );
		$controls['priority'] 			= 250;
		$controls['section'] 			= 'new_section';
		$controls['settings'] 			= 'country';
		$controls['type'] 				= 'select';

		$wp_customize->add_setting( 'country', $settings );
		$wp_customize->add_control( 'country', $controls );
		$wp_customize->get_setting( 'country' )->transport = 'postMessage';


		// US States Select Field
		$settings = $controls = array();
		$settings['default'] 			= '';
		$settings['sanitize_callback'] 	= '';
		$settings['transport'] 			= 'postMessage';
		$controls['choices'] 			= $this->states_list_unitedstates();
		$controls['description'] 		= esc_html__( '', 'text-domain' );
		$controls['label'] 				= esc_html__( 'Select State', 'text-domain' );
		$controls['priority'] 			= 230;
		$controls['section'] 			= 'new_section';
		$controls['settings'] 			= 'us_state';
		$controls['type'] 				= 'select';

		$wp_customize->add_setting( 'us_state', $settings );
		$wp_customize->add_control( 'us_state', $controls );
		$wp_customize->get_setting( 'us_state' )->transport = 'postMessage';


		// Canadian States Select Field
		$settings = $controls = array();
		$settings['default'] 			= '';
		$settings['sanitize_callback'] 	= '';
		$settings['transport'] 			= 'postMessage';
		$controls['choices'] 			= $this->states_list_canada();
		$controls['description'] 		= esc_html__( '', 'text-domain' );
		$controls['label'] 				= esc_html__( 'Select State', 'text-domain' );
		$controls['priority'] 			= 230;
		$controls['section'] 			= 'new_section';
		$controls['settings'] 			= 'canada_state';
		$controls['type'] 				= 'select';

		$wp_customize->add_setting( 'canada_state', $settings );
		$wp_customize->add_control( 'canada_state', $controls );
		$wp_customize->get_setting( 'canada_state' )->transport = 'postMessage';


		// Australian States Select Field
		$settings = $controls = array();
		$settings['default'] 			= '';
		$settings['sanitize_callback'] 	= '';
		$settings['transport'] 			= 'postMessage';
		$controls['choices'] 			= $this->states_list_australia();
		$controls['description'] 		= esc_html__( '', 'text-domain' );
		$controls['label'] 				= esc_html__( 'Select State', 'text-domain' );
		$controls['priority'] 			= 230;
		$controls['section'] 			= 'new_section';
		$controls['settings'] 			= 'australia_state';
		$controls['type'] 				= 'select';

		$wp_customize->add_setting( 'australia_state', $settings );
		$wp_customize->add_control( 'australia_state', $controls );
		$wp_customize->get_setting( 'australia_state' )->transport = 'postMessage';


		// Layout Picker Field
		$settings = $controls = array();
		$settings['default'] 			= '';
		$controls['description'] 		= esc_html__( '', 'text-domain' );
		$controls['label'] 				= esc_html__( 'Choose Layout', 'text-domain' );
		$controls['priority'] 			= 10;
		$controls['section'] 			= 'new_section';
		$controls['settings'] 			= 'layout_field';

		$wp_customize->add_setting( 'layout_field', $settings );
		$wp_customize->add_control(
			new Layout_Picker_Custom_Control( $wp_customize, 'layout_field', $controls )
		);
		$wp_customize->get_setting( 'layout_field' )->transport = 'postMessage';



		// Select Category Field
		$settings = $controls = array();
		$settings['default'] 			= '';
		$controls['description'] 		= esc_html__( '', 'text-domain' );
		$controls['label'] 				= esc_html__( 'Choose Category', 'text-domain' );
		$controls['priority'] 			= 10;
		$controls['section'] 			= 'new_section';
		$controls['settings'] 			= 'select_category';

		$wp_customize->add_setting( 'select_category', $settings );
		$wp_customize->add_control(
			new Select_Category_Custom_Control( $wp_customize, 'select_category', $controls )
		);
		$wp_customize->get_setting( 'select_category' )->transport = 'postMessage';



		// Select Menu Field
		$settings = $controls = array();
		$settings['default'] 			= '';
		$controls['description'] 		= esc_html__( '', 'text-domain' );
		$controls['label'] 				= esc_html__( 'Choose Menu', 'text-domain' );
		$controls['priority'] 			= 10;
		$controls['section'] 			= 'new_section';
		$controls['settings'] 			= 'select_menu';

		$wp_customize->add_setting( 'select_menu', $settings );
		$wp_customize->add_control(
			new Select_Menu_Custom_Control( $wp_customize, 'select_menu', $controls )
		);
		$wp_customize->get_setting( 'select_menu' )->transport = 'postMessage';



		// Select Post Field
		$settings = $controls = array();
		$settings['default'] 			= '';
		$controls['description'] 		= esc_html__( '', 'text-domain' );
		$controls['label'] 				= esc_html__( 'Choose Post', 'text-domain' );
		$controls['priority'] 			= 10;
		$controls['section'] 			= 'new_section';
		$controls['settings'] 			= 'select_post';

		$wp_customize->add_setting( 'select_post', $settings );
		$wp_customize->add_control(
			new Select_Post_Custom_Control( $wp_customize, 'select_post', $controls )
		);
		$wp_customize->get_setting( 'select_post' )->transport = 'postMessage';



		// Select Post Type Field
		$settings = $controls = array();
		$settings['default'] 			= '';
		$controls['description'] 		= esc_html__( '', 'text-domain' );
		$controls['label'] 				= esc_html__( 'Choose Post Type', 'text-domain' );
		$controls['priority'] 			= 10;
		$controls['section'] 			= 'new_section';
		$controls['settings'] 			= 'select_posttype';

		$wp_customize->add_setting( 'select_posttype', $settings );
		$wp_customize->add_control(
			new Select_Post_Type_Custom_Control( $wp_customize, 'select_posttype', $controls )
		);
		$wp_customize->get_setting( 'select_posttype' )->transport = 'postMessage';



		// Select Tag Field
		$settings = $controls = array();
		$settings['default'] 			= '';
		$controls['description'] 		= esc_html__( '', 'text-domain' );
		$controls['label'] 				= esc_html__( 'Choose Tag', 'text-domain' );
		$controls['priority'] 			= 10;
		$controls['section'] 			= 'new_section';
		$controls['settings'] 			= 'select_tag';

		$wp_customize->add_setting( 'select_tag', $settings );
		$wp_customize->add_control(
			new Select_Tag_Custom_Control( $wp_customize, 'select_tag', $controls )
		);
		$wp_customize->get_setting( 'select_tag' )->transport = 'postMessage';



		// Select Taxonomy Field
		$settings = $controls = array();
		$settings['default'] 			= '';
		$controls['description'] 		= esc_html__( '', 'text-domain' );
		$controls['label'] 				= esc_html__( 'Choose Taxonomy', 'text-domain' );
		$controls['priority'] 			= 10;
		$controls['section'] 			= 'new_section';
		$controls['settings'] 			= 'select_taxonomy';

		$wp_customize->add_setting( 'select_taxonomy', $settings );
		$wp_customize->add_control(
			new Select_Taxonomy_Custom_Control( $wp_customize, 'select_taxonomy', $controls )
		);
		$wp_customize->get_setting( 'select_taxonomy' )->transport = 'postMessage';



		// Select User Field
		$settings = $controls = array();
		$settings['default'] 			= '';
		$controls['description'] 		= esc_html__( '', 'text-domain' );
		$controls['label'] 				= esc_html__( 'Choose User', 'text-domain' );
		$controls['priority'] 			= 10;
		$controls['section'] 			= 'new_section';
		$controls['settings'] 			= 'select_user';

		$wp_customize->add_setting( 'select_user', $settings );
		$wp_customize->add_control(
			new Select_User_Custom_Control( $wp_customize, 'select_user', $controls )
		);
		$wp_customize->get_setting( 'select_user' )->transport = 'postMessage';



		// Editor Field
		$settings = $controls = array();
		$settings['default'] 			= '';
		$controls['description'] 		= esc_html__( '', 'text-domain' );
		$controls['label'] 				= esc_html__( 'Edit Content', 'text-domain' );
		$controls['priority'] 			= 10;
		$controls['section'] 			= 'new_section';
		$controls['settings'] 			= 'editor_field';

		$wp_customize->add_setting( 'editor_field', $settings );
		$wp_customize->add_control(
			new Text_Editor_Custom_Control( $wp_customize, 'editor_field', $controls )
		);
		$wp_customize->get_setting( 'editor_field' )->transport = 'postMessage';

		*/

	} // register_fields()

	/**
	 * Used by customizer controls, mostly for active callbacks.
	 *
	 * @hook		customize_controls_enqueue_scripts
	 *
	 * @access 		public
	 * @see 		add_action( 'customize_preview_init', $func )
	 * @since 		1.0.0
	 */
	public function control_scripts() {

		wp_enqueue_script( 'function_names_customizer_controls', get_template_directory_uri() . '/js/customizer-controls.min.js', array( 'jquery', 'customize-controls' ), false, true );

	} // control_scripts()

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

		$countries['AF'] = esc_html__( 'Afghanistan (‫افغانستان‬‎)', 'text-domain' );
		$countries['AX'] = esc_html__( 'Åland Islands (Åland)', 'text-domain' );
		$countries['AL'] = esc_html__( 'Albania (Shqipëri)', 'text-domain' );
		$countries['DZ'] = esc_html__( 'Algeria (‫الجزائر‬‎)', 'text-domain' );
		$countries['AS'] = esc_html__( 'American Samoa', 'text-domain' );
		$countries['AD'] = esc_html__( 'Andorra', 'text-domain' );
		$countries['AO'] = esc_html__( 'Angola', 'text-domain' );
		$countries['AI'] = esc_html__( 'Anguilla', 'text-domain' );
		$countries['AQ'] = esc_html__( 'Antarctica', 'text-domain' );
		$countries['AG'] = esc_html__( 'Antigua and Barbuda', 'text-domain' );
		$countries['AR'] = esc_html__( 'Argentina', 'text-domain' );
		$countries['AM'] = esc_html__( 'Armenia (Հայաստան)', 'text-domain' );
		$countries['AW'] = esc_html__( 'Aruba', 'text-domain' );
		$countries['AC'] = esc_html__( 'Ascension Island', 'text-domain' );
		$countries['AU'] = esc_html__( 'Australia', 'text-domain' );
		$countries['AT'] = esc_html__( 'Austria (Österreich)', 'text-domain' );
		$countries['AZ'] = esc_html__( 'Azerbaijan (Azərbaycan)', 'text-domain' );
		$countries['BS'] = esc_html__( 'Bahamas', 'text-domain' );
		$countries['BH'] = esc_html__( 'Bahrain (‫البحرين‬‎)', 'text-domain' );
		$countries['BD'] = esc_html__( 'Bangladesh (বাংলাদেশ)', 'text-domain' );
		$countries['BB'] = esc_html__( 'Barbados', 'text-domain' );
		$countries['BY'] = esc_html__( 'Belarus (Беларусь)', 'text-domain' );
		$countries['BE'] = esc_html__( 'Belgium (België)', 'text-domain' );
		$countries['BZ'] = esc_html__( 'Belize', 'text-domain' );
		$countries['BJ'] = esc_html__( 'Benin (Bénin)', 'text-domain' );
		$countries['BM'] = esc_html__( 'Bermuda', 'text-domain' );
		$countries['BT'] = esc_html__( 'Bhutan (འབྲུག)', 'text-domain' );
		$countries['BO'] = esc_html__( 'Bolivia', 'text-domain' );
		$countries['BA'] = esc_html__( 'Bosnia and Herzegovina (Босна и Херцеговина)', 'text-domain' );
		$countries['BW'] = esc_html__( 'Botswana', 'text-domain' );
		$countries['BV'] = esc_html__( 'Bouvet Island', 'text-domain' );
		$countries['BR'] = esc_html__( 'Brazil (Brasil)', 'text-domain' );
		$countries['IO'] = esc_html__( 'British Indian Ocean Territory', 'text-domain' );
		$countries['VG'] = esc_html__( 'British Virgin Islands', 'text-domain' );
		$countries['BN'] = esc_html__( 'Brunei', 'text-domain' );
		$countries['BG'] = esc_html__( 'Bulgaria (България)', 'text-domain' );
		$countries['BF'] = esc_html__( 'Burkina Faso', 'text-domain' );
		$countries['BI'] = esc_html__( 'Burundi (Uburundi)', 'text-domain' );
		$countries['KH'] = esc_html__( 'Cambodia (កម្ពុជា)', 'text-domain' );
		$countries['CM'] = esc_html__( 'Cameroon (Cameroun)', 'text-domain' );
		$countries['CA'] = esc_html__( 'Canada', 'text-domain' );
		$countries['IC'] = esc_html__( 'Canary Islands (islas Canarias)', 'text-domain' );
		$countries['CV'] = esc_html__( 'Cape Verde (Kabu Verdi)', 'text-domain' );
		$countries['BQ'] = esc_html__( 'Caribbean Netherlands', 'text-domain' );
		$countries['KY'] = esc_html__( 'Cayman Islands', 'text-domain' );
		$countries['CF'] = esc_html__( 'Central African Republic (République centrafricaine)', 'text-domain' );
		$countries['EA'] = esc_html__( 'Ceuta and Melilla (Ceuta y Melilla)', 'text-domain' );
		$countries['TD'] = esc_html__( 'Chad (Tchad)', 'text-domain' );
		$countries['CL'] = esc_html__( 'Chile', 'text-domain' );
		$countries['CN'] = esc_html__( 'China (中国)', 'text-domain' );
		$countries['CX'] = esc_html__( 'Christmas Island', 'text-domain' );
		$countries['CP'] = esc_html__( 'Clipperton Island', 'text-domain' );
		$countries['CC'] = esc_html__( 'Cocos (Keeling) Islands (Kepulauan Cocos (Keeling))', 'text-domain' );
		$countries['CO'] = esc_html__( 'Colombia', 'text-domain' );
		$countries['KM'] = esc_html__( 'Comoros (‫جزر القمر‬‎)', 'text-domain' );
		$countries['CD'] = esc_html__( 'Congo (DRC) (Jamhuri ya Kidemokrasia ya Kongo)', 'text-domain' );
		$countries['CG'] = esc_html__( 'Congo (Republic) (Congo-Brazzaville)', 'text-domain' );
		$countries['CK'] = esc_html__( 'Cook Islands', 'text-domain' );
		$countries['CR'] = esc_html__( 'Costa Rica', 'text-domain' );
		$countries['CI'] = esc_html__( 'Côte d’Ivoire', 'text-domain' );
		$countries['HR'] = esc_html__( 'Croatia (Hrvatska)', 'text-domain' );
		$countries['CU'] = esc_html__( 'Cuba', 'text-domain' );
		$countries['CW'] = esc_html__( 'Curaçao', 'text-domain' );
		$countries['CY'] = esc_html__( 'Cyprus (Κύπρος)', 'text-domain' );
		$countries['CZ'] = esc_html__( 'Czech Republic (Česká republika)', 'text-domain' );
		$countries['DK'] = esc_html__( 'Denmark (Danmark)', 'text-domain' );
		$countries['DG'] = esc_html__( 'Diego Garcia', 'text-domain' );
		$countries['DJ'] = esc_html__( 'Djibouti', 'text-domain' );
		$countries['DM'] = esc_html__( 'Dominica', 'text-domain' );
		$countries['DO'] = esc_html__( 'Dominican Republic (República Dominicana)', 'text-domain' );
		$countries['EC'] = esc_html__( 'Ecuador', 'text-domain' );
		$countries['EG'] = esc_html__( 'Egypt (‫مصر‬‎)', 'text-domain' );
		$countries['SV'] = esc_html__( 'El Salvador', 'text-domain' );
		$countries['GQ'] = esc_html__( 'Equatorial Guinea (Guinea Ecuatorial)', 'text-domain' );
		$countries['ER'] = esc_html__( 'Eritrea', 'text-domain' );
		$countries['EE'] = esc_html__( 'Estonia (Eesti)', 'text-domain' );
		$countries['ET'] = esc_html__( 'Ethiopia', 'text-domain' );
		$countries['FK'] = esc_html__( 'Falkland Islands (Islas Malvinas)', 'text-domain' );
		$countries['FO'] = esc_html__( 'Faroe Islands (Føroyar)', 'text-domain' );
		$countries['FJ'] = esc_html__( 'Fiji', 'text-domain' );
		$countries['FI'] = esc_html__( 'Finland (Suomi)', 'text-domain' );
		$countries['FR'] = esc_html__( 'France', 'text-domain' );
		$countries['GF'] = esc_html__( 'French Guiana (Guyane française)', 'text-domain' );
		$countries['PF'] = esc_html__( 'French Polynesia (Polynésie française)', 'text-domain' );
		$countries['TF'] = esc_html__( 'French Southern Territories (Terres australes françaises)', 'text-domain' );
		$countries['GA'] = esc_html__( 'Gabon', 'text-domain' );
		$countries['GM'] = esc_html__( 'Gambia', 'text-domain' );
		$countries['GE'] = esc_html__( 'Georgia (საქართველო)', 'text-domain' );
		$countries['DE'] = esc_html__( 'Germany (Deutschland)', 'text-domain' );
		$countries['GH'] = esc_html__( 'Ghana (Gaana)', 'text-domain' );
		$countries['GI'] = esc_html__( 'Gibraltar', 'text-domain' );
		$countries['GR'] = esc_html__( 'Greece (Ελλάδα)', 'text-domain' );
		$countries['GL'] = esc_html__( 'Greenland (Kalaallit Nunaat)', 'text-domain' );
		$countries['GD'] = esc_html__( 'Grenada', 'text-domain' );
		$countries['GP'] = esc_html__( 'Guadeloupe', 'text-domain' );
		$countries['GU'] = esc_html__( 'Guam', 'text-domain' );
		$countries['GT'] = esc_html__( 'Guatemala', 'text-domain' );
		$countries['GG'] = esc_html__( 'Guernsey', 'text-domain' );
		$countries['GN'] = esc_html__( 'Guinea (Guinée)', 'text-domain' );
		$countries['GW'] = esc_html__( 'Guinea-Bissau (Guiné Bissau)', 'text-domain' );
		$countries['GY'] = esc_html__( 'Guyana', 'text-domain' );
		$countries['HT'] = esc_html__( 'Haiti', 'text-domain' );
		$countries['HM'] = esc_html__( 'Heard & McDonald Islands', 'text-domain' );
		$countries['HN'] = esc_html__( 'Honduras', 'text-domain' );
		$countries['HK'] = esc_html__( 'Hong Kong (香港)', 'text-domain' );
		$countries['HU'] = esc_html__( 'Hungary (Magyarország)', 'text-domain' );
		$countries['IS'] = esc_html__( 'Iceland (Ísland)', 'text-domain' );
		$countries['IN'] = esc_html__( 'India (भारत)', 'text-domain' );
		$countries['ID'] = esc_html__( 'Indonesia', 'text-domain' );
		$countries['IR'] = esc_html__( 'Iran (‫ایران‬‎)', 'text-domain' );
		$countries['IQ'] = esc_html__( 'Iraq (‫العراق‬‎)', 'text-domain' );
		$countries['IE'] = esc_html__( 'Ireland', 'text-domain' );
		$countries['IM'] = esc_html__( 'Isle of Man', 'text-domain' );
		$countries['IL'] = esc_html__( 'Israel (‫ישראל‬‎)', 'text-domain' );
		$countries['IT'] = esc_html__( 'Italy (Italia)', 'text-domain' );
		$countries['JM'] = esc_html__( 'Jamaica', 'text-domain' );
		$countries['JP'] = esc_html__( 'Japan (日本)', 'text-domain' );
		$countries['JE'] = esc_html__( 'Jersey', 'text-domain' );
		$countries['JO'] = esc_html__( 'Jordan (‫الأردن‬‎)', 'text-domain' );
		$countries['KZ'] = esc_html__( 'Kazakhstan (Казахстан)', 'text-domain' );
		$countries['KE'] = esc_html__( 'Kenya', 'text-domain' );
		$countries['KI'] = esc_html__( 'Kiribati', 'text-domain' );
		$countries['XK'] = esc_html__( 'Kosovo (Kosovë)', 'text-domain' );
		$countries['KW'] = esc_html__( 'Kuwait (‫الكويت‬‎)', 'text-domain' );
		$countries['KG'] = esc_html__( 'Kyrgyzstan (Кыргызстан)', 'text-domain' );
		$countries['LA'] = esc_html__( 'Laos (ລາວ)', 'text-domain' );
		$countries['LV'] = esc_html__( 'Latvia (Latvija)', 'text-domain' );
		$countries['LB'] = esc_html__( 'Lebanon (‫لبنان‬‎)', 'text-domain' );
		$countries['LS'] = esc_html__( 'Lesotho', 'text-domain' );
		$countries['LR'] = esc_html__( 'Liberia', 'text-domain' );
		$countries['LY'] = esc_html__( 'Libya (‫ليبيا‬‎)', 'text-domain' );
		$countries['LI'] = esc_html__( 'Liechtenstein', 'text-domain' );
		$countries['LT'] = esc_html__( 'Lithuania (Lietuva)', 'text-domain' );
		$countries['LU'] = esc_html__( 'Luxembourg', 'text-domain' );
		$countries['MO'] = esc_html__( 'Macau (澳門)', 'text-domain' );
		$countries['MK'] = esc_html__( 'Macedonia (FYROM) (Македонија)', 'text-domain' );
		$countries['MG'] = esc_html__( 'Madagascar (Madagasikara)', 'text-domain' );
		$countries['MW'] = esc_html__( 'Malawi', 'text-domain' );
		$countries['MY'] = esc_html__( 'Malaysia', 'text-domain' );
		$countries['MV'] = esc_html__( 'Maldives', 'text-domain' );
		$countries['ML'] = esc_html__( 'Mali', 'text-domain' );
		$countries['MT'] = esc_html__( 'Malta', 'text-domain' );
		$countries['MH'] = esc_html__( 'Marshall Islands', 'text-domain' );
		$countries['MQ'] = esc_html__( 'Martinique', 'text-domain' );
		$countries['MR'] = esc_html__( 'Mauritania (‫موريتانيا‬‎)', 'text-domain' );
		$countries['MU'] = esc_html__( 'Mauritius (Moris)', 'text-domain' );
		$countries['YT'] = esc_html__( 'Mayotte', 'text-domain' );
		$countries['MX'] = esc_html__( 'Mexico (México)', 'text-domain' );
		$countries['FM'] = esc_html__( 'Micronesia', 'text-domain' );
		$countries['MD'] = esc_html__( 'Moldova (Republica Moldova)', 'text-domain' );
		$countries['MC'] = esc_html__( 'Monaco', 'text-domain' );
		$countries['MN'] = esc_html__( 'Mongolia (Монгол)', 'text-domain' );
		$countries['ME'] = esc_html__( 'Montenegro (Crna Gora)', 'text-domain' );
		$countries['MS'] = esc_html__( 'Montserrat', 'text-domain' );
		$countries['MA'] = esc_html__( 'Morocco (‫المغرب‬‎)', 'text-domain' );
		$countries['MZ'] = esc_html__( 'Mozambique (Moçambique)', 'text-domain' );
		$countries['MM'] = esc_html__( 'Myanmar (Burma) (မြန်မာ)', 'text-domain' );
		$countries['NA'] = esc_html__( 'Namibia (Namibië)', 'text-domain' );
		$countries['NR'] = esc_html__( 'Nauru', 'text-domain' );
		$countries['NP'] = esc_html__( 'Nepal (नेपाल)', 'text-domain' );
		$countries['NL'] = esc_html__( 'Netherlands (Nederland)', 'text-domain' );
		$countries['NC'] = esc_html__( 'New Caledonia (Nouvelle-Calédonie)', 'text-domain' );
		$countries['NZ'] = esc_html__( 'New Zealand', 'text-domain' );
		$countries['NI'] = esc_html__( 'Nicaragua', 'text-domain' );
		$countries['NE'] = esc_html__( 'Niger (Nijar)', 'text-domain' );
		$countries['NG'] = esc_html__( 'Nigeria', 'text-domain' );
		$countries['NU'] = esc_html__( 'Niue', 'text-domain' );
		$countries['NF'] = esc_html__( 'Norfolk Island', 'text-domain' );
		$countries['MP'] = esc_html__( 'Northern Mariana Islands', 'text-domain' );
		$countries['KP'] = esc_html__( 'North Korea (조선 민주주의 인민 공화국)', 'text-domain' );
		$countries['NO'] = esc_html__( 'Norway (Norge)', 'text-domain' );
		$countries['OM'] = esc_html__( 'Oman (‫عُمان‬‎)', 'text-domain' );
		$countries['PK'] = esc_html__( 'Pakistan (‫پاکستان‬‎)', 'text-domain' );
		$countries['PW'] = esc_html__( 'Palau', 'text-domain' );
		$countries['PS'] = esc_html__( 'Palestine (‫فلسطين‬‎)', 'text-domain' );
		$countries['PA'] = esc_html__( 'Panama (Panamá)', 'text-domain' );
		$countries['PG'] = esc_html__( 'Papua New Guinea', 'text-domain' );
		$countries['PY'] = esc_html__( 'Paraguay', 'text-domain' );
		$countries['PE'] = esc_html__( 'Peru (Perú)', 'text-domain' );
		$countries['PH'] = esc_html__( 'Philippines', 'text-domain' );
		$countries['PN'] = esc_html__( 'Pitcairn Islands', 'text-domain' );
		$countries['PL'] = esc_html__( 'Poland (Polska)', 'text-domain' );
		$countries['PT'] = esc_html__( 'Portugal', 'text-domain' );
		$countries['PR'] = esc_html__( 'Puerto Rico', 'text-domain' );
		$countries['QA'] = esc_html__( 'Qatar (‫قطر‬‎)', 'text-domain' );
		$countries['RE'] = esc_html__( 'Réunion (La Réunion)', 'text-domain' );
		$countries['RO'] = esc_html__( 'Romania (România)', 'text-domain' );
		$countries['RU'] = esc_html__( 'Russia (Россия)', 'text-domain' );
		$countries['RW'] = esc_html__( 'Rwanda', 'text-domain' );
		$countries['BL'] = esc_html__( 'Saint Barthélemy (Saint-Barthélemy)', 'text-domain' );
		$countries['SH'] = esc_html__( 'Saint Helena', 'text-domain' );
		$countries['KN'] = esc_html__( 'Saint Kitts and Nevis', 'text-domain' );
		$countries['LC'] = esc_html__( 'Saint Lucia', 'text-domain' );
		$countries['MF'] = esc_html__( 'Saint Martin (Saint-Martin (partie française))', 'text-domain' );
		$countries['PM'] = esc_html__( 'Saint Pierre and Miquelon (Saint-Pierre-et-Miquelon)', 'text-domain' );
		$countries['WS'] = esc_html__( 'Samoa', 'text-domain' );
		$countries['SM'] = esc_html__( 'San Marino', 'text-domain' );
		$countries['ST'] = esc_html__( 'São Tomé and Príncipe (São Tomé e Príncipe)', 'text-domain' );
		$countries['SA'] = esc_html__( 'Saudi Arabia (‫المملكة العربية السعودية‬‎)', 'text-domain' );
		$countries['SN'] = esc_html__( 'Senegal (Sénégal)', 'text-domain' );
		$countries['RS'] = esc_html__( 'Serbia (Србија)', 'text-domain' );
		$countries['SC'] = esc_html__( 'Seychelles', 'text-domain' );
		$countries['SL'] = esc_html__( 'Sierra Leone', 'text-domain' );
		$countries['SG'] = esc_html__( 'Singapore', 'text-domain' );
		$countries['SX'] = esc_html__( 'Sint Maarten', 'text-domain' );
		$countries['SK'] = esc_html__( 'Slovakia (Slovensko)', 'text-domain' );
		$countries['SI'] = esc_html__( 'Slovenia (Slovenija)', 'text-domain' );
		$countries['SB'] = esc_html__( 'Solomon Islands', 'text-domain' );
		$countries['SO'] = esc_html__( 'Somalia (Soomaaliya)', 'text-domain' );
		$countries['ZA'] = esc_html__( 'South Africa', 'text-domain' );
		$countries['GS'] = esc_html__( 'South Georgia & South Sandwich Islands', 'text-domain' );
		$countries['KR'] = esc_html__( 'South Korea (대한민국)', 'text-domain' );
		$countries['SS'] = esc_html__( 'South Sudan (‫جنوب السودان‬‎)', 'text-domain' );
		$countries['ES'] = esc_html__( 'Spain (España)', 'text-domain' );
		$countries['LK'] = esc_html__( 'Sri Lanka (ශ්‍රී ලංකාව)', 'text-domain' );
		$countries['VC'] = esc_html__( 'St. Vincent & Grenadines', 'text-domain' );
		$countries['SD'] = esc_html__( 'Sudan (‫السودان‬‎)', 'text-domain' );
		$countries['SR'] = esc_html__( 'Suriname', 'text-domain' );
		$countries['SJ'] = esc_html__( 'Svalbard and Jan Mayen (Svalbard og Jan Mayen)', 'text-domain' );
		$countries['SZ'] = esc_html__( 'Swaziland', 'text-domain' );
		$countries['SE'] = esc_html__( 'Sweden (Sverige)', 'text-domain' );
		$countries['CH'] = esc_html__( 'Switzerland (Schweiz)', 'text-domain' );
		$countries['SY'] = esc_html__( 'Syria (‫سوريا‬‎)', 'text-domain' );
		$countries['TW'] = esc_html__( 'Taiwan (台灣)', 'text-domain' );
		$countries['TJ'] = esc_html__( 'Tajikistan', 'text-domain' );
		$countries['TZ'] = esc_html__( 'Tanzania', 'text-domain' );
		$countries['TH'] = esc_html__( 'Thailand (ไทย)', 'text-domain' );
		$countries['TL'] = esc_html__( 'Timor-Leste', 'text-domain' );
		$countries['TG'] = esc_html__( 'Togo', 'text-domain' );
		$countries['TK'] = esc_html__( 'Tokelau', 'text-domain' );
		$countries['TO'] = esc_html__( 'Tonga', 'text-domain' );
		$countries['TT'] = esc_html__( 'Trinidad and Tobago', 'text-domain' );
		$countries['TA'] = esc_html__( 'Tristan da Cunha', 'text-domain' );
		$countries['TN'] = esc_html__( 'Tunisia (‫تونس‬‎)', 'text-domain' );
		$countries['TR'] = esc_html__( 'Turkey (Türkiye)', 'text-domain' );
		$countries['TM'] = esc_html__( 'Turkmenistan', 'text-domain' );
		$countries['TC'] = esc_html__( 'Turks and Caicos Islands', 'text-domain' );
		$countries['TV'] = esc_html__( 'Tuvalu', 'text-domain' );
		$countries['UM'] = esc_html__( 'U.S. Outlying Islands', 'text-domain' );
		$countries['VI'] = esc_html__( 'U.S. Virgin Islands', 'text-domain' );
		$countries['UG'] = esc_html__( 'Uganda', 'text-domain' );
		$countries['UA'] = esc_html__( 'Ukraine (Україна)', 'text-domain' );
		$countries['AE'] = esc_html__( 'United Arab Emirates (‫الإمارات العربية المتحدة‬‎)', 'text-domain' );
		$countries['GB'] = esc_html__( 'United Kingdom', 'text-domain' );
		$countries['US'] = esc_html__( 'United States', 'text-domain' );
		$countries['UY'] = esc_html__( 'Uruguay', 'text-domain' );
		$countries['UZ'] = esc_html__( 'Uzbekistan (Oʻzbekiston)', 'text-domain' );
		$countries['VU'] = esc_html__( 'Vanuatu', 'text-domain' );
		$countries['VA'] = esc_html__( 'Vatican City (Città del Vaticano)', 'text-domain' );
		$countries['VE'] = esc_html__( 'Venezuela', 'text-domain' );
		$countries['VN'] = esc_html__( 'Vietnam (Việt Nam)', 'text-domain' );
		$countries['WF'] = esc_html__( 'Wallis and Futuna', 'text-domain' );
		$countries['EH'] = esc_html__( 'Western Sahara (‫الصحراء الغربية‬‎)', 'text-domain' );
		$countries['YE'] = esc_html__( 'Yemen (‫اليمن‬‎)', 'text-domain' );
		$countries['ZM'] = esc_html__( 'Zambia', 'text-domain' );
		$countries['ZW'] = esc_html__( 'Zimbabwe', 'text-domain' );

		if ( ! empty( $country ) ) {

			return $countries[$country];

		}

		return $countries;

	} // country_list()

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

		if ( empty( $mod ) ) { return; }

		$return = sprintf('%s { %s:%s; }',
			$selector,
			$style,
			$prefix . $mod . $postfix
		);

		if ( $echo ) {

			echo $return;

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
	 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
	 *
	 * Used by hook: 'customize_preview_init'
	 *
	 * @access 		public
	 * @see 		add_action( 'customize_preview_init', $func )
	 * @since 		1.0.0
	 */
	public function live_preview() {

		wp_enqueue_script( 'function_names_customizer', get_template_directory_uri() . '/js/customizer.min.js', array( 'jquery', 'customize-preview' ), '', true );

	} // live_preview()

	/**
	 * Loads files for Custom Controls.
	 */
	public function load_customize_controls() {

		$files[] = 'control-checkbox-multiple.php';
		$files[] = 'control-layout-picker.php';
		$files[] = 'control-select-category.php';
		$files[] = 'control-select-menu.php';
		$files[] = 'control-select-post.php';
		$files[] = 'control-select-recent-post.php';
		$files[] = 'control-select-post-type.php';
		$files[] = 'control-select-tag.php';
		$files[] = 'control-select-taxonomy.php';
		$files[] = 'control-select-user.php';
		$files[] = 'control-editor.php';

		foreach ( $files as $file ) {

			require_once( trailingslashit( get_template_directory() ) . $file );

		}

	} // load_customize_controls()

	public function sanitizer( $values ) {

		if ( is_array( $values ) ) {

			$multi_values = $values;

		} else {

			$multi_values = explode( ',', $values );

		}

		if ( empty( $multi_values ) ) {

			return array();

		}

		return array_map( 'sanitize_text_field', $multi_values );

		$sanitizer 	= new Class_Names_Sanitize();
		$new_value 	= $sanitizer->clean( $_POST[$meta[0]], $meta[1] );

	} // sanitizer()

	/**
	 * Returns an array of the Australian states and Territories.
	 * The optional parameters allows for returning just one state.
	 *
	 * @param 		string 		$state 		The state to return.
	 * @return 		array 					An array containing states.
	 */
	private function states_list_australia( $state = '' ) {

		$states = array();

		$states['ACT'] = esc_html__( 'Australian Capital Territory', 'text-domain' );
		$states['NSW'] = esc_html__( 'New South Wales', 'text-domain' );
		$states['NT' ] = esc_html__( 'Northern Territory', 'text-domain' );
		$states['QLD'] = esc_html__( 'Queensland', 'text-domain' );
		$states['SA' ] = esc_html__( 'South Australia', 'text-domain' );
		$states['TAS'] = esc_html__( 'Tasmania', 'text-domain' );
		$states['VIC'] = esc_html__( 'Victoria', 'text-domain' );
		$states['WA' ] = esc_html__( 'Western Australia', 'text-domain' );

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

		$states['AB'] = esc_html__( 'Alberta', 'text-domain' );
		$states['BC'] = esc_html__( 'British Columbia', 'text-domain' );
		$states['MB'] = esc_html__( 'Manitoba', 'text-domain' );
		$states['NB'] = esc_html__( 'New Brunswick', 'text-domain' );
		$states['NL'] = esc_html__( 'Newfoundland and Labrador', 'text-domain' );
		$states['NT'] = esc_html__( 'Northwest Territories', 'text-domain' );
		$states['NS'] = esc_html__( 'Nova Scotia', 'text-domain' );
		$states['NU'] = esc_html__( 'Nunavut', 'text-domain' );
		$states['ON'] = esc_html__( 'Ontario', 'text-domain' );
		$states['PE'] = esc_html__( 'Prince Edward Island', 'text-domain' );
		$states['QC'] = esc_html__( 'Quebec', 'text-domain' );
		$states['SK'] = esc_html__( 'Saskatchewan', 'text-domain' );
		$states['YT'] = esc_html__( 'Yukon', 'text-domain' );

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

		$states['AL'] = esc_html__( 'Alabama', 'text-domain' );
		$states['AK'] = esc_html__( 'Alaska', 'text-domain' );
		$states['AZ'] = esc_html__( 'Arizona', 'text-domain' );
		$states['AR'] = esc_html__( 'Arkansas', 'text-domain' );
		$states['CA'] = esc_html__( 'California', 'text-domain' );
		$states['CO'] = esc_html__( 'Colorado', 'text-domain' );
		$states['CT'] = esc_html__( 'Connecticut', 'text-domain' );
		$states['DE'] = esc_html__( 'Delaware', 'text-domain' );
		$states['DC'] = esc_html__( 'District of Columbia', 'text-domain' );
		$states['FL'] = esc_html__( 'Florida', 'text-domain' );
		$states['GA'] = esc_html__( 'Georgia', 'text-domain' );
		$states['HI'] = esc_html__( 'Hawaii', 'text-domain' );
		$states['ID'] = esc_html__( 'Idaho', 'text-domain' );
		$states['IL'] = esc_html__( 'Illinois', 'text-domain' );
		$states['IN'] = esc_html__( 'Indiana', 'text-domain' );
		$states['IA'] = esc_html__( 'Iowa', 'text-domain' );
		$states['KS'] = esc_html__( 'Kansas', 'text-domain' );
		$states['KY'] = esc_html__( 'Kentucky', 'text-domain' );
		$states['LA'] = esc_html__( 'Louisiana', 'text-domain' );
		$states['ME'] = esc_html__( 'Maine', 'text-domain' );
		$states['MD'] = esc_html__( 'Maryland', 'text-domain' );
		$states['MA'] = esc_html__( 'Massachusetts', 'text-domain' );
		$states['MI'] = esc_html__( 'Michigan', 'text-domain' );
		$states['MN'] = esc_html__( 'Minnesota', 'text-domain' );
		$states['MS'] = esc_html__( 'Mississippi', 'text-domain' );
		$states['MO'] = esc_html__( 'Missouri', 'text-domain' );
		$states['MT'] = esc_html__( 'Montana', 'text-domain' );
		$states['NE'] = esc_html__( 'Nebraska', 'text-domain' );
		$states['NV'] = esc_html__( 'Nevada', 'text-domain' );
		$states['NH'] = esc_html__( 'New Hampshire', 'text-domain' );
		$states['NJ'] = esc_html__( 'New Jersey', 'text-domain' );
		$states['NM'] = esc_html__( 'New Mexico', 'text-domain' );
		$states['NY'] = esc_html__( 'New York', 'text-domain' );
		$states['NC'] = esc_html__( 'North Carolina', 'text-domain' );
		$states['ND'] = esc_html__( 'North Dakota', 'text-domain' );
		$states['OH'] = esc_html__( 'Ohio', 'text-domain' );
		$states['OK'] = esc_html__( 'Oklahoma', 'text-domain' );
		$states['OR'] = esc_html__( 'Oregon', 'text-domain' );
		$states['PA'] = esc_html__( 'Pennsylvania', 'text-domain' );
		$states['RI'] = esc_html__( 'Rhode Island', 'text-domain' );
		$states['SC'] = esc_html__( 'South Carolina', 'text-domain' );
		$states['SD'] = esc_html__( 'South Dakota', 'text-domain' );
		$states['TN'] = esc_html__( 'Tennessee', 'text-domain' );
		$states['TX'] = esc_html__( 'Texas', 'text-domain' );
		$states['UT'] = esc_html__( 'Utah', 'text-domain' );
		$states['VT'] = esc_html__( 'Vermont', 'text-domain' );
		$states['VA'] = esc_html__( 'Virginia', 'text-domain' );
		$states['WA'] = esc_html__( 'Washington', 'text-domain' );
		$states['WV'] = esc_html__( 'West Virginia', 'text-domain' );
		$states['WI'] = esc_html__( 'Wisconsin', 'text-domain' );
		$states['WY'] = esc_html__( 'Wyoming', 'text-domain' );
		$states['AS'] = esc_html__( 'American Samoa', 'text-domain' );
		$states['AA'] = esc_html__( 'Armed Forces America (except Canada)', 'text-domain' );
		$states['AE'] = esc_html__( 'Armed Forces Africa/Canada/Europe/Middle East', 'text-domain' );
		$states['AP'] = esc_html__( 'Armed Forces Pacific', 'text-domain' );
		$states['FM'] = esc_html__( 'Federated States of Micronesia', 'text-domain' );
		$states['GU'] = esc_html__( 'Guam', 'text-domain' );
		$states['MH'] = esc_html__( 'Marshall Islands', 'text-domain' );
		$states['MP'] = esc_html__( 'Northern Mariana Islands', 'text-domain' );
		$states['PR'] = esc_html__( 'Puerto Rico', 'text-domain' );
		$states['PW'] = esc_html__( 'Palau', 'text-domain' );
		$states['VI'] = esc_html__( 'Virgin Islands', 'text-domain' );

		if ( ! empty( $state ) ) {

			return $states[$state];

		}

		return $states;

	} // states_list_unitedstates()

	/**
	 * Returns TRUE based on which link type is selected, otherwise FALSE
	 *
	 * @param 	object 		$control 			The control object
	 * @return 	bool 							TRUE if conditions are met, otherwise FALSE
	 */
	public function states_of_country_callback( $control ) {

		$country_setting = $control->manager->get_setting('country')->value();

		//wp_die( print_r( $radio_setting ) );
		//wp_die( print_r( $control->id ) );

		if ( 'us_state' === $control->id && 'US' === $country_setting ) { return true; }
		if ( 'canada_state' === $control->id && 'CA' === $country_setting ) { return true; }
		if ( 'australia_state' === $control->id && 'AU' === $country_setting ) { return true; }
		if ( 'default_state' === $control->id && ! $this->custom_countries( $country_setting ) ) { return true; }

		return false;

	} // states_of_country_callback()

} // class
