<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package uncgonline
 */

get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

            <?php
            if ( have_posts() ) : ?>

                <header class="page-header">
                    <?php
                    the_archive_title( '<h1 class="page-title">', '</h1>' );
                    the_archive_description( '<div class="archive-description">', '</div>' );
                    ?>
                </header><!-- .page-header -->

                <?php
                /* Start the Loop */
                while ( have_posts() ) : the_post();

                    /*
                     * Include the Post-Format-specific template for the content.
                     */

                    get_template_part( 'parts/' . get_post_format(). '/template', get_post_format() );

                endwhile;

                the_posts_navigation();

            else :

                include( __DIR__ . '/parts/site-content/none/template-none.php' );

		endif; ?>

        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_sidebar();
get_footer();
