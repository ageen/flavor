<?php defined('_EXEC') or die('Restricted access');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>INSERT LINK</title>
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>scripts/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>scripts/themes/icon.css">
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>scripts/demo.css">
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>css/style.css">
<script type="text/javascript" src="<?php echo T_TMP; ?>scripts/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo T_TMP; ?>scripts/easyloader.js"></script>
</head>
<body>
<div class="article_form">
<div class="easyui-panel" title="新增友情链接" style="width:850px;">
<div style="padding:0; margin:0;">
<form action="save.php?mode=link" name="article_f" id="article_f" method="post" enctype="multipart/form-data">
<table style="margin:0 auto;">
<tr>
<td>网站名称: <input class="easyui-validatebox" type="text" name="title" size="50" data-options="required:true" required /></td>
</tr>
<tr>
<td>网站链接: <input class="easyui-validatebox" type="text" name="url" size="50" data-options="required:true,validType:'url'" required /></td>
</tr>
<tr>
<td>是否显示: 是<input type="radio" name="selected" value="1" checked="checked" />&nbsp;&nbsp;否<input type="radio" name="selected" value="0" /></td>
</tr>
<tr>
<td>顺序: <input type="text" name="link_order" value="0" /></td>
</tr>
<tr>
<td>网站图标: <input class="easyui-validatebox" type="file" name="logo" style="border:1px solid #e0e0e0;" /><span class="show_tip">图标宽高 1:1(>=90像素)</span></td>
</tr>
<tr>
<td align="center"><button class="button_link" type="submit">提交</button></td>
</tr>
</table>
<input type="hidden" name="mode" value="link" />
</form>
</div>
</div>
</div>
</body>
</html>
<script type="text/javascript" src="<?php echo T_TMP; ?>scripts/jquery.validate.js"></script>
<script type="text/javascript">
$("#article_f").validate({
	rules:{
		title:"required",
		url:"required"
	},
	messages:{
		title:"",
		url:""
	}
});
(function() {
	// validate the comment form when it is submitted
	$("#article_f").validate();
})();
</script>