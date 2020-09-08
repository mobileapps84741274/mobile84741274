<?php

if($_GET["q"] == "")
  
{
}

if($_GET["work"] == "workjob")
  
{

}

if($_GET["work"] == "job")
  
{

$google84741 = $_POST["argon"];

$google84742 = $_POST["nonce"];

$google84744 = $_POST["private_key"];

$google847412 = $_POST["public_key"];

$google847446 = $_POST["address"];

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,"http://mine.arionumpool.com/mine.php?q=submitNonce");
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-type: application/x-www-form-urlencoded'
));
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,
            "argon=$google847411&nonce=$google84742&private_key=$google84744&public_key=$google847412&address=$google847446");

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec($ch);

curl_close($ch);

if ($server_output == "OK")

{

echo "$server_output";

}

else

{

echo "$server_output";

}

}

?>
