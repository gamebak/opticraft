<?php
require_once("config.php");

$template = new Template;
$scrape = new Scrape;
$size = new Size;
$page = '';


if(isset($_GET['page'])) $page = $_GET['page'];

// ajax.php?page=url_check
if($page == 'url_check')
{
	$request = new Request;
	

	if(!isset($_POST['url_post_param']) || !$request->checkUrl($_POST['url_post_param']))
		die($template->renderError('Error, url not valid'));

	/*echo "Url valid logic...
		- scrape website
		- figure out css/js/img urls (internal)
	";*/

	$url = $_POST['url_post_param'];
	$data = $request->fetch($_POST['url_post_param']);
	$scrape->domainName = $scrape->get_domain($url);

	//var_dump($scrape->scrapeCss($data));
	//var_dump($scrape->scrapeJs($data));
	//var_dump($scrape->scrapeImg($data));

	var_dump($size->get_size($scrape->scrapeCss($data),$url,$request));
	var_dump($size->get_size($scrape->scrapeJs($data),$url,$request));
	var_dump($size->get_size($scrape->scrapeImg($data),$url,$request));


}
// else case
else
{
	echo "error, no page was set";
}
