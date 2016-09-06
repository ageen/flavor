<?php defined('_EXEC') or die('Restricted access');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>INSERT WI</title>
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>scripts/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>scripts/themes/icon.css">
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>scripts/demo.css">
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>css/style.css">
<script type="text/javascript" src="<?php echo T_TMP; ?>scripts/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo T_TMP; ?>scripts/easyloader.js"></script>
</head>
<body>
<div class="banner_form">
<div class="easyui-panel" title="新增微薄代码" style="width:750px;">
<div style="padding:10px 0 10px 60px">
<form name="banner_f" id="banner_f">
<table style="float:left;">
<tr>
<td colspan="2" style="border-right:1px solid #e0e0e0;padding-right:10px;"><textarea cols="20" rows="10" name="code" id="wi_code"><?php echo $row_wi == "nothing"?"":$row_wi["code"];?></textarea></td>
</tr>
<tr>
<td></td><td><button class="button_link" onclick="check_submit();" type="button">提交</button></td>
</tr>
</table>
</form>
</div>
<div id="show_wi" style="margin:0 0 0 10px;float:left;width:362px;"><?php echo $row_wi == "nothing"?"":$row_wi["code"];?></div>
</div>
</div>
</body>
</html>
<script type="text/javascript" src="<?php echo T_TMP; ?>scripts/jquery.validate.js"></script>
<script type="text/javascript">
function check_submit(){
	if(document.getElementById("wi_code").value == ""){
		alert("请输入微薄调用代码！");
		return false;
	} else {
		ajax_wi();	
	}
}
function ajax_wi(){
	$.ajax({
		   type: "POST",
		   url: "ajax_wi.php",
		   data: $("#banner_f").serialize(),
		   success: function(msg){
			 $("#show_wi").html(msg);
		   }
	});
}
</script>