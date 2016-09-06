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
	if (get_magic_quotes_gpc()) {
		$string = stripslashes($string);	
	}
	if (version_compare(phpversion(),"4.3.0") == "-1"){
		return mysql_escape_string($string);
	} else {
		return mysql_real_escape_string($string);	
	}
}

//	Preventing HTML Injection
function mysql_entities_fix_string($string){
	return htmlentities(mysql_fix_string($string));	
}

function sanitizeString($string){
	$string = strip_tags($string);
	$string = htmlentities($string);
	$string = stripslashes($string);
	return mysql_real_escape_string($string);
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