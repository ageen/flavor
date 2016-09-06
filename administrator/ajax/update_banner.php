<?php
require_once("../global.php");
require_once("../authentication.php");
if(isset($_POST["id"])){
	$id=$_POST["id"];
	unset($_POST["id"]);
}else{
	bm_die("参数不正确！");
}
$sql = "SELECT * FROM f_banner WHERE id = $id";
$num = get_num($sql);
if($num==0){
	bm_die("参数错误！");
}
foreach($_POST as $k=>$v){
	$feed["$k"] = $v;
}
$sql = $idb->query_update($feed, "f_banner", "id=$id");
if($idb->query_ex($sql)){
	$sql = "SELECT * FROM f_banner WHERE id = $id";
	$row_banner = get_rows($sql);
?>
<form name="banner_f" id="banner_f" method="post" onsubmit="return false;">
<table style="margin:10px auto;">
<tr>
<td align="center"><img src="../uploads/banner/thumbnail/<?php echo $row_banner["filename"];?>" /></td>
</tr>
<tr>
<td>BANNER名称: <input class="easyui-validatebox" type="text" name="title" id="title" value="<?php echo $row_banner["title"];?>" data-options="required:true" required /></td>
</tr>
<tr>
<td>BANNER描述: <textarea name="description" rows="8" cols="20"><?php echo $row_banner["description"];?></textarea></td>
</tr>
<tr>
<td style="height:25px;">首页显示: 是<input type="radio" name="is_show" value="1" <?php echo $row_banner["is_show"]==1?"checked='checked'":'';?> />&nbsp;&nbsp;否<input type="radio" name="is_show" value="0" <?php echo $row_banner["is_show"]==0?"checked='checked'":'';?> /></td>
</tr>
<tr>
<td style="height:20px;">排序: <input type="text" name="banner_order" value="<?php echo $row_banner["banner_order"];?>" /></td>
</tr>
<tr>
<td align="center"><button class="button_link" type="button" onclick="check_form();">保存</button>&nbsp;&nbsp;<button class="button_link" type="button" onclick="javascript:history.back();">返回</button></td>
</tr>
</table>
<input type="hidden" name="id" value="<?php echo $row_banner["id"];?>" />
</form>
<?php
} else {
	bm_die($idb->print_error());
}
?>