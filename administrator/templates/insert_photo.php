<?php defined('_EXEC') or die('Restricted access');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>INSERT PHOTO</title>
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>scripts/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>scripts/themes/icon.css">
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>scripts/demo.css">
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>css/style.css">
<script type="text/javascript" src="<?php echo T_TMP; ?>scripts/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo T_TMP; ?>scripts/easyloader.js"></script>
</head>
<body>
<div class="banner_form">
<div class="easyui-panel" title="新增图片" style="width:750px;">
<div style="padding:10px 0 10px 60px">
<?php
if($row_albums == "nothing"){
?>
<div class="no_article">暂无相册！&nbsp;<a href="insert.php?mode=album">新建相册</a></div>
<?php		
} else {
?>
<form action="save.php?mode=photo" name="photo_f" id="photo_f" method="post" enctype="multipart/form-data">
<table>
<tr>
<td>选择图片文件:</td><td width="550"><input type="file" name="photo" />&nbsp;</td>
</tr>
<tr>
<td colspan="2"><hr /></td>
</tr>
<tr>
<td>选择相册:</td>
<td>
<select name="album_id">
<?php
foreach($row_albums as $k=>$v){
?>
<option value="<?php echo $v['id'];?>"><?php echo $v['title'];?></option>
<?php	
}
?>
</select>
</td>
</tr>
<tr>
<td>图片名称:</td><td><input class="easyui-validatebox" name="title" type="text" data-options="required:true" required /></td>
</tr>
<tr>
<td>描述:</td><td><textarea name="description" style="height:60px;"></textarea></td>
</tr>
<tr>
<td>允许评论:</td><td>是<input type="radio" name="comment" value="1" checked="checked" />&nbsp;&nbsp;否<input type="radio" name="comment" value="0" /></td>
</tr>
<tr>
<td>首页滚动栏:</td><td>是<input type="radio" name="scroll" value="1" checked="checked" />&nbsp;&nbsp;否<input type="radio" name="scroll" value="0" checked="checked" /></td>
</tr>
<tr>
<td></td><td><button class="button_link" type="submit">提交</button></td>
</tr>
</table>
<input type="hidden" name="publish_time" value="<?php echo date("Y-m-d H:i:s");?>" />
<input type="hidden" name="mode" value="photo" />
</form>
<?php	
}
?>
</div>
</div>
</div>
</body>
</html>
<script type="text/javascript" src="<?php echo T_TMP; ?>scripts/jquery.validate.js"></script>
<script type="text/javascript">
$("#photo_f").validate({
	rules:{
		title:"required"
	},
	messages:{
		title:""
	}
});
(function() {
	// validate the comment form when it is submitted
	$("#photo_f").validate();
})();
</script>