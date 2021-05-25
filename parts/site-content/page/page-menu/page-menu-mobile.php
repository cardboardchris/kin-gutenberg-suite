<nav class="page-navigation-mobile dropdown" role="navigation" aria-label="topic navigation">
    <button class="dropdown-toggle" type="button" id="secondaryMenuButton" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
        <span><?php echo get_post($post->post_parent)->post_title; ?>: <?php echo the_title(); ?></span>
    </button>
    <ul class="dropdown-menu" aria-labelledby="secondaryMenuButton" role="menubar">
        <?php echo wpb_list_child_pages_menu(); ?>
    </ul>
</nav>
