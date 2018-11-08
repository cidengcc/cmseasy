<?php
$url = $_GET['url'];
?>    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>ckplayer简单调用演示-手机版</title>
    <!-- width=device-width：让文档的宽度与设备的宽度保持一致，且文档最大的宽度比例是1.0,initial-scale=1：初始的缩放比例,maximum-scale=1：允许用户缩放到的最大比例（对应还有个minimum-scale）, user-scalable=no：不允许用户手动缩放-->
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no" />
    <!--  telephone=no：禁止自动将页面中的数字识别为电话号码, address=no：禁止自动地址转为链接,email=no：禁止自动将email转为链接 -->
    <meta name="format-detection" content="telephone=no,address=no,email=no" />
    <!-- 强制将页面布局为一列 -->
    <meta name="mobileOptimized" content="width" />
    <!-- 申明页面是移动友好的 -->
    <meta name="handheldFriendly" content="true" />
    <!-- 允许用户使用全屏模式浏览 -->
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <!-- 当用户使用全屏浏览时，将状态条设置为黑色 -->
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
</head>
<body>
<div id="video" style="width: 100%; height:100%;"></div>
<script type="text/javascript" src="ckplayer/ckplayer.js"></script>
<script type="text/javascript">
    var videoObject = {
        container: '#video', //容器的ID或className
        variable: 'player',//播放函数名称
        video: [//视频地址列表形式
            ['<?php echo $url;?>', 'video/mp4', '中文标清', 0]
        ]
    };
    var player = new ckplayer(videoObject);
</script>
</body>
</html>
