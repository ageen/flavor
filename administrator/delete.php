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
	case "article":
		$sql = $idb->query_delete($id, "f_article");
		if($idb->query_ex($sql)){
			$sql = "DELETE FROM f_article_comment WHERE article_id = $id";
			if($idb->query_ex($sql)){
				showinfo("删除成功！", "view.php?mode=article");
			} else {
				bm_die(print_error());
			}
		} else {
			bm_die(print_error());
		}
		break;
		
	case "article_comment":
		$sql = $idb->query_delete($id, "f_article_comment");
		if($idb->query_ex($sql)){
			showinfo("删除成功！", "back");
		} else {
			bm_die(print_error());
		}
		break;
		
	case "link":
		$sql = "SELECT filename FROM f_link WHERE id = $id LIMIT 1";
		$row_link = get_rows($sql);
		$file = "../uploads/logo/" . $row_link["filename"];
		if(file_exists($file)){
			unlink($file);
		}
		$sql = $idb->query_delete($id, "f_link");
		if($idb->query_ex($sql)){
			showinfo("删除成功！", "view.php?mode=link");
		} else {
			bm_die($idb->print_error());
		}
		break;

	case "album":
		$sql = "SELECT filename FROM f_album WHERE id = $id LIMIT 1";
		$row_album = get_rows($sql);
		$file = "../uploads/album/" . $row_album["filename"];
		if(file_exists($file)){
			unlink($file);
		}
		$sql = "SELECT filename FROM f_photo WHERE album_id = $id";
		$row_photo_files = get_rows($sql, "array");
		if($row_photo_files != "nothing"){
			foreach($row_photo_files as $k=>$v){
				$orginal = "../uploads/photo/" . $v["filename"];
				if(file_exists($orginal)){
					unlink($orginal);
				}
				$thumb = "../uploads/photo/thumbnail/" . $v["filename"];
				if(file_exists($thumb)){
					unlink($thumb);
				}
			}
			$sql = "DELETE FROM f_photo WHERE album_id = $id";
			if(!$idb->query_ex($sql)){
				bm_die($idb->print_error());	
			}
		}
		$sql = $idb->query_delete($id, "f_album");
		if($idb->query_ex($sql)){
			showinfo("删除成功！", "view.php?mode=album");
		} else {
			bm_die($idb->print_error());
		}
		break;
		
	case "photo":
		$sql = "SELECT filename FROM f_photo WHERE id = $id LIMIT 1";
		$row_photo = get_rows($sql);
		$origin = "../uploads/photo/" . $row_photo["filename"];
		$thumb = "../uploads/photo/thumbnail/" . $row_photo["filename"];
		if(file_exists($origin)){
			unlink($origin);
		}
		if(file_exists($thumb)){
			unlink($thumb);
		}
		$sql = $idb->query_delete($id, "f_photo");
		if($idb->query_ex($sql)){
			showinfo("删除成功！", "view.php?mode=photo");
		} else {
			bm_die($idb->print_error());
		}
		break;

	case "q_photo":
		$sql = "SELECT filename FROM q_photo WHERE id = $id LIMIT 1";
		$row_photo = get_rows($sql);
		$origin = "../quanfeng/uploads/photo/" . $row_photo["filename"];
		$thumb = "../quanfeng/uploads/photo/thumbnail/" . $row_photo["filename"];
		if(file_exists($origin)){
			unlink($origin);
		}
		if(file_exists($thumb)){
			unlink($thumb);
		}
		$sql = $idb->query_delete($id, "q_photo");
		if($idb->query_ex($sql)){
			showinfo("删除成功！", "view.php?mode=q_photo");
		} else {
			bm_die($idb->print_error());
		}
		break;
		
	case "photo_comment":
		$sql = $idb->query_delete($id, "f_photo_comment");
		if($idb->query_ex($sql)){
			showinfo("删除成功！", "back");
		} else {
			bm_die(print_error());
		}
		break;
		
	case "banner":
		$sql = "SELECT filename FROM f_banner WHERE id = $id LIMIT 1";
		$row_banner = get_rows($sql);
		$origin = "../uploads/banner/" . $row_banner["filename"];
		$thumb = "../uploads/banner/thumbnail/" . $row_banner["filename"];
		if(file_exists($origin)){
			unlink($origin);
		}
		if(file_exists($thumb)){
			unlink($thumb);
		}
		$sql = $idb->query_delete($id, "f_banner");
		if($idb->query_ex($sql)){
			showinfo("删除成功！", "view.php?mode=banner");
		} else {
			bm_die($idb->print_error());
		}
		break;
		
	case "vedio":
		$sql = "SELECT filename,thumbnail FROM f_vedio WHERE id = $id LIMIT 1";
		$row_vedio = get_rows($sql);
		$origin = "../uploads/vedio/" . $row_vedio["filename"];
		if(file_exists($origin)){
			unlink($origin);
		}
		if(!empty($row_vedio["thumbnail"])){
			$thumb = "../uploads/vedio/thumbnail/" . $row_vedio["thumbnail"];	
			if(file_exists($thumb)){
				unlink($thumb);
			}
		}
		$sql = $idb->query_delete($id, "f_vedio");
		if($idb->query_ex($sql)){
			showinfo("删除成功！", "view.php?mode=vedio");
		} else {
			bm_die($idb->print_error());
		}
		break;
		
	case "vedio_comment":
		$sql = $idb->query_delete($id, "f_vedio_comment");
		if($idb->query_ex($sql)){
			showinfo("删除成功！", "back");
		} else {
			bm_die(print_error());
		}
		break;
		
	case "messages":
		$sql = $idb->query_delete($id, "f_messages");
		if($idb->query_ex($sql)){
			$sql = "DELETE FROM f_messages WHERE reply = 1 AND reply_id = $id";
			if($idb->query_ex($sql)){
				showinfo("删除成功！", "back");	
			} else {
				bm_die(print_error());
			}
		} else {
			bm_die(print_error());	
		}
		break;

        case "p_message":
                $sql = $idb->query_delete($id, "q_message");
                if($idb->query_ex($sql)){
                        showinfo("删除成功！", "back");
                } else {
                        bm_die(print_error());
                }
                break;

		
	case "account":
		$sql = "SELECT id FROM f_account";
		$num = get_num($sql);
		if($num == 1){
			showinfo("此为最后一个帐号，无法删除！","back");	
		}
		$sql = $idb->query_delete($id, "f_account");
		if($idb->query_ex($sql)){
			showinfo("删除成功！", "back");
		} else {
			bm_die(print_error());	
		}
		break;
		
	default:
		bm_die("参数错误！");
		break;
endswitch;
?>
