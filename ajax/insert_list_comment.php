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
if(isset($_POST["mode"])){
	$mode = $_POST["mode"];
	unset($_POST["mode"]);
} else {
	bm_die("参数错误！");	
}
$feed = array();
$feed["publish_time"] = date("Y-m-d H:i:s");
switch($mode):
	case "photo":
		foreach($_POST as $k=>$v){
			if($k == "comment"){
				if($v == "" ){
					showinfo("评论内容不能为空！", "back");
				} else {
					$feed[$k] = $v;
				}
			} elseif($k == "username"){
				if($v == ""){
					$feed[$k] = LEAVE_USERNAME;
				} else {
					$feed[$k] = $v;
				}
			} else {
				$feed[$k] = $v;
			}
		}
		$sql = $idb->query_insert($feed, "f_photo_comment");
		if(!$idb->query_ex($sql)){
			bm_die($idb->print_error());
		}
		$sql = "SELECT id,title,album_id FROM f_photo WHERE id = ". $feed["photo_id"] ." AND comment = 1 LIMIT 1";
		$row_photo = get_rows($sql);
		if($row_photo == "nothing"){
			bm_die("参数错误！");	
		}
		if(isset($_SESSION["auth_album"])&&in_array($row_photo["album_id"], $_SESSION["auth_album"])){
			$sql = "SELECT * FROM f_album WHERE id = " . $row_photo["album_id"];
			$row_album = get_rows($sql);
			$sql = "SELECT * FROM f_photo_comment WHERE photo_id = " . $feed["photo_id"] . " ORDER BY publish_time DESC";
		} else {
			$sql = "SELECT * FROM f_album WHERE id = " . $row_photo["album_id"];
			$row_album = get_rows($sql);
			if($row_album == "nothing"){
				bm_die("参数错误！");
			} else {
				if($row_album["public"] == 0){
					bm_die("无权限访问！");
				} else {
					$sql = "SELECT * FROM f_photo_comment WHERE photo_id = " . $feed["photo_id"] . " ORDER BY publish_time DESC";
				}
			}
		}
		
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
		$row_photo_comments = get_rows($sql, "array");
?>
<!--ARTICLE COMMENTS LIST-->
<?php 
if($row_photo_comments == "nothing"){
?>
<div class="no_article">暂无评论！</div>
<?php
} else {
	$i = 1;
	foreach($row_photo_comments as $k=>$v){
?>
<div class="comment_list">
<div class="comment_list_top"><span style="font-weight:bold;"><?php echo $i;?>.</span> <?php echo $v["username"];?> 于 <?php echo $v["publish_time"];?> 发表评论：</div>
<div class="comment_list_content"><?php echo $v["comment"];?></div>
<div class="comment_list_bottom"></div>
</div>
<?php
		$i++;
	}
?>
<div class="f_paginate"><?php echo $page_string;?></div>
<?php
}
		break;
	
	case "article":
		foreach($_POST as $k=>$v){
			if($k == "comment"){
				if($v == "" ){
					showinfo("评论内容不能为空！", "back");
				} else {
					$feed[$k] = $v;
				}
			} elseif($k == "username"){
				if($v == ""){
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
		$sql = "SELECT * FROM f_article WHERE id = ".$feed["article_id"]." AND draft = 0 AND comment = 1";
		if(get_num($sql) != 1){
			bm_die("参数错误！");
		}
		$sql = "SELECT * FROM f_article_comment WHERE article_id = ".$feed["article_id"]." ORDER BY publish_time DESC";
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
		$row_article_comments = get_rows($sql, "array");
		if($row_article_comments == "nothing"){
?>
<div class="no_article">暂无评论！</div>
<?php
		} else {
			$i=1;
			foreach($row_article_comments as $k=>$v){
?>
<div class="comment_list">
<div class="comment_list_top"><span style="font-weight:bold;"><?php echo $i;?>.</span> <?php echo $v["username"];?> 于 <?php echo $v["publish_time"];?> 发表评论：</div>
<div class="comment_list_content"><?php echo $v["comment"];?></div>
<div class="comment_list_bottom"></div>
</div>
<?php
				$i++;
			}
?>
<div class="f_paginate"><?php echo $page_string;?></div>
<?php
		}
		break;
		
	case "vedio":
		foreach($_POST as $k=>$v){
			if($k == "comment"){
				if($v == "" ){
					showinfo("评论内容不能为空！", "back");
				} else {
					$feed[$k] = $v;
				}
			} elseif($k == "username"){
				if($v == ""){
					$feed[$k] = LEAVE_USERNAME;
				} else {
					$feed[$k] = $v;
				}
			} else {
				$feed[$k] = $v;
			}
		}
		$sql = $idb->query_insert($feed, "f_vedio_comment");
		if(!$idb->query_ex($sql)){
			bm_die($idb->print_error());
		}
		$sql = "SELECT * FROM f_vedio WHERE id = ". $feed["vedio_id"] ." AND public = 1 AND comment = 1";
		if(get_num($sql) != 1){
			bm_die("参数错误！");
		}
		$sql = "SELECT * FROM f_vedio_comment WHERE vedio_id = ". $feed["vedio_id"] ." ORDER BY publish_time DESC";
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
		$row_vedio_comments = get_rows($sql, "array");
		if($row_vedio_comments == "nothing"){
?>
<div class="no_article">暂无评论！</div>
<?php
		} else {
			$i=1;
			foreach($row_vedio_comments as $k=>$v){
?>
<div class="comment_list">
<div class="comment_list_top"><span style="font-weight:bold;"><?php echo $i;?>.</span> <?php echo $v["username"];?> 于 <?php echo $v["publish_time"];?> 发表评论：</div>
<div class="comment_list_content"><?php echo $v["comment"];?></div>
<div class="comment_list_bottom"></div>
</div>
<?php
				$i++;
			}
?>
<div class="f_paginate"><?php echo $page_string;?></div>
<?php
		}
		break;
		
	default:
		bm_die("参数错误！");
		break;
endswitch;