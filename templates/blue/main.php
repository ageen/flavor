<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo INDEX_TITLE;?> - <?php echo WEBPAGE_TITLE_SUFFIX;?></title>
<link href="<?php echo TEMPATH; ?>css/style.css" type="text/css" rel="stylesheet" />
<link href="<?php echo TEMPATH; ?>css/jquery.ad-gallery.css" type="text/css" rel="stylesheet" />
<link href="<?php echo TEMPATH; ?>css/jsCarousel.css" type="text/css" rel="stylesheet" />
<link href="<?php echo TEMPATH; ?>css/jquery.lightbox-0.5.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo TEMPATH; ?>scripts/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo TEMPATH; ?>scripts/jquery.ad-gallery.js?rand=995"></script>
<script type="text/javascript" src="<?php echo TEMPATH; ?>scripts/jsCarousel.js"></script>
<script type="text/javascript" src="<?php echo TEMPATH; ?>scripts/jquery.lightbox-0.5.min.js"></script>
<script type="text/javascript" src="<?php echo TEMPATH; ?>scripts/jquery.flash.min_.js"></script>
<script type="text/javascript" src="<?php echo TEMPATH; ?>scripts/jquery.lazyload.min.js"></script>
<script type="text/javascript" src="<?php echo TEMPATH; ?>scripts/init.js"></script>
<script type="text/javascript">
$(function() {
	$("img.lazy").lazyload({ 
    	effect : "fadeIn",
		threshold :200,
		failure_limit : 10
	});
});
</script>
</head>
<body>
<!--TOP-->
<?php
require_once("top.php");
?>
<!--BODY-->
<div class="f_frame">
<!--SLIDE-->
<div id="gallery" class="ad-gallery">
	<div class="ad-gallery-canvas">
    <div class="ad-image-wrapper"></div>
    <!--<div class="ad-controls"> </div>-->
    </div>
    <div class="ad-nav">
    	<div class="ad-thumbs">
        <ul class="ad-thumb-list">
<?php
if($row_banners != "nothing"){  
	foreach($row_banners as $k=>$v){
?>
<li><a href='uploads/banner/<?php echo $v['filename'];?>'><img class="lazy" src="<?php echo TEMPATH; ?>images/lightblue.gif" data-original="uploads/banner/thumbnail/<?php echo $v['filename'];?>" title='<?php echo $v['title'];?>' longdesc='<?php echo $v['description'];?>' /></a></li>
<?php
	}	
} else {
?>
<li><a><img title='无BANNER' class="lazy" src="<?php echo TEMPATH; ?>images/lightblue.gif" data-original='<?php echo TEMPATH; ?>images/no-banner_thumb.png' class='image'></a></li>
<?php
}
?>
		</ul>
		</div>
	</div>
</div>
<div style="clear:both;"></div>
<!--ARTICLE-->
<div class="f_article">
<div class="f_article_micro_blog">
<div class="f_menu_bar">
<div class="f_menu_bar_middle" style="width:360px;"><h4>最新微博</h4></div>
</div>
<div class="f_article_micro_blog_content">
<?php
if($row_wi == "nothing"){
?>
<div class="no_title">无嵌入微薄代码</div>
<?php	
} else {
	echo $row_wi["code"];
}
?>
</div>
</div>
<div class="f_article_note">
<div class="f_menu_bar">
<div class="f_menu_bar_middle" style="width:610px;"><h4>最新发布文章</h4></div>
</div>
<div class="f_article_note_content">
<?php
if($row_articles == "nothing"){
?>
<div class="no_title">暂无文章</div>
<?php	
} else {
	foreach($row_articles as $k=>$v){
		$sql = "SELECT id FROM f_article_comment WHERE article_id = " . $v["id"];
		$comment_num = get_num($sql);
?>
<dl>
<dt><a href="detail.php?mode=article&id=<?php echo $v["id"];?>"><?php echo $v["title"];?></a></dt>
<dd class="f_article_note_content_text"><?php echo csubstr(HtmToText($v["content"]), 60, "...");?></dd>
<dd class="f_article_note_content_bottom"><?php echo $v["publish_time"];?>&nbsp;&nbsp;<a href="view.php?mode=article_comment&id=<?php echo $v["id"];?>">共<?php echo $comment_num;?>条评论</a>&nbsp;</dd>
</dl>
<?php		
	}	
}
?>
<div class="f_coner_left"></div>
<div class="f_coner_right"></div>
</div>
</div>
</div>
<div style="clear:both;"></div>
<!--Vedio-->
<div class="f_vedio">
<div class="f_vedio_recommend">
<div class="f_ceil_left"></div>
<div class="f_ceil_right"></div>
<div class="f_coner_left"></div>
<div class="f_coner_right"></div>
<div class="f_vedio_content">
<?php
if($row_vedio_recommend == "nothing"){
?>
<img class="lazy" src="<?php echo TEMPATH; ?>images/lightblue.gif" data-original="<?php echo TEMPATH; ?>images/no-logox390.jpg" />
<?php		
} else {
?>
<div id="myplayer">
<script type="text/javascript">
    $(document).ready(function(){
        $('#myplayer').flash({
            'src':'<?php echo TEMPATH; ?>swf/gddflvplayer.swf',
            'width':'390',
            'height':'350',
            'allowfullscreen':'true',
            'allowscriptaccess':'always',
            'wmode':'transparent',
            'flashvars': {
                'vdo':'../../../uploads/vedio/<?php echo $row_vedio_recommend["filename"];?>',
                'sound':'50',
<?php
if($row_vedio_recommend["thumbnail"] != ""){
?>
			'splashscreen':'uploads/vedio/thumbnail/<?php echo $row_vedio_recommend["thumbnail"];?>',
<?php
} else {
?>
			'splashscreen':'<?php echo TEMPATH; ?>images/no-logo.jpg',
<?php
}
?>
            'autoplay':'false',
//			'clickTAG':"http://www.smallcell.me/detail.php?mode=vedio&id=<?php echo $row_vedio_recommend["id"];?>",
            'endclipaction':'javascript:endclip();'
            }
        });
    });
</script>
</div>
<?php
}
?>
</div>
<?php
if($row_vedio_recommend=="nothing"){
?>
<div class="f_vedio_title"><h4><span class='no_title'>无推荐视频</span></h4></div>
<div class="f_vedio_description"></div>
<?php	
} else {
?>
<div class="f_vedio_title"><h4><span class='have_title'><a href='detail.php?mode=vedio&id=<?php echo $row_vedio_recommend["id"];?>'><?php echo $row_vedio_recommend["title"];?></a></span></h4></div>
<div class="f_vedio_description"><?php echo $row_vedio_recommend["description"] == ""?"无视频简介":$row_vedio_recommend["description"];?></div>
<?php	
}
?>
</div>
<div class="f_vedio_new">
<div class="f_menu_bar">
<div class="f_menu_bar_middle" style="width:570px;"><h4>最新视频</h4></div>
</div>
<div class="f_vedio_new_content">
<?php
if($row_vedios == "nothing"){
?>
<div class='no_title'>暂无视频</div>
<?php
} else {
	foreach($row_vedios as $k=>$v){
?>
<div class="new_vedio_list">
<?php
if(empty($v["thumbnail"])){
?>
<div class="new_vedio_thumb"><a href="detail.php?mode=vedio&id=<?php echo $v["id"];?>"><img class="lazy" src="<?php echo TEMPATH; ?>images/lightblue.gif" data-original="<?php echo TEMPATH; ?>images/no_thumb.jpg" /></a></div>
<?php	
} else {
?>
<div class="new_vedio_thumb"><a href="detail.php?mode=vedio&id=<?php echo $v["id"];?>"><img class="lazy" src="<?php echo TEMPATH; ?>images/lightblue.gif" data-original="uploads/vedio/thumbnail/<?php echo $v["thumbnail"];?>" /></a></div>
<?php
}
?>
<div class="new_vedio_title"><a href="detail.php?mode=vedio&id=<?php echo $v["id"];?>" title="<?php echo $v['title'];?>"><?php echo csubstr($v['title'],25);?></a></div>
</div>
<?php
	}	
}
?>
<div class="f_coner_left"></div>
<div class="f_coner_right"></div>
</div>
</div>
</div>
<div style="clear:both;"></div>
<!--gallery-->
<div id="jsCarousel">
<?php
if($row_photo_scroll == "nothing"){
?>
<div><img src="<?php echo TEMPATH; ?>images/no-scroll.png" /></div>
<?php
} else {
	foreach($row_photo_scroll as $k=>$v){
?>
<div><a href="uploads/photo/<?php echo $v["filename"];?>" title="<?php echo $v["title"];?>" class="lightbox"><img src="uploads/photo/thumbnail/<?php echo $v["filename"];?>" /></a></div>
<?php	
	}
}
?>
</div>
<div style="clear:both;"></div>
<?php
require_once("footer.php");
?>
<!--END BODY-->
</body>
</html>
<script type="text/javascript">
$(function(){
	//	reload iframe
	//parent.iframe_w.location.reload()
	//	gallery show
	var galleries,effect = null;
	start();
	function start(){
		galleries = $('.ad-gallery').adGallery();
		galleries[0].settings.effect = "<?php echo BANNER_EFFECT;?>";
	}
	
	//	slide show
	$('#jsCarousel').jsCarousel({ onthumbnailclick: function(){ $(".lightbox").lightBox() }, autoscroll:true });
});
</script>
