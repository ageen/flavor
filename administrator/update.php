<?php
require_once("global.php");
require_once("authentication.php");
if(isset($_GET["id"])){
	$id = $_GET["id"];
}
$mode = $_POST["mode"];
unset($_POST["mode"]);
switch($mode):
	case "article":
		$sql = $idb->query_update($_POST, "f_article", "id = $id");
		if($idb->query_ex($sql)){
			showinfo("更新成功", "view.php?mode=article");
		} else {
			bm_die($idb->print_error());
		}
		break;
endswitch;
?>