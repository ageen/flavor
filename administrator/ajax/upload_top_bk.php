<?php
require_once("../global.php");
require_once("../authentication.php");
$sql = "SELECT top_background FROM f_config WHERE id = 100";
$row_config = get_rows($sql);
if($row_config["top_background"] == ""){
	$filename = time();
	$is_new = true;
} else {
	$filename = substr($row_config["top_background"], 0, -4);
}
if (!empty($_FILES['bk_photo']['tmp_name'])){
	$tempFile = $_FILES['bk_photo']['tmp_name'];
	$targetPath = '../../uploads/background';
	$handle = new Upload($_FILES['bk_photo']);
	if ($handle->uploaded){
		$handle->image_convert = 'jpg';
		$handle->file_src_name_body	= $filename; // hard name
		$handle->file_auto_rename = false;
		$handle->jpeg_quality = 100;
		$handle->file_overwrite = true;
		$handle->image_resize = true;
		$handle->image_x = 830; // size of picture
		$handle->image_y = 100;
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
	if(isset($is_new)&&$is_new == true){
		$feed["top_background"] = $filename . ".jpg";
		$sql = $idb->query_update($feed, "f_config", "id=100");
		if(!$idb->query_ex($sql)){
			echo "error";
			exit;
		}
	}
} else {
	echo "empty";
	exit;
}
?>
<img src="../uploads/background/<?php echo $filename . ".jpg";?>" />