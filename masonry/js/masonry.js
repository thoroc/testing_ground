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
        columnWidth: '.item',
        itemSelector: '.item',
        gutter: 20
    });

    $( 'input[type=range]' ).on( 'change', function() {
        var attr = $( this ).attr( 'data-target' );
        var value = $( this ).val();
        var out = $( this ).siblings( 'div' );
        out.text( value );
        // dirty hacks
        switch( attr ) {
            case 'columnWidth':
                $( '#test' ).masonry({ columnWidth: parseInt( value ) }).masonry();
                break;
            case 'gutter':
                $( '#test' ).masonry({ gutter: parseInt( value ) }).masonry();
                break;
            case 'margin-bottom':
            case 'width':
            case 'height':
                $( '.item' ).css( attr, parseInt( value ));
                $( '#test' ).masonry();
                break;
        }
    });
});

function getLorem( DOMElement ) {
    var str = '1p';
    if( DOMElement.hasClass( 'h2' ) ) { str = '2p'; }
    else if( DOMElement.hasClass( 'h3' ) ) { str = '3p'; }
    else if( DOMElement.hasClass( 'h4' ) ) { str = '4p'; }

    return str;
}
