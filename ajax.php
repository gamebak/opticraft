<?php
require_once("config.php");

$template = new Template;
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

	$data = $request->fetch($_POST['url_post_param']);

	$html = htmlentities($data);
	$matchcss = preg_match('~href=\'.*\.css\'~', $data, $matches);
	print_r($matches);
	$matchimg = preg_match('~src=".*\.png"~',$data,$matches);
	print_r($matches);

	
	
}
// else case
else
{
	echo "error, no page was set";
}
