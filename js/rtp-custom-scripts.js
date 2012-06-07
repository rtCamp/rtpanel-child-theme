/**
 * Custom Child Scripts
 */

jQuery( document ).ready( function() {
    /* Dropdown support for ie7 browsers (li:hover doesn't work in ie7 out of box) */
    jQuery('.ie7 #rtp-nav-menu li').hover(
        function() { jQuery(this).children('ul').css('display', 'block') },
        function() { jQuery(this).children('ul').css('display', 'none') }
    );
} );
