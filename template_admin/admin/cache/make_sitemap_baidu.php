<ul class="nav nav-tabs" role="tablist">
<li><a href="{$base_url}/index.php?case=cache&act=make_show&admin_dir={get('admin_dir')}&site=default">内容</a></li>
<li><a href="{$base_url}/index.php?case=cache&act=make_list&admin_dir={get('admin_dir')}&site=default">栏目</a></li>
<li><a href="{$base_url}/index.php?case=cache&act=make_type&admin_dir={get('admin_dir')}&site=default">分类</a></li>
<li><a href="{$base_url}/index.php?case=cache&act=make_special&admin_dir={get('admin_dir')}&site=default">专题</a></li>
<li><a href="{$base_url}/index.php?case=cache&act=make_tag&admin_dir={get('admin_dir')}&site=default">标签</a></li>
<li><a href="{$base_url}/index.php?case=cache&act=make_sitemap_google&admin_dir={get('admin_dir')}&site=default">Google地图</a></li>
<li class="active"><a href="{$base_url}/index.php?case=cache&act=make_sitemap_baidu&admin_dir={get('admin_dir')}&site=default">百度地图</a></li>
<li><a href="{$base_url}/index.php?case=cache&act=ctsitemap">网站地图</a></li>
<li><a href="{$base_url}/index.php?case=cache&act=make_index&admin_dir={get('admin_dir')}&site=default">首页</a></li>
</ul>
<div class="blank30"></div>

<form name='formxmlmap' method='post' action='<?php echo url('cache/make_baidu') ?>'>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">总输出数量</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<input name='XmlOutNum' id='XmlOutNum' value='450' class="form-control" />
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="地图总输出数量！"></span>
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">每页连接数</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<input name='XmlMaxPerPage' value='90' id='XmlMaxPerPage' class="form-control" />
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="每页连接数,百度规范要求不得大于100！"></span>
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">更新频率</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<input name='frequency' id='frequency' value='1440' class="form-control" />
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="更新周期，以分钟为单位！"></span>
</div>
</div>


<div class="blank30"></div>
<div class="line"></div>
<div class="blank30"></div>
<input name='submit' type='submit' id='submit' value='生成' class="btn btn-primary">
</form>
