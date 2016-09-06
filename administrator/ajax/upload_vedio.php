<?php
require_once("../global.php");
require_once("../authentication.php");
function uploadfile($origin, $dest, $tmp_name)
{
   $fileext = (strpos($origin,'.')===false?'':'.'.substr(strrchr($origin, "."), 1));
   $filename = time().$fileext;
   $fulldest = $dest.$filename;
   if (move_uploaded_file($tmp_name, $fulldest)) return $filename;
   return false;
}
//print_r($_FILES);
//exit;
if (!empty($_FILES['vedio_file']['tmp_name'])){
	$allow_type = array("video/x-flv");
	if(!in_array($_FILES['vedio_file']['type'], $allow_type)){
		echo "<span style='color:#F00'>视频格式错误！</span>";
		exit;
	}
	$path = "../../uploads/vedio/";
	$filename = uploadfile($_FILES['vedio_file']['name'],$path,$_FILES['vedio_file']['tmp_name']);
	if(!$filename){
		echo "<span style='color:#F00'>上传视频失败！</span>";
		exit;
	} else {
		if(!empty($_FILES['vedio_thumb']['tmp_name'])){
			$filename_thumb = substr($filename, 0, -4);
			$thumb_Path = $path . "thumbnail";
			$handle = new Upload($_FILES['vedio_thumb']);
			if ($handle->uploaded){
				$handle->image_convert = 'jpg';
				$handle->jpeg_quality = 90;
				$handle->file_src_name_body	= $filename_thumb; // hard name
				$handle->file_auto_rename = false;
				$handle->file_overwrite = true;
				$handle->image_resize = true;
				$handle->image_x = 400; // size of picture
				$handle->image_y = 400;
				$handle->image_ratio_crop = true;
				//$handle->image_text = 'test';
				//$handle->image_ratio_fill = true;
				//$handle->image_ratio_y = true;
				$handle->file_max_size = '1012000'; // max size
				$handle->Process($thumb_Path);
				$handle->clean();
			}			
		}
		$feed["filename"] = $filename;
		if(!empty($filename_thumb)){
			$feed["thumbnail"] = $filename_thumb . ".jpg";
		}
		foreach($_POST as $k=>$v){
			if($v != ""){
				$feed[$k] = $v;	
			}
		}
		$sql = $idb->query_insert($feed, "f_vedio");
		if($idb->query_ex($sql)){
			echo "success";
			exit;
		} else {
			echo "<span style='color:#F00'>视频添加失败！</span>";
			exit;
		}
	}
} else {
	echo "<span style='color:#F00'>未上传视频！</span>";
	exit;
}
?>
