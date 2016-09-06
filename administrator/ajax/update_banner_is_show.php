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
if(isset($_POST["is_show"])){
	$is_show_value=$_POST["is_show"];
}else{
	bm_die("参数不正确！");
}

if($is_show_value == 0){
	$sql = "UPDATE f_banner SET is_show = 0 WHERE id = $id";
} elseif($is_show_value == 1) {
	$sql = "UPDATE f_banner SET is_show = 1 WHERE id = $id";
} else {
	bm_die("参数错误！");
}

if($idb->query_ex($sql)){
	if($is_show_value==1){
?>
<div class="f_detail"><a href="javascript:void(0)" onclick="is_show_ajax(<?php echo $order;?>,<?php echo $id;?>, 0)">[关闭显示]</a></div>
<?php
	} else {
?>
<div class="f_detail2"><a href="javascript:void(0)" onclick="is_show_ajax(<?php echo $order;?>,<?php echo $id;?>, 1)">[开启显示]</a></div>
<?php
	}
} else {
	bm_die($idb->print_error());
}
?>