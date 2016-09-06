<?php
require_once("../global.php");
require_once("../authentication.php");
if(isset($_POST["id"])){
	$id=$_POST["id"];
	unset($_POST["id"]);
}else{
	bm_die("参数不正确！");
}
$sql = "SELECT * FROM f_link WHERE id = $id";
$num = get_num($sql);
if($num==0){
	bm_die("参数错误！");
}
foreach($_POST as $k=>$v){
	$feed["$k"] = $v;
}
$sql = $idb->query_update($feed, "f_link", "id=$id");
if($idb->query_ex($sql)){
	$sql = "SELECT * FROM f_link WHERE id = $id";
	$row_link = get_rows($sql);
?>
<form name="article_f" id="article_f" method="post" onsubmit="return false;">
<table style="margin:0 auto;">
<tr>
<td>网站名称: <input class="easyui-validatebox" type="text" name="title" id="title" size="50" value="<?php echo $row_link["title"];?>" data-options="required:true" required /></td>
</tr>
<tr>
<td>网站链接: <input class="easyui-validatebox" type="text" name="url" id="url" size="50" value="<?php echo $row_link["url"];?>" data-options="required:true,validType:'url'" required /></td>
</tr>
<tr>
<td>是否显示: 是<input type="radio" name="selected" value="1" <?php echo $row_link["selected"]==1?"checked='checked'":'';?> />&nbsp;&nbsp;否<input type="radio" name="selected" value="0" <?php echo $row_link["selected"]==0?"checked='checked'":'';?> /></td>
</tr>
<tr>
<td>排序: <input type="text" name="link_order" value="<?php echo $row_link["link_order"];?>" /></td>
</tr>
<tr>
<td align="center"><button class="button_link" type="button" onclick="check_form();">保存</button>&nbsp;&nbsp;<button class="button_link" type="button" onclick="javascript:history.back();">返回</button></td>
</tr>
</table>
<input type="hidden" name="id" value="<?php echo $row_link["id"];?>" />
</form>
<?php
} else {
	bm_die($idb->print_error());
}
?>