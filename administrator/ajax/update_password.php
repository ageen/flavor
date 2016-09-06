<?php
require_once("../global.php");
require_once("../authentication.php");
if(isset($_GET["id"])){
	$id = $_GET["id"];	
} else {
	bm_die("参数错误！");	
}
$origin_password = md5($_POST["origin_password"]);
$sql = "SELECT * FROM f_account WHERE id = $id AND password = '" . $origin_password . "'";
$num = get_num($sql);
if($num != 1){
	echo "wrong";
	exit;
}
$feed["password"] = md5($_POST["new_password"]);
$sql = $idb->query_update($feed, "f_account", "id=$id");
if(!$idb->query_ex($sql)){
	echo "fail";
	exit;
} else {
	echo "success";
	exit;
}
?>