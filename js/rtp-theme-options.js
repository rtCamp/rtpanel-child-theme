/**
 * Theme Options Scripts
 */

jQuery(document).ready( function(){
    
    /* Function to upload files using the media library */
    function media_upload( button_id, textbox_id, main_metabox_id, iframe_title ) {
        jQuery(button_id).click(function() {
            formfield = jQuery(textbox_id).attr('name');
            H = jQuery(window).height() - 80, W = ( 640 < jQuery(window).width() ) ? 640 : jQuery(window).width();
            tb_show( 'Upload '+iframe_title, 'media-upload.php?post_id=0&amp;rtp_theme=rtp_true&amp;logo_or_favicon=Logo&amp;type=image&amp;TB_iframe=true&amp;width='+W+'&amp;height='+H);
            window.send_to_editor = function(html) {
                imgurl = jQuery('img',html).attr('src');
                imgid = html.match(/wp-image-(\d+)/i);
                if( ( typeof(imgurl) !== 'undefined' ) && ( ( imgurl.match(/(.jpg|.jpeg|.jpe|.gif|.png|.bmp|.ico|.tif|.tiff)$/i) && ( iframe_title != 'Favicon' ) ) || ( imgurl.match(/(.ico)$/i) &&  ( iframe_title == 'Favicon' ) ) ) ) {
                    jQuery(textbox_id).val(imgid[1]);
                    jQuery(textbox_id).parent().next().children().attr('src', imgurl);
                    jQuery(textbox_id).parent().next().children().css('display', 'block');
                    tb_remove();
                } else {
                    if( iframe_title == 'Favicon' ) {
                        alert("Please select a valid favicon file (.ico)")
                    } else {
                        alert("Please select a valid image file.");
                    }
                    tb_remove();
                }
            }
            return false;
        });
    }
    
    media_upload( '#custom_image_uploader', '#custom_image_id', '#custom_theme_options', 'Custom Image' );
});