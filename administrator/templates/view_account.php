<?php defined('_EXEC') or die('Restricted access');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>VIEW ACCOUNT</title>
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>scripts/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>scripts/themes/icon.css">
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>scripts/demo.css">
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>css/style.css">
<script type="text/javascript" src="<?php echo T_TMP; ?>scripts/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo T_TMP; ?>scripts/jquery.easyui.min.js"></script>
</head>
<body>
<div class="article_search">
<div class="photo_album_form">
<form action="view.php?mode=account" method="post" name="create_sort_form">
<label>排序：</label><select name="create_sort" onchange="javascript:document.create_sort_form.submit();">
<?php
foreach($order as $k=>$v){
	if($_SESSION["create_sort"] == "$k"){
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
<div class="photo_album_form">
<form action="view.php?mode=account" method="post" name="account_able_form">
<label>显示：</label><select name="account_able" onchange="javascript:document.account_able_form.submit();">
<?php
foreach($disabled as $k=>$v){
	if($_SESSION["account_able"] == "$k"){
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
if($row_accounts == "nothing"){
?>
<div class="no_article">暂无帐号！</div>
<?php
} else {
$i = 0;
foreach($row_accounts as $k=>$v){
?>
<div id="show_accounts<?php echo $i;?>">
<table>
<tr>
<td colspan="2">
<div class="f_title2">登录名称： <?php echo $v["username"];?></div>
<div class="f_title2">创建时间： <?php echo $v["create_time"];?></div>
<div class="f_title2">登录时间： <?php echo $v["last_login_time"];?></div>
</td>
</tr>
<tr><td colspan="3"><hr /></td></tr>
<tr>
<td colspan="3" style="margin:0;padding:0 0 10px 0;line-height:30px;border-bottom:1px dashed #666666;">
<div id="show_disable<?php echo $i;?>" style="float:left;">
<?php
if($v["disable"]==0){
?>
<div class="f_detail"><a href="javascript:void(0)" onclick="disable_ajax(<?php echo $i;?>,<?php echo $v["id"];?>, 1)">[禁用帐号]</a></div>
<?php
} else {
?>
<div class="f_detail2"><a href="javascript:void(0)" onclick="disable_ajax(<?php echo $i;?>,<?php echo $v["id"];?>, 0)">[开启帐号]</a></div>
<?php
}
?>
</div>
<div class="f_detail"><a href="javascript:void(0)" onClick="change_username_form(<?php echo $i;?>,'<?php echo $v["id"];?>')" target="_self" >[修改登录名]</a></div>
<div class="f_detail"><a href="javascript:void(0)" onClick="change_password_form('<?php echo $v["id"];?>')" target="_self" >[修改密码]</a></div>
<div class="f_detail"><a href="delete.php?mode=account&id=<?php echo $v["id"];?>" onclick="return del();" target="_self">[删除该帐号]</a></div>
</td>
</tr>
</table>
</div>
<?php
	$i++;
}
}
?>
<div style="width:850px;margin:10px auto;"><div class="f_paginate"><?php echo $page_string;?></div></div>
</div>
<div id="change_username_form">
<div class="change_username_form">
<form id="change_username_data">
<div style="font-size:14px; color:#666;">登录名称：<input type="text" id="username" name="username" /></div>
<div class="reply_form_button"><button type="button" onclick="ajax_update_username();">更新登录名</button>&nbsp;<button type="button" onclick="close_form();">关闭</button></div>
</form>
</div>
</div>
<div id="change_password_form">
<div class="change_password_form">
<form id="change_password_data">
<div style="font-size:14px; color:#666; height:30px;">输入当前密码：<input type="password" id="origin_password" name="origin_password" /></div>
<div style="font-size:14px; color:#666;">输入新密码：&nbsp;&nbsp;<input type="password" id="new_password" name="new_password" /></div>
<div class="reply_form_button"><button type="button" onclick="ajax_update_password();">更新密码</button>&nbsp;<button type="button" onclick="close_form2();">关闭</button></div>
</form>
</div>
</div>
</body>
</html>
<script type="text/javascript">
var _order;
var _id;
$("#change_username_form").hide();
$("#change_password_form").hide();
function change_username_form(order,a_id){
	$("#change_password_form").hide();
	$("#change_username_form").fadeIn("slow");
	_order = order;
	_id = a_id;
}
function change_password_form(a_id){
	$("#change_username_form").hide();
	$("#change_password_form").fadeIn("slow");
	_id = a_id;
}
function ajax_update_username(){
	if($("#username").val()==""){
		alert("请输入新的登录名！")
		return false;
	}
	$.ajax({
		   type: "POST",
		   url: "ajax/update_username.php?id="+_id+"&order="+_order,
		   data: $("#change_username_data").serialize(),
		   success: function(msg){
				if(msg == "same"){
					alert("登录名重复！");
					return false;
				} else {
					$("#change_username_form").hide();
					$("#show_accounts"+_order).html(msg);
				}
		   }
	});
}
function ajax_update_password(){
	if($("#origin_password").val()==""){
		alert("请输入当前密码！")
		return false;
	}
	if($("#new_password").val()==""){
		alert("请输入新密码！")
		return false;
	}	
	$.ajax({
		   type: "POST",
		   url: "ajax/update_password.php?id="+_id,
		   data: $("#change_password_data").serialize(),
		   success: function(msg){
				if(msg == "wrong"){
					alert("密码错误！");
					return false;
				} else if(msg == "fail"){
					alert("密码更新失败！");
					return false;
				} else if(msg == "success") {
					alert("密码更新成功！");
					$("#change_password_form").hide();
				}
		   }
	});
}
function close_form(){
	$("#change_username_form").fadeOut("slow");
}
function close_form2(){
	$("#change_password_form").fadeOut("slow");
}
function del() {
	var msg = "删除该帐号？"; 
	if (confirm(msg)==true){
		return true;
	}else{
		return false; 
	}
}
function disable_ajax(order, a_id, diable){
	$.ajax({
	   type: "POST",
	   url: "ajax/update_account_diable.php",
	   data: "id=" + a_id + "&disable=" + diable + "&order=" + order,
	   success: function(msg){
		   $("#show_disable" + order).html(msg)
	   }
	});	
}
</script>