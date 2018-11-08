

<a href="{$base_url}/index.php?case=table&act=add&table=friendlink&admin_dir={get('admin_dir')}&site=default" class="btn btn-steeblue">添加友情链接</a>
<a href="{$base_url}/index.php?case=table&act=setting&table=friendlink&admin_dir={get('admin_dir')}&site=default" class="btn btn-lightslategray">友情链接配置</a>






<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">
<div class="blank20"></div>
<div id="tagscontent" class="right_box">

<div class="table-responsive">
<table class="table table-hover">
<thead>
<tr class="th">
<th class="s_out"><input title="点击可全选本页的所有项目"  onclick="CheckAll(this.form)" type="checkbox" name="chkall" class="checkbox" /> </th>
<th><!--id-->编号</th>
<th align="center" class="catname"><!--name-->名称</th>
<th align="center" class="htmldir"><!--listorder-->排序号</th>
<th align="center" class="htmldir"><!--logo-->LOGO</th>
<th align="center" class="htmldir"><!--username-->用户名</th>
<th align="center" class="htmldir"><!--adddate-->添加时间</th>
<!-- <th align="center" class="htmldir"><!--hits--点击数</th> -->
<th align="center" class="manage">操作</th>
</tr>


{loop $data $d}
<tr>

<td align="center" >
<input onclick="c_chang(this)" type="checkbox" value="{$d.$primary_key}" name="select[]" class="checkbox" />
</td>

<td align="center">{cut($d['id'])}</td>
<td align="left" class="catname">{cut($d['name'])}</td>
<td align="center" class="htmldir">{cut($d['listorder'])}</td>
<td align="center" class="htmldir">{if $d['logo']}<?php if($d['logo']) echo helper::img($d['logo'], 100); ?>{else}无{/if}</td>
<td align="left" class="htmldir">{cut($d['username'])}</td>
<td align="center" class="htmldir">{cut($d['adddate'])}</td>
<!-- <td align="center">{cut($d['hits'])}</td> -->

<td align="center" class="manage">
<a href="<?php echo modify("act/edit/table/$table/id/$d[$primary_key]");?>">编辑</a>
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

<input type="hidden" name="batch" value="" class="button" />
<input  class="btn btn-primary" type="button" value=" 删除 " name="delete" onclick="if(getSelect(this.form) && confirm('确实要删除ID为('+getSelect(this.form)+')的记录吗?')){this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='delete'; this.form.submit();}" />

</form>