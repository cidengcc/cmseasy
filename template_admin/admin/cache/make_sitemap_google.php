<ul class="nav nav-tabs" role="tablist">
<li><a href="{$base_url}/index.php?case=cache&act=make_show&admin_dir={get('admin_dir')}&site=default">内容</a></li>
<li><a href="{$base_url}/index.php?case=cache&act=make_list&admin_dir={get('admin_dir')}&site=default">栏目</a></li>
<li><a href="{$base_url}/index.php?case=cache&act=make_type&admin_dir={get('admin_dir')}&site=default">分类</a></li>
<li><a href="{$base_url}/index.php?case=cache&act=make_special&admin_dir={get('admin_dir')}&site=default">专题</a></li>
<li><a href="{$base_url}/index.php?case=cache&act=make_tag&admin_dir={get('admin_dir')}&site=default">标签</a></li>
<li class="active"><a href="{$base_url}/index.php?case=cache&act=make_sitemap_google&admin_dir={get('admin_dir')}&site=default">Google地图</a></li>
<li><a href="{$base_url}/index.php?case=cache&act=make_sitemap_baidu&admin_dir={get('admin_dir')}&site=default">百度地图</a></li>
<li><a href="{$base_url}/index.php?case=cache&act=ctsitemap">网站地图</a></li>
<li><a href="{$base_url}/index.php?case=cache&act=make_index&admin_dir={get('admin_dir')}&site=default">首页</a></li>
</ul>
<div class="blank30"></div>

<form name='formxmlmap' method='post' action='<?php echo url('cache/make_google') ?>'>

<div class="alert alert-warning alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <span class="glyphicon glyphicon-warning-sign"></span>	 <strong>XML生成</strong>	<a href="{get('site_url')}sitemaps.xml" target="_blank">{get('site_url')}sitemaps.xml</a>
</div>



<div class="line"></div>
<div class="blank30"></div>
<input name='submit' type='submit' id='submit' value='生成' class="btn btn-primary">


</form>