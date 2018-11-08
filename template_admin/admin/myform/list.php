

<?php helper::filterField($field,$fieldlimit);?>

<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">

  <?php
  if(get('table')=='type')
  $this->render('_table/type/_list.php');
  else { ?>


<div class="table-responsive">
<table class="table table-hover">
<thead>
<tr class="th">
            <th class="s_out"><input title="点击可全选本页的所有项目"  onclick="CheckAll(this.form)" type="checkbox" name="chkall" class="checkbox" /> </th>
{loop $field $f}
          <th align="center" class="catname"><!--{$f.name}-->{$f.name|lang}</th>
{/loop}
          <th align="center" class="manage">操作</th>
        </tr>

</thead>
<tbody>
{loop $data $d}
<tr>

<td align="center" class="s_out"><input onclick="c_chang(this)" type="checkbox" value="{$d.$primary_key}" name="select[]" class="checkbox" /> </td>

{loop $field $f}
<?php $name=$f['name']; ?>
<td align="center">{cut($d[$name])}</td>
{/loop}

<td align="center" class="manage">

<a href='<?php echo url("table/show/table/$table/id/$d[$primary_key]/aid/".$d['aid']);?>'>查看</a>

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

<input class="btn btn-primary" type="button" value=" 删除 " name="delete" onclick="if(getSelect(this.form) && confirm('确实要删除ID为('+getSelect(this.form)+')的记录吗?')){this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='delete'; this.form.submit();}" />

<?php } ?>


</form>




