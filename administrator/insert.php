<?php
require_once("global.php");
require_once("authentication.php");
$mo = $_GET["mode"];
switch($mo):
	case "banner":
		require_once("templates/insert_banner.php");
		break;
		
	case "wi":
		$sql = "SELECT * FROM f_wi LIMIT 1";
		$row_wi = get_rows($sql);
		require_once("templates/insert_wi.php");
		break;
		
	case "article":
		require_once("templates/insert_article.php");
		break;
		
	case "album":
		require_once("templates/insert_album.php");
		break;

	case "photo":
		$sql = "SELECT id,title FROM f_album";
		$row_albums = get_rows($sql, "array");
		require_once("templates/insert_photo.php");
		break;

        case "q_photo":
                require_once("templates/insert_photo_q.php");
                break;
		
	case "link":
		require_once("templates/insert_link.php");
		break;
		
	case "vedio":
		require_once("templates/insert_vedio.php");
		break;
		
	case "account":
		require_once("templates/insert_account.php");
		break;
		
	default:
		bm_die("参数错误！");
		break;
endswitch;
?>
