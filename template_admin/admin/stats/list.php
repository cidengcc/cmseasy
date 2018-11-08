
<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">
<div class="table-responsive">
<table class="table table-hover">
<thead>
<tr class="th">
<th class="s_out"><input title="点击可全选本页的所有项目"  onclick="CheckAll(this.form)" type="checkbox" name="chkall" class="checkbox" /> </th>
          <th class="catid" align="center"><!--id-->编号</th>
          <th class="catname" align="center">搜索引擎</th>
          <th class="htmldir" align="center">IP</th>
          <th class="htmldir" align="center">时间</th>
          <th class="htmldir" align="center">受访地址</th>
          <th align="center" class="manage">操作</th>
        </tr>

</thead>
<tbody>
{loop $data $d}
<tr>

<td align="center" ><input onclick="c_chang(this)" type="checkbox" value="{$d.$primary_key}" name="select[]" class="checkbox" /> </td>

<td align="center" >{$d['id']}</td>
<td align="center" >{$d['bot']}</td>
<td align="center">{$d['ip']}</td>
<td align="center">{$d['time']}</td>
<td align="left" style="padding-left:10px;"><a href="{$d['url']}" target="_blank">{$d['url']}</a></td>

<td align="center" class="manage">
<a onclick="javascript: return confirm('确实要删除吗?');" href="<?php echo modify("/act/delete/table/$table/id/$d[$primary_key]");?>">删除</a>
</tr>
{/loop}


</tbody>
</table>
</div>
<div class="page"><?php if(get('table')!='type' && front::get('case')!='field') echo pagination::html($record_count); ?></div>


<div class="blank30"></div>
<div class="line"></div>
<div class="blank30"></div>

<input type="hidden" name="batch" value="">
<input  class="btn btn-primary" type="button" value=" 删除 " name="delete" onclick="if(getSelect(this.form) && confirm('确实要删除ID为('+getSelect(this.form)+')的记录吗?')){this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='delete'; this.form.submit();}"/>

<input  class="btn btn-steeblue" type="button" value=" 清空 " name="clear" onclick="if(confirm('确实要清空记录吗?')){this.form.action='<?php echo modify('act/clear',true);?>'; this.form.batch.value='clear'; this.form.submit();}"/>

</form>



