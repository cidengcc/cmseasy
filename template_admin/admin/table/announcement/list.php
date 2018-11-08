
<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">

<a href="{$base_url}/index.php?case=table&act=add&table=announcement&admin_dir={get('admin_dir')}&site=default" class="btn btn-primary">添加公告</a>
<div class="blank30"></div>
<div class="table-responsive">
<table class="table table-hover">
<thead>
<tr class="th">
<th class="s_out"><input title="点击可全选本页的所有项目"  onclick="CheckAll(this.form)" type="checkbox" name="chkall" class="checkbox" /> </th>
<th class="catid" align="center"><!--id-->编号</th>
<th class="catname" align="center"><!--title-->标题</th>
<th class="catid" align="center"><!--content-->内容</th>
<th class="catid" align="center"><!--adddate-->添加时间</th>
<th class="manage" align="center">操作</th>
</tr>
</thead>
<tbody>
{loop $data $d}
<tr>
<td class="s_out" align="center" >
<input onclick="c_chang(this)" type="checkbox" value="{$d.$primary_key}" name="select[]" class="checkbox" />
</td>

<td class="catid" align="center" >{cut($d['id'])}</td>
<td align="left" class="catname">{cut($d['title'])}</td>
<td align="left" class="catid">{cut($d['content'])}</td>
<td class="catid" align="center" >{cut($d['adddate'])}</td>

<td class="manage" align="center">
<a href="<?php echo modify("act/edit/table/$table/id/$d[$primary_key]");?>">编辑</a>
<a onclick="javascript: return confirm('确实要删除吗?');" href="<?php echo modify("/act/delete/table/$table/id/$d[$primary_key]/token/$token");?>">删除</a>
</td>
</tr>
{/loop}

</tbody>
</table>

<div class="page"><?php if(get('table')!='type' && front::get('case')!='field') echo pagination::html($record_count); ?></div>
<div class="blank30"></div>
<div class="line"></div>
<div class="blank30"></div>

<input type="hidden" name="batch" value="">
<input  class="btn btn-primary" type="button" value=" 删除 " name="delete" onclick="if(getSelect(this.form) && confirm('确实要删除ID为('+getSelect(this.form)+')的记录吗?')){this.form.action='<?php echo modify("/act/delete/table/$table/id/$d[$primary_key]/token/$token");?>'; this.form.batch.value='delete'; this.form.submit();}"/>

</form>