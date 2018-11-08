<ul class="nav nav-tabs" role="tablist">
<li><a href="{$base_url}/index.php?case=table&act=list&table=friendlink&admin_dir={get('admin_dir')}&site=default">联盟配置</a></li>
<li><a href="{$base_url}/index.php?case=union&act=visit&table=union&admin_dir={get('admin_dir')}&site=default">访问统计</a></li>
<li class="active"><a href="{$base_url}/index.php?case=union&act=reguser&table=union&admin_dir={get('admin_dir')}&site=default">注册统计</a></li>
<li><a href="{$base_url}/index.php?case=union&act=pay&table=union&admin_dir={get('admin_dir')}&site=default">结算记录</a></li>
</ul>

<div class="blank30"></div>

<div class="table-responsive">
<table class="table table-hover">
<thead>
<tr class="th">
<th align="center" class="catname">用户名</th>
<th align="center" class="htmldir">email</th>
<th align="center" class="htmldir">注册IP</th>
<th align="center" class="htmldir">联盟ID</th>
</tr>
</thead>

<tbody>
{loop $data $d}
<tr>

<td class="catname">{$d['username']}</td>
<td class="htmldir">{$d['e_mail']}</td>
<td class="htmldir">{$d['userip']}</td>
<td class="htmldir">{$d['introducer']}[{$d['introducerusername']}]</td>

</tr>
{/loop}


</tbody>
</table>
</div>

<div class="page"><?php echo pagination::html($record_count); ?></div>


