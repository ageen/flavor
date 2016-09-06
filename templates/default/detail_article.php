<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $row_article=="nothing"?"无该文章":$row_article["title"];?> - <?php echo WEBPAGE_TITLE_SUFFIX;?></title>
<link href="<?php echo TEMPATH; ?>css/style.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo TEMPATH; ?>scripts/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo TEMPATH; ?>scripts/jquery.lazyload.min.js"></script>
<script type="text/javascript" src="<?php echo TEMPATH; ?>scripts/init.js"></script>
<script type="text/javascript">
$(function() {
	$("img.lazy").lazyload({ 
    	effect : "fadeIn",
		threshold : 100
	});
	$("#verify_code").click(function(){
		$(this).attr("src","verify.php?t=admin&g="+Math.random());
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
<span class="f_crumbs_link"><a href="index.php">首页</a></span> &gt; <span class="f_crumbs_link"><a href="view.php?mode=article">文章列表</a></span> &gt; <span class="f_crumbs_link"><a title="<?php echo $row_article["title"];?>"><?php echo $row_article=="nothing"?"无该文章":csubstr($row_article["title"], 18);?></a></span>
</div>
<!--ARTICLE DETAIL-->
<?php
if($row_article=="nothing"){
?>
<div class="no_article">无该文章信息！</div>
<?php
} else {
?>
<div class="article_show">
<div class="article_show_title"><h4><?php echo $row_article["title"];?></h4></div>
<div class="article_show_info">
<span class="article_show_info_time">发布时间:<?php echo $row_article["publish_time"];?></span>
</div>
<div class="article_show_contain">
<?php echo $row_article["content"];?>
</div>
<div style="clear:both;"></div>
<div class="vedio_show_footer">
<?php
if($row_article_pre=="nothing"){
?>
<div class="vedio_show_previous">没有了！</div>
<?php
} else {
?>
<div class="vedio_show_previous">上一篇文章：<a href="detail.php?mode=article&id=<?php echo $row_article_pre["id"];?>"><?php echo $row_article_pre["title"];?></a></div>
<?php
}
?>
<?php
if($row_article_next=="nothing"){
?>
<div class="vedio_show_next">没有了！</div>
<?php
} else {
?>
<div class="vedio_show_next">下一篇文章：<a href="detail.php?mode=article&id=<?php echo $row_article_next["id"];?>"><?php echo $row_article_next["title"];?></a></div>
<?php
}
?>
</div>
</div>
<?php
if($row_article["comment"] == 1){
?>
<div class="comment">
<div class="comment_title">文章评论</div>
<!--ajax show comments-->
<div id="show_comment">
<div class="comment_contain">
<?php
if($row_comments == "nothing"){
?>
<div class="no_comment">暂无评论！</div>
<?php	
} else {
	$i = 1;
	foreach($row_comments as $k=>$v){
?>
<div class="comment_content">
<div class="comment_content_title" style="margin-left:10px;"><span style="font-weight:bold;"><?php echo $i; ?>.</span>&nbsp;&nbsp;<?php echo $v["username"];?> 于 <?php echo $v["publish_time"];?> 发表评论 </div>
<div class="comment_content_text">
<?php
	echo $v["comment"];
?>
</div>
</div>
<div style="clear:both"></div>
<?php
		$i++;
	}
}
?>
</div>
<div class="comment_more"><a href="view.php?mode=article_comment&id=<?php echo $row_article["id"];?>">共<?php echo $comments_num;?>条评论 >></a></div>
</div>
<!--end ajax show comments-->
<div style="clear:both"></div>
<div class="comment_post">
<form id="comment_form" onSubmit="return false;">
<div class="comment_post_textarea">
<textarea name="comment" id="myEditor"></textarea>
</div>
<div class="comment_post_input">
<div class="comment_post_item"><label>昵称：</label><input type="text" name="username" /></div>
<div class="comment_post_item"><label style="float:left;">验证码：<input type="text" id="veri_code" name="verify_code" size="6" style="height:18px;" /></label><div style="float:left;margin-left:5px;"><img src="verify.php" title="点击刷新图片！" style="cursor:pointer;" id="verify_code" /></div></div>
<div style="margin-top:10px; text-align:center;"><button onClick="checkform();">发表评论</button></div>
<div style="font-size:12px; color:#F00; line-height:20px; text-align:center;"><span id="show_tip"></span></div>
</div>
<input type="hidden" name="article_id" value="<?php echo $row_article["id"];?>" />
</form>
</div>
</div>
<?php
}
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
window.UEDITOR_HOME_URL ="http://www.smallcell.me/<?php echo TEMPATH; ?>scripts/ueditor/";
</script>
<script type="text/javascript" src="<?php echo TEMPATH; ?>scripts/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="<?php echo TEMPATH; ?>scripts/ueditor/ueditor.all.js"></script>
<script type="text/javascript">
var editor = new UE.ui.Editor();
editor.render("myEditor");

function checkform(){
	if($("#myEditor").val() == ""){
		alert("请输入评论内容！");	
	} else if($("#veri_code").val() == ""){
		alert("请输入验证码！");
	}else {
		ajax_post();
	}
}
function ajax_post(){
	$.ajax({
		   type: "POST",
		   url: "ajax/insert_article_comment.php",
		   data: $("#comment_form").serialize(),
		   success: function(msg){
				if(msg == "code_error"){
					$("#show_tip").text("验证码错误！");
				} else {
					alert("发布成功！");
					$("#show_tip").text("");
					$("#show_comment").html(msg);
					$("#veri_code").val("");
					$("#verify_code").attr("src","verify.php?g="+Math.random());
				}
		   }
	});
}
</script>