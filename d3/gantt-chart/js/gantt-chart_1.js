var height = 300;
var width = 500;

var json = d3.json("data/gantt-chart-example.json")

var chart = d3.select("body").selectAll(".chart")
    .append("div")
    .data(json)
    .attr("class", "chart");
    
chart.selectAll("div")
    .enter().append("div")
    .data(json)
    .style("width", function(d) { return d * 10 + "px"; })
    .text(function(d) { return d; });
    

