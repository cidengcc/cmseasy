<ul class="nav nav-tabs" role="tablist">
<li><a href="{$base_url}/index.php?case=database&act=baker&admin_dir={get('admin_dir')}&site=default">备份数据库</a></li>
<li><a href="{$base_url}/index.php?case=database&act=restore&admin_dir={get('admin_dir')}&site=default">还原数据库</a></li>
<li class="active"><a href="{$base_url}/index.php?case=adminlogs&act=manage&admin_dir={get('admin_dir')}&site=default">日志管理</a></li>
<li><a href="{$base_url}/index.php?case=database&act=str_replace&admin_dir={get('admin_dir')}&site=default">替换字符串</a></li>
<li><a href="{$base_url}/index.php?case=database&act=phpwebinsert&admin_dir={get('admin_dir')}&site=default">导入PHPweb数据</a></li>
<li><a href="{$base_url}/index.php?case=database&act=backAll&admin_dir={get('admin_dir')}&site=default">备份整站</a></li>
</ul>

<div class="blank30"></div>

<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">
<div class="table-responsive">
<table class="table table-hover">
<thead>
<tr class="th">
<th class="s_out">编号</th>
<th align="center">用户名</th>
<th align="center">操作时间</th>
<th align="center">IP</th>
<th align="center">操作方法</th>
<th align="center">说明</th>
<th align="center">操作</th>
</tr>
</thead>
<tbody>
{loop $data $d}
<tr>
<td align="center">{cut($d['id'])}</td>
<td align="center" style="padding-left:10px;">{cut($d['username'])}</td>
<td align="center">{date('Y-m-d H:i:s',$d['addtime'])}</td>
<td align="center">{$d['ip']}</td>
<td align="center">{cut($d['event'])}</td>
<td align="left">{$d['note']}</td>
<td align="left"><a href="{url('adminlogs/delete/id/'.$d['id'])}" onClick="return confirm('确定要删除吗?')">删除</a></td>
</tr>
{/loop}
</table>
</div>


<div class="page"><?php echo pagination::html($record_count); ?></div>

<div class="blank30"></div>
<div class="line"></div>
<div class="blank30"></div>

<input type="hidden" name="batch" value="">
<input  class="btn btn-primary" type="button" value=" 清空 " name="delete" onclick="if(confirm('确实要清空日志记录吗?')){this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='delete'; this.form.submit();}"/>

</form>