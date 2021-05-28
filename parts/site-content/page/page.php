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

        ?>
    </div><!-- .entry-content -->

    <?php
    if (get_current_page_depth() > 0) : ?>
        <div class="entry-navigation">
            <?php include(__DIR__.'/page-menu/page-menu-web.php'); ?>
        </div>
    <?php endif; ?>
</article><!-- #post-## -->

<?php if (get_edit_post_link()) : ?>
    <footer class="entry-footer">
        <?php

        do_action('spartan_pagination');

        edit_post_link(
            sprintf(
            /* translators: %s: Name of current post */
                esc_html__('Edit %s', 'uncgonline'),
                the_title('<span class="screen-reader-text">', '</span>', false)
            ),
            '<span class="edit-link">',
            '</span>'
        );
        ?>
    </footer><!-- .entry-footer -->
<?php endif; ?>
