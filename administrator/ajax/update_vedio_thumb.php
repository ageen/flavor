<?php
require_once("../global.php");
require_once("../authentication.php");
if(isset($_POST["id"])){
	$id=$_POST["id"];
}else{
	bm_die("参数不正确！");
}
$sql = "SELECT * FROM f_vedio WHERE id = $id";
$num = get_num($sql);
if($num==0){
	bm_die("参数错误！");
}
$row_vedio = get_rows($sql);
if (!empty($_FILES['thumb']['tmp_name'])){
	$is_new = false;
	if($row_vedio["thumbnail"] == ""){
		$thumbnail = time();
		$is_new = true;
	} else {
		$thumbnail = substr($row_vedio["thumbnail"], 0, -4);	
	}
	$tempFile = $_FILES['thumb']['tmp_name'];
	$targetPath = '../../uploads/vedio/thumbnail/';
	$handle = new Upload($_FILES['thumb']);
	if ($handle->uploaded){
		$handle->image_convert = 'jpg';
		$handle->file_src_name_body	= $thumbnail; // hard name
		$handle->file_auto_rename = false;
		$handle->file_overwrite = true;
		$handle->image_resize = true;
		$handle->image_x = 400; // size of picture
		$handle->image_y = 400;
		$handle->image_ratio_crop = true;
		$handle->file_max_size = '1012000'; // max size
		$handle->Process($targetPath);
		if ($handle->processed) {
			$handle->clean();
		} else {
			echo $handle->error;
			exit;
		}
	}
	$thumbnail = $thumbnail.".jpg";
	if($is_new){
		$sql = "UPDATE f_vedio SET thumbnail = '" . $thumbnail ."' WHERE id = $id";
		if(!$idb->query_ex($sql)){
			bm_die($idb->print_error());	
		}
	}
}
?>
<img src="../uploads/vedio/thumbnail/<?php echo $thumbnail;?>" height="200" width="200" />