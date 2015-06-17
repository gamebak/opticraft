<?php
/**
* Scrape website for css&javascript files and images using regex
*/
class Scrape 
{
	//test

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
	 * Gets the domain name from an url
	 * @param string 	full url
	 * @return string 	return domain name
	 */
	public function get_domain($url)
	{
		$pieces = parse_url($url);
	  	$domain = isset($pieces['host']) ? $pieces['host'] : '';
	  	if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) 
	  	{
	    	return $regs['domain'];
	  	}
		return false;
	}	

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
			//convert each array element into string
			$str = (string)$arr[$i];

			//if external url, it must have http somewhere within the name
			if (strpos($str, "http://") !== false || strpos($str, "https://") !== false) {
				// check if is $this->domainName the main url
				
				if($this->get_domain($str) == $this->domainName)
					$arrValidLocal[] = $str;				
			}
			else
			{
				//not external, then add it to valid local array
				$arrValidLocal[] = $str;

			}

		}

		// return only valid ressources that are local, without complete domain path in url
		return $arrValidLocal;
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
		$match = preg_match_all('~(?<=href=(\"|\'))[^(\"|\')]+\.css~', $data, $arrayCss);
		return $this->filterLocalStrings($arrayCss[0]);
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
		$match = preg_match_all('~(?<=src=(\"|\'))[^(\"|\')]+\.js~', $data, $arrayJs);
		return $this->filterLocalStrings($arrayJs[0]);
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
		$match = preg_match_all('~(?<=src=(\"|\'))[^(\"|\')]+\.(jpg|gif|png|jpeg|bmp)~', $data, $arrayImg);

		return $this->filterLocalStrings($arrayImg[0]);
	}

	

}	

