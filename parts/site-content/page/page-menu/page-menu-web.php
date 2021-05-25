<div class="page-navigation-web" role="navigation" aria-label="topic navigation">
    <p class="parent-title"><?php echo get_post($post->post_parent)->post_title; ?></p>
    <ul class="page-navigation-web-list" role="menubar">
        <?php echo wpb_list_child_pages_menu(); ?>
    </ul>
</div>
