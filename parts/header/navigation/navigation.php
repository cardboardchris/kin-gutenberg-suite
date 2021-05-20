<?php

include( __DIR__ . '/menu-toggle/menu-toggle.php' );

if ( has_nav_menu( 'primary' ) ) {
    wp_nav_menu( array(
        'theme_location' => 'primary',
        'container' => false,
        'menu_id' => 'primary-menu',
        'walker' => new Aria_Walker_Nav_Menu(),
        'items_wrap' => '<ul id="%1$s" class="%2$s" role="menubar">%3$s</ul>',
        'link_before'    => '<span>',
        'link_after'     => '</span>',
        'after'          => '<button class="expander">
                                <svg class="icon-chevron-down" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 11.47 7.5">
                                    <title>chevron</title>
                                    <path d="M5.73,7.5h0A1,1,0,0,1,5,7.15L.24,1.65A1,1,0,0,1,1.76.35L5.73,5l4-4.62a1,1,0,1,1,1.52,1.3L6.49,7.15A1,1,0,0,1,5.73,7.5Z"/>
                                </svg>
                                </button>'

    ) );
}
