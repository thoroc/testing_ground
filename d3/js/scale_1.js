/* Global variables */

/* Definition code */
function randomData() {
    return d3.range(10).map(function(i) {
        return {x: i / 9, y: Math.random()};
    });
}

function reDomain(maxValue) {
    var dy = Math.pow(10, Math.round(Math.log(maxValue) / Math.log(10)) - 1);
    return Math.ceil(maxValue / dy) * dy;
}

function updateData() {
    var data = randomData();
    var newMaxY = d3.max(data, function(d) {return d.y;});
    var newCeilY = reDomain(newMaxY);

    var w = 450,
        h = 450,
        x = d3.scale.linear().domain([0, 1]).range([0, w]),
        y = d3.scale.linear().domain([0, newCeilY]).range([h, 0]);

    var vis = d3.select("#mainGraph svg g");

    var yrule = vis.selectAll("g.y")
        .data(y.ticks(10));

    // yRule Enter
    var newrule = yrule.enter().append("svg:g")
        .attr("class", "y");

    newrule.append("svg:line")
        .attr("class", "yLine")
        .style("stroke", "#ccc")
        .style("shape-rendering", "crispEdges")
        .attr("x1", 0)
        .attr("x2", w)
        .attr("y1", 0)
        .attr("y2", 0)
        .transition()
        .duration(2000)
        .attr("y1", y)
        .attr("y2", y);

    newrule.append("svg:text")
        .attr("class", "yText")
        .attr("x", -3)
        .attr("dy", ".35em")
        .attr("text-anchor", "end")
        .attr("y", 0)
        .transition()
        .duration(2000)
        .attr("y", y)
        .text(y.tickFormat(10));

    // yLine Update
    yrule.select("line.yLine")
        .transition()
        .duration(2000)
        .attr("y1", y)
        .attr("y2", y);

    // yText Update
    yrule.select("text.yText")
        .transition()
        .duration(2000)
        .attr("y", y)
        .text(y.tickFormat(10));

    // yrule Remove
    var oldrule = yrule.exit();

    oldrule.select("line.yLine")
        .transition()
        .duration(2000)
        .attr("y1", 0)
        .attr("y2", 0)
        .remove();


    oldrule.select("text.yText")
        .transition()
        .duration(2000)
        .attr("y", 0)
        .remove();

    oldrule.transition()
        .duration(2000).remove();

    // Dots
    var node = vis.selectAll("path.dot")
        .data(data)
        .transition()
        .duration(2000)
        .attr("transform", function(d) { return "translate(" + x(d.x) + "," + y(d.y) + ")"; });

    node.select("title.dotTitle")
        .text(function(d) { return "X: " + d.x.toFixed(3) + ", Y: " + d.y.toFixed(3); });

}

var initData = function() {
    var data = randomData();
    var newMaxY = d3.max(data, function(d) {return d.y;});
    var newCeilY = reDomain(newMaxY);

    var w = 450,
        h = 450,
        p = 50,
        x = d3.scale.linear().domain([0, 1]).range([0, w]),
        y = d3.scale.linear().domain([0, newCeilY]).range([h, 0]);

    var chart = d3.select("#mainGraph")
        .append("svg:svg")
        .attr("width", w + p * 2)
        .attr("height", h + p * 2);

    var vis = chart.append("svg:g")
        .attr("transform", "translate(" + p + "," + p + ")");

    var xrule = vis.selectAll("g.x")
        .data(x.ticks(10))
        .enter().append("svg:g")
        .attr("class", "x");

    xrule.append("svg:line")
        .style("stroke", "#ccc")
        .style("shape-rendering", "crispEdges")
        .attr("x1", x)
        .attr("x2", x)
        .attr("y1", 0)
        .attr("y2", h);

    xrule.append("svg:text")
        .attr("x", x)
        .attr("y", h + 3)
        .attr("dy", ".71em")
        .attr("text-anchor", "middle")
        .text(x.tickFormat(10));

    var yrule = vis.selectAll("g.y")
        .data(y.ticks(10))
        .enter().append("svg:g")
        .attr("class", "y");

    yrule.append("svg:line")
        .attr("class", "yLine")
        .style("stroke", "#ccc")
        .style("shape-rendering", "crispEdges")
        .attr("x1", 0)
        .attr("x2", w)
        .attr("y1", y)
        .attr("y2", y);

    yrule.append("svg:text")
        .attr("class", "yText")
        .attr("x", -3)
        .attr("y", y)
        .attr("dy", ".35em")
        .attr("text-anchor", "end")
        .text(y.tickFormat(10));

    var node = vis.selectAll("path.dot")
            .data(data)
            .enter().append("svg:path")
            .attr("class", "dot")
            .style("fill", "white")
            .style("stroke-width", "1.5px")
            .attr("stroke", "#9acd32")
            .attr("transform", function(d) { return "translate(" + x(d.x) + "," + y(d.y) + ")"; })
            .attr("d", d3.svg.symbol())
            .on("mouseover", function(d,i) {
                d3.select(this).transition().duration(300).style("fill","#00ffff"); })
            .on("mouseout", function(d,i) {
                d3.select(this).transition().duration(300).style("fill","white"); });

    node.append("svg:title")
        .attr("class", "dotTitle")
        .text(function(d) { return "X: " + d.x.toFixed(3) + ", Y: " + d.y.toFixed(3); });
};

/* UI Events */
/* Execution code */
initData();