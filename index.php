<?php
require_once("config.php");

/**Init template class*/
$template = new Template;


$template->title="Opticraft";
echo $template->renderHead();

echo "<h1>".$template->title."</h1>";

echo $template->renderFooter();

