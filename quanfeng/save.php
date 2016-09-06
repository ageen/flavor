<?php
require_once("global.php");
check_form();
foreach($_POST as $k=>$v){
	if(trim($v) == ""){
		echo "empty";
		exit;
	} else {
		$feed[$k] = nl2br(htmlspecialchars($v));
	}
}
if($feed["send_user"]==""){
	echo "empty";
	exit;
}
if($feed["message_content"]==""){
	echo "empty";
	exit;
}
$time = date("Y-m-d H:i:s");
$db = new Db();
$db->bind("nickname",$feed["send_user"]);
$db->bind("content",$feed["message_content"]);
$db->bind("date_time",$time);
$insert	= $db->query("INSERT INTO q_message(nickname,content,date_time)VALUES(:nickname,:content,:date_time)");
if($insert){
//	destroy_session('token');
	echo "success";
	exit;
} else {
	echo "fail";
	exit;
}
?>
