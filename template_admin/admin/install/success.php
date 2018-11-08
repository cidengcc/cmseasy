<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>易通CMS-免费企业建站程序安装完成</title>
    <link rel="shortcut icon" href="{$base_url}/favicon.ico" type="image/x-icon" />
    <!-- 调用样式表 -->
    <link type="text/css" rel="stylesheet" media="all" href="{$skin_path}/css/install.css" />

</head>
<body>

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

<style type="text/css">
    .go {background:url({$skin_path}/images/go_4.gif) center top no-repeat;}
</style>
<div class="result">
    <h1>恭喜您，CmsEasy已经成功安装完成！</h1>
    <h5>（基于安全考虑，请在安装后修改后台登陆目录名称！！！）</h5>
</div>
<div class="blank20"></div>
<center>
    <input onclick="javascrtpt:window.location.href='{$base_url}/'" class="btn_b" style="margin-right:20px;" value=" 访问网站首页 " />
    <input onclick="javascrtpt:window.location.href='{$base_url}/index.php?case=admin&act=login&admin_dir={get('admin_dir')}&site=default'" class="btn btn-primary" value=" 登陆网站后台 " />
</center>

</div>

<div class="clear"></div>

<div class="blank30"></div>
<div class="copy">
    {getCopyRight()}
</div>
<div class="blank30"></div>

</body>
</html>