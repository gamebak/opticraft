<?php 
require_once("../config.php");


$r = new Request;
$scrape = new Scrape;

/* Test page */
$data = $r->fetch("http://skyul.com");
$arrImg = $scrape->scrapeImg($data);

//var_dump($arrImg);


