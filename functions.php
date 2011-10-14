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

// Includes PHP files located in 'lib' folder
foreach( glob ( get_stylesheet_directory() . "/lib/*.php" ) as $lib_filename ) {
    require_once( $lib_filename );
}