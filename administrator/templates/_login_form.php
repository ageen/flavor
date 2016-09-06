<div class="login_form">
<form id="login_data">
<table>
<tr><td><label>登录帐号：</label></td><td><div class="login_form_input"><input type="text" name="username" /></div></td></tr>
<tr><td><label>登录密码：</label></td><td><div class="login_form_input"><input type="password" name="password" /></div></td></tr>
<tr><td><label>验证码：</label></td><td><div class="login_form_input"><input type="text" name="verify_code" id="verify_code_data" style="width:60px; float:left;" /><img src="verify.php" style="float:left;margin-left:10px;cursor:pointer;" id="verify_code" title="点击刷新验证码！" alt="验证码" /></div></td></tr>
<tr><td></td><td><div class="login_form_input"><button type="button" onclick="ajax_auth();"><img src="templates/images/login_button.png" /></button></div></td></tr>
<tr><td colspan="2" style="height:20px; text-align:center;"><span class="show_login_tip" id="show_tip"></span></td></tr>
</table>
</form>
</div>
<div class="f_footer_logo"><a  href="../index.php"><img src="templates/images/starshine.png" /></a></div>
<script type="text/javascript">
$(function(){
	$("#verify_code").click(function(){
		$(this).attr("src","verify.php?g="+Math.random());
	});
});
function ajax_auth(){
	$.ajax({
	  	type: "POST",
	  	url: "ajax/verify_auth.php",
		data: $("#login_data").serialize(),
		success: function(msg){
			if(msg == "empty"){
				$("#show_tip").text("请输入登录名和密码！");
				return false;
			}
			if(msg == "code_error"){
				$("#show_tip").text("验证码错误！");
				$("#verify_code_data").val("");
				return false;	
			}
			if(msg == "fail"){
				$("#show_tip").text("用户名或密码错误！");
				return false;					
			}
			if(msg == "success"){
				window.location.href='index.php';
			}
		}
	});	
}
</script>