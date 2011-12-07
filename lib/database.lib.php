<?php   if ( ! defined("_VALID_")) die("No direct script access");
/**
 * Database class (Mysqli)
 * 
 * @author Davidmoreen <davidmoreen@gmail.com>
 * @version 1.0
 */


class Database {
	
	private $_creds;  // database credentials
	private $_db;
	
	public function __construct($creds)
	{
		$this->_creds = $creds;
		
		$this->init();
	}
	
	
	/**
	 * Initiate the mysqli library and connection to database
	 */
	public function init()
	{
		$conn = array(
					"host" => $this->_creds['host'],
					"user" => $this->_creds['user'],
					"pass" => $this->_creds['pass'],
					"name" => $this->_creds['name']);
		
		// Make the connection
		$db = @new mysqli($conn['host'], $conn['user'], $conn['pass'], $conn['name']);
		
		// Check database connection
		if ($db->connect_error) {
			_kill("Database connection error", "There was an error connecting to the database. Please try again.");
		}
		else {
			$this->_db = $db;
			return true;
		}
	}
	
	
	/**
	 * Return an instance of the mysqli library
	 */
	public function instance()
	{
		return $this->_db;
	}
	
	
	/**
	 * Clean a string for database insertion
	 */
	public function clean($string, $allowed_tags = array())
	{
		return $this->_db->escape_string(strip_tags(trim($string), $allowed_tags));
	}
	
	
	/**
	 * Query result
	 */
	public function result_array($obj)
	{
		$result_array = array();
		while ($row = $obj->fetch_assoc()) {
			$result_array[] = $row;
		}
		
		return $result_array;
	}
	
}