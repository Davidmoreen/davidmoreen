<?php   if ( ! defined("_VALID_")) die("No direct script access");
/**
 * User helper
 * 
 * @author Davidmoreen <davidmoreen@gmail.com>
 * @since 1.0
 */


/**
 * Clean a string for sql use
 */
function sql_clean($string, $allowed_tags = "")
{
	global $Db;
	
	return $Db->escape_string(strip_tags(trim($string), $allowed_tags));
}


/**
 * Generate query string with where argument
 */
function where_query_str($table, $select, $args)
{
	$query_str = "SELECT $select FROM ".PREFIX."$table WHERE ";
	$update    = array();
	foreach ($args as $key => $value) {
		$update[] .= "$key='" .sql_clean($value). "'";
	}
	
	return $query_str . implode(" AND ", $update);
}


/**
 * Generate an update query string
 */
function update_query_str($table, $update_args, $where_args)
{
	$query_str = "UPDATE ".PREFIX . $table." SET ";
	$foo = array();
	foreach ($update_args as $key => $value) {
		$foo[] .= "$key='".sql_clean($value)."'";
	}
	
	$query_str .= implode(", ", $foo);
	$foo        = array();
	$query_str .= " WHERE ";
	
	foreach ($where_args as $key1 => $value1) {
		$foo[] .= "$key1='" .sql_clean($value1). "'";
	}
	
	return $query_str . implode(" AND ", $foo);
}


/**
 * Return result array
 */
function result_array($result)
{
	$ary = array();
	while($row = $result->fetch_assoc()) {
		$ary[] .= $row;
	}
	
	return $ary;
}