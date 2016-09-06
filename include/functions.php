<?php
function set_cookie($name, $value = "", $cookiedate = 0){
	global $_COOKIE,$_SERVER,$cookiedomain,$cookiepath,$cookieprename;
	$timestamp = time();
	$cookiedomain = $cookiedomain == "" ? ""  : $cookiedomain;
	$cookiepath   = $cookiepath   == "" ? "/" : $cookiepath;
	$name = $cookieprename.$name;
	$_COOKIE[$name] = $value;
	setcookie($name, $value, $cookiedate ? $timestamp + $cookiedate : 0, $cookiepath, $cookiedomain, $_SERVER['SERVER_PORT'] == 443 ? 1 : 0);
}
function set_session() {
	if (!isset($_SESSION)) {
		session_start();	
	}	
}
function destroy_session($var = '') {
	if ($var == '') {
		$_SESSION = array();
		if (isset($_COOKIE[session_name()])) {
			setcookie(session_name(), '', time()-2592000, '/');	
		}
		session_destroy();
	} else {
		$_SESSION[$var] = NULL;
		unset($_SESSION[$var]);
	}
}
function get_user_ip() {
	if (isset($_SERVER['HTTP_CLIENT_IP']) && $_SERVER['HTTP_CLIENT_IP']!='unknown') {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR']!='unknown') {
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	return $ip;
}
function random($length, $numeric = 0) {
	PHP_VERSION < '4.2.0' && mt_srand((double)microtime() * 1000000);
	if($numeric) {
		$hash = sprintf('%0'.$length.'d', mt_rand(0, pow(10, $length) - 1));
	} else {
		$hash = '';
		$chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789abcdefghjkmnpqrstuvwxyz';
		$max = strlen($chars) - 1;
		for($i = 0; $i < $length; $i++) {
			$hash .= $chars[mt_rand(0, $max)];
		}
	}
	return $hash;
}
function redirect($url,$mode="")
/*  It redirects to a page specified by "$url".
 *  $mode can be:
 *    LOCATION:	Redirect via Header "Location".
 *    REFRESH:	Redirect via Header "Refresh".
 *    META:		Redirect via HTML META tag
 *    JS:		Redirect via JavaScript command
 */
{
  if (strncmp('http:',$url,5) && strncmp('https:',$url,6)) {
     $starturl = ($_SERVER["HTTPS"] == 'on' ? 'https' : 'http') . '://'.
                 (empty($_SERVER['HTTP_HOST'])? $_SERVER['SERVER_NAME'] :
                 $_SERVER['HTTP_HOST']);
     if ($url[0] != '/') $starturl .= dirname($_SERVER['PHP_SELF']).'/';
     $url = "$starturl$url";
  }

	switch($mode) {
    	case 'LOCATION': 
			if (headers_sent()) exit("Headers already sent. Can not redirect to $url");
				header("Location: $url");
				exit;

		case 'REFRESH': 
			if (headers_sent()) exit("Headers already sent. Can not redirect to $url");
			header("Refresh: 0; URL=\"$url\""); 
			exit;
		case 'META': 
?>
<meta http-equiv="refresh" content="0;url=<?php echo $url; ?>" />
<?php
	exit;
		default: /* -- Java Script */
?>
<script type="text/javascript">window.location.href='<?php echo $url; ?>';</script>
<?php
	}
	exit;
}

function get_rows($query, $type = "default"){
	global $idb;
	if ($query == ""){
		bm_die("QUERY STRING EMPTY!","ERROR");	
	}
	if ($result = $idb->query_ex($query)){
		$num = $idb->return_num($result);
		if ($num == 1) {
			if ($type == "default"){
				$rows = $idb->return_array($result, "assoc");
			} elseif ($type == "array") {
				$rows[] = $idb->return_array($result, "assoc");
			}
		} elseif($num >= 2) {
			while($row = $idb->return_array($result, "assoc")){
				$rows[] = $row;	
			}		
		} else {
			$rows = "nothing";
		}
	} else {
		$idb->print_error();
	}
	$idb->free_result($result);
	return $rows;
}

function get_num($query){
	global $idb;
	if ($query == ""){
		bm_die("QUERY STRING EMPTY!","ERROR");	
	}
	if ($result = $idb->query_ex($query)){
		$num = $idb->return_num($result);
	} else {
		$idb->print_error();	
	}
	$idb->free_result($result);
	return $num;
}

function my_strpos($mystr,$findme){
	if (strpos($mystr, $findme) === false) {
		return false;
	} else {
		return true;
	}
}

function paginate($db, $limit = 10) {
	global $admin;
	global $idb;
	
	$sql = 'SELECT FOUND_ROWS();';
	$result = $idb->query_ex($sql);
	$row = $idb->return_array($result, "num");
//	$result = mysql_query($sql, $db) or die(mysql_error($db));
//	$row = mysql_fetch_array($result);
	$numrows = $row[0];
	
	if ($numrows > $limit) {
		if (isset($_GET['page'])) {
			$page = $_GET['page'];	
		} else {
			$page = 1;	
		}
		$pagelinks = '<ul>';
		$currpage = $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'];
		$currpage = str_replace('&page=' . $page, '', $currpage);
		
		if ($page == 1) {
			$pagelinks .= "<li class='disabled'><a>&laquo;</a></li>";
		} else {
			$pageprev = $page - 1;
			$pagelinks .= "<li class='active'><a href=$currpage&page=$pageprev>&laquo;</a></li>";
		}
		
		$numofpages = ceil($numrows / $limit);
		$range = $admin['pageRange']['value'];
		if ($range == '' or $range ==0) {
			$range = 6;	
		}
		$lrange = max(1, $page - (($range - 1) / 2));
		$rrange = min($numofpages, $page + (($range - 1) / 2));
		if (($rrange - $lrange) < ($range - 1)) {
			if ($lrange == 1) {
				$rrange = min($lrange + ($range - 1), $numofpages);	
			} else {
				$lrange = max($rrange - ($range - 1), 0);
			}
		}
		
		if ($lrange > 1) {
			$pagelinks .= "<li class='disabled'><a>..</a></li>";
		} else {
			$pagelinks .= "<li class='disabled'><a>&nbsp;&nbsp;</a></li>";	
		}
		for ($i = 1; $i <= $numofpages; $i++) {
			if ($i == $page) {
				$pagelinks .= "<li class='disabled'><a>$i</a></li>";
			} else {
				if ($lrange <= $i and $i <= $rrange) {	
					$pagelinks .= "<li class='active'><a href=$currpage&page=$i>$i</a></li>";
				}	
			}
		}
		if ($rrange < $numofpages) {
			$pagelinks .= "<li class='disabled'><a>..</a></li>";	
		} else {
			$pagelinks .= "<li class='disabled'><a>&nbsp;&nbsp;</a></li>";
		}
		
		if (($numrows - ($limit * $page)) > 0) {
			$pagenext = $page + 1;
			$pagelinks .= "<li class='active'><a href=$currpage&page=$pagenext>&raquo;</a></li>";
		} else {
			$pagelinks .= "<li class='disabled'><a>&raquo;</a></li>";
		}
		$pagelinks .= '</ul>';
		$pagelinks = "<div class='pageinate_info'>共".$numrows."条记录 当前第".$page."/".$numofpages."页</div>".$pagelinks;
	} else {
		//$pagelinks = 'nothing';
		$pagelinks = "<div class='pageinate_info'>共".$numrows."条记录</div>";
	}
	return $pagelinks;
}
function get_value($val){
	if(isset($_GET[$val])){
		return $_GET[$val];	
	}elseif(isset($_POST[$val])){
		return $_POST[$val];
	}else{
		return NULL;
	}
}
//---------------------------------------------------------------------------------------------
/*
 * @todo 中文截取，支持gb2312,gbk,utf-8,big5 
 * @param string $str 要截取的字串
 * @param int $length 截取长度
 * @param $suffix 是否加尾缀
 * @param int $start 截取起始位置
 * @param string $charset utf-8|gb2312|gbk|big5 编码
 */
function csubstr($str,$length,$suffix=FALSE,$start=0){
	if (function_exists('mb_substr')) {
		$more = (mb_strlen($str) > $length) ? TRUE : FALSE;
		$text = mb_substr($str, $start, $length, DB_CHARSET);
		if($suffix && $more) $text.=" ...";
	} elseif (function_exists('iconv_substr')) {
		$more = (iconv_strlen($str) > $length) ? TRUE : FALSE;
		$text = iconv_substr($str, $start, $length, DB_CHARSET);
		if($suffix && $more) $text.=" ...";
	} else {
		$re['gbk'] = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
		$re['utf8'] = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
		preg_match_all($re[DB_CHARSET], $str, $match);
		$text = join("",array_slice($match[0], $start, $length));
		if (count($match[0])>$length) {
			$more = TRUE;
			$text = join("",array_slice($match[0],0,$length)); 
		} else {
			$more = FALSE;
			$text = join("",array_slice($match[0],0,$length)); 
		}
		if($suffix && $more) $text.=" ...";
	}
	return $text;
}

//中文长度
Function cstrlen($str){
	if (function_exists('mb_substr')) {
		$len = mb_strlen($str,DB_CHARSET);
		return $len;
	} elseif (function_exists('iconv_substr')) {
		$len = iconv_strlen($str,DB_CHARSET);
		return $len;
	} else {
		$re['gbk'] = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
		$re['utf8'] = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
		preg_match_all($re[DB_CHARSET], $str, $match);
		$len =count($match[0]);
		return $len;
	} 
}
//截取HTML
function htmlSubString($content,$maxlen=300,$suffix=FALSE){
	$content = preg_split("/(<[^>]+?>)/si",$content, -1,PREG_SPLIT_NO_EMPTY| PREG_SPLIT_DELIM_CAPTURE);
	$wordrows=0;	$outstr="";	$wordend=false;	$beginTags=0;	$endTags=0;	
	foreach($content as $value){
		if (trim($value)=="") continue;
		
		if (strpos(";$value","<")>0){
			if (!preg_match("/(<[^>]+?>)/si",$value) &&cstrlen($value)<=$maxlen) {
				$wordend=true;
				$outstr.=$value;
			}
			if ($wordend==false){
				$outstr.=$value;
				if (!preg_match("/<img([^>]+?)>/is",$value)&& !preg_match("/<param([^>]+?)>/is",$value)&& !preg_match("/<!([^>]+?)>/is",$value)&& !preg_match("/<[br|BR]([^>]+?)>/is",$value)&& !preg_match("/<hr([^>]+?)>/is",$value)&&!preg_match("/<\/([^>]+?)>/is",$value)) {
					$beginTags++;
				}else{
					if (preg_match("/<\/([^>]+?)>/is",$value,$matches)){
						$endTags++;
					}
				}
			}else{
				if (preg_match("/<\/([^>]+?)>/is",$value,$matches)){
					$endTags++;
					$outstr.=$value;
					if ($beginTags==$endTags && $wordend==true) break;
				}else{
					if (!preg_match("/<img([^>]+?)>/is",$value) && !preg_match("/<param([^>]+?)>/is",$value) && !preg_match("/<!([^>]+?)>/is",$value) && !preg_match("/<[br|BR]([^>]+?)>/is",$value) && !preg_match("/<hr([^>]+?)>/is",$value)&& !preg_match("/<\/([^>]+?)>/is",$value)) {
						$beginTags++; 
						$outstr.=$value;
					}
				}
			}
		}else{
			if (is_numeric($maxlen)){
				$curLength=cstrlen($value);
				$maxLength=$curLength+$wordrows;
				if ($wordend==false){
					if ($maxLength>$maxlen){
						$outstr.=csubstr($value,$maxlen-$wordrows,FALSE,0);
						$wordend=true;
					}else{
						$wordrows=$maxLength;
						$outstr.=$value;
					}
				}
			}else{
				if ($wordend==false) $outstr.=$value;
			}
		}
	}
	while(preg_match("/<([^\/][^>]*?)><\/([^>]+?)>/is",$outstr)){
		$outstr=preg_replace_callback("/<([^\/][^>]*?)><\/([^>]+?)>/is","strip_empty_html",$outstr);
	}
	if (strpos(";".$outstr,"[html_")>0){
		$outstr=str_replace("[html_&lt;]","<",$outstr);
		$outstr=str_replace("[html_&gt;]",">",$outstr);
	}
	if($suffix&&cstrlen($outstr)>=$maxlen)$outstr.="．．．";
	return $outstr;
}
//去掉多余的空标签
function strip_empty_html($matches){
	$arr_tags1=explode(" ",$matches[1]);
	if ($arr_tags1[0]==$matches[2]){
		return "";
	}else{
		$matches[0]=str_replace("<","[html_&lt;]",$matches[0]);
		$matches[0]=str_replace(">","[html_&gt;]",$matches[0]);
		return $matches[0];
	}
}

//HTML TO TEXT
function HtmToText($htm){
	$search = array ("'<script[^>]*?>.*?</script>'si","'<[\/\!]*?[^<>]*?>'si","'([\r\n])[\s]+'","'&(quot|#34);'i","'&(amp|#38);'i","'&(lt|#60);'i","'&(gt|#62);'i","'&(nbsp|#160);'i","'&(iexcl|#161);'i","'&(cent|#162);'i","'&(pound|#163);'i","'&(copy|#169);'i","'&#(\d+);'e");
	$replace = array ("", "", "\\1", "\"", "&", "<", ">", " ", chr(161), chr(162), chr(163), chr(169), "chr(\\1)");
	$text = preg_replace ($search, $replace, $htm);
	return $text;
}

function stripslashes_deep($value)
{
	$value = is_array($value)?array_map('stripslashes_deep', $value):stripslashes($value);
	return $value;
}