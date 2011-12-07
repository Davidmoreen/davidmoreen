<?php   if ( ! defined("_VALID_")) die("No direct script access");
/**
 * Post class
 * 
 * @author Davidmoreen <davidmoreen@gmail.com>
 * @version 1.0
 */


class Post extends Application {
	
	public $id;
	public $author;
	public $category;
	public $title;
	public $excerpt;
	public $content;
	public $meta_desc;
	public $meta_keywords;
	public $permalink;
	public $draft;
	public $created_at;
	public $updated_at;
	
	private $_cat;
	
	
	function __construct($post = array())
	{
		if (count($post) > 0) {
			$this->initialize($post);
		}
	}
	
	
	/**
	 * Initialize the class
	 */
	public function initialize($args)
	{
		require_once 'category.lib.php';
		$this->_cat = new Category();
		
		$this->set_vars($args);
	}
	
	
	/**
	 * Set class vars for post
	 */
	public function set_vars($args)
	{
		foreach ($args as $key => $value) {
			$key = lc(str_replace("post_", "", trim($key)));
			$this->$key = $value;
		}
		
		$this->category = element("name", $this->_cat->get_cat($this->category));
	}
	
	
	/**
	 * Post date formatted
	 */
	public function date($format)
	{
		$date = strtotime($this->created_at);
		return date($format, $date);
	}
	
	
	/**
	 * Validate if post has an excerpt
	 */
	public function excerpt()
	{
		return ( ! empty($this->excerpt))? $this->excerpt : truncate_word($this->content, 200);
	}
	
	
	/**
	 * Array of meta keywords
	 */
	public function keywords_array()
	{
		return array_map("trim", explode(",", $this->meta_keywords));
	}
	
}