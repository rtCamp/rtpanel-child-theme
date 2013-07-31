/**
 * Theme Options Scripts
 */

jQuery(document).ready( function(){

    /* WP Media Uploader */
    var _rtp_media = true,
        _orig_send_attachment = wp.media.editor.send.attachment;

        jQuery('.rtp-media-uploader').click(function () {

            var button = jQuery(this),
                textbox_id = jQuery(this).attr('data-id'),
                image_id = jQuery(this).attr('data-src');

            _rtp_media = true;

            wp.media.editor.send.attachment = function (props, attachment) {

                //console.log(attachment);

                if ( _rtp_media && ( attachment.type === 'image' ) ) {
                    jQuery( '#'+ textbox_id ).val( attachment.id );
                    jQuery( '#'+ image_id ).attr( 'src', attachment.url );
                    button.next().show();
                } else {
                    alert('Please select a valid image file');
                    return false;
                }
            }

            wp.media.editor.open(button);
            return false;
        });

        jQuery('.add_media').on('click', function(){
            _rtp_media = false;
        });

});