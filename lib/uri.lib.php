<?php   if ( ! defined("_VALID_")) die("No direct script access");
/**
 * URI library
 * 
 * @author Davidmoreen <davidmoreen@gmail.com>
 * @version 1.0
 */


class Uri {
	
	public $request;
	public $segments;
	public $current_uri;
	public $self_uri;
	
	private $delimiter = '/';
	
	
	/**
	 * $request being the ...index.php/REQUEST/URI
	 */
	public function __construct($request)
	{
		$this->initiate(clean($request));
	}
	
	
	/**
	 * Begin the goodness!!
	 */
	public function initiate($request)
	{
		$this->request     = $request;
		$this->segments    = $this->segments();
		$this->current_uri = $this->set_current_uri();
	}
	
	
	/**
	 * Return all of the segments in the current path
	 */
	public function segments()
	{
		$segments = explode($this->delimiter, $this->request);
		array_shift($segments);  // first segment is empty
		$segments = preg_grep("/^[^ ]+$/", $segments);
		
		return $segments;
	}
	
	
	/**
	 * All of the segments in the uri
	 */
	public function segment_count()
	{
		return count($this->segments);
	}
	
	
	/**
	 * Get a current segment
	 */
	public function segment($index)
	{
		$index = $index - 1;
		if (isset($this->segments[$index]))
			return $this->segments[$index];
		
		return false;
	}
	
	
	/**
	 * Parse the current URI
	 */
	public function set_current_uri()
	{
		$request = $this->request;
	}
	
	
	/**
	 * Set the self uri variable
	 */
	public function set_self_uri($uri)
	{
		$this->self_uri = $uri;
	}
	
	
	/**
	 * Add another section to the uri
	 */
	public function append_to_uri($uri)
	{
		$this->self_uri .= $uri;
	}
	
}