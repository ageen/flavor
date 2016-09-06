<?php session_start();?>
<?php require("include/functions.php");?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<META content="IE=10.000" http-equiv="X-UA-Compatible">
<META charset="utf-8">
<meta name='HandheldFriendly' content='True'>
<meta name='MobileOptimized' content='320'>
<meta name='format-detection' content='telephone=no'>
<meta name='viewport' content='width=device-width, minimum-scale=1.0, maximum-scale=1.0'>
<meta http-equiv='cleartype' content='on'>
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<TITLE>留言板 - 全锋队足球俱乐部</TITLE>
<LINK href="css/style.css" rel="stylesheet" type="text/css">
<SCRIPT src="js/jquery-1.9.1.min.js" type="text/javascript"></SCRIPT>
</HEAD>
<body>
<div id="mask"></div>
<header>
<h1>全锋足球队</h1>
</header>
<ul class="message_more">
<li>
<ul class="message" id="message_show"></ul>
</li>
</ul>
<div style="text-align:center; line-height:30px; position:fixed; bottom:30px;right:0; width:81px; height:59px;"><img src="images/message.png" onClick="pop_message_box();" /></div>
<!--Message Box-->
<div id="message_box" class="login-popup">
<a href="#" class="close" onClick="close_box()"><img src="images/close.png" /></a>
<div id="login-content">
<form id="message_send" name="message_send" method="post">
<h4 style="color:#fff; line-height:30px;">留个言</h4>
<div class="message_bar"><textarea name="message_content" id="message_content" rows="10" cols="25" placeholder="说点什么"></textarea><span class="message_warning"></span></div>
<div class="message_bar"><label style="color:#FFF;">留个名</label><input type="text" name="send_user" id="send_user" placeholder="留个名吧" /><span class="message_warning"></span></div>
<div class="message_bar"><button type="submit">发送</button></div>
<?php token_input();?>
</form>
</div>
</div>
<!-- END Message Box -->
</body>
</HTML>
<SCRIPT src="js/jquery.validate.js" type="text/javascript"></SCRIPT>
<script type="text/javascript">
$(document).ready(function() {
	$('#message_show').load('message2.php');
	$("#message_send").validate({
		rules:{
			message_content:{required:true},
			send_user:{required:true}
		},
		messages:{
			message_content:{required:"留言内容为空"},
			send_user:{required:"留个名"}
		},
		errorPlacement: function(error, element) {
			error.appendTo(element.next("span"));
		},submitHandler : function(form) {
			$.ajax({
				type: "POST",
				url: "save.php",
				data: $("#message_send").serialize(),
				success: function(msg){
					if(msg=="fail"){
						alert('留言失败')
						return false;
					} else if(msg == "success"){
						alert('留言成功')
						$('#message_content').val('');
						$('#send_user').val('');
						close_box()
						$('#message_show').load('message2.php');
					} else if(msg == "empty"){
						alert('请输入完整内容！')
						return false;
					} else {
						alert('留言失败')
						return false;
					}
				}
			});
		}
	});
});
function pop_message_box(){
	// Getting the variable's value from a link
	var messageBox = $('#message_box');

	//Fade in the Popup and add close button
	$(messageBox).fadeIn(300);
	//$(loginBox).load('cart_view.php');
	//Set the center alignment padding + border
	var popMargTop = 300;
	var popMargLeft = ($(messageBox).width() + 24) / 2;

	$(messageBox).css({
		'margin-top' : -popMargTop,
		'margin-left' : -popMargLeft
	});

	// Add the mask to body
	$('body').append('<div id="mask"></div>');
	
	$('#mask').fadeIn(300);
	return false;
}
function close_box(){
	$('#mask , #message_box').fadeOut(300 , function() {
		$('#mask').remove();
	});
	return false;
}
function ajax_page(page){
	$('#message_show').load('message2.php?page='+page)
}
</script>
