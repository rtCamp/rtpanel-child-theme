<?php
/**
 * Custom Theme Options
 *
 * @package rtPanel
 */

/** 
 * Adds a Custom Theme Options Tab to rtPanel Theme Options
 * 
 * @since rtPanelChild 1.0
 */
function rtp_custom_theme_options( $theme_pages ) {
    $theme_pages['custom_theme_options'] = array(
                                    'menu_title' => __( 'Custom Theme Options', 'rtPanel' ),
                                    'menu_slug' => 'custom_theme_options'
                                );
    
    return $theme_pages;
}
add_filter( 'rtp_add_theme_pages', 'rtp_custom_theme_options' );

/** 
 * Default Values for the extended custom theme options
 * 
 * @since rtPanelChild 1.0
 */
function rtp_custom_theme_default_values() {
    $default_values = array(
                        'custom_text'      => '',
                        'custom_textarea'  => '',
                        'custom_image_id'  => '',
                    );

    if ( !get_option( 'custom_theme_options' ) ) {
        update_option( 'custom_theme_options', $default_values );
        $blog_users = get_users();

        /* Set screen layout to 1 by default for all users */
        foreach ( $blog_users as $blog_user ) {
          $blog_user_id = $blog_user->ID;
          if ( !get_user_meta( $blog_user_id, 'screen_layout_appearance_page_custom_theme_options' ) )
          update_user_meta( $blog_user_id, 'screen_layout_appearance_page_custom_theme_options', 1, NULL );
        }
    }

    return $default_values;
}

// Get the extended custom theme options from database
$rtp_custom_theme_options = ( get_option( 'custom_theme_options' ) ) ? get_option( 'custom_theme_options' ) : rtp_custom_theme_default_values(); // Ned Theme Options

/** 
 * Register the extended custom theme options settings api
 * 
 * @since rtPanelChild 1.0
 */
function rtp_register_settings() {
    register_setting( 'custom_theme_options_settings', 'custom_theme_options', 'rtp_custom_theme_options_validate');
}
add_action( 'admin_init', 'rtp_register_settings' );

/** 
 * Extended Custom Theme Options Page Markup
 * 
 * @since rtPanelChild 1.0
 */
function custom_theme_options_options_page( $pagehook ) {
    global $screen_layout_columns; ?>

    <div class="options-main-container">
        <?php settings_errors(); ?>
        <a href="#" class="expand-collapse button-link" title="Show/Hide All">Show/Hide All</a>
        <div class="clear"></div>
        <div class="options-container">
            <form name="custom_theme_options_form" id="custom_theme_options_form" action="options.php" method="post" enctype="multipart/form-data">
                <?php
                /* nonce for security purpose */
                wp_nonce_field( 'closedpostboxes', 'closedpostboxesnonce', false );
                wp_nonce_field( 'meta-box-order', 'meta-box-order-nonce', false ); ?>
                
                <input type="hidden" name="action" value="save_rtp_metaboxes_custom_theme_options" />
                <div id="poststuff" class="metabox-holder alignleft <?php echo 2 == $screen_layout_columns ? ' has-right-sidebar' : ''; ?>">
                    <div id="side-info-column" class="inner-sidebar">
                        <?php do_meta_boxes( $pagehook, 'side', '' ); ?>
                    </div>
                    <div id="post-body" class="has-sidebar">
                        <div id="post-body-content" class="has-sidebar-content">
                            <?php settings_fields( 'custom_theme_options_settings' ); ?>
                            <?php do_meta_boxes( $pagehook, 'normal', '' ); ?>
                        </div>
                    </div>
                    <br class="clear"/>
                    <input class="button-primary" value="<?php _e( 'Save All Changes', 'rtPanel' ); ?>" name="rtp_submit" type="submit" />
                    <input class="button-link" value="<?php _e( 'Reset All Custom Theme Option Settings', 'rtPanel' ); ?>" name="rtp_reset" type="submit" />
                </div>

                <script type="text/javascript">
                    //<![CDATA[
                    jQuery(document).ready( function($) {
                        // close postboxes that should be closed
                        $('.if-js-closed').removeClass('if-js-closed').addClass('closed');
                        // postboxes setup
                        postboxes.add_postbox_toggles('<?php echo $pagehook; ?>');
                    });
                    //]]>
                </script>
            </form>
        </div>
    </div><?php
}

/** 
 * Extended Custom Theme Options Metaboxes ( Screen Options )
 * 
 * @since rtPanelChild 1.0
 */
function rtp_custom_theme_options_screen_options() {
    add_meta_box( 'custom_theme_options', __( 'Custom Theme Options', 'rtPanel' ), 'rtp_custom_theme_options_metabox', 'appearance_page_custom_theme_options', 'normal', 'core' );
}
add_action( 'custom_theme_options_metaboxes', 'rtp_custom_theme_options_screen_options' );

/** 
 * Extended Custom Theme Options Contextual Help
 * 
 * @since rtPanelChild 1.0
 */
function rtp_custom_theme_option_contextual_help ( $contextual_help, $screen_id, $screen ) {
    if( 'appearance_page_custom_theme_options' == $screen_id ){
        $contextual_help = '<p>' . __( 'Custom Theme Options', 'rtPanel' ) . '</p>';
    }
    return $contextual_help;
}
add_filter('contextual_help', 'rtp_custom_theme_option_contextual_help', 10, 3);

/** 
 * Extended Custom Theme Options Metabox Markup
 * 
 * @since rtPanelChild 1.0
 */
function rtp_custom_theme_options_metabox() {
    global $rtp_custom_theme_options; ?>
    <table class="form-table">
        <tbody>
            <tr valign="top">
                <th scope="row"><label for="custom_text"><?php _e( 'Custom Text', 'rtPanel' ); ?></label></th>
                <td>
                    <input type="text" value="<?php echo $rtp_custom_theme_options['custom_text']; ?>" size="40" name="custom_theme_options[custom_text]" id="custom_text" />
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="custom_textarea"><?php _e( 'Custom Textarea', 'rtPanel' ); ?></label></th>
                <td>
                    <textarea cols="33" rows="5" name="custom_theme_options[custom_textarea]" id="custom_textarea"><?php echo $rtp_custom_theme_options['custom_textarea']; ?></textarea><br />
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="custom_image_uploader"><?php _e( 'Custom Image Uploader', 'rtPanel' ); ?></label></th>
                <td>
                    <input type="button" value="<?php _e( 'Upload Custom Image', 'rtPanel' ); ?>" class="button " id="custom_image_uploader" />
                    <input type="hidden"  name="custom_theme_options[custom_image_id]" id="custom_image_id" value="<?php if( isset( $rtp_custom_theme_options['custom_image_id'] ) ) echo $rtp_custom_theme_options['custom_image_id']; ?>" />
                </td>
                <td>
                    <?php $custom_image_uploader = wp_get_attachment_image_src( @$rtp_custom_theme_options['custom_image_id'], 'thumbnail' ); ?>
                    <img src="<?php echo @$custom_image_uploader[0] ?>" alt="Custom Image"<?php echo ( isset( $custom_image_uploader[0] ) ?  'style="max-width: 240px; width: 100%;"' : 'style="max-width: 240px; width: 100%; display: none;"' ); ?> />
                </td>
            </tr>
        </tbody>
    </table>
        <?php
}

/** 
 * Extended Custom Theme Options Validation Callback
 * 
 * @since rtPanelChild 1.0
 */
function rtp_custom_theme_options_validate( $input ) {
    if ( isset ( $_POST['rtp_submit'] ) ) {
       $input['custom_text'] = trim( $input['custom_text'] );
    } elseif ( isset ( $_POST['rtp_reset'] ) ) {
       $input = rtp_custom_theme_default_values();
       add_settings_error( 'custom_theme_options', 'reset_custom_theme_options', __( 'All Custom Theme Options have been restored to default.', 'rtPanel' ), 'updated' );
    }
    return $input;
}

/** 
 * Extended Custom Theme Options Page Scripts
 * Comment the following lines if not using Image Uploader or Custom Scripts for the Custom Theme Options Page
 * 
 * @since rtPanelChild 1.0
 */
function rtp_custom_theme_options_page_scripts() {
    wp_enqueue_script( 'rtp-theme-options', get_stylesheet_directory_uri() . '/js/rtp-theme-options.js', 'rtp-admin-scripts' );
}
add_action( 'admin_print_scripts-appearance_page_custom_theme_options', 'rtp_custom_theme_options_page_scripts', 999 );