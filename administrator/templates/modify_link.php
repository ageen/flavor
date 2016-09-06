<?php defined('_EXEC') or die('Restricted access');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>UPDATE LINK</title>
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>scripts/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>scripts/themes/icon.css">
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>scripts/demo.css">
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>css/style.css">
<script type="text/javascript" src="<?php echo T_TMP; ?>scripts/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo T_TMP; ?>scripts/easyloader.js"></script>
</head>
<body>
<div class="article_form">
<div class="easyui-panel" title="更新友情链接" style="width:850px;">
<div style="padding:0;margin:0;color:#666666;" id="show_link_form">
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
</div>
<form action="ajax/update_link_logo.php" method="post" id="link_logo_form" enctype="multipart/form-data">
<table style="margin:0 auto;">
<tr>
<td>替换网站图标: <input type="file" name="logo" style="border:1px solid #e0e0e0;" /></td>
<td align="center"><div id="show_link_logo" style='height:90px;width:90px;'><img src="../uploads/logo/<?php echo $row_link["filename"];?>" /></div></td>
</tr>
<tr>
<td colspan="2" align="center"><button class="button_link" type="submit">更新图标</button></td>
</tr>
<tr><td colspan="2" align="center"></td></tr>
</table>
<input type="hidden" name="id" value="<?php echo $row_link["id"];?>" />
</form>
</div>
</div>
</body>
</html>
<script type="text/javascript" src="<?php echo T_TMP; ?>scripts/jquery.ajax.upload.js"></script>
<script type="text/javascript">
function check_form(){
	if(document.getElementById("title").value == ""){
		alert("请输入网站名称！");
		return false;
	}
	if(document.getElementById("url").value == ""){
		alert("请输入网站地址！");
		return false;
	}
	ajax_post();
}
function ajax_post(){
	$.ajax({
	  	type: "POST",
	  	url: "ajax/update_link.php",
		data: $("#article_f").serialize(),
		success: function(msg){
			alert("更新成功！")
	   		$("#show_link_form").html(msg)
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
			$("#show_link_logo").html("<div style='height:90px;width:90px;background:url(templates/images/lightbox-ico-loading.gif) center center no-repeat;'></div>");
		},
		uploadProgress: function() 
		{
			$("#show_link_logo").html("<div style='height:90px;width:90px;background:url(templates/images/lightbox-ico-loading.gif) center center no-repeat;'></div>");
		},
		complete: function(response)
		{
			alert("图标更新成功！")
			setTimeout(function(){
              $("#show_link_logo").html(response.responseText);
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