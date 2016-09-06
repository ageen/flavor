<?php
require_once("global.php");
//BANNER
$sql = "SELECT * FROM f_banner WHERE is_show = 1 ORDER BY banner_order ASC";
$row_banners = get_rows($sql, "array");
//PHOTO SCROLL
$sql = "SELECT fp.*, fa.public FROM f_photo AS fp LEFT JOIN f_album AS fa ON fp.album_id = fa.id WHERE scroll = 1 AND fa.public = 1";
$row_photo_scroll = get_rows($sql, "array");
//ARTICLE
$sql = "SELECT * FROM f_article WHERE draft = 0 ORDER BY publish_time DESC LIMIT 6";
$row_articles = get_rows($sql, "array");
//VEDIO RECOMMEND
$sql = "SELECT * FROM f_vedio WHERE public = 1 AND recommend = 1 ORDER BY publish_time DESC LIMIT 1";
$row_vedio_recommend = get_rows($sql);
//VEDIO NEW
$sql = "SELECT * FROM f_vedio WHERE public = 1 ORDER BY publish_time DESC LIMIT 6";
$row_vedios = get_rows($sql, "array");
//Wi Code
$sql = "SELECT * FROM f_wi WHERE selected=1 LIMIT 1";
$row_wi = get_rows($sql);
require_once("templates/".THEME_COLOR."/main.php");
?>