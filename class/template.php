<?php

/**
 * Render Templates from files
 */
class Template
{
	public $title, $description;

	/**
	 * Render the html head
	 * 
	 * @return string
	*/
	public function renderHead()
	{
		return '<html><head><title>'.$this->title.'</title></head>';
	}
}