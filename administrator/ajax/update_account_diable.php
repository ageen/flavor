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
if(isset($_POST["disable"])){
	$disable=$_POST["disable"];
}else{
	bm_die("参数不正确！");
}
if($disable == 0){
	$sql = "UPDATE f_account SET disable = 0 WHERE id = $id";
} elseif($disable == 1) {
	$sql = "UPDATE f_account SET disable = 1 WHERE id = $id";
} else {
	bm_die("参数错误！");
}
if($idb->query_ex($sql)){
	if($disable==0){
?>
<div class="f_detail"><a href="javascript:void(0)" onclick="disable_ajax(<?php echo $order;?>,<?php echo $id;?>, 1)">[禁用帐号]</a></div>
<?php
	} else {
?>
<div class="f_detail2"><a href="javascript:void(0)" onclick="disable_ajax(<?php echo $order;?>,<?php echo $id;?>, 0)">[开启帐号]</a></div>
<?php
	}
} else {
	bm_die($idb->print_error());
}
?>