<?php   if ( ! defined("_VALID_")) die("No direct script access");
/**
 * Template library
 * 
 * @author Davidmoreen <davidmoreen@gmail.com>
 * @version 1.0
 */

class Template extends Application {
	
	public $current_page	= null;
	public $subtitle		= null;
	public $meta_keywords	= array();
	public $meta_desc		= null;
	
	/**
	 * Display stylesheet link
	 */
	public function stylesheet($stylesheets)
	{
		$text = "";
		$stylesheets = (array)$stylesheets;
		
		foreach ($stylesheets as $stylesheet)
		{
			$text .= '<link rel="stylesheet" href="'.$this->path['css'] . $stylesheet.'.css" type="text/css" media="screen" charset="utf-8">';
		}
		
		return $text;
	}
	
	
	/**
	 * Application logo
	 */
	public function logo($height, $width, $custom = null)
	{
		if (!is_null($custom))
			$link = $this->path['template']."images/".$custom;
		else
			$link = $this->config['logo'];
		
		return '<a href="'.$this->config['base_url'].'" style="background:url('.$link.');height:'.$height.'px;width:'.$width.'px"></a>';
	}
	
	
	/**
	 * Set the current page vcariable
	 */
	public function set_current_page($page)
	{
		$this->current_page = $page;
	}
	
	
	public function set_subtitle($x)
	{
		$this->subtitle = $x;
	}
	
	
	public function set_meta_keywords($x)
	{
		$this->meta_keywords = $x;
	}
	
	
	public function set_meta_desc($x)
	{
		$this->meta_desc = $x;
	}
	
}