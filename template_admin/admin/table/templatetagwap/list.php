
<?php
$tagfrom = $_GET['tagfrom'];
if($tagfrom=='content'){
	$listname = '内容';
}elseif($tagfrom=='category'){
	$listname = '栏目';
}elseif($tagfrom=='function'){
	$listname = '函数';
}elseif($tagfrom=='system'){
	$listname = '系统';
}elseif($tagfrom=='define'){
	$listname = '自定义';
}
?>



<script type="text/javascript">
window.onload = function ()
{
	var aP = document.getElementsByTagName("table");
	var i = 0;
	for (i = 0; i < aP.length; i++)
	{
		aP[i].getElementsByTagName("a")[0].onclick = function ()
		{
			var aSpan = this.parentNode.getElementsByTagName("span");
			aSpan[0].innerHTML = aSpan[1].style.display == "block" ? "显示JS" : "隐藏";
			aSpan[1].style.display = aSpan[1].style.display == "block" ? "none" : "block";
		}	
	}	
}
</script>

<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">

<a href="{$base_url}/index.php?case=table&act=add&table=templatetagwap&tagfrom=content&admin_dir={get('admin_dir')}&site=default" class="btn btn-primary">添加手机内容标签</a>
<a href="{$base_url}/index.php?case=table&act=add&table=templatetagwap&tagfrom=category&admin_dir={get('admin_dir')}&site=default" class="btn btn-lightslategray">添加手机栏目标签</a>
<a href="{$base_url}/index.php?case=table&act=add&table=templatetagwap&tagfrom=define&admin_dir={get('admin_dir')}&site=default" class="btn btn-steeblue">添加手机自定义标签</a>

<div class="blank30"></div>




<div class="table-responsive">
<table class="table table-hover">
<thead>
<tr class="th">
<th class="s_out"><input title="点击可全选本页的所有项目"  onclick="CheckAll(this.form)" type="checkbox" name="chkall" class="checkbox" /> </th>
<!-- <th><!--id--><!--编号</th> -->
<th class="catname"><!--name-->名称</th>
<th class="htmldir">Js调用格式</th>
<th class="htmldir"><!--tagcontent-->标签模板</th>
<th class="manage">操作</th>
</tr>
</thead>
<tbody>
{loop $data $d}
<tr>
<td class="s_out" align="center" ><input onclick="c_chang(this)" type="checkbox" value="{$d.$primary_key}" name="select[]" class="checkbox" /> </td>
<!-- <td align="center">{cut($d['id'])}</td> -->
<td>{cut($d['name'])}</td>
<td class="catname">
<table>
<tr><td>站内调用：<span>{</span>tagwap_{cut($d['name'])}<span>}</span></td></tr>
<tr><td>站外调用：<a href="javascript:;"><span style="color:green;">显示JS</span></a><span style="display:none;margin-top:10px;">&lt;script src="{$base_url}/index.php?case=templatetag&act=get&id={cut($d['id'])}&="&gt;&lt;/script&gt;</span></td></tr>
</table>
</td>
<td class="htmldir"><?php
if($d['tagcontent']=='null'){
	$id = $d['id'];
	$path=ROOT.'/config/tag/'.get('tagfrom').'_'.$id.'.php';
	$tag_config = array();
	$tag_config_content = @file_get_contents($path);
	$tag_config = unserialize($tag_config_content);
	echo $tag_config['tagtemplate'];
}else{
	?>
	{tool::cn_substr(htmlspecialchars($d['tagcontent']),20)}
<?php
}
?></td>
<td align="center" class="manage">
<a href='<?php echo url("templatetagwap/test/id/$d[$primary_key]",false);?>' target="_blank">预览</a>
<?php
if(($_GET['tagfrom']!='function')){
?>
<a href="<?php echo modify("act/edit/table/$table/id/$d[$primary_key]/tagfrom/$tagfrom");?>">编辑</a>
<a onclick="javascript: return confirm('确实要删除吗?');" href="<?php echo modify("/act/delete/table/$table/id/$d[$primary_key]/token/$token");?>">删除</a>
<?php
}
?>
</td>
</tr>
{/loop}

</tbody>
</table>

</div>

<div class="line"></div>
<div class="blank30"></div>

<input type="hidden" name="batch" value="" />
<input  class="btn btn-primary" type="button" value="删除" name="delete" onclick="if(getSelect(this.form) && confirm('确实要删除ID为('+getSelect(this.form)+')的记录吗?')){this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='delete'; this.form.submit();}" />

</form>