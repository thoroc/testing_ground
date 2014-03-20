$( function() {
    var elements = $( '.elem' );
//    var colors = [ '#6AC5AC', '#D64078', '#FDC72F', '#96C02E'  ];
    var colors = [ '#FF0000', '#FF7400', '#009999', '#00CC00', '#D8005F', '#8506A9', '#FFDD00'  ];
    var bColors = [ '#FDC4C4', '#FFE0C6', '#C7FFFF', '#B4E6B4', '#FFC4DE', '#F3C9FF', '#FFF7C6'  ];
    var counter = 0;

    $.each( elements, function() {
        var eColor = colors[counter];
        var eBackgroundColor = bColors[counter];
        var el = $( this );
        var eType = el.prop( 'tagName' ).toLowerCase();
        var eClasses = el.attr( 'class' ).split( ' ' );
        var activeClass = '';
        var eId = ( el.attr( 'id' )) ? ' id="' + el.attr( 'id' ) + '"' : '';

        $.each( eClasses, function() {
            if( this != 'elem' ) activeClass += ' ' + this;
        });
        var eClass = activeClass !== ''? ' class="' + $.trim( activeClass ) + '"': '';
        el.css( 'border-color', eColor );
        el.css( 'background-color', eBackgroundColor );
        $( '<span/>', {
            'class': 'label',
            'css': { 'background-color': eColor },
            'text': '<' + eType + eId + eClass + '>'
        }).appendTo( el );
        $( '<span/>', {
            'class': 'endlabel',
            'css': { 'background-color': eColor },
            'text': '<' + eType + '>'
        }).appendTo( el );
        ( counter < colors.length - 1 ) ? counter++ : counter = 0;
        el.attr( 'title', '<' + eType + eId + eClass + '>' );
    });
});

function hexToRGBA( hex, alpha ) {
    return 'rgba(' + hexToR( hex ) + ',' + hexToG( hex ) + ',' + hexToB( hex ) + ',' + alpha +  ')';
}

function hexToRGB( hex ) {
    return 'rgb(' + hexToR( hex ) + ',' + hexToG( hex ) + ',' + hexToB( hex ) + ')';
}

function hexToR( h )  {
    return parseInt( ( cutHex( h ) ).substring( 0, 2 ), 16  );
}

function hexToG( h ) {
    return parseInt( ( cutHex( h ) ).substring( 2,4 ), 16 );
}

function hexToB( h ) {
    return parseInt( ( cutHex( h )  ).substring( 4,6 ), 16 );
}

function cutHex( h ) {
    return ( h.charAt( 0 ) === '#' ) ? h.substring( 1,7 ): h ;
}

