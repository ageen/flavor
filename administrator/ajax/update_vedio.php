<?php
require_once("../global.php");
require_once("../authentication.php");
if(isset($_POST["id"])){
	$id=$_POST["id"];
	unset($_POST["id"]);
}else{
	bm_die("参数不正确！");
}
$sql = "SELECT * FROM f_vedio WHERE id = $id";
$num = get_num($sql);
if($num==0){
	bm_die("参数错误！");
}
foreach($_POST as $k=>$v){
	$feed["$k"] = $v;
}
$sql = $idb->query_update($feed, "f_vedio", "id=$id");
if($idb->query_ex($sql)){
	$sql = "SELECT * FROM f_vedio WHERE id = $id";
	$row_vedio = get_rows($sql);
?>
<form name="vedio_f" id="vedio_f" method="post" onsubmit="return false;">
<table style="margin:0 auto;">
<tr>
<td height="30">视频名称: <input class="easyui-validatebox" type="text" name="title" id="title" size="50" value="<?php echo $row_vedio["title"];?>" data-options="required:true" required /></td>
</tr>
<tr>
<td>视频描述: <textarea name="description" rows="10" cols="30" style="font-size:14px;"><?php echo $row_vedio["description"];?></textarea></td>
</tr>
<tr>
<td>是否发布: 是<input type="radio" name="public" value="1" <?php echo $row_vedio["public"]==1?"checked='checked'":'';?> />&nbsp;&nbsp;否<input type="radio" name="public" value="0" <?php echo $row_vedio["public"]==0?"checked='checked'":'';?> /></td>
</tr>
<tr>
<td>是否推荐: 是<input type="radio" name="recommend" value="1" <?php echo $row_vedio["recommend"]==1?"checked='checked'":'';?> />&nbsp;&nbsp;否<input type="radio" name="recommend" value="0" <?php echo $row_vedio["recommend"]==0?"checked='checked'":'';?> /></td>
</tr>
<tr>
<td>允许评论: 是<input type="radio" name="comment" value="1" <?php echo $row_vedio["comment"]==1?"checked='checked'":'';?> />&nbsp;&nbsp;否<input type="radio" name="comment" value="0" <?php echo $row_vedio["comment"]==0?"checked='checked'":'';?> /></td>
</tr>
<tr>
<td align="center"><button class="button_link" type="button" onclick="check_form();">保存</button>&nbsp;&nbsp;<button class="button_link" type="button" onclick="javascript:history.back();">返回</button></td>
</tr>
</table>
<input type="hidden" name="id" value="<?php echo $row_vedio["id"];?>" />
</form>
<?php
} else {
	bm_die($idb->print_error());
}
?>