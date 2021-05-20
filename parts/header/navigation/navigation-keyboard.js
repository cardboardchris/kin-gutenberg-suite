jQuery(function ($) {
  var $primaryMenu = $('#primary-menu');
  var $searchToggleButton = $('#search-button');

  // when focus is on a menu item that has a submenu, set aria-expanded to true,
  // on focus out set to false
  var $menu_with_children = $primaryMenu.children('.menu-item-has-children'); // use find() if sub-menu shows nested sub-menu
  $menu_with_children.attr('aria-expanded', false);

  $menu_with_children.focusin(function () {
    $(this).attr('aria-expanded', true);
  });

  $menu_with_children.focusout(function () {
    $(this).attr('aria-expanded', false);
  });

  // focus behavior for search button
  $searchToggleButton.on('focus.wparia  mouseenter.wparia', function () {
    $(this).addClass('focus');
  });
  $searchToggleButton.on('blur.wparia  mouseleave.wparia', function () {
    $(this).removeClass('focus');
  });

});
