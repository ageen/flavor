<?php
//error_reporting(0);	// Turn off all the error reporting
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
//function_exists('date_default_timezone_set')&&date_default_timezone_set('Etc/GMT+8');	//	prevent PHP 5.1.x error reporting when use time function
function_exists('date_default_timezone_set')&&date_default_timezone_set('Asia/Shanghai');
define('T_ROOT', dirname(strtr(__FILE__,'\\','/'))."/");	// Return the root directory with divison slash
//	unset global variate
unset($_ENV,$HTTP_ENV_VARS,$_REQUEST,$HTTP_POST_VARS,$HTTP_GET_VARS,$HTTP_POST_FILES,$HTTP_COOKIE_VARS,$HTTP_SESSION_VARS,$HTTP_SERVER_VARS);
unset($GLOBALS['_ENV'],$GLOBALS['HTTP_ENV_VARS'],$GLOBALS['_REQUEST'],$GLOBALS['HTTP_POST_VARS'],$GLOBALS['HTTP_GET_VARS'],$GLOBALS['HTTP_POST_FILES'],$GLOBALS['HTTP_COOKIE_VARS'],$GLOBALS['HTTP_SESSION_VARS'],$GLOBALS['HTTP_SERVER_VARS']);
session_start();
header("Content-type:text/html;charset=utf-8");
require_once(T_ROOT.'include/config.php');
require_once(T_ROOT.'include/class/templite/class.template.php');
require_once(T_ROOT.'include/display.php');
require_once(T_ROOT.'include/class/mysql.php');
require_once(T_ROOT.'include/functions.php');
require_once(T_ROOT.'include/fence.php');
$_GET = add_magic_quotes($_GET);
//$_POST = add_magic_quotes($_POST);
$_COOKIE = add_magic_quotes($_COOKIE);
$sql = "SELECT * FROM f_config LIMIT 1";
$row_config = get_rows($sql);
define("TOP_BACKGROUND", $row_config["top_background"]==""?"templates/images/default_top_back.png":"uploads/background/".$row_config["top_background"]);
define("INDEX_TITLE", $row_config["index_title"]==""?"FLAVOR 2013":$row_config["index_title"]);
define("WEBPAGE_TITLE_SUFFIX", $row_config["webpage_title_suffix"]==""?"STARSHINE, THE WISH IN THE SKY":$row_config["webpage_title_suffix"]);
define("LEAVE_USERNAME", $row_config["leave_username"]==""?"无名":$row_config["leave_username"]);
define("THEME_COLOR", $row_config["theme_color"]==""?"default":$row_config["theme_color"]);
define("BANNER_EFFECT", $row_config["banner_effect"]==""?"none":$row_config["banner_effect"]);
define("TEMPATH","templates/".THEME_COLOR."/");
