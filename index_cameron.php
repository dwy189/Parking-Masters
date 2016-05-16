<!DOCTYPE html>
<html>
  <body>
<?php
   ini_set('display_errors', 1);
   ini_set('display_startup_errors', 1);
   error_reporting(E_ALL);
   
   $servername = "localhost";
$username = "root";
$password = "pmasters1234";
$dbname = "ParkingInfo";

// Create connection
   $conn = new mysqli($servername, $username, $password, $dbname);
   
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT lot_id, currentTime, occupied, distance FROM parkingInfo";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while ($row = $result->fetch_assoc()) {
    echo "lot_id: " . $row["lot_id"] . " - time: " . $row["currentTime"] .
         " " . $row["occupied"] . " - distance: " . $row["distance"];
  }
} else {
  echo "0 results";
}
$conn->close();
?>

  </body>
</html>
