<?php
require_once("global.php");
if(isset($_SESSION["authentication"])&&($_SESSION["authentication"]==true)){
	redirect("index.php");
}
require_once("templates/login_form.php");
?>