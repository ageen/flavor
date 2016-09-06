<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>文章列表 - <?php echo WEBPAGE_TITLE_SUFFIX;?></title>
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
<span class="f_crumbs_link"><a href="index.php">首页</a></span> &gt; <span class="f_crumbs_link"><a href="view.php?mode=article">文章列表</a></span>
</div>
<!--ARTICLE LIST-->
<?php 
if($row_articles == "nothing"){
?>
<div class="no_article">暂无文章！</div>
<?php
} else {
	foreach($row_articles as $k=>$v){
		$sql = "SELECT * FROM f_article_comment WHERE article_id = ".$v["id"];
		$comment_num = get_num($sql);
?>
<div class="article_list">
<div class="article_list_bar">
<div class="article_list_title"><a href="detail.php?mode=article&id=<?php echo $v["id"];?>"><?php echo $v["title"];?></a></div>
<div class="article_list_content"><?php echo csubstr(HtmToText($v["content"]), 120, "...");?></div>
<div class="article_list_footer"><span class="article_list_link"><?php echo $v["publish_time"];?></span><span class="article_list_link"><a href="detail.php?mode=article&id=<?php echo $v["id"];?>">查看全文</a></span>
<?php
if($v["comment"] == 1){
?>
<span class="article_list_link"><a href="view.php?mode=article_comment&id=<?php echo $v["id"];?>">评论(<?php echo $comment_num;?>)</a></span>
<?php
}
?>
</div>
</div>
</div>
<?php
	}
?>
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