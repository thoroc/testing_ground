/*
 * SRF SVG Extension SVG object
 *
 * @file js-includes/srfsvgt.svg.js
 *
 * @author Leo Bergmann,
 *         Patrick Skiebe,
 *         Philipp Theil
 */

/**
 *
 *  Main object to load and evaluate all wiki data
 *  Draw the d3 powered SVG graphic + update it when necessary
 */
function srfsvgt_svg_object(){


  // Definition of global vars used

  // Timestamp of last bar click event, used to 
  // prevent sttrange behaviour on bar doubleclick events
  this.lastClick = new Date().getTime();
  this.doubleClickDelay = 500; //ms

  // Time period of the selected range
  this.period;

  // Default sizes and positions of the d3 graph
  this.borderRight      = 40,
  this.borderLeft       = 20,
  this.borderTop        = 4,
  this.spaceChartScale  = 4,
  this.spaceGroups      = 2,
  this.widthOfChart     = cf.p['svg_width']['set_val'],
  this.heightOfChart    = cf.p['svg_height']['set_val'],
  this.widthOfCaption   = 150,
  this.heightOfScale    = 50,
  // Default sizes of the scale that belongs to the graph
  this.widthOfScale     = this.widthOfChart  - (this.borderRight + this.borderLeft) - this.widthOfCaption,
  this.heightOfCaption  = this.heightOfChart - this.heightOfScale - this.spaceChartScale -this.borderTop,
  this.widthOfData      = this.widthOfScale,
  this.heightOfData     = this.heightOfCaption, 
  // Default sizes of one timebar
  this.heightOfBar        = 25,
  this.heightOfFocusBar   = 75,
  this.heightOfUnFocusBar = 15,

  // scaleStartDate & scaleEndDate keep the current time range
  // which is set via the timeslider
  this.scaleStartDate   = new Date(),
  this.scaleEndDate     = new Date();
  // scaleLeftBorder & scaleRightBorger keep the max & min time range
  // of the used data stored
  this.scaleLeftBorder  = new Date(),
  this.scaleRightBorder = new Date();

  // D3 Elements
  this.groups;
  this.captions;
  this.barLabels;
/**
 *  Init function sets up the needed wrapper and parent 
 *  elemnts for the d3 graph
 *  Writes wrappers to the HTML
 */
this.init = function() {
    
    // Draw SVG Container
    d3.select("#placeholderSVG")
    .append("div")
      .attr("id", "grafik")
      .style("max-height", sv.heightOfChart+"px" )
      .style("width", sv.widthOfChart+"px");

    
    // Magnifier Symbols
    d3.select("#grafik")
    .append("div")
      .attr("id", "magnifierWrapper")
    .append("svg:svg")
      .attr("id", "magnifier");

    // Minus Magnifier
    d3.select("#magnifier")
    .append("svg:g")
      .attr("id", "minus")
      .attr("transform", "translate(10,0) scale(0.8)")
      .attr("cursor", "pointer")
      .on("click", this.fnc_unFocusAllGroups);
    d3.select("#minus")
    .append("svg:path")
      .attr("d", "M16.573,3.573c-1.245-3.262-5.651-4.432-10.147-2.92s-7.38,5.133-6.135,8.395 c1.062,2.781,4.603,4.215,8.411,3.642l2.84,7.44c0,0,1.059,0.002,2.212-0.412c1.153-0.414,1.627-0.879,1.627-0.879l-2.84-7.44 C15.869,9.572,17.635,6.354,16.573,3.573z")
      .attr("fill", "#999999");
    d3.select("#minus")
    .append("svg:path")
      .attr("d", "M10.484,11.283C6.886,12.493,2.666,11.109,1.67,8.5s1.361-5.705,4.958-6.915 c3.597-1.209,7.569-0.074,8.565,2.535S14.081,10.074,10.484,11.283z")
      .attr("fill", "#fefefe");
    d3.select("#minus")
    .append("svg:polygon")
      .attr("points", "4.738,7.56 4.738,5.119 8.44,5.119 12.142,5.119 12.142,7.56")
      .attr("fill", "#999999");
    
    // Plus Magnifier
    d3.select("#magnifier")
    .append("svg:g")
      .attr("id", "plus")
      .attr("transform", "translate(30,0) scale(0.8)")
      .attr("cursor", "pointer")
      .on("click", this.fnc_focusAllGroups);
    d3.select("#plus")
    .append("svg:path")
      .attr("d", "M16.573,3.573c-1.245-3.262-5.651-4.432-10.147-2.92s-7.38,5.133-6.135,8.395 c1.062,2.781,4.603,4.215,8.411,3.642l2.84,7.44c0,0,1.059,0.002,2.212-0.412c1.153-0.414,1.627-0.879,1.627-0.879l-2.84-7.44 C15.869,9.572,17.635,6.354,16.573,3.573z")
      .attr("fill", "#999999");
    d3.select("#plus")
    .append("svg:path")
      .attr("d", "M10.484,11.283C6.886,12.493,2.666,11.109,1.67,8.5s1.361-5.705,4.958-6.915 c3.597-1.209,7.569-0.074,8.565,2.535S14.081,10.074,10.484,11.283z")
      .attr("fill", "#fefefe");
    d3.select("#plus")
    .append("svg:polygon")
      .attr("points", "12.105,5.133 9.647,5.133 9.647,2.675 7.233,2.675 7.233,5.133 4.776,5.133 4.776,7.547 7.233,7.547 7.233,10.004 9.647,10.004 9.647,7.547 12.105,7.547")
      .attr("fill", "#999999");


    // Caption and Timeline Wrapper
    d3.select("#grafik")
    .append("div")
      .attr("id", "divTimelineWrapper")  
      .style("width",  sv.widthOfChart+"px")
      .style("max-height", sv.heightOfData+"px" )
    .append("svg:svg")
      .attr("id", "timelineWrapper");
    
    // Timeline
    d3.select("#timelineWrapper")
    .append("svg:g")
      .attr("id", "timeline")
      .attr("width", this.widthOfChart)
      .attr("transform", "translate(0,"+ this.borderTop +")");
   
    // Scale Wrapper
    d3.select("#grafik")
    .append("div").attr("id", "divScaleWrapper")
      .style("width",  this.widthOfChart+"px")    
      .style("height", this.heightOfScale+"px")    
    .append("svg:svg")
      .attr("id", "scaleWrapper")
    .append("svg:rect")
      .attr("id", "scaleBg")
      .attr("width", this.widthOfChart)
      .attr("height", 0)
    .transition().duration(600).delay(700)
      .attr("height", this.heightOfScale);

    // Scale
    d3.select("#scaleWrapper")
    .append("svg:g")
      .attr("id", "scale")
      .attr("transform", "translate("+ (this.borderLeft+sv.widthOfCaption) +",0)");

    // Set Date Range for the slider, for the first start the slider is in max length
    this.scaleStartDate = jo.jsonObject.minDateInData.dt;
    this.scaleEndDate   = jo.jsonObject.maxDateInData.dt;
    // Set the total Date Range Frontiers
    this.scaleLeftBorder  = this.scaleStartDate;
    this.scaleRightBorder = this.scaleEndDate;
    // Calculate Period 
    this.period = this.scaleEndDate.getFullYear() - this.scaleStartDate.getFullYear();

    // Custom Event to call the Slidercontrols to update its date range
    $('#placeholderSVG').trigger("gotDateBounds");

    // Fill the wrapper / parent elements with data driven graphics
    this.drawNow();
} // END init





  ////////////////////////////////////////////////////////////////////////
  // Draw SVG Chart
  ////////////////////////////////////////////////////////////////////////
  // Further notes on the d3 functions:
  // jo.jsonObject calls the JSon object which conatins the data
  // When a function from a d3 object is called with function(d,i),
  // it allows to iterate (i) the data (d) that is bound to the d3 object
  ////////////////////////////////////////////////////////////////////////
/**
 *  Function to evaluate the data from the JSON object and 
 *  draw the visible elemnts based on the data (eg. bars, scale labels+ticks, ...)
 */
this.drawNow = function(){

    // Scale the time bars (x, y) and the scale (xs) to fit the specified sizes in combination
    // with the data
    var x  = retSclFnc(this.scaleStartDate, this.scaleEndDate, this.borderLeft, this.widthOfData ),
        xs = retSclFnc(this.scaleStartDate.getFullYear(), (this.scaleEndDate.getFullYear()), 0, this.widthOfScale ),
        scaleToGroup,
        usedSpace;
    function y(d){return sv.heightOfBar*d;}

    // Draw category groups /////////////////////////////////////////////////////////

    // Container for Groups
    sv.groups = d3.select("#timeline").selectAll("g")
    .data(jo.jsonObject.groupNames, function(d) {usedSpace=0;return d;})
    .enter().append("svg:g")
      .attr("id", function(d,i){return "wr"+i;})
      .attr("class", "katGroupWrapper")
      .attr("width",  this.widthOfData)
      .attr("height", function(d,i){return  y(jo.jsonObject.groups[d].length);})
      .attr("transform", function(d,i){
        var thisYPos = usedSpace;
        usedSpace += y(jo.jsonObject.groups[d].length);
        sv.heightOfData = usedSpace;
        return "translate(0,"+ thisYPos +")";
      });

    // Update the wrapper
    sv.updateWrapper();
    
    // Add captions for the category groups
    d3.selectAll(".katGroupWrapper")
      .append("svg:g")
      .attr("id", function(d,i){return "c"+i;})
      .attr("class", "caption")
    .append("svg:rect")
      .attr("class", "captionBg")
      .attr("width", 0)
      .attr("height", function(d){return y(jo.jsonObject.groups[d].length)-sv.spaceGroups;})
    .transition().duration(600)
      .attr("width", sv.widthOfCaption+5);
    
    // Add EventListener to the caption, if it is clicked the category group
    // switches into the unFocused state
    d3.selectAll(".caption")
      .on("click", this.fnc_unFocusGroup);
    // Magnifier 
      // .append("svg:polygon")
      //   .attr("fill", "#CCCCCC")
      //   .attr("points", "17.056,9.855 17.056,6.097 9.474,6.097 5.652,6.097 5.652,9.855")


    // Add caption label with the group category name
    d3.selectAll(".caption")
    .append("svg:text")
      .attr("class", "capLabel")
      .attr("dy", "0.2em")
      .attr("x", "11em")
      .attr("text-anchor", "end")      
      .attr("transform", function(d){return "translate(0,"+ (y(jo.jsonObject.groups[d].length)/2) +")";})
      .text(function(d, i){return jo.jsonObject.groupNames[i].replace(/_/g, " ");});

    // Add category group background element
    d3.selectAll(".katGroupWrapper")
    .append("svg:g")
      .attr("id", function(d,i){return "kG"+i;})
      .attr("class", "katGroup")
      .attr("transform", "translate("+ (sv.widthOfCaption) +",0)")
    .append("svg:rect")
      .attr("class", "katGroupBg")
      .attr("width", 0)
      .attr("height", function(d,i){return  y(jo.jsonObject.groups[d].length);})
      .attr("transform", "translate(5,0)" )
    .transition().duration(600)
      .attr("width", this.widthOfData+sv.borderLeft-5);
    
    // Add EventListener to the category group background, if it is clicked the category group
    // switches into the focused state where further data is added to the bars
    d3.selectAll(".katGroup")
      .on("click", this.fnc_focusGroup);
    
    // Adds the triangle element to the category caption
    d3.selectAll(".katGroup")
      .append("svg:polyline")
        .attr("class", "polyline")
        .attr("linejoin", "bevel")
        .attr("points", "5.3,17.68 5.3,17.489 0.3,11.788 5.3,5.817 5.3,5.63")
        .attr("transform", function(d){ 
          return "translate(0,"+ (y(jo.jsonObject.groups[d].length)/2-sv.heightOfBar/2) +")";
        });

    // Draw time bars into the groups
    d3.selectAll(".katGroup").selectAll("g")
    .data(function(d,i){
        //Define scaleFunction for each Group
        scaleToGroup = retSclFnc(0, jo.jsonObject.groups[d].length, 0, y(jo.jsonObject.groups[d].length) );
        return jo.jsonObject.groups[d];
      })
    .enter().append("svg:g")
      .attr("id", function(d, i){
          return fnc_checkValidityOfID("barID_" + jo.jsonObject.items[d].label);
        })
      .attr("class", "bar")
      .attr("transform", function(d,i){
          var start = jo.jsonObject.items[d].start;
          return "translate("+ x(start) +","+ (scaleToGroup(i)+sv.spaceGroups/2) + ")";
        })
      // Add EventListener to the bar to open a Info Box with the abstract and picture of the selected bar entry
      .on("click", function(d,i){
          // stop the bar click event from propagating to events higher in the hierarchy
          d3.event.stopPropagation();
          // quick'n'dirty fix to block the popup in state2 bars
          if ($(this).parent().parent().attr('class').baseVal==='focus') {return;}
          else{fnc_showInfoBox(jo.jsonObject.items[d].label);}
        })
    .append("svg:rect")
      .attr("class", "barBg")
      .attr("width", function(d,i){
          var start = jo.jsonObject.items[d].start,
              end   = jo.jsonObject.items[d].end;
              return x(end) - x(start) ;
        })
      .attr("height", 0)
      .transition().duration(400).delay(function(d,i){return (i+10)*24;})
      .attr("height", function(){return y(0.9);});

    //Add a label to the bar (based on its "content")
    d3.selectAll(".bar")
    .append("svg:text")
      .attr("class", "label")
      .attr("id", "labelID")
      .attr("dx", 10)
      .attr("dy", (y(0.9)*(2/3)))
      .attr("opacity", 1)
      .text(function(d, i){return (jo.jsonObject.items[d].label).toUpperCase();});

    // Add a labelLink to the bar which is shown in the focused state
    d3.selectAll(".bar")
      .append("svg:a")
      .attr("xlink:href", function(d, i){return jo.jsonObject.items[d].uri;})
      .attr("xlink:title", function(d, i){return jo.jsonObject.items[d].label;})
      .attr("target", "_blank")
      .append("svg:text")
      .attr("class", "labelLink")
      .attr("id", "labelLinkID")
      .attr("dx", 10)
      .attr("dy", (y(1.25)))
      .attr("opacity", 0)
      .text("Link");


    // Draw Scale //////////////////////////////////////////////////////////

    // Handle ticks according to period
    var ruleTicks = this.period;
    while(ruleTicks > 20){ruleTicks--;} 
    var lineTicks = this.period/2;
    var xscl = retSclFnc(0, lineTicks, 0, this.widthOfScale);

    var scale = d3.select("#scale");

    // Add the ticks to the scale
    scale.selectAll("rect")
    .data(xs.ticks(lineTicks))
    .enter().append("svg:rect")
      .attr("class", "scaleTicks")
      .attr("width", this.widthOfScale/lineTicks/2)
      .attr("height", this.heightOfScale)
      .attr("transform", function(d,i){
          return "translate("+ xscl(i) +","+ 0 +")";
        });

    // Add the date text elements to the scale
    scale.selectAll("text.rule")
    .data(xs.ticks(ruleTicks))
    .enter().append("svg:text")
      .attr("class", "rule")
      .attr("x", xs )
      .attr("y", this.heightOfScale*(3/5))
      .attr("text-anchor", "middle")
      .text(String);

    // Colorize group bars
    this.colorizeGroupBars();
}; // END drawNow()



  ////////////////////////////////////////////////////////////////////////
  // Re-Draw SVG Chart
  ////////////////////////////////////////////////////////////////////////
  
/**
 *  Used to redraw the graph after a change; eg the slider range was dragged,
 *  or a click on the caption oder katGroup occured
 */
this.reDrawNow = function(){

    // Scale the time bars (x) and the scale (xs) to fit the specified sizes in combination
    // with the data; y, yFG, yUFG = height, heightOfFocusedGroup, heightOfUnfocusedGroup
    var x  = retSclFnc(this.scaleStartDate, this.scaleEndDate, this.borderLeft, this.widthOfData ),
        xs = retSclFnc(this.scaleStartDate.getFullYear(), (this.scaleEndDate.getFullYear()), 0, this.widthOfScale ),
        scaleToGroup,
        usedSpace = 0;
    function y(d){return sv.heightOfBar*d;};
    function yFG(d){return sv.heightOfFocusBar*d;};
    function yUFG(d){ 
      if (d!==0) {return sv.heightOfUnFocusBar;}
      else {return 0;}
     };

    // NORMAL GROUPS  ////////////////////////////////////////////////////////
    var katGroups = d3.selectAll(".katGroupWrapper");

    // Caption
    katGroups.selectAll(".captionBg")
      .transition().duration(400)
      .attr("height", function(d){return y(jo.jsonObject.groups[d].length)-sv.spaceGroups;});
    // Caption label
    katGroups.selectAll(".capLabel")
      // .transition().duration(400)
      .attr("transform", function(d){return "translate(0,"+ (y(jo.jsonObject.groups[d].length)/2) +")";})
      .attr("font-size", "");
    // KatGroups
    katGroups
      .attr("height", function(d,i){return y(jo.jsonObject.groups[d].length);});

    // Change all category groups and their children
    katGroups.selectAll(".katGroupBg")
      .transition().duration(450)
      .attr("height", function(d){return y(jo.jsonObject.groups[d].length);})
      .each("start", function(){
        katGroups.selectAll(".bar")
          .transition().duration(400)
          .attr("height", function(){return y(1);})
          .attr("transform", function(d,i){
              return "translate("+ sliceAttr( (d3.select(this).attr("transform")), "x" )
              +","+ (y(i)+sv.spaceGroups/2) +")";
          });
        katGroups.selectAll(".barBg")
          .transition().duration(300)
          .attr("height", function(){return y(1)-sv.spaceGroups;})
          .attr("opacity", 1);

        katGroups.selectAll(".label")
          .transition().duration(250)
          .attr("opacity", 1);

        katGroups.selectAll(".labelInactive")
          .transition().duration(250)
          .attr("opacity", 1);

        katGroups.selectAll(".labelLink")
          .transition().duration(250)
          .attr("opacity", 0);

        katGroups.selectAll(".bar").selectAll("image")
          .transition().duration(250)
          .attr("opacity", 0);
      });
    
    katGroups.selectAll(".polyline")
      .transition().duration(400)
      .attr("transform", function(d){return "translate(0,"+ (y(jo.jsonObject.groups[d].length)/2-sv.heightOfBar/2) +")";});



    // FOCUS GROUPS ////////////////////////////////////////////////////////
    var focusGroups = d3.selectAll(".focus");  

    // Change the caption and caption label to the now needed height / position
    focusGroups.selectAll(".captionBg")
      .attr("height", function(d){return yFG(jo.jsonObject.groups[d].length)-sv.spaceGroups;});

    focusGroups.selectAll(".capLabel")
      .transition().duration(400).delay(250)
      .attr("transform", function(d){
          return "translate(0,"+ (yFG(jo.jsonObject.groups[d].length)/2) +")";
        })
      .attr("font-size", "100%");

    focusGroups
      .attr("height", function(d,i){return yFG(jo.jsonObject.groups[d].length);});
    
    focusGroups.selectAll(".katGroupBg")
      .transition().duration(600)
      .attr("height", function(d){return yFG(jo.jsonObject.groups[d].length);})
      .each("start", function(){
        focusGroups.selectAll(".bar")
          .transition().duration(400).delay(200)
          .attr("height", function(){return yFG(1);})
          .attr("transform", function(d,i){
              return "translate("+ sliceAttr( (d3.select(this).attr("transform")), "x" )
              +","+ (yFG(i)+sv.spaceGroups/2) +")";
            });
        focusGroups.selectAll(".barBg")
          .transition().duration(400).delay(300)
          .attr("height", function(d){return yFG(1)-sv.spaceGroups;})
          .attr("opacity", 1);
        // Render the label and the labelLink visible
        focusGroups.selectAll(".katGroup").selectAll("text")
          .transition().duration(250)
          .attr("opacity", 1);
        // Render the image, if loaded visible
        focusGroups.selectAll(".bar").selectAll("image")
          .transition().duration(600)
          .attr("opacity", function(){
            var opacity = 1;
            // get the ID of the parent bar
            var parentId = "#" + (d3.select(this).attr("id")).slice(6, d3.select(this).attr("id").length);
            // get the x value of the parent bar as float value
            var transX = parseFloat(d3.select(parentId).attr("transform").slice(10, (d3.select(parentId).attr("transform").length - 4)));
            // get the length of the added labels
            var lblLength = d3.select(parentId).select("text").node().getComputedTextLength();
            // get the width of the image
            var imgWidth = parseFloat(d3.select(this).attr("width"));
            // signal if call comes from the focus group or not
            var fromFocus = true;

            return checkForThumbnailOffset(opacity, parentId, transX, lblLength, imgWidth, fromFocus);
          });
      });

    focusGroups.selectAll(".polyline")
      .transition().duration(400).delay(200)
      .attr("transform", function(d){
          return "translate(0,"+ (yFG(jo.jsonObject.groups[d].length)/2-sv.heightOfBar/2) +")";
        });

    // unbind inline popup box events for all not unfocused bars
    $("[id^=barID_] > .barBg").unbind('mouseover').unbind('mouseout');



    // UN-FOCUS GROUPS ////////////////////////////////////////////////////////
    var unFocusGroups = d3.selectAll(".unfocus");  

    // Change the caption and caption label to the now needed height / position
    unFocusGroups.selectAll(".capLabel")
    // .transition().duration(400).delay(250)
      .attr("transform", function(d){
          return "translate(34,"+ (yUFG(jo.jsonObject.groups[d].length)/2) +")";
        }) 
      .attr("font-size", "75%") ;
      

    unFocusGroups.selectAll(".captionBg")
      .transition().duration(400).delay(250)
      .attr("height", function(d){return yUFG(jo.jsonObject.groups[d].length)-sv.spaceGroups;});

    unFocusGroups
      .attr("height", function(d,i){return yUFG(jo.jsonObject.groups[d].length);});

    unFocusGroups.selectAll(".katGroupBg")
      .transition().duration(600)
      .attr("height", function(d){return yUFG(jo.jsonObject.groups[d].length);})
      .each("start", function(){
        unFocusGroups.selectAll(".bar")
          .transition().duration(400).delay(200)
          .attr("height", function(){return yUFG(1);})
          .attr("transform", function(d,i){
              return "translate("+ sliceAttr( (d3.select(this).attr("transform")), "x" )
              +","+ (yUFG(0)+sv.spaceGroups/2) +")";
            });
        unFocusGroups.selectAll(".barBg")
          .transition().duration(400)
          .attr("height", function(d){return yUFG(1)-sv.spaceGroups;})
          .attr("opacity", 0.3);
        // Render the label and the labelLink invisible
        unFocusGroups.selectAll(".katGroup").selectAll("text")
          .transition().duration(250)
          .attr("opacity", 0);
        // Render the image, if loaded invisible
        unFocusGroups.selectAll(".bar").selectAll("image")
          .transition().duration(250)
          .attr("opacity", 0);    
      });

    unFocusGroups.selectAll(".polyline")
      .transition().duration(400).delay(200)
      .attr("transform", function(d){return "translate(0,"+ (yUFG(jo.jsonObject.groups[d].length)/2-sv.heightOfBar/2) +")";});



    // NORMAL GROUPS ////////////////////////////////////////////////////////
    sv.groups.transition().duration(800)
      .delay(function(d,i){return i*12;})
      .attr("transform", function(d,i){
          var thisYPos = usedSpace;
          var cls = d3.select(this).attr("class");
          if (cls==="focus") {usedSpace += yFG(jo.jsonObject.groups[d].length);}
          else if(cls==="unfocus") {usedSpace += yUFG(jo.jsonObject.groups[d].length);}
          else {usedSpace += y(jo.jsonObject.groups[d].length);}
        
          sv.heightOfData = usedSpace;
          return "translate(0,"+ thisYPos +")";
        })
      .each("end", sv.updateWrapper);

    // adds the mouse over handling for the pop up box containing the bar names if a group is unfocused
    $(".unfocus").find("[id^=barID_] > .barBg").bind('mouseover', mo.activateInlineModal).bind('mouseout', mo.hideInlineModal);
    

  } // END ReDrawNow()






  ////////////////////////////////////////////////////////////////////////
  // Set New Time
  ////////////////////////////////////////////////////////////////////////
/**
 *  Handling to scale in realtime while the slider handle is dragged
 */
this.newTime = function(){

    // Scale the time bars (x) and the scale (xs) to fit the specified sizes in combination
    // with the data
    var x = retSclFnc(this.scaleStartDate, this.scaleEndDate, this.borderLeft, this.widthOfData),
        xs = retSclFnc(this.scaleStartDate.getFullYear(), this.scaleEndDate.getFullYear(), 0, this.widthOfScale),
        scaleToGroup,
        usedSpace = 0;

    // Remove Scale Entries while dragging
    d3.selectAll(".rule")
      .transition().delay( function(d,i){
        return i*24
      })
    .attr("opacity", 0)

    // Handle width and transform of all groups
    sv.groups.selectAll(".bar")
      .attr("width", function(d,i){
          var start = jo.jsonObject.items[d].start;
          var end   = jo.jsonObject.items[d].end;
          return x(checkForRightOffset(end)) - x(checkForLeftOffset(start)) ;
        })
      .attr("transform", function(d,i){
          var start = jo.jsonObject.items[d].start;
          return "translate("+ x(checkForLeftOffset(start)) +","
          + sliceAttr(d3.select(this).attr("transform"), "y") + ")";
        })
   
    //Bars
    sv.groups.selectAll(".barBg")
      .attr("width", function(d,i){
          var start = jo.jsonObject.items[d].start,
              end   = jo.jsonObject.items[d].end;
          return x(checkForRightOffset(end)) - x(checkForLeftOffset(start)) ;
        })

    // Adds an arrow to the label if the parent bar is out of focus to supply it's destination
    sv.groups.selectAll(".bar").select(".label")
      .text(function(d, i){
          var start = jo.jsonObject.items[d].start;
          var end   = jo.jsonObject.items[d].end;
          return checkForLabelArrow((jo.jsonObject.items[d].label).toUpperCase(), start, end);
        })
    sv.groups.selectAll(".bar").select(".labelInactive")
      .text(function(d, i){
          var start = jo.jsonObject.items[d].start;
          var end   = jo.jsonObject.items[d].end;
          return checkForLabelArrow((jo.jsonObject.items[d].label).toUpperCase(), start, end);
        })
    
    // Check if an image is displayed or not depending on the offset
    sv.groups.selectAll(".bar").select("image")
      .attr("opacity", function(){
          var opacity = d3.select(this).attr("opacity");
          // get the ID of the parent bar
          var parentId = "#" + (d3.select(this).attr("id")).slice(6, d3.select(this).attr("id").length);
          // get the x value of the parent bar as float value
          var transX = parseFloat(d3.select(parentId).attr("transform").slice(10, (d3.select(parentId).attr("transform").length - 4)));
          // get the length of the added labels
          var lblLength = d3.select(parentId).select("text").node().getComputedTextLength();
          // get the width of the image
          var imgWidth = parseFloat(d3.select(this).attr("width"));
          // signal if call comes from the focus group or not
          var fromFocus = false;

          return checkForThumbnailOffset(opacity, parentId, transX, lblLength, imgWidth, fromFocus);
        })

    // Handle the lablelink if there is overflow for the labellink
    sv.groups.selectAll(".bar").select(".labelLink")
      .attr("transform", function(d,i){
          var lblLength = d3.select(this).node().getComputedTextLength();
          var start     = jo.jsonObject.items[d].start;
          var end       = jo.jsonObject.items[d].end;
          var barValue  = x(checkForLeftOffset(start));        
          return checkForLabelOffset(start, end, lblLength, barValue);
        })

    // Handle the lables if there is overflow for the label
    sv.groups.selectAll(".bar").select(".label")
      .attr("transform", function(d,i){
          var lblLength = d3.select(this).node().getComputedTextLength();
          var start     = jo.jsonObject.items[d].start;
          var end       = jo.jsonObject.items[d].end;
          var barValue  = x(checkForLeftOffset(start));
          return checkForLabelOffset(start, end, lblLength, barValue);   
        })
    sv.groups.selectAll(".bar").select(".labelInactive")
      .attr("transform", function(d,i){
          var lblLength = d3.select(this).node().getComputedTextLength();
          var start     = jo.jsonObject.items[d].start;
          var end       = jo.jsonObject.items[d].end;
          var barValue  = x(checkForLeftOffset(start));
          var newValue;
          return checkForLabelOffset(start, end, lblLength, barValue);   
        })
            
    // Handle the color of the labels if it's parent bar is outside of the timerange  
    sv.groups.selectAll(".bar").select(".label")
      .attr("class", function(d,i){
          var start = jo.jsonObject.items[d].start;
          var end   = jo.jsonObject.items[d].end;
          return checkForLabelColor(start, end);
        })
    sv.groups.selectAll(".bar").select(".labelInactive")
      .attr("class", function(d,i){
          var start = jo.jsonObject.items[d].start;
          var end   = jo.jsonObject.items[d].end;
          return checkForLabelColor(start, end);
        })
      
} // END newTime()



  ////////////////////////////////////////////////////////////////////////
  // Redraw Scale
  ////////////////////////////////////////////////////////////////////////  

/**
 *  Used to totally redraw the scale after a full change (eg. handle released
 *  after dragging, switching the focus state, ...)
 */
this.reDrawScale = function(){
    
    // Handle ticks according to period
    var ruleTicks = this.period;
    while(ruleTicks > 20){ruleTicks--} 
    var lineTicks = this.period/2;


    var scale = d3.select("#scale");
    var xs = retSclFnc(this.scaleStartDate.getFullYear(), this.scaleEndDate.getFullYear(), 0, this.widthOfScale);
    var xscl = retSclFnc(0, lineTicks, 0, this.widthOfScale);
    var lines = scale.selectAll("line").data(xs.ticks(lineTicks));
    var rects = scale.selectAll(".scaleTicks").data(xs.ticks(lineTicks)); 
    var rulers = scale.selectAll(".rule");


    // Remove old Ticks
    rects.exit()
      .transition().duration(200).delay(function(d,i){ return i*12 })
      .attr("opacity", 0)
      .remove();

    // New Ticks
    rects.enter().append("svg:rect")
      .attr("class", "scaleTicks")
      .attr("width", sv.widthOfScale/lineTicks/2)
      .attr("height", sv.heightOfScale)
      .attr("transform", "translate("+ xs(sv.scaleEndDate.getFullYear()) +",0)")
      .transition().duration(400).delay(function(d,i){ return i*12 })
      .attr("transform", function(d,i){
          return "translate("+ xscl(i) +",0)"
        })
     
    // Update     
    rects.transition().duration(400).delay(function(d,i){ return i*12 })
      .attr("width", sv.widthOfScale/lineTicks/2)
      .attr("transform", function(d,i){
          return "translate("+ xscl(i) +",0)"
        })

    // Remove Old Rulers
    d3.selectAll(".rule")
    .remove()
    // New Rulers
    scale.selectAll(".rule")
      .data(xs.ticks(ruleTicks))
      .enter().insert("svg:text")
      .attr("class", "rule")
      .attr("x", xs)
      .attr("y", sv.heightOfScale*(3/5))
      .attr("text-anchor", "middle")
      .attr("opacity", 0)
      .text(String)
      .transition().duration(600).delay( function(d,i){
          return i*24
        })
      .attr("opacity", 1);

} // END reDrawScale()




  ////////////////////////////////////////////////////////////////////////
  // Functions
  ////////////////////////////////////////////////////////////////////////

  //Un/Focus Toggle Classes
/**
 *  To focus the group, the user has clicked on
 */
this.fnc_focusGroup = function(){
    // prevent double click
    if(new Date().getTime()-sv.doubleClickDelay < sv.lastClick){return;}
    sv.lastClick = new Date().getTime();
    // console.log("focus Click! on "+ d3.select(this).attr("id"));
    var currId  = d3.select(this).attr("id").replace(/kG/g, "#wr"); 
    var currElm = d3.select(String(currId));
    if(currElm.attr("class") == "focus"){
      currElm.attr("class", "katGroupWrapper");
      unloadInlineThumbnail(d3.select(this));
    }
    else{
      currElm.attr("class", "focus");
      loadInlineThumbnail(d3.select(this));
    }
    sv.reDrawNow();
} // END fnc_focusGroup()

/**
 *  To focus all groups, started by click on the positive magnifier
 */ 
this.fnc_focusAllGroups = function(){
    // prevent double click
    if(new Date().getTime()-sv.doubleClickDelay < sv.lastClick){return;}
    sv.lastClick = new Date().getTime();
    // all Groups get focus class
    d3.selectAll(".katGroupWrapper").attr("class", "focus");
    d3.selectAll(".unfocus").attr("class", "focus");
    unloadInlineThumbnail(d3.select(this));
   
    sv.reDrawNow();
} // END fnc_focusAllGroups()

/**
 *  To unfocus the group, the user has clicked on
 */
this.fnc_unFocusGroup = function(){
    // prevent double click
    if(new Date().getTime()-sv.doubleClickDelay < sv.lastClick){return;}
    sv.lastClick = new Date().getTime();
    // console.log("UnFocus Click! on "+ d3.select(this).attr("id"));
    var currId  = d3.select(this).attr("id").replace(/c/g, "#wr");  
    var currElm = d3.select(String(currId)); 
    (currElm.attr("class") == "unfocus") ? currElm.attr("class", "katGroupWrapper") 
                                         : currElm.attr("class", "unfocus");      
    unloadInlineThumbnail(d3.select(this));
    sv.reDrawNow();
} // END fnc_unfocusGroup()

/**
 *  To unfocus all groups, started by click on the negative magnifier
 */
this.fnc_unFocusAllGroups = function(){
    // prevent double click
    if(new Date().getTime()-sv.doubleClickDelay < sv.lastClick){return;}
    sv.lastClick = new Date().getTime();
    // all Groups get focus class
    d3.selectAll(".katGroupWrapper").attr("class", "unfocus");
    d3.selectAll(".focus").attr("class", "unfocus");
    unloadInlineThumbnail(d3.select(this));
   
    sv.reDrawNow();
} // END fnc_unFocusAllGroups()

/**
 *  Update the height of the div Wrapper for whole Chart 
 */
this.updateWrapper = function(){
    //Update wrapper
    d3.select("#timelineWrapper")
      .transition()
      .attr("height", sv.heightOfData+sv.spaceChartScale+sv.borderTop)
} // END updateWrapper()

/*
 *  Assign different analogous colors of the base
 *  color set in admin interface to every group
 */
this.colorizeGroupBars = function(){

    var wikiColor = cf.p['base_color']['set_val'];
    var shuffleColorPalette = true;
    var groupColors = new Array();
    var xColors = $.xcolor.analogous(wikiColor, results=jo.jsonObject.groupCount, slices=50);
    $.each(xColors , function(index, value){
      groupColors.push(value+'');
    });

    // Fisher-Yates algorithm to shuffle the group colors array
    // http://sroucheray.org/blog/2009/11/array-sort-should-not-be-used-to-shuffle-an-array/
    if (shuffleColorPalette) {
      var i = groupColors.length, j, temp;
      if (i != 0) {
        while ( --i ) {
          j = Math.floor( Math.random() * ( i + 1 ) );
          temp = groupColors[i];
          groupColors[i] = groupColors[j];
          groupColors[j] = temp;
        }
      }
    }

    $('.katGroup').each(function(index){
      $(this).find('.barBg').css("fill", groupColors[index]);
    });
} // END colorGroupBars()

/**
  *  Extract the Label Information of all bars in an unfocused group
  *  return <Array> Strings with the names of all articles in this group
  *  @return {array} group entries (label titles)
  */
function fnc_getLabelText(d){
      var groupEntries = [];
      var j = 0;
      for(j = 0; j < jo.jsonObject.groups[d].length; j++){
        groupEntries.push(jo.jsonObject.items[(jo.jsonObject.groups[d][j])].label);
      }
      return groupEntries;
  }
} // END srfsvgt_svg_object()
