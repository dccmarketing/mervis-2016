<?php
/**
 * The metabox-specific functionality of the theme.
 *
 * @link 		http://slushman.com
 * @since 		1.0.0
 *
 * @package 	Mervis_2016
 */
class Mervis_2016_Metaboxes_Menus extends Mervis_2016_Metaboxes {

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 		1.0.0
	 * @param 		string 			$plugin_name 		The name of this theme.
	 * @param 		string 			$version 			The version of this theme.
	 */
	public function __construct( $theme_name, $version ) {

		$this->theme_name 	= $theme_name;
		$this->version 		= $version;

		$this->configure();

	} // __construct()

	private function configure() {

		$this->fields[] = '';

		$this->cpt = 'page';

	} // configure()

	/**
	 * Registers metaboxes with WordPress
	 *
	 * @hooked 		add_meta_boxes
	 * @since 		1.0.0
	 * @access 		public
	 */
	public function add_metaboxes() {

		add_meta_box(
			'subtitle',
			apply_filters( $this->theme_name . '-subtitle-title', esc_html__( 'Subtitle', 'mervis-2016' ) ),
			array( $this, 'metabox' ),
			'page',
			'normal',
			'default',
			array(
				'file' => 'subtitle'

			)
		);

	} // add_metaboxes()

} // class
