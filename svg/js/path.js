
$( document ).ready( function() {
    var graph = drawnPath( '#D3line' );

    $( '<div/>', {
        'text': 'foo',
        'class': 'awesome'
    }).appendTo( '#D3line' );
});

function drawnPath( DOMElement ) {
    var div = d3.select( DOMElement );
    var width = 200;
    var height = 200;
    var svg = div.append( 'svg:svg' )
         .attr( 'width', width )
         .attr( 'height', height )

    var strokeWidth = 4;
    // 21 points
    var border = 10;
    var x = 10;
    var y = 20;

    var corners = {
        A: { x:border, y:border },
        B: { X:width - border, y:border },
        C: { X:width - border, y:height - border },
        D: { X:border, y:height - border },
    };

    console.log( corners );
    console.log( corners['A']['y'] );

    var steps = [10, 20 , 40];
    console.log( steps );

    var a1 = { x:x, y:y };
    var a2 = { x:x*4, y:y };
    var a3 = { x:x*4, y:y*2 };
    var a4 = { x:x*2, y:y*2 };
    var a5 = { x:x*2, y:y/2 };

    console.log( a1 );

    $.each( corners, function() {
        
    });

    // Specify the path points
    var pathOutline = [
        // A
        { x:8, y:20 },
        { x:40, y:20 },
        { x:40, y:40 },
        { x:20, y:40 },
        { x:20, y:10 },
        // B
        { x:180, y:10 },
        { x:180, y:40 },
        { x:160, y:40 },
        { x:160, y:20 },
        { x:190, y:20 },
        // C
        { x:190, y:180 },
        { x:160, y:180 },
        { x:160, y:160 },
        { x:180, y:160 },
        { x:180, y:190 },
        // D
        { x:20, y:190 },
        { x:20, y:160 },
        { x:40, y:160 },
        { x:40, y:180 },
        { x:10, y:180 },
        // Trailing
        { x:10, y:18 }
    ];

    var pathSquare = [
        { x:2, y:4 },
        { x:30, y:4 },
        { x:30, y:30 },
        { x:4, y:30 },
        { x:4, y:2 }
    ];

    // Specify the function for generating path data
    var line = d3.svg.line()
                    .x( function( d ) { return d.x; })
                    .y( function( d ) { return d.y; })
                    .interpolate( 'linear' );

    // Creating path using data in pathinfo and path data generator
    // d3line.
    svg.append( 'svg:path' )
        .attr( 'd', line( pathOutline ))
        .style( 'stroke-width', strokeWidth )
        .style( 'stroke', 'steelblue' )
        .style( 'fill', 'none' );
//    svg.append( 'svg:path' )
//        .attr( 'd', line( pathSquare ))
//        .style( 'stroke-width', strokeWidth )
//        .style( 'stroke', 'steelblue' )
//        .style( 'fill', 'none' );
}



