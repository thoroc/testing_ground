
$( document ).ready( function() {
    var width = 800;
    var height = 800;
    var step = 20;
    // draw the grid
    var vis = drawGrid( '#graph', width, height, step );
    drawLine( vis, getEquationData( width, 'x' ) );

    $( 'input[type=button]' ).click( function() {
        var string = $( this ).siblings( 'input[type=text]' ).val();
        drawLine( vis, getEquationData( width, string ) );
//        decodeEquation( string );
//        console.log( equation );
//        drawLine( vis, decodeEquation(  ) )
    });
});

function decodeEquation( inputString, value ) {
//    console.log( inputString );
//    console.log( value );
    var regex = new RegExp( '[\\d\\sx+*]+', 'i' );
    var match = regex.test( inputString );
//    console.log( match );
    if( match ) {
        var newValue = inputString.replace( /[x]/i, value );
        console.log( newValue );
        return newValue;
    }
    return false;
}

function getEquationData( x, equation ) {
    var range = d3.range( 0, x );
    var data = [];
    range.forEach( function( d ) {
//        data.push({ 'x':d , 'y': ((2 * d) + d ^ 2 + 1) });
//        data.push({ 'x':d , 'y': d });
        data.push({ 'x':d , 'y': (integer) (decodeEquation( equation, d )) });
    });
//    console.log( data );
    return data;
}

function drawLine( vis, lineData ) {
    var lineFunction = d3.svg.line()
            .x( function ( d ) { return d.x; })
            .y( function ( d ) { return d.y; })
            .interpolate( 'linear' );
    var visGroup = vis.append( 'svg:g' );
    visGroup.append( 'svg:path' )
            .attr( 'd', lineFunction( lineData ))
            .attr( 'class', 'equation' );
}

function drawGrid( DOMElement, width, height, step ) {
    var vis = d3.select( DOMElement ).append( 'svg' )
        .attr( 'width', width )
        .attr( 'height', height );

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

    // grid
    var gridGroup = vis.append( 'svg:g' );

    gridGroup.selectAll( 'line.vertical' )
            .data( xRange )
        .enter().append( 'svg:line' )
            .attr( 'class', function( d ) { return ( d % 50 === 0 )? 'line' : 'dashed'; })
            .attr( 'x1', function( d ) { return d; })
            .attr( 'y1', 0 )
            .attr( 'x2', function( d ) { return d; })
            .attr( 'y2', height );

    gridGroup.selectAll( 'line.horizontal')
            .data( yRange )
        .enter().append( 'svg:line' )
            .attr( 'class', function( d ) { return ( d % 50 === 0 )? 'line' : 'dashed'; })
            .attr( 'x1', 0 )
            .attr( 'y1', function( d ) { return d; })
            .attr( 'x2', width )
            .attr( 'y2', function( d ) { return d; });

    // axis
    var axisGroup = vis.append( 'svg:g' );

    axisGroup.append( 'svg:defs' ).append( 'marker' )
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
        .attr( 'y1', yCenter )
        .attr( 'x2', xScale( xMax ) - step / 2  )
        .attr( 'y2', yCenter );

    axisGroup.append( 'svg:line' )
        .attr( 'class', 'axis' )
        .attr( 'marker-end', 'url( #arrowhead )' )
        .attr( 'x1', xCenter )
        .attr( 'y1', yScale( 0 ) )
        .attr( 'x2', xCenter )
        .attr( 'y2', yScale( yMax ) - step / 2 );

    // labels for axis
    axisGroup.append( 'svg:text' )
        .attr( 'class', 'label' )
        .attr( 'x', width - step /2 )
        .attr( 'y', yCenter + step )
        .attr( 'text-anchor', 'end' )
        .text( 'x' );

    axisGroup.append( 'svg:text' )
        .attr( 'class', 'label' )
        .attr( 'x', 0 + step )
        .attr( 'y', yCenter + step )
        .attr( 'text-anchor', 'end' )
        .text( '-x' );

    axisGroup.append( 'svg:text' )
        .attr( 'class', 'label' )
        .attr( 'x', xCenter + step )
        .attr( 'y', height - step / 2 )
        .attr( 'text-anchor', 'end' )
        .text( 'y' );

    axisGroup.append( 'svg:text' )
        .attr( 'class', 'label' )
        .attr( 'x', xCenter + step )
        .attr( 'y', 0 + step )
        .attr( 'text-anchor', 'end' )
        .text( '-y' );

    return vis;
}
