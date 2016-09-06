<?php
require_once("global.php");
require_once("authentication.php");
$sql = "SELECT * FROM f_wi LIMIT 1";
if (get_magic_quotes_gpc()){
	$_POST = array_map('stripslashes_deep', $_POST);
}
if(get_num($sql) == 0){
	$sql = $idb->query_insert($_POST, "f_wi");
	if($idb->query_ex($sql)){
		echo $_POST["code"];
	} else {
		bm_die($idb->print_error());	
	}	
} else {
	$row_wi = get_rows($sql);
	$id = $row_wi["id"];
	$sql = $idb->query_update($_POST, "f_wi", "id=$id");
	if($idb->query_ex($sql)){
		echo $_POST["code"];
	} else {
		bm_die($idb->print_error());	
	}
}
?>