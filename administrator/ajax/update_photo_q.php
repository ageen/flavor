<?php
require_once("../global.php");
require_once("../authentication.php");
if(isset($_POST["id"])){
	$id=$_POST["id"];
	unset($_POST["id"]);
}else{
	bm_die("参数不正确！");
}
$sql = "SELECT * FROM q_photo WHERE id = $id";
$num = get_num($sql);
if($num==0){
	bm_die("参数错误！");
}
foreach($_POST as $k=>$v){
	$feed["$k"] = $v;
}
$sql = $idb->query_update($feed, "q_photo", "id=$id");
if($idb->query_ex($sql)){
	$sql = "SELECT * FROM q_photo WHERE id = $id";
	$row_photo = get_rows($sql);
?>
<form name="photo_f" id="photo_f" method="post" onsubmit="return false;">
<table style="margin:10px auto;">
<tr>
<td align="center"><img src="../quanfeng/uploads/photo/thumbnail/<?php echo $row_photo["filename"];?>" /></td>
</tr>
<tr>
<td>图片名称: <input class="easyui-validatebox" type="text" name="title" id="title" value="<?php echo $row_photo["title"];?>" data-options="required:true" required /></td>
</tr>
<tr>
<td style="height:25px;">首页显示: 是<input type="radio" name="scroll" value="1" <?php echo $row_photo["scroll"]==1?"checked='checked'":'';?> />&nbsp;&nbsp;否<input type="radio" name="scroll" value="0" <?php echo $row_photo["scroll"]==0?"checked='checked'":'';?> /></td>
</tr>
<tr>
<td align="center"><button class="button_link" type="button" onclick="check_form();">保存</button>&nbsp;&nbsp;<button class="button_link" type="button" onclick="javascript:history.back();">返回</button></td>
</tr>
</table>
<input type="hidden" name="id" value="<?php echo $row_photo["id"];?>" />
</form>
<?php
} else {
	bm_die($idb->print_error());
}
?>
