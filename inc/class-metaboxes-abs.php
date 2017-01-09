<?php
/**
 * The metabox-specific functionality of the theme.
 *
 * @link 		http://slushman.com
 * @since 		1.0.0
 *
 * @package 	Mervis_2016
 */
class Mervis_2016_Metaboxes {

	/**
	 * The capabilities required for saving these metaboxes.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 			$caps 			The capability.
	 */
	private $caps = 'edit_post';

	/**
	 * The post type for this set of metaboxes.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 			$cpt 			This post type.
	 */
	private $cpt;

	/**
	 * Array of fields used in these metaboxes.
	 *
	 * @since 		1.0.0
	 *
	 * @var [type]
	 */
	private $fields;

	/**
	 * The post meta data
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 			$meta    			The post meta data.
	 */
	private $meta;

	/**
	 * The ID of this theme.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 			$theme_name 		The ID of this theme.
	 */
	private $theme_name;

	/**
	 * The version of this theme.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 			$version 			The current version of this theme.
	 */
	private $version;

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

		$this->set_caps();
		$this->set_cpt();

	} // __construct()

	/**
	 * Registers metaboxes with WordPress
	 *
	 * @hooked 		add_meta_boxes
	 * @since 		1.0.0
	 * @access 		public
	 */
	public function add_metaboxes() {

		// Define in child class.

	} // add_metaboxes()

	/**
	 * Check each nonce. If any don't verify, $nonce_check is increased.
	 * If all nonces verify, returns 0.
	 *
	 * @since 		1.0.0
	 * @access 		public
	 * @return 		int 		The value of $nonce_check
	 */
	private function check_nonces( $posted ) {

		$nonce_check 	= 0;
		$nonces 		= $this->nonces;

		foreach ( $nonces as $nonce ) {

			if ( ! isset( $posted[$nonce] ) ) { $nonce_check++; }
			if ( isset( $posted[$nonce] ) && ! wp_verify_nonce( $posted[$nonce], $this->theme_name ) ) { $nonce_check++; }

		}

		return $nonce_check;

	} // check_nonces()

	/**
	 * Calls a metabox file specified in the add_meta_box args.
	 *
	 * @exits 		Not in the admin.
	 * @exits 		Not on the correct post type.
	 * @since 		1.0.0
	 * @access 		public
	 */
	public function metabox( $post, $params ) {

		if ( ! is_admin() ) { return; }
		if ( $this->cpt != $post->post_type ) { return; }

		include( get_stylesheet_directory() . '/template-parts/metaboxes/' . $params['args']['file'] . '.php' );

	} // metabox()

	/**
	 * Checks conditions before validating metabox submissions.
	 *
	 * Returns FALSE under these conditions:
	 * 		Doing autosave.
	 * 		User doesn't have the capabilities.
	 * 		Not on the correct post type.
	 * 		Nonces don't validate.
	 *
	 * @param 		object 		$posted 		The submitted data.
	 * @param 		int 		$post_id 		The post ID.
	 * @param 		object 		$post 			The post object.
	 * @return 		bool 						FALSE if any conditions are met, otherwise TRUE.
	 */
	private function pre_validation_checks( $posted, $post_id, $post ) {

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return FALSE; }
		if ( ! current_user_can( $this->caps, $post_id ) ) { return FALSE; }
		if ( $this->cpt != $post->post_type ) { return FALSE; }

		$nonce_check = $this->check_nonces( $posted );

		if ( 0 < $nonce_check ) { return FALSE; }

		return TRUE;

	} // pre_validation_checks()

	/**
	 * Sets the class variable $caps.
	 */
	private function set_caps() {

		$this->caps = 'edit_post';

	} // set_caps()

	/**
	 * Sets the class variable $cpt.
	 */
	private function set_cpt() {

		$this->cpt = '';

	} // set_cpt()

	/**
	 * Sets the class variable $options
	 *
	 * @exits 		Post is empty.
	 * @exits 		Not on the correct post type.
	 * @hooked 		add_meta_boxes
	 */
	public function set_meta() {

		global $post;

		if ( empty( $post ) ) { return; }
		if ( $this->cpt != $post->post_type ) { return; }

		$this->meta = get_post_custom( $post->ID );

	} // set_meta()

	/**
	 * Saves metabox data
	 *
	 * @hooked 		save_post 		10
	 * @since 		1.0.0
	 * @access 		public
	 * @param 		int 			$post_id 		The post ID
	 * @param 		object 			$post 			The post object
	 */
	public function validate_meta( $post_id, $post ) {

		$validate = $this->pre_validation_checks( $_POST, $post_id, $post );

		if ( ! $validate ) { return $post_id; }

		$fields = $this->fields;

		foreach ( $fields as $meta ) {

			$value 		= ( empty( $this->meta[$meta[0]][0] ) ? '' : $this->meta[$meta[0]][0] );
			$sanitizer 	= new Mervis_2016_Sanitize();
			$new_value 	= $sanitizer->clean( $_POST[$meta[0]], $meta[1] );

			update_post_meta( $post_id, $meta[0], $new_value );

			unset( $value );
			unset( $sanitizer );
			unset( $new_value );

		} // foreach

	} // validate_meta()

} // class
