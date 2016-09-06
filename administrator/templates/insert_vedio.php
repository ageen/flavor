<?php defined('_EXEC') or die('Restricted access');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>INSERT VEDIO</title>
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>scripts/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>scripts/themes/icon.css">
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>scripts/demo.css">
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>css/style.css">
<style type="text/css">
#progress { position:relative; width:400px; border: 1px solid #ddd; padding: 1px; border-radius: 3px; }
#bar { background-color: #B4F5B4; width:0%; height:20px; border-radius: 3px; }
#percent { position:absolute; display:inline-block; top:3px; left:48%; }
</style>
<script type="text/javascript" src="<?php echo T_TMP; ?>scripts/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo T_TMP; ?>scripts/easyloader.js"></script>
</head>
<body>
<div class="banner_form">
<div class="easyui-panel" title="新增视频" style="width:750px;">
<div style="padding:10px 0 10px 60px">
<form action="ajax/upload_vedio.php" name="vedio_f" id="vedio_f" method="post" enctype="multipart/form-data">
<table>
<tr>
<td>选择视频文件:</td><td width="550"><input class="easyui-validatebox" type="file" name="vedio_file" />&nbsp;</td>
</tr>
<tr>
<td>视频缩略图:</td><td width="550"><input class="easyui-validatebox" type="file" name="vedio_thumb" />&nbsp;</td>
</tr>
<tr>
<td colspan="2"><div id="progress"><div id="bar"><div id="percent"></div></div></div></td>
</tr>
<tr>
<td colspan="2"><hr /></td>
</tr>
<tr>
<td>视频名称:</td><td><input class="easyui-validatebox" name="title" type="text" data-options="required:true" required /></td>
</tr>
<tr>
<td>视频描述:</td><td><textarea name="description" rows="10" cols="30" style="font-size:14px;"></textarea></td>
</tr>
<tr>
<td>是否发布:</td><td>是<input type="radio" name="public" value="1" checked="checked" />&nbsp;&nbsp;否<input type="radio" name="public" value="0" /></td>
</tr>
<tr>
<td>允许评论:</td><td>是<input type="radio" name="comment" value="1" checked="checked" />&nbsp;&nbsp;否<input type="radio" name="comment" value="0" /></td>
</tr>
<tr>
<td>推荐视频:</td><td>是<input type="radio" name="recommend" value="1" />&nbsp;&nbsp;否<input type="radio" name="recommend" value="0" checked="checked" /></td>
</tr>
<tr>
<td>上传时间:</td><td><input type="text" name="publish_time" class="easyui-datetimebox" size="23" value="<?php echo date("Y-m-d H:i:s");?>" /></td>
</tr>
<tr>
<td></td><td><button class="button_link" type="submit">提交</button></td>
</tr>
<tr>
<td colspan="2"><div id="show_bar"></div></td>
</tr>
</table>
</form>
</div>
</div>
</div>
</body>
</html>
<script type="text/javascript" src="<?php echo T_TMP; ?>scripts/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo T_TMP; ?>scripts/jquery.ajax.upload.js"></script>
<script type="text/javascript">
$("#vedio_f").validate({
	rules:{
		title:"required"
	},
	messages:{
		title:""
	}
});
(function() {
	// validate the comment form when it is submitted
	$("#vedio_f").validate();
})();

function check_form(){
	if(document.getElementById("title").value == ""){
		alert("请输入视频名称！");
		return false;
	}
	if(document.getElementById("url").value == ""){
		alert("请输入网站地址！");
		return false;
	}
}

$(document).ready(function()
{
	var options = {
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
		/*
		beforeSend: function() 
		{
			$("#show_link_logo").html("<img src='templates/images/lightbox-ico-loading.gif' />");
		},
		uploadProgress: function() 
		{
			$("#show_link_logo").html("<div style='height:90px;width:90px;background:url(templates/images/lightbox-ico-loading.gif) center center no-repeat;'></div>");
		},
		*/
		complete: function(response)
		{
			if(response.responseText == "success"){
				alert("上传成功！");
				window.location.href='view.php?mode=vedio'
			} else {
				$("#show_bar").html(response.responseText)	
			}
		},
		error: function()
		{
			alert("视频上传错误！")
		}
	};
	$("#vedio_f").ajaxForm(options);
});
</script>