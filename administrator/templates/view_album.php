<?php defined('_EXEC') or die('Restricted access');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>VIEW ALBUM</title>
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>scripts/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>scripts/themes/icon.css">
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>scripts/demo.css">
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>css/style.css">
<script type="text/javascript" src="<?php echo T_TMP; ?>scripts/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo T_TMP; ?>scripts/jquery.easyui.min.js"></script>
</head>
<body>
<div class="article_search">
<div class="article_time_sort">
<form action="view.php?mode=album" method="post" name="album_sort_form">
<label>排序：</label><select name="album_sort" onchange="javascript:document.album_sort_form.submit();">
<?php
foreach($order as $k=>$v){
	if($_SESSION["album_sort"] == "$k"){
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
<div class="article_time_sort">
<form action="view.php?mode=album" method="post" name="album_public_form">
<label>显示：</label><select name="album_public" onchange="javascript:document.album_public_form.submit();">
<?php
foreach($public as $k=>$v){
	if($_SESSION["album_public"] == "$k"){
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
if($row_albums == "nothing"){
?>
<div class="no_article">暂无相册！</div>
<?php
} else {
$i = 0;
foreach($row_albums as $k=>$v){
	$sql = "SELECT * FROM f_photo WHERE album_id = ".$v['id'];
	$photo_num = get_num($sql);
?>
<table>
<tr>
<td width="202">
<a href="modify.php?mode=album&id=<?php echo $v["id"];?>"><img src="../uploads/album/<?php echo $v["filename"];?>" /></a>
</td>
<td colspan="2">
<div class="f_title2">相册名称： <?php echo $v["title"];?></div>
<div class="f_title2">是否公开： <?php echo $v["public"]==1?"是":"否";?></div>
<div class="f_title2">排序： <?php echo $v["album_order"];?></div>
<div class="f_title2">共有 <?php echo $photo_num; ?> 张图片</div>
</td>
</tr>
<tr><td colspan="3"><hr /></td></tr>
<tr>
<td colspan="3" style="margin:0;padding:0 0 10px 0;line-height:30px;border-bottom:1px dashed #666666;">
<div class="f_detail"><a href="modify.php?mode=album&id=<?php echo $v["id"];?>" target="_self">[编辑]</a></div>
<div class="f_detail"><a href="delete.php?mode=album&id=<?php echo $v["id"];?>" onclick="return del();" target="_self">[删除该相册]</a></div>
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
	var msg = "确定删除该相册及相册内所有图片？"; 
	if (confirm(msg)==true){
		return true;
	}else{
		return false; 
	}
}
</script>