<?php
/**
* Determines the size of files
*/

class Size 
{

	/** @var string $data contains the contents of the file requested 
	 */
	public $data = '';
	/** @var array $size contains the sizes of the file requested 
	 */
	public $size = array();


	/**
	 * Gets the data from css/js files
	 * @param array 	$obj contains an array of names
	 * @return string 	$url is the url of the website
	 */
	public function get_size($obj, $url, $request)
	{
		$size = [];
		foreach($obj as $value) {
			//check if the path is complete
			if (strpos($value, $url) !== false) {
				$data = $request->fetch($value);
			}
			else{
				//check if the name of the file starts with /, if not, add it
				if($value[0] == "/") {
					$data = $request->fetch($url.$value);
				}
				else {
					$data = $request->fetch($url."/".$value);
				}
			}
			array_push($size, strlen($data)/1000);
		}
		return $size;
	}
}