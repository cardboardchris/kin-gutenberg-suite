jQuery(document).ready(function ($) {
  var $main_nav = $("#site-navigation");
  var $menu_btn = $("#menu-toggle");
  var $search_btn = $("#search-button");
  var $search_box = $("#primary-search");

  $search_btn.on("click", function () {
    $this = $(this);
    $this.toggleClass('toggled');

    if ($search_btn.hasClass("toggled")) {
      showSearch();
      if ($main_nav.hasClass("toggled")) {
        hideMobileMenu();
      }
    } else {
      hideSearch();
    }
  });

  function hideSearch() {
    $search_btn.attr("aria-expanded", false);
    $search_box.attr("aria-expanded", false);
    $search_box.hide();
  }

  function showSearch() {
    $search_box.show().find('input').focus();
    $search_btn.attr("aria-expanded", true);
    $search_box.attr("aria-expanded", true);
  }

  function hideMobileMenu() {
    $menu_btn.removeClass("toggled");
    $menu_btn.attr("aria-expanded", false);
    $main_nav.removeClass("toggled");
    $main_nav.attr("aria-expanded", false);
  }
});
