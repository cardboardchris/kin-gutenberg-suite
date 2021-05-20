<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package uncgonline
 */

get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

            <?php
            while ( have_posts() ) : the_post();

                if ( get_post_type() ):
                    get_template_part( 'parts/' . get_post_type(). '/template', get_post_type() );
                else:
                    get_template_part( 'parts/' . get_post_format(). '/template', get_post_format() );
                endif;

                the_post_navigation();

            endwhile; // End of the loop.
            ?>

        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_sidebar();
get_footer();
