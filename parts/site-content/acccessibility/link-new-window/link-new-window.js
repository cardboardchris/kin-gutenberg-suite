(function( $ ) {
    'use strict';

    $( function() {
        // Add screen reader text to links that open in new windows.
        const newWindowText = '<span class="screen-reader-text">(opens in a new window)</span>';
        $('a[target="_blank"]').append(newWindowText);
    });
})( jQuery );
