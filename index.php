<?php


require_once("config.php");
$template = new Template;

$template->title="Opticraft";
echo $template->renderHead();


echo $template->renderFooter();

echo "<h1>".$template->title."</h1>";