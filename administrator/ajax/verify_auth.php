<?php
require_once("../global.php");
foreach($_POST as $k=>$v){
	if($v == ""){
		echo "empty";
		exit;
	} else if($k == "password"){
		$feed[$k] = md5($v);	
	} else {
		$feed[$k] = $v;
	}
}
if($feed["verify_code"]!=strtolower($_COOKIE["verify_code"])){
	echo "code_error";
	exit;
}
$sql = "SELECT * FROM f_account WHERE username = '" . $feed["username"] . "' AND password = '" . $feed["password"] . "' AND disable = 0 LIMIT 1";
$row_account = get_rows($sql);
if($row_account == "nothing"){
	echo "fail";
	exit;
} else {
	echo "success";
	$_SESSION["authentication"] = true;
	$_SESSION["username"] = $row_account["username"];
}
?>