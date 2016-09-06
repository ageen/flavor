<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>GLOBAL CONFIG</title>
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>css/style.css">
<script type="text/javascript" src="<?php echo T_TMP; ?>scripts/jquery.min.js"></script>
</head>
<body>
<div class="show_config">
<div id="show_top_back">
<?php 
if($row_config["top_background"]==""){
?>
<div class="show_top_back"><img src="../templates/images/default_top_back.png" /></div>
<?php
} else {
?>
<div class="show_top_back"><img src="../uploads/background/<?php echo $row_config["top_background"];?>" /></div>
<?php	
}
?>
</div>
<table>
<tr>
<td>顶部背景图片:</td>
<td><form action="ajax/upload_top_bk.php" method="post" id="bk_photo_form" enctype="multipart/form-data"><input type="file" name="bk_photo" />&nbsp;<button type="submit">上传</button></form></td><td><div class="show_config_tip"><span style="color:#00F">图片尺寸：宽>=850px , 高>=100px</span></div></td>
</tr>
<tr>
<td>网站主题色:</td>
<td><form id="theme_color">
<select name="theme_color" id="theme_color_value">
<?php
foreach($theme_color as $k=>$v){
	if($row_config["theme_color"] == $k){
?>
<option value="<?php echo $k; ?>" selected="selected"><?php echo $v;?></option>
<?php		
	} else {
?>
<option value="<?php echo $k; ?>"><?php echo $v;?></option>
<?php		
	}
}
?>
</select>
&nbsp;<button type="button" onclick="ajax_update_config('theme_color')">更新</button></form></td><td><div id="theme_color_tip" class="show_config_tip"></div></td>
</tr>
<tr>
<td>首页BANNER切换效果:</td>
<td><form id="banner_effect">
<select name="banner_effect" id="banner_effect_value">
<?php
foreach($banner_effect as $k=>$v){
	if($row_config["banner_effect"] == $k){
?>
<option value="<?php echo $k; ?>" selected="selected"><?php echo $v;?></option>
<?php		
	} else {
?>
<option value="<?php echo $k; ?>"><?php echo $v;?></option>
<?php		
	}
}
?>
</select>
&nbsp;<button type="button" onclick="ajax_update_config('banner_effect')">更新</button></form></td><td><div id="banner_effect_tip" class="show_config_tip"></div></td>
</tr>
<tr>
<td>首页标题：</td>
<td><form id="index_title"><input type="text" name="index_title" id="index_title_value" value="<?php echo $row_config["index_title"];?>" />&nbsp;<button type="button" onclick="ajax_update_config('index_title')">更新</button></form></td><td><div id="index_title_tip" class="show_config_tip"></div></td>
</tr>
<tr>
<td>网站标题后缀：</td>
<td><form id="webpage_title_suffix"><input type="text" name="webpage_title_suffix" id="webpage_title_suffix_value" value="<?php echo $row_config["webpage_title_suffix"];?>" />&nbsp;<button type="button" onclick="ajax_update_config('webpage_title_suffix')">更新</button></form></td><td><div id="webpage_title_suffix_tip" class="show_config_tip"></div></td>
</tr>
<tr>
<td>留言默认名：</td>
<td><form id="leave_username"><input type="text" name="leave_username" id="leave_username_value" value="<?php echo $row_config["leave_username"];?>" />&nbsp;<button type="button" onclick="ajax_update_config('leave_username')">更新</button></form></td><td><div id="leave_username_tip" class="show_config_tip"></div></td>
</tr>
<tr>
<td>回复留言显示名：</td>
<td><form id="reply_username"><input type="text" name="reply_username" id="reply_username_value" value="<?php echo $row_config["reply_username"];?>" />&nbsp;<button type="button" onclick="ajax_update_config('reply_username')">更新</button></form></td><td><div id="reply_username_tip" class="show_config_tip"></div></td>
</tr>
</table>
</div>
</body>
</html>
<script type="text/javascript" src="<?php echo T_TMP; ?>scripts/jquery.ajax.upload.js"></script>
<script type="text/javascript">
function ajax_update_config(form_id){
	if($("#"+form_id+"_value").val()==""){
		alert("请输入值！")
		return false;
	}
	$.ajax({
		   type: "POST",
		   url: "ajax/update_config.php?mode=" + form_id,
		   data: $("#"+form_id).serialize(),
		   success: function(msg){
				if(msg == "empty"){
					$("#"+form_id+"_tip").text("请输入值！");
				} else if(msg == "fail") {
					$("#"+form_id+"_tip").text("更新失败");
				} else if(msg == "success"){
					$("#"+form_id+"_tip").html("<span style='color:#00F'>更新成功</span>");
					setTimeout(function(){
					  	$("#"+form_id+"_tip").hide();
					 }, 1500);
				} else {
					alert("参数错误！");	
				}
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
			$("#show_top_back").html("<div style='height:50px;width:830px;background:url(templates/images/lightbox-ico-loading.gif) center center no-repeat;'></div>");
		},
		uploadProgress: function() 
		{
			$("#show_top_back").html("<div style='height:50px;width:830px;background:url(templates/images/lightbox-ico-loading.gif) center center no-repeat;'></div>");
		},
		complete: function(response)
		{
			if(response.responseText == "empty"){
				$("#show_top_back").html("<div style='height:50px;width:830px;text-align:center;color:#F00;line-height:50px;font-size:14px;'>上传图片为空！</div>");
				return false;
			}
			setTimeout(function(){
              $("#show_top_back").html(response.responseText);
			 }, 1000);
		},
		error: function()
		{
			alert("图片上传错误！")
		}
	};
	$("#bk_photo_form").ajaxForm(options);
});
</script>