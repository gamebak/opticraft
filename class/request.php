<?php

/**
* Fetch websites data and various filters for incoming data
*/
class Request
{
	public 
		$timeout = 18,
		$connectionTimeout = 8,
		$userAgent = "Mozilla/6.0 (Windows NT 6.2; WOW64; rv:16.0.1) Gecko/20121011 Firefox/16.0.1",
		$cookiePath = "/tmp/cookie.txt";

	/**
	* Fetch a webpage via GET/POST
	*
	* @param string $url Url to fetch
	* @param boolean|array $post Post array values
	* @param boolean|string $referral	Referral string, leave false if not used
	*
	* @return string
	*/
	public function fetch( $url, $post = false, $refferal = false)
	{
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			
			if(is_string($refferal)) curl_setopt($ch, CURLOPT_REFERER, $refferal);

			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeout);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $this->connectionTimeout);
			
			curl_setopt($ch, CURLOPT_USERAGENT, $this->userAgent);
			curl_setopt($ch, CURLOPT_COOKIEJAR, $this->cookiePath);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookiePath);		
			curl_setopt($ch, CURLOPT_URL, $url);
			
			if(is_array($post) && count($post) > 0)
			{
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS , $post);
			}
			
			if(curl_exec($ch) === false)
	   			echo 'Curl error: ' . curl_error($ch);
			
			$strResponse = curl_exec($ch);
			
			return $strResponse;
	}

	/**
	 * Check if url is valid
	 * @param  string $url
	 * @return boolean
	 */
	public function checkUrl($url)
	{
		if(preg_match('~^https?://([0-9a-zA-Z]+\.[a-z]+)|([0-255]\.[0-255]\.[0-255]\.[0-255])$~', $url))
			return true;

		return false;
	}

	public function curl_get_file_size( $url ) {
	    // Assume failure.
	    $result = -1;

	    $curl = curl_init( $url );

	    // Issue a HEAD request and follow any redirects.
	    curl_setopt( $curl, CURLOPT_NOBODY, true );
	    curl_setopt( $curl, CURLOPT_HEADER, true );
	    curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
	    curl_setopt( $curl, CURLOPT_FOLLOWLOCATION, true );
	    //curl_setopt( $curl, CURLOPT_USERAGENT, get_user_agent_string() );

	    $data = curl_exec( $curl );
	    curl_close( $curl );

	    if( $data ) {
	    	$content_length = "unknown";
	    	$status = "unknown";

	    	if( preg_match( "/^HTTP\/1\.[01] (\d\d\d)/", $data, $matches ) ) {
	      		$status = (int)$matches[1];
	    	}

	    	if( preg_match( "/Content-Length: (\d+)/", $data, $matches ) ) {
	      		$content_length = (int)$matches[1];
	    	}

	    	// http://en.wikipedia.org/wiki/List_of_HTTP_status_codes
	    	if( $status == 200 || ($status > 300 && $status <= 308) ) {
	      		$result = $content_length;
	    	}
	  	}

	  	return $result;
	}

}	
