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
        'name' => _x( 'Custom Taxonomies', 'taxonomy general name' ),
        'singular_name' => _x( 'Custom Taxonomy', 'taxonomy singular name' ),
        'search_items' => __( 'Search Custom Taxonomies' ),
        'all_items' => __( 'All Custom Taxonomies' ),
        'parent_item' => array( null, __( 'Parent Custom Taxonomy' ) ),
        'parent_item_colon' => array( null, __( 'Parent Custom Taxonomy:' ) ),
        'edit_item' => __( 'Edit Custom Taxonomy' ),
        'view_item' => __( 'View Custom Taxonomy' ),
        'update_item' => __( 'Update Custom Taxonomy' ),
        'add_new_item' => __( 'Add New Custom Taxonomy' ),
        'new_item_name' => __( 'New Custom Taxonomy Name' ) ),
        'capabilities' => array(),
        'show_in_nav_menus' => null,
        'label' => __( 'Custom Taxonomies' ),
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
        'name' => _x( 'Custom Post Categories', 'taxonomy general name' ),
        'singular_name' => _x( 'Custom Post Category', 'taxonomy singular name' ),
        'search_items' => __( 'Search Custom Post Categories' ),
        'all_items' => __( 'All Custom Post Categories' ),
        'parent_item' => array( null, __( 'Parent Custom Post Category' ) ),
        'parent_item_colon' => array( null, __( 'Parent Custom Post Category:' ) ),
        'edit_item' => __( 'Edit Custom Post Category' ),
        'view_item' => __( 'View Custom Post Category' ),
        'update_item' => __( 'Update Custom Post Category' ),
        'add_new_item' => __( 'Add New Custom Post Category' ),
        'new_item_name' => __( 'New Custom Post Category Name' ) ),
        'capabilities' => array(),
        'show_in_nav_menus' => null,
        'label' => __( 'Custom Post Categories' ),
        'sort' => true,
        'args' => array( 'orderby' => 'term_order' ) )
    );
    
}
add_action( 'init', 'rtp_create_taxonomies' );
