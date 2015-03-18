<?php

require_once("config.php");
require_once("class\\template.php");

$template = new Template;

$r = new Request;
$url = $_POST["urlInput"];

$pattern = '~^https?://([0-9a-zA-Z]+\.[a-z]+)|([0-255]\.[0-255]\.[0-255]\.[0-255])$~';
$success = preg_match($pattern, $url);

if ($success) {
	$data = $r->fetch($url);
	//var_dump($data); ????nu arata tot
	echo "Este un URL valid";
} else {
	echo $template->cssRender();
	echo $template->renderError();
}








