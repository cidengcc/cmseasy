

<a href="<?php echo modify("/act/add/table/".$table);?>" class="btn btn-primary">添加字段</a>
<a href="<?php echo modify("/act/list/table/".$table);?>" class="btn btn-lightslategray">查看列表</a>

<div class="blank30"></div>

<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">
<div class="table-responsive">
<table class="table table-hover">
<thead>
<tr class="th">
            <th class="s_out"><input title="点击可全选本页的所有项目"  onclick="CheckAll(this.form)" type="checkbox" name="chkall" class="checkbox" /> </th>
          <th class="catname">字段名名</th>
          <th class="htmldir">类型</th>
          <th class="htmldir">长度</th>
          <th>字段中文名</th>
          <th class="manage">操作</th>
        </tr>
</thead>
 <tbody>
{loop $fields $f}
<tr>
<td class="s_out" align="center"><input onclick="c_chang(this)" type="checkbox" value="{$f.name}" name="select[]" class="checkbox" /> </td>
<td align="center" class="catname">{$f.name}</td>
<td align="center" class="htmldir"><?php
	//var_dump(setting::$var);
$tmp = setting::$var[front::get('table')][$f['name']];
if($tmp['type'] == 'varchar'){ 
	$s = '单行文本';
}
if($tmp['type'] == 'text'){ 
	$s = '多行文本';
}
if($tmp['type'] == 'mediumtext'){ 
	$s = '超文本';
}
if($tmp['type'] == 'int'){ 
	$s = '整型';
}
if($tmp['type'] == 'datetime'){ 
	$s = '日期型';
}
if($tmp['selecttype'] == 'radio'){
	$s = '单选';
}
if($tmp['selecttype'] == 'checkbox'){
	$s = '多选';
}
if($tmp['selecttype'] == 'select'){
	$s = '下拉选择';
}
if($tmp['filetype'] == 'image'){
	$s = '图片';
}
if($tmp['filetype'] == 'file'){
	$s = '附件';
}
echo $s;

?></td>
<td align="center" class="htmldir">{$f.len}</td>
<td align="center"  class="htmldir"><?php echo @setting::$var[$table][$f['name']]['cname'];?></td>
<td align="center" class="manage">
<a href="<?php echo modify("/act/edit/table/$table/name/".$f['name']);?>">编辑</a>
<a onclick="return confirm('确实要删除这个字段吗?');" href="<?php echo modify("/act/delete/table/$table/name/".$f['name']);?>">删除</a>
</td>
</tr>
{/loop}
</tbody>
</table>

<div class="blank30"></div>
<div class="line"></div>
<div class="blank30"></div>
<input type="hidden" name="batch" value="">
<input type="button" value="删除" name="delete" onclick="if(getSelect(this.form) && confirm('确实要删除名为('+getSelect(this.form)+')的字段吗?')){this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='delete'; this.form.submit();}" class="btn btn-primary" />
</form>
