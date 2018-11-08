<ul class="nav nav-tabs" role="tablist">
<li><a href="{$base_url}/index.php?case=database&act=baker&admin_dir={get('admin_dir')}&site=default">备份数据库</a></li>
<li><a href="{$base_url}/index.php?case=database&act=restore&admin_dir={get('admin_dir')}&site=default">还原数据库</a></li>
<li><a href="{$base_url}/index.php?case=adminlogs&act=manage&admin_dir={get('admin_dir')}&site=default">日志管理</a></li>
<li><a href="{$base_url}/index.php?case=database&act=str_replace&admin_dir={get('admin_dir')}&site=default">替换字符串</a></li>
<li class="active"><a href="{$base_url}/index.php?case=database&act=phpwebinsert&admin_dir={get('admin_dir')}&site=default">导入PHPweb数据</a></li>
<li><a href="{$base_url}/index.php?case=database&act=backAll&admin_dir={get('admin_dir')}&site=default">备份整站</a></li>
</ul>
<div class="blank30"></div>
<script type="text/javascript" src="{$base_url}/common/js/ajaxfileupload.js"></script>
<script type="text/javascript" src="{$base_url}/common/js/ThumbAjaxFileUpload.js"></script>



<form name="form" id="listform"  action="<?php echo uri();?>" method="post">
<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">
数据库表前缀
</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::input('phpweb_prefix')}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="PHPWEB表前缀，不需包含下划线 _！"></span>
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">
数据库文件
</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::upload_file('data','data')}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="只支持.txt和.sql文件格式！"></span>
</div>
</div>



<div class="blank30"></div>
<div class="line"></div>
<div class="blank30"></div>
{form::submit('开始导入')}

</form>