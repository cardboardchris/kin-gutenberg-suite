<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.com/
 *
 * @package uncgonline
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/infinite-scroll/
 * See: https://jetpack.com/support/responsive-videos/
 */
function uncgonline_jetpack_setup() {

    // Add theme support for Responsive Videos.
    add_theme_support( 'jetpack-responsive-videos' );
}

add_action( 'after_setup_theme', 'uncgonline_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function uncgonline_infinite_scroll_render() {
    while ( have_posts() ) {
        the_post();
        if ( is_search() ) :
            include( __DIR__ . '/parts/content/search-results/template-search-results.php' );
        else :
            get_template_part( 'parts/' . get_post_format(). '/template', get_post_format() );
        endif;
    }
}
