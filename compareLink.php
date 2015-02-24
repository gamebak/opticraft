<?php

require_once("config.php");


$r = new Request;
$url = $_POST["urlInput"];

//url filter to verify the validity of the url
$var = filter_var($url, FILTER_VALIDATE_URL);

/*if($var) {
	//verify the use of http://
	$str = substr($url, 0, 7);
	if($str!="http://") {
		echo "Please use http:// in front of the URL!";
	} else {
		$data = $r->fetch($url);
		var_dump($data);
	}
} else {
	echo "The URL does not exist!";
}*/

if($var) {
	echo "este url";
} else {
	echo "nu este url";
}




