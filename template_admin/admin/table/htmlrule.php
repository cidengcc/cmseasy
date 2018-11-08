<div class="blank20"></div>

<form name="listform" id="listform"  action="<?php echo uri();?>&o=" method="post">
<div class="blank5"></div>
<div id="tagscontent" class="right_box">

<table border="0" cellspacing="0" cellpadding="0" id="table1" width="100%">
<thead>
<tr class="th">
<th><input title="点击可全选本页的所有项目"  onclick="CheckAll(this.form)" type="checkbox" name="chkall"> </th>
<th>ID</th>
<th>名字</th>
<th>规则</th>
<th>所属</th>
<th>操作</th>
</tr>
</thead>
<tbody>
{loop $data $id $htmlrule}
{php $id+=1}
<tr class="s_out" >
<td align="center" ><input onclick="c_chang(this)" type="checkbox" value="{$id}" name="select[]"> </td>
<td align="center" >{$id}</td>
<td align="center" >{$htmlrule['hrname']}</td>
<td align="center" >{$htmlrule['htmlrule']}</td>
<td align="center" >{if $htmlrule['cate'] == 'archive'}内容{/if}{if $htmlrule['cate'] == 'category'}栏目{/if}</td>
<td align="center" >
<span class="hotspot" onmouseover="tooltip.show('确定要删除吗？');" onmouseout="tooltip.hide();"><a onclick="javascript: return confirm('确实要删除吗?');" href="<?php echo modify("/act/htmlrule/table/$table/id/$id/o/del");?>"></a></span>
</td>
</tr>
{/loop}

        </tbody>
    </table>
<br>
    <table border="0" cellspacing="0" cellpadding="0" id="table1" width="100%">
<thead>
<tr class="th">
<th align="left">&nbsp;&nbsp;&nbsp;&nbsp;添加新规则</th>
</tr>
</thead>
<tbody>
<tr class="s_out" >
<td align="left" >&nbsp;名字&nbsp;<input type="text" style="width:200px;" value="" name="hrname" id="hrname" class="input_d" />&nbsp;&nbsp;内容&nbsp;<input type="text" style="width:200px;" value="" name="htmlrule" class="input_d" />&nbsp;&nbsp;所属
  <select name="cate" id="cate">
    <option value="archive">内容</option>
    <option value="category">栏目</option>
  </select>  &nbsp;&nbsp;<input name="submit" type="submit" value="添加" class="btn_d" /></td>
</tr>
        </tbody>
    </table>
</div>
</form>
<div class="blank10"></div>
