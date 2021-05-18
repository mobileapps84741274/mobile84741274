<?php

$linux84747474744474 = file_get_contents("https://www.arionum.com/peers.txt");

$linux84747474744474 = explode("\n","$linux84747474744474");

shuffle($linux84747474744474);

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

if($count8474 == "12")

{

break;

}

}

$occurences = array_count_values($linux8474444474);

asort($occurences);

print_r($occurences);

$linux84744444444474 = array();

foreach(array_keys($occurences) as $linux84748874)

{

$linux84744444444474[] = "$linux84748874";

}

$linux84748874747474 = end($linux84744444444474);

$linux8474222274 = array();

echo "<br>";

foreach($linux84744444744474 as $linux844444444474)

{

if(preg_match("/$linux84748874747474/", $linux844444444474))

{

echo "$linux844444444474" . "<br>";

$linux8474222274[] = preg_replace("/(.*) (.*)/","$1",$linux844444444474);

}

}

$linux844444444444444474 = array();

foreach($linux8474222274 as $linux8444224474747474)

{

$linux844444444444444474[] = "$linux8444224474747474";

}

$linux8444444444444444744474 = implode("\n",$linux844444444444444474);

echo file_put_contents("./peers.txt","$linux8444444444444444744474");

$linux88888888747474 = $linux8474222274[array_rand($linux8474222274)];

    $max_dl = 3600;
    $cache_file = "./linux84.sh";

    $f = file_get_contents("$linux88888888747474");
    $g = json_decode($f, true);

    $res = [
        "difficulty"    => $g['data']['difficulty'],
        "block"         => $g['data']['block'],
        "height"        => $g['data']['height'],
        "public_key"    => "PZ8Tyr4Nx8MHsRAGMpZmZ6TWY63dXWSCworn17gwq3phD49svFCvC7qoAFE4tamjsMKGjXpsxa6wd6XRKZSJBv8xxj37hCaus2qXG65pnaHv61DShsL6SQza",
        "limit"         => $max_dl,
        "recommendation"=> $g['data']['recommendation'], 
        "argon_mem"     => $g['data']['argon_mem'],  
        "argon_threads" => $g['data']['argon_threads'], 
        "argon_time"    => $g['data']['argon_time'],
    ];
    $fin = json_encode(["status" => "ok", "data" => $res, "coin" => "arionum"]);
    file_put_contents($cache_file, $fin);

?>
