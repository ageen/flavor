<?php
function showinfo($str,$url){
	if($url<>''){
		if ($url=='back'){
			echo "<script language=javascript>alert('$str');window.history.go(-1);</script>";
		}else{
			echo "<script language=javascript>alert('$str');window.location.href='$url'</script>";
		} 
	}else{
		echo "<script language=javascript>window.top.location.href='$url';</script>";
	}
	exit();
}
function bm_die($message, $title = '') {
	global $tpl;
	$tpl->assign("title", $title);
	$tpl->assign("message", $message);
	$tpl->display("error.html");
	die();
}
?>