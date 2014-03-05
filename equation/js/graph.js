
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
    var xRange =    d3.range( yStep, width, yStep );
    var xMin =      d3.min( xRange );
    var xMax =      d3.max( xRange );
    var xScale =    d3.scale.linear()
            .domain([ xMin, xMax ])
            .range([0, width]);
    var yRange =    d3.range( xStep, height, xStep );
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
        .attr( 'x1', function( d ) { /*if( d !== xCenter )*/ return d; })
        .attr( 'y1', yStep )
        .attr( 'x2', function( d ) { /*if( d !== xCenter )*/ return d; })
        .attr( 'y2', height - yStep );

    gridGroup.selectAll( 'line.horizontal')
        .data( yRange )
        .enter().append( 'svg:line' )
        .attr( 'class', 'line' )
        .attr( 'x1', xStep )
        .attr( 'y1', function( d ) { return d; })
        .attr( 'x2', width - xStep )
        .attr( 'y2', function( d ) { return d; });

    var axisGroup = vis.append( 'svg:g' );

    axisGroup.append( 'svg:line' )
            .attr( 'class', 'axis' )
            .attr( 'x1', xScale( 0 ) )
            .attr( 'y1', height / 2 )
            .attr( 'x2', xScale( xMax ) )
            .attr( 'y2', height / 2 );

    axisGroup.append( 'svg:line' )
            .attr( 'class', 'axis' )
            .attr( 'x1', width / 2 )
            .attr( 'y1', yScale( 0 ) )
            .attr( 'x2', width / 2 )
            .attr( 'y2', yScale( yMax ) );
}
