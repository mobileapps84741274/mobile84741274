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

$linux84744474 = date("Y-m-d H:i:s");

$linux847444744474 = $_GET['percentage'];

$sql = "INSERT INTO linux8474444474 (date, linux8474, linux84)
VALUES ('$linux84744474', '$linux847444744474', 'linux84')";

if ($conn->query($sql) === TRUE) {
  echo "";
} else {
}

$conn->close();

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

$linux84 = date("Y-m-d H:i:s", strtotime("-4 seconds", strtotime($linux84741274)));

$sql = "SELECT * FROM linux8474444474 WHERE date BETWEEN '" . $linux84 . "' AND  '" . $linux84741274 . "' ORDER by date DESC";
$result = $conn->query($sql);

$linux84741274 = array();

$date8474 = array();

$color84 = array();

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $linux84741274[] = $row["linux84"];
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

echo "bitcoin.blueinc.cloud";

echo "\n";

echo "---------------------";

echo count($linux84744474) . " Miners | " . $_GET['percentage'];

echo "\n";

echo "---------------------";

echo date("H:i:s") . " Time" . " | " . $_GET['battery'];

echo "\n";

echo "---------------------";

$linux84744474 = file_get_contents("./pool/linux84.sh");

$g = json_decode($linux84744474, true);

echo $g['data']['height'];

echo "\n";

echo "---------------------";

?>

