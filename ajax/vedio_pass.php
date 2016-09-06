<?php
require_once("../global.php");
if (get_magic_quotes_gpc()){
	$_POST = array_map('stripslashes_deep', $_POST);
}
if(isset($_POST["id"])){
	$id=$_POST["id"];	
}else{
	echo "error";
	exit;
}
if(isset($_POST["locked_password"])){
	$password=md5($_POST["locked_password"]);	
}else{
	echo "error";
	exit;
}
$sql = "SELECT id FROM f_vedio WHERE id = $id AND password = '" . $password . "'";
$num = get_num($sql);
if($num == 1){
	$_SESSION["unlock"][] = $id;
	echo "success";
	exit;
} else {
	echo "fail";
	exit;
}