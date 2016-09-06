<?php
require_once("../global.php");
if (get_magic_quotes_gpc()){
	$_POST = array_map('stripslashes_deep', $_POST);
}
if($_POST["verify_code"]!=strtolower($_COOKIE["verify_code"])){
	echo "code_error";
	exit;
}
unset($_POST["verify_code"]);
$feed = array();
$feed["publish_time"] = date("Y-m-d H:i:s");
foreach($_POST as $k=>$v){
	if($k == "content"){
		if($v == "" ){
			showinfo("留言内容不能为空！", "back");	
		} else {
			if(cstrlen(HtmToText($v)) > 200){
				echo "max_words";
				exit;
			} else {
				$feed[$k] = $v;
			}
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
$sql = $idb->query_insert($feed, "f_messages");
if(!$idb->query_ex($sql)){
	bm_die($idb->print_error());
}
$sql = "SELECT * FROM f_messages WHERE reply = 0 ORDER BY publish_time DESC";
//	分页
$page_string = "";
$pagelimit = 16;
$num_info = get_num($sql);
if ($num_info >= 1){
	$idb->query_ex($sql);
	$page_string = paginate($idb->conn, $pagelimit);
	if (isset($_GET['page'])) {
		$page = $_GET['page'];
		$pagestart = $pagelimit*($page-1);
		$sql .= " limit $pagestart, $pagelimit";
	} else {
		$sql .= " limit 0, $pagelimit";
	}
}
$row_messages = get_rows($sql, "array");
?>
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
<div class="messages_list_bottom2"><?php echo $row_reply["username"];?> 于 <?php echo $v["publish_time"];?> 回复留言</div>
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
<div class="messages_list_bottom"><?php echo $row_reply["username"];?> 于 <?php echo $v["publish_time"];?> 回复留言</div>
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
