<?php   if ( ! defined("_VALID_")) die("No direct script access");
/**
 * Validation class
 * 
 * @author Davidmoreen <davidmoreen@gmail.com>
 * @version 1.0
 */

class Validation {
	
	/**
	 * Validate a string for letter characters
	 */
	public function alpha($string)
	{
		return (bool)preg_match("/^[a-zA-Z]+$/", $string);
	}
	
	
	/**
	 * Validate a string for letters and numbers
	 */
	public function alphanum($string)
	{
		return (bool)preg_match("/^[a-z\d]+$/i", $string);
	}
	
	
	/**
	 * Validate a string for letters, numbers and underscores
	 */
	public function alphanumunder($string)
	{
		return (bool)preg_match("/^[a-z\d_]+$/i", $string);
	}
	
	
	/**
	 * Validate an email address
	 */
	public function email($string)
	{
		return (bool)preg_match("/^([a-z0-9])(([-a-z0-9._])*([a-z0-9]))*\@([a-z0-9])(([a-z0-9-])*([a-z0-9]))+(\.([a-z0-9])([-a-z0-9_-])?([a-z0-9])+)+$/i", $string);
	}
	
	
	/**
	 * Validate a url
	 */
	public function url($string)
	{
		return (bool)preg_match("/^(http|https):\/\/.+\.(.){1,6}$/i", $string); 
	}
	
	
	/**
	 * Validate a hex code
	 */
	public function hex($code)
	{
		return (bool)preg_match("/^(#)?([0-9a-f]{1,2}){3}$/i", $code);
	}
	
	
	/**
	 * Check the length of a string
	 */
	public function length($string, $max, $min)
	{
		$length = strlen($string);
		
		return ($length > $max)? false : (bool)($length >= $min);
	}
	
	
	/**
	 * Test a method from this class along with the length
	 */
	public function mlength($string, $method, $max, $min)
	{
		if (!$this->length($string, $max, $min)) return false;
		return (bool)$this->$method($string);
	}
	
}