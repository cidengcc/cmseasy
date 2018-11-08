
<a href="{$base_url}/index.php?case=table&act=add&table=usergroup&admin_dir={get('admin_dir')}&site=default" class="btn btn-primary">添加用户组</a>
<div class="clearfix blank30"></div>

<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">


<div class="table-responsive">
<table class="table table-hover">
<thead>
<tr class="th">
<th><input title="点击可全选本页的所有项目"  onclick="CheckAll(this.form)" type="checkbox" name="chkall" class="checkbox" /> </th>
<th><!--id-->编号</th>
<th><!--groupid-->用户组</th>
<th><!--name-->名称</th>
<th>操作</th>
</tr>
</thead>
<tbody>

{loop $data $d}
<tr class="s_out">

<td align="center" ><input onclick="c_chang(this)" type="checkbox" value="{$d.$primary_key}" name="select[]" class="checkbox" /> </td>

<td align="center">{cut($d['groupid'])}</td>
<td align="center">{cut($d['groupid'])}</td>
<td align="center">{cut($d['name'])}</td>

<td align="center">
<a title="点击编辑用户组！" href="<?php echo modify("act/edit/table/$table/id/$d[$primary_key]");?>">编辑</a>
&nbsp;&nbsp;
<a title="确定要删除吗？" onclick="javascript: return confirm('确实要删除吗?');" href="<?php echo modify("/act/delete/table/$table/id/$d[$primary_key]/token/$token");?>">删除</a>

</td>
</tr>
{/loop}

</tbody>
</table>

<!-- <nav aria-label="Page navigation">
  <ul class="pagination">
  <?php if(get('table')!='type' && front::get('case')!='field') echo pagination::html($record_count); ?>
  </ul>
  </div> -->
<div class="blank20"></div>
</div>

<div class="blank20"></div>

<input type="hidden" name="batch" value="">
<input  class="btn btn-primary" type="button" value="删除" name="delete" onclick="if(getSelect(this.form) && confirm('确实要删除ID为('+getSelect(this.form)+')的记录吗?')){this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='delete'; this.form.submit();}" />

</form>