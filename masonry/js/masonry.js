$( function() {
    $( '.item' ).each( function() {
        var e = $( this );
        var name = e.attr( 'class' );
        e.text( name );
        $( '<div/>', {
            'class': 'lorem',
            'attr': { 'data-lorem': getLorem( e ) },
            'css': {
                'font-family': 'IM Fell English',
                'font-weight': '0.8em'
            }
        }).appendTo( e );
        $( '<span/>', {
            'class': 'label',
            'css': {
                'color': '#fff',
                'background-color': '#666'
            },
            'text': 'dimensions: ' + e.outerWidth() + ' x ' + e.height()
        }).appendTo( e );
    });

    $( '#test' ).masonry({
        columnWidth: 250,
        itemSelector: '.item'
    });
});

function getLorem( DOMElement ) {
    var str = '';
    if( DOMElement.hasClass( 'h2' ) ) { str = '2p'; }
    else if( DOMElement.hasClass( 'h3' ) ) { str = '3p'; }
    else if( DOMElement.hasClass( 'h4' ) ) { str = '4p'; }
    else { str = '1p'; }

    return str;
}
