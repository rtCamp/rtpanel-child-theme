/**
 * jQuery Cycle Plugin Scripts
 */

jQuery( document ).ready( function() {
    jQuery( '#rtp-cycle-slider .rtp-cycle-slider-container' ).cycle( {
        activePagerClass: 'active', // class name used for the active pager element 
        fx:            'fade',// name of transition effect (or comma separated names, ex: 'fade,scrollUp,shuffle') 
        height:        'auto',// container height (if the 'fit' option is true, the slides will be set to this height as well) 
        next:          '#rtp-next-cycle',  // element, jQuery object, or jQuery selector string for the element to use as event trigger for next slide 
        pager:         '#rtp-cycle-nav',  // element, jQuery object, or jQuery selector string for the element to use as pager container 
        pagerAnchorBuilder: pagerFactory, // callback fn for building anchor links:  function(index, DOMelement) 
        prev:          '#rtp-prev-cycle',  // element, jQuery object, or jQuery selector string for the element to use as event trigger for previous slide 
        speed:         1000,  // speed of the transition (any valid fx speed value) 
        timeout:       4000,  // milliseconds between slide transitions (0 to disable auto advance) 
        width:         null   // container width (if the 'fit' option is true, the slides will be set to this width as well) 
    });
    
    /* Uncomment the lines in the function for slider pagination */
    function pagerFactory( idx, slide ) {
    /*    var img;
        img = jQuery( slide ).find( 'img' ).attr( 'src' );

        //return '<span><a href="#">' + ( idx + 1 ) + '<img width="50" height="50" src="' + img + '" /></a></span>';
        return '<span><a href="#">' + ( idx + 1 ) + '</a></span>'; */
    }
});