
<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">
<div class="blank20"></div>
<div id="tagscontent" class="right_box">

<table border="0" cellspacing="0" cellpadding="0" name="table1" id="table1" width="100%">
<thead>
<tr class="th">
<th><input title="点击可全选本页的所有项目"  onclick="CheckAll(this.form)" type="checkbox" name="chkall"> </th>
<th align="center"><!--id-->编号</th>
<th align="center"><!--content-->标题</th>
<th align="center"><!--username-->用户名</th>
<th align="center">操作</th>
</tr>
</thead>
<tbody>
{loop $data $d}
<?php
$archive = archive::getInstance();
$news = $archive->getrow($d['aid']);
$aurl = $archive->url($news);
$user = new user();
$user = $user->getrow($d['uid']);
$username = $user['username'];
unset($user);
?>
<tr>
<td align="center" >
<input onclick="c_chang(this)" type="checkbox" value="{$d.$primary_key}" name="select[]" class="checkbox" />
</td>

<td align="center">{cut($d['zlid'])}</td>
<td align="left" style="padding-left:10px;"><a href="{$aurl}" target="_blank">{$news['title']}</a></td>
<td align="left" style="padding-left:10px;">{$username}</td>

<td align="center">
<span class="hotspot" onmouseover="tooltip.show('点击编辑栏目设置');" onmouseout="tooltip.hide();">
<a href="<?php echo modify("act/edit/table/$table/id/$d[$primary_key]");?>"></a>
</span>
<span class="hotspot" onmouseover="tooltip.show('删除这个栏目');" onmouseout="tooltip.hide();">
<a onclick="javascript: return confirm('确实要删除吗?');" href="<?php echo modify("/act/delete/table/$table/id/$d[$primary_key]/token/$token");?>"></a>
</span>
</td>
</tr>
{/loop}

</tbody>
</table>

<div class="page"><?php if(get('table')!='type' && front::get('case')!='field') echo pagination::html($record_count); ?></div>
<div class="blank20"></div>
</div>

<div class="blank20"></div>

<input type="hidden" name="batch" value="">
<input class="btn btn-primary" type="button" value=" 删除 " name="delete" onclick="if(getSelect(this.form) && confirm('确实要删除ID为('+getSelect(this.form)+')的记录吗?')){this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='delete'; this.form.submit();}"/>


</form>