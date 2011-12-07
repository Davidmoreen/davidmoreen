<?php   if ( ! defined("_VALID_")) die("No direct script access");
/**
 * Post class
 * 
 * @author Davidmoreen <davidmoreen@gmail.com>
 * @version 1.0
 */


class Category extends Application {
	
	private $_cache;
	
	
	/**
	 * Get a category
	 */
	public function get_cat($id)
	{
		if (isset($this->_cache[$id]))
			return $this->_cache[$id];
		
		$query = $this->db->query(where_query_str("categories", "*", array("ID" => $id)));
		
		if ($query->num_rows == 1) {
			$this->_cache[$id] = $this->raw_db->result_array($query);
			return @$this->_cache[$id][0];
		}
		
		return null;
	}
	
}