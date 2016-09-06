<?php
require_once("../global.php");
require_once("../authentication.php");
if(isset($_GET["id"])){
	$id = $_GET["id"];	
} else {
	bm_die("参数错误！");	
}
if (get_magic_quotes_gpc()){
	$_POST = array_map('stripslashes_deep', $_POST);
}

$feed = array();
$feed["publish_time"] = date("Y-m-d H:i:s");
$feed["reply"] = 1;
$feed["reply_id"] = $id;
$feed["username"] = REPLY_USERNAME;

if($_POST["content"] == "" ){
	showinfo("不能为空！", "back");	
} else {
	if(cstrlen(HtmToText($_POST["content"])) > 200){
		echo "max_words";
		exit;
	} else {
		$feed["content"] = $_POST["content"];
	}
}
$sql = $idb->query_insert($feed, "f_messages");
if(!$idb->query_ex($sql)){
	bm_die($idb->print_error());
}
$sql = "SELECT * FROM f_messages WHERE id = $id AND reply = 0 LIMIT 1";
$row_message = get_rows($sql);
if($row_message == "nothing"){
	bm_die("参数错误！");
}
$sql = "SELECT * FROM f_messages WHERE reply_id = ". $row_message["id"] ." AND reply = 1 LIMIT 1";
$row_reply = get_rows($sql);
?>
<table>
<tr>
<td colspan="2" style="line-height:30px;border-bottom:1px solid #e0e0e0;"><span class="f_title"><?php echo $row_message["username"];?> 于 <?php echo $row_message["publish_time"];?> 发表评论：</span></td><td width="400"></td>
</tr>
<tr>
<td colspan="3" style="border-bottom:1px solid #e0e0e0;margin:0;padding:10px 0 10px 0;"><?php echo $row_message["content"]; ?></td>
</tr>
<?php
if($row_reply != "nothing"){
?>
<tr>
<td colspan="3">
<div class="reply_content"><span style="color:#666;"><?php echo $row_reply["username"];?> 在 <?php echo $row_reply["publish_time"]?> 回复：</span><?php echo $row_reply["content"]?></div>
</td>
</tr>
<tr>
<td colspan="3" style="margin:0;padding:0 0 10px 0;line-height:30px;border-bottom:1px dashed #666666;" align="right">
<div class="f_detail" style="width:780px;margin:0 auto;"><a href="delete.php?mode=messages&id=<?php echo $row_reply["id"];?>" onclick="return del();" target="_self">[删除该回复]</a></div>
</td>
<?php
}
?>
<tr>
<td colspan="3" style="margin:0;padding:0 0 10px 0;line-height:30px;border-bottom:1px dashed #666666;" align="right">
<div class="f_detail" style="float:right;"><a href="delete.php?mode=messages&id=<?php echo $row_message["id"];?>" onclick="return del();" target="_self">[删除该留言]</a></div>
<?php
if($row_reply == "nothing"){
?>
<div class="f_detail" style="float:right;"><a href="javascript:void(0)" id="reply_form<?php echo $i;?>" onClick="show_reply_form(<?php echo $i;?>,'<?php echo $row_message["id"];?>')" target="_self" style="color:#00F;">[回复该留言]</a></div>
<?php	
}
?>
</td>
</tr>
</table>