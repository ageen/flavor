<?php
require("global.php");
$db = new Db();
$photo = $db->query("SELECT * FROM q_photo WHERE scroll=1 ORDER BY publish_time DESC LIMIT 8");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<META content="IE=10.000" http-equiv="X-UA-Compatible">
<META charset="utf-8">
<meta name='HandheldFriendly' content='True'>
<meta name='MobileOptimized' content='320'>
<meta name='format-detection' content='telephone=no'>
<meta name='viewport' content='width=device-width, minimum-scale=1.0, maximum-scale=1.0'>
<meta http-equiv='cleartype' content='on'>
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<TITLE>全锋队足球俱乐部</TITLE>
<LINK href="css/style.css" rel="stylesheet" type="text/css">
<style type="text/css">
.iw_poi_title {color:#CC5522;font-size:14px;font-weight:bold;overflow:hidden;padding-right:13px;white-space:nowrap}
.iw_poi_content {font:12px arial,sans-serif;overflow:visible;padding-top:4px;white-space:-moz-pre-wrap;word-wrap:break-word}
</style>
<SCRIPT src="js/jquery-1.9.1.min.js" type="text/javascript"></SCRIPT>
<SCRIPT src="js/jquery.easing.1.3.js" type="text/javascript"></SCRIPT>
<script>	
$(document).ready(function () {
	$('#accordion a.item').click(function () {
			/* FIRST SECTION */
			//slideup or hide all the Submenu
			$('#accordion li').children('ul').slideUp('fast');	
			//remove all the "Over" class, so that the arrow reset to default
			$('#accordion a.item').each(function () {
				if ($(this).attr('rel')!='') {
					$(this).removeClass($(this).attr('rel') + 'Over');	
				}
			});
			/* SECOND SECTION */
			//show the selected submenu
			$(this).siblings('ul').slideDown('fast');
			//add "Over" class, so that the arrow pointing down
			$(this).addClass($(this).attr('rel') + 'Over');			
			return false;
		});	
	});	
</script>
<script type="text/javascript" src="http://api.map.baidu.com/api?key=&v=1.1&services=true"></script>
</HEAD>
<body>
<div id="mask"></div>
<header>
<h1>全锋足球队</h1>
</header>
<div id='gallery'>
<div id='mySwipe' style='max-width:500px;margin:0 auto'>
<div class='swipe-wrap'>
<?php
if($photo == false){
?>
<div style='line-height:30px;'>暂无图片</div>
<?php
}else{
	foreach($photo as $k=>$v){
?>
<div><img src="uploads/photo/<?php echo $v['filename'];?>" /></div>
<?php
	}
}
?>
</div>
</div>
<nav>
<a href='#' id='prev' onclick='mySwipe.prev();return false;'><em>上一张</em></a>
<span id='position'>quanfeng club</span>
<a href='#' id='next' onclick='mySwipe.next();return false;'><em>下一张</em></a>
</nav>
</div>
<div class="show_logo">&nbsp;</div>
<ul id="accordion" style="background:#191D1F;">
	<li>
		<a href="#" class="item popular" rel="popular">全锋队介绍</a>
		<ul>
			<li style="background:#fff;">全锋队为重庆一支业余足球队，团队成员个个积极热心，曾在球场上落后十球的情况下还跑去抢救球场边围观的因癫痫倒地的中年男子。在路人倒地扶不扶这个尖锐的社会话题面前，我们全锋队给了答案。全锋队前身为“抓个球”，创建于2012年。因“抓个球”队名过于豪爽不羁，不适合小伙伴们严肃，稳重的性格故而改名为“全锋队”，顾名思义，我们全是前锋，你害怕了吗？</li>
		</ul>
	</li>
	<li>
		<a href="#" class="item category" rel="category">主场地址</a>
        <ul><li><div style="width:100%;height:300px;border:#ccc solid 1px;" id="dituContent"></div></li></ul>
	</li>
        <li><a href="photo.php" class="category">球队照片</a></li>
    <li>
    <a href="#" class="item category" rel="backmusic">背景音乐</a>
        <ul><li style="text-align:center;">
<audio controls="controls" autoplay='autoplay' height="100" width="100">
<source src="music/ola.mp3" type="audio/mp3" />
<embed height="100" width="100" autostart="true" src="music/ola.mp3" />
</audio>       
        </li></ul>
    </li>
    <li>
    <a href="#" class="item category" rel="backmusic">留言板</a>
    <ul class="message" id="message_show"></ul>
    </li>
    <li>&nbsp;</li>
</ul>
<div style="text-align:center; line-height:30px; position:fixed; bottom:80px;right:15px; width:48px; height:48px;"><a href="#"><img src="images/totop.png" /></a></div>
<div style="text-align:center; line-height:30px; position:fixed; bottom:0;right:0; width:81px; height:59px;"><img src="images/message.png" onClick="pop_message_box();" /></div>
<!--Message Box-->
<div id="message_box" class="login-popup">
<a href="#" class="close" onClick="close_box()"><img src="images/close.png" /></a>
<div id="login-content">
<form id="message_send" name="message_send" method="post">
<h4 style="color:#fff; line-height:30px;">留个言</h4>
<div class="message_bar"><textarea name="message_content" id="message_content" type='text' rows="10" cols="25" placeholder="说点什么"></textarea><span class="message_warning"></span></div>
<div class="message_bar"><label style="color:#FFF;">留个名</label><input type="text" name="send_user" id="send_user" placeholder="留个名吧" /><span class="message_warning"></span></div>
<div class="message_bar"><button type="submit">发送</button></div>
<?php token_input();?>
</form>
</div>
</div>
<!-- END Message Box -->
</body>
</HTML>
<script src='js/swipe.js'></script>
<script type="text/javascript">
var elem = document.getElementById('mySwipe');
window.mySwipe = Swipe(elem, {
  // startSlide: 4,
  auto: 3000,
  // continuous: true,
  // disableScroll: true,
  // stopPropagation: true,
  // callback: function(index, element) {},
  // transitionEnd: function(index, element) {}
});
</script>
<SCRIPT src="js/jquery.validate.js" type="text/javascript"></SCRIPT>
<script type="text/javascript">
$(document).ready(function() {
	$('#message_show').load('message.php');
	$("#message_send").validate({
		rules:{
			message_content:{required:true},
			send_user:{required:true}
		},
		messages:{
			message_content:{required:"留言内容为空"},
			send_user:{required:"留个名"}
		},
		errorPlacement: function(error, element) {
			error.appendTo(element.next("span"));
		},submitHandler : function(form) {
			$.ajax({
				type: "POST",
				url: "save.php",
				data: $("#message_send").serialize(),
				success: function(msg){
					if(msg=="fail"){
						alert('留言失败')
						return false;
					} else if(msg == "success"){
						alert('留言成功')
						$('#message_content').val('');
						$('#send_user').val('');
						close_box()
						$('#message_show').load('message.php');
					} else if(msg == "empty"){
						alert('请输入完整内容！')
						return false;
					} else {
						alert('留言失败')
						return false;
					}
				}
			});
		}
	});
});
</script>
<script type="text/javascript">
function pop_message_box(){
	// Getting the variable's value from a link
	var messageBox = $('#message_box');

	//Fade in the Popup and add close button
	$(messageBox).fadeIn(300);
	//$(loginBox).load('cart_view.php');
	//Set the center alignment padding + border
	var popMargTop = 300;
	var popMargLeft = ($(messageBox).width() + 24) / 2;

	$(messageBox).css({
		'margin-top' : -popMargTop,
		'margin-left' : -popMargLeft
	});

	// Add the mask to body
	$('body').append('<div id="mask"></div>');
	
	$('#mask').fadeIn(300);
	return false;
}
function close_box(){
	$('#mask , #message_box').fadeOut(300 , function() {
		$('#mask').remove();
	});
	return false;
}
</script>
<script type="text/javascript">
    //创建和初始化地图函数：
    function initMap(){
        createMap();//创建地图
        setMapEvent();//设置地图事件
        addMapControl();//向地图添加控件
        addMarker();//向地图中添加marker
    }
    
    //创建地图函数：
    function createMap(){
        var map = new BMap.Map("dituContent");//在百度地图容器中创建一个地图
        var point = new BMap.Point(106.522078,29.533866);//定义一个中心点坐标
        map.centerAndZoom(point,18);//设定地图的中心点和坐标并将地图显示在地图容器中
        window.map = map;//将map变量存储在全局
    }
    
    //地图事件设置函数：
    function setMapEvent(){
        map.enableDragging();//启用地图拖拽事件，默认启用(可不写)
        map.enableScrollWheelZoom();//启用地图滚轮放大缩小
        map.enableDoubleClickZoom();//启用鼠标双击放大，默认启用(可不写)
        map.enableKeyboard();//启用键盘上下左右键移动地图
    }
    
    //地图控件添加函数：
    function addMapControl(){
                        }
    
    //标注点数组
    var markerArr = [{title:"全锋队场地",content:"QF&nbsp;Club<br/>地址：谢家湾正街5号",point:"106.522011|29.533646",isOpen:1,icon:{w:21,h:21,l:0,t:0,x:6,lb:5}}
		 ];
    //创建marker
    function addMarker(){
        for(var i=0;i<markerArr.length;i++){
            var json = markerArr[i];
            var p0 = json.point.split("|")[0];
            var p1 = json.point.split("|")[1];
            var point = new BMap.Point(p0,p1);
			var iconImg = createIcon(json.icon);
            var marker = new BMap.Marker(point,{icon:iconImg});
			var iw = createInfoWindow(i);
			var label = new BMap.Label(json.title,{"offset":new BMap.Size(json.icon.lb-json.icon.x+10,-20)});
			marker.setLabel(label);
            map.addOverlay(marker);
            label.setStyle({
                        borderColor:"#808080",
                        color:"#333",
                        cursor:"pointer"
            });
			
			(function(){
				var index = i;
				var _iw = createInfoWindow(i);
				var _marker = marker;
				_marker.addEventListener("click",function(){
				    this.openInfoWindow(_iw);
			    });
			    _iw.addEventListener("open",function(){
				    _marker.getLabel().hide();
			    })
			    _iw.addEventListener("close",function(){
				    _marker.getLabel().show();
			    })
				label.addEventListener("click",function(){
				    _marker.openInfoWindow(_iw);
			    })
				if(!!json.isOpen){
					label.hide();
					_marker.openInfoWindow(_iw);
				}
			})()
        }
    }
    //创建InfoWindow
    function createInfoWindow(i){
        var json = markerArr[i];
        var iw = new BMap.InfoWindow("<b class='iw_poi_title' title='" + json.title + "'>" + json.title + "</b><div class='iw_poi_content'>"+json.content+"</div>");
        return iw;
    }
    //创建一个Icon
    function createIcon(json){
        var icon = new BMap.Icon("http://app.baidu.com/map/images/us_mk_icon.png", new BMap.Size(json.w,json.h),{imageOffset: new BMap.Size(-json.l,-json.t),infoWindowOffset:new BMap.Size(json.lb+5,1),offset:new BMap.Size(json.x,json.h)})
        return icon;
    }
    
    initMap();//创建和初始化地图
</script>
