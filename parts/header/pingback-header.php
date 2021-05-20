<?php
/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function uncgonline_pingback_header() {
    if ( is_singular() && pings_open() ) {
        echo '<link rel="pingback" href="', bloginfo( 'pingback_url' ), '">';
    }
}
add_action( 'wp_head', 'uncgonline_pingback_header' );
