<?php defined('_EXEC') or die('Restricted access');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>VIEW PHOTO COMMENT</title>
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>scripts/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>scripts/themes/icon.css">
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>scripts/demo.css">
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>css/style.css">
<script type="text/javascript" src="<?php echo T_TMP; ?>scripts/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo T_TMP; ?>scripts/jquery.easyui.min.js"></script>
</head>
<body>
<div class="view_article_comment_head"><?php echo $row_photo["title"];?> 相关评论： <a href="view.php?mode=photo">返回图片</a></div>
<div class="article_search">
<div class="article_time_sort">
<form action="view.php?mode=photo_comment&id=<?php echo $id;?>" method="post" name="photo_time_sort">
<select name="comment_sort" onchange="javascript:document.photo_time_sort.submit();">
<?php
foreach($order as $k=>$v){
	if($_SESSION["comment_sort"] == "$k"){
?>
<option value="<?php echo $k;?>" selected="selected"><?php echo $v;?></option>
<?php
	} else {
?>
<option value="<?php echo $k;?>"><?php echo $v;?></option>
<?php	
	}
}
?>
</select>
</form>
</div>
</div>
<div class="view_article">
<?php
if($row_comments == "nothing"){
?>
<div class="no_article">暂无该图片评论！</div>
<?php
} else {
$i = 0;
foreach($row_comments as $k=>$v){
?>
<table>
<tr>
<td colspan="2" style="line-height:30px;border-bottom:1px solid #e0e0e0;"><span class="f_title"><?php echo $v["username"];?> 于 <?php echo $v["publish_time"];?> 发表评论：</span></td><td width="400"></td>
</tr>
<tr>
<td colspan="3" style="border-bottom:1px solid #e0e0e0;margin:0;padding:10px 0 10px 0;"><?php echo $v["comment"]; ?></td>
</tr>
<tr>
<td colspan="3" style="margin:0;padding:0 0 10px 0;line-height:30px;border-bottom:1px dashed #666666;" align="right">
<div class="f_detail" style="float:right;"><a href="delete.php?mode=photo_comment&id=<?php echo $v["id"];?>" onclick="return del();" target="_self">[删除该条评论]</a></div>
</td>
</tr>
</table>
<?php
	$i++;
}
}
?>
<div style="width:850px;margin:10px auto;"><div class="f_paginate"><?php echo $page_string;?></div></div>
</div>
</body>
</html>
<script type="text/javascript">
function del() {
	var msg = "确定删除该条评论？"; 
	if (confirm(msg)==true){
		return true;
	}else{
		return false; 
	}
}
</script>