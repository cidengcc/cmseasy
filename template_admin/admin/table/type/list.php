
<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">

    <?php
    //$data=type::gettypedata();
    ?>

<input class="btn btn-primary" type="button" value=" 添加分类 " onclick="javascript:window.location.href='index.php?case=table&act=add&table=type&admin_dir={get('admin_dir')}'" />
  
<div class="blank30"></div>
<div class="clear"></div>
<div id="tagscontent" class="right_box">

<div class="blank5"></div>
<div class="table-responsive">
<table class="table table-hover">
<thead>
<tr class="th">
<th align="center" class="s_out"><input title="点击可全选本页的所有项目"  onclick="CheckAll(this.form)" type="checkbox" name="chkall"> </th>
<th class="sort">排序</th>
<th class="catid"><!--typeid-->分类</th>
<th class="catname"><!--typename-->分类名称</th>
<th>操作</th>
</tr>
</thead>
<tbody id="listtable">
{loop $data $d}
<?php
	$data1=type::gettypedata($d['typeid'],$data11,$l=1);
	?>
<tr>
<td align="center" class="s_out"><input onclick="c_chang(this)" type="checkbox" value="{$d[$primary_key]}" name="select[]"> </td>
<td class="sort">{form::input("listorder[$d[$primary_key]]",$d['listorder'],'size=3')}</td>
<td align="center" class="catid">{$d['typeid']} </td>
<td align="left" style="padding-left:10px;" class="catname">{$d['typename']} </td>
<td align="center" class="manage">

<a href="<?php echo url("type/list/typeid/$d[$primary_key]",false);?>" target="_blank">查看</a>

<a href="<?php echo modify("/act/edit/table/$table/id/$d[$primary_key]");?>">编辑</a>

<a onclick="javascript: return confirm('确实要删除吗?');" href="<?php echo modify("/act/delete/table/$table/id/$d[$primary_key]/token/$token");?>">删除</a>

</td>
</tr>
            
<?php

if(isset($data1)){
?>

{loop $data1 $d1}

<tr>
<td align="center" class="s_out"><input onclick="c_chang(this)" type="checkbox" value="{$d1[$primary_key]}" name="select[]"> </td>
<td class="sort">{form::input("listorder[$d1[$primary_key]]",$d1['listorder'],'size=3')}</td>
<td align="center">{$d1['typeid']}</td>
<td align="left" style="padding-left:10px;">{$d1['typename']}</td>
  
<td align="center" class="manage">

<a href="<?php echo url("type/list/typeid/$d1[$primary_key]",false);?>" target="_blank">查看</a>

<a href="<?php echo modify("/act/edit/table/$table/id/$d1[$primary_key]");?>">编辑</a>

<a onclick="javascript: return confirm('确实要删除吗?');" href="<?php echo modify("/act/delete/table/$table/id/$d1[$primary_key]/token/$token");?>">删除</a>
</td>
</tr>

{/loop}  
              
<?php } unset($d1);unset($data1);unset($data11);?>
            
{/loop}

</tbody>
</table>
<div class="blank10"></div>

</div>

<div class="page"><?php echo pagination::html($record_count); ?></div>


<div class="blank20"></div>
<div class="line"></div>
<div class="blank30"></div>


<input type="hidden" name="batch" value="">

<input  class="btn btn-lightslategray" type="button" value=" 排序 " name="order" onclick="this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='listorder'; this.form.submit();"/>

<input  class="btn btn-steeblue" type="button" value=" 移动到 " name="delete" onclick="if(getSelect(this.form) && confirm('确实要移动ID为('+getSelect(this.form)+')的类吗?')){this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='move'; this.form.submit();}"/>

<?php echo form::select('typeid',0,type::option());?>

</form>





