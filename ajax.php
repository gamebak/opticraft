<?php
require_once("config.php");

$page = '';

if(isset($_GET['page'])) $page = $_GET['page'];

// ajax.php?page=url_check
if($page == 'url_check')
{
	$request = new Request;
	

	if(!isset($_POST['url_post_param']) || !$request->checkUrl($_POST['url_post_param']))
		die($template->renderError('Error, url not valid'));

	echo "Url valid logic...
		- scrape website
		- figure out css/js/img urls (internal)
	";

}
// else case
else
{
	echo "error, no page was set";
}
