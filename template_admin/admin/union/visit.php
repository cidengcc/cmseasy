<ul class="nav nav-tabs" role="tablist">
<li><a href="{$base_url}/index.php?case=table&act=list&table=friendlink&admin_dir={get('admin_dir')}&site=default">联盟配置</a></li>
<li class="active"><a href="{$base_url}/index.php?case=union&act=visit&table=union&admin_dir={get('admin_dir')}&site=default">访问统计</a></li>
<li><a href="{$base_url}/index.php?case=union&act=reguser&table=union&admin_dir={get('admin_dir')}&site=default">注册统计</a></li>
<li><a href="{$base_url}/index.php?case=union&act=pay&table=union&admin_dir={get('admin_dir')}&site=default">结算记录</a></li>
</ul>

<div class="blank30"></div>

<div class="table-responsive">
<table class="table table-hover">
<thead>
<tr class="th">
<th class="catname">来源地址</th>
<th align="center" class="htmldir">访问IP</th>
<th align="center" class="htmldir">访问时间</th>
<th align="center" class="htmldir">注册用户</th>
<th align="center" class="htmldir">注册时间</th>
</tr>
</thead>


<tbody>
{loop $data $d}
<tr>

<td class="catname">{if $d['referer']}{$d['referer']}{else}地址栏直接进入{/if}</td>
<td class="htmldir" align="center">{$d['visitip']}</td>
<td class="htmldir" align="center">{date('Y-m-d H:i:s',$d['visittime'])}</td>
<td class="htmldir" align="left">{$d['regusername']}</td>
<td class="htmldir" align="center">{if $d['regtime']}{date('Y-m-d H:i:s',$d['regtime'])}{/if}</td>

</tr>
{/loop}

</tbody>
</table>
</div>



<div class="page"><?php echo pagination::html($record_count); ?></div>

