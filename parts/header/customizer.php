<?php
/**
 * UNCG Online Theme Customizer.
 *
 * @package uncgonline
 */

if ( function_exists( 'acf_add_options_page' ) ) {
    acf_add_options_page( array(
        'page_title' => 'Theme General Settings',
        'menu_title' => 'Theme Settings',
        'menu_slug' => 'theme-general-settings',
        'capability' => 'edit_posts',
    ) );

    acf_add_options_sub_page( array(
        'page_title' => 'Theme Options',
        'menu_title' => 'Options',
        'parent_slug' => 'theme-general-settings',
    ) );
}

/**
 * Set default values for customizer fields.
 */
function uncgonline_customizer_defaults() {
    $uncgonline_customizer_defaults = array();

    $uncgonline_customizer_defaults['primary_color'] = '#919191';

    $uncgonline_customizer_defaults['secondary_color'] = '#919191';

    $uncgonline_customizer_defaults['tertiary_color'] = '#919191';

    $uncgonline_customizer_defaults['custom_css'] = '';

    $uncgonline_customizer_vals['custom_css_file'] = false;

    return $uncgonline_customizer_defaults;
}

/**
 * Set values from custom fields.
 *
 * @return array
 */
function uncgonline_customizer_values() {
    $uncgonline_customizer_vals = uncgonline_customizer_defaults();
    if ( get_field( 'primary_color', 'option' ) ) {
        $uncgonline_customizer_vals['primary_color'] = get_field( 'primary_color', 'option' );
    }

    if ( get_field( 'secondary_color', 'option' ) ) {
        $uncgonline_customizer_vals['secondary_color'] = get_field( 'secondary_color', 'option' );
    }

    if ( get_field( 'tertiary_color', 'option' ) ) {
        $uncgonline_customizer_vals['tertiary_color'] = get_field( 'tertiary_color', 'option' );
    }

    if ( get_field( 'custom_css', 'option' ) ) {
        $uncgonline_customizer_vals['custom_css'] = get_field( 'custom_css', 'option' );
    }

    if ( get_field( 'custom_css_file', 'option' ) ) {
        $uncgonline_customizer_vals['custom_css_file'] = get_field( 'custom_css_file', 'option' );
    }

    return $uncgonline_customizer_vals;
}


/**
 * Add CSS from the customizer to the head.
 */
function uncgonline_customizer_css() {
    $uncgonline_customizer_vals = uncgonline_customizer_values();

    ?>
    <style type="text/css">
        .entry-content a,
        .entry-content a:visited,
        .entry-content a:active,
        .entry-content a:focus,
        .entry-content a:hover {
            color: <?php echo esc_html( $uncgonline_customizer_vals['primary_color'] ); ?>;
        }

        .table .table-row .table-cell.column-header,
        .wp-block-uncgonline-block-indent .indent-icon {
            background-color: <?php echo esc_html( $uncgonline_customizer_vals['primary_color'] ); ?>;
        }

        .wp-block-uncgonline-block-indent,
        .wp-block-uncgonline-block-btlo,
        .wp-block-uncgonline-block-tabs .nav-tabs .nav-item .nav-link.active {
            border-top-color: <?php echo esc_html( $uncgonline_customizer_vals['primary_color'] ); ?>;
        }

        .wp-block-uncgonline-block-indent .indent-icon:after,
        .wp-block-uncgonline-block-accordion .accordion-header .accordion-button[aria-expanded="true"] {
            border-left-color: <?php echo esc_html( $uncgonline_customizer_vals['primary_color'] ); ?>;
        }

        .menu-toggle[aria-expanded="true"] svg .st0,
        .menu-toggle[aria-expanded="true"] svg .st2,
        .search-button[aria-expanded="true"] svg .st0 {
            fill: <?php echo esc_html( $uncgonline_customizer_vals['secondary_color'] ); ?>;
        }

        .search-box {
            border-color: <?php echo esc_html( $uncgonline_customizer_vals['secondary_color'] ); ?>;
        }

        .main-navigation ul li.current-menu-item > a > span {
            border-bottom-color: <?php echo esc_html( $uncgonline_customizer_vals['secondary_color'] ); ?>;
        }

        .main-navigation ul a:hover,
        .main-navigation ul a.focus,
        .main-navigation ul a:focus,
        .main-navigation ul a:active {
            color: <?php echo esc_html( $uncgonline_customizer_vals['secondary_color'] ); ?>;
        }

        button:hover,
        input[type=button]:hover,
        input[type=reset]:hover,
        input[type=submit]:hover,
        .spartan-pagination-nav-buttons ul li a:hover {
            background-color: <?php echo esc_html( $uncgonline_customizer_vals['tertiary_color'] ); ?>;
        }

        <?php
        if ( $uncgonline_customizer_vals[ 'custom_css_file' ] ) {
            wp_enqueue_style( 'custom-css-file', esc_url( $uncgonline_customizer_vals[ 'custom_css_file' ] ) );
        }

        echo sanitize_text_field( $uncgonline_customizer_vals['custom_css'] );
        ?>
    </style>
    <?php
} // End uncgonline_customizer_css.
add_action( 'wp_head', 'uncgonline_customizer_css' );
