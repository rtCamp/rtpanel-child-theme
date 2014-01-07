<?php
/**
 * Theme Options
 *
 * @package rtPanel
 */

/** 
 * Adds a Theme Options Tab to rtPanel Theme Options
 * @param string $theme_pages
 * @since rtPanelChild 1.0
 */
function rtp_theme_options( $theme_pages ) {
    $theme_pages['theme_options'] = array( 
        'menu_title' => __( 'Theme Options', 'rtPanel' ), 
        'menu_slug' => 'theme_options' 
    );
    
    return $theme_pages;
}
add_filter( 'rtp_add_theme_pages', 'rtp_theme_options' );

/** 
 * Default Values for the extended Theme Options
 * 
 * @since rtPanelChild 1.0
 */
function rtp_theme_default_values() {
    $default_values = array(
        /* Google Analytics */
        'rtp_google_analytics'  => '',
        
        /* Theme Options */
        'custom_text'           => '',
        'custom_textarea'       => '',
        'custom_image_id'       => ''
    );

    if ( !get_option( 'theme_options' ) ) {
        update_option( 'theme_options', $default_values );
        $blog_users = get_users();

        /* Set screen layout to 1 by default for all users */
        foreach ( $blog_users as $blog_user ) {
          $blog_user_id = $blog_user->ID;
          if ( !get_user_meta( $blog_user_id, 'screen_layout_appearance_page_theme_options' ) )
          update_user_meta( $blog_user_id, 'screen_layout_appearance_page_theme_options', 1, NULL );
        }
    }

    return $default_values;
}

// Get the extended Theme Options from database
$rtp_theme_options = ( get_option( 'theme_options' ) ) ? get_option( 'theme_options' ) : rtp_theme_default_values();

/** 
 * Register the extended Theme Options settings api
 * 
 * @since rtPanelChild 1.0
 */
function rtp_register_settings() {
    register_setting( 'theme_options_settings', 'theme_options', 'rtp_theme_options_validate');
}
add_action( 'admin_init', 'rtp_register_settings' );

/** 
 * Extended Theme Options Page Markup
 * 
 * @since rtPanelChild 1.0
 */
function theme_options_options_page( $pagehook ) {
    global $screen_layout_columns; ?>

    <div class="options-main-container">
        <?php settings_errors(); ?>
        <a href="#" class="expand-collapse button-link" title="Show/Hide All">Show/Hide All</a>
        <div class="clear"></div>
        <div class="options-container">
            <form name="theme_options_form" id="theme_options_form" action="options.php" method="post" enctype="multipart/form-data">
                <?php
                /* nonce for security purpose */
                wp_nonce_field( 'closedpostboxes', 'closedpostboxesnonce', false );
                wp_nonce_field( 'meta-box-order', 'meta-box-order-nonce', false ); ?>
                
                <input type="hidden" name="action" value="save_rtp_metaboxes_theme_options" />
                <div id="poststuff" class="metabox-holder alignleft <?php echo 2 == $screen_layout_columns ? ' has-right-sidebar' : ''; ?>">
                    <div id="side-info-column" class="inner-sidebar">
                        <?php do_meta_boxes( $pagehook, 'side', '' ); ?>
                    </div>
                    <div id="post-body" class="has-sidebar">
                        <div id="post-body-content" class="has-sidebar-content">
                            <?php settings_fields( 'theme_options_settings' ); ?>
                            <?php do_meta_boxes( $pagehook, 'normal', '' ); ?>
                        </div>
                    </div>
                    <br class="clear"/>
                    <input class="button-primary" value="<?php _e( 'Save All Changes', 'rtPanel' ); ?>" name="rtp_submit" type="submit" />
                    <input class="button-link" value="<?php _e( 'Reset All Theme Option Settings', 'rtPanel' ); ?>" name="rtp_reset" type="submit" />
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
 * Extended Theme Options Metaboxes ( Screen Options )
 * 
 * @since rtPanelChild 1.0
 */
function rtp_theme_options_screen_options() {
    add_meta_box( 'google_analytics_metabox', __( 'Google Analytics', 'rtPanel' ), 'rtp_google_analytics_metabox', 'appearance_page_theme_options', 'normal', 'core' );
    add_meta_box( 'theme_options', __( 'Theme Options', 'rtPanel' ), 'rtp_theme_options_metabox', 'appearance_page_theme_options', 'normal', 'core' );
}
add_action( 'theme_options_metaboxes', 'rtp_theme_options_screen_options' );

/**
 * Adds rtPanel Contextual help for Theme Options
 *
 * @return string
 *
 * @since rtPanelChild 2.0
 */
function rtp_child_theme_options_help() {
    $rtp_google_analytics_help = '<p>' . __( 'Add Google Analytics to the theme. <br />Add Google Analytics code to given textarea which will appear in Head Section of your Theme.', 'rtPanel' ) . '</p>';
    $rtp_theme_option_help = '<p>' . __( 'Theme Options Support Help.', 'rtPanel' ) . '</p>';
    $sidebar = '<p><strong>' . __( 'For more information, <br />you can always visit:', 'rtPanel' ) . '</strong></p>' .
            '<p><a href="' . RTP_THEME_URL . '" target="_blank" title="' . __( 'rtPanel Official Page', 'rtPanel' ) . '">' . __( 'rtPanel Official Page', 'rtPanel' ) . '</a></p>' .
            '<p><a href="' . RTP_DOCS_URL . '" target="_blank" title="' . __( 'rtPanel Documentation', 'rtPanel' ) . '">' . __( 'rtPanel Documentation', 'rtPanel' ) . '</a></p>' .
            '<p><a href="' . RTP_AUTHOR_URL . '" target="_blank" title="' . __( 'rtPanel Forum', 'rtPanel' ) . '">' . __( 'rtPanel Forum', 'rtPanel' ) . '</a></p>';

    $screen = get_current_screen();
    $screen->add_help_tab( array( 'title' => __( 'Google Analytics', 'rtPanel' ), 'id' => 'rtp_google_analytics_help', 'content' => $rtp_google_analytics_help ) );
    $screen->add_help_tab( array( 'title' => __( 'Theme Options', 'rtPanel' ), 'id' => 'rtp-theme-options-help', 'content' => $rtp_theme_option_help ) );
    $screen->set_help_sidebar( $sidebar );
}
add_action( 'load-appearance_page_theme_options', 'rtp_child_theme_options_help' );

/**
 * Extended Google Analytics Metabox Markup
 * 
 * @since rtPanelChild 1.0
 */
function rtp_google_analytics_metabox() {
    global $rtp_theme_options; ?>
    <table class="form-table">
        <tbody>
            <tr valign="top">
                <th scope="row"><label for="rtp_google_analytics"><?php _e( 'Google Analytics', 'rtPanel' ); ?></label></th>
                <td>
                    <textarea cols="50" rows="5" name="theme_options[rtp_google_analytics]" id="rtp_google_analytics"><?php echo esc_textarea( $rtp_theme_options['rtp_google_analytics'] ); ?></textarea>
                </td>
            </tr>
        </tbody>
    </table>
    <input class="button-primary" value="<?php _e( 'Save', 'rtPanel' ); ?>" name="rtp_submit" type="submit" /><?php
}

/** 
 * Extended Theme Options Metabox Markup
 * 
 * @since rtPanelChild 1.0
 */
function rtp_theme_options_metabox() {
    global $rtp_theme_options; ?>
    <table class="form-table">
        <tbody>
            <tr valign="top">
                <th scope="row"><label for="custom_text"><?php _e( 'Custom Text', 'rtPanel' ); ?></label></th>
                <td>
                    <input type="text" value="<?php echo esc_attr( $rtp_theme_options['custom_text'] ); ?>" size="40" name="theme_options[custom_text]" id="custom_text" />
                </td>
            </tr>

            <tr valign="top">
                <th scope="row"><label for="custom_textarea"><?php _e( 'Custom Textarea', 'rtPanel' ); ?></label></th>
                <td>
                    <textarea cols="50" rows="5" name="theme_options[custom_textarea]" id="custom_textarea"><?php echo esc_textarea( $rtp_theme_options['custom_textarea'] ); ?></textarea><br />
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">
                    <?php
                        $custom_image_var = 'custom_image_id';
                        $custom_image_id = $rtp_theme_options[$custom_image_var];
                    ?>
                    <label for="rtp_<?php echo $custom_image_var; ?>"><?php _e( 'Custom Image Uploader', 'rtPanel' ); ?></label>
                </th>

                <td>
                    <input type="button" value="<?php _e( 'Upload Custom Image', 'rtPanel' ); ?>" data-id="<?php echo $custom_image_var; ?>" class="button rtp-media-uploader" id="rtp_<?php echo $custom_image_var; ?>" />
                    <small class="file-added hide" style="background-color: #FFFFE0; border: 1px solid #e6db55; font-weight: bold; padding: 5px 8px;"><?php _e('File Added', 'rtPanel') ?></small>
                    <input type="hidden" name="theme_options[<?php echo $custom_image_var; ?>]" id="<?php echo $custom_image_var; ?>" value="<?php if( isset( $custom_image_id ) ) echo $custom_image_id; ?>" />
                </td>

                <td>
                    <?php 
                    $custom_image_uploader = wp_get_attachment_image_src( @$custom_image_id, 'thumbnail' ); ?>
                    <img src="<?php echo @$custom_image_uploader[0] ?>" alt="Custom Image"<?php echo ( isset( $custom_image_uploader[0] ) ?  'style="max-height: 100px; height: auto; max-width: 100px; width: auto;"' : 'style="display: none; max-height: 100px; height: auto; max-width: 100px; width: auto;"' ); ?> />
                </td>
            </tr>
        </tbody>
    </table><?php
}

/** 
 * Extended Theme Options Validation Callback
 * 
 * @since rtPanelChild 1.0
 */
function rtp_theme_options_validate( $input ) {
    if ( isset ( $_POST['rtp_submit'] ) ) {
       $input['custom_text'] = trim( $input['custom_text'] );
       $input['custom_image_id '] = trim( $input['custom_image_id '] );
    } elseif ( isset ( $_POST['rtp_reset'] ) ) {
       $input = rtp_theme_default_values();
       add_settings_error( 'theme_options', 'reset_theme_options', __( 'All Theme Options have been restored to default.', 'rtPanel' ), 'updated' );
    }
    return $input;
}

/** 
 * Extended Theme Options Page Scripts
 * Comment the following lines if not using Image Uploader or Custom Scripts for the Theme Options Page
 * 
 * @since rtPanelChild 1.0
 */
function rtp_theme_options_page_scripts() {
    // WP Enqueue Media
    if( function_exists( 'wp_enqueue_media' ) ) {
        wp_enqueue_media();
    }
    
    wp_enqueue_script( 'rtp-theme-options', get_stylesheet_directory_uri() . '/js/rtp-theme-options.js', 'rtp-admin-scripts' );
}
add_action( 'admin_print_scripts-appearance_page_theme_options', 'rtp_theme_options_page_scripts', 999 );