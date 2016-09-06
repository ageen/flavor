<?php
//error_reporting(0);	// Turn off all the error reporting
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
define('DCPATH', dirname(strtr(__FILE__,'\\','/'))."/");	// Return the root directory with divison slash
//function_exists('date_default_timezone_set')&&date_default_timezone_set('Etc/GMT+8');	//	prevent PHP 5.1.x error reporting when use time function
function_exists('date_default_timezone_set')&&date_default_timezone_set('Asia/Shanghai');
//	unset global variate
unset($_ENV,$HTTP_ENV_VARS,$_REQUEST,$HTTP_POST_VARS,$HTTP_GET_VARS,$HTTP_POST_FILES,$HTTP_COOKIE_VARS,$HTTP_SESSION_VARS,$HTTP_SERVER_VARS);
unset($GLOBALS['_ENV'],$GLOBALS['HTTP_ENV_VARS'],$GLOBALS['_REQUEST'],$GLOBALS['HTTP_POST_VARS'],$GLOBALS['HTTP_GET_VARS'],$GLOBALS['HTTP_POST_FILES'],$GLOBALS['HTTP_COOKIE_VARS'],$GLOBALS['HTTP_SESSION_VARS'],$GLOBALS['HTTP_SERVER_VARS']);
session_start();
header("Content-type:text/html;charset=utf-8");
require(DCPATH.'include/config.php');
require(DCPATH.'include/class/MySQL-PDO/Db.class.php');
require(DCPATH.'include/functions.php');
require(DCPATH.'include/fence.php');
//$_GET = add_magic_quotes($_GET);
//$_POST = add_magic_quotes($_POST);
//$_COOKIE = add_magic_quotes($_COOKIE);
?>
