<?php defined('_EXEC') or die('Restricted access');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>VIEW PHOTO</title>
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>scripts/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>scripts/themes/icon.css">
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>scripts/demo.css">
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>css/style.css">
<script type="text/javascript" src="<?php echo T_TMP; ?>scripts/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo T_TMP; ?>scripts/jquery.easyui.min.js"></script>
</head>
<body>
<div class="article_search">
<div class="photo_album_form">
<form action="view.php?mode=q_photo" method="post" name="photo_scroll_form">
<label>首页显示：</label>
<select name="photo_scroll" onchange="javascript:document.photo_scroll_form.submit();">
<?php
foreach($scroll as $k=>$v){
	if($_SESSION["photo_scroll"] == "$k"){
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
<form action="view.php?mode=q_photo" method="post" name="photo_publish_form">
<select name="photo_publish" onchange="javascript:document.photo_publish_form.submit();">
<?php
foreach($order as $k=>$v){
	if($_SESSION["photo_publish"] == "$k"){
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
if($row_photos == "nothing"){
?>
<div class="no_article">暂无图片！</div>
<?php
} else {
$i = 0;
foreach($row_photos as $k=>$v){
?>
<table>
<tr>
<td width="202">
<a href="modify.php?mode=q_photo&id=<?php echo $v["id"];?>"><img src="../quanfeng/uploads/photo/thumbnail/<?php echo $v["filename"];?>" /></a>
</td>
<td colspan="2">
<div class="f_title2">图片名称： <?php echo $v["title"];?></div>
<div class="f_title2">首页显示： <?php echo $v["scroll"] == 0?"否":"是";?></div>
<div class="f_title2">上传时间： <?php echo $v["publish_time"];?></div>
</td>
</tr>
<tr><td colspan="3"><hr /></td></tr>
<tr>
<td colspan="3" style="margin:0;padding:0 0 10px 0;line-height:30px;border-bottom:1px dashed #666666;">
<div class="f_detail2"><a href="javascript:void(0)" onclick="$('#w<?php echo $i;?>').window('open');show_photo_ajax(<?php echo $i; ?>, '../quanfeng/uploads/photo/<?php echo $v["filename"];?>');">[查看图片]</a></div>
<div class="f_detail"><a href="modify.php?mode=q_photo&id=<?php echo $v["id"];?>" target="_self">[编辑]</a></div>
<div id="show_scroll<?php echo $i;?>" style="float:left;">
<?php
if($v["scroll"]==1){
?>
<div class="f_detail"><a href="javascript:void(0)" onclick="scroll_ajax(<?php echo $i;?>,<?php echo $v["id"];?>, 0)">[关闭首页显示]</a></div>
<?php
} else {
?>
<div class="f_detail2"><a href="javascript:void(0)" onclick="scroll_ajax(<?php echo $i;?>,<?php echo $v["id"];?>, 1)">[开启首页显示]</a></div>
<?php
}
?>
</div>
<div class="f_detail"><a href="delete.php?mode=q_photo&id=<?php echo $v["id"];?>" onclick="return del();" target="_self">[删除该图片]</a></div>
</td>
</tr>
</table>
<div id="w<?php echo $i;?>" class="easyui-window" title="图片名称标题 - <?php echo $v["title"];?>" data-options="closed:true" style="width:600px;height:600px;padding:10px;"></div>
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
	var msg = "确定删除该图片？"; 
	if (confirm(msg)==true){
		return true;
	}else{
		return false; 
	}
}
function scroll_ajax(order, p_id, p_scroll){
	$.ajax({
	   type: "POST",
	   url: "ajax/update_photo_q_scroll.php",
	   data: "id=" + p_id + "&scroll=" + p_scroll + "&order=" + order,
	   success: function(msg){
	   	$("#show_scroll" + order).html(msg)
	   }
	});	
}
function show_photo_ajax(order,psrc){
	$("#w" + order).html("<img src=" + psrc + " />")
}
</script>
