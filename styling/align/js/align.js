$( function() {
    var elements = $( '.elem' );
    var colors = [ '#6AC5AC', '#D64078', '#FDC72F', '#96C02E'  ];
    var counter = 0;

    $.each( elements, function() {
        var el = $( this );
        var eType = el.prop( 'tagName' ).toLowerCase();
        var eClasses = el.attr( 'class' ).split( ' ' );
        var activeClass = '';
        var eId = ( el.attr( 'id' )) ? ' id="' + el.attr( 'id' ) + '"' : '';

        $.each( eClasses, function() {
            if( this != 'elem' ) activeClass += ' ' + this;
        });
        var eClass = activeClass !== ''? ' class="' + $.trim( activeClass ) + '"': '';
        el.css( 'border-color', colors[counter] );
        var eColor = el.css( 'border-color' );
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
        ( counter < 3 ) ? counter++ : counter = 0;
    });
});

