<?php
/**
 * Custom Taxonomies
 *
 * @package rtPanel
 */

/** 
 * Registers Taxonomies
 * 
 * @since rtPanelChild 1.0
 */
function rtp_create_taxonomies() {
    
    /* Post Custom Taxonomy */
    register_taxonomy( 'custom-taxonomy', 'post', array(
        'hierarchical' => true,
        'update_count_callback' => '',
        'rewrite' => true,
        'query_var' => 'custom-taxonomy',
        'public' => true,
        'show_ui' => null,
        'show_tagcloud' => null,
        '_builtin' => false,
        'labels' => array(
        'name' => _x( 'Custom Taxonomies', 'taxonomy general name', 'rtPanel' ),
        'singular_name' => _x( 'Custom Taxonomy', 'taxonomy singular name', 'rtPanel' ),
        'search_items' => __( 'Search Custom Taxonomies', 'rtPanel' ),
        'all_items' => __( 'All Custom Taxonomies', 'rtPanel' ),
        'parent_item' => array( null, __( 'Parent Custom Taxonomy', 'rtPanel' ) ),
        'parent_item_colon' => array( null, __( 'Parent Custom Taxonomy:', 'rtPanel' ) ),
        'edit_item' => __( 'Edit Custom Taxonomy', 'rtPanel' ),
        'view_item' => __( 'View Custom Taxonomy', 'rtPanel' ),
        'update_item' => __( 'Update Custom Taxonomy', 'rtPanel' ),
        'add_new_item' => __( 'Add New Custom Taxonomy', 'rtPanel' ),
        'new_item_name' => __( 'New Custom Taxonomy Name', 'rtPanel' ) ),
        'not_found' => __( 'No Custom Taxonomy Found', 'rtPanel' ),
        'capabilities' => array(),
        'show_in_nav_menus' => null,
        'label' => __( 'Custom Taxonomies', 'rtPanel' ),
        'sort' => true,
        'args' => array( 'orderby' => 'term_order' ) )
    );
    
    /* Custom Post Category */
    register_taxonomy( 'custom-post-category', 'custom-post', array(
        'hierarchical' => true,
        'update_count_callback' => '',
        'rewrite' => true,
        'query_var' => 'custom-post-category',
        'public' => true,
        'show_ui' => null,
        'show_tagcloud' => null,
        '_builtin' => false,
        'labels' => array(
        'name' => _x( 'Custom Post Categories', 'taxonomy general name', 'rtPanel' ),
        'singular_name' => _x( 'Custom Post Category', 'taxonomy singular name', 'rtPanel' ),
        'search_items' => __( 'Search Custom Post Categories', 'rtPanel' ),
        'all_items' => __( 'All Custom Post Categories', 'rtPanel' ),
        'parent_item' => array( null, __( 'Parent Custom Post Category', 'rtPanel' ) ),
        'parent_item_colon' => array( null, __( 'Parent Custom Post Category:', 'rtPanel' ) ),
        'edit_item' => __( 'Edit Custom Post Category', 'rtPanel' ),
        'view_item' => __( 'View Custom Post Category', 'rtPanel' ),
        'update_item' => __( 'Update Custom Post Category', 'rtPanel' ),
        'add_new_item' => __( 'Add New Custom Post Category', 'rtPanel' ),
        'new_item_name' => __( 'New Custom Post Category Name', 'rtPanel' ) ),
        'not_found' => __( 'No Custom Post Category Found', 'rtPanel' ),
        'capabilities' => array(),
        'show_in_nav_menus' => null,
        'label' => __( 'Custom Post Categories', 'rtPanel' ),
        'sort' => true,
        'args' => array( 'orderby' => 'term_order' ) )
    );
}
add_action( 'init', 'rtp_create_taxonomies' );