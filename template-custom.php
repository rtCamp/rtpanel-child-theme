<?php
/**
 * Template Name: Custom Template
 * 
 * Custom Template Layout
 *
 * @package rtPanel
 *
 * @since rtPanelChild 1.0
 */
get_header(); ?>

    <div id="content" class="custom-page">
        <?php rtp_hook_begin_content(); ?>
        
        <?php
            /* the loop */
            if ( have_posts () ) {
                while( have_posts() ) {
                    the_post(); ?>

                    <div <?php post_class( 'rtp-custom-box' ); ?>>
                        <?php rtp_hook_begin_post(); ?>

                        <div class="post-title">
                            <?php rtp_hook_begin_post_title(); ?>

                                <h1><?php the_title(); ?></h1>

                            <?php rtp_hook_end_post_title(); ?>

                            <div class="clear"></div>
                        </div><!-- .post-title -->

                        <?php rtp_hook_post_meta( 'top' ); ?>

                        <div class="post-content">
                            
                            <?php rtp_hook_begin_post_content(); ?>

                            <?php the_content( __( 'Read More &rarr;', 'rtPanel' ) ); ?>

                            <?php rtp_hook_end_post_content(); ?>

                            <div class="clear"></div>
                        </div><!-- .post-content -->

                        <?php rtp_hook_post_meta( 'bottom' ); ?>

                        <?php rtp_hook_end_post(); ?>
                    </div><!-- .rtp-post-box --><?php

                } /* End of While Loop */
                
            } else {
                /* If there are no posts to display */ ?>
                <div id="post-0" <?php post_class('rtp-custom-box'); ?>>
                    <div class="hentry rtp-not-found">
                        <?php rtp_hook_begin_post(); ?>

                        <div class="post-content">
                            <p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'rtPanel' ); ?></p>
                            <?php get_search_form(); ?>
                        </div>

                        <?php rtp_hook_end_post();  ?>
                    </div>
                </div><!-- #post-0 --><?php
            } ?>        

        <?php rtp_hook_end_content(); ?>
    </div><!-- End of #content -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>