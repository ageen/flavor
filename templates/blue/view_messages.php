<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>网站留言 - <?php echo WEBPAGE_TITLE_SUFFIX;?></title>
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
<span class="f_crumbs_link"><a href="index.php">首页</a></span> &gt; <span class="f_crumbs_link"><a>网站留言</a></span>
</div>
<div id="show_messages">
<!--ARTICLE COMMENTS LIST-->
<?php 
if($row_messages == "nothing"){
?>
<div class="no_article">暂无留言！</div>
<?php
} else {
	$i = 1;
	foreach($row_messages as $k=>$v){
		$sql = "SELECT * FROM f_messages WHERE reply=1 AND reply_id = " . $v["id"] . " LIMIT 1";
		$row_reply = get_rows($sql);
		if($i%2 != 0){
?>
<div class="messages_list">
<div class="messages_list_left">
<div class="messages_list_content"><?php echo $v["content"];?></div>
<div class="messages_list_bottom"><?php echo $v["username"];?> 于 <?php echo $v["publish_time"];?> 发表留言</div>
</div>
<?php
			if($row_reply != "nothing"){
?>
<div class="reply_arrow">
<div class="reply_arrow_left"></div>
</div>
<div class="messages_list_right_reply">
<div class="messages_list_content"><?php echo $row_reply["content"];?></div>
<div class="messages_list_bottom2"><?php echo $row_reply["username"];?><br />在 <?php echo $row_reply["publish_time"];?> 回复留言</div>
</div>
<?php				
			}
?>
</div>
<div style="clear:both;"></div>
<?php			
		} else {
?>
<div class="messages_list">
<?php
			if($row_reply != "nothing"){
?>
<div class="messages_list_left_reply">
<div class="messages_list_content"><?php echo $row_reply["content"];?></div>
<div class="messages_list_bottom"><?php echo $row_reply["username"];?><br />在 <?php echo $row_reply["publish_time"];?> 回复留言</div>
</div>
<div class="reply_arrow">
<div class="reply_arrow_right"></div>
</div>
<?php				
			}
?>
<div class="messages_list_right">
<div class="messages_list_content"><?php echo $v["content"];?></div>
<div class="messages_list_bottom2"><?php echo $v["username"];?> 于 <?php echo $v["publish_time"];?> 发表留言</div>
</div>
</div>
<div style="clear:both;"></div>
<?php			
		}
		$i++;
	}
?>
<div class="f_paginate"><?php echo $page_string;?></div>
<?php
}
?>
</div>
<div style="clear:both;"></div>
<div class="comment_post" style="margin-top:10px;">
<form id="messages_form" onSubmit="return false;">
<div class="comment_post_textarea">
<textarea name="content" id="myEditor"></textarea>
</div>
<div class="comment_post_input">
<div class="comment_post_item"><label>昵称：</label><input type="text" name="username" /></div>
<div class="comment_post_item"><label style="float:left;">验证码：<input type="text" id="veri_code" name="verify_code" size="6" style="height:18px;" /></label><div style="float:left;margin-left:5px;"><img src="verify.php" title="点击刷新图片！" style="cursor:pointer;" id="verify_code" /></div></div>
<div style="margin-top:10px; text-align:center;"><button onClick="checkform();">发表留言</button></div>
<div style="font-size:12px; color:#F00; line-height:20px; text-align:center;"><span id="show_tip"></span></div>
</div>
</form>
</div>
<?php
require_once("footer.php");
?>
<!--END BODY-->
</body>
</html>
<script type="text/javascript">
window.UEDITOR_HOME_URL ="http://www.smallcell.me/<?php echo TEMPATH; ?>scripts/ueditor/";
</script>
<script type="text/javascript" src="<?php echo TEMPATH; ?>scripts/ueditor/ueditor2.config.js"></script>
<script type="text/javascript" src="<?php echo TEMPATH; ?>scripts/ueditor/ueditor.all.js"></script>
<script type="text/javascript">
var editor = new UE.ui.Editor();
editor.render("myEditor");

function checkform(){
	if($("#myEditor").val() == ""){
		alert("请输入留言内容！");	
	} else if($("#veri_code").val() == ""){
		alert("请输入验证码！");
	}else {
		ajax_post();
	}
}
function ajax_post(){
	$.ajax({
		   type: "POST",
		   url: "ajax/insert_messages.php",
		   data: $("#messages_form").serialize(),
		   success: function(msg){
				if(msg == "code_error"){
					$("#show_tip").text("验证码错误！");
				} else if(msg == "max_words"){
					$("#show_tip").text("超出最大字数限制！");
				} else {
					alert("发布成功！");
					$("#show_tip").text("");
					$("#show_messages").html(msg);
					$("#veri_code").val("");
					$("#verify_code").attr("src","verify.php?g="+Math.random());
				}
		   }
	});
}
</script>