<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>相册列表 - <?php echo WEBPAGE_TITLE_SUFFIX;?></title>
<link href="<?php echo TEMPATH; ?>css/style.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo TEMPATH; ?>scripts/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo TEMPATH; ?>scripts/jquery.lazyload.min.js"></script>
<script type="text/javascript" src="<?php echo TEMPATH; ?>scripts/init.js"></script>
<script type="text/javascript">
$(function() {
	$("img.lazy").lazyload({ 
    	effect : "fadeIn",
		threshold :200,
		failure_limit : 10
	});
});
</script>
</head>
<body>
<!--TOP-->
<?php
require_once("top.php");
?>
<!--BODY-->
<div class="f_frame">
<div class="f_crumbs">
<span class="f_crumbs_link"><a href="index.php">首页</a></span> &gt; <span class="f_crumbs_link"><a>相册列表</a></span>
</div>
<!--vedio LIST-->
<div style="height:20px;"></div>
<?php 
if($row_albums == "nothing"){
?>
<div class="no_article">暂无相册！</div>
<?php
} else {
	$i=1;
	foreach($row_albums as $k=>$v){
		$sql = "SELECT * FROM f_photo WHERE album_id = " . $v["id"];
		$photo_num = get_num($sql);
?>
<div class="list_album">
<?php
		if($v["public"]==1){
?>
<div class="list_album_border1">
<div style="width:200px;height:200px; overflow:hidden;"><a href="view.php?mode=photo&id=<?php echo $v["id"];?>"><img class="lazy" src="<?php echo TEMPATH; ?>images/lightblue.gif" data-original="uploads/album/<?php echo $v["filename"];?>" /></a></div>
</div>
<div class="list_album_border2"></div>
<div class="list_album_title"><a href="view.php?mode=photo&id=<?php echo $v["id"];?>" title="<?php echo $v["title"];?>"><?php echo csubstr($v["title"],10);?></a>(共<?php echo $photo_num;?>张图片)</div>
<?php
		} else {
			if(isset($_SESSION["auth_album"])&&in_array($v["id"], $_SESSION["auth_album"])){
?>
<div class="list_album_border1">
<div style="width:200px;height:200px; overflow:hidden;"><a href="view.php?mode=photo&id=<?php echo $v["id"];?>"><img class="lazy" src="<?php echo TEMPATH; ?>images/lightblue.gif" data-original="uploads/album/<?php echo $v["filename"];?>" /></a></div>
</div>
<div class="list_album_border2"></div>
<div class="list_album_title"><a href="view.php?mode=photo&id=<?php echo $v["id"];?>" title="<?php echo $v["title"];?>"><?php echo csubstr($v["title"],10);?></a>(共<?php echo $photo_num;?>张图片)</div>
<?php
			} else {
?>
<div class="list_album_border1">
<div style="width:200px;height:200px;overflow:hidden;filter:alpha(opacity=30);opacity:0.3;"><img class="lazy" src="<?php echo TEMPATH; ?>images/lightblue.gif" data-original="uploads/album/<?php echo $v["filename"];?>" /></div>
<div class="list_album_lock"><a onClick="show_form(<?php echo $i;?>, <?php echo $v["id"];?>)"><img class="lazy" src="<?php echo TEMPATH; ?>images/lightblue.gif" data-original="<?php echo TEMPATH; ?>images/lock.png" style="cursor:pointer;"></a></div>
<div id="list_album_password<?php echo $i;?>"></div>
</div>
<div class="list_album_border2"></div>
<div class="list_album_title"><a href="javascript:return false;" onClick="show_form(<?php echo $i;?>, <?php echo $v["id"];?>)" title="<?php echo $v["title"];?>"><?php echo csubstr($v["title"],10);?></a></div>
<?php
			}
		}
?>
</div>
<?php
		$i++;
	}
?>
<div style="clear:both"></div>
<div class="f_paginate"><?php echo $page_string;?></div>
<?php
}
?>
<div style="clear:both;"></div>
<?php
require_once("footer.php");
?>
<!--END BODY-->
</body>
</html>
<script type="text/javascript">
function show_form(order,id){
	$("#list_album_password"+order).html('<div class="list_album_password"><form method="post" id="pass_form'+order+'" onsubmit="return false;"><label>请输入密码：<input name="password" type="password" id="password'+order+'" /></label><div class="list_album_password_button"><button onclick="ajax_album_pass('+order+','+id+')">确认</button>&nbsp;<button type="button" onclick="hidden_form('+order+')">取消</button><input type="hidden" name="id" value="'+id+'" /></div></form></div>');
}
function hidden_form(order){
	$("#list_album_password"+order).html("");
}
function ajax_album_pass(order, id){
	if($("#password"+order).val()==""){
		alert("请输入密码！");	
	}else{
		$.ajax({
			   type: "POST",
			   url: "ajax/album_pass.php",
			   data: $("#pass_form"+order).serialize(),
			   success: function(msg){
				   if(msg == "error"){
					   alert(msg);
					} else if(msg == "fail"){
						alert("密码错误！");
					} else if(msg == "success"){
						window.location.href="view.php?mode=photo&id=" + id;
					}
			   }
		});
	}
}
</script>