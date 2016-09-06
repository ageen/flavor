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
/**
	if (function_exists('is_ob_error') && is_ob_error($message)) {
		if (empty($title)) {
			$error_data = $message->get_error_data();
			if (is_array($error_data) && isset($error_data['title'])) {
				$title = $error_data['title'];	
			} 
		}
		$errors = $message->get_error_messages();

		switch (count($errors)):
			case 0:
				$message = '';
				break;
			case 1:
				$message = "<p>{$errors[0]}</p>";
				break;
			default:
				$message = "<ul>\n\t\t<li>" . join("</li>\n\t\t<li>", $errors) . "</li>\n\t</ul>";
				break;
		endswitch;
	} elseif (is_string($message)) {
		$message = "<p>$message</p>";
	}
	
	if (empty($title)) {
		if (function_exists('__')) {
			$title = __('Error Tip' );
		} else {
			$title = 'Error Tip';
		}
	}
**/
	$tpl->assign("title", $title);
	$tpl->assign("message", $message);
	$tpl->display("error.html");
	die();
}
?>