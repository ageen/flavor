<?php
require_once("global.php");
require_once("authentication.php");
if(isset($_GET["id"])){
	$id = $_GET["id"];
}
$mode = $_GET["mode"];
$order = $_GET["order"];
switch($mode):
	case "article":
		if($_GET["draft"] == 0){
			$sql = "UPDATE f_article SET draft = 0 WHERE id = $id";
		} elseif($_GET["draft"] == 1) {
			$sql = "UPDATE f_article SET draft = 1 WHERE id = $id";
		} else {
			bm_die("参数错误！");
		}
		if($idb->query_ex($sql)){
			if($_GET["draft"] == 0){
				echo "<div class='f_detail'><a href='javascript:void(0)' onclick='pub_ajax(".$order.",".$id.",1)'>[转为草稿]</a></div>";
			}else{
				echo "<div class='f_detail2'><a href='javascript:void(0)' onclick='pub_ajax(".$order.",".$id.",0)'>[正式发布]</a></div>";
			}
		} else {
			bm_die($idb->print_error());
		}
		break;

	case "vedio":
		if($_GET["public"] == 0){
			$sql = "UPDATE f_vedio SET public = 0 WHERE id = $id";
		} elseif($_GET["public"] == 1) {
			$sql = "UPDATE f_vedio SET public = 1 WHERE id = $id";
		} else {
			bm_die("参数错误！");
		}
		if($idb->query_ex($sql)){
			if($_GET["public"] == 1){
				echo "<div class='f_detail'><a href='javascript:void(0)' onclick='pub_ajax(".$order.",".$id.",0)'>[取消发布]</a></div>";
			}else{
				echo "<div class='f_detail2'><a href='javascript:void(0)' onclick='pub_ajax(".$order.",".$id.",1)'>[发布视频]</a></div>";
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