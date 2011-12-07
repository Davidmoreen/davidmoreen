<?php   if ( ! defined("_VALID_")) die("No direct script access");
/**
 * Main inheritable controller
 * 
 * @author Davidmoreen <davidmoreen@gmail.com>
 * @version 1.0
 */

class Application {
	
	protected $db;
	protected $raw_db;
	protected $config;
	protected $path;
	
	public function __construct()
	{
		global $Raw_db, $Db, $config, $path;
		
		$this->config = $config;
		$this->path   = $path;
		$this->db     = $Db;
		$this->raw_db = $Raw_db;
	}
	
}