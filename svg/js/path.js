
$( document ).ready( function() {
    drawnPath( "#D3line" );
});

function drawnPath( DOMElement ) {
    var div = d3.select( DOMElement );

    var svg = div.append( 'svg:svg' )
         .attr( 'width', 200 )
         .attr( 'height', 200 )

    //

    // Specify the path points
    var pathinfo = [
        { x:0, y:60 },
        { x:50, y:110 },
        { x:90, y:70 },
        { x:140, y:100 }
    ];

    // Specify the function for generating path data
    var line = d3.svg.line()
                    .x( function( d ) { return d.x; })
                    .y( function( d ) { return d.y; })
                    .interpolate( 'linear' );

    // Creating path using data in pathinfo and path data generator
    // d3line.
    svg.append( 'svg:path' )
        .attr( 'd', line( pathinfo ))
        .style( 'stroke-width', 4 )
        .style( 'stroke', 'steelblue' )
        .style( 'fill', 'none' );
}



