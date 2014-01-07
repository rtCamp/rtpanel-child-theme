<?php
/**
 * rtPanel Child functions and definitions
 *
 * @package rtPanel
 * 
 * @since rtPanelChild 1.0
 */

/* Define Directory Constants */
    define( 'RTP_CHILD_CSS', get_stylesheet_directory_uri() . '/css' );
    define( 'RTP_CHILD_JS', get_stylesheet_directory_uri() . '/js' );
    define( 'RTP_CHILD_IMG', get_stylesheet_directory_uri() . '/img' );
    define( 'RTP_CHILD_ASSETS_URL', get_template_directory_uri() . '/assets' );
    define( 'RTP_CHILD_BOWER_COMPONENTS_URL', get_template_directory_uri() . '/assets/foundation/bower_components' );

// Includes PHP files located in 'lib' folder
foreach( glob ( get_stylesheet_directory() . "/lib/*.php" ) as $lib_filename ) {
    require_once( $lib_filename );
}