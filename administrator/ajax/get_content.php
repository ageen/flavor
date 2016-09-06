<?php
require_once("../global.php");
require_once("../authentication.php");
if(isset($_GET["id"])){
	$id = $_GET["id"];
} else {
	echo "参数错误！";
}
$sql = "SELECT content FROM f_article WHERE id = $id";
$row_article = get_rows($sql);
if($row_article == "nothing"){
	echo "文章不存在！";
} else {
	echo $row_article["content"];
}
?>