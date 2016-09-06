<?php
require_once("../global.php");
$db = new Db();
//Pageinate
$pagesize = 5;
$page = 1;
if(isset($_GET['page'])) $page = (int)$_GET['page'];
if($page < 1) $page = 1;
$pages=($page-1)*$pagesize;
//End Pageinate
$photo = $db->query("SELECT * FROM q_photo ORDER BY publish_time DESC LIMIT $pages,$pagesize");
if($photo==false){
?>
<div class="item" >No Photo</div>
<?php
}else{
	foreach($photo as $k=>$v){
?>
<div class="item" ><a href="uploads/photo/<?php echo $v['filename'];?>" target="_blank" title="<?php echo $v['title'];?>"><img src="uploads/photo/thumbnail/<?php echo $v['filename'];?>" width="300" /></a></div>
<?php
	}
}
?>
