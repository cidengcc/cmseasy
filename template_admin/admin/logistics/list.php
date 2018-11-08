
<input class="btn btn-primary" type="button" value=" 增加配货 " name="add" onclick="javascript:window.location.href='<?php echo modify("act/add/table/$table");?>'"/> 

<div class="blank30"></div>
<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">
<div class="table-responsive">
<table class="table table-hover">
<thead>
<tr class="th">       
<th class="catname" align="center"><!--name-->配货方式</th>
<th class="htmldir" align="center"><!--rate-->配货费用</th>
<th class="htmldir" align="center"><!--ver-->货到付款</th>
<th class="htmldir" align="center">是否保价</th>
<th class="manage" align="center">操作</th>
</tr>
</thead>
<tbody>
{loop $data $d}

<tr>


<td class="catname"><strong>{$d['title']}</strong><br /><font color="#666666">{$d['content']}</font></td>
<td class="htmldir" align="center">{$d['price']}</td>
<td class="htmldir" align="center">{if $d['cashondelivery'] == 0}<img src="{$skin_path}/images/no.gif" />{else}<img src="{$skin_path}/images/ok.gif" />{/if}</td>
<td class="htmldir" align="center">{if $d['insure'] == 0}<img src="{$skin_path}/images/no.gif" />{else}<img src="{$skin_path}/images/ok.gif" />{/if}</td>

<td class="manage" align="center">
<a href="<?php echo modify("act/edit/table/$table/id/".$d['id']);?>">管理</a>
<a onclick="javascript: return confirm('确实要删除吗?');" href="<?php echo modify("/act/delete/table/$table/id/".$d['id']);?>">删除</a>
</td>
</tr>
{/loop}


</tbody>
</table>

</div>


<div class="line"></div>
<div class="blank30"></div>

<input type="hidden" name="batch" value="">
<input  class="btn btn-primary" type="button" value=" 删除 " name="delete" onclick="if(getSelect(this.form) && confirm('确实要删除ID为('+getSelect(this.form)+')的记录吗?')){this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='delete'; this.form.submit();}"/>

</form>

