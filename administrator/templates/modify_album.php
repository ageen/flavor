<?php defined('_EXEC') or die('Restricted access');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>UPDATE ALBUM</title>
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>scripts/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>scripts/themes/icon.css">
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>scripts/demo.css">
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>css/style.css">
<script type="text/javascript" src="<?php echo T_TMP; ?>scripts/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo T_TMP; ?>scripts/easyloader.js"></script>
</head>
<body>
<div class="article_form">
<div class="easyui-panel" title="更新相册信息" style="width:850px; height:480px;">
<div style="padding:0;margin:0;color:#666666;" id="show_album_form">
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
</div>
<!--ALBUM PHOTO-->
<form action="ajax/update_album_photo.php" method="post" id="album_photo_form" enctype="multipart/form-data">
<table style="margin:0 auto;">
<tr>
<td align="center"><div id="show_album_photo"><img src="../uploads/album/<?php echo $row_album["filename"];?>" /></div></td>
</tr>
<tr>
<td height="30">替换相册图片: <input type="file" name="album_photo" style="border:1px solid #e0e0e0;" /></td>
</tr>
<tr>
<td align="center" height="30"><button class="button_link" type="submit">更新图片</button></td>
</tr>
<tr><td align="center"></td></tr>
</table>
<input type="hidden" name="id" value="<?php echo $row_album["id"];?>" />
</form>
</div>
</div>
</body>
</html>
<script type="text/javascript" src="<?php echo T_TMP; ?>scripts/jquery.ajax.upload.js"></script>
<script type="text/javascript">
function check_form(){
	if(document.getElementById("title").value == ""){
		alert("请输入相册名称！");
		return false;
	}
	ajax_post();
}
function set_password(){
	if($("#has_password").val()==""){
		$("#has_password").val("123456")
		$("#show_tip_pass").text("默认密码为123456")		
	}
}
function ajax_post(){
	$.ajax({
	  	type: "POST",
	  	url: "ajax/update_album.php",
		data: $("#album_f").serialize(),
		success: function(msg){
			alert("更新成功！")
	   		$("#show_album_form").html(msg)
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
			$("#show_album_photo").html("<div style='height:200px;width:200px;background:url(templates/images/lightbox-ico-loading.gif) center center no-repeat;'></div>");
		},
		uploadProgress: function() 
		{
			$("#show_album_photo").html("<div style='height:200px;width:200px;background:url(templates/images/lightbox-ico-loading.gif) center center no-repeat;'></div>");
		},
		complete: function(response)
		{
			setTimeout(function(){
              $("#show_album_photo").html(response.responseText);
			 }, 1500);
		},
		error: function()
		{
			alert("图片上传错误！")
		}
	};
	$("#album_photo_form").ajaxForm(options);
});
</script>