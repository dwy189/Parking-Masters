<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>parking masters</title>
    <script type="text/javascript" src="./d3/d3.v3.js"></script>
    <script type="text/javascript" src="./d3/d3.tip.v0.6.3.js"></script>
    <script type="text/javascript" src="./d3/fisheye.js"></script>
  </head>
  
  <h1>
    <b><center>Parking Masters</center></b>
  </h1>

  <style>
    .d3-tip{
    line-height: 1;
    padding: 12px;
    background: rgba(100,100,0,0.8);
    color: #fff;
    border-radius: 2px;
    }
  </style>

  
  <body>
    <script type="text/javascript">

      var w = 1200;
      var h = 500;
      var svg = d3.select("body")
      .append("svg")
      .attr("width", w)
      .attr("height", h);

      d3.select("body").attr("align", "center");
				 
      var background = d3.select("svg")
      .append("rect")
      .attr("x", 0)
      .attr("y", 0)
      .attr("width", w)
      .attr("height", h)
      .attr("fill", "black");

      d3.json("/data.php", function(error, dataset){
         var tip = d3.tip()
	     .attr('class', 'd3-tip')
	     .offset([-10, 0])		      
             .html(function(d){
                if (d.voltage <= 3.0)
                   var volt = "Low";
                else
                   var volt = "Healthy";
                if (d.distance < 50)
                   var avail = "Occupied";
                else
                   var avail = "Available";
				 
                return "<span style='color:white'><strong>Spot ID: " +  d.lot_id + "<br>Availability: " + avail + "<br>Voltage status: " + volt + "</strong></span>";});
	
	 svg.call(tip);
      
	 var spots = svg.selectAll(".circle")
         .data(dataset)
         .enter()
         .append("circle")
         .attr("class", "circle");

      
         spots.attr("cx", function(d,i){
            return i % 10 * 100 + 140;
         })
	.attr("cy", function(d,i){
           return Math.floor(i / 10) * 200 + 150;
	 })
	.attr("r", 40)
	.attr("stroke", function(d){
	   if (d.voltage >= 3.0)
              return "blue";
           else
	      return "yellow";		    
	 })
         .attr("stroke-width", 5)
	 .attr("fill", function(d){
            if (d.distance <= 50)
               return "red";
            else
               return "green";
	 })
         .on('mouseover', tip.show)
         .on('mouseout', tip.hide);
			      

    	 spots.append("title")
	 .text(function(d){return "spot_id: " + d.lot_id;});

         var num = svg.selectAll("text")
                   .data(dataset)
                   .enter()
                   .append("text")
	           .text(function(d){
                      var wrap = "";
	              if (Math.floor(d.lot_id / 100) == 0){
                         if (Math.floor(d.lot_id / 10) == 0){
			    wrap = "00";
		         } else {   
                            wrap = "0";
			 }
                      } 
		      return wrap + d.lot_id;})
	            .attr("x", function(d,i){return i % 10 * 100 + 106;})
	            .attr("y", function(d,i){return Math.floor(i / 10) * 200 + 165;})
                    .attr("font-family", "sans-serif")
                    .attr("font-size", "40px")
	            .attr("font-weight", "bold")	      
	            .attr("fill", "purple");     

       });
      
    </script>
  </body>
  <p>
    <center>Fill-color: red --- spot occupied, green --- spot available</canter>
  </p>
  <p>
    <center>Stroke-color: blue --- battery healthy, yellow --- battery low</center>
  </p>
    
  <p>
    <center>
      <a href="/devel.php">See Detail Stat</a>
    </center>
  </p>
  
</html>
