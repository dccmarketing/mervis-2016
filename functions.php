<?php
/**
 * Mervis 2016 functions and definitions
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package Mervis_2016
 */

/**
 * Custom template tags for this theme.
 */
require get_stylesheet_directory() . '/inc/template-tags.php';

/**
 * Load The image function library
 */
require get_stylesheet_directory() . '/inc/imagekit.php';

/**
 * Load Slushman Themekit
 */
require get_stylesheet_directory() . '/inc/themekit.php';

/**
 * Load Main Menu Walker
 */
require get_stylesheet_directory() . '/inc/main-menu-walker.php';

/**
 * Autoloader function
 *
 * Will search both plugin root and includes folder for class
 *
 * @param string $class_name
 */
function mervis_2016_autoloader( $class_name ) {

	if ( 0 !== strpos( $class_name, 'Mervis_2016_' ) ) { return; }

	$class_name = str_replace( 'Mervis_2016_', '', $class_name );
	$lower 		= strtolower( $class_name );
	$file      	= 'class-' . str_replace( '_', '-', $lower ) . '.php';
	$base_path 	= trailingslashit( get_stylesheet_directory() );
	$paths[] 	= $base_path . $file;
	$paths[] 	= $base_path . 'classes/' . $file;
	$paths[] 	= $base_path . 'inc/' . $file;

	/**
	 * plugin_name_autoloader_paths filter
	 */
	$paths = apply_filters( 'mervis-2016-autoloader-paths', $paths );

	foreach ( $paths as $path ) :

		if ( is_readable( $path ) && file_exists( $path ) ) {

			require_once( $path );
			return;

		}

	endforeach;

} // mervis_2016_autoloader()

spl_autoload_register( 'mervis_2016_autoloader' );

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
call_user_func( array( new Mervis_2016_Controller(), 'run' ) );
