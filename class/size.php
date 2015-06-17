<?php
/**
* Determines the size of files
*/

require_once("config.php");
$request = new Request;

class Size 
{

	/** @var string $data contains the contents of the file requested 
	 */
	public $data = '';
	/** @var float $size contains the size of the file requested 
	 */
	public $size = 0;

	/**
	 * Gets the data from css/js files
	 * @param array 	$obj contains an array of names
	 * @return string 	$url is the url of the website
	 */
	public function get_size($obj,$url)
	{
		
		foreach($obj as $value) {
			//check if the path is complete
			if (strpos($value, $url) !== false) {
				$data = $request->fetch($_POST[$value]);
			}
			else{
				//check if the name of the file starts with /, if not, add it
				if($value[0] == "/") {
					$data = $request->fetch($_POST[$url.$value]);
				}
				else {
					$data = $request->fetch($_POST[$url."/".$value]);
				}
			}
		}
		$size = strlen($data);
		return $size;
	}
}