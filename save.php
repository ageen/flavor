<?php
require_once("global.php");
if(isset($_GET["mode"])){
	$mode=$_GET["mode"];
}else{
	bm_die("参数不正确！");
}
switch($mode):
	case "article":
		$feed = array();
		foreach($_POST as $k=>$v){
			if($k == "comment"){
				if($v == "" ){
					showinfo("评论内容不能为空！", "back");
				} else {
					$feed[$k] = $v;	
				}
			} elseif($k == "username") {
				if($v == "" ){
					$feed[$k] = LEAVE_USERNAME;	
				} else {
					$feed[$k] = $v;	
				}					
			} else {
				$feed[$k] = $v;
			}
		}
		$sql = $idb->query_insert($feed, "f_article_comment");
		if($idb->query_ex($sql)){
			showinfo("发表成功！", "back");	
		} else {
			bm_die($idb->print_error());
		}
		break;
endswitch;
?>