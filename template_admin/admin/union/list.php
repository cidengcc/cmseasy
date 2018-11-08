
<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">

<div class="blank20"></div>
<div id="tagscontent" class="right_box">

<table border="0" cellspacing="0" cellpadding="0" name="table1" id="table1" width="100%">
<thead>
<tr class="th">
<th align="center"><input title="点击可全选本页的所有项目"  onclick="CheckAll(this.form)" type="checkbox" name="chkall" class="checkbox" /></th>
          <th align="center">用户名</th>
          <th align="center">点数</th>
          <th align="center">利率</th>
          <th align="center">费用</th>
          <th align="center">IP数</th>
          <th align="center">注册数</th>
          <th align="center">网址</th>
          <th align="center">加入日期</th>
          <th align="center">操作</th>
        </tr>

</thead>


<tbody>
{loop $data $d}
<tr>

<td align="center" ><input onclick="c_chang(this)" type="checkbox" value="{$d.$primary_key}" name="select[]" class="checkbox" /> </td>

<td align="left" style="padding-left:10px;">{$d['username']}</td>
<td align="left" style="padding-left:10px;">{$d['point']}</td>
<td align="left" style="padding-left:10px;">{$d['profitmargin']} %</td>
<td align="left" style="padding-left:10px;"><font color="red"><?php echo $d['point']*($d['profitmargin']/100);?></font></td>
<td align="left" style="padding-left:10px;">{$d['visits']}</td>
<td align="left" style="padding-left:10px;">{$d['registers']}</td>
<td align="left" style="padding-left:10px;">{$d['website']}</td>
<td align="center">{date('Y-m-d H:i:s',$d['regtime'])}</td>

<td align="center">
<a href="<?php echo modify("act/settle/table/$table/id/$d[$primary_key]");?>">结算</a> 
<a href="<?php echo modify("/act/edit/table/$table/id/$d[$primary_key]");?>">配置用户</a>
</td>
</tr>
{/loop}


</tbody>
</table>

<div class="page"><?php echo pagination::html($record_count); ?></div>
<div class="blank20"></div>
</div>
<div class="blank20"></div>

<input type="hidden" name="batch" value="">
<input  class="btn btn-primary" type="button" value=" 删除 " name="delete" onclick="if(getSelect(this.form) && confirm('确实要删除ID为('+getSelect(this.form)+')的记录吗?')){this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='delete'; this.form.submit();}"/>

</form>