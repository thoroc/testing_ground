// https://gist.github.com/analyticsPierce/5144641

// TODO split the json array of objects into separate arrays and vars


function bar_chart( height, width, data, mod ) {

    // populate a metric1 array from the array of json objects
    var metric1_arr = [ ];
    for( var i = 0; i < data.length; i++ ) {
        metric1_arr.push( data[i].metric1 );
    }
    // populate a dimension1 array from the array of json objects
    var dimension1_arr = [ ];
    for( var i = 0; i < data.length; i++ ) {
        dimension1_arr.push( data[i].dimension1 );
    }
    console.log( "dimension1: " + dimension1_arr );
    // create a dim1_label var from the array of json objects
    var dim1_label = data[0].dim1_label;
    // create a met1_label var from array of json objects
    var met1_label = data[0].met1_label;

    function my() {
        // add chart title above the chart
        var chart_title = d3.select( "body" ).append( "p" )
                .attr( "id", "mod-" + mod + "-bar-chart-title" )
                .attr( "class", "bar_chart_title" )
                .text( met1_label + " by " + dim1_label );

        var bar_chart = d3.select( "body" ).append( "svg" )
                .attr( "id", "mod-" + mod + "-bar-chart" )
                .attr( "class", "bar_chart" )
                .attr( "width", width )
                .attr( "height", height )
                .append( "g" )
                .attr( "transform", "translate(10,15)" );

        var x = d3.scale.linear()
                .domain( [ 0, d3.max( metric1_arr ) ] )
                .range( [ 0, 450 ] );

        var y = d3.scale.ordinal()
                .domain( metric1_arr )
                .rangeBands( [ 0, 140 ] );

        /*    var x_axis = d3.svg.axis().scale(x_scale);

         bar_chart.append("g")
         .attr("class", "x axis")
         .call(x_axis);
         */
        bar_chart.selectAll( "line" )
                .data( x.ticks( 10 ) )
                .enter().append( "line" )
                .attr( "x1", x )
                .attr( "x2", x )
                .attr( "y1", 0 )
                .attr( "y2", 140 )
                .style( "stroke", "#ccc" );

        bar_chart.selectAll( "rect" )
                .data( metric1_arr )
                .enter()
                .append( "rect" )
                .attr( "y", y )
                .attr( "width", x )
                .attr( "height", y.rangeBand() );

        bar_chart.selectAll( "text" )
                .data( metric1_arr )
                .enter().append( "text" )
                .attr( "x", x )
                .attr( "y", function( d ) {
                    return y( d ) + y.rangeBand() / 2;
                })
                .attr( "dx", +13 ) // padding-right
                .attr( "dy", ".35em" ) // vertical-align: middle
                .attr( "text-anchor", "end" ) // text-align: right
                .attr( "fill", "slategrey" )
                .text( String );

        bar_chart.append( "line" )
                .attr( "y1", 0 )
                .attr( "y2", 140 )
                .style( "stroke", "#000" );

        bar_chart.selectAll( ".rule" )
                .data( x.ticks( 10 ) )
                .enter()
                .append( "text" )
                .attr( "class", "rule" )
                .attr( "x", x )
                .attr( "y", 0 )
                .attr( "dy", -3 )
                .attr( "text-anchor", "middle" )
                .text( String );

        /*    bar_chart.selectAll("text")
         .data(dimension1_arr)
         .enter()
         .append("text")
         .attr("x", 450)
         .attr("class", "labels")
         .text(dimension1_arr);
         */
        var y_axis = d3.svg.axis().scale( y ).orient( "left" );

        bar_chart.append( "g" )
                .attr( "class", "axis" )
                .data( dimension1_arr )
                .enter()
                .text( data, function( d ) {
                    return d;
                })
                .call( y_axis );
    }

    my.width = function( value ) {
        if( !arguments.length ) return width;
        width = value;
        return my;
    };

    my.height = function( value ) {
        if( !arguments.length ) return height;
        height = value;
        return my;
    };

    my.data = function( value ) {
        if( !arguments.length ) return data;
        data = value;
        return my;
    }

    return my;
}
