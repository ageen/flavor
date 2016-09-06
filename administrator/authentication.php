<?php
require_once("global.php");
if(isset($_SESSION["authentication"])&&($_SESSION["authentication"]==true)){
	1;
} else {
	redirect("login.php");	
}
?>