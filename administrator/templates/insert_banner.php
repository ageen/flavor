<?php defined('_EXEC') or die('Restricted access');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>INSERT BANNER</title>
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>scripts/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>scripts/themes/icon.css">
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>scripts/demo.css">
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>css/style.css">
<script type="text/javascript" src="<?php echo T_TMP; ?>scripts/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo T_TMP; ?>scripts/easyloader.js"></script>
</head>
<body>
<div class="banner_form">
<div class="easyui-panel" title="新增banner图片" style="width:750px;">
<div style="padding:10px 0 10px 60px">
<form action="save.php?mode=banner" name="banner_f" id="banner_f" method="post" enctype="multipart/form-data">
<table>
<tr>
<td>BANNER图片:</td><td><input type="file" name="banner_photo"></input></td>
</tr>
<tr>
<td colspan="2"><hr /></td>
</tr>
<tr>
<td>标题:</td><td><input class="easyui-validatebox" type="text" name="title" data-options="required:true" required /></td>
</tr>
<tr>
<td>描述:</td><td><textarea name="description" style="height:60px;"></textarea></td>
</tr>
<tr>
<td>排序:</td><td><input type="text" name="banner_order" /></td>
</tr>
<tr>
<td>是否隐藏:</td><td>是<input type="radio" name="is_show" value="1" checked="checked" />&nbsp;&nbsp;否<input type="radio" name="is_show" value="0" /></td>
</tr>
<tr>
<td></td><td><button class="button_link" type="submit">提交</button></td>
</tr>
</table>
<input type="hidden" name="mode" value="banner" />
</form>
</div>
</div>
</div>
</body>
</html>
<script type="text/javascript" src="<?php echo T_TMP; ?>scripts/jquery.validate.js"></script>
<script type="text/javascript">
$("#banner_f").validate({
	rules:{
		title:"required"
	},
	messages:{
		title:""
	}
});
(function() {
	// validate the comment form when it is submitted
	$("#banner_f").validate();
})();
</script>