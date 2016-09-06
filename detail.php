<?php
require_once("global.php");
if(isset($_GET["mode"])){
	$mode=$_GET["mode"];		
}else{
	bm_die("参数不正确！");
}
if(isset($_GET["id"])&&(is_numeric($_GET["id"]))){
	$id = $_GET["id"];		
}else{
	bm_die("参数不正确");
}
switch($mode):
	case "article":
		$sql = "SELECT * FROM f_article WHERE id = $id AND draft = 0";
		$row_article = get_rows($sql);
		if($row_article != "nothing"){
			$sql = "SELECT * FROM f_article_comment WHERE article_id = $id ORDER BY publish_time DESC LIMIT 8";
			$row_comments = get_rows($sql, "array");
			$sql = "SELECT * FROM f_article_comment WHERE article_id = $id";
			$comments_num = get_num($sql);
			//previous
			$sql = "SELECT id,title FROM f_article WHERE id>$id AND draft = 0 ORDER BY id ASC LIMIT 1";
			$row_article_pre = get_rows($sql);
			//next
			$sql = "SELECT id,title FROM f_article WHERE id<$id AND draft = 0 ORDER BY id DESC LIMIT 1";
			$row_article_next = get_rows($sql);
		}
		require_once(TEMPATH."detail_article.php");
		break;
		 
	case "photo":
		$sql = "SELECT fp.*, fa.id AS a_id, fa.title AS a_title, fa.public AS is_public FROM f_photo AS fp LEFT JOIN f_album AS fa ON fp.album_id = fa.id WHERE fp.id = $id";
		$row_photo = get_rows($sql);
		if($row_photo == "nothing"){
			bm_die("参数不正确！");
		} else {
			if($row_photo["is_public"]==1){
				$sql = "SELECT * FROM f_photo_comment WHERE photo_id = $id ORDER BY publish_time DESC LIMIT 8";
				$row_comments = get_rows($sql, "array");
				$sql = "SELECT * FROM f_photo_comment WHERE photo_id = $id";
				$comments_num = get_num($sql);
				//previous
				$sql = "SELECT id,title,filename FROM f_photo WHERE id>$id AND album_id = ".$row_photo["album_id"]." ORDER BY id ASC LIMIT 1";
				$row_photo_pre = get_rows($sql);
				//next
				$sql = "SELECT id,title,filename FROM f_photo WHERE id<$id AND album_id = ".$row_photo["album_id"]." ORDER BY id DESC LIMIT 1";
				$row_photo_next = get_rows($sql);
				require_once(TEMPATH."detail_photo.php");
				exit;
			} else {
				if(isset($_SESSION["auth_album"])&&in_array($row_photo["album_id"], $_SESSION["auth_album"])){
					$sql = "SELECT * FROM f_photo_comment WHERE photo_id = $id ORDER BY publish_time DESC LIMIT 8";
					$row_comments = get_rows($sql, "array");
					$sql = "SELECT * FROM f_photo_comment WHERE photo_id = $id";
					$comments_num = get_num($sql);
					//previous
					$sql = "SELECT id,title,filename FROM f_photo WHERE id>$id AND album_id = ".$row_photo["album_id"]." ORDER BY id ASC LIMIT 1";
					$row_photo_pre = get_rows($sql);
					//next
					$sql = "SELECT id,title,filename FROM f_photo WHERE id<$id AND album_id = ".$row_photo["album_id"]." ORDER BY id DESC LIMIT 1";
					$row_photo_next = get_rows($sql);
					require_once(TEMPATH."detail_photo.php");
					exit;
				} else {
					bm_die("无权限查看！");
				}
			}
		}
		break;
		
	case "vedio":
		$sql = "SELECT * FROM f_vedio WHERE id = $id AND public = 1";
		$row_vedio = get_rows($sql);
		if($row_vedio != "nothing"){
			$sql = "SELECT * FROM f_vedio_comment WHERE vedio_id = $id ORDER BY publish_time DESC LIMIT 8";
			$row_comments = get_rows($sql, "array");
			$sql = "SELECT * FROM f_vedio_comment WHERE vedio_id = $id";
			$comments_num = get_num($sql);
			//previous
			$sql = "SELECT id,title FROM f_vedio WHERE id<$id AND public = 1 ORDER BY id DESC LIMIT 1";
			$row_vedio_pre = get_rows($sql);
			//next
			$sql = "SELECT id,title FROM f_vedio WHERE id>$id AND public = 1 ORDER BY id ASC LIMIT 1";
			$row_vedio_next = get_rows($sql);
		}
		require_once(TEMPATH."detail_vedio.php");
		break;
endswitch;
?>
