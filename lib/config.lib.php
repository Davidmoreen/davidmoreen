<?php   if ( ! defined("_VALID_")) die("No direct script access");
/**
 * Configuration libary
 * 
 * @author Davidmoreen <davidmoreen@gmail.com>
 * @version 1.0
 */

class Config extends Application {
	
	public function __construct()
	{
		parent::__construct();
	}
	
	
	/**
	 * Get a config item
	 */
	public function item($item_name)
	{
		if (isset($this->config[$item_name]))
			return $this->config[$item_name];
		else {
			$query = $this->db->query("SELECT value FROM ".PREFIX."config WHERE name = '$item_name'");
			
			if ($query->num_rows == 0) return null;  // Not found in database
			$query = $query->fetch_assoc();
			
			return $query['value'];
		}
	}
		
}