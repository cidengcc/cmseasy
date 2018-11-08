
<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">

<div class="table-responsive">
<table class="table table-hover">
<thead>
<tr class="th">
<th class="catname"><!--name-->登录方式</th>
<th class="htmldir"><!--rate-->说明</th>
<th class="htmldir"><!--rate-->官方网站</th>
<th class="htmldir"><!--ver-->插件版本</th>
<th class="manage">操作</th>
</tr>
</thead>
<tbody>
{loop $data $d}

<tr class="s_out" onmouseover="m_over(this)" onmouseout="m_out(this)">
<td class="catname"><strong>{$d['name']}</strong>
</td>
<td class="htmldir" align="center">{$d['desc']}</td>
<td class="htmldir" align="center">{cut($d['website'])}</td>
<td class="htmldir" align="center">{cut($d['version'])}</td>
<td class="manage" align="center">
<?php if ($d['install']==0){?>
<span class="hotspot" onmouseover="tooltip.show('安装支付模块！');" onmouseout="tooltip.hide();">
<a href="<?php echo modify("act/install/table/$table/name/".$d['ologin_code']);?>" class="a_management">安装</a></span>

<?php }else{?>
<span class="hotspot" onmouseover="tooltip.show('编辑登录方式具体配置！');" onmouseout="tooltip.hide();">
<a href="<?php echo modify("act/edit/table/$table/id/".$d['id']);?>" class="a_edit">编辑</a></span>
<span class="hotspot" onmouseover="tooltip.show('确定要删除吗？');" onmouseout="tooltip.hide();">
<a onclick="javascript: return confirm('确实要删除吗?');" href="<?php echo modify("/act/delete/table/$table/id/".$d['id']);?>" class="a_del">删除</a></span>
<?php } ?>
</td>
</tr>
{/loop}


</tbody>
</table>
</div>

</form>