<?php

require_once("config.php");

$r = new Request;
$url = $_POST["urlInput"];

$pattern = '~^https?://([0-9a-zA-Z]+\.[a-z]+)|([0-255]\.[0-255]\.[0-255]\.[0-255])$~';
$success = preg_match($pattern, $url);

if ($success) {
	$data = $r->fetch($url);
	var_dump($data); //????nu arata tot
} else {
	echo "NU incepe cu ce trebuie";
}







