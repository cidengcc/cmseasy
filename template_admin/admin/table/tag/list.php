

<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">

<input class="btn btn-primary" type="button" value=" 添加标签" onclick="javascript:window.location.href='index.php?case=table&act=add&table=tag&admin_dir={get('admin_dir')}'" />

<div class="blank30"></div>

<div class="table-responsive">
<table class="table table-hover">
<thead>
<tr class="th">
<th class="s_out"><input title="点击可全选本页的所有项目"  onclick="CheckAll(this.form)" type="checkbox" name="chkall" class="checkbox" /></th>
<th class="catid" align="center">编号</th>
<th class="catname" align="center">标签名</th>
<th class="manage" align="center">操作</th>
</tr>
</thead>
<tbody>
    {loop $data $d}
    <tr>
      <td align="center" class="s_out"><input onclick="c_chang(this)" type="checkbox" value="{$d.$primary_key}" name="select[]" class="checkbox" /></td>
      <td align="center" class="catid">{cut($d['tagid'])}</td>
      <td align="left"  class="catname">{cut($d['tagname'])}</td>
      <td align="center" class="manage">
        <a href="<?php echo modify("case/cache/act/make_tag/submit/1/tag/".$d['tagid']);?>">生成</a>
        <a href="<?php echo modify("act/edit/table/$table/id/$d[$primary_key]");?>">编辑</a>
        <a onclick="javascript: return confirm('确实要删除吗?');" href="<?php echo modify("/act/delete/table/$table/id/$d[$primary_key]/token/$token");?>">删除</a>
      </td>
    </tr>
    {/loop}
    </tbody>
    
  </table>
</div>
<input type="hidden" name="batch" value="" />
<input class="btn btn-primary" type="button" value=" 删除 " name="delete" onclick="if(getSelect(this.form) && confirm('确实要删除ID为('+getSelect(this.form)+')的记录吗?')){this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='delete'; this.form.submit();}"/>


 
<div class="blank30"></div>
<div class="line"></div>

<div class="clear page">
  <?php if(get('table')!='type' && front::get('case')!='field') echo pagination::html($record_count); ?>
</div>

</form>
