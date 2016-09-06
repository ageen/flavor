<?php
require_once("../global.php");
require_once("../authentication.php");
if(isset($_POST["id"])){
	$id=$_POST["id"];
	unset($_POST["id"]);
}else{
	bm_die("参数不正确！");
}
$sql = "SELECT * FROM f_album WHERE id = $id";
$num = get_num($sql);
if($num==0){
	bm_die("参数错误！");
}
foreach($_POST as $k=>$v){
	if($k=="password"){
		if($v != ""){
			$feed[$k] = md5($v);	
		}
	} else {
		$feed["$k"] = $v;	
	}
}
$sql = $idb->query_update($feed, "f_album", "id=$id");
if($idb->query_ex($sql)){
	$sql = "SELECT * FROM f_album WHERE id = $id";
	$row_album = get_rows($sql);
?>
<form name="album_f" id="album_f" method="post" onsubmit="return false;">
<table style="margin:10px auto;">
<tr>
<td>相册名称: <input class="easyui-validatebox" type="text" name="title" id="title" size="50" value="<?php echo $row_album["title"];?>" data-options="required:true" required /></td>
</tr>
<tr>
<td>是否公开: 是<input type="radio" name="public" value="1" <?php echo $row_album["public"]==1?"checked='checked'":'';?> />&nbsp;&nbsp;否<input type="radio" name="public" value="0" <?php echo $row_album["public"]==0?"checked='checked'":'';?> onclick="set_password();" /></td>
</tr>
<tr>
<td>设置密码: <input type="password" name="password" id="has_password" />&nbsp;<span class="show_tip" id="show_tip_pass"></span></td>
</tr>
<tr>
<td>排序: <input type="text" name="album_order" value="<?php echo $row_album["album_order"];?>" /></td>
</tr>
<tr>
<td align="center"><button class="button_link" type="button" onclick="check_form();">保存</button>&nbsp;&nbsp;<button class="button_link" type="button" onclick="javascript:history.back();">返回</button></td>
</tr>
</table>
<input type="hidden" name="id" value="<?php echo $row_album["id"];?>" />
</form>
<?php
} else {
	bm_die($idb->print_error());
}
?>