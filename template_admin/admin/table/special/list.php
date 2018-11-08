

<form name="listform" id="listform"  action="<?php echo uri(); ?>" method="post">

<input class="btn btn-primary" type="button" value=" 添加专题 " onclick="javascript:window.location.href='<?php echo url('table/add/table/special') ?>'" />

<div class="blank10"></div>

<div class="table-responsive">
<table class="table table-hover">
<thead>
<tr class="th">
<th class="s_out"><input title="点击可全选本页的所有项目"  onclick="CheckAll(this.form)" type="checkbox" name="chkall"> </th>
<!--<th>排序</th>-->
<th class="catid"><!--spid-->专题ID</th>
<th class="catname"><!--catname-->专题名称</th>
<th class="manage">操作</th>
</tr>

{loop $data $d}
<?php $spid=$d['spid']; ?>
<tr>
<td align="center" class="s_out"><input onclick="c_chang(this)" type="checkbox" value="{$spid}" name="select[]"></td>
<!--<td>{form::input("listorder[$d[$primary_key]]",$d['listorder'],'size=3')}</td>-->
<td align="center" class="catid">{$d['spid']}</td>
<td align="center" class="catname"><a href="<?php echo url("special/show/spid/$spid", false); ?>" target="_blank">{$d['title']}</a></td>

<td align="center" class="manage">
<a href="<?php echo url("special/show/spid/$spid", false); ?>" target="_blank">查看</a>

<a href="<?php echo modify("/act/edit/table/$table/id/$spid"); ?>">编辑</a>

<!-- <a href="<?php echo modify("/act/list/table/archive/spid/$spid"); ?>">管理专题内容</a> -->
<a onclick="javascript: return confirm('确实要删除吗?');" href="<?php echo modify("/act/delete/table/special/id/$spid/token/$token"); ?>">删除</a>

</td>
</tr>

{/loop}

</tbody>
</table>



</div>


<div class="line"></div>


<div class="page"><?php echo pagination::html($record_count); ?></div>

<input type="hidden" name="batch" value=" " class="btn btn-primary" />

</form>