<?php
require_once("../global.php");
require_once("../authentication.php");
if(isset($_GET["id"])){
	$id=$_GET["id"];
}else{
	bm_die("参数不正确！");
}
if(isset($_GET["order"])){
	$order=$_GET["order"];
}else{
	bm_die("参数不正确！");
}
if(isset($_GET["locked"])){
	$locked=$_GET["locked"];
}else{
	bm_die("参数不正确！");
}
if($locked == 0){
	$sql = "UPDATE f_vedio SET locked = 0 WHERE id = $id";
} elseif($locked == 1) {
	if(isset($_POST["locked_password"])){
		$locked_password=md5($_POST["locked_password"]);
	}else{
		echo "fail";
		exit;
	}
	$sql = "UPDATE f_vedio SET locked = 1, password = '".$locked_password."' WHERE id = $id";
} else {
	echo "fail";
	exit;
}
if($idb->query_ex($sql)){
	if($locked==1){
?>
<div class="f_detail"><a href="javascript:void(0)" onclick="locked_ajax(<?php echo $order;?>,<?php echo $id;?>, 0)">[解锁视频]</a></div>
<?php
	} else {
?>
<div class="f_detail2"><a href="javascript:void(0)" onclick="locked_ajax(<?php echo $order;?>,<?php echo $id;?>, 1)">[锁定视频]</a></div>
<?php
	}
} else {
	bm_die($idb->print_error());
}
?>