
<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">
<?php
$data=category::getcategorydata();
?>

<input class="btn btn-primary" type="button" value=" 添加栏目 " onclick="javascript:window.location.href='index.php?case=table&act=add&table=category&admin_dir={get('admin_dir')}'" />

<div class="blank30"></div>

<div class="table-responsive">
<table class="table table-hover">
<thead>
<tr class="th">
<th class="s_out"><input title="点击可全选本页的所有项目"  onclick="CheckAll(this.form)" type="checkbox" name="chkall"> </th>
<th class="sort">排序</th>
<th class="catid"><!--catid-->ID</th>
<th class="catname"><!--catname-->栏目名称</th>
<th class="htmldir"><!--htmldir-->目录名称</th>
<th class="isnav"><!--isnav-->导航</th>
<th class="manage">操作</th>
</tr>
</thead>
<tbody id="listtable">
{loop $data $d}

<tr onmouseover="m_over(this)" onmouseout="m_out(this)" lang="{$d['level']}" {if $d['level']>0}style="display:none"{/if}>
<td align="center" class="s_out"><input onclick="c_chang(this)" type="checkbox" value="{$d[$primary_key]}" name="select[]"> </td>
<td align="center" class="sort"><span class="hotspot" onmouseover="tooltip.show('填写排序号，<br />数字越小，排序越靠前！');" onmouseout="tooltip.hide();">{form::input("listorder[$d[$primary_key]]",$d['listorder'])}</span></td>
<td align="center" class="catid">
{$d['catid']}
</td>
<td class="catname"><a style="float:left;" href="<?php echo modify("/act/edit/table/$table/id/$d[$primary_key]");?>">{$d['catname']}</a>
<?php if(category::hasson($d['catid'])) { ?>
{if $d['level']==0}<a onclick="child(this)" title="点击展开/收起" class="child"><span class="glyphicon glyphicon-indent-left"></span></a>{/if}
<?php } ?>
</td>

<td align="center" class="htmldir">
<span class="hotspot" onmouseover="tooltip.show('栏目文件存放目录，目录必须为英文或拼音，中间不可有空格！');" onmouseout="tooltip.hide();">{$d['htmldir']}</span>
</td>

<td align="center" class="isnav">
<span class="hotspot" onmouseover="tooltip.show('选择栏目是否在导航显示，只对顶级栏目有效！');" onmouseout="tooltip.hide();">{helper::yes($d['isnav'],false)} </span></td>

<td align="center" class="manage">
<a href="<?php echo url("archive/list/catid/$d[$primary_key]",false);?>" target="_blank">查看</a>
<a  href="<?php echo modify("/act/edit/table/$table/id/$d[$primary_key]");?>">编辑</a>
<a onclick="javascript: return confirm('确实要删除吗?');" href="<?php echo modify("/act/delete/table/$table/id/$d[$primary_key]/token/$token");?>">删除</a>
<a href="<?php echo modify("/act/list/table/archive/catid/$d[$primary_key]");?>">管理</a>
</td>
</tr>
{/loop}
</tbody>
</table>

</div>
<div class="page"><?php echo pagination::html($record_count); ?></div>
<div class="blank30"></div>
<div class="line"></div>
<div class="blank30"></div>
<input type="hidden" name="batch" value="">

<input class="btn btn-lightslategray" type="button" value=" 排序 " name="order" onclick="this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='listorder'; this.form.submit();"/>
<input class="btn btn-steeblue" type="button" value=" 移动到 " name="delete" onclick="if(getSelect(this.form) && confirm('确实要移动ID为('+getSelect(this.form)+')的栏目吗?')){this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='move'; this.form.submit();}"/>
<?php echo form::select('catid',0,category::option());?>
</form>
