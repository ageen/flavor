<?php
require_once("../global.php");
require_once("../authentication.php");
if(isset($_POST["id"])){
	$id=$_POST["id"];
}else{
	bm_die("参数不正确！");
}
if(isset($_POST["order"])){
	$order=$_POST["order"];
}else{
	bm_die("参数不正确！");
}
if(isset($_POST["recommend"])){
	$recommend_value=$_POST["recommend"];
}else{
	bm_die("参数不正确！");
}
if($recommend_value == 0){
	$sql = "UPDATE f_vedio SET recommend = 0 WHERE id = $id";
} elseif($recommend_value == 1) {
	$sql = "UPDATE f_vedio SET recommend = 1 WHERE id = $id";
} else {
	bm_die("参数错误！");
}
if($idb->query_ex($sql)){
	if($recommend_value==1){
?>
<div class="f_detail"><a href="javascript:void(0)" onclick="recommend_ajax(<?php echo $order;?>,<?php echo $id;?>, 0)">[取消推荐]</a></div>
<?php
	} else {
?>
<div class="f_detail2"><a href="javascript:void(0)" onclick="recommend_ajax(<?php echo $order;?>,<?php echo $id;?>, 1)">[推荐视频]</a></div>
<?php
	}
} else {
	bm_die($idb->print_error());
}
?>