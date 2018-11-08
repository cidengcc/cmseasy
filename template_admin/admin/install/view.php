<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>易通CMS-免费企业建站程序安装数据库</title>
    <link rel="shortcut icon" href="{$base_url}/favicon.ico" type="image/x-icon"/>
    <!-- 调用样式表 -->
    <link type="text/css" rel="stylesheet" media="all" href="{$skin_path}/css/install.css"/>

</head>
<body>

<style type="text/css">
    .go {
        background: url({$skin_path}/images/go_3.gif) center top no-repeat;
    }
#view {padding: 10px;background: #fff;border: 1px solid #CCC;line-height: 200%; font-size:12px; color:#888; }
</style>


<div id="header">
    <div class="box">
        <img src="{$skin_path}/images/logo.png" class="logo"/>
    </div>
    <div class="top_right">
        <ul>
            <li><span>您好<strong>！</strong></li>
            <li><a href="http://www.cmseasy.cn" target="_blank">官方网站</a> | <a
                    href="http://www.cmseasy.cn/service_1.html" target="_blank">商业授权</a> | <a
                    href="http://www.cmseasy.org" target="_blank">问题交流</a> | <a href="http://www.cmseasy.cn/chm/"
                                                                                target="_blank">在线教程？</a></li>
        </ul>
    </div>
</div>

<div id="nav">
    欢迎使用 CmsEasy！
</div>

<div class="box">
    <div class="blank10"></div>
    <div class="blank30"></div>
    <div class="go"></div>
    <div class="blank30"></div>
    <div class="blank10"></div>
<div style="padding:10px 4px 4px 10px; background:#eee;border:1px solid #CCC;line-height:200%;">
    <iframe name="view" id="view"  src="<?php echo url::create('install/database'); ?>" width="770" height="180" color="#888"></iframe>
</div>
</div>

<div class="clear"></div>

<div class="blank30"></div>
<div class="copy">
    {getCopyRight()}
</div>
<div class="blank30"></div>

</body>
</html>

