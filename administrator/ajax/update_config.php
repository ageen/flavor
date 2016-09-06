<?php
require_once("../global.php");
require_once("../authentication.php");
if(isset($_GET["mode"])){
	$mode=$_GET["mode"];
	unset($_GET["mode"]);
}else{
	bm_die("参数不正确！");
}
switch($mode):
	case "webpage_title_suffix":
		if($_POST["webpage_title_suffix"] == ""){
			echo "empty";
			exit;
		}
		$sql = $idb->query_update($_POST, "f_config", "id=100");
		if($idb->query_ex($sql)){
			echo "success";
			exit;
		} else {
			echo "fail";
			exit;
		}
		break;

	case "leave_username":
		if($_POST["leave_username"] == ""){
			echo "empty";
			exit;
		}
		$sql = $idb->query_update($_POST, "f_config", "id=100");
		if($idb->query_ex($sql)){
			echo "success";
			exit;
		} else {
			echo "fail";
			exit;
		}
		break;
		
	case "reply_username":
		if($_POST["reply_username"] == ""){
			echo "empty";
			exit;
		}
		$sql = $idb->query_update($_POST, "f_config", "id=100");
		if($idb->query_ex($sql)){
			echo "success";
			exit;
		} else {
			echo "fail";
			exit;
		}
		break;
		
	case "index_title":
		if($_POST["index_title"] == ""){
			echo "empty";
			exit;
		}
		$sql = $idb->query_update($_POST, "f_config", "id=100");
		if($idb->query_ex($sql)){
			echo "success";
			exit;
		} else {
			echo "fail";
			exit;
		}
		break;
		
	case "theme_color":
		if($_POST["theme_color"] == ""){
			echo "empty";
			exit;
		}
		$sql = $idb->query_update($_POST, "f_config", "id=100");
		if($idb->query_ex($sql)){
			echo "success";
			exit;
		} else {
			echo "fail";
			exit;
		}
		break;
		
	case "banner_effect":
		if($_POST["banner_effect"] == ""){
			echo "empty";
			exit;
		}
		$sql = $idb->query_update($_POST, "f_config", "id=100");
		if($idb->query_ex($sql)){
			echo "success";
			exit;
		} else {
			echo "fail";
			exit;
		}
		break;
		
	default:
		echo "nothing";
		break;
endswitch;
?>