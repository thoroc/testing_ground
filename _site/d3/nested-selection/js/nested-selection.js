function tree(root, outerHeight) {
    var margin = {top: 0, right: 440, bottom: 0, left: 40};
    var width = 960 - margin.right;
    var height = outerHeight - margin.top - margin.bottom;
    var step = 120;

    var tree = d3.layout.tree()
        .size([height, 1])
        .separation(function() { return 1; });

    var svg = d3.select("body").append("svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
        .style("margin", "1em 0 1em " + -margin.left + "px");

    var g = svg.append("g")
        .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

    var nodes = tree.nodes(root);

    var link = g.selectAll(".link")
        .data(tree.links(nodes))
        .enter().append("path")
        .attr("class", "link")
        .attr("d", d3.svg.diagonal()
        .source(function(d) { return {y: d.source.depth * step, x: d.source.x}; })
        .target(function(d) { return {y: d.target.depth * step, x: d.target.x}; })
        .projection(function(d) { return [d.y, d.x]; }));

    var node = g.selectAll(".node")
        .data(nodes)
        .enter().append("g")
        .attr("class", function(d) { return (d.type || "") + " node"; })
        .attr("transform", function(d) { return "translate(" + d.depth * step + "," + d.x + ")"; });

    node.append("text")
        .attr("x", 6)
        .attr("dy", ".32em")
        .text(function(d) { return d.name; })
        .each(function(d) { d.width = this.getComputedTextLength() + 12; });

    node.insert("rect", "text")
        .attr("ry", 6)
        .attr("rx", 6)
        .attr("y", -10)
        .attr("height", 20)
        .attr("width", function(d) { return Math.max(32, d.width); });

    return svg;
}