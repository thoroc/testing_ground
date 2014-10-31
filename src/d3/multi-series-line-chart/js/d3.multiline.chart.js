
var data = [
    {
        "question":"header",
        "data":[
            {"month":"February","score":4.54},
            {"month":"March","score":4.54},
            {"month":"April","score":4.54}
        ]
    },
    {
        "question":"Overall Result",
        "data":[
            {"month":"February","score":"4.62"},
            {"month":"March","score":"4.60"},
            {"month":"April","score":"4.68"}
        ]
    },
    {
        "question":"Ease of Access to Help",
        "data":[
            {"month":"February","score":"4.66"},
            {"month":"March","score":"4.63"},
            {"month":"April","score":"4.68"}
        ]
    },
    {
        "question":"Timeliness of Problem Resolution",
        "data":[
            {"month":"February","score":"4.54"},
            {"month":"March","score":"4.54"},
            {"month":"April","score":"4.63"}
        ]
    },
    {
        "question":"Effectiveness of Solution - Information",
        "data":[
            {"month":"February","score":"4.59"},
            {"month":"March","score":"4.55"},
            {"month":"April","score":"4.66"}
        ]
    },
    {
        "question":"Technical Expertise of Technician",
        "data":[
            {"month":"February","score":"4.60"},
            {"month":"March","score":"4.59"},
            {"month":"April","score":"4.64"}
        ]
    },
    {
        "question":"The Technician was Courteous and Professional",
        "data":[
            {"month":"February","score":"4.77"},
            {"month":"March","score":"4.73"},
            {"month":"April","score":"4.77"}
        ]
    }
];

$( document ).ready( function() {
    var month = '';
    var score = '';

    var color = d3.scale.category10();

    var line = d3.svg.line()
        .interpolate( 'basis' )
        .x( function( d ) { return d.month; })
        .y( function( d ) { return d.score; });

    var svg = createGraph( data );

    var questions = color.domain().map( function( question ) {
        return {
            name: question,
            values: data.map( function( d ) {
                return { month: d.month, score: d.score };
            })
        };
    });

    var question = svg.selectAll( '.question' )
        .data( questions )
        .enter().append( 'g' )
        .attr( 'class', 'question' );

    console.log( question );

    question.append( 'path' )
        .datum( data )
        .attr( 'class', 'line' )
        .attr( 'd', function( d ) { return line( d.values ); })
        .style( 'stroke', function( d ) { return color( d.name ); });

});

function createGraph( data )
{
    var margin = {top: 20, right: 80, bottom: 30, left: 50};
    var width = 960 - margin.left - margin.right;
    var height = 500 - margin.top - margin.bottom;

    var xRange = data[0]['data'].map( function( d ) { return d.month; } );

    var xScale = d3.scale.ordinal()
        .domain( xRange )
        .rangePoints([0, width]);

    var yScale = d3.scale.linear()
        .domain([0, 5])
        .range([height, 0]);

    var xAxis = d3.svg.axis()
        .scale( xScale )
        .orient( 'bottom' );

    var yAxis = d3.svg.axis()
        .scale( yScale )
        .orient( 'left' );

    var svg = d3.select( 'body' ).append( 'svg' )
        .attr( 'width', width + margin.left + margin.right)
        .attr( 'height', height + margin.top + margin.bottom)
      .append( 'g' )
        .attr( 'transform', 'translate( ' + margin.left + "," + margin.top + ' )' );

    /**
     * X Axis
     */
    svg.append( 'g' )
        .attr( 'class', 'x axis' )
        .attr( 'transform', 'translate( 0,' + height + ' )' )
        .call( xAxis );

    /**
     * Y Axis
     */
    svg.append( 'g' )
        .attr( 'class', 'y axis' )
        .call( yAxis )
        .append( 'text' )
        .attr( 'transform', 'rotate( -90 )' )
        .attr( 'y', 6 )
        .attr( 'dy', '.71em' )
        .style( 'text-anchor', 'end' )
        .text( 'Score' );

    return svg;
}
