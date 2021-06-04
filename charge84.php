<?php

date_default_timezone_set('Africa/Johannesburg');

$servername = "localhost";
$username = "root";
$password = "08KdRQV7FLhW0SZY";
$dbname = "linux8474444474";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$linux84741274 = date("Y-m-d H:i:s");

$linux84 = date("Y-m-d H:i:s", strtotime("-2 minutes", strtotime($linux84741274)));

$sql = "SELECT * FROM linux8474444474 WHERE date BETWEEN '" . $linux84 . "' AND  '" . $linux84741274 . "' ORDER by date DESC";
$result = $conn->query($sql);

$linux84741274 = array();

$date8474 = array();

$color84 = array();

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $linux84741274[] = $row["linux8474"];
    $date8474[] = $row["linux84"];
    $color84[] = "\"#00b0ff\"";
  }
}
$conn->close();

$linux84744474 = array_reverse($linux84741274);

$linux84744474 = array_filter($linux84744474);

$linux84741274 = implode(",",$linux84744474);

$date8474 = array_reverse($date8474);

$date8474 = implode(",",$date8474);

$color84 = implode(",",$color84);

echo $linux84744 = array_sum($linux84744474) / count($linux84744474);

if($linux84744 < 90)

{

echo "";

}

else

{

echo "";

}

?>
