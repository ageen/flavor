<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>图片列表 - <?php echo WEBPAGE_TITLE_SUFFIX;?></title>
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
<span class="f_crumbs_link"><a href="index.php">首页</a></span> &gt; <span class="f_crumbs_link"><a href="view.php?mode=album">相册列表</a></span> &gt; <span class="f_crumbs_link"><a><?php echo $row_album["title"];?></a></span>
</div>
<!--album detail-->
<div class="album_detail">
<div class="album_detail_thumb">
<div class="album_detail_thumb_border1"><img class="lazy" src="<?php echo TEMPATH; ?>images/lightblue.gif" data-original="uploads/album/<?php echo $row_album["filename"];?>" width="100" /></div>
<div class="album_detail_thumb_border2"></div>
</div>
<div class="album_detail_right">
<div class="album_detail_title"><span style="color:#AFB52F;font-weight:normal;">相册名称：</span><?php echo $row_album["title"];?></div>
<div class="album_detail_date">创建时间：<?php echo $row_album["create_time"];?></div>
</div>
</div>
<!--photo LIST-->
<div style="height:15px;clear:both;"></div>
<?php 
if($row_photos == "nothing"){
?>
<div class="no_article">暂无图片！</div>
<div style="height:10px;"></div>
<?php
} else {
	$i=1;
	foreach($row_photos as $k=>$v){
//		$sql = "SELECT * FROM f_photo_comment WHERE photo_id = " . $v["id"];
?>
<div class="list_photo_item">
<div class="list_photo_border"><a href="detail.php?mode=photo&id=<?php echo $v["id"];?>"><img class="lazy" src="<?php echo TEMPATH; ?>images/lightblue.gif" data-original="uploads/photo/thumbnail/<?php echo $v["filename"];?>" /></a></div>
<div class="list_photo_title"><a href="detail.php?mode=photo&id=<?php echo $v["id"];?>"><?php echo $v["title"];?></a></div>
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
function ajax_album_pass(order){
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
					} else{
						alert(msg);
					}
			   }
		});
	}
}
</script>