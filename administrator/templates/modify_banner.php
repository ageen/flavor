<?php defined('_EXEC') or die('Restricted access');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>UPDATE BANNER</title>
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>scripts/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>scripts/themes/icon.css">
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>scripts/demo.css">
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>css/style.css">
<script type="text/javascript" src="<?php echo T_TMP; ?>scripts/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo T_TMP; ?>scripts/easyloader.js"></script>
</head>
<body>
<div class="article_form">
<div class="easyui-panel" title="更新BANNER信息" style="width:850px; height:550px;">
<div style="padding:0;margin:0;color:#666666;" id="show_banner_form">
<form name="banner_f" id="banner_f" method="post" onsubmit="return false;">
<table style="margin:10px auto;">
<tr>
<td align="center"><img src="../uploads/banner/thumbnail/<?php echo $row_banner["filename"];?>" /></td>
</tr>
<tr>
<td>BANNER名称: <input class="easyui-validatebox" type="text" name="title" id="title" value="<?php echo $row_banner["title"];?>" data-options="required:true" required /></td>
</tr>
<tr>
<td>BANNER描述: <textarea name="description" rows="8" cols="20"><?php echo $row_banner["description"];?></textarea></td>
</tr>
<tr>
<td style="height:25px;">首页显示: 是<input type="radio" name="is_show" value="1" <?php echo $row_banner["is_show"]==1?"checked='checked'":'';?> />&nbsp;&nbsp;否<input type="radio" name="is_show" value="0" <?php echo $row_banner["is_show"]==0?"checked='checked'":'';?> /></td>
</tr>
<tr>
<td style="height:20px;">排序: <input type="text" name="banner_order" value="<?php echo $row_banner["banner_order"];?>" /></td>
</tr>
<tr>
<td align="center"><button class="button_link" type="button" onclick="check_form();">保存</button>&nbsp;&nbsp;<button class="button_link" type="button" onclick="javascript:history.back();">返回</button></td>
</tr>
</table>
<input type="hidden" name="id" value="<?php echo $row_banner["id"];?>" />
</form>
</div>
</div>
</div>
</body>
</html>
<script type="text/javascript" src="<?php echo T_TMP; ?>scripts/jquery.ajax.upload.js"></script>
<script type="text/javascript">
function check_form(){
	if(document.getElementById("title").value == ""){
		alert("请输入图片名称！");
		return false;
	}
	ajax_post();
}
function ajax_post(){
	$.ajax({
	  	type: "POST",
	  	url: "ajax/update_banner.php",
		data: $("#banner_f").serialize(),
		success: function(msg){
			alert("更新成功！")
	   		$("#show_banner_form").html(msg)
		}
	});
}
</script>