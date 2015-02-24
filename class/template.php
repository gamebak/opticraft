<?php

/**
 * Render Templates from files
 */
class Template
{
	/**
	 * @var string $title          Page Title
	 */
	public $title;

	/**
	 * @var string $description    Page meta description
	 */
	public $description;

	/**
	 * @var array $scriptSrc 	    Inject scripts src inside scriptRender from array
	 */
	public $scriptSrc = array();

	/**
	 * @var  array $cssHref 		Inject css scripts in the header
	 */
	public $cssHref = array();

	/**
	 * Render the html header
	 * 
	 * @return string
	*/
	public function renderHeader()
	{
		$tmp = '<!DOCTYPE html>
		<html lang="en"><head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>'.$this->title.'</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		'.$this->cssRender().'
		</head><body>';

		return $tmp;
	}

	/**
	 * Load scripts dynamically and render them in page
	 * 
	 * @return string|void    String with scripts code
	 */
	public function scriptsRender()
	{
		if(count($this->scriptSrc) > 0 )
		{
			$tmpString = '';

			for($i=0; $i<count($this->scriptSrc); $i++)
			{
				$tmpString.= '<script src="'.$this->scriptSrc[$i].'"><script>';
			}

			return $tmpString;
		}
	}

	/**
	 * Load css files dynamically and render them in page
	 *
	 * @return string|void    String with css code
	 */
	public function cssRender()
	{
		if(count($this->cssHref) > 0 )
		{
			$tmpString = '';
			for($i=0; $i<count($this->cssHref); $i++)
			{
				$tmpString.= '<link href="'.$this->cssHref[$i].'" rel="stylesheet">';
			}

			return $tmpString;

		}
	}

	/**
	 * Render social buttons
	 */
	public function renderSocial()
	{
		return '<div class="row">
        <div class="col-lg-12 text-center v-center" style="font-size:39pt;">
          <a href="#"><i class="icon-google-plus"></i></a> <a href="#"><i class="icon-facebook"></i></a>  <a href="#"><i class="icon-twitter"></i></a> <a href="#"><i class="icon-github"></i></a> <a href="#"><i class="icon-pinterest"></i></a>
        </div>
      </div>';
	}

	public function mainContainer()
	{
		return '<div class="container-full">

      <div class="row">
       
        <div class="col-lg-12 text-center v-center">
          
          <h1>Welcome to Opticraft</h1>
          <p class="lead">A simple and efficient optimization tool for your web-site</p>
          
          <br><br><br>
          
          <form class="col-lg-12" action="compareLink.php" method="post">
            <div class="input-group" style="width:340px;text-align:center;margin:0 auto;">
            <input class="form-control input-lg" name="urlInput" value="http://" type="text">
              <span class="input-group-btn"><button class="btn btn-lg btn-primary" type="button">OK</button></span>
            </div>
          </form>
        </div>
        
      </div> <!-- /row -->
  	  '.$this->renderSocial().'
  
  	<br><br><br><br><br>

	</div> <!-- /container full -->';
	}

	/**
	 * Continuarea cu al doilea container, nu am fost inspirat ca-s obosit
	 * @return [type] [description]
	 */
	public function secondContainer()
	{
		return '<div class="container">
  		<hr>
	  	<div class="row">
	        <div class="col-md-4">
	          <div class="panel panel-default">
	            <div class="panel-heading"><h3>Hello.</h3></div>
	            <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis pharetra varius quam sit amet vulputate. 
	            Quisque mauris augue, molestie tincidunt condimentum vitae, gravida a libero. Aenean sit amet felis 
	            dolor, in sagittis nisi. Sed ac orci quis tortor imperdiet venenatis. Duis elementum auctor accumsan. 
	            Aliquam in felis sit amet augue.
	            </div>
	          </div>
	        </div>
	      	<div class="col-md-4">
	        	<div class="panel panel-default">
	            <div class="panel-heading"><h3>Hello.</h3></div>
	            <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis pharetra varius quam sit amet vulputate. 
	            Quisque mauris augue, molestie tincidunt condimentum vitae, gravida a libero. Aenean sit amet felis 
	            dolor, in sagittis nisi. Sed ac orci quis tortor imperdiet venenatis. Duis elementum auctor accumsan. 
	            Aliquam in felis sit amet augue.
	            </div>
	          </div>
	        </div>
	      	<div class="col-md-4">
	        	<div class="panel panel-default">
	            <div class="panel-heading"><h3>Hello.</h3></div>
	            <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis pharetra varius quam sit amet vulputate. 
	            Quisque mauris augue, molestie tincidunt condimentum vitae, gravida a libero. Aenean sit amet felis 
	            dolor, in sagittis nisi. Sed ac orci quis tortor imperdiet venenatis. Duis elementum auctor accumsan. 
	            Aliquam in felis sit amet augue.
	            </div>
	          </div>
	        </div>
	    </div>
	  
		<div class="row">
	        <div class="col-lg-12">
	        <br><br>
	          <p class="pull-right"><a href="http://www.bootply.com">Template from Bootply</a> &nbsp; ©Copyright 2013 ACME<sup>TM</sup> Brand.</p>
	        <br><br>
	        </div>
	  </div>
	</div>';
	}

	/**
	 * Render html enclosure
	 * 
	 * @return string
	 */
	public function renderFooter()
	{
		return '</body></html>';
	}
}