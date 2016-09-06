<?php
require_once("global.php");
require_once("authentication.php");
if(isset($_POST["mode"])){
	$mode=$_POST["mode"];
	unset($_POST["mode"]);
}else{
	bm_die("参数不正确！");
}
switch($mode):
	case "article":
		$sql = $idb->query_insert($_POST,"f_article");
		if($idb->query_ex($sql)){
			showinfo("文章新增成功！", "view.php?mode=article");
		} else {
			bm_die($idb->print_error());
		}
		break;
		
	case "link":
		if (!empty($_FILES['logo']['tmp_name'])){
			$filename = time();
			$tempFile = $_FILES['logo']['tmp_name'];
			$targetPath = '../uploads/logo';
			$handle = new Upload($_FILES['logo']);
			if ($handle->uploaded){
				$handle->image_convert = 'jpg';
				$handle->file_src_name_body	= $filename; // hard name
				$handle->image_resize = true;
				$handle->image_x = 90; // size of picture
				$handle->image_ratio_y = true;
				$handle->file_max_size = '1012000'; // max size
				$handle->Process($targetPath);
				$handle-> Clean();
			}
			$feed["filename"] = $filename.".jpg";
			foreach($_POST as $k=>$v){
				$feed["$k"] = $v;	
			}
			$sql = $idb->query_insert($feed, "f_link");
			if($idb->query_ex($sql)){
				showinfo("新增成功！", "view.php?mode=link");
			} else {
				bm_die($idb->print_error());
			}
		} else {
			showinfo("请选择logo文件！", "back");	
		}
		break;
		
	case "album":
		if(!empty($_FILES['album_photo']['tmp_name'])){
			$filename = time();
			$tempFile = $_FILES['album_photo']['tmp_name'];
			$targetPath = '../uploads/album';
			$handle = new Upload($_FILES['album_photo']);
			if ($handle->uploaded){
				$handle->image_convert = 'jpg';
				$handle->jpeg_quality = 100;
				$handle->file_src_name_body	= $filename; // hard name
				$handle->image_resize = true;
				$handle->image_x = 200; // size of picture
				$handle->image_y = 200;
				$handle->image_ratio_crop = true;
				//$handle->image_text = 'test';
				//$handle->image_ratio_fill = true;
				//$handle->image_ratio_y = true;
				$handle->file_max_size = '1012000'; // max size
				$handle->Process($targetPath);
				if ($handle->processed) {
					$handle->clean();
				} else {
					bm_die($handle->error);
					break;
				}
			}
			$feed["filename"] = $filename.".jpg";
			foreach($_POST as $k=>$v){
				if($v != ""){
					if($k=="password"){
						$feed[$k] = md5($v);
					} else {
						$feed["$k"] = $v;	
					}
				}
			}
			$sql = $idb->query_insert($feed, "f_album");
			if($idb->query_ex($sql)){
				showinfo("新增成功！", "view.php?mode=album");
			} else {
				bm_die($idb->print_error());
			}
		} else {
			showinfo("请选择相册图片！", "back");
		}
		break;
		
	case "photo":
		if(!empty($_FILES['photo']['tmp_name'])){
			$filename = time();
			$tempFile = $_FILES['photo']['tmp_name'];
			$targetPath = '../uploads/photo';
			$handle = new Upload($_FILES['photo']);
			if ($handle->uploaded){
				$handle->image_convert = 'jpg';
				$handle->jpeg_quality = 90;
				$handle->file_src_name_body	= $filename; // hard name
				$handle->image_resize = false;
				//$handle->image_text = 'test';
				//$handle->image_ratio_fill = true;
				//$handle->image_ratio_y = true;
				$handle->file_max_size = '1012000'; // max size
				$handle->Process($targetPath);
				if (!$handle->processed) {
					bm_die($handle->error);
					break;
				}
				
				$handle->image_convert = 'jpg';
				$handle->jpeg_quality = 90;
				$handle->file_src_name_body	= $filename; // hard name
				$handle->image_resize = true;
				$handle->image_x = 205; // size of picture
				$handle->image_y = 205;
				$handle->image_ratio_crop = true;
				//$handle->image_text = 'test';
				//$handle->image_ratio_fill = true;
				//$handle->image_ratio_y = true;
				$handle->file_max_size = '1012000'; // max size
				$handle->Process($targetPath."/thumbnail");
				if ($handle->processed) {
					$handle->clean();
				} else {
					bm_die($handle->error);
					break;
				}
			}
			$feed["filename"] = $filename.".jpg";
			foreach($_POST as $k=>$v){
				if($v != ""){
					$feed["$k"] = $v;
				}
			}
			$sql = $idb->query_insert($feed, "f_photo");
			if($idb->query_ex($sql)){
				showinfo("新增成功！", "view.php?mode=photo");
			} else {
				bm_die($idb->print_error());
			}
		} else {
			showinfo("请选择图片！", "back");
		}
		break;

	case "photo_q":
		if(!empty($_FILES['photo']['tmp_name'])){
			$filename = time();
			$tempFile = $_FILES['photo']['tmp_name'];
			$targetPath = '../quanfeng/uploads/photo';
			$handle = new Upload($_FILES['photo']);
			if ($handle->uploaded){
				$handle->image_convert = 'jpg';
				$handle->jpeg_quality = 90;
				$handle->file_src_name_body	= $filename; // hard name
				$handle->image_resize = false;
				$imginfo=getimagesize($tempFile);
				//$handle->image_text = 'test';
				//$handle->image_ratio_fill = true;
				//$handle->image_ratio_y = true;
				$handle->file_max_size = '1012000'; // max size
				$handle->Process($targetPath);
				if (!$handle->processed) {
					bm_die($handle->error);
					break;
				}
				
				$handle->image_convert = 'jpg';
				$handle->jpeg_quality = 90;
				$handle->file_src_name_body	= $filename; // hard name
				$handle->image_resize = true;
				$handle->image_x = 300; // size of picture
				//$handle->image_y = 205;
				//$handle->image_ratio_crop = false;
				//$handle->image_text = 'test';
				$handle->image_ratio_fill = true;
				$handle->image_ratio_y = true;
				$handle->file_max_size = '1012000'; // max size
				$handle->Process($targetPath."/thumbnail");
				if ($handle->processed) {
					$handle->clean();
				} else {
					bm_die($handle->error);
					break;
				}
			}
			$feed["filename"] = $filename.".jpg";
			foreach($_POST as $k=>$v){
				if($v != ""){
					$feed["$k"] = $v;
				}
			}
			$sql = $idb->query_insert($feed, "q_photo");
			if($idb->query_ex($sql)){
				showinfo("新增成功！", "view.php?mode=q_photo");
			} else {
				bm_die($idb->print_error());
			}
		} else {
			showinfo("请选择图片！", "back");
		}
		break;

	case "banner":
		if(!empty($_FILES['banner_photo']['tmp_name'])){
			$filename = time();
			$tempFile = $_FILES['banner_photo']['tmp_name'];
			$targetPath = '../uploads/banner';
			$handle = new Upload($_FILES['banner_photo']);
			if ($handle->uploaded){
				$handle->image_convert = 'jpg';
				$handle->jpeg_quality = 90;
				$handle->file_src_name_body	= $filename; // hard name
				$handle->image_resize = true;
				$handle->image_x = 810; // size of picture
				$handle->image_y = 446;
				$handle->image_ratio_crop = true;
				$handle->file_max_size = '1012000'; // max size
				$handle->Process($targetPath);
				if (!$handle->processed) {
					bm_die($handle->error);
					break;
				}
				
				$handle->image_convert = 'jpg';
				$handle->jpeg_quality = 90;
				$handle->file_src_name_body	= $filename; // hard name
				$handle->image_resize = true;
				$handle->image_x = 131; // size of picture
				$handle->image_y = 131;
				$handle->image_ratio_crop = true;
				//$handle->image_text = 'test';
				//$handle->image_ratio_fill = true;
				//$handle->image_ratio_y = true;
				$handle->file_max_size = '1012000'; // max size
				$handle->Process($targetPath."/thumbnail");
				if ($handle->processed) {
					$handle->clean();
				} else {
					bm_die($handle->error);
					break;
				}
			}
			$feed["filename"] = $filename.".jpg";
			foreach($_POST as $k=>$v){
				if($v != ""){
					$feed["$k"] = $v;
				}
			}
			$sql = $idb->query_insert($feed, "f_banner");
			if($idb->query_ex($sql)){
				showinfo("新增成功！", "view.php?mode=banner");
			} else {
				bm_die($idb->print_error());
			}
		} else {
			showinfo("请选择图片！", "back");
		}
		break;
		
		case "account":
			foreach($_POST as $k=>$v){
				if($v != ""){
					if($k == "password"){
						$feed["$k"] = md5($v);	
					} else if($k == "username"){
						$sql = "SELECT id FROM f_account WHERE username = '$v'";
						$num = get_num($sql);
						if($num == 1){
							showinfo("用户名重复！", "back");	
						} else {
							$feed["$k"] = $v;
						}
					} else {
						$feed["$k"] = $v;	
					}
				}
			}
			$sql = $idb->query_insert($feed, "f_account");
			if($idb->query_ex($sql)){
				showinfo("新增成功！", "view.php?mode=account");
			} else {
				bm_die($idb->print_error());	
			}
			break;

		default:
			bm_die("参数错误！");
			break;
endswitch;
?>
