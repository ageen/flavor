<?php
require_once("../global.php");
require_once("../authentication.php");
if(isset($_POST["id"])){
	$id=$_POST["id"];
}else{
	bm_die("参数不正确！");
}
$sql = "SELECT filename FROM f_album WHERE id = $id";
$num = get_num($sql);
if($num==0){
	bm_die("参数错误！");
}
$row_album = get_rows($sql);
if(!empty($_FILES['album_photo']['tmp_name'])){
	$filename = substr($row_album["filename"], 0, -4);
	$targetPath = '../../uploads/album';
	$handle = new Upload($_FILES['album_photo']);
	if ($handle->uploaded){
		$handle->image_convert = 'jpg';
		$handle->jpeg_quality = 100;
		$handle->file_src_name_body	= $filename; // hard name
		$handle->file_auto_rename = false;
		$handle->file_overwrite = true;
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
}
?>
<img src="../uploads/album/<?php echo $row_album["filename"];?>" />