<?php
/**
 * Custom Slideshows
 *
 * @package rtPanel
 */

/* Uncomment following line if using a custom image size for the slider */
//add_image_size( 'rtp-slider', '600', '300', true );

/**
 * jQuery Cycle Plugin ( http://jquery.malsup.com/cycle/ )
 */
function rtp_get_cycle_slider() {
    $slider_html = '<div id="rtp-cycle-slider"><div class="rtp-cycle-slider-container">';
    query_posts( array( 'ignore_sticky_posts' => 1, 'posts_per_page' => 10, 'order' => 'DESC' ) );
    while ( have_posts() ) {
        the_post();
        $slider_html .= '<div class="cycle-slides">';
        if ( has_post_thumbnail() ) { 
            $image_details = wp_get_attachment_image_src( get_post_thumbnail_id(), 'rtp-slider' );
            $slider_image = $image_details[0];
        } else {
            $slider_image = rtp_generate_thumbs( '', 'rtp-slider' );
        }
            $slider_image = ( $slider_image ) ? $slider_image : RTP_CHILD_IMG . '/default-slider.jpg';
            $slider_html .= ( $slider_image ) ? '<a href="' . get_permalink() .'" title="'.  esc_attr( get_the_title() ) . '"><img class="cycle-slider-img" src ="' . $slider_image . '" alt="' . esc_attr( get_the_title() ) . '" /></a>' : '';
            $slider_html .= '<h1><a href="' . get_permalink() .'" title="'.  get_the_title().'" rel="bookmark">' . ( ( strlen( get_the_title() ) > 50 ) ? substr( get_the_title(), 0, 50 ) . "..." : get_the_title() ) . '</a></h1>' . get_the_excerpt();
        $slider_html .= '</div>';
    }
    wp_reset_query();
    $slider_html .= '</div>';

    /* Uncomment following line if using pagination in the slider */
    $slider_html .= '<div class="rtp-cycle-pagination"><a href="#" id="rtp-prev-cycle" class="previous-cycle"><span>'. __( 'Prev', 'rtPanel' ) . '</span></a><a href="#" id="rtp-next-cycle" class="next-cycle"><span>'. __( 'Prev', 'rtPanel' ) . '</span></a><div id="rtp-cycle-nav" class="rtp-pagination"></div></div>';

    $slider_html .= '</div>';
    return $slider_html;
}