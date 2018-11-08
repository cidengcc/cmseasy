
<input title="增加内链" onclick="window.location.href='{url::create('table/add/table/linkword')}'" type="button" name="addcontentlinkword" class="btn btn-steeblue" value="增加内链" />

<div class="blank30"></div>
<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">
<div class="table-responsive">
<table class="table table-hover">
<thead>
<tr class="th">
<th class="s_out"><input title="点击可全选本页的所有项目"  onclick="CheckAll(this.form)" type="checkbox" name="chkall" class="checkbox" /> </th>
<th class="catid" align="center"><!--id-->编号</th>
<th class="catname" align="center"><!--linkword-->链接词</th>
<th class="htmldir" align="center"><!--linkurl-->URL</th>
<th class="catid" align="center"><!--linkorder-->链接权重值</th>
<th class="catid" align="center"><!--linktimes-->链接次数</th>
<th class="manage" align="center">操作</th>
</tr>
</thead>
<tbody>

{loop $data $d}
<tr>

<td align="center" class="s_out"><input onclick="c_chang(this)" type="checkbox" value="{$d.$primary_key}" name="select[]" class="checkbox" /> </td>

<td align="center" class="catid">{cut($d['id'])}</td>
<td align="left" class="htmldir">{cut($d['linkword'])}</td>
<td align="left" class="htmldir">{$d['linkurl']}</td>
<td class="catid" align="center">{cut($d['linkorder'])}</td>
<td class="catid" align="center">{cut($d['linktimes'])}</td>
                
<td class="manage" align="center">    
<a href="<?php echo modify("act/edit/table/$table/id/$d[$primary_key]");?>">编辑</a>
<a onclick="javascript: return confirm('确定要删除吗?');" href="<?php echo modify("/act/delete/table/$table/id/$d[$primary_key]/token/$token");?>">删除</a>
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

<input  class="btn btn-primary" type="button" value=" <?php if(get('table')=='archive') {?>彻底<?php } ?>删除 " name="delete" onclick="if(getSelect(this.form) && confirm('确实要删除ID为('+getSelect(this.form)+')的记录吗?')){this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='delete'; this.form.submit();}" />

</form>