<?php   if ( ! defined("_VALID_")) die("No direct script access");
/**
 * Author class
 * 
 * @author Davidmoreen <davidmoreen@gmail.com>
 * @version 1.0
 */


class Author extends Application {
	
	public $id;				// authors id
	public $display_name;	// name to be displayed inline
	public $name;			// authors full name
	public $email;			// authors email address
	public $phone;			// authors phone number
	public $about;			// author bio
	public $image;			// image of author 
	public $vcard;			// location of vcard
	public $twitter;		// twitter username
	public $codecanyon;		// codecanyon username
	public $skype;			// skype username
	public $website;		// website address
	public $birthday;		// authors birthday
	public $title;			// occupational title
	public $created_at;		// date created
	public $updated_at;		// date last updated
	
	public $exists;
	
	
	function __construct($author = null)
	{
		parent::__construct();
		
		if ($author !== null) {
			$this->initialize($author);
		}
	}
	
	
	/**
	 * Initialize the class
	 */
	public function initialize($author)
	{
		$author_id = (int)$this->author_id($author);
		
		if ($author_id == false)
			return false;
		$this->exists = true;
		
		$query = $this->db->query("SELECT * FROM ".PREFIX."authors WHERE ID = '".sql_clean($author_id)."'");
		
		if ($query->num_rows != 0) {
			$this->_set_vars($query->fetch_assoc());
		}
	}
	
	
	/**
	 * Set the class vars for an author
	 */
	private function _set_vars($info)
	{
		foreach ($info as $key => $value) {
			$this->$key = $value;  // set the class var
		}
		
		$this->image = unserialize($this->image);
	}
	
	
	/**
	 * Authors ID
	 */
	public function author_id($identifier)
	{
		if (is_numeric($identifier))
			return $identifier;
		else
			return $this->get_id_by_display_name($identifier);
	}
	
	
	/**
	 * Get an authors id based on display name
	 */
	public function get_id_by_display_name($name)
	{
		$query = $this->db->query("SELECT ID FROM ".PREFIX."authors WHERE display_name = '".sql_clean($name)."'");
		
		if ($query->num_rows) {
			$query = $query->fetch_assoc();
			return $query['ID'];
		}
		return false;
	}
	
}