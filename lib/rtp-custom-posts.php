<?php
/**
 * Custom Post Types
 *
 * @package rtPanel
 */

/** 
 * Registers Custom Post Types
 * 
 * @since rtPanelChild 1.0
 */
function rtp_create_post_types() {
    
    /* Custom Posts */
    register_post_type( 'custom-post', array(
        'labels' => array(
        'name' => _x('Custom Posts', 'post type general name', 'rtPanel'),
        'singular_name' => _x('Custom Post', 'post type singular name', 'rtPanel'),
        'add_new' => _x('Add New', 'custom post', 'rtPanel'),
        'add_new_item' => __('Add New Custom Post', 'rtPanel'),
        'edit_item' => __('Edit Custom Post', 'rtPanel'),
        'new_item' => __('New Custom Post', 'rtPanel'),
        'view_item' => __('View Custom Post', 'rtPanel'),
        'search_items' => __('Search Custom Posts', 'rtPanel'),
        'not_found' => __('No custom posts found.', 'rtPanel'),
        'not_found_in_trash' => __('No custom posts found in Trash.', 'rtPanel'),
        'parent_item_colon' => array( null, __('Parent Custom Post:', 'rtPanel') ),
        'all_items' => __( 'All Custom Posts', 'rtPanel' ) ),
        'description' => __( 'Custom Posts', 'rtPanel' ),
        'publicly_queryable' => null, 
        'exclude_from_search' => null,
        'capability_type' => 'post', 
        'capabilities' => array(), 
        'map_meta_cap' => null,
        '_builtin' => false, 
        '_edit_link' => 'post.php?post=%d', 
        'hierarchical' => false,
        'public' => true, 
        'rewrite' => true,
        'has_archive' => true, 
        'query_var' => true,
        'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
        'register_meta_box_cb' => null,
        'taxonomies' => array(), 
        'show_ui' => null, 
        'menu_position' => null, 
        'menu_icon' => null,
        'permalink_epmask' => EP_PERMALINK, 
        'can_export' => true,
        'show_in_nav_menus' => null, 
        'show_in_menu' => null, 
        'show_in_admin_bar' => null )
    );
    
}
add_action( 'init', 'rtp_create_post_types' );