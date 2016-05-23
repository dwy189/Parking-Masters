<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>parking masters</title>
    <script type="text/javascript" src="./d3/d3.v3.js"></script>
  </head>

  <h1>
    <b><center>Parking Masters</center></b>
  </h1>
  
  <body>
    <script type="text/javascript">

      /*
      var xmlhttp = new XMLHttpRequest();
      var url = "http://173.250.246.144/data.php";

      var idVal = [];
      xmlhttp.onreadystatechange = function() {
         if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var dataset = JSON.parse(xmlhttp.responseText);
            idVal = showData(dataset);
         }
      };
      xmlhttp.open("GET", url, true);
      xmlhttp.send();

      function showData(arr) {
         var out = new Array();
         var i;
         for (i=0; i<arr.length; i++) {
            out[i] = arr[i].lot_id;
         }
	 return out;
      }
      */
				 
				 
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
				 
     var force = d3.layout.force()
        .charge(-360)
        .size([w,h]);
				 

      d3.json("http://173.250.246.144/data.php", function(error, dataset){
         force
         .nodes(dataset)
         .start();
         				 
	 var spots = svg.selectAll(".circle")
         .data(dataset)
         .enter()
         .append("circle");

       /*
         spots.attr("cx", function(d,i){
            return i % 10 * 80 + 50;
         })
	.attr("cy", function(d,i){
           return Math.floor(i / 10) * 100 + 50;
	 })
	.attr("r", 20)
	.attr("stroke", function(d){
	   if (d.voltage <= 3.0)
              return "blue";
           else
	      return "yellow";		    
	 })
         .attr("stroke-width", 15px)
	 .attr("fill", function(d){
            if (d.distance <= 25)
               return "red";
            else
               return "green";
	 });
        */
	 spots.attr("r", 40)
         .attr("stroke", function(d){
	   if (d.voltage <= 3.0)
              return "blue";
           else
	      return "yellow";		    
	 })
	 .attr("stroke-width", 5)
	 .attr("fill", function(d){
            if (d.distance <= 25)
               return "red";
            else
               return "green";
	 })
         .call(force.drag);
			      
	 spots.append("title")
	 .text(function(d){return "spot_id: " + d.lot_id;});

         var num = svg.selectAll("text")
                   .data(dataset)
                   .enter()
                   .append("text")
                   .text(function(d){return d.lot_id;})
                   .call(force.drag);
			      
	 force.on("tick", function(){
            spots.attr("cx", function(d){return d.x;})
	         .attr("cy", function(d){return d.y;});
            
            num.attr("x", function(d){return d.x - 30;})
	       .attr("y", function(d){return d.y + 10;})
               .attr("font-family", "sans-serif")
               .attr("font-size", "40px")
	       .attr("font-weight", "bold")	      
	       .attr("fill", "purple");
			      
	 });
			      
       });
/*				 
      var spotdata = ["red","green","red","green","green","red","red","green","green"]
      var spots = svg.selectAll("circle")
      .data(spotdata)
      .enter()
      .append("circle");

      spots.attr("cx", function(d,i){
      return i*150 + 100;
      })
      .attr("cy", 80)
      .attr("r", 20)
      .attr("fill", "black");
*/
      
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
      <a href="http://173.250.246.144/devel.php">See Detail Stat</a>
    </center>
  </p>
  
</html>
