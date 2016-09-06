<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>视频列表 - <?php echo WEBPAGE_TITLE_SUFFIX;?></title>
<link href="<?php echo TEMPATH; ?>css/style.css" type="text/css" rel="stylesheet" />
<link href="<?php echo TEMPATH; ?>css/jquery.ad-gallery.css" type="text/css" rel="stylesheet" />
<link href="<?php echo TEMPATH; ?>css/jsCarousel.css" type="text/css" rel="stylesheet" />
<link href="<?php echo TEMPATH; ?>css/jquery.lightbox-0.5.css" type="text/css" rel="stylesheet" />
<link href="<?php echo TEMPATH; ?>css/jPaginate.css" type="text/css" rel="stylesheet" />
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
<span class="f_crumbs_link"><a href="index.php">首页</a></span> &gt; <span class="f_crumbs_link"><a href="view.php?mode=vedio">视频列表</a></span>
</div>
<!--vedio LIST-->
<div style="height:20px;"></div>
<?php 
if($row_vedios == "nothing"){
?>
<div class="no_article">暂无视频！</div>
<?php
} else {
	foreach($row_vedios as $k=>$v){
		$sql = "SELECT * FROM f_vedio_comment WHERE vedio_id = ".$v["id"];
		$comment_num = get_num($sql);
?>
<div class="vedio_list">
<div class="vedio_list_thumb"><a href="detail.php?mode=vedio&id=<?php echo $v["id"];?>" title="<?php echo $v["title"];?>"><img class="lazy" src="<?php echo TEMPATH; ?>images/lightblue.gif" data-original="uploads/vedio/thumbnail/<?php echo $v["thumbnail"];?>" height="200" width="200" /></a></div>
<div class="vedio_list_right">
<div class="vedio_list_title"><a href="detail.php?mode=vedio&id=<?php echo $v["id"];?>"><?php echo $v["title"];?></a></div>
<div class="vedio_list_description"><?php echo $v["description"]==""?"无视频简介":$v["description"];?></div>
<div class="vedio_list_publish">发布日期：<?php echo $v["publish_time"];?></div>
<?php
if($v["comment"] == 1){
?>
<div class="vedio_list_bar"><a href="view.php?mode=vedio_comment&id=<?php echo $v["id"];?>">共<?php echo $comment_num;?>条评论</a></div>
<?php
}
?>
</div>
</div>
<?php
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