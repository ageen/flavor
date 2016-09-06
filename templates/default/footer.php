<!--LINKS-->
<div class="f_link">
<div class="f_ceil_left"></div>
<div class="f_ceil_right"></div>
<div class="f_coner_left"></div>
<div class="f_coner_right"></div>
<div class="f_link_title"></div>
<div class="f_link_logo">
<ul>
<?php
$sql = "SELECT * FROM f_link WHERE selected = 1 ORDER BY link_order ASC LIMIT 8";
$row_links = get_rows($sql, "array");
if($row_links == "nothing"){
?>
<li><div class="f_link_logo_img"><a><img class="lazy" src="<?php echo TEMPATH; ?>images/lightblue.gif" data-original="<?php echo TEMPATH; ?>images/no-logo.jpg" /></a></div></li>
<?php
} else {
	foreach($row_links as $k=>$v){
?>
<li><div class="f_link_logo_img"><a href="<?php echo $v["url"];?>" title="<?php echo $v["title"];?>" target="_blank"><img class="lazy" src="<?php echo TEMPATH; ?>images/lightblue.gif" data-original="uploads/logo/<?php echo $v["filename"];?>" /></a></div></li>
<?php	
	}
}
?>
</ul>
</div>
</div>
<!--FOOTER-->
<div class="f_footer">
<div class="f_footer_text">
<ul>
<li><a href="http://weibo.com/u/2660936254" target="_blank">小细胞的微博</a></li>
<li><a href="administrator/index.php" target="_blank">登录后台</a></li>
</ul>
</div>
<div class="f_footer_logo"><img class="lazy" src="<?php echo TEMPATH; ?>images/lightblue.gif" data-original="<?php echo TEMPATH; ?>images/starshine.png" /></div>
<div class="f_footer_sign">
</div>
</div>
</div>
<div style='text-align:center;font-size:12px;'>浙ICP备13037568号</div>
