<?php
require("global.php");
$db = new Db();
//Pageinate
$pagesize = 12;
$page = 1;
if(isset($_GET['page'])) $page = (int)$_GET['page'];
if($page < 1) $page = 1;
$pages=($page-1)*$pagesize;
$column = $db->column("SELECT id FROM q_message");
$count = count($column);
$num = ceil($count / $pagesize);
if($page > $num) $page=$num;
//End Pageinate
$mes = $db->query("SELECT * FROM q_message ORDER BY date_time DESC LIMIT $pages,$pagesize");
?>
<div class="count_message">留言板 - 共有<?php echo $count;?>条留言,分为<?php echo $num;?>页</div>
<div> </div>
<?php
if($count == 0){
?>
<li>
<div class="raised"><strong class="b1"></strong><strong class="b2"></strong><strong class="b3"></strong><strong class="b4"></strong>
<div class="boxcontent" style="color:#F00; text-align:center;">暂无留言</div>
<strong class="b4b"></strong><strong class="b3b"></strong><strong class="b2b"></strong><strong class="b1b"></strong></div>
</li>
<?php	
} else {
	$i = 1;
	foreach($mes as $k=>$v){
?>
<li>
<div class="message_from"><?php echo $i;?>、<span style="font-weight:bold; color:#FFC;font-size:12px;"><?php echo $v["nickname"];?></span>， <span style="font-size:12px;"><?php echo $v["date_time"];?></span> 留言：</div>
<div class="raised"><strong class="b1"></strong><strong class="b2"></strong><strong class="b3"></strong><strong class="b4"></strong>
<div class="boxcontent" style="text-indent:1em;"><?php echo $v["content"];?></div>
 <strong class="b4b"></strong><strong class="b3b"></strong><strong class="b2b"></strong><strong class="b1b"></strong></div>
 </li>
<?php
		$i++;
	}
	if($count > 8){
?>
<li><div class="page_message" style="float:left;"><a onclick="ajax_page(<?php echo $page-1;?>)">上一页</a></div><div class="page_message" style="float:right;"><a onclick="ajax_page(<?php echo $page+1;?>)">下一页</a></div></li>
<?php		
	}
}
?>