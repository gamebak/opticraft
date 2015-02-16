





	
		



<?php
require_once("config.php");

// *Init template class
$template = new Template;

/**
 * Trebuie sa creezi array-ul cssHref inainte de renderHead ( pentru ca acolo sunt afisate, trebuie incarcate inainte )
 */

$template->title="Opticraft";
echo $template->renderHead();


echo $template->mainContainer();
echo $template->secondContainer();

/**
 * Load javascript files dynamically
 */
$template->scriptSrc[] = "//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js";
$template->scriptSrc[] = "js/bootstrap.min.js";

/**
 * This will output:
 * <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
 *  <script src="js/bootstrap.min.js"></script>
 */
echo $template->scriptsRender();


echo $template->renderFooter();

