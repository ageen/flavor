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
if(!$idb->query_ex($sql)){
	bm_die($idb->print_error());
}
$sql = "SELECT * FROM f_article_comment WHERE article_id = " . $feed["article_id"] . " ORDER BY publish_time DESC LIMIT 8";
$row_comments = get_rows($sql, "array");
$sql = "SELECT * FROM f_article_comment WHERE article_id = " . $feed["article_id"];
$comments_num = get_num($sql);
?>
<div class="comment_contain">
<?php
if($row_comments == "nothing"){
?>
<div class="no_comment">暂无评论！</div>
<?php	
} else {
	$i = 1;
	foreach($row_comments as $k=>$v){
?>
<div class="comment_content">
<div class="comment_content_title" style="margin-left:10px;"><span style="font-weight:bold;"><?php echo $i; ?>楼</span>&nbsp;&nbsp;<?php echo $v["username"];?> 于 <?php echo $v["publish_time"];?> 发表评论 </div>
<div class="comment_content_text">
<?php
	echo $v["comment"];
?>
</div>
</div>
<div style="clear:both"></div>
<?php
		$i++;
	}
}
?>
</div>
<div class="comment_more"><a href="view.php?mode=article_comment&id=<?php echo $feed["article_id"];?>">共<?php echo $comments_num;?>条评论 >></a></div>