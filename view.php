<?php
require_once("global.php");
if(isset($_GET["mode"])){
	$mode=$_GET["mode"];		
}else{
	bm_die("参数不正确！");
}
$pagestart = 0;
$pagelimit = 8;

switch($mode):
	case "article":
		$sql = "SELECT * FROM f_article WHERE draft = 0 ORDER BY publish_time DESC";
		//	分页
		$page_string = "";
		$num_info = get_num($sql);
		if ($num_info >= 1){
		$idb->query_ex($sql);
		$page_string = paginate($idb->conn, $pagelimit);
		if (isset($_GET['page'])&&(is_numeric($_GET["page"]))) {
			$page = $_GET['page'];
				$pagestart = $pagelimit*($page-1);
				$sql .= " limit $pagestart, $pagelimit";
			} else {
				$sql .= " limit 0, $pagelimit";
			}
		}
		$row_articles = get_rows($sql, "array");
		require_once(TEMPATH."/list_article.php");
		break;

	case "article_comment":
		if(isset($_GET["id"])&&is_numeric($_GET["id"])){
			$id=htmlentities($_GET["id"]);
		}else{
			bm_die("参数错误！");
		}
		$sql = "SELECT * FROM f_article WHERE id = $id AND draft = 0 AND comment = 1";
		if(get_num($sql) != 1){
			bm_die("参数错误！");
		}
		$sql = "SELECT * FROM f_article_comment WHERE article_id = $id ORDER BY publish_time DESC";
		//	分页
		$page_string = "";
		$pagelimit = 16;
		$num_info = get_num($sql);
		if ($num_info >= 1){
		$idb->query_ex($sql);
		$page_string = paginate($idb->conn, $pagelimit);
		if (isset($_GET['page'])&&(is_numeric($_GET["page"]))) {
			$page = $_GET['page'];
				$pagestart = $pagelimit*($page-1);
				$sql .= " limit $pagestart, $pagelimit";
			} else {
				$sql .= " limit 0, $pagelimit";
			}
		}
		$row_article_comments = get_rows($sql, "array");
		$sql = "SELECT * FROM f_article WHERE id = $id";
		$row_article = get_rows($sql);
		if($row_article == "nothing"){
			bm_die("参数错误！");	
		}
		require_once(TEMPATH."view_article_comment.php");
		break;
		
	case "album":
		$sql = "SELECT * FROM f_album ORDER BY album_order ASC";
		//	分页
		$page_string = "";
		$num_info = get_num($sql);
		if ($num_info >= 1){
		$idb->query_ex($sql);
		$page_string = paginate($idb->conn, $pagelimit);
		if (isset($_GET['page'])&&(is_numeric($_GET["page"]))) {
			$page = $_GET['page'];
				$pagestart = $pagelimit*($page-1);
				$sql .= " limit $pagestart, $pagelimit";
			} else {
				$sql .= " limit 0, $pagelimit";
			}
		}
		$row_albums = get_rows($sql, "array");
		require_once(TEMPATH."list_album.php");
		break;

	case "photo":
		if(isset($_GET["id"])&&is_numeric($_GET["id"])){
			$id=htmlentities($_GET["id"]);
		} else {
			bm_die("参数错误！");
		}
		if(isset($_SESSION["auth_album"])&&in_array($id, $_SESSION["auth_album"])){
			$sql = "SELECT * FROM f_album WHERE id = $id";
			$row_album = get_rows($sql);
			if($row_album == "nothing"){
				bm_die("参数错误！");
			}
			$sql = "SELECT * FROM f_photo WHERE album_id = $id ORDER BY publish_time DESC";
		} else {
			$sql = "SELECT * FROM f_album WHERE id = $id";
			$row_album = get_rows($sql);
			if($row_album == "nothing"){
				bm_die("参数错误！");
			} else {
				if($row_album["public"] == 0){
					bm_die("无权限访问！");
				} else {
					$sql = "SELECT * FROM f_photo WHERE album_id = $id ORDER BY publish_time DESC";
				}
			}
		}
		//	分页
		$pagelimit = 16;
		$page_string = "";
		$num_info = get_num($sql);
		if ($num_info >= 1){
		$idb->query_ex($sql);
		$page_string = paginate($idb->conn, $pagelimit);
		if (isset($_GET['page'])&&is_numeric($_GET['page'])) {
			$page = $_GET['page'];
				$pagestart = $pagelimit*($page-1);
				$sql .= " limit $pagestart, $pagelimit";
			} else {
				$sql .= " limit 0, $pagelimit";
			}
		}
		$row_photos = get_rows($sql, "array");
		require_once(TEMPATH."list_photo.php");
		break;
		
	case "photo_comment":
		if(isset($_GET["id"])&&is_numeric($_GET["id"])){
			$id=$_GET["id"];
		}else{
			bm_die("参数错误！");
		}
		$sql = "SELECT id,title,album_id FROM f_photo WHERE id = $id AND comment = 1 LIMIT 1";
		$row_photo = get_rows($sql);
		if($row_photo == "nothing"){
			bm_die("参数错误！");	
		}
		if(isset($_SESSION["auth_album"])&&in_array($row_photo["album_id"], $_SESSION["auth_album"])){
			$sql = "SELECT * FROM f_album WHERE id = " . $row_photo["album_id"];
			$row_album = get_rows($sql);
			$sql = "SELECT * FROM f_photo_comment WHERE photo_id = $id ORDER BY publish_time DESC";
		} else {
			$sql = "SELECT * FROM f_album WHERE id = " . $row_photo["album_id"];
			$row_album = get_rows($sql);
			if($row_album == "nothing"){
				bm_die("参数错误！");
			} else {
				if($row_album["public"] == 0){
					bm_die("无权限访问！");
				} else {
					$sql = "SELECT * FROM f_photo_comment WHERE photo_id = $id ORDER BY publish_time DESC";
				}
			}
		}
		
		//	分页
		$page_string = "";
		$pagelimit = 16;
		$num_info = get_num($sql);
		if ($num_info >= 1){
		$idb->query_ex($sql);
		$page_string = paginate($idb->conn, $pagelimit);
		if (isset($_GET['page'])&&is_numeric($_GET['page'])) {
			$page = $_GET['page'];
				$pagestart = $pagelimit*($page-1);
				$sql .= " limit $pagestart, $pagelimit";
			} else {
				$sql .= " limit 0, $pagelimit";
			}
		}
		$row_photo_comments = get_rows($sql, "array");
		require_once(TEMPATH."view_photo_comment.php");
		break;
		
	case "vedio":
		$sql = "SELECT * FROM f_vedio WHERE public = 1 ORDER BY publish_time DESC";
		//	分页
		$page_string = "";
		$num_info = get_num($sql);
		if ($num_info >= 1){
		$idb->query_ex($sql);
		$page_string = paginate($idb->conn, $pagelimit);
		if (isset($_GET['page'])) {
			$page = $_GET['page'];
				$pagestart = $pagelimit*($page-1);
				$sql .= " limit $pagestart, $pagelimit";
			} else {
				$sql .= " limit 0, $pagelimit";
			}
		}
		$row_vedios = get_rows($sql, "array");
		require_once(TEMPATH."list_vedio.php");
		break;

	case "vedio_comment":
		if(isset($_GET["id"])&&is_numeric($_GET["id"])){
			$id=$_GET["id"];
		}else{
			bm_die("参数错误！");
		}
		$sql = "SELECT * FROM f_vedio WHERE id = $id AND public = 1 AND comment = 1";
		if(get_num($sql) != 1){
			bm_die("参数错误！");
		}
		$sql = "SELECT * FROM f_vedio_comment WHERE vedio_id = $id ORDER BY publish_time DESC";
		//	分页
		$page_string = "";
		$pagelimit = 16;
		$num_info = get_num($sql);
		if ($num_info >= 1){
		$idb->query_ex($sql);
		$page_string = paginate($idb->conn, $pagelimit);
		if (isset($_GET['page'])&&is_numeric($_GET['page'])) {
			$page = $_GET['page'];
				$pagestart = $pagelimit*($page-1);
				$sql .= " limit $pagestart, $pagelimit";
			} else {
				$sql .= " limit 0, $pagelimit";
			}
		}
		$row_vedio_comments = get_rows($sql, "array");
		$sql = "SELECT * FROM f_vedio WHERE id = $id";
		$row_vedio = get_rows($sql);
		if($row_vedio == "nothing"){
			bm_die("参数错误！");	
		}
		require_once(TEMPATH."view_vedio_comment.php");
		break;
		
	case "messages":
		$sql = "SELECT * FROM f_messages WHERE reply = 0 ORDER BY publish_time DESC";
		//	分页
		$page_string = "";
		$pagelimit = 8;
		$num_info = get_num($sql);
		if ($num_info >= 1){
			$idb->query_ex($sql);
			$page_string = paginate($idb->conn, $pagelimit);
			if (isset($_GET['page'])&&is_numeric($_GET['page'])) {
				$page = $_GET['page'];
				$pagestart = $pagelimit*($page-1);
				$sql .= " limit $pagestart, $pagelimit";
			} else {
				$sql .= " limit 0, $pagelimit";
			}
		}
		$row_messages = get_rows($sql, "array");
		require_once(TEMPATH."view_messages.php");
		break;

	default:
		bm_die("参数错误！");
		break;
endswitch;
?>
