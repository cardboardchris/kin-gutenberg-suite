jQuery(document).ready(function ($) {

    let $main_nav = $('#site-navigation');
    let $main_menu_expander_btn = $('#primary-menu .expander');
    let $primary_menu = $('#primary-menu');
    let $menu_btn = $('#menu-toggle');
    let $search_btn = $('#search-button');
    let $search_box = $('#primary-search');
    let $page_menu_expander_btn = $('.page-navigation-mobile > .dropdown-toggle');
    let $page_menu = $('.page-navigation-mobile .dropdown-menu');
    let $page_parents = $primary_menu.find('.current-menu-ancestor');

    // toggle behavior for the mobile menu button
    $menu_btn.on('click', function () {
        let $this = $(this);
        $this.toggleClass('toggled');
        if ($page_menu.hasClass("toggled")) {
            hidePageMenu();
        }

        if ($this.hasClass('toggled')) {
            showMobileMenu();
            if ($search_btn.hasClass("toggled")) {
                hideSearch();
            }
        } else {
            hideMobileMenu();
        }
    });

    $main_menu_expander_btn.on('click', function(e) {
        e.preventDefault();
        let $parent_li = $(this).parent();
        $parent_li.toggleClass('toggled');

        if ($parent_li.hasClass('toggled')) {
            showChildrenMenu($parent_li);
        } else {
            hideChildrenMenu($parent_li);
        }
    });

    // toggle behavior for the page menu
    $page_menu_expander_btn.on('click', function() {
        let $this = $(this);
        $this.toggleClass('toggled');

        if ($this.hasClass('toggled')) {
            showPageMenu();
        } else {
            hidePageMenu();
        }
    });

    // toggle behavior for mobile menu expander buttons
    function showChildrenMenu($parent_li) {
        $parent_li.addClass('toggled');
        $parent_li.children('ul').attr('aria-expanded', true);
    }

    function hideChildrenMenu($parent_li) {
        $parent_li.removeClass('toggled');
        $parent_li.children('ul').attr('aria-expanded', false);
    }

    function showMobileMenu() {
        $page_parents.addClass('toggled');
        $main_nav.addClass('toggled');
        $primary_menu.attr('aria-expanded', true);
        $menu_btn.attr('aria-expanded', true);
    }

    function hideMobileMenu() {
        $main_nav.removeClass('toggled');
        $primary_menu.attr('aria-expanded', false);
        $menu_btn.attr('aria-expanded', false);
    }

    function showPageMenu() {
        $page_menu.addClass('toggled');
    }

    function hidePageMenu() {
        $page_menu.removeClass('toggled');
    }

    function hideSearch() {
        $search_btn.removeClass("toggled");
        $search_btn.attr("aria-expanded", false);
        $search_box.attr("aria-expanded", false);
        $search_box.hide();
    }
});
