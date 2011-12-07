<?php   if ( ! defined("_VALID_")) die("No direct script access");
/**
 * Configuration
 * 
 * @author Davidmoreen <davidmoreen@gmail.com>
 * @version 1.0
 */

$config = array();

// It is very important that the base_url be changed accordingly
$config['base_url'] = "http://davidmoreen.com/davidmoreen/";  // with a trailing slash
$base_url           = &$config['base_url'];

$config['app_name']    = "Davidmoreen";

$config['site_author']      = "";
$config['copyright_date']   = date("Y");
$config['copyright_holder'] = "";
$config['site_description'] = "";
$config['site_keywords']    = array();


$config['home_post'] = 3;  // max # of posts on home page


// mailer settings
$config['mail_method'] = "smtp";  // smtp/mail/sendmail
$config['smtp_encrypt'] = "ssl";
$config['smtp_host'] = "";
$config['smtp_port'] = 465;
$config['smtp_user'] = "";
$config['smtp_pass'] = "";


// The prefix for database tables and sessions
define("PREFIX", "", true);
define("COOKIEHASH", "");  // random 32 character alpha-num string


define("DM_AID", 1);  // author ID for davidmoreen (me) hence DM