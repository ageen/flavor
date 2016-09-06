<?php defined('_EXEC') or die('Restricted access');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>INSERT ARTICLE</title>
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>scripts/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>scripts/themes/icon.css">
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>scripts/demo.css">
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>css/style.css">
<script type="text/javascript" src="<?php echo T_TMP; ?>scripts/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo T_TMP; ?>scripts/easyloader.js"></script>
<script type="text/javascript">
window.UEDITOR_HOME_URL ="http://www.smallcell.me/administrator/templates/scripts/ueditor/";
</script>
<script type="text/javascript" src="<?php echo T_TMP; ?>scripts/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="<?php echo T_TMP; ?>scripts/ueditor/ueditor.all.js"></script> 
</head>
<body>
<div class="article_form">
<div class="easyui-panel" title="新增文章" style="width:850px;">
<div style="padding:0; margin:0;">
<form action="save.php?mode=article" name="article_f" id="article_f" method="post">
<table style="margin:0 auto;">
<tr>
<td>文章标题: <input class="easyui-validatebox" type="text" name="title" size="60" data-options="required:true" required />&nbsp;</td>
</tr>
<tr>
<td>
<textarea id="myEditor" name="content"></textarea>
</td>
</tr>
<tr>
<td>存为草稿: 是<input type="radio" name="draft" value="1" />&nbsp;&nbsp;否<input type="radio" name="draft" value="0" checked="checked" /></td>
</tr>
<tr>
<td>
允许评论: 是<input type="radio" name="comment" value="1" checked="checked" />&nbsp;&nbsp;否<input type="radio" name="comment" value="0" />&nbsp;&nbsp;&nbsp;&nbsp;
发布日期： <input type="text" name="publish_time" class="easyui-datetimebox" size="23" value="<?php echo date("Y-m-d H:i:s");?>" />
</td>
</tr>
<tr>
<td align="center"><button class="button_link" type="submit">新增</button>&nbsp;&nbsp;<button class="button_link" type="button" onclick="history.back();">返回</button></td>
</tr>
</table>
<input type="hidden" name="mode" value="article" />
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
		title:"required"
	},
	messages:{
		title:""
	}
});
(function() {
	// validate the comment form when it is submitted
	$("#article_f").validate();
})();

var editor = new UE.ui.Editor();
	editor.render("myEditor");
    //1.2.4以后可以使用一下代码实例化编辑器
    //UE.getEditor('myEditor')
</script>