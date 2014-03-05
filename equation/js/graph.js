
$( document ).ready( function() {
    var width = 600;
    var height = 400;

    var vis = d3.select( "#graph" ).append( 'svg' )
        .attr( 'width', width )
        .attr( 'height', height );
//    drawGrid( vis, width, height );
    drawAnimatedTrigo( vis, width, height );
});

function drawGrid( vis, width, height ) {
//    var width = 400;
//    var height = width;
    var step = width / 20;

//    var grid = d3.select( DOMElement )
//        .append( 'svg:svg' )
//        .attr( 'width', width )
//        .attr( 'height', height );

    // the xAxis gives the x coordinates
    // for vertical lines ( 'y1" = 25 and, "y2"=height-25 )
    var xRange = d3.range( step, width, step );

    // the yAxis gives the y coordinates
    // for horizontal lines ( 'x1" = 25 and, "x2"=width-25 )
    var yRange = d3.range( step, height, step );

    var group = vis.append( 'svg:g' )
        .style( 'stroke', 'lightgrey' )
        .style( 'stroke-width', 2 );

    // Using the xaxiscoorddata to generate vertical lines.
    group.selectAll( 'line.vertical' )
        .data( xRange )
        .enter().append( 'svg:line' )
        .attr( 'x1', function( d ) { return d; })
        .attr( 'y1', step )
        .attr( 'x2', function( d ) { return d; })
        .attr( 'y2', height - step );

    // Using the yaxiscoorddata to generate horizontal lines.
    group.selectAll( 'line.horizontal')
        .data( yRange )
        .enter().append( 'svg:line' )
        .attr( 'x1', step )
        .attr( 'y1', function( d ) { return d; })
        .attr( 'x2', width - step )
        .attr( 'y2', function( d ) { return d; });
}

function drawAnimatedTrigo(  vis, width, height  ) {
    var INTERVAL = Math.PI / 30;

    // Precompute sin and tan waves
    var d = d3.range( 0, Math.PI / 2 + INTERVAL, INTERVAL );
    var sinWave = d.map( Math.sin );
    var tanWave = d.map( Math.tan );

    // Remove problematic "infinite" point
    tanWave.pop();

    var x = d3.scale.linear().domain( [-5, 15] ).range( [0, width] );
    var y = x;
    var r = ( function( a, b ) {
      return Math.sqrt( a * a + b * b );
    })( x.invert( width ), y.invert( height ));

    vis.append( 'g' )
        .attr( 'id', 'sinwave' )
        .attr( 'width', width )
        .attr( 'height', height )
        .attr( 'transform', 'translate( ' + x( 1 ) + ' )' )
      .selectAll( 'path' )
        .data( [d3.range( 0, 8 * Math.PI + INTERVAL, INTERVAL ).map( Math.sin )] )
      .enter().append( 'path' )
        .attr( 'class', 'wave' )
        .attr( 'd', d3.svg.line()
          .x( function( d, i ) { return x(i * INTERVAL ) - x( 0 ); })
          .y( function( d ) { return y( d ); }));

    vis.append( 'g' )
        .attr( 'id', 'tanwave' )
        .attr( 'width', width )
        .attr( 'height', height )
        .attr( 'transform', 'translate( ' + x( 1 ) + ' )' )
      .selectAll( 'path' )
        .data( d3.range( 8 ).map( function( i ) {
            return d3.range(-Math.PI/2+ INTERVAL, Math.PI/2, INTERVAL ).map( Math.tan );
        }))
      .enter().append( 'path' )
        .attr( 'class', 'wave' )
        .attr( 'transform', function(d, i ) {
            return 'translate( ' + ( x( ( i-.5 ) * Math.PI + INTERVAL )-x( 0 ) ) + ",0 )";
        })
        .attr( 'd', d3.svg.line()
          .x( function( d, i ) { return x( i * INTERVAL ) - x( 0 ); })
          .y( function( d ) { return y( d ); }));

    var filler = function( w, h ) {
      return vis.append( 'rect' )
          .attr( 'class', 'filler' )
          .attr( 'width', w )
          .attr( 'height', h );
    };

    filler( x( 1 ), height  );
    vis.append( 'g' )
        .attr( 'id', 'coswave' )
        .attr( 'width', width )
        .attr( 'height', height )
      .selectAll( 'path' )
        .data( [d3.range( 0, 5 * Math.PI + INTERVAL, INTERVAL ).map( Math.cos )] )
      .enter().append( 'path' )
        .attr( 'class', 'wave' )
        .attr( 'd', d3.svg.line()
          .x( function( d ) { return x( d ); })
          .y( function( d, i ) { return y( i * INTERVAL ) - y( 0 ); })
        );
    filler(x( 1 ), y( 1 ));
    var line = function( e, x1, y1, x2, y2 ) {
      return e.append( 'line' )
          .attr( 'class', 'line' )
          .attr( 'x1', x1 )
          .attr( 'y1', y1 )
          .attr( 'x2', x2 )
          .attr( 'y2', y2 );
    };

    var axes = function( cx, cy, cls ) {
      cx = x( cx );
      cy = y( cy );
      line( vis, cx, 0, cx, height ).attr( 'class', cls || 'line' );
      line( vis, 0, cy, width, cy ).attr( 'class', cls || 'line' );
    };

//    var grid = drawAnimatedTrigo( vis, width, height );

    axes(0, 0, 'axis' );
    axes(1, 1, 'edge' );

    vis.append( 'circle' )
        .attr( 'class', 'circle' )
        .attr( 'cx', x( 0 ))
        .attr( 'cy', y( 0 ))
        .attr( 'r', y( 1 ) - y( 0 ));

    line( vis, x( 0 ), y( 0 ), x( 1 ), y( 0 ) )
        .attr( 'id', 'line' );

    line( vis, x( -x.invert( width )), y( 0 ), width, y( 0 ) )
        .attr( 'id', 'tanline' );

    line( vis, 0, y( 0 ), width, y( 0 ) )
        .attr( 'id', 'xline' );

    line( vis, x( 0 ), 0, x( 0 ), height )
        .attr( 'id', 'yline' );

    vis.append( 'circle' )
        .attr( 'class', 'circle' )
        .attr( 'id', 'dot' )
        .attr( 'cx', x( 1 ) )
        .attr( 'cy', y( 0 ) )
        .attr( 'r', 5 );

    var offset = -4*Math.PI, last = 0;

    d3.timer( function( elapsed ) {
      offset += ( elapsed - last ) / 500;
      last = elapsed;
      if ( offset > - 2 * Math.PI ) {
          offset = - 4 * Math.PI;
      }
      vis.selectAll( '#sinwave, #tanwave' )
        .attr( 'transform', 'translate( ' + x( offset+ 5*Math.PI/4 ) + ',0 )' );

      vis.selectAll( '#coswave' )
        .attr( 'transform', 'translate(0,' + y( offset+ 5*Math.PI/4 ) + ' )' );

      vis.selectAll( '#dot, #tanline' )
        .attr( 'transform', 'rotate( '
                + ( 180 - offset * 180 / Math.PI )
                + ',' + x ( 0 ) + ',' + y( 0 ) + ' )'
        );

      var xline = x( Math.sin( offset )) - x( 0 );

      var yline = x( -Math.cos( offset )) - y( 0 );

      vis.select( '#xline' )
        .attr( 'transform', 'translate(0,' + xline + ' )' );

      vis.select( '#yline' )
        .attr( 'transform', 'translate( ' + yline + ',0 )' );
    });
}


