<?php
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

	/** @var string $domainName main domain in the current scraping object */
	public $domainName = '';


	/**
	 * Filter elements in array based on the domain path
	 * @param array 	list of scraped data css/js/img
	 * @return array    return array only with local imgs/css/js files
	 */
	public function filterLocalStrings($arr)
	{
		// you have to set $this->domainName for validation first!
		if(empty($this->domainName))
			return 'Exception, please set domainName for validation!';

		// here we will save every ressource
		$arrValidLocal = array();
		for($i = 0; $i<count($arr); $i++)
		{
			//if external url, it must start with http or have www. in it
			$str = (string)$arr[0][$i];
			/*if(strstr($str, 'http') || strstr($str, 'https') || strstr($str, 'www'))
			{
				if($this->domainName == strstr($str, '.', true))
				 	$arrValidLocal[] = $arr[$i];	
				echo "e dintr-un site!!! ". $str;			
			}
			else
			{
				//not external, then add it to valid local array
				$arrValidLocal[] = $arr[$i];
			}
			return $arrValidLocal;
			
		}

		// return only valid ressources that are local, without complete domain path in url
		return $arrValidLocal;*/

	}

	/**
	* Scrape the website for css files
	*
	* @param string $data content of the website
	*
	* @return string
	*/	
	public function scrapeCss($data) 
	{
		$match = preg_match_all('~[a-zA-Z0-9:/_.-]+\.css~', $data, $arrayCss);

		return $this->filterLocalStrings($arrayCss);
		//return $arrayCss;
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
		$match = preg_match_all('~[a-zA-Z0-9:/_.-]+\.js~', $data, $arrayJs);

		return $this->filterLocalStrings($arrayJs);
		//return $arrayJs;
	}	

	/**
	* Scrape the website for images
	*
	* @param string $data content of the website
	*
	* @return boolean|string  		returns false if nothing found
	*/	
	public function scrapeImg($data) 
	{
		$match = preg_match_all('~[a-zA-Z0-9:/_.-]+(\.jpg|\.gif|\.png|\.jpeg|\.bmp)~', $data, $arrayImg);
		// no results, or no images found

		return $this->filterLocalStrings($arrayImg);
		//return $arrayImg;
	}

}	

