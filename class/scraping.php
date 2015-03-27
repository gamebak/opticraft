<?php
require_once("ajax.php");

/**
* Scrape website for css&javascript files and images using regex
*/
class Scrape 
{

	/**
	 * @var array $arrayCss contains the path to all the css files 
	 */
	public $arrayCss = array();
	/**
	 * @var array $arrayJs contains the path to all the js files
	 */
	public $arrayJs = array();
	/**
	 * @var array $arrayImg contains the path to all the images
	 */
	public $arrayImg = array();


	/**
	* Scrape the website for css files
	*
	* @param string $data content of the website
	*
	* @return string
	*/	
	public function scrapeCss($data) 
	{
		$match = preg_match_all('~href=\'.*\.css\'~', $data, $arrayCss);
		return $arrayCss;
	}	

	/**
	* Scrape the website for javascript files
	*
	* @param string $data content of the website
	*
	* @return string
	*/	
	public function scrapeJs($data) 
	{
		$match = preg_match_all('~src=".*\.js"~', $data, $arrayJs);
		return $arrayJs;
	}	

	/**
	* Scrape the website for images
	*
	* @param string $data content of the website
	*
	* @return string
	*/	
	public function scrapeImg($data) 
	{
		$url = $_POST['url_post_param'];
		$match = preg_match_all('~src=".*(.jpg|.gif|.png|.jpeg|.bmp)"~', $data, $arrayImg);
		return $arrayImg;
	}	
}	

