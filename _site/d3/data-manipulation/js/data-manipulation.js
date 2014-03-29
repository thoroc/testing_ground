
var width = 500,
    height = 500, 
    margin = 50;
var x = d3.scale.linear().domain([0,5]).range([margin,width-margin]);
var y = d3.scale.linear().domain([-10,10]).range([height-margin,margin]);
var r = d3.scale.linear().domain([0,500]).range([0,20]);
var o = d3.scale.linear().domain([10000,100000]).range([.5,1]);
var c = d3.scale.category10().domain(["Africa","America","Asia","Europe","Oceania"]);

var xAxis = d3.svg.axis()
  .scale(x)
  .orient("bottom");

var yAxis = d3.svg.axis()
  .scale(y)
  .orient("left");

d3.json("data/data-manipulation.json", function(json) {

    // now we can easily sort data by decreasing population
    json.world.sort(function(a,b) {return b.population-a.population;});

    var plot = d3.select(".plot")
        .append("svg")
        .attr("width",width)
        .attr("height",height);

    plot.append("g")
      .attr("class", "axis")
      .attr("transform", "translate(0," + (height - margin) + ")")
      .call(xAxis);

    plot.append("g")
      .attr("class", "axis")
       .attr("transform", "translate(" + margin + ",0)")
      .call(yAxis);

    plot.selectAll(".h").data(d3.range(-8,10,2)).enter()
      .append("line").classed("h",1)
      .attr("x1",margin).attr("x2",height-margin)
      .attr("y1",y).attr("y2",y);

    plot.selectAll(".v").data(d3.range(1,5)).enter()
      .append("line").classed("v",1)
      .attr("y1",margin).attr("y2",width-margin)
      .attr("x1",x).attr("x2",x);

    plot.selectAll("circle").data(json.world)
        .enter().append("circle")
        .attr("cx",function(d) { return x(+d.GERD); })
        .attr("cy",function(d) { return y(+d.growth); })
        .attr("r",function(d) { return r(Math.sqrt(+d.population)); })
        .style("fill",function(d) { return c(d.continent); })
        .style("opacity",function(d) { return o(+d.GDPcap); })
        .append("title")
        .text(function(d) {return d.country;});
});

