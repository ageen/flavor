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
if(isset($_POST["scroll"])){
	$is_scroll=$_POST["scroll"];
}else{
	bm_die("参数不正确！");
}

if($is_scroll == 0){
	$sql = "UPDATE q_photo SET scroll = 0 WHERE id = $id";
} elseif($is_scroll == 1) {
	$sql = "UPDATE q_photo SET scroll = 1 WHERE id = $id";
} else {
	bm_die("参数错误！");
}
if($idb->query_ex($sql)){
	if($is_scroll==1){
?>
<div class="f_detail"><a href="javascript:void(0)" onclick="scroll_ajax(<?php echo $order;?>,<?php echo $id;?>, 0)">[关闭首页滚动]</a></div>
<?php
	} else {
?>
<div class="f_detail2"><a href="javascript:void(0)" onclick="scroll_ajax(<?php echo $order;?>,<?php echo $id;?>, 1)">[开启首页滚动]</a></div>
<?php
	}
}
?>
