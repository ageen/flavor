<?php
function salting($string) {
//	$string = mysql_fix_string($string);
//	$string = mysql_entities_fix_string($string);
	$salt1 = "I&love*";
	$salt2 = "world!@";
	$token = md5("$salt1$string$salt2");
	return $token;
}

//	Preventing SQL Injection
function mysql_fix_string($string){
	global $idb;
	if (get_magic_quotes_gpc()) {
		$string = stripslashes($string);	
	}
	return mysqli_real_escape_string($idb->conn, $string);
}

//	Preventing HTML Injection
function mysql_entities_fix_string($string){
	return htmlentities(mysql_fix_string($string));	
}

function sanitizeString($string){
	global $idb;
	$string = strip_tags($string);
	$string = htmlentities($string);
	$string = stripslashes($string);
	return mysqli_real_escape_string($idb->conn,$string);
}

function add_magic_quotes($var){
	if(is_array($var)){
		foreach($var as $k => $v) {
			if (is_array($v)) {
				$var[$k] = add_magic_quotes($v);	
			} else {
				$var[$k] = mysql_fix_string($v);
			}
		}
	} else {
		$var = mysql_fix_string($var);	
	}
	return $var;
}
?>
