var margin = {top: 10, right: 10, bottom: 30, left: 30},
    width = 400 - margin.left - margin.right,
    height = 300 - margin.top - margin.bottom;

var x = d3.scale.linear()
    .domain([0, 10])
    .range([0, width]);

var y = d3.scale.log()
    .domain([1,5])
    .range([0, height]);

var xAxis = d3.svg.axis()
    .scale(x)
    .orient("bottom");

var yAxis = d3.svg.axis()
    .scale(y)
    .orient("left");

var svg = d3.select(".chart").append("svg")
    .attr("width", width + margin.left + margin.right)
    .attr("height", height + margin.top + margin.bottom)
  .append("g")
    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

svg.append("g")
    .attr("class", "x axis")
    .attr("transform", "translate(0," + height + ")")
    .call(xAxis);

svg.append("g")
    .attr("class", "y axis")
    .call(yAxis);
            
//var data = [[1,1.5],[2,2],[3,2.5],[4,3],[5,3.5],[6,4],[7,4.5],[8,5],[4,5,10]];
var data = [[1,1.5],[2,2],[3,2.5],[4,3],[5,3.5],[6,4],[7,4.5],[8,5],[9,3]];
//var data = [[1,1.5],[2,2],[3,2.5],[4,3],[5,3.5],[6,4],[7,4.5],[8,5]];
var bars = svg.selectAll("rect")
    .data(data)
 .enter().append("rect")
    .attr("x", function(d) {return x(d[0]) - 10;})
    .attr("y", function(d) {return height - y(d[1]);})
    .attr("width",20)
    .attr("height", function(d) {return y(d[1]);})
    .style("fill","steelblue");
