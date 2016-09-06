<?php
require_once("../global.php");
require_once("../authentication.php");
if(isset($_POST["id"])){
	$id=$_POST["id"];
}else{
	bm_die("参数不正确！");
}
$sql = "SELECT * FROM f_link WHERE id = $id";
$num = get_num($sql);
if($num==0){
	bm_die("参数错误！");
}
$row_link = get_rows($sql);
if (!empty($_FILES['logo']['tmp_name'])){
	$filename = substr($row_link["filename"], 0, -4);
	$tempFile = $_FILES['logo']['tmp_name'];
	$targetPath = '../../uploads/logo';
	$handle = new Upload($_FILES['logo']);
	if ($handle->uploaded){
		$handle->image_convert = 'jpg';
		$handle->file_src_name_body	= $filename; // hard name
		$handle->file_auto_rename = false;
		$handle->file_overwrite = true;
		$handle->image_resize = true;
		$handle->image_x = 90; // size of picture
		$handle->image_ratio_y = true;
		$handle->file_max_size = '1012000'; // max size
		$handle->Process($targetPath);
		if ($handle->processed) {
			$handle->clean();
		} else {
			echo $handle->error;
			exit;
		}
	}
}
?>
<img src="../uploads/logo/<?php echo $row_link["filename"];?>" />