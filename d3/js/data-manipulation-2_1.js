
//var width = 500;
//var height = 500; 
//var margin = 50;
//var x = d3.scale.linear().domain([0, 5]).range([margin, width-margin]);
//
////var x = d3.scale.linear()
////    .domain([ 0, d3.max(data) ])
////    .range([0, 420]);
//
//
//var y = d3.scale.linear().domain([-10,10]).range([height-margin,margin]);
//var r = d3.scale.linear().domain([0,500]).range([0,20]);
//var o = d3.scale.linear().domain([10000,100000]).range([.5,1]);
//var c = d3.scale.category10().domain(["Africa","America","Asia","Europe","Oceania"]);
//
//var xAxis = d3.svg.axis()
//  .scale(x)
//  .orient("bottom");
//
//var yAxis = d3.svg.axis()
//  .scale(y)
//  .orient("left");

d3.json("data/data-manipulation.json", function(json) {

    // now we can easily sort data by decreasing population
    json.world.sort(function(a,b) {return b.population-a.population;});


    var margin = {top: 10, right: 20, bottom: 50, left: 50};
    var max = d3.max(json.world, function(d) { return d.population; });
    var min = d3.min(json.world, function(d) { return d.population; });
    console.log( max );
    var height = 500;
    var width = Math.round(max/500) + margin.left;

// Ich habe genug von einem kaputen fernseher eines kunden gehoert.



//    var width = 700;
    
//    var xScale = d3.scale.log().domain().range();
    
//    var x = d3.scale.linear().domain([min+1, max+1]).range([margin, width-margin]);
    var x = d3.scale.log().domain([ min, max ]).range([ margin.left, width - margin.right ]);
//    var y = d3.scale.linear().domain([-10,10]).range([height-margin,margin]);
    var y = d3.scale.linear().domain([ 0,10 ]).range([ height - margin.top, margin.bottom ]);
    var colors = d3.scale.category10().domain([ "Africa", "America", "Asia", "Europe", "Oceania" ]);

//    var xAxis = d3.svg.axis()
//        .scale(x)
//        .orient("top");

    var chart = d3.select(".chart")
        .append("svg")
        .attr("width", width)
        .attr("height", json.world.length * 20);

//    chart.append("g")
//        .attr("class", "x axis")
//        .attr("transform", "translate(0," + height + ")")
//        .call(xAxis);

    chart.selectAll("rect").data(json.world)
        .enter().append("rect")
        .attr("y", function(d, i) { return i * 20; })
        .attr("height", 20)
//        .attr("width", function(d) { return r(Math.sqrt(+d.population)); })
        .attr("width", function(d) { return d.population / 500; })
        .style("fill",function(d) { return colors(d.continent); });
//        .text(function(d) { return d.country; });

    chart.selectAll(".label").data(json.world)
        .enter().append("text")
        .attr("class", "label")
        .attr("x", function(d) { if( (d.population/500) > 50 )
                return (d.population / 500) - 5 ;
            else
                return (d.population / 500) + 65; })
        .attr("y", function(d, i) { return (i * 20) + 16; })
        .attr("text-anchor", "end")
        .style("colour", "white")
        .text(function(d) { return (Math.round(d.population) * 100 / 10000) + " mil"; });
        

// display value at the end of the bar
//chart.selectAll(".bar")
//    .data(data)
//  .enter().append("text")
//    .attr("class", "bar")
//    .attr("x", x)
//    .attr("y", function(d) { return y(d) + y.rangeBand() / 2; })
//    .attr("dx", -3) // padding-right
//    .attr("dy", ".35em") // vertical-align: middle
//    .attr("text-anchor", "end") // text-align: right
//    .style("colour", "white")
//    .text(String);
        

});

