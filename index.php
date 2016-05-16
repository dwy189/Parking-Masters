<!DOCTYPE html>
<html>
  <h1><b><center>Parking Masters</center></b></h1>
  <body>
    <style>
      table, th, td {
      border: 1px solid black;
      text-align:center;
      }
    </style>
    <?php
       // Auto refresh the page every 60 seconds.
       $ipAddress = '173.250.181.25';
       $url1=$_SERVER[$ipAddress];
       header("Refresh: 60; URL=$url1");

       $servername = "localhost";
       $username = "root";
       $password = "pmasters1234";
       $dbname = "ParkingInfo";

       // Create connection
       $conn = new mysqli($servername, $username, $password, $dbname);

       // Check connection
       if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    exit();
    }

    // Setup the local time in Seattle. Converted from UTC to PDT.
    $timeSql = "SET time_zone = '-7:00';";
    $conn->query($timeSql);
    // Query the mysql database
    $sql = "SELECT * FROM parkingInfo ORDER BY lot_id ASC;";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    echo "<center><table><tr><th>Spot ID</th><th>Time Updated</th><th>Occupied</th>
          <th>Distance(Inches)</th><th>Parking Duration(hh:mm:ss)</th><th>Park Time</th></tr>";
	// output data of each row
	while ($row = $result->fetch_assoc()) {
	    //$oDate = date('Y-m-d H:i:s', $row[currentTime]);
	    //$sDate = date('Y-m-d H:i:s', strtotime($row["currentTime"]);  // converted time format
	    $Park_Time = "2016-05-01 12:30:01";
	    $CurrentTimeDate = strtotime($row["time"]);
	    $OriginalTimeDate = strtotime($Park_Time);
	    // Convert duration from second to hour
	    $difference = ($CurrentTimeDate - $OriginalTimeDate);
	    $differenceInHours = floor($difference / 3600);
	    $differenceInMinutes = floor(($difference / 60) % 60);
	    $differenceInSeconds = $difference % 60;
    

 	    if ($row["distance"] <= 25) {
	        $occupied = "Yes";
    	        $Parking_Duration = "$differenceInHours:$differenceInMinutes:$differenceInSeconds";
	    } else {
    	        $occupied = "No";
	        $Park_Time = "";
	        $Parking_Duration = "";
	    }

	    // $Parking_Duration = "2h";
	    // $Park_Time = "2000-01-01 00:00:01";
	    echo "<tr><td>" . $row["lot_id"] . "</td><td>" . $row["time"] .
	         "</td><td>" . $occupied . "</td><td>" . $row["distance"] . "</td><td>" . $Parking_Duration . "</td><td>" . $Park_Time . "</td></tr>";
        }
        echo "</table></center>";
    } else {
        echo "0 results";
    }
    				    
    $conn->close();
    ?>
  </body>
</html>
