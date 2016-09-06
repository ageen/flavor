<?php
require("global.php");
$db = new Db();
$column = $db->column("SELECT id FROM q_message");
$count = count($column);
$mes = $db->query("SELECT * FROM q_message ORDER BY date_time DESC LIMIT 8");
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
<div class="boxcontent"><?php echo $v["content"];?></div>
 <strong class="b4b"></strong><strong class="b3b"></strong><strong class="b2b"></strong><strong class="b1b"></strong></div>
 </li>
<?php
		$i++;
	}
	if($count > 8){
?>
<li style=" line-height:50px; text-align:center;font-weight:bold;"><a href="show_message.php" style="color:#FF0">更多留言</a></li>
<?php		
	}
}
?>
