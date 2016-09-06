<?php defined('_EXEC') or die('Restricted access');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>VIEW LINK</title>
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
<form action="view.php?mode=link" method="post" name="link_sort_form">
<label>排序：</label><select name="link_sort" onchange="javascript:document.link_sort_form.submit();">
<?php
foreach($order as $k=>$v){
	if($_SESSION["link_sort"] == "$k"){
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
<form action="view.php?mode=link" method="post" name="link_display_form">
<label>显示：</label><select name="link_display" onchange="javascript:document.link_display_form.submit();">
<?php
foreach($display as $k=>$v){
	if($_SESSION["link_display"] == "$k"){
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
if($row_links == "nothing"){
?>
<div class="no_article">暂无信息！</div>
<?php
} else {
$i = 0;
foreach($row_links as $k=>$v){
?>
<table>
<tr>
<td width="100">
<a href="<?php echo $v["url"];?>" target="_blank"><img src="../uploads/logo/<?php echo $v["filename"];?>" /></a>
</td>
<td colspan="2">
<div class="f_title2">网站标题： <?php echo $v["title"];?></div>
<div class="f_title2">网站地址： <a href="<?php echo $v["url"];?>" target="_blank"><?php echo $v["url"];?></a></div>
<div class="f_title2">排序： <?php echo $v["link_order"];?></a></div>
</td>
</tr>
<tr><td colspan="3"><hr /></td></tr>
<tr>
<td colspan="3" style="margin:0;padding:0 0 10px 0;line-height:30px;border-bottom:1px dashed #666666;">
<div class="f_detail"><a href="modify.php?mode=link&id=<?php echo $v["id"];?>" target="_self">[编辑]</a></div>
<div id="show_com<?php echo $i;?>" style="float:left;">
<?php
if($v["selected"]==1){
?>
<div class="f_detail"><a href="javascript:void(0)" onclick="select_ajax(<?php echo $i;?>,<?php echo $v["id"];?>, 0)">[关闭显示]</a></div>
<?php
} else {
?>
<div class="f_detail2"><a href="javascript:void(0)" onclick="select_ajax(<?php echo $i;?>,<?php echo $v["id"];?>, 1)">[开启显示]</a></div>
<?php
}
?>
</div>
<div class="f_detail"><a href="delete.php?mode=link&id=<?php echo $v["id"];?>" onclick="return del();" target="_self">[删除链接]</a></div>
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
	var msg = "确定删除该链接？"; 
	if (confirm(msg)==true){
		return true;
	}else{
		return false;
	}
}
function select_ajax(order, p_id, a_select){
	$.ajax({
	   type: "POST",
	   url: "ajax/update_link_select.php",
	   data: "id=" + p_id + "&selected=" + a_select + "&order=" + order,
	   success: function(msg){
	   	$("#show_com" + order).html(msg)
	   }
	});
}
</script>