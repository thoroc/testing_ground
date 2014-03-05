
$( document ).ready( function() {
    var width = 600;
    var height = 600;
    var step = 20;
    var vis = d3.select( '#graph' ).append( 'svg' )
        .attr( 'width', width )
        .attr( 'height', height );

    drawGrid( vis, width, height, step );
});

function drawGrid( vis, width, height, step ) {
    var xRange =    d3.range( step, width, step );
    var xMin =      d3.min( xRange );
    var xMax =      d3.max( xRange );
    var xScale =    d3.scale.linear()
            .domain([ xMin, xMax ])
            .range([0, width]);
    var yRange =    d3.range( step, height, step );
    var yMin =      d3.min( yRange );
    var yMax =      d3.max( yRange );
    var yScale =    d3.scale.linear()
            .domain([ yMin, yMax ])
            .range([ 0, height ]);
    var xCenter = width / 2;
    var yCenter = height / 2;

    var gridGroup = vis.append( 'svg:g' );

    gridGroup.selectAll( 'line.vertical' )
        .data( xRange )
        .enter().append( 'svg:line' )
        .attr( 'class', 'line' )
        .attr( 'x1', function( d ) { return d; })
        .attr( 'y1', 0 )
        .attr( 'x2', function( d ) { return d; })
        .attr( 'y2', height );

    gridGroup.selectAll( 'line.horizontal')
        .data( yRange )
        .enter().append( 'svg:line' )
        .attr( 'class', 'line' )
        .attr( 'x1', 0 )
        .attr( 'y1', function( d ) { return d; })
        .attr( 'x2', width )
        .attr( 'y2', function( d ) { return d; });

    var axisGroup = vis.append( 'svg:g' );

    axisGroup.append( 'defs' ).append( 'marker' )
        .attr('id', 'arrowhead')
        .attr( 'refX', 5 ) /*must be smarter way to calculate shift*/
        .attr( 'refY', 5 )
        .attr( 'martkerUnits', 'strokeWidth' )
        .attr( 'markerWidth', 40 )
        .attr( 'markerHeight', 40 )
        .attr( 'orient', 'auto' )
        .append( 'path' )
        .attr( 'viewBox', '0 0 10 10' )
            .attr( 'd', 'M 0 0 L 10 5 L 0 10 z' );

    axisGroup.append( 'svg:line' )
            .attr( 'class', 'axis' )
            .attr( 'marker-end', 'url( #arrowhead )' )
            .attr( 'x1', xScale( 0 ) )
            .attr( 'y1', height / 2 )
            .attr( 'x2', xScale( xMax ) - step / 2  )
            .attr( 'y2', height / 2 );

    axisGroup.append( 'svg:line' )
            .attr( 'class', 'axis' )
            .attr( 'marker-end', 'url( #arrowhead )' )
            .attr( 'x1', width / 2 )
            .attr( 'y1', yScale( 0 ) )
            .attr( 'x2', width / 2 )
            .attr( 'y2', yScale( yMax ) - step / 2 );

}
