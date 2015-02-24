<?php 
require_once("../config.php");


$r = new Request;
$data = $r->fetch();

var_dump($data);
