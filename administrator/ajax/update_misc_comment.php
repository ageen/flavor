<?php
require_once("../global.php");
require_once("../authentication.php");
if(isset($_GET["id"])){
	$id = $_GET["id"];
}
$mode = $_GET["mode"];
$order = $_GET["order"];
switch($mode):
	case "article":
		if($_GET["comment"] == 0){
			$sql = "UPDATE f_article SET comment = 0 WHERE id = $id";
		} elseif($_GET["comment"] == 1) {
			$sql = "UPDATE f_article SET comment = 1 WHERE id = $id";
		} else {
			bm_die("参数错误！");
		}
		if($idb->query_ex($sql)){
			if($_GET["comment"] == 0){
				echo "<div class='f_detail2'><a href='javascript:void(0)' onclick='com_ajax(".$order.",".$id.",1)'>[开启评论]</a></div>";
			}else{
				echo "<div class='f_detail'><a href='javascript:void(0)' onclick='com_ajax(".$order.",".$id.",0)'>[禁止评论]</a></div>";
			}
		} else {
			bm_die($idb->print_error());
		}
		break;
		
	case "photo":
		if($_GET["comment"] == 0){
			$sql = "UPDATE f_photo SET comment = 0 WHERE id = $id";
		} elseif($_GET["comment"] == 1) {
			$sql = "UPDATE f_photo SET comment = 1 WHERE id = $id";
		} else {
			bm_die("参数错误！");
		}
		if($idb->query_ex($sql)){
			if($_GET["comment"] == 0){
				echo "<div class='f_detail2'><a href='javascript:void(0)' onclick='com_ajax(".$order.",".$id.",1)'>[开启评论]</a></div>";
			}else{
				echo "<div class='f_detail'><a href='javascript:void(0)' onclick='com_ajax(".$order.",".$id.",0)'>[禁止评论]</a></div>";
			}
		} else {
			bm_die($idb->print_error());
		}
		break;
		
	case "vedio":
		if($_GET["comment"] == 0){
			$sql = "UPDATE f_vedio SET comment = 0 WHERE id = $id";
		} elseif($_GET["comment"] == 1) {
			$sql = "UPDATE f_vedio SET comment = 1 WHERE id = $id";
		} else {
			bm_die("参数错误！");
		}
		if($idb->query_ex($sql)){
			if($_GET["comment"] == 0){
				echo "<div class='f_detail2'><a href='javascript:void(0)' onclick='com_ajax(".$order.",".$id.",1)'>[开启评论]</a></div>";
			}else{
				echo "<div class='f_detail'><a href='javascript:void(0)' onclick='com_ajax(".$order.",".$id.",0)'>[禁止评论]</a></div>";
			}
		} else {
			bm_die($idb->print_error());
		}
		break;
		
	default:
		echo "参数错误！";
		break;
endswitch;
?>