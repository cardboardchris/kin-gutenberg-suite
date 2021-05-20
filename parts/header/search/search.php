<button id="search-button" class="search-button" aria-controls="primary-search" aria-expanded="false">
    <span class="screen-reader-text">Search</span>
    <?php include( __DIR__ . '/search.svg' ); ?>
</button>
<div id="primary-search" class="search-box" aria-expanded="false">
    <?php get_search_form(); ?>
</div>
