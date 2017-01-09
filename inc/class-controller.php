<?php

/**
 * The file that defines the core actions and filters for the theme
 *
 * @since 		1.0.0
 *
 * @package 	Mervis_2016
 */
class Mervis_2016_Controller {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the theme.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Mervis_2016_Loader    $loader    Maintains and registers all hooks for the theme.
	 */
	protected $loader;

	/**
	 * The unique identifier of this theme.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $theme_name    The string used to uniquely identify this theme.
	 */
	protected $theme_name;

	/**
	 * The current version of the theme.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the theme.
	 */
	protected $version;

	/**
	 * Define the core functionality of the theme.
	 *
	 * Set the theme name and the theme version that can be used throughout the theme.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->theme_name 	= 'mervis-2016';
		$this->version 		= '1.0.0';

		$this->load_dependencies();
		$this->define_utility_hooks();
		$this->define_menu_hooks();
		$this->define_theme_hooks();
		$this->define_metabox_hooks();
		$this->define_post_format_hooks();
		$this->define_automattic_hooks();
		$this->define_customizer_hooks();

	} // __construct()

	/**
	 * Load the required dependencies for this theme.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		$this->loader 		= new Mervis_2016_Loader();
		//$this->sanitizer 	= new Mervis_2016_Sanitize();

	} // load_dependencies()

	/**
	 * Register all of the hooks related to Automattic plugin compatiblity.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 */
	private function define_automattic_hooks() {

		$theme_automattic = new Mervis_2016_Automattic( $this->get_theme_name(), $this->get_version() );

		$this->loader->action( 'after_setup_theme', $theme_automattic, 'jetpack_setup' );
		$this->loader->action( 'after_setup_theme', $theme_automattic, 'wpcom_setup' );

	} // define_automattic_hooks()

	/**
	 * Register all of the hooks related to the Customizer.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 */
	private function define_customizer_hooks() {

		$theme_customizer = new Mervis_2016_Customizer( $this->get_theme_name(), $this->get_version() );

		$this->loader->action( 'customize_register', 					$theme_customizer, 'register_panels' );
		$this->loader->action( 'customize_register', 					$theme_customizer, 'register_sections' );
		$this->loader->action( 'customize_register', 					$theme_customizer, 'register_fields' );
		$this->loader->action( 'wp_head', 								$theme_customizer, 'header_output' );
		$this->loader->action( 'customize_register', 					$theme_customizer, 'load_customize_controls', 0 );

	} // define_customizer_hooks()

	/**
	 * Register all of the hooks related to customizing the appearance of the menus.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_menu_hooks() {

		$theme_menu = new Mervis_2016_Menukit( $this->get_theme_name(), $this->get_version() );

		$this->loader->filter( 'walker_nav_menu_start_el', 	$theme_menu, 'menu_show_hide', 10, 4 );
		$this->loader->filter( 'walker_nav_menu_start_el', 	$theme_menu, 'add_icons_to_menu', 10, 4 );
		$this->loader->filter( 'wp_nav_menu_items', 		$theme_menu, 'add_search_to_menu', 10, 2 );

	} // define_menu_hooks()

	/**
	 * Register all of the hooks related to metaboxes
	 *
	 * @since 		1.0.0
	 * @access 		private
	 */
	private function define_metabox_hooks() {

		//$theme_metaboxes = new Mervis_2016_Metaboxes( $this->get_theme_name(), $this->get_version() );

		$theme_metaboxes = new Mervis_2016_Metaboxes_Menus( $this->get_theme_name(), $this->get_version() );

		$this->loader->action( 'add_meta_boxes', 				$theme_metaboxes, 'add_metaboxes' );
		$this->loader->action( 'save_post', 					$theme_metaboxes, 'validate_meta', 10, 2 );
		//$this->loader->action( 'edit_form_after_title', 		$theme_metaboxes, 'metabox_subtitle', 10, 2 );
		$this->loader->action( 'add_meta_boxes', 				$theme_metaboxes, 'set_meta' );
		//$this->loader->filter( 'post_type_labels', 				$theme_metaboxes, 'change_featured_image_labels', 10, 1 );

	} // define_metabox_hooks()

	/**
	 * Register all hooks related to post formats.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 */
	private function define_post_format_hooks() {

		//$theme_formats = new Mervis_2016_Post_Format_Metaboxes( $this->get_theme_name(), $this->get_version() );

		//$this->loader->action( 'add_meta_boxes', 							$theme_formats, 'add_metaboxes' );
		//$this->loader->action( 'save_post', 								$theme_formats, 'validate_meta', 10, 2 );
		//$this->loader->action( 'add_meta_boxes', 							$theme_formats, 'set_meta' );
		//$this->loader->action( 'edit_form_after_title', 					$theme_formats, 'promote_metaboxes' );

	} // define_post_format_hooks()

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the theme.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_theme_hooks() {

		$theme_hooks = new Mervis_2016_Themehooks( $this->get_theme_name(), $this->get_version() );

		$this->loader->action( 'mervis_2016_header_top', 			$theme_hooks, 'header_wrap_begin', 10 );
		$this->loader->action( 'mervis_2016_header_top', 			$theme_hooks, 'site_branding_begin', 15 );
		$this->loader->action( 'mervis_2016_header_content', 			$theme_hooks, 'title_site', 10 );
		//$this->loader->action( 'mervis_2016_header_content', 			$theme_hooks, 'text_logo', 20 );
		$this->loader->action( 'mervis_2016_header_content', 			$theme_hooks, 'site_branding_end', 20 );
		$this->loader->action( 'mervis_2016_header_content', 			$theme_hooks, 'header_menus_wrap_begin', 25 );
		$this->loader->action( 'mervis_2016_header_content', 			$theme_hooks, 'menu_toptabs', 30 );
		$this->loader->action( 'mervis_2016_header_content', 			$theme_hooks, 'menu_header', 35 );
		$this->loader->action( 'mervis_2016_header_bottom', 		$theme_hooks, 'header_menus_wrap_end', 75 );
		$this->loader->action( 'mervis_2016_header_bottom', 		$theme_hooks, 'header_wrap_end', 85 );
		$this->loader->action( 'mervis_2016_header_after', 		$theme_hooks, 'slider_home', 10 );
		$this->loader->action( 'mervis_2016_header_after', 		$theme_hooks, 'featured_image', 10 );
		$this->loader->action( 'mervis_2016_header_after', 		$theme_hooks, 'menu_belowslider', 15 );
		$this->loader->action( 'mervis_2016_body_top', 					$theme_hooks, 'analytics_code', 10 );
		$this->loader->action( 'mervis_2016_body_top', 					$theme_hooks, 'skip_link', 20 );
		$this->loader->action( 'mervis_2016_content_top', 			$theme_hooks, 'breadcrumbs', 10 );
		$this->loader->action( 'mervis_2016_content_top', 			$theme_hooks, 'menubox_wrap_begin', 19 );
		$this->loader->action( 'mervis_2016_content_top', 			$theme_hooks, 'menu_menubox1', 20 );
		$this->loader->action( 'mervis_2016_content_top', 			$theme_hooks, 'menu_menubox2', 25 );
		$this->loader->action( 'mervis_2016_content_top', 			$theme_hooks, 'menu_menubox3', 30 );
		$this->loader->action( 'mervis_2016_content_top', 			$theme_hooks, 'menu_menubox4', 40 );
		$this->loader->action( 'mervis_2016_content_top', 			$theme_hooks, 'menubox_wrap_end', 41 );

		$this->loader->action( 'mervis_2016_while_before', 			$theme_hooks, 'title_archive', 10 );
		$this->loader->action( 'mervis_2016_while_before', 			$theme_hooks, 'title_single_post', 10 );
		$this->loader->action( 'mervis_2016_while_after', 				$theme_hooks, 'posts_nav' );
		$this->loader->action( 'mervis_2016_404_content', 			$theme_hooks, 'add_search', 10 );
		$this->loader->action( 'mervis_2016_404_content', 			$theme_hooks, 'four_04_posts_widget', 15 );
		$this->loader->action( 'mervis_2016_404_content', 			$theme_hooks, 'four_04_categories', 20 );
		$this->loader->action( 'mervis_2016_404_content', 			$theme_hooks, 'four_04_archives', 25 );
		$this->loader->action( 'mervis_2016_404_content', 			$theme_hooks, 'four_04_tag_cloud', 30 );
		$this->loader->action( 'entry_header_content', 					$theme_hooks, 'title_entry', 10 );
		$this->loader->action( 'entry_header_content', 					$theme_hooks, 'title_page', 10 );
		$this->loader->action( 'entry_header_content', 					$theme_hooks, 'title_search', 10 );
		$this->loader->action( 'entry_header_content', 					$theme_hooks, 'posted_on', 20 );
		$this->loader->action( 'mervis_2016_content_bottom', 			$theme_hooks, 'sidebar_news', 50 );
		$this->loader->action( 'mervis_2016_content_after', 		$theme_hooks, 'sidebar_home', 50 );
		$this->loader->action( 'mervis_2016_footer_before', 			$theme_hooks, 'sidebar_footer', 10 );
		$this->loader->action( 'mervis_2016_footer_top', 			$theme_hooks, 'footer_wrap_begin' );
		$this->loader->action( 'mervis_2016_footer_content', 			$theme_hooks, 'footer_content', 20 );
		$this->loader->action( 'mervis_2016_footer_bottom', 		$theme_hooks, 'footer_wrap_end' );



		/**
		 * Illini Castings Hooks
		 */
		$this->loader->action( 'castings_header_top', 			$theme_hooks, 'header_wrap_begin', 10 );
		$this->loader->action( 'castings_header_top', 			$theme_hooks, 'site_branding_begin', 15 );
		$this->loader->action( 'castings_header_content', 			$theme_hooks, 'title_site', 10 );
		//$this->loader->action( 'castings_header_content', 			$theme_hooks, 'text_logo', 20 );
		$this->loader->action( 'castings_header_content', 			$theme_hooks, 'site_branding_end', 20 );
		$this->loader->action( 'castings_header_content', 			$theme_hooks, 'header_menus_wrap_begin', 25 );
		$this->loader->action( 'castings_header_content', 			$theme_hooks, 'menu_castings_header', 35 );
		$this->loader->action( 'castings_header_bottom', 		$theme_hooks, 'header_menus_wrap_end', 75 );
		$this->loader->action( 'castings_header_bottom', 		$theme_hooks, 'header_wrap_end', 85 );
		$this->loader->action( 'castings_header_after', 			$theme_hooks, 'featured_image', 10 );
		$this->loader->action( 'castings_header_after', 			$theme_hooks, 'menu_castings_main', 15 );

	} // define_theme_hooks()

	/**
	 * Register all of the hooks related to the utility functions.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_utility_hooks() {

		$theme_utils = new Mervis_2016_Utilities( $this->get_theme_name(), $this->get_version() );

		$this->loader->action( 'after_setup_theme', 				$theme_utils, 'setup' );
		$this->loader->action( 'after_setup_theme', 				$theme_utils, 'content_width', 0 );
		$this->loader->action( 'widgets_init', 						$theme_utils, 'widgets_init' );

		$this->loader->filter( 'script_loader_tag', 				$theme_utils, 'async_scripts', 10, 2 );
		$this->loader->action( 'admin_enqueue_scripts', 			$theme_utils, 'enqueue_admin' );
		$this->loader->action( 'customize_preview_init', 			$theme_utils, 'enqueue_customizer' );
		$this->loader->action( 'customize_controls_enqueue_scripts', $theme_utils, 'enqueue_customizer_controls' );
		$this->loader->action( 'login_enqueue_scripts', 			$theme_utils, 'enqueue_login' );
		$this->loader->action( 'wp_enqueue_scripts', 				$theme_utils, 'enqueue_public' );
		$this->loader->filter( 'style_loader_src', 					$theme_utils, 'remove_cssjs_ver', 10, 2 );
		$this->loader->filter( 'script_loader_src', 				$theme_utils, 'remove_cssjs_ver', 10, 2 );

		$this->loader->filter( 'body_class', 						$theme_utils, 'page_body_classes' );
		$this->loader->action( 'wp_head', 							$theme_utils, 'background_images' );
		$this->loader->filter( 'get_search_form', 					$theme_utils, 'make_search_button_a_button' );
		$this->loader->filter( 'embed_oembed_html', 				$theme_utils, 'youtube_add_id_attribute', 99, 4 );
		$this->loader->action( 'init', 								$theme_utils, 'disable_emojis' );
		$this->loader->filter( 'excerpt_length', 					$theme_utils, 'excerpt_length' );
		$this->loader->filter( 'excerpt_more', 						$theme_utils, 'excerpt_read_more' );

		$this->loader->filter( 'post_mime_types', 					$theme_utils, 'add_mime_types' );
		$this->loader->filter( 'upload_mimes', 						$theme_utils, 'custom_upload_mimes' );
		$this->loader->filter( 'mce_buttons_2', 					$theme_utils, 'add_editor_buttons' );
		$this->loader->filter( 'manage_page_posts_columns', 		$theme_utils, 'page_template_column_head', 10 );
		$this->loader->action( 'manage_page_posts_custom_column', 	$theme_utils, 'page_template_column_content', 10, 2 );
		$this->loader->action( 'edit_category', 					$theme_utils, 'category_transient_flusher' );
		$this->loader->action( 'save_post', 						$theme_utils, 'category_transient_flusher' );
		//$this->loader->filter( 'wp_setup_nav_menu_item', 			$theme_utils, 'add_menu_title_as_class', 10, 1 );
		//$this->loader->filter( 'wp_nav_menu_container_allowedtags', $theme_utils, 'allow_section_tags_as_containers', 10, 1 );
		$this->loader->shortcode( 'listmenu', 						$theme_utils, 'list_menu' );

	} // define_utility_hooks()

	/**
	 * Get instance of main class
	 *
	 * @since 		1.0.0
	 * @return 		Mervis_2016_Controller
	 */
	public static function get_instance() {

		if ( empty( self::$_instance ) ) {

			self::$_instance = new self;

		}

		return self::$_instance;

	} // get_instance()

	/**
	 * The reference to the class that orchestrates the hooks with the theme.
	 *
	 * @since     1.0.0
	 *
	 * @return    Mervis_2016_Loader    Orchestrates the hooks of the theme.
	 */
	public function get_loader() {

		return $this->loader;

	} // get_loader()

	/**
	 * The name of the theme used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 *
	 * @return    string    The name of the theme.
	 */
	public function get_theme_name() {

		return $this->theme_name;

	} // get_theme_name()

	/**
	 * Retrieve the version number of the theme.
	 *
	 * @since     1.0.0
	 *
	 * @return    string    The version number of the theme.
	 */
	public function get_version() {

		return $this->version;

	} // get_version()



	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {

		$this->loader->run();

	} // run()

} // class
