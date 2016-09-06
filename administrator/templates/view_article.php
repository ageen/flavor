<?php defined('_EXEC') or die('Restricted access');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>VIEW ARTICLE</title>
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>scripts/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>scripts/themes/icon.css">
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>scripts/demo.css">
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>css/style.css">
<script type="text/javascript" src="<?php echo T_TMP; ?>scripts/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo T_TMP; ?>scripts/jquery.easyui.min.js"></script>
</head>
<body>
<div class="article_search">
<div class="article_name_search">
<form action="view.php?mode=article" method="post" name="article_name_search">
<label>文章名称搜索:<input type="text" name="article_keywords" value="<?php echo isset($_POST["article_keywords"])?$_POST["article_keywords"]:"";?>" /></label>
<label><button type="submit">搜索</button></label>
</form>
</div>
<div class="article_time_sort">
<form action="view.php?mode=article" method="post" name="article_is_draft">
<label>
<select name="article_draft" onchange="javascript:document.article_is_draft.submit();">
<?php
foreach($draft as $k=>$v){
	if($_SESSION["article_draft"] == "$k"){
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
</label>
</form>
</div>
<div class="article_time_sort">
<form action="view.php?mode=article" method="post" name="article_time_sort">
<select name="article_sort" onchange="javascript:document.article_time_sort.submit();">
<?php
foreach($order as $k=>$v){
	if($_SESSION["article_sort"] == "$k"){
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
if($row_article == "nothing"){
?>
<div class="no_article">暂无文章！</div>
<?php
} else {
$i = 0;
foreach($row_article as $k=>$v){
	$sql = "SELECT * FROM f_article_comment WHERE article_id = " . $v['id'];
	$num_comments = get_num($sql);
?>
<table>
<tr>
<td colspan="3" style="line-height:30px;"><span class="f_title">文章标题:</span>&nbsp;<span class="f_content"><?php echo $v["title"];?></span></td>
</tr>
<tr>
<td colspan="3"><span class="f_title">发布日期:</span>&nbsp;<span class="f_content"><?php echo $v["publish_time"];?></span>&nbsp;&nbsp;&nbsp;&nbsp;<span class="f_title">评论:</span>&nbsp;<span class="f_content"><?php echo $num_comments;?>条</span></td>
</tr>
<tr><td colspan="2"><hr /></td><td></td></tr>
<tr>
<td colspan="3" style="margin:0;padding:0 0 10px 0;line-height:30px;border-bottom:1px dashed #666666;">
<div class="f_detail2"><a href="javascript:void(0)" onclick="$('#w<?php echo $i;?>').window('open');article_ajax('#w<?php echo $i;?>', <?php echo $v["id"];?>)">[查看文章]</a></div>
<div class="f_detail2"><a href="modify.php?mode=article&id=<?php echo $v["id"];?>" target="_self">[编辑文章]</a></div>
<div class="f_detail2"><a href="view.php?mode=article_comment&id=<?php echo $v["id"];?>" target="_self">[查看评论]</a></div>
<div id="show_pub<?php echo $i;?>" style="float:left;">
<?php
if($v["draft"]==0){
?>
<div class="f_detail"><a href="javascript:void(0)" onclick="pub_ajax(<?php echo $i;?>,<?php echo $v["id"];?>, 1)">[转为草稿]</a></div>
<?php
} else {
?>
<div class="f_detail2"><a href="javascript:void(0)" onclick="pub_ajax(<?php echo $i;?>,<?php echo $v["id"];?>, 0)">[正式发布]</a></div>
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
<div class="f_detail"><a href="delete.php?mode=article&id=<?php echo $v["id"];?>" onclick="return del();" target="_self">[删除文章]</a></div>
</td>
</tr>
</table>
<div id="w<?php echo $i;?>" class="easyui-window" title="文章标题 - <?php echo $v["title"];?>" data-options="closed:true" style="width:700px;height:600px;padding:10px;">
</div>
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
function pub_ajax(order, a_id, a_draft){
	$.ajax({
	   type: "GET",
	   url: "pub.php",
	   data: "mode=article&id=" + a_id + "&draft=" + a_draft + "&order=" + order,
	   success: function(msg){
	   	$("#show_pub" + order).html(msg)
	   }
	});
}
function com_ajax(order, a_id, a_com){
	$.ajax({
	   type: "GET",
	   url: "ajax/update_misc_comment.php",
	   data: "mode=article&id=" + a_id + "&comment=" + a_com + "&order=" + order,
	   success: function(msg){
	   	$("#show_com" + order).html(msg)
	   }
	});
}
function article_ajax(show_id, a_id){
	$.ajax({
	   type: "GET",
	   url: "ajax/get_content.php",
	   data: "id=" + a_id,
	   success: function(msg){
	   	$(show_id).html(msg)
	   }
	});	
}
function del() {
	var msg = "确定删除该文章？"; 
	if (confirm(msg)==true){
		return true;
	}else{
		return false; 
	}
}
</script>