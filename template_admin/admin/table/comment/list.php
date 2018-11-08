
<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">

<div class="table-responsive">
<table class="table table-hover">
<thead>
<tr class="th">
<th class="s_out"><input title="点击可全选本页的所有项目"  onclick="CheckAll(this.form)" type="checkbox" name="chkall"> </th>
<th class="catid" align="center"><!--id-->编号</th>
<th class="catname" align="center"><!--content-->内容</th>
<th class="htmldir" align="center"><!--username-->用户名</th>
<th class="htmldir" align="center">状态</th>
<th class="manage" align="center">操作</th>
</tr>
</thead>
<tbody>
{loop $data $d}
<tr>
<td class="s_out" align="center" >
<input onclick="c_chang(this)" type="checkbox" value="{$d.$primary_key}" name="select[]" class="checkbox" />
</td>

<td class="catid" align="center">{cut($d['id'])}</td>
<td class="catname" align="left" style="padding-left:10px;">{cut($d['content'])}</td>
<td class="htmldir" align="left">{cut($d['username'])}</td>
<td class="htmldir" align="center">{if $d['state']}<font color="#006600">已审</font>{else}<font color="#990000">未审</font>{/if}</td>

<td class="manage" align="center">
<a href="<?php echo modify("act/edit/table/$table/id/$d[$primary_key]");?>">编辑</a>
<a onclick="javascript: return confirm('确实要删除吗?');" href="<?php echo modify("/act/delete/table/$table/id/$d[$primary_key]/token/$token");?>">删除</a>
</td>
</tr>
{/loop}

</tbody>
</table>

<div class="page"><?php if(get('table')!='type' && front::get('case')!='field') echo pagination::html($record_count); ?></div>

</div>

<div class="blank30"></div>
<div class="line"></div>
<div class="blank30"></div>

<input type="hidden" name="batch" value="">
<input class="btn btn-lightslategray" type="button" value=" 删除 " name="delete" onclick="if(getSelect(this.form) && confirm('确实要删除ID为('+getSelect(this.form)+')的记录吗?')){this.form.action='<?php echo modify("/act/delete/table/$table/id/$d[$primary_key]/token/$token");?>'; this.form.batch.value='delete'; this.form.submit();}"/>

<input class="btn btn-primary" type="button" value=" 审核 " name="docheck" onclick="if(getSelect(this.form) && confirm('确实要审核ID为('+getSelect(this.form)+')的记录吗?')){this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='docheck'; this.form.submit();}"/>

<input class="btn btn-steeblue" type="button" value="取消审核" name="douncheck" onclick="if(getSelect(this.form) && confirm('确实要取消审核ID为('+getSelect(this.form)+')的记录吗?')){this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='douncheck'; this.form.submit();}"/>

</form>