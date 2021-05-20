jQuery(document).ready(function ($) {
  vimeoPlayerResize();

  function vimeoPlayerResize() {
    $('iframe').each(function () {
      var source = $(this).attr('src');
      if (source.toLowerCase().indexOf('player.vimeo.com') >= 0) {
        $(this).css({
          'height': 'calc(100vw * (360 / 640))',
          'max-height': '360px'
        });
      }
    })
  }
});
