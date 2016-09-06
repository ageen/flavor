<?php defined('_EXEC') or die('Restricted access');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>VIEW BANNER</title>
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
<form action="view.php?mode=banner" method="post" name="banner_order">
<label>排序：</label>
<select name="banner_order_value" onchange="javascript:document.banner_order.submit();">
<?php
foreach($order as $k=>$v){
	if($_SESSION["banner_order_value"] == "$k"){
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
<form action="view.php?mode=banner" method="post" name="banner_show_form">
<label>显示：</label>
<select name="banner_show" onchange="javascript:document.banner_show_form.submit();">
<?php
foreach($display as $k=>$v){
	if($_SESSION["banner_show"] == "$k"){
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
if($row_banners == "nothing"){
?>
<div class="no_article">暂无BANNER！</div>
<?php
} else {
$i = 0;
foreach($row_banners as $k=>$v){
?>
<table>
<tr>
<td width="202">
<a href="modify.php?mode=banner&id=<?php echo $v["id"];?>"><img src="../uploads/banner/thumbnail/<?php echo $v["filename"];?>" /></a>
</td>
<td colspan="2">
<div class="f_title2">BANNER名称： <?php echo $v["title"];?></div>
<div class="f_title2">BANNER描述： <?php echo $v["description"] == ""?"无描述":$v["description"];?></div>
<div class="f_title2">首页显示： <?php echo $v["is_show"] == 0?"否":"是";?></div>
<div class="f_title2">排序： <?php echo $v["banner_order"];?></div>
</td>
</tr>
<tr><td colspan="3"><hr /></td></tr>
<tr>
<td colspan="3" style="margin:0;padding:0 0 10px 0;line-height:30px;border-bottom:1px dashed #666666;">
<div class="f_detail2"><a href="javascript:void(0)" onclick="$('#w<?php echo $i;?>').window('open');show_banner_ajax(<?php echo $i; ?>, '../uploads/banner/<?php echo $v["filename"];?>');">[查看]</a></div>
<div class="f_detail"><a href="modify.php?mode=banner&id=<?php echo $v["id"];?>" target="_self">[编辑]</a></div>
<div id="is_show<?php echo $i;?>" style="float:left;">
<?php
if($v["is_show"]==1){
?>
<div class="f_detail"><a href="javascript:void(0)" onclick="is_show_ajax(<?php echo $i;?>,<?php echo $v["id"];?>, 0)">[关闭显示]</a></div>
<?php
} else {
?>
<div class="f_detail2"><a href="javascript:void(0)" onclick="is_show_ajax(<?php echo $i;?>,<?php echo $v["id"];?>, 1)">[开启显示]</a></div>
<?php
}
?>
</div>
<div class="f_detail"><a href="delete.php?mode=banner&id=<?php echo $v["id"];?>" onclick="return del();" target="_self">[删除该BANNER]</a></div>
</td>
</tr>
</table>
<div id="w<?php echo $i;?>" class="easyui-window" title="BANNER名称 - <?php echo $v["title"];?>" data-options="closed:true" style="width:600px;height:600px;padding:10px;"></div>
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
	var msg = "确定删除该BANNER？"; 
	if (confirm(msg)==true){
		return true;
	}else{
		return false; 
	}
}
function is_show_ajax(order, b_id, is_show_value){
	$.ajax({
	   type: "POST",
	   url: "ajax/update_banner_is_show.php",
	   data: "id=" + b_id + "&is_show=" + is_show_value + "&order=" + order,
	   success: function(msg){
	   	$("#is_show" + order).html(msg)
	   }
	});	
}
function show_banner_ajax(order,psrc){
	$("#w" + order).html("<img src=" + psrc + " />")
}
</script>