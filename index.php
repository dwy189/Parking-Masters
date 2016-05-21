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
  
  <style>
    table, th, td {
    border: 1px solid black;
    text-align:center;
    }
  </style>

  <body>
    <script type="text/javascript">
      


      
      var w = 1200;
      var h = 400;
      var svg = d3.select("body")
      .append("svg")
      .attr("width", w)
      .attr("height", h);
/*
      var background = d3.select("svg")
      .append("rect")
      .attr("x", 0)
      .attr("y", 0)
      .attr("width", w)
      .attr("height", h)
      .attr("fill", "black")
*/

      var spotdata = [1,2,3,4,5,6,7,8]
      var spots = svg.selectAll("circle")
      .data(spotdata)
      .enter()
      .append("circle");

      spots.attr("cx", function(d,i){
      return i*150 + 100;
      })
      .attr("cy", 80)
      .attr("r", 20)
      .attr("fill", "blue");

      
    </script>
  </body>
  <p>
    <center>
      <a href="http://173.250.246.144/devel.php">See Detail Stat</a>
    </center>
  </p>
  
</html>
