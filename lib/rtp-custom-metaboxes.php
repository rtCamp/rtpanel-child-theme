<?php
/**
 * Custom Metaboxes for Posts/Pages/Custom Posts
 *
 * @package rtPanel
 */

/* Define the custom box */

// WP 3.0+
add_action( 'add_meta_boxes', 'rtp_post_types_custom_box' );

// backwards compatible
add_action( 'admin_init', 'rtp_post_types_custom_box', 1 );

/* Do something with the data entered */
add_action( 'save_post', 'rtp_post_types_save_postdata' );

/**
 *  Adds a box to the main column on the Post and Page edit screens
 * 
 * @since rtPanelChild 1.0
 */
function rtp_post_types_custom_box() {
    add_meta_box( 'post_custom_field_id', __( 'Custom Field', 'rtPanel' ), 'rtp_posts_inner_custom_box', 'post', 'side', 'high' );
    add_meta_box( 'post_custom_field_id', __( 'Custom Field', 'rtPanel' ), 'rtp_posts_inner_custom_box', 'page', 'normal', 'high' );
}

/**
 *  Prints the box content
 * 
 * @since rtPanelChild 1.0
 */
function rtp_posts_inner_custom_box( $post ) { 
  wp_nonce_field( plugin_basename( __FILE__ ), $post->post_type . '_noncename' ); ?>
  <input name="_custom_checkbox" type="hidden" value="0" />
  <input id="_custom_checkbox" name="_custom_checkbox" type="checkbox" value="1" <?php checked( get_post_meta( $post->ID, '_custom_checkbox', true) ); ?> tabindex="4" /> <label for="_custom_checkbox" class="selectit"><?php _e( 'Custom Checkbox', 'rtPanel' ); ?></label><br /><br />
  <label for="_custom_text" class="selectit">Custom Text:</label><input type="text" id="_custom_text" name="_custom_text" value="<?php echo get_post_meta( $post->ID, '_custom_text', true ); ?>" size="25" /><?php
}

/** 
 * When the post is saved, saves our custom data 
 * 
 * @since rtPanelChild 1.0
 */
function rtp_post_types_save_postdata( $post_id ) {
  // verify if this is an auto save routine. 
  // If it is our form has not been submitted, so we dont want to do anything
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return;

  // verify this came from the our screen and with proper authorization,
  // because save_post can be triggered at other times

  if ( !wp_verify_nonce( @$_POST[$_POST['post_type'] . '_noncename'], plugin_basename( __FILE__ ) ) )
      return;
  
  // OK,nonce has been verified and now we can save the data according the the capabilities of the user
  if( 'page' == $_POST['post_type'] ) {
      if ( !current_user_can( 'edit_page', $post_id ) ) {
          return;
      } else {
          update_post_meta( $post_id, '_custom_checkbox', $_POST['_custom_checkbox'] );
          update_post_meta( $post_id, '_custom_text', $_POST['_custom_text'] );
      }
  } else {
      if ( !current_user_can( 'edit_post', $post_id ) ) {
          return;
      } else {
          update_post_meta( $post_id, '_custom_checkbox', $_POST['_custom_checkbox'] );
          update_post_meta( $post_id, '_custom_text', $_POST['_custom_text'] );
      }
  }

}