<?php   if ( ! defined("_VALID_")) die("No direct script access");
/**
 * Cookie helper
 * 
 * Easy CRUD cookie operations
 * 
 * @author Davidmoreen <davidmoreen@gmail.com>
 * @since 1.0
 */

/**
 * Set a cookie
 */
function set_cookie($name = '', $value = '', $expire = '', $path = '/', $domain = '')
{
	if ($expire == '')
		$expire = time() + 60*60;  // 24 hours
	else
		$expire = time() + $expire;
	
	setcookie($name, $value, $expire, $path, $domain, 0);	
}


/**
 * Delete a cookie
 */
function delete_cookie($name)
{
	set_cookie($name, '', time()-86500);
}


/**
 * Get a cookies data
 */
function get_cookie($index)
{
	return isset($_COOKIE[$index])? clean($_COOKIE[$index]) : false;
}