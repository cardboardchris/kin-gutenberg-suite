<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package uncgonline
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'uncgonline'); ?></a>

    <header id="masthead" class="site-header" role="banner">
        <div class="site-branding">
            <p class="site-title">
                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?><span class="site-description"><?php bloginfo('description'); ?></span>
                </a>
            </p>

        </div><!-- .site-branding -->

        <nav id="site-navigation" class="main-navigation" role="navigation">
            <?php
            include( __DIR__ . '/navigation/navigation.php' );
            include( __DIR__ . '/search/search.php' );
            ?>
            </nav><!-- #site-navigation -->
    </header><!-- #masthead -->

    <?php if (get_field('site_banner', 'option')) : ?>
        <div class="site-banner" style="background-image: url(<?php the_field('site_banner', 'option'); ?>);">
            <?php
            //    if ( get_current_page_depth() > 1 ) {
            include( __DIR__ . '/page-menu/page-menu.php' );
            //    }
            ?>
        </div>
    <?php endif; ?>

    <div id="content" class="site-content">
