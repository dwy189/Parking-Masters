<?php
    // Auto refresh the page every 60 seconds.
    $ipAddress = '173.250.246.144';
    $rounterIpAddress = '192.168.1.147';
    $url1=$_SERVER[$rounterIpAddress];
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
    $sql = "SELECT T2.* 
            FROM (SELECT lot_id, MAX(time) as most_recent FROM parkingInfo GROUP BY lot_id) T1, parkingInfo T2
            WHERE T1.lot_id = T2.lot_id AND T1.most_recent = T2.time; ";
    $result = $conn->query($sql);

    $dataArray = array();
    if ($result->num_rows > 0) {
      // output data of each row

      while ($row = $result->fetch_assoc()) {

        $dataArray[] = $row;
      }
    }  
    // write as json
    header("Content-type: application/json");
    $json_string = json_encode($dataArray);
    echo $json_string;

    $conn->close();
?>
