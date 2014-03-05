
$( document ).ready( function() {
    var width = 400;
    var height = 400;
    var xStep = width / 20;
    var yStep = height / 20;

    var vis = d3.select( "#graph" ).append( 'svg' )
        .attr( 'width', width )
        .attr( 'height', height );

    drawGrid( vis, width, height, xStep, yStep );
});

function drawGrid( vis, width, height, xStep, yStep ) {
    // the xAxis gives the x coordinates
    // for vertical lines ( 'y1' = 25 and, 'y2' = height - 25 )
    var xRange = d3.range( yStep, width, yStep );

    // the yAxis gives the y coordinates
    // for horizontal lines ( 'x1' = 25 and, 'x2' = width - 25 )
    var yRange = d3.range( xStep, height, xStep );

    var group = vis.append( 'svg:g' );

    // Using the xaxiscoorddata to generate vertical lines.
    group.selectAll( 'line.vertical' )
        .data( xRange )
        .enter().append( 'svg:line' )
        .attr( 'class', 'line' )
        .attr( 'x1', function( d ) { return d; })
        .attr( 'y1', yStep )
        .attr( 'x2', function( d ) { return d; })
        .attr( 'y2', height - yStep );

    // Using the yaxiscoorddata to generate horizontal lines.
    group.selectAll( 'line.horizontal')
        .data( yRange )
        .enter().append( 'svg:line' )
        .attr( 'class', 'line' )
        .attr( 'x1', xStep )
        .attr( 'y1', function( d ) { return d; })
        .attr( 'x2', width - xStep )
        .attr( 'y2', function( d ) { return d; });
}
