<ul class="nav nav-tabs" role="tablist">
<li><a href="{$base_url}/index.php?case=table&act=send&table=user&admin_dir={get('admin_dir')}&site=default">发送邮件</a></li>
<li class="active"><a href="{$base_url}/index.php?case=table&act=mail&table=user&admin_dir={get('admin_dir')}&site=default">注册会员群发</a></li>
<li><a href="{$base_url}/index.php?case=table&act=send&table=user&type=subscription&admin_dir={get('admin_dir')}&site=default">订阅会员群发</a></li>
</ul>
<div class="clearfix blank30"></div>
<form name="listform" id="listform"  action="?case=table&act=send&table=user&admin_dir={get('admin_dir')}&getSelect(this.form)" method="post">

<div class="table-responsive">
<table class="table table-hover">
<thead>
<tr class="th">
<th class="s_out"><input title="点击可全选本页的所有项目"  onclick="CheckAll(this.form)" type="checkbox" name="chkall" class="checkbox" /> </th>
<th class="catid" align="center"><!--userid-->编号</th>
<th class="catname" align="center"><!--username-->用户名</th>
<th class="htmldir" align="center"><!--nickname-->昵称</th>
<th class="htmldir" align="center"><!--groupid-->用户组</th>
<th class="manage" align="center">操作</th>
</tr>
</thead>
<tbody>

{loop $data $d}
<tr>

<td class="s_out" align="center"><input onclick="c_chang(this)" type="checkbox" value="{$d.$primary_key}" name="select[]" class="checkbox" /> </td>

<td class="catid" align="center">{cut($d['userid'])}</td>
<td class="catname" align="center">{cut($d['username'])}</td>
<td align="center">{cut($d['nickname'])}</td>
<td align="center">{usergroupname($d['groupid'])}</td>

<td class="manage" align="center">
<a href="<?php echo modify("st/1/act/send/table/$table/id/$d[$primary_key]");?>" class="btn_d">发送</a> 
</td>
</tr>
{/loop}

</tbody>
</table>



</div>
<div class="page"><?php if(get('table')!='type' && front::get('case')!='field') echo pagination::html($record_count); ?></div>
<div class="blank30"></div>
<div class="line"></div>
<div class="blank30"></div>

<input type="hidden" name="batch" value="" />
<input  class="btn btn-primary" type="button" value=" 群发邮件(下一步) " name="sendall" onclick="if(getSelect(this.form) && confirm('确实要给ID为('+getSelect(this.form)+')的记录发送邮件吗?')){this.form.action='?case=table&act=send&table=user&admin_dir={get('admin_dir')}&st=1&id='+getSelect(this.form); this.form.submit();}"/> 

</form>