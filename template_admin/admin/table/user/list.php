
<a href="{$base_url}/index.php?case=table&act=add&table=user&admin_dir={get('admin_dir')}&site=default" class="btn btn-primary">添加用户</a>

<div class="clearfix blank30"></div>
<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">


<div class="table-responsive">
<table class="table table-hover">
<thead>
<tr class="th">
<th class="s_out"><input title="点击可全选本页的所有项目"  onclick="CheckAll(this.form)" type="checkbox" name="chkall" class="checkbox" /> </th>
<th align="center" class="catid" align="center"><!--userid-->编号</th>
<th class="catname" align="center"><!--username-->用户名</th>
<th class="catid" align="center"><!--nickname-->昵称</th>
<th class="catid" align="center"><!--groupid-->用户组</th>
<th align="center">操作</th>
</tr>
</thead>
<tbody>

{loop $data $d}
<tr>

<td class="s_out" align="center" ><input onclick="c_chang(this)" type="checkbox" value="{$d.$primary_key}" name="select[]" class="checkbox" /> </td>

<td align="center" class="catid">{cut($d['userid'])}</td>
<td align="center" class="catname">{cut($d['username'])}</td>
<td align="center" class="catid">{cut($d['nickname'])}</td>
<td align="center" class="catid">{usergroupname($d['groupid'])}</td>

<td align="center" class="manage">
<a href="<?php echo modify("act/edit/table/$table/id/$d[$primary_key]");?>">编辑</a>
{if $d['isblock']}<a href="<?php echo modify("act/block/table/$table/id/$d[$primary_key]");?>">解冻</a>
{else}
<a href="<?php echo modify("act/block/table/$table/id/$d[$primary_key]");?>">冻结</a>
{/if}
{if $d['isdelete']}
<a href="<?php echo modify("act/clean/table/$table/id/$d[$primary_key]");?>">拉回</a>
{else}
<a href="<?php echo modify("act/clean/table/$table/id/$d[$primary_key]");?>">清退</a>
{/if} 
<a href="<?php echo url("invite/list/ctname/".$d['username']);?>">邀请</a>
<a href="<?php echo modify("act/list/table/comment/uid/$d[$primary_key]");?>">互动</a>
<a href="<?php echo modify("act/list/table/zanlog/uid/$d[$primary_key]");?>">点赞</a>
<a onclick="javascript: return confirm('确实要删除吗?');" href="<?php echo modify("/act/delete/table/$table/id/$d[$primary_key]/token/$token");?>">删除</a>
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
<input  class="btn btn-primary" type="button" value=" 删除 " name="delete" onclick="if(getSelect(this.form) && confirm('确实要删除ID为('+getSelect(this.form)+')的记录吗?')){this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='delete'; this.form.submit();}"/>

</form>