<?php
require_once("../global.php");
require_once("../authentication.php");
if(isset($_POST["id"])){
	$id=$_POST["id"];
	unset($_POST["id"]);
}else{
	bm_die("参数不正确！");
}
$sql = "SELECT * FROM f_photo WHERE id = $id";
$num = get_num($sql);
if($num==0){
	bm_die("参数错误！");
}
foreach($_POST as $k=>$v){
	$feed["$k"] = $v;
}
$sql = $idb->query_update($feed, "f_photo", "id=$id");
if($idb->query_ex($sql)){
	$sql = "SELECT * FROM f_photo WHERE id = $id";
	$row_photo = get_rows($sql);
	$sql = "SELECT id,title FROM f_album";
	$row_albums = get_rows($sql, "array");
?>
<form name="photo_f" id="photo_f" method="post" onsubmit="return false;">
<table style="margin:10px auto;">
<tr>
<td align="center"><img src="../uploads/photo/thumbnail/<?php echo $row_photo["filename"];?>" /></td>
</tr>
<tr>
<td>图片名称: <input class="easyui-validatebox" type="text" name="title" id="title" value="<?php echo $row_photo["title"];?>" data-options="required:true" required /></td>
</tr>
<tr>
<td>所属相册: 
<select name="album_id">
<?php
foreach($row_albums as $k=>$v){
	if($row_photo["album_id"] == $v["id"]){
?>
<option value="<?php echo $v["id"];?>" selected="selected"><?php echo $v["title"];?></option>
<?php		
	} else {
?>
<option value="<?php echo $v["id"];?>"><?php echo $v["title"];?></option>
<?php		
	}
}
?>
</select>
</td>
</tr>
<tr>
<td>图片描述: <textarea name="description" rows="8" cols="20"><?php echo $row_photo["description"];?></textarea></td>
</tr>
<tr>
<td style="height:25px;">首页滚动栏: 是<input type="radio" name="scroll" value="1" <?php echo $row_photo["scroll"]==1?"checked='checked'":'';?> />&nbsp;&nbsp;否<input type="radio" name="scroll" value="0" <?php echo $row_photo["scroll"]==0?"checked='checked'":'';?> /></td>
</tr>
<tr>
<td style="height:20px;">允许评论: 是<input type="radio" name="comment" value="1" <?php echo $row_photo["comment"]==1?"checked='checked'":'';?> />&nbsp;&nbsp;否<input type="radio" name="comment" value="0" <?php echo $row_photo["comment"]==0?"checked='checked'":'';?> /></td>
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