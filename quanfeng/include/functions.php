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
		
		if (session_id != "" || isset($_COOKIE[session_name()])) {
			setcookie(session_name(), '', time()-2592000, '/');
		}
		session_destroy();
	} else {
		$_SESSION[$var] = NULL;
		unset($_SESSION[$var]);
	}
}
function random($length, $numeric = 0) {
	PHP_VERSION < '4.2.0' && mt_srand((double)microtime() * 1000000);
	if($numeric) {
		$hash = sprintf('%0'.$length.'d', mt_rand(0, pow(10, $length) - 1));
	} else {
		$hash = '';
		$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$max = strlen($chars) - 1;
		for($i = 0; $i < $length; $i++) {
			$hash .= $chars[mt_rand(0, $max)];
		}
	}
	return $hash;
}
function get_token(){
	$hash = md5(uniqid(rand(), true));
	$token = $hash.session_id();
	return $token;
}
function check_form(){
	if($_POST['qm_token']=='' || $_SESSION['token']=='' || $_POST['qm_token'] != $_SESSION['token']){
		exit('Illegal submission!');
	}
}
function token_input(){
	$token = get_token();
	$_SESSION["token"] = $token;
	echo "<input type='hidden' name='qm_token' value='".$token."' />";
}
function redirect($url,$mode = "LOCATION")
/*  It redirects to a page specified by "$url".
 *  $mode can be:
 *    LOCATION:	Redirect via Header "Location".
 *    REFRESH:	Redirect via Header "Refresh".
 *    META:		Redirect via HTML META tag
 *    JS:		Redirect via JavaScript command
 */
{
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

function getAuthImage($text) {
	$im_x = 98;
	$im_y = 37;
	$im = imagecreatetruecolor($im_x,$im_y);
	$text_c = ImageColorAllocate($im, mt_rand(0,100),mt_rand(0,100),mt_rand(0,100));
	$tmpC0=mt_rand(100,255);
	$tmpC1=mt_rand(100,255);
	$tmpC2=mt_rand(100,255);
	$buttum_c = ImageColorAllocate($im,249,254,234);
	imagefill($im, 16, 13, $buttum_c);

	$font = 'include/t1.ttf';

	for ($i=0;$i<strlen($text);$i++)
	{
		$tmp =substr($text,$i,1);
		$array = array(-1,1);
		$p = array_rand($array);
		$an = $array[$p]*mt_rand(1,10);
		$size = 18;
		imagettftext($im, $size, $an, $i*$size, 30, $text_c, $font, $tmp);
	}
	$distortion_im = imagecreatetruecolor ($im_x, $im_y);
	imagefill($distortion_im, 16, 13, $buttum_c);
	for ( $i=0; $i<$im_x; $i++) {
		for ( $j=0; $j<$im_y; $j++) {
			$rgb = imagecolorat($im, $i , $j);
			if( (int)($i+20+sin($j/$im_y*2*M_PI)*10) <= imagesx($distortion_im)&& (int)($i+20+sin($j/$im_y*2*M_PI)*10) >=0 ) {
				imagesetpixel ($distortion_im, (int)($i+10+sin($j/$im_y*2*M_PI-M_PI*0.1)*4) , $j , $rgb);
			}
		}
	}
	$count = 160;
	for($i=0; $i<$count; $i++){
		$randcolor = ImageColorallocate($distortion_im,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
		imagesetpixel($distortion_im, mt_rand()%$im_x , mt_rand()%$im_y , $randcolor);
	}
	$rand = mt_rand(5,30);
	$rand1 = mt_rand(15,25);
	$rand2 = mt_rand(5,10);
	for ($yy=$rand; $yy<=+$rand+2; $yy++){
		for ($px=-80;$px<=80;$px=$px+0.1)
		{
			$x=$px/$rand1;
			if ($x!=0)
			{
				$y=sin($x);
			}
			$py=$y*$rand2;
			imagesetpixel($distortion_im, $px+80, $py+$yy, $text_c);
		}
	}
	Header("Content-type: image/JPEG");
	ImagePNG($distortion_im);
	ImageDestroy($distortion_im);
	ImageDestroy($im);
}
?>
