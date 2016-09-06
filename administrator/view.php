<?php
require_once("global.php");
require_once("authentication.php");
if(isset($_GET["mode"])){
	$mode=$_GET["mode"];		
}else{
	bm_die("参数不正确！");
}
$pagestart = 0;
$pagelimit = 8;
switch($mode):
	case "config":
		$theme_color = array("default"=>"默认","blue"=>"蓝色");
		$banner_effect = array("none"=>"无效果","slide-hori"=>"水平切换","slide-vert"=>"垂直切换","fade"=>"淡入淡出","resize"=>"缩略尺寸");
		$sql = "SELECT * FROM f_config LIMIT 1";
		$row_config = get_rows($sql);
		require_once("templates/main.php");
		break;
	case "article":
		$draft = array("all" => "全部文章", 0=>"已发布", 1=>"未发布");
		$order = array("desc" => "按发布日期降序", "asc"=>"按发布日期升序");
		//关键字
		$sql = "SELECT * FROM f_article WHERE 1=1";
		if(isset($_POST["article_keywords"])){
			if($_POST["article_keywords"] != ""){
				$sql .= " AND title like '%" . $_POST["article_keywords"] . "%'";
			}
		}
		//是否发布
		if(isset($_POST["article_draft"])){
			if($_POST["article_draft"] != ""){
				$_SESSION["article_draft"] = $_POST["article_draft"];
			}
		}
		if(isset($_SESSION["article_draft"])&&$_SESSION["article_draft"] != ""){
			if($_SESSION["article_draft"] != "all"){
				$sql .= " AND draft = " . $_SESSION["article_draft"];
			}
		}
		//排序
		$_SESSION["article_sort"] = "desc";
		if(isset($_POST["article_sort"])){
			if($_POST["article_sort"] != ""){
				$_SESSION["article_sort"] = $_POST["article_sort"];
			}
		}
		if($_SESSION["article_sort"] != ""){
			$sql .= " ORDER BY publish_time " . $_SESSION["article_sort"];
		}
		//	分页
		$page_string = "";
		$num_info = get_num($sql);
		if ($num_info >= 1){
		$idb->query_ex($sql);
		$page_string = paginate($idb->conn, $pagelimit);
		if (isset($_GET['page'])) {
			$page = $_GET['page'];
				$pagestart = $pagelimit*($page-1);
				$sql .= " limit $pagestart, $pagelimit";
			} else {
				$sql .= " limit 0, $pagelimit";
			}
		}
		$row_article = get_rows($sql,"array");
		require_once(T_TMP."view_article.php");
		break;
		
	case "article_comment":
		$order = array("desc" => "按评论日期降序", "asc"=>"按评论日期升序");
		if(isset($_GET["id"])){
			$id=$_GET["id"];
		}else{
			bm_die("参数不正确！");
		}
		$sql = "SELECT title FROM f_article WHERE id = $id";
		if(get_num($sql) != 1){
			bm_die("参数错误！");
		} else {
			$row_article = get_rows($sql);	
		}
		$sql = "SELECT * FROM f_article_comment WHERE article_id = $id";
		//排序
		$_SESSION["comment_sort"] = "desc";
		if(isset($_POST["comment_sort"])){
			if($_POST["comment_sort"] != ""){
				$_SESSION["comment_sort"] = $_POST["comment_sort"];
			}
		}
		if($_SESSION["comment_sort"] != ""){
			$sql .= " ORDER BY publish_time " . $_SESSION["comment_sort"];
		}
		//	分页
		$page_string = "";
		$num_info = get_num($sql);
		if ($num_info >= 1){
		$idb->query_ex($sql);
		$page_string = paginate($idb->conn, $pagelimit);
		if (isset($_GET['page'])) {
			$page = $_GET['page'];
				$pagestart = $pagelimit*($page-1);
				$sql .= " limit $pagestart, $pagelimit";
			} else {
				$sql .= " limit 0, $pagelimit";
			}
		}
		$row_comments = get_rows($sql, "array");
		require_once("templates/view_article_comment.php");
		break;
		
	case "link":
		$order = array("DESC" => "降序", "ASC"=>"升序");
		$display = array("all"=>"全部", "1" => "显示", "0"=>"不显示");
		$sql = "SELECT * FROM f_link WHERE 1=1";
		//显示
		if(isset($_POST["link_display"])){
			if($_POST["link_display"] != ""){
				$_SESSION["link_display"] = $_POST["link_display"];
			}
		}
		if(isset($_SESSION["link_display"])&&$_SESSION["link_display"] != "all"){
			$sql .= " AND selected = " . $_SESSION["link_display"];
		}		
		//排序
		$_SESSION["link_sort"] = "ASC";
		if(isset($_POST["link_sort"])){
			if($_POST["link_sort"] != ""){
				$_SESSION["link_sort"] = $_POST["link_sort"];
			}
		}
		if($_SESSION["link_sort"] != ""){
			$sql .= " ORDER BY link_order " . $_SESSION["link_sort"];
		}
		$sql .=  ", id DESC";
		//	分页
		$page_string = "";
		$num_info = get_num($sql);
		if ($num_info >= 1){
		$idb->query_ex($sql);
		$page_string = paginate($idb->conn, $pagelimit);
		if (isset($_GET['page'])) {
			$page = $_GET['page'];
				$pagestart = $pagelimit*($page-1);
				$sql .= " limit $pagestart, $pagelimit";
			} else {
				$sql .= " limit 0, $pagelimit";
			}
		}
		$row_links = get_rows($sql, "array");
		require_once("templates/view_link.php");
		break;
		
	case "album":
		$order = array("DESC" => "降序", "ASC"=>"升序");
		$public = array("all"=>"全部", "1" => "公开", "0"=>"不公开");
		$sql = "SELECT * FROM f_album WHERE 1=1";
		//显示
		if(isset($_POST["album_public"])){
			if($_POST["album_public"] != ""){
				$_SESSION["album_public"] = $_POST["album_public"];
			}
		}
		if(isset($_SESSION["album_public"])&&$_SESSION["album_public"] != "all"){
			$sql .= " AND public = " . $_SESSION["album_public"];
		}
		//排序
		$_SESSION["album_sort"] = "ASC";
		if(isset($_POST["album_sort"])){
			if($_POST["album_sort"] != ""){
				$_SESSION["album_sort"] = $_POST["album_sort"];
			}
		}
		$sql .= " ORDER BY album_order " . $_SESSION["album_sort"];

		//	分页
		$pagelimit = 6;
		$page_string = "";
		$num_info = get_num($sql);
		if ($num_info >= 1){
		$idb->query_ex($sql);
		$page_string = paginate($idb->conn, $pagelimit);
		if (isset($_GET['page'])) {
			$page = $_GET['page'];
				$pagestart = $pagelimit*($page-1);
				$sql .= " limit $pagestart, $pagelimit";
			} else {
				$sql .= " limit 0, $pagelimit";
			}
		}
		$row_albums = get_rows($sql, "array");
		require_once("templates/view_album.php");
		break;

	case "photo":
		$order = array("DESC" => "按上传时间降序", "ASC"=>"按上传时间升序");
		$scroll = array("all" => "全部", "0" => "不显示", "1"=>"显示");
		$sql = "SELECT fp.*, fa.title AS album_title, fa.public AS album_public FROM f_photo AS fp LEFT JOIN f_album AS fa ON fp.album_id = fa.id WHERE 1=1";
		//相册
		if(isset($_POST["photo_album"])){
			$_SESSION["photo_album"] = $_POST["photo_album"];
		}
		if(isset($_SESSION["photo_album"])){
			if($_SESSION["photo_album"] != "all"){
				$sql .= " AND album_id = " . $_SESSION["photo_album"];	
			}
		}
		//首页滚动
		if(isset($_POST["photo_scroll"])){
			$_SESSION["photo_scroll"] = $_POST["photo_scroll"];
		}
		if(isset($_SESSION["photo_scroll"])){
			if($_SESSION["photo_scroll"] != "all"){
				$sql .= " AND scroll = " . $_SESSION["photo_scroll"];	
			}
		}
		//排序
		$_SESSION["photo_publish"] = "ASC";
		if(isset($_POST["photo_publish"])){
			if($_POST["photo_publish"] != ""){
				$_SESSION["photo_publish"] = $_POST["photo_publish"];
			}
		}
		$sql .= " ORDER BY publish_time " . $_SESSION["photo_publish"];

		//	分页
		$pagelimit = 6;
		$page_string = "";
		$num_info = get_num($sql);
		if ($num_info >= 1){
		$idb->query_ex($sql);
		$page_string = paginate($idb->conn, $pagelimit);
		if (isset($_GET['page'])) {
			$page = $_GET['page'];
				$pagestart = $pagelimit*($page-1);
				$sql .= " limit $pagestart, $pagelimit";
			} else {
				$sql .= " limit 0, $pagelimit";
			}
		}
		$row_photos = get_rows($sql, "array");
		$sql = "SELECT id,title FROM f_album";
		$row_albums = get_rows($sql, "array");
		require_once("templates/view_photo.php");
		break;

	case "q_photo":
		$order = array("DESC" => "按上传时间降序", "ASC"=>"按上传时间升序");
		$scroll = array("all" => "全部", "0" => "不显示", "1"=>"显示");
		$sql = "SELECT * FROM q_photo WHERE 1=1";
		
		//首页滚动
		if(isset($_POST["photo_scroll"])){
			$_SESSION["photo_scroll"] = $_POST["photo_scroll"];
		}
		if(isset($_SESSION["photo_scroll"])){
			if($_SESSION["photo_scroll"] != "all"){
				$sql .= " AND scroll = " . $_SESSION["photo_scroll"];	
			}
		}
		//排序
		$_SESSION["photo_publish"] = "ASC";
		if(isset($_POST["photo_publish"])){
			if($_POST["photo_publish"] != ""){
				$_SESSION["photo_publish"] = $_POST["photo_publish"];
			}
		}
		$sql .= " ORDER BY publish_time " . $_SESSION["photo_publish"];

		//	分页
		$pagelimit = 6;
		$page_string = "";
		$num_info = get_num($sql);
		if ($num_info >= 1){
		$idb->query_ex($sql);
		$page_string = paginate($idb->conn, $pagelimit);
		if (isset($_GET['page'])) {
			$page = $_GET['page'];
				$pagestart = $pagelimit*($page-1);
				$sql .= " limit $pagestart, $pagelimit";
			} else {
				$sql .= " limit 0, $pagelimit";
			}
		}
		$row_photos = get_rows($sql, "array");
		require_once("templates/view_photo_q.php");
		break;

		
	case "photo_comment":
		$order = array("desc" => "按评论日期降序", "asc"=>"按评论日期升序");
		if(isset($_GET["id"])){
			$id=$_GET["id"];
		}else{
			bm_die("参数不正确！");
		}
		$sql = "SELECT title FROM f_photo WHERE id = $id";
		if(get_num($sql) != 1){
			bm_die("参数错误！");
		} else {
			$row_photo = get_rows($sql);	
		}
		$sql = "SELECT * FROM f_photo_comment WHERE photo_id = $id";
		//排序
		$_SESSION["comment_sort"] = "desc";
		if(isset($_POST["comment_sort"])){
			if($_POST["comment_sort"] != ""){
				$_SESSION["comment_sort"] = $_POST["comment_sort"];
			}
		}
		if($_SESSION["comment_sort"] != ""){
			$sql .= " ORDER BY publish_time " . $_SESSION["comment_sort"];
		}
		//	分页
		$page_string = "";
		$num_info = get_num($sql);
		if ($num_info >= 1){
		$idb->query_ex($sql);
		$page_string = paginate($idb->conn, $pagelimit);
		if (isset($_GET['page'])) {
			$page = $_GET['page'];
				$pagestart = $pagelimit*($page-1);
				$sql .= " limit $pagestart, $pagelimit";
			} else {
				$sql .= " limit 0, $pagelimit";
			}
		}
		$row_comments = get_rows($sql, "array");
		require_once("templates/view_photo_comment.php");
		break;
		
	case "banner":
		$order = array("DESC" => "降序", "ASC"=>"升序");
		$display = array("all"=>"全部", 0 => "不显示", 1=>"显示");
		$sql = "SELECT * FROM f_banner WHERE 1=1";
		//显示
		if(isset($_POST["banner_show"])){
			$_SESSION["banner_show"] = $_POST["banner_show"];
		}
		if(isset($_SESSION["banner_show"])){
			if($_SESSION["banner_show"] != "all"){
				$sql .= " AND is_show = " . $_SESSION["banner_show"];	
			}
		}
		//排序
		$_SESSION["banner_order_value"] = "ASC";
		if(isset($_POST["banner_order_value"])){
			if($_POST["banner_order_value"] != ""){
				$_SESSION["banner_order_value"] = $_POST["banner_order_value"];
			}
		}
		$sql .= " ORDER BY banner_order " . $_SESSION["banner_order_value"];

		//	分页
		$pagelimit = 6;
		$page_string = "";
		$num_info = get_num($sql);
		if ($num_info >= 1){
		$idb->query_ex($sql);
		$page_string = paginate($idb->conn, $pagelimit);
		if (isset($_GET['page'])) {
			$page = $_GET['page'];
				$pagestart = $pagelimit*($page-1);
				$sql .= " limit $pagestart, $pagelimit";
			} else {
				$sql .= " limit 0, $pagelimit";
			}
		}
		$row_banners = get_rows($sql, "array");
		require_once("templates/view_banner.php");
		break;
		
	case "vedio":
		$order = array("DESC" => "降序", "ASC"=>"升序");
		$recommend = array("all"=>"全部", 1 => "推荐", 0=>"不推荐");
		$public = array("all"=>"全部", 1 => "已发布", 0=>"未发布");
		$sql = "SELECT * FROM f_vedio WHERE 1=1";
		//推荐
		if(isset($_POST["vedio_recommend"])){
			$_SESSION["vedio_recommend"] = $_POST["vedio_recommend"];
		}
		if(isset($_SESSION["vedio_recommend"])){
			if($_SESSION["vedio_recommend"] != "all"){
				$sql .= " AND recommend = " . $_SESSION["vedio_recommend"];	
			}
		}
		//公开
		if(isset($_POST["vedio_public"])){
			$_SESSION["vedio_public"] = $_POST["vedio_public"];
		}
		if(isset($_SESSION["vedio_public"])){
			if($_SESSION["vedio_public"] != "all"){
				$sql .= " AND public = " . $_SESSION["vedio_public"];	
			}
		}
		//排序
		$_SESSION["vedio_order"] = "ASC";
		if(isset($_POST["vedio_order"])){
			if($_POST["vedio_order"] != ""){
				$_SESSION["vedio_order"] = $_POST["vedio_order"];
			}
		}
		$sql .= " ORDER BY publish_time " . $_SESSION["vedio_order"];
		//	分页
		$pagelimit = 6;
		$page_string = "";
		$num_info = get_num($sql);
		if ($num_info >= 1){
		$idb->query_ex($sql);
		$page_string = paginate($idb->conn, $pagelimit);
		if (isset($_GET['page'])) {
			$page = $_GET['page'];
				$pagestart = $pagelimit*($page-1);
				$sql .= " limit $pagestart, $pagelimit";
			} else {
				$sql .= " limit 0, $pagelimit";
			}
		}
		$row_vedios = get_rows($sql, "array");
		require_once("templates/view_vedio.php");
		break;
		
	case "vedio_comment":
		$order = array("desc" => "按评论日期降序", "asc"=>"按评论日期升序");
		if(isset($_GET["id"])){
			$id=$_GET["id"];
		}else{
			bm_die("参数不正确！");
		}
		$sql = "SELECT title FROM f_vedio WHERE id = $id";
		if(get_num($sql) != 1){
			bm_die("参数错误！");
		} else {
			$row_vedio = get_rows($sql);	
		}
		$sql = "SELECT * FROM f_vedio_comment WHERE vedio_id = $id";
		//排序
		$_SESSION["comment_sort"] = "desc";
		if(isset($_POST["comment_sort"])){
			if($_POST["comment_sort"] != ""){
				$_SESSION["comment_sort"] = $_POST["comment_sort"];
			}
		}
		if($_SESSION["comment_sort"] != ""){
			$sql .= " ORDER BY publish_time " . $_SESSION["comment_sort"];
		}
		//	分页
		$page_string = "";
		$num_info = get_num($sql);
		if ($num_info >= 1){
		$idb->query_ex($sql);
		$page_string = paginate($idb->conn, $pagelimit);
		if (isset($_GET['page'])) {
			$page = $_GET['page'];
				$pagestart = $pagelimit*($page-1);
				$sql .= " limit $pagestart, $pagelimit";
			} else {
				$sql .= " limit 0, $pagelimit";
			}
		}
		$row_comments = get_rows($sql, "array");
		require_once("templates/view_vedio_comment.php");
		break;
		
	case "messages":
		$order = array("DESC" => "按留言日期降序", "ASC"=>"按留言日期升序");	
		$sql = "SELECT * FROM f_messages WHERE reply = 0";
		//排序
		$_SESSION["messages_sort"] = "DESC";
		if(isset($_POST["messages_sort"])){
			if($_POST["messages_sort"] != ""){
				$_SESSION["messages_sort"] = $_POST["messages_sort"];
			}
		}
		if($_SESSION["messages_sort"] != ""){
			$sql .= " ORDER BY publish_time " . $_SESSION["messages_sort"];
		}
		//	分页
		$page_string = "";
		$num_info = get_num($sql);
		if ($num_info >= 1){
		$idb->query_ex($sql);
		$page_string = paginate($idb->conn, $pagelimit);
		if (isset($_GET['page'])) {
			$page = $_GET['page'];
				$pagestart = $pagelimit*($page-1);
				$sql .= " limit $pagestart, $pagelimit";
			} else {
				$sql .= " limit 0, $pagelimit";
			}
		}
		$row_messages = get_rows($sql, "array");
		require_once("templates/view_messages.php");
		break;

        case "p_messages":
                $order = array("DESC" => "按留言日期降序", "ASC"=>"按留言日期升序");
                $sql = "SELECT * FROM q_message";
                //排序
                $_SESSION["p_messages_sort"] = "DESC";
                if(isset($_POST["p_messages_sort"])){
                        if($_POST["p_messages_sort"] != ""){
                                $_SESSION["p_messages_sort"] = $_POST["p_messages_sort"];
                        }
                }
                if($_SESSION["p_messages_sort"] != ""){
                        $sql .= " ORDER BY date_time " . $_SESSION["p_messages_sort"];
                }
                //      分页
                $page_string = "";
                $num_info = get_num($sql);
                if ($num_info >= 1){
                $idb->query_ex($sql);
                $page_string = paginate($idb->conn, $pagelimit);
                if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                                $pagestart = $pagelimit*($page-1);
                                $sql .= " limit $pagestart, $pagelimit";
                        } else {
                                $sql .= " limit 0, $pagelimit";
                        }
                }
                $row_messages = get_rows($sql, "array");
                require_once("templates/view_p_messages.php");
                break;
		
	case "account":
		$disabled = array("all"=>"全部", "0" => "开启", "1"=>"未开启");
		$order = array("DESC" => "按创建日期降序", "ASC"=>"按创建日期升序");
		$sql = "SELECT * FROM f_account WHERE 1=1";
		//开启
		if(isset($_POST["account_able"])){
			$_SESSION["account_able"] = $_POST["account_able"];
		}
		if(isset($_SESSION["account_able"])){
			if($_SESSION["account_able"] != "all"){
				$sql .= " AND disable = " . $_SESSION["account_able"];
			}
		}
		//排序
		if(!isset($_SESSION["create_sort"])){
			$_SESSION["create_sort"] = "DESC";	
		}
		if(isset($_POST["create_sort"])){
			if($_POST["create_sort"] != ""){
				$_SESSION["create_sort"] = $_POST["create_sort"];
			}
		}
		if($_SESSION["create_sort"] != ""){
			$sql .= " ORDER BY create_time " . $_SESSION["create_sort"];
		}
		//	分页
		$page_string = "";
		$num_info = get_num($sql);
		if ($num_info >= 1){
		$idb->query_ex($sql);
		$page_string = paginate($idb->conn, $pagelimit);
		if (isset($_GET['page'])) {
			$page = $_GET['page'];
				$pagestart = $pagelimit*($page-1);
				$sql .= " limit $pagestart, $pagelimit";
			} else {
				$sql .= " limit 0, $pagelimit";
			}
		}
		$row_accounts = get_rows($sql, "array");
		require_once("templates/view_account.php");
		break;

	default:
		bm_die("参数错误！");
		break;
endswitch;
?>
