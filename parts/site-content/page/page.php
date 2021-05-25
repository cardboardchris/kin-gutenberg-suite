<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package uncgonline
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php
        include(__DIR__.'/page-menu/page-menu-mobile.php');
    ?>

    <div class="entry-content">

        <header class="entry-header">
            <h1 class="entry-title"><?php the_title(); ?></h1>
        </header><!-- .entry-header -->

        <?php

        the_content();

        do_action( 'spartan_pagination' );

        ?>
    </div><!-- .entry-content -->

    <div class="entry-navigation">
        <?php include(__DIR__.'/page-menu/page-menu-web.php'); ?>
    </div>

</article><!-- #post-## -->

<?php if ( get_edit_post_link() ) : ?>
    <footer class="entry-footer">
        <?php
        edit_post_link(
            sprintf(
            /* translators: %s: Name of current post */
                esc_html__( 'Edit %s', 'uncgonline' ),
                the_title( '<span class="screen-reader-text">', '</span>', false )
            ),
            '<span class="edit-link">',
            '</span>'
        );
        ?>
    </footer><!-- .entry-footer -->
<?php endif; ?>
