var t = 1297110663, // start time (seconds since epoch)
    v = 70, // start value (subscribers)
    data = d3.range(33).map(next); // starting dataset

function next() {
    return {
        time: ++t,
        value: v = ~~Math.max(10, Math.min(90, v + 10 * (Math.random() - .5)))
    };
}

setInterval( function() {
    data.shift();
    data.push( next());
    redraw();
}, 1500);

var w = 20,
    h = 80;
    
var x = d3.scale.linear()
    .domain([0, 1])
    .range([0, w]);

var y = d3.scale.linear()
    .domain([0, 100])
    .rangeRound([0, h]);

var chart = d3.select("#graph").append("svg")
    .attr("class", "chart")
    .attr("width", w * data.length - 1)
    .attr("height", h)
   .append("g")
     .attr("transform", "translate(25, 0)");

//// vertical bar
//chart.selectAll("line")
//    .data(y.ticks(5))
//  .enter().append("line")
//    .attr("x1", 0)
//    .attr("x2", w * data.length)
//    .attr("y1", y)
//    .attr("y2", y)
//    .attr("stroke", "#CCC");

//// horizontal ruler
//chart.selectAll(".rule")
//    .data(y.ticks(5))
//  .enter().append("text")
//    .attr("class", "rule")
//    .attr("x", 0)
////    .attr("y", h-y)
////    .attr("y", function(d) { return - d; })
//    .attr("y", function(d) { return -d * 4 / -5; })
//    .attr("dx", -5)
////    .attr("dy", function(d) { return d + 5})
//    .attr("dy", 5)
//    .attr("text-anchor", "end")
//    .text(function(d) { return 100 - d; });

chart.selectAll("rect")
    .data(data)
    .enter().append("rect")
    .attr("x", function(d, i) { return x(i) - .5; })
    .attr("y", function(d) { return h  - y(d.value) - .5; })
    .attr("width", w)
    .attr("height", function(d) { return y(d.value); });

//chart.selectAll("text")
//    .data(data)
//    .enter().append("text")
//    .attr("class", "label")
//    .attr("x", function(d, i) { return x(i) - .5; })
//    .attr("y", function(d) { 
//                    if(d.value < 25) {
//                        return h - y(d.value); 
//                    }
//                    else {
//                        return h - y(d.value) + 18;
//                    }
//                })
//    .attr("dy", -3) // vertical-align: middle
//    .attr("dx", 1)
//    .text(function(d) { return d.value; });

chart.append("line")
    .attr("x1", 0)
    .attr("x2", w * data.length)
    .attr("y1", h - .5)
    .attr("y2", h - .5)
    .style("stroke", "#000");

function redraw() {
    // Update...
    var rect = chart.selectAll("rect")
        .data(data, function(d) { return d.time; });

    rect.enter().insert("rect", "line")
        .attr("x", function(d, i) { return x(i) - .5; })
        .attr("y", function(d) { return h - y(d.value) - .5; })
        .attr("width", w)
        .attr("height", function(d) { return y(d.value); })
        .transition()
        .duration(1000)
        .attr("x", function(d, i) { return x(i) - .5; });

    rect.transition()
        .duration(500)
        .attr("x", function(d, i) { return x(i) - .5; });

    rect.exit().transition()
        .duration(500)
        .attr("x", function(d, i) { return (x - 25) * (i - 1) - .5; })
        .remove();

//    var label = chart.selectAll(".label")
//        .data(data, function(d) { return d.time; });
//
//    label.enter().insert("text")
//        .attr("x", function(d, i) { return x(i) - .5; })
//        .attr("y", function(d) { 
//                        if(d.value < 25) {
//                            return h - y(d.value); 
//                        }
//                        else {
//                            return h - y(d.value) + 18;
//                        }
//                    })
//        .attr("dy", -3) // vertical-align: middle
//        .attr("dx", 1)
//        .text(function(d) { return d.value; });
//
//    label.transition()
//        .duration(1000)
//        .attr("x", function(d, i) { return x(i) - .5; });
//
//    label.exit()
//        .remove();
}