<?php   if ( ! defined("_VALID_")) die("No direct script access");
/**
 * Data library (really just for flash sessions)
 * 
 * @author Davidmoreen <davidmoreen@gmail.com>
 * @version 1.0
 */


class Data {
	
	private $_flash_session_key;
	
	public function __construct()
	{
		$this->_flash_session_key = "_flash_";
		
		$this->_unset_old_flash_data();
		$this->_new2old();
	}
	
	
	/**
	 * Delete all flash data variables
	 */
	private function _unset_old_flash_data()
	{
		foreach ($_SESSION as $session => $value) {
			if (preg_match("/^" .substr($this->_flash_session_key, 1). "/", $session)){
				unset($_SESSION[$session]);
			}
		}	
	}
	
	
	/**
	 * Set new to old flash data, for deletion on next request
	 */
	private function _new2old()
	{
		foreach ($_SESSION as $session => $value)
			if (preg_match("/^" .$this->_flash_session_key. "/", $session)) {
				unset($_SESSION[$session]);
				$_SESSION[substr($session, 1)] = $value;
			}
	}
	
	
	/**
	 * Add a flash variable
	 */
	public function set_flash_data($name, $value = null)
	{
		if (is_array($name)) {
			foreach ($name as $session => $value)
				$_SESSION[$this->_flash_session_key . clean($session)] = clean($value, "<strong>");
		} else
			$_SESSION[$this->_flash_session_key . clean($name)] = clean($value, "<strong>");
	}
	
	
	/**
	 * Retrive flash data
	 */
	public function flash_data($data)
	{
		$data = clean($data);
		
		if (isset($_SESSION[substr($this->_flash_session_key . $data, 1)]))
			return $_SESSION[substr($this->_flash_session_key . $data, 1)];
		
		return false;
	}
	
}