<?php defined('_EXEC') or die('Restricted access');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>INSERT ALBUM</title>
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>scripts/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>scripts/themes/icon.css">
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>scripts/demo.css">
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>css/style.css">
<script type="text/javascript" src="<?php echo T_TMP; ?>scripts/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo T_TMP; ?>scripts/easyloader.js"></script>
</head>
<body>
<div class="banner_form">
<div class="easyui-panel" title="新增相册" style="width:750px;">
<div style="padding:10px 0 10px 60px">
<form action="save.php?mode=album" name="album_f" id="album_f" method="post" enctype="multipart/form-data" onsubmit="return check_form();">
<table>
<tr>
<td>相册展示图:</td><td width="550"><input type="file" name="album_photo" />&nbsp;<span class="show_tip">图片宽高 >= 200像素</span></td>
</tr>
<tr>
<td colspan="2"><hr /></td>
</tr>
<tr>
<td>相册名称:</td><td><input class="easyui-validatebox" name="title" id="title" data-options="required:true" required /></td>
</tr>
<tr>
<td>排序:</td><td><input type="text" name="album_order" />&nbsp;<span class="show_tip">排序默认0</span></td>
</tr>
<tr>
<td>是否公开:</td><td>是<input type="radio" name="public" id="is_public" value="1" checked="checked" onclick="cancel_password();" />&nbsp;&nbsp;否<input type="radio" name="public" id="is_public" value="0" onclick="set_password();" /></td>
</tr>
<tr>
<td>设置密码:</td><td><input type="password" name="password" id="has_password" />&nbsp;<span class="show_tip" id="show_tip_pass"></span></td>
</tr>
<tr>
<td></td><td><button class="button_link" type="submit">提交</button></td>
</tr>
</table>
<input type="hidden" name="create_time" value="<?php echo date("Y-m-d H:i:s");?>" />
<input type="hidden" name="mode" value="album" />
</form>
</div>
</div>
</div>
</body>
</html>
<script type="text/javascript" src="<?php echo T_TMP; ?>scripts/jquery.validate.js"></script>
<script type="text/javascript">
$("#album_f").validate({
	rules:{
		title:"required"
	},
	messages:{
		title:""
	}
});
(function() {
	// validate the comment form when it is submitted
	$("#album_f").validate();
})();

function set_password(){
	$("#has_password").val("123456")
	$("#show_tip_pass").text("默认密码为123456 或重新设置！")
}
function cancel_password(){
	$("#has_password").val("")
	$("#show_tip_pass").text("")
}
</script>