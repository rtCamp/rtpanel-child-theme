<?php
/**
 * Template Name: Custom Template
 * 
 * Custom Template Layout
 *
 * @package rtPanel
 *
 * @since rtPanelChild 2.0
 */
get_header(); ?>

    <section id="content" role="main" class="large-8 columns rtp-custom-page">
        <?php rtp_hook_begin_content(); ?>
        
        <?php
            /* the loop */
            if ( have_posts () ) {
                while( have_posts() ) {
                    the_post(); ?>

                    <article id="post-<?php the_ID(); ?>" <?php post_class( 'rtp-custom-box' ); ?>>
                        <?php rtp_hook_begin_post(); ?>

                        <header class="post-header clearfix">
                            <?php rtp_hook_begin_post_title(); ?>

                                <h1 class="post-title"><?php the_title(); ?></h1>
                                        
                            <?php rtp_hook_end_post_title(); ?>

                            <?php rtp_hook_post_meta( 'top' ); ?>

                        </header><!-- .post-title -->
                        
                        <div class="post-content clearfix">
                            <?php rtp_hook_begin_post_content(); ?>

                            <?php the_content( __( 'Read More &rarr;', 'rtPanel' ) ); ?>

                            <?php rtp_hook_end_post_content(); ?>

                        </div><!-- .post-content -->

                        <?php rtp_hook_post_meta( 'bottom' ); ?>

                        <?php rtp_hook_end_post(); ?>

                    </article><!-- .rtp-post-box --><?php

                    // Comment Form
                    rtp_hook_comments();
                }

            } ?>

        <?php rtp_hook_end_content(); ?>
    </section><!-- End of #content -->

<?php rtp_hook_sidebar(); ?>

<?php get_footer();
