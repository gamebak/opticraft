<?php 
require_once("../config.php");

$r = new Request;
$data = $r->fetch("http://skyul.com");

var_dump($data);