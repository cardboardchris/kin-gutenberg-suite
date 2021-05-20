<?php
/**
 * The search form template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package uncgonline
 */

?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label>
        <span class="screen-reader-text">Search for:</span>
        <input type="search" class="search-field" placeholder="Search …" value="" name="s" title="Search for:"/>
    </label>
    <button class="search-submit" type="submit" aria-label="search"><?php include( __DIR__ . '/search.svg' ); ?></button>
</form>
