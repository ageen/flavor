<?php defined('_EXEC') or die('Restricted access');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>UPDATE VEDIO</title>
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>scripts/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>scripts/themes/icon.css">
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>scripts/demo.css">
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>css/style.css">
<script type="text/javascript" src="<?php echo T_TMP; ?>scripts/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo T_TMP; ?>scripts/easyloader.js"></script>
</head>
<body>
<div class="article_form">
<div class="easyui-panel" title="更新视频信息" style="width:850px;">
<div style="padding:0;margin:0;color:#666666;" id="show_vedio_form">
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
</div>
<form action="ajax/update_vedio_thumb.php" method="post" id="link_logo_form" enctype="multipart/form-data">
<table style="margin:0 auto;">
<tr>
<td align="center">
<div id="show_vedio_thumb" style='height:200px;width:200px; overflow:hidden;'>
<?php
if(empty($row_vedio["thumbnail"])){
?>
<img src="templates/images/no_thumb.jpg" />
<?php
} else {
?>
<img src="../uploads/vedio/thumbnail/<?php echo $row_vedio["thumbnail"];?>"  height="200" width="200" />
<?php
}
?>
</div>
</td>
</tr>
<tr>
<td>替换视频缩略图: <input type="file" name="thumb" style="border:1px solid #e0e0e0;" /></td>
</tr>
<tr>
<td colspan="2" align="center"><button class="button_link" type="submit">更新图标</button></td>
</tr>
<tr><td colspan="2" align="center"></td></tr>
</table>
<input type="hidden" name="id" value="<?php echo $row_vedio["id"];?>" />
</form>
</div>
</div>
</body>
</html>
<script type="text/javascript" src="<?php echo T_TMP; ?>scripts/jquery.ajax.upload.js"></script>
<script type="text/javascript">
function check_form(){
	if(document.getElementById("title").value == ""){
		alert("请输入视频名称！");
		return false;
	}
	ajax_post();
}
function ajax_post(){
	$.ajax({
	  	type: "POST",
	  	url: "ajax/update_vedio.php",
		data: $("#vedio_f").serialize(),
		success: function(msg){
			alert("更新成功！")
	   		$("#show_vedio_form").html(msg)
		}
	});
}
$(document).ready(function()
{
	var options = {
/**
		beforeSend: function() 
		{
			$("#progress").show();
			//clear everything
			$("#bar").width('0%');
			$("#percent").html("0%");
		},

		uploadProgress: function(event, position, total, percentComplete) 
		{
			$("#bar").width(percentComplete+'%');
			$("#percent").html(percentComplete+'%');
		},
		success: function() 
		{
			$("#bar").width('100%');
			$("#percent").html('100%');
		},
*/
		beforeSend: function() 
		{
			$("#show_vedio_thumb").html("<div style='height:200px;width:200px;background:url(templates/images/lightbox-ico-loading.gif) center center no-repeat;'></div>");
		},
		uploadProgress: function() 
		{
			$("#show_vedio_thumb").html("<div style='height:200px;width:200px;background:url(templates/images/lightbox-ico-loading.gif) center center no-repeat;'></div>");
		},
		complete: function(response)
		{
			alert("图标更新成功！")
			setTimeout(function(){
              $("#show_vedio_thumb").html(response.responseText);
			 }, 1500);
		},
		error: function()
		{
			alert("图片上传错误！")
		}
	};
	$("#link_logo_form").ajaxForm(options);
});
</script>