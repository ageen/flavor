<?php
require_once("../global.php");
require_once("../authentication.php");
if(isset($_GET["id"])){
	$id = $_GET["id"];	
} else {
	bm_die("参数错误！");	
}
if(isset($_GET["order"])){
	$order = $_GET["order"];	
} else {
	bm_die("参数错误！");	
}

$sql = "SELECT * FROM f_account WHERE username = '" . $_POST["username"] . "'";
$num = get_num($sql);
if($num == 1){
	echo "same";
	exit;
}
$sql = $idb->query_update($_POST, "f_account", "id=$id");
if(!$idb->query_ex($sql)){
	bm_die($idb->print_error());
}
$sql = "SELECT * FROM f_account WHERE id = $id";
$row_account = get_rows($sql);
if($row_account == "nothing"){
	bm_die("参数错误！");
}
?>
<table>
<tr>
<td colspan="2">
<div class="f_title2">登录名称： <?php echo $row_account["username"];?></div>
<div class="f_title2">创建时间： <?php echo $row_account["create_time"];?></div>
<div class="f_title2">登录时间： <?php echo $row_account["last_login_time"];?></div>
</td>
</tr>
<tr><td colspan="3"><hr /></td></tr>
<tr>
<td colspan="3" style="margin:0;padding:0 0 10px 0;line-height:30px;border-bottom:1px dashed #666666;">
<div id="show_disable<?php echo $order;?>" style="float:left;">
<?php
if($row_account["disable"]==0){
?>
<div class="f_detail"><a href="javascript:void(0)" onclick="disable_ajax(<?php echo $order;?>,<?php echo $row_account["id"];?>, 1)">[禁用帐号]</a></div>
<?php
} else {
?>
<div class="f_detail2"><a href="javascript:void(0)" onclick="disable_ajax(<?php echo $order;?>,<?php echo $row_account["id"];?>, 0)">[开启帐号]</a></div>
<?php
}
?>
</div>
<div class="f_detail"><a href="javascript:void(0)" onClick="change_username_form(<?php echo $order;?>,'<?php echo $row_account["id"];?>')" target="_self" >[修改登录名]</a></div>
<div class="f_detail"><a href="javascript:void(0)" onClick="change_password_form('<?php echo $row_account["id"];?>')" target="_self" >[修改密码]</a></div>
<div class="f_detail"><a href="delete.php?mode=account&id=<?php echo $row_account["id"];?>" onclick="return del();" target="_self">[删除该帐号]</a></div>
</td>
</tr>
</table>