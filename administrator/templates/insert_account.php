<?php defined('_EXEC') or die('Restricted access');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>INSERT ACCOUNT</title>
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>scripts/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>scripts/themes/icon.css">
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>scripts/demo.css">
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>css/style.css">
<script type="text/javascript" src="<?php echo T_TMP; ?>scripts/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo T_TMP; ?>scripts/easyloader.js"></script>
</head>
<body>
<div class="article_form">
<div class="easyui-panel" title="新建帐号" style="width:500px;">
<div style="padding:0; margin:0;">
<form action="save.php?mode=account" name="account_f" id="account_f" method="post">
<table style="margin:10px auto;">
<tr>
<td>登录名称: <input class="easyui-validatebox" type="text" id="username" name="username" size="50" data-options="required:true" required /></td>
</tr>
<tr>
<td>登录密码: <input class="easyui-validatebox" type="password" name="password" size="50" data-options="required:true" required /></td>
</tr>
<tr>
<td>是否启用: 是<input type="radio" name="disable" value="0" checked="checked" />&nbsp;&nbsp;否<input type="radio" name="disable" value="1" /></td>
</tr>
<tr>
<td align="center"><button class="button_link" type="submit" onclick="return check_form();">提交</button></td>
</tr>
</table>
<input type="hidden" name="mode" value="account" />
<input type="hidden" name="create_time" value="<?php echo date("Y-m-d H:i:s");?>" />
</form>
</div>
</div>
</div>
</body>
</html>
<script type="text/javascript" src="<?php echo T_TMP; ?>scripts/jquery.validate.js"></script>
<script type="text/javascript">
$("#account_f").validate({
	rules:{
		username:"required",
		password:"required"
	},
	messages:{
		username:"",
		password:""
	}
});
(function() {
	// validate the comment form when it is submitted
	$("#account_f").validate();
})();
</script>