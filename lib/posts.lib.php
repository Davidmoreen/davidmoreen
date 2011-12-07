<?php   if ( ! defined("_VALID_")) die("No direct script access");
/**
 * Posts class
 * 
 * @author Davidmoreen <davidmoreen@gmail.com>
 * @version 1.0
 */


class Posts extends Application {
	
	private $_order_by		= "created_at";
	private $_list_order	= "DESC";
	public  $num_rows;
	public  $posts_count;
	
	/**
	 * Query for posts
	 */
	public function get_posts($start, $limit, $conditions = array())
	{
		if (count($conditions) > 0) {
			$query = where_query_str("posts", "*", $conditions);
		}
		else {
			$query = "SELECT * FROM ".PREFIX."posts";
		}
		
		$query .= " ORDER BY ".$this->_order_by." ".$this->_list_order." LIMIT $start,$limit";
		
		$query = $this->db->query($query);
		
		if ($query->num_rows) {
			$this->num_rows[] .= $query->num_rows;
			return $this->raw_db->result_array($query);
		}
		
		return false;
	}
	
	
	/**
	 * Are there any posts
	 */
	public function have_posts($conditions = array())
	{
	if (count($conditions) > 0) {
			$query = where_query_str("posts", "*", $conditions);
		}
		else {
			$query = "SELECT * FROM ".PREFIX."posts";
		}
		$query .= " LIMIT 0,1";
		$query = $this->db->query($query);
		
		return (bool)($query->num_rows);
				
	}
	
	
	/**
	 * Total count of all posts
	 */
	public function post_count()
	{
		if ($this->posts_count > 0)
			return $this->posts_count;
		
		$query = $this->db->query("SELECT * FROM ".PREFIX."posts");
		
		$this->posts_count = $query->num_rows;
		return $this->posts_count;
	}
	
	
	/**
	 * Post on homepage
	 */
	public function home_post()
	{
		if ($this->config['home_post'] !== null)
			return $this->config['home_post'];
		else {
			$query = $this->db->query("SELECT MAX(ID) as max_id FROM ".PREFIX."posts");
			$query = $query->fetch_assoc();
			return $query['max_id'];
		}
	}
	
	
	/**
	 * Class accessors
	 */
	public function set_order_by($x)
	{
		$this->_order_by = $x;
	}
	
	
	public function set_list_order($x)
	{
		$this->_list_order = $x;
	}
	
}