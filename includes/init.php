<?php   if (preg_match('/init\.php/i', $_SERVER['REQUEST_URI'])) die('No direct script access');
/**
 * Set up the application to run
 */
	
session_start();
ob_start();

ini_set('display_error', 1);
error_reporting(E_ALL ^ E_NOTICE);

define('_VALID_', true, true);

if (!isset($prepended_path))
	$prepended_path = '';

/**
 * Require all files needed to make this puppy work
 */
require_once $prepended_path.'config/config.php';
require_once $prepended_path.'includes/functions.php';
require_once $prepended_path.'config/db/connect.php';
require_once $prepended_path.'includes/paths.php';

// ----------------------------------------------------------

require_once $prepended_path.'lib/database.lib.php';
$Raw_db = new Database($database_connection);
$Db     = $Raw_db->instance();

// ----------------------------------------------------------

require_once 'includes/helpers/cookie.php';
require_once 'includes/helpers/database.php';

// ----------------------------------------------------------

require_once $prepended_path.'lib/application.lib.php';
require_once $prepended_path.'lib/config.lib.php';
$Config = new Config();

require_once $prepended_path.'lib/data.lib.php';
$Data = new Data();

require_once $prepended_path.'lib/template.lib.php';
$Template = new Template();

require_once $prepended_path.'lib/uri.lib.php';
$Uri = @new Uri(@$_SERVER['PATH_INFO']);

// ----------------------------------------------------------

require_once 'lib/author.lib.php';

$Me = new Author(DM_AID);