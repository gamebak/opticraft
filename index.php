
<?php
require_once("config.php");

// *Init template class
$template = new Template;

$template->title="Opticraft";

/**
 * Load css files dynamically
 */
$template->cssHref[] = "css/bootstrap.min.css";
$template->cssHref[] = "//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css";
$template->cssHref[] = "css/styles.css";

echo $template->renderHeader();

echo $template->mainContainer();

/**
 * Load javascript files dynamically
 */
$template->scriptSrc[] = "//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js";
$template->scriptSrc[] = "js/bootstrap.min.js";
$template->scriptSrc[] = "js/app.js";

/**
 * This will output:
 * <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
 *  <script src="js/bootstrap.min.js"></script>
 */
echo $template->scriptsRender();


echo $template->renderFooter();




