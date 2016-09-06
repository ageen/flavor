<?php defined('_EXEC') or die('Restricted access');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>VIEW MESSAGES</title>
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>scripts/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>scripts/themes/icon.css">
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>scripts/demo.css">
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>css/style.css">
<script type="text/javascript" src="<?php echo T_TMP; ?>scripts/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo T_TMP; ?>scripts/jquery.easyui.min.js"></script>
<script type="text/javascript" src="<?php echo T_TMP; ?>scripts/easyloader.js"></script>
<script type="text/javascript">
window.UEDITOR_HOME_URL ="http://www.smallcell.me/administrator/templates/scripts/ueditor/";
</script>
<script type="text/javascript" src="<?php echo T_TMP; ?>scripts/ueditor/ueditor2.config.js"></script>
<script type="text/javascript" src="<?php echo T_TMP; ?>scripts/ueditor/ueditor.all.js"></script> 
</head>
<body>
<div class="view_article_comment_head">网站留言</div>
<div class="article_search">
<div class="article_time_sort">
<form action="view.php?mode=p_messages" method="post" name="messages_time_sort">
<select name="p_messages_sort" onchange="javascript:document.messages_time_sort.submit();">
<?php
foreach($order as $k=>$v){
	if($_SESSION["p_messages_sort"] == "$k"){
?>
<option value="<?php echo $k;?>" selected="selected"><?php echo $v;?></option>
<?php
	} else {
?>
<option value="<?php echo $k;?>"><?php echo $v;?></option>
<?php	
	}
}
?>
</select>
</form>
</div>
</div>
<div class="view_article">
<?php
if($row_messages == "nothing"){
?>
<div class="no_article">暂无留言！</div>
<?php
} else {
$i = 0;
foreach($row_messages as $k=>$v){
	$sql = "SELECT * FROM f_messages WHERE reply_id = ". $v["id"] ." AND reply = 1 LIMIT 1";
	$row_reply = get_rows($sql);
?>
<div id="show_messages<?php echo $i;?>">
<table>
<tr>
<td colspan="2" style="line-height:30px;border-bottom:1px solid #e0e0e0;"><span class="f_title"><?php echo $v["nickname"];?> 于 <?php echo $v["date_time"];?> 发表评论：</span></td><td width="400"></td>
</tr>
<tr>
<td colspan="3" style="border-bottom:1px solid #e0e0e0;margin:0;padding:10px 0 10px 0;"><?php echo $v["content"]; ?></td>
</tr>
<tr>
<td colspan="3" style="margin:0;padding:0 0 10px 0;line-height:30px;border-bottom:1px dashed #666666;" align="right">
<div class="f_detail" style="float:right;"><a href="delete.php?mode=p_message&id=<?php echo $v["id"];?>" onclick="return del();" target="_self">[删除该留言]</a></div>
</td>
</tr>
</table>
</div>
<?php
	$i++;
}
}
?>
<div style="width:850px;margin:10px auto;"><div class="f_paginate"><?php echo $page_string;?></div></div>
</div>
<div id="reply_form">
<div class="reply_form">
<form id="reply_form_data">
<div><textarea id="myEditor" name="content"></textarea></div>
<div class="reply_form_button"><button type="button" onclick="ajax_submit_message();">回复留言</button>&nbsp;<button type="button" onclick="close_form();">关闭</button></div>
</form>
</div>
</div>
</body>
</html>
<script type="text/javascript">
$("#reply_form").hide();
var _order;
var _id;
var editor = new UE.ui.Editor();
	editor.render("myEditor");
    //1.2.4以后可以使用一下代码实例化编辑器
    //UE.getEditor('myEditor')
function show_reply_form(order, m_id){
	$("#reply_form").fadeIn("slow");
	_order = order;
	_id = m_id;
}
function ajax_submit_message(){
	if($("#myEditor").val()==""){
		alert("输入回复内容！")
		return false;
	}
	$.ajax({
		   type: "POST",
		   url: "ajax/reply_messages.php?id="+_id+"&order="+_order,
		   data: $("#reply_form_data").serialize(),
		   success: function(msg){
				if(msg == "max_words"){
					alert("字数超出！");
					return false;
				} else {
					$("#reply_form").hide();
					$("#show_messages"+_order).html(msg);
				}
		   }
	});
}
function close_form(){
	$("#reply_form").fadeOut("slow");
}

function del() {
	var msg = "确定删除该留言？";
	if (confirm(msg)==true){
		return true;
	}else{
		return false; 
	}
}
</script>
