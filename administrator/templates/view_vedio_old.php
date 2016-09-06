<?php defined('_EXEC') or die('Restricted access');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>VIEW VEDIO</title>
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>css/style.css">
<script type="text/javascript" src="<?php echo T_TMP; ?>scripts/top_up/top_up-min.js"></script>
<script type="text/javascript">
TopUp.addPresets({
	"#movies": {
		resizable: 0
	}
});
TopUp.players_path = "templates/scripts/players/";
</script>
</head>
<body>
<div class="article_search">
<div class="article_time_sort">
<form action="view.php?mode=vedio" method="post" name="vedio_sort_form">
<label>排序：</label><select name="vedio_order" onchange="javascript:document.vedio_sort_form.submit();">
<?php
foreach($order as $k=>$v){
	if($_SESSION["vedio_order"] == "$k"){
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
<form action="view.php?mode=vedio" method="post" name="vedio_public_form">
<label>视频发布：</label><select name="vedio_public" onchange="javascript:document.vedio_public_form.submit();">
<?php
foreach($public as $k=>$v){
	if($_SESSION["vedio_public"] == "$k"){
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
<form action="view.php?mode=vedio" method="post" name="vedio_recommend_form">
<label>推荐：</label><select name="vedio_recommend" onchange="javascript:document.vedio_recommend_form.submit();">
<?php
foreach($recommend as $k=>$v){
	if(isset($_SESSION["vedio_recommend"])&&$_SESSION["vedio_recommend"] == "$k"){
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
if($row_vedios == "nothing"){
?>
<div class="no_article">暂无视频！</div>
<?php
} else {
$i = 0;
foreach($row_vedios as $k=>$v){
	$sql = "SELECT * FROM f_vedio_comment WHERE vedio_id = ".$v['id'];
	$vedio_comment_num = get_num($sql);
?>
<table>
<tr>
<td width="200">
<div class="vedio_thumb_show">
<a href="http://localhost/flavor/uploads/vedio/<?php echo $v["filename"];?>" toptions="width = 480, height = 480, title = <?php echo $v['title'];?>, layout = quicklook, shaded = 1">
<?php 
if(empty($v["thumbnail"])){
?>
<img src="templates/images/no_thumb.jpg" />
<?php	
} else {
?>
<img src="../uploads/vedio/thumbnail/<?php echo $v["thumbnail"];?>" />
<?php	
}
?>
</a>
</div>
</td>
<td colspan="2">
<div class="f_title2">视频名称： <?php echo $v["title"];?></div>
<div class="f_title2">视频描述： <span style="font-weight:normal;color:#030;font-size:12px;"><?php echo $v["description"]==""?"无描述":$v["description"];?></span></div>
<div class="f_title2">是否公开： <?php echo $v["public"]==1?"是":"否";?></div>
<div class="f_title2">是否推荐： <?php echo $v["recommend"]==1?"是":"否";?></div>
<div class="f_title2">上传时间： <?php echo $v["publish_time"];?></div>
<div class="f_title2">共 <?php echo $vedio_comment_num;?> 条评论</div>
</td>
</tr>
<tr><td colspan="3"><hr /></td></tr>
<tr>
<td colspan="3" style="margin:0;padding:0 0 10px 0;line-height:30px;border-bottom:1px dashed #666666;">
<div class="f_detail2"><a href="modify.php?mode=vedio&id=<?php echo $v["id"];?>" target="_self">[编辑视频]</a></div>
<div class="f_detail2"><a href="view.php?mode=vedio_comment&id=<?php echo $v["id"];?>" target="_self">[查看评论]</a></div>
<div id="show_pub<?php echo $i;?>" style="float:left;">
<?php
if($v["public"]==0){
?>
<div class="f_detail2"><a href="javascript:void(0)" onclick="pub_ajax(<?php echo $i;?>,<?php echo $v["id"];?>, 1)">[发布视频]</a></div>
<?php
} else {
?>
<div class="f_detail"><a href="javascript:void(0)" onclick="pub_ajax(<?php echo $i;?>,<?php echo $v["id"];?>, 0)">[取消发布]</a></div>
<?php
}
?>
</div>
<div id="show_recommend<?php echo $i;?>" style="float:left;">
<?php
if($v["recommend"]==0){
?>
<div class="f_detail2"><a href="javascript:void(0)" onclick="recommend_ajax(<?php echo $i;?>,<?php echo $v["id"];?>, 1)">[推荐视频]</a></div>
<?php
} else {
?>
<div class="f_detail"><a href="javascript:void(0)" onclick="recommend_ajax(<?php echo $i;?>,<?php echo $v["id"];?>, 0)">[取消推荐]</a></div>
<?php
}
?>
</div>
<div id="show_com<?php echo $i;?>" style="float:left;">
<?php
if($v["comment"]==1){
?>
<div class="f_detail"><a href="javascript:void(0)" onclick="com_ajax(<?php echo $i;?>,<?php echo $v["id"];?>, 0)">[禁止评论]</a></div>
<?php
} else {
?>
<div class="f_detail2"><a href="javascript:void(0)" onclick="com_ajax(<?php echo $i;?>,<?php echo $v["id"];?>, 1)">[开启评论]</a></div>
<?php
}
?>
</div>
<div class="f_detail"><a href="delete.php?mode=vedio&id=<?php echo $v["id"];?>" onclick="return del();" target="_self">[删除视频]</a></div>
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
	var msg = "确定删除该视频？"; 
	if (confirm(msg)==true){
		return true;
	}else{
		return false; 
	}
}
function pub_ajax(order, v_id, v_public){
	$.ajax({
	   type: "GET",
	   url: "pub.php",
	   data: "mode=vedio&id=" + v_id + "&public=" + v_public + "&order=" + order,
	   success: function(msg){
	   	$("#show_pub" + order).html(msg)
	   }
	});
}
function recommend_ajax(order, v_id, v_recommend){
	$.ajax({
	   type: "POST",
	   url: "ajax/update_vedio_recommend.php",
	   data: "id=" + v_id + "&recommend=" + v_recommend + "&order=" + order,
	   success: function(msg){
	   	$("#show_recommend" + order).html(msg)
	   }
	});	
}
function com_ajax(order, v_id, v_com){
	$.ajax({
	   type: "GET",
	   url: "ajax/update_misc_comment.php",
	   data: "mode=vedio&id=" + v_id + "&comment=" + v_com + "&order=" + order,
	   success: function(msg){
	   	$("#show_com" + order).html(msg)
	   }
	});
}
</script>