$( function() {
    $( 'a' ).on( 'click', function() {
        var target = $( this ).attr( 'data-target' );
        var include = $( '.include' );
        include.load( './' + target + '.html' );
    });
});

