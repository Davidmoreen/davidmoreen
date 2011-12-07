<?php   if ( ! defined("_VALID_")) die("No direct script access");
/**
 * Application helpers
 * 
 * @package app name
 */

	
/**
 * Kill the script with style
 */
function _kill($title, $body, $path = "")
{
	$data = @file_get_contents($path."includes/error.html");
	if ($data) {
		$replace = array("PAGE_TITLE", "PAGE_DESCRIPTION", "STYLESHEET_PATH");
		$with = array($title, $body, $path);
		die(str_replace($replace, $with, $data));
	} else {
		die("<center><h1>$title</h1><h2>$body</h2></center>");
	}
}


/**
 * Get a config item
 * 
 * ONLY CONFIG ITEMS THAT ARE HARD CODED
 * THE DATABASE HASN'T BEEN INITATED YET
 */
function config_item($index)
{
	global $config;
	return isset($config[$index])? $config[$index] : false;
}


/**
 * Remove underscores/add spaces
 */
function remove_($string)
{
	return str_replace("_", " ", $string);
}


/**
 * Get a users ip address
 */
function ip_address()
{
	return $_SERVER['REMOTE_ADDR'];
}


/**
 * Obfuscate email address so robots don't bother you
 */
function obfuscate_email($email) {
	$out = "";
	$len = strlen($email);

	for($i = 0; $i < $len; $i++)
		$out .= "&#" . ord($email[$i]) . ";";

	return $out;
}


/**
 * Get element of array
 */
function element($key, $array)
{
	return $array[$key];
}


/**
 * Remove spaces/add underscores
 */
function add_($string)
{
	return str_replace(" ", "_", $string);
}


/**
 * A database friendly date
 */
function db_date() {
	return date("Y-m-d H:i:s");
}


/**
 * Truncate a string
 */
function truncate($string, $max, $ellipsis = "...")
{
	if (strlen($string) >= $max)
		return substr($string, 0, ($max - strlen($eclipse))) . $ellipsis;
	else
		return $string;
}


/**
 * Restrict word count
 */
function truncate_word($string, $limit = 250, $cliff = "...")
{
	preg_match("/^\s*+(?:\S++\s*+){1,".$limit."}/", $string, $matches);
		
	if (strlen($string) == strlen($matches[0]))
		$cliff = "";
	
	return rtrim($matches[0]) . $cliff;
}


/**
 * Supply feedback to a user
 */
function feedback($messages, $type = "error", $style = '')
{
	if (!is_array($messages))
		$messages = array($messages);

	echo '
	<div class="notice ' .(($type == "error")? "warning" : "info"). '" style="' .$style. '">
		<div class="inner_notice">
		<ul>';
	
	foreach ($messages as $message)
		echo "<li>" .$message. "</li>";
	
	echo '
		</ul>
		</div>
	</div>';
}


/**
 * Redirect a user to a page on the site
 */
function redirect($to = '')
{
	$link = config_item("base_url");
	if (substr($to, -1, 1) == '/' || preg_match("/\?/", $to))
		$link .= $to;
	elseif ($to != '')
		$link .= $to.".php";
	header("Location: $link");
}


/**
 * Parse a username
 *  - whether it's lowercase or not
 */
function p_usrnam($username)
{
	return config_item("username_as_lowercase")? lc($username) : $username;
}


/**
 * Redirect to a url
 */
function url_redirect($to)
{
	header("Location: $to");
}


/**
 * sha256 hash
 */
function sha2($string)
{
	return hash("sha256", $string);
}


/**
 * String to lowercase
 */
function lc($str)
{
	return strtolower($str);
}


/**
 * String to uppercase
 */
function uc($str)
{
	return strtoupper($str);
}


/**
 * Send email using swift phpmailer
 */
function sendmail($data) {
	require_once("swift/swift_required.php");
	
	switch ($data['method']) {
		default:
		case "mail":
			$Method = Swift_MailTransport::newInstance();
			break;
		case "sendmail":
			$Method = Swift_SendmailTransport::newInstance($data['sendmail']);
			break;
		case "smtp":
			$Method = Swift_SmtpTransport::newInstance($data['host'], $data['port'])->setEncryption($data['encrypt'])->setUsername($data['user'])->setPassword($data['pass']);
			break;
	}
	
	$Mail = Swift_Mailer::newInstance($Method);

	$Email = Swift_Message::newInstance($data['subject'])
	  ->setFrom($data['from'])
	  ->setTo($data['to'])
	  ->setBody($data['body'], "text/html");
	  
	if ($Mail->send($Email))
		return true;
	
	return false;
}


/**
 * Clean a string
 */
function clean($string, $allowed_tags = "")
{
	return strip_tags(trim($string), $allowed_tags);
}


/**
 * Clean the items that are passed
 */
function clean_args($args)
{
	if (!is_array($args))
		$args = array($args);
	
	foreach ($args as $arg)
		$filtered .= clean($arg);
	
	return $filtered;
}


/**
 * Generate a random string
 */
function randstr($length = 10)
{
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	$string = "";
	
	for ($i=0; $i < $length; $i++) {
		str_shuffle($chars);
		$string .= $chars[mt_rand(0, strlen($chars))];
	}
		
	return $string;
}


/**
 * Make text literally smaller if it is to long
 */
function strshrink($string, $default_size, $max)
{
	$strlen = strlen($string);
	
	if (strlen($string) >= $max) {
		$size = $default_size;
		
		for ($i=0; ($strlen - $max) >= $i; $i += 6) {
			$size -= 1;
		}
		
		return '<div style="display:inline;font-size:' .$size. 'px">' .$string. '</div>';
	}
	
	return $string;
}


/**
 * Make links from strings with web protocols in it
 */
function add_links($string)
{
	$string = preg_match("/((ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?)/", "<a href='\\0' target='_blank'>\\0</a>", $string);
	
	return $string;
}


/**
 * Time ago
 * 
 * http://css-tricks.com/snippets/php/time-ago-function/
 */
function timeago($time)
{
   $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
   $lengths = array("60", "60", "24", "7", "4.35", "12", "10");

   $now = time();

       $difference = $now - $time;
       $tense = "ago";

   for($i = 0; $difference >= $lengths[$i] && $j < count($lengths)-1; $i++) {
       $difference /= $lengths[$i];
   }

   $difference = round($difference);

   if($difference != 1) {
       $periods[$i].= "s";
   }

   return "$difference $periods[$i] ago";
}


/**
 * Encrypt a password
 */
function salt($username, $password)
{
	$salt = "5a#ew445=@=/3!57jd%^wgr{+'+~ew`@`p455w0rd%I2#f^c%6@4d&4+=~`5<//?";
	return sha2($salt . sha1(md5($password) . p_usrnam($username)));
}


/**
 * Make a number shorter
 * If $num is a float it will be rounded to an int
 */
function num_to_short($num)
{
	if (is_float($num))
		$num = round($num);
	
	if ($num >= 1000) {
		$i = 1000;
		while ($num >= $i) {
			$return = ($i/1000). "K";
			
			if ($num > $i)
				$return .= "+";
			
			$i += 1000;
		}
	} else
		$return = $num;
	
	return $return;
}


/**
 * Modify a uris query string
 */
function modify_url($mod) { 
    $url = "http://" .$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; 
    $query = explode("&", $_SERVER['QUERY_STRING']); 
    // modify/delete data 
    foreach($query as $q) { 
        @list($key, $value) = explode("=", $q); 
        if(array_key_exists($key, $mod)) 
        { 
            if($mod[$key]) 
            { 
                $url = preg_replace('/' .$key. '=' .$value. '/', $key. '=' .$mod[$key], $url); 
            } 
            else 
            { 
                $url = preg_replace('/&?'.$key.'='.$value.'/', '', $url); 
            } 
        } 
    } 
    // add new data 
    foreach($mod as $key => $value) { 
        if($value && !preg_match('/' .$key. '=/', $url)) 
        { 
            $url .= '&' .$key. '=' .$value; 
        } 
    }
    
   	for ($i=0; $_SERVER['QUERY_STRING'] == "" && $i != 1; $i++)
    	$url = str_replace("&", "?", $url);
    
    
    return $url; 
}