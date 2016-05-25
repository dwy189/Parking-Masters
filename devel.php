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
      
  <?php
     $json_file = file_get_contents('http://localhost/data.php');
     $jfo = json_decode($json_file, true);
     # var_dump($jfo);
     date_default_timezone_set('America/Los_Angeles');
     $currentTime = new DateTime();	
     $currentTimeInFormat = $currentTime->format('Y-m-d H:i:s');
     if (count($jfo) > 0) {
        echo "<center><table><tr><th>Spot ID</th><th>Time Updated</th><th>Occupied</th><th>Parking Duration</th>
              <th>Distance(Inches)</th><th>Need Charge</th></tr>";
        foreach ($jfo as $spot) {
           if ($spot[distance] <= 50) {
    	      $occupied = "Yes";
	      
	      $ParkingTimeInDateTime = new DateTime($spot[time]);
              $RawParkingDuration = $ParkingTimeInDateTime->diff($currentTime);	
	      $ParkingDuration = $RawParkingDuration->d . " day(s) " . $RawParkingDuration->h . " hours " . $RawParkingDuration->i . " minutes " ;
	      $occupiedColor = "red";
           } else {
              $occupied = "No";
	      $ParkingDuration = "";
              $occupiedColor = "green";
           }
    
           if ($spot[voltage] <= 3.0 ) {
              $needCharge = "Yes";
              $voltageColor = "red";
           } else {
              $needCharge = "No";
              $voltageColor = "green";
           }
  
           echo "<tr><td>" . $spot[lot_id] . "</td><td>" . $spot[time] . "</td><td><font color='" . $occupiedColor . "'>" . $occupied . "</td><td>" . $ParkingDuration . "</td><td>" .  $spot[distance] .
	        "</td><td><font color='" . $voltageColor . "'>" . $needCharge . "</td></tr>";

       }
       echo "</table></center>";
    } else {
       echo "0 results";
    }
 
  ?>
 </body>
				  
  <p>
    <center>
      <a href="/">Back To Main Page</a>
    </center>
  </p>




</html>
