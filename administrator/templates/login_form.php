<?php defined('_EXEC') or die('Restricted access');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台登录</title>
<link rel="stylesheet" type="text/css" href="<?php echo T_TMP; ?>css/style.css">
<script type="text/javascript" src="<?php echo T_TMP; ?>scripts/jquery.min.js"></script>
</head>
<body>
<div id="loadingImg" class="loadingImg">
<img src="templates/images/lightbox-ico-loading.gif" />
</div>
</body>
</html>
<script type="text/javascript">
$.ajax({
//	type:'GET',	  
	url:'templates/_login_form.php',
//	data:{},
	cache: false,
	success:function(html){
		$('body').append(html);
		$('#loadingImg').remove();
	},
	dataType:'html'
});
</script>