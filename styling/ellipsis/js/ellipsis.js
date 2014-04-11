$( function() {
    $( 'a' ).on( 'click', function() {
        var target = './pages/' + $( this ).attr( 'data-target' ) + '.html';
        var include = $( '.include' );
        include.load( target );
    });
});

