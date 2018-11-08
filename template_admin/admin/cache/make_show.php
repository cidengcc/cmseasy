<ul class="nav nav-tabs" role="tablist">
<li class="active"><a href="{$base_url}/index.php?case=cache&act=make_show&admin_dir={get('admin_dir')}&site=default">内容</a></li>
<li><a href="{$base_url}/index.php?case=cache&act=make_list&admin_dir={get('admin_dir')}&site=default">栏目</a></li>
<li><a href="{$base_url}/index.php?case=cache&act=make_type&admin_dir={get('admin_dir')}&site=default">分类</a></li>
<li><a href="{$base_url}/index.php?case=cache&act=make_special&admin_dir={get('admin_dir')}&site=default">专题</a></li>
<li><a href="{$base_url}/index.php?case=cache&act=make_tag&admin_dir={get('admin_dir')}&site=default">标签</a></li>
<li><a href="{$base_url}/index.php?case=cache&act=make_sitemap_google&admin_dir={get('admin_dir')}&site=default">Google地图</a></li>
<li><a href="{$base_url}/index.php?case=cache&act=make_sitemap_baidu&admin_dir={get('admin_dir')}&site=default">百度地图</a></li>
<li><a href="{$base_url}/index.php?case=cache&act=ctsitemap">网站地图</a></li>
<li><a href="{$base_url}/index.php?case=cache&act=make_index&admin_dir={get('admin_dir')}&site=default">首页</a></li>
</ul>
<div class="blank30"></div>

<style type="text/css">
	@media(max-width:468px) {
	.cache-btn {margin-top:10px;}
	}
</style>


<form name="aidform" method="post" action="<?php echo front::$uri;?>">

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">按ID</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<div class="row">
<?php
	$archive=new archive();
	$aid=$archive->rec_query_one("select min(aid) as min,max(aid) as max from ".$archive->name);
	echo " <div class='col-xs-5 col-sm-5 col-md-5 col-lg-5'>".form::input('aid_start',max($aid['max']-100,1));
	echo " </div><div class='col-xs-1 col-sm-1 col-md-1 col-lg-1'>	~	</div><div class='col-xs-5 col-sm-5 col-md-5 col-lg-5'>".form::input('aid_end',$aid['max']);
	?></div><div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 cache-btn"><?php echo form::submit('更新');
	?></div>
</div>
<div class="clearfix blank10"></div>
&nbsp;&nbsp;[	ID范围: {$aid['min']}	~	{$aid['max']}	]</div>
</div>
</div>
</div>
<div class="blank30"></div>
<div class="line"></div>
<div class="blank30"></div>
</form>

<form name="aidform2" method="post" action="<?php echo front::$uri;?>">
<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">按栏目</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<?php
	//$archive=archive::getInstance();
	echo form::select('catid',get('catid'),category::option());
	?>
	&nbsp;&nbsp;
	<?php echo form::submit('更新');
	?>
</div>
</div>
<div class="clearfix blank20"></div>
</form>

