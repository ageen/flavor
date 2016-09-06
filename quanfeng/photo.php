<?php
require("global.php");
$db = new Db();
//Pageinate
$pagesize = 5;
$column = $db->column("SELECT id FROM q_photo");
$count = count($column);
$num = ceil($count / $pagesize);
?>
<!doctype html>
<html>
<head>
<META content="IE=10.000" http-equiv="X-UA-Compatible">
<META charset="utf-8">
<meta name='HandheldFriendly' content='True'>
<meta name='MobileOptimized' content='320'>
<meta name='format-detection' content='telephone=no'>
<meta name='viewport' content='width=device-width, minimum-scale=1.0, maximum-scale=1.0'>
<meta http-equiv='cleartype' content='on'>
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<title>球队图片</title>
<link rel="stylesheet" href="css/reset.css">
<link rel="stylesheet" href="css/waterfall.css">
<script src="js/jquery-1.9.1.min.js"></script>
</head>
<body>
<div id="header">
    <h1>球队图片</h1>
</div>
<div id="container"></div>
<div id="page-navigation" class="hide clear">无更多图片</div>
<!-- #page-navigation -->
<script type="text/x-handlebars-template" id="waterfall-tpl">
{{#result}}
    <div class="item">
        <img src="{{image}}" width="{{width}}" height="{{height}}" />
    </div>
{{/result}}
</script>

<script src="js/libs/handlebars/handlebars.js"></script>
<script src="js/waterfall.min.js"></script>
<script>
$('#container').waterfall({
    itemCls: 'item',
    colWidth: 310,  
    gutterWidth: 15,
    gutterHeight: 15,
    maxPage: <?php echo $num;?>,
    checkImagesLoaded:true,
	dataType: 'html',
    callbacks: {
        
        loadingFinished: function($loading, isBeyondMaxPage) {
            if ( !isBeyondMaxPage ) {
                $loading.fadeOut();
            } else {
                $loading.hide();
                $('#page-navigation').show();
            }
        },
        renderData: function (data, dataType) {
            var tpl,
                template,
                resultNum = data.total;
                
            if ( resultNum < 20) {
                $('#container').waterfall('pause', function() {
                    $('#waterfall-message').html('<p style="color:#666;">无更多图片...</p>')
                    //alert('no more data');
                });
            }
            if ( dataType === 'json' ||  dataType === 'jsonp'  ) { // json or jsonp format
                tpl = $('#waterfall-tpl').html();
                template = Handlebars.compile(tpl);
    
                return template(data);
            } else { // html format
                return data;
            }
        }
    },
    path: function(page) {
        return 'data/data.php?page=' + page;
    }
});
</script>
</body>
</html>
