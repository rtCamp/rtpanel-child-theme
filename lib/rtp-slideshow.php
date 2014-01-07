<?php
/**
 * Custom Slideshows
 *
 * @package rtPanel
 * 
 * jQuery Cycle Plugin ( http://jquery.malsup.com/cycle/ )
 * 
 * Foundation Orbit Slider ( http://foundation.zurb.com/docs/components/orbit.html )
 */

/**
 * Usage:
 * Copy-Paste the following lines to use slider,
 * 
 * jQuery Cycle2 Slider
 * Provide the Valid Paramiters to rtp_get_cycle_slider() function.
 * 
    if ( function_exists( 'rtp_get_cycle_slider' ) ) {
        rtp_get_cycle_slider( __( 'Slider', 'rtPanel' ), 5, 100, false, false, false, true );
    }
 * 
 * Foundation based Orbit Slider
 * 
    if ( function_exists( 'rtp_orbit_slider' ) ) {
        rtp_orbit_slider( $custom_query, 5, 100, false, false, false, true );
    }
 * 
*/

/**
 * Returns Slider Markup
 *
 * @param int $slide_number The number of posts to show in slider
 * @param int $content_length The character limit for content
 * @param bool $show_title Set true to show title
 * @param bool $show_excerpt Set true to show excerpt content
 * @param bool $show_navigation Set true to show slider navigation
 * @param bool $show_pagination Set true to show slider pagination
 * @return string
 *
 * @since rtPanelChild 1.0
 */
function rtp_get_cycle_slider( $slide_number = 5, $content_length = 200, $show_title = true, $show_excerpt = true, $show_navigation = true, $show_pagination = true ) {
    $slider_q = new WP_Query( array( 'ignore_sticky_posts' => 1, 'posts_per_page' => $slide_number, 'order' => 'DESC' ) );

    $slider_image = '';
    $slider_pagination = false;
    $slider_html = '<div id="rtp-cycle-slider">';

    if ( $slider_q->have_posts() ) {
        $slider_html .= '<div class="cycle-slideshow rtp-cycle-slider-container" data-cycle-slides="div" data-cycle-log="false" data-cycle-timeout="3000" data-cycle-prev="#rtp-prev-cycle" data-cycle-next="#rtp-next-cycle">';

        while ( $slider_q->have_posts() ) { $slider_q->the_post();

            if ( has_post_thumbnail() ) {
                $image_details = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
                $slider_image = $image_details[0];
            }

            if ( $slider_image ) {
                $slider_html .= '<div class="cycle-slides">';
                    $slider_html .= '<a href="' . get_permalink() .'" title="'.  esc_attr( get_the_title() ) . '"><img class="cycle-slider-img" src ="' . $slider_image . '" alt="' . esc_attr( get_the_title() ) . '" /></a>';
                    $slider_html .= ( $show_title ) ? '<h1><a href="' . get_permalink() .'" title="'.  get_the_title().'" rel="bookmark">' . ( ( strlen( get_the_title() ) > 50 ) ? substr( get_the_title(), 0, 50 ) . "..." : get_the_title() ) . '</a></h1>' : '';
                    $slider_html .= ( $show_excerpt ) ? ( ( strlen( get_the_content() ) > $content_length ) ? wp_html_excerpt( get_the_content(), $content_length ) . '...' : wp_html_excerpt( get_the_content(), $content_length ) ) : '';
                $slider_html .= '</div>';
            }

            $slider_pagination = true;
        }

        $slider_html .= '</div>';
    }

    wp_reset_postdata();

    /* Uncomment following line if using pagination in the slider */
    if ( $slider_pagination && ( $show_navigation || $show_pagination ) ) {
        $slider_html .= '<div class="rtp-cycle-pagination" id="rtp-pager">';
            $slider_html .= ( $show_navigation ) ? '<a href="#" id="rtp-prev-cycle" class="previous-cycle"><span>'. __( 'Prev', 'rtPanel' ) . '</span></a><a href="#" id="rtp-next-cycle" class="next-cycle"><span>'. __( 'Next', 'rtPanel' ) . '</span></a>' : '';
        $slider_html .= '</div>';
    }

    $slider_html .= '</div>';

    echo $slider_html;
}

/**
 * Foundation Orbit Slider Funtion
 *
 * @param WP_Query $slider_q
 * @param type $slide_number
 * @param type $content_length
 * @param type $show_title
 * @param type $show_excerpt
 * @param type $show_navigation
 * @param type $show_pagination
 */
function rtp_orbit_slider ( WP_Query $slider_q = null, $slide_number = 100, $content_length = 200, $show_title = true, $show_excerpt = true, $show_navigation = true, $show_pagination = true ) {
    if ( $slider_q == null ) {
        $slider_q = new WP_Query ( array( 'ignore_sticky_posts' => 1, 'posts_per_page' => $slide_number, 'order' => 'DESC' ) );
    }

    if ( $slider_q->have_posts () ) {
        $slider_image = '';
        $slider_pagination = false;
        $slider_html = '<div class="rtp-orbit-slider-row"><ul data-orbit id="rtp-orbit-slider" data-options="timer_speed:2500; bullets:false;">';

        while ( $slider_q->have_posts () ) {
            $slider_q->the_post ();
            $image_details = wp_get_attachment_image_src ( get_post_thumbnail_id (), "full" );
            if ( $image_details ) {
                $slider_image = $image_details[ 0 ];
            } else {
                $slider_image = false;
            }

            if ( $slider_image ) {
                $slider_html .= '<li>';
                $slider_html .= '<img  src ="' . $slider_image . '" alt="' . esc_attr ( get_the_title () ) . '" data-interchange="' . rtp_img_attachement_interchange_string ( get_post_thumbnail_id (), "full", "full", "large" ) . '"/>';
                if ( $show_excerpt ) {
                    $slider_html .= "<div class='orbit-caption'>";
                    $slider_html .= ( strlen ( get_the_content () ) > $content_length ) ? wp_html_excerpt ( get_the_content (), $content_length ) . '... ' : wp_html_excerpt ( get_the_content (), $content_length );
                    $slider_html .="</div>";
                }

                $slider_html .= '</li>';
                $slider_pagination = true;
            }
        }

        $slider_html .= '</ul></div>';
        if ( $slider_pagination ) {
            echo $slider_html;
        }
    }
    wp_reset_postdata ();
}