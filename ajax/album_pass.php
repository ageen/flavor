<?php
require_once("../global.php");
if (get_magic_quotes_gpc()){
	$_POST = array_map('stripslashes_deep', $_POST);
}
if(isset($_POST["id"])){
	$id=$_POST["id"];	
}else{
	echo "error";	
}
if(isset($_POST["password"])){
	$password=md5($_POST["password"]);	
}else{
	echo "error";
}
$sql = "SELECT id FROM f_album WHERE id = $id AND password = '" . $password . "' AND public = 0";
$num = get_num($sql);
if($num == 1){
	$_SESSION["auth_album"][] = $id;
	echo "success";
} else {
	echo "fail";
}