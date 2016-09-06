<?php
require_once("global.php");
require_once("authentication.php");
if(isset($_GET["mode"])){
	$mode=$_GET["mode"];		
}else{
	bm_die("参数不正确！");
}
if(isset($_GET["id"])){
	$id=$_GET["id"];		
}else{
	bm_die("参数不正确！");
}
switch($mode):
	case "banner":
		$sql = "SELECT * FROM f_banner WHERE id = $id";
		$row_banner = get_rows($sql);
		if($row_banner == "nothing"){
			bm_die("参数不正确！");	
		}
		require_once("templates/modify_banner.php");
		break;

	case "wi":
		require_once("templates/modify_wi.php");
		break;

	case "article":
		$sql = "SELECT * FROM f_article WHERE id = $id";
		$row_article = get_rows($sql);
		if($row_article == "nothing"){
			bm_die("参数不正确！");
		}
		require_once("templates/modify_article.php");
		break;

	case "album":
		$sql = "SELECT * FROM f_album WHERE id = $id";
		$row_album = get_rows($sql);
		if($row_album == "nothing"){
			bm_die("参数不正确！");
		}		
		require_once("templates/modify_album.php");
		break;

	case "photo":
		$sql = "SELECT * FROM f_photo WHERE id = $id";
		$row_photo = get_rows($sql);
		if($row_photo == "nothing"){
			bm_die("参数不正确！");	
		}
		$sql = "SELECT id,title FROM f_album";
		$row_albums = get_rows($sql, "array");
		if($row_albums == "nothing"){
			bm_die("无相册信息！");	
		}
		require_once("templates/modify_photo.php");
		break;

	case "q_photo":
		$sql = "SELECT * FROM q_photo WHERE id = $id";
		$row_photo = get_rows($sql);
		if($row_photo == "nothing"){
			bm_die("参数不正确！");	
		}
		require_once("templates/modify_photo_q.php");
		break;

		
	case "link":
		$sql = "SELECT * FROM f_link WHERE id = $id";
		$row_link = get_rows($sql);
		if($row_link == "nothing"){
			bm_die("参数不正确！");
		}
		require_once("templates/modify_link.php");
		break;
		
	case "vedio":
		$sql = "SELECT * FROM f_vedio WHERE id = $id";
		$row_vedio = get_rows($sql);
		if($row_vedio == "nothing"){
			bm_die("参数不正确！");
		}
		require_once("templates/modify_vedio.php");
		break;
		
	default:
		bm_die("参数不正确！");
		break;
endswitch;
?>
