<?php
/**
 * The metabox-specific functionality of the theme.
 *
 * @link 		http://slushman.com
 * @since 		1.0.0
 *
 * @package 	TCCi
 */
class Mervis_2016_Post_Format_Metaboxes {

	/**
	 * The post meta data
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 			$meta    			The post meta data.
	 */
	private $meta;

	/**
	 * The post type.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 			$posttype    			The post type.
	 */
	private $posttype;

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
		$this->posttype 	= 'post';

	} // __construct()

	/**
	 * Registers metaboxes with WordPress
	 *
	 * @since 	1.0.0
	 * @access 	public
	 */
	public function add_metaboxes() {

		//remove_meta_box( 'postimagediv', 'employee', 'side' );

		// add_meta_box( $id, $title, $callback, $screen, $context, $priority, $callback_args );

		add_meta_box(
			'post_format_link',
			apply_filters( $this->theme_name . '-post-format-link-title', esc_html__( 'Post Link', 'mervis-2016' ) ),
			array( $this, 'metabox' ),
			'post',
			'top',
			'high',
			array(
				'file' => 'post-format-link'
			)
		);

		add_meta_box(
			'post_format_video',
			apply_filters( $this->theme_name . '-post-format-video-title', esc_html__( 'Post Video', 'mervis-2016' ) ),
			array( $this, 'metabox' ),
			'post',
			'top',
			'high',
			array(
				'file' => 'post-format-video'
			)
		);

		add_meta_box(
			'post_format_image',
			apply_filters( $this->theme_name . '-post-format-image-title', esc_html__( 'Post Image', 'mervis-2016' ) ),
			array( $this, 'metabox' ),
			'post',
			'top',
			'high',
			array(
				'file' => 'post-format-image'
			)
		);

		/*add_meta_box(
			'metabox_name',
			apply_filters( $this->theme_name . '-metabox-name-title', esc_html__( 'Metabox Name', 'mervis-2016' ) ),
			array( $this, 'metabox' ),
			'posttypename',
			'normal',
			'default',
			array(
				'file' => 'metabox'
			)
		);*/

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

		$nonces 		= array();
		$nonce_check 	= 0;
		$nonces[] 		= 'nonce_tcci_post_link';
		$nonces[] 		= 'nonce_tcci_post_image';
		$nonces[] 		= 'nonce_tcci_post_video';

		foreach ( $nonces as $nonce ) {

			if ( ! isset( $posted[$nonce] ) ) { $nonce_check++; }
			if ( isset( $posted[$nonce] ) && ! wp_verify_nonce( $posted[$nonce], $this->theme_name ) ) { $nonce_check++; }

		}

		return $nonce_check;

	} // check_nonces()

	/**
	 * Enqueues admin scripts specific to post formats.
	 */
	public function enqueue() {

		wp_enqueue_media();

		wp_enqueue_script( $this->theme_name . '-file-uploader', get_stylesheet_directory() . 'js/file-uploader.js', array( 'jquery' ), $this->version, true );

		wp_enqueue_script( $this->theme_name . '-post-formats', get_template_directory_uri() . '/js/post-formats.js', array( 'jquery' ), $this->version, true );

	} // enqueue

	/**
	 * Returns an array of the all the metabox fields and their respective types
	 *
	 * $fields[] 	= array( 'field-name', 'field-type', 'Field Label' );
	 *
	 * @since 		1.0.0
	 * @access 		public
	 * @return 		array 		Metabox fields and types
	 */
	private function get_metabox_fields() {

		$fields = array();

		$fields[] 	= array( 'post-link', 'url', '' );
		$fields[] 	= array( 'post-video', 'url', '' );
		$fields[] 	= array( 'post-image', 'url', '' );

		return $fields;

	} // get_metabox_fields()

	/**
	 * Calls a metabox file specified in the add_meta_box args for post format metaboxes.
	 *
	 * @since 	1.0.0
	 * @access 	public
	 * @return 	void
	 */
	public function metabox( $post, $params ) {

		if ( ! is_admin() ) { return; }
		if ( $this->posttype != $post->post_type ) { return; }

		include( get_stylesheet_directory() . '/metaboxes/' . $params['args']['file'] . '.php' );

	} // metabox()

	/**
	 * Adds classes to post format metaboxes.
	 *
	 * @param 		array 		$classes 		Current metabox classes
	 * @return 		array 						Modified metabox classes
	 */
	public function metabox_classes_post_formats( $classes ) {

		$classes[] = 'post-format-metabox';
		$classes[] = 'hide';

		return $classes;

	} // metabox_classes_post_formats()

	/**
	 * Adds all metaboxes in the "top" priority to just under the title field.
	 */
	public function promote_metaboxes() {

		global $post, $wp_meta_boxes;

		do_meta_boxes( get_current_screen(), 'top', $post );

		unset( $wp_meta_boxes[get_post_type( $post )]['top'] );

	} // promote_metaboxes()

	/**
	 * Sets the class variable $options
	 */
	public function set_meta() {

		global $post;

		if ( empty( $post ) ) { return; }
		if ( $this->posttype != $post->post_type ) { return; }

		$this->meta = get_post_custom( $post->ID );

	} // set_meta()

	/**
	 * Saves metabox data
	 *
	 * @since 		1.0.0
	 * @access 		public
	 *
	 * @param 		int 		$post_id 		The post ID
	 * @param 		object 		$post 			The post object
	 */
	public function validate_meta( $post_id, $post ) {

		//wp_die( 'valdaite' );

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return $post_id; }
		if ( ! current_user_can( 'edit_post', $post_id ) ) { return $post_id; }
		if ( $this->posttype != $post->post_type ) { return $post_id; }

		$nonce_check = $this->check_nonces( $_POST );

		if ( 0 < $nonce_check ) { return $post_id; }

		$metas = $this->get_metabox_fields();

		foreach ( $metas as $meta ) {

			$value 		= ( empty( $this->meta[$meta[0]][0] ) ? '' : $this->meta[$meta[0]][0] );
			$sanitizer 	= new TCCi_Sanitize();
			$new_value 	= $sanitizer->clean( $_POST[$meta[0]], $meta[1] );

			update_post_meta( $post_id, $meta[0], $new_value );

			unset( $sanitizer );

		} // foreach

	} // validate_meta()

} // class
