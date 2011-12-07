<?php   if ( ! defined("_VALID_")) die("No direct script access");
/**
 * Featured content slide
 * 
 * @author Davidmoreen <davidmoreen@gmail.com>
 * @version 1.0
 */


class Slide extends Application {
	
	public $id;					// slide id
	public $title;				// slide title
	public $content;			// content description
	public $image;				// slide image
	public $link_title;			// view more link custom title
	public $link_destionation;	// view more link desctionation
	public $created_at;			// slide date created
	public $updated_at;			// slide updated on
	
	function __construct($info = array())
	{
		parent::__construct();
		
		if (count($info) > 0) {
			$this->parse($info);
		}
	}
	
	
	/**
	 * Parse all slide information
	 */
	public function parse($slide)
	{
		$this->_set_vars($slide);
		
		
	}
	
	
	/**
	 * Set class vars
	 */
	private function _set_vars($info)
	{
		foreach ($info as $key => $value) {
			$key = lc($key);
			$this->$key = trim($value);
		}
	}
	
	
	/**
	 * Check if slide has title
	 */
	public function has_title()
	{
		return (bool)($this->title != null);
	}
	
	
	/**
	 * Slide has desctiption
	 */
	public function has_content()
	{
		return (bool)($this->has_title() && $this->content != null);
	}
	
	
	/**
	 * Slide has an outside link
	 */
	public function has_link()
	{
		return (bool)($this->link_destionation != null);
	}
	
	
	/**
	 * Slide has a custom link title
	 */
	public function has_custom_link_title()
	{
		return (bool)($this->link_title != null);
	}
	
	
	/**
	 * Slide getters
	 */
	
	public function content()
	{
		return htmlspecialchars(stripslashes( $this->content ));
	}
	
	
	public function image()
	{
		return str_replace("[IMAGES_PATH]", $this->path['images'], $this->image);
	}
	
	
}