
/**
 * @see http://stackoverflow.com/questions/5976289/stretch-text-to-fit-width-of-div
 */
$.fn.strechText = function() {
    var e = $( this );
    var efont = e.css( 'font' );
    var lines = e.html().split( '\n' );
    e.html( '' );
    $.each( lines, function( i, val ) {
        if( $.trim( val ).length > 0 ) {
            var txt = $.trim( val );
            var oneLine = $( '<span/>', {
                'class': 'stretch-it',
                'text': txt
            }).appendTo( e );
            var spacing = e.width() / txt.length;
            var txtWidth = getTextWidth( txt, efont );
            var charWidth = txtWidth / txt.length;
            var ltrSpacing = spacing - charWidth + ( spacing - charWidth ) / txt.length;
            if( txtWidth < e.width() ) {
                oneLine.css({ 'letter-spacing': ltrSpacing });
                // case not in use, so fuckit
//            } else if( txtWidth > e.width() ) {
            } else {
                oneLine.contents().unwrap();
                e.addClass( 'justify' );
            }
        }
    });
};

/**
 * Uses canvas.measureText to compute and return the width of the given text of given font in pixels.
 *
 * @param {String} text The text to be rendered.
 * @param {String} font The css font descriptor that text is to be rendered with (e.g. "bold 14px verdana").
 *
 * @see http://stackoverflow.com/questions/118241/calculate-text-width-with-javascript/21015393#21015393
 */
getTextWidth = function( text, font ) {
    // if given, use cached canvas for better performance
    // else, create new canvas
    var canvas = getTextWidth.canvas || ( getTextWidth.canvas = document.createElement( 'canvas' ));
    var context = canvas.getContext( '2d' );
    context.font = font;
    var metrics = context.measureText( text );

    return metrics.width;
};

drawLine = function( eClass ) {
//    $( eClass ).css({ width: '500px', height: '10px' });

//    var canvas = drawLine.canvas || ( drawLine.canvas = document.createElement( 'canvas' ));
//    var canvas = document.getElementsById( eClass );
    var canvas = document.createElement( 'canvas' );
    var context = canvas.getContext( '2d' );
//    canvas.css({ width: '500px', height: '10px' });
    canvas.width = 500;
    canvas.height = 20;
    context.beginPath();
        context.moveTo(50,10);
        context.lineTo(450,10);
        context.lineWidth = 2;
    context.stroke();
    $( eClass ).replaceWith( canvas );
};


//console.log( getTextWidth( "hello there!", "bold 12pt arial" ));  // reports 84

$( document ).ready( function() {
    $( '.stretch' ).each( function() {
        $( this ).strechText();
    });
    $( '.divider' ).each( function() {
        drawLine( this );
    });
});