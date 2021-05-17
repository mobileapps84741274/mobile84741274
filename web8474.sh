<?php

$linux84747474744474 = file_get_contents("https://www.arionum.com/peers.txt");

$linux84747474744474 = explode("\n","$linux84747474744474");

$count8474 = "0";

$linux8474444474 = array();

$linux84744444744474 = array();

foreach($linux84747474744474 as $linux8474)

{

$count8474++;

$res = file_get_contents("$linux8474/mine.php?q=info");
$data = json_decode($res, true);

$linux8474444474[] = $data['data']['height'];

$linux84744444744474[] = "$linux8474/mine.php?q=info" . " " . $data['data']['height'];

if($count8474 == "8")

{

break;

}

}

$occurences = array_count_values($linux8474444474);

$linux84744444444474 = array();

foreach(array_keys($occurences) as $linux84748874)

{

$linux84744444444474[] = "$linux84748874";

}

$linux84748874747474 = reset($linux84744444444474);

foreach($linux84744444744474 as $linux844444444474)

{

if(preg_match("/$linux84748874747474/", $linux844444444474))

{

echo "$linux844444444474" . "<br>";

}

}

?>
