
<form name="listform" id="listform"  action="<?php echo uri();?>&o=" method="post">

<div class="table-responsive">
<table class="table table-hover">
<thead>
<tr class="th">
<th class="s_out"><input title="点击可全选本页的所有项目"  onclick="CheckAll(this.form)" type="checkbox" name="chkall"> </th>
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
<tr>
<td align="center" class="s_out"><input onclick="c_chang(this)" type="checkbox" value="{$id}" name="select[]"> </td>
<td align="center" >{$id}</td>
<td align="left" >{$htmlrule['hrname']}</td>
<td align="left" >{$htmlrule['htmlrule']}</td>
<td align="center" >{if $htmlrule['cate'] == 'archive'}内容{/if}{if $htmlrule['cate'] == 'category'}栏目{/if}</td>
<td align="center" >
<a onclick="javascript: return confirm('确实要删除吗?');" href="<?php echo modify("/act/htmlrule/table/$table/id/$id/o/del");?>">删除</a>
</td>
</tr>
{/loop}

        </tbody>
    </table>
	</div>

<div class="blank30"></div>
<div class="line"></div>
<div class="blank30"></div>

<div class="alert alert-warning alert-danger" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
<span class="glyphicon glyphicon-warning-sign"></span>	<strong>新增自定义URL规则</strong> 	[	请谨慎操作！]	
</div>


<table class="table table-hover">
<thead>
<tr class="th">
<th>名字</th>
<th>内容</th>
<th>所属</th>
<th>操作</th>
</tr>
</thead>
<tbody>

<tr class="s_out" >
<td align="center">
<input type="text" value="" name="hrname" id="hrname" class="form-control" /></td>
<td><input type="text" value="" name="htmlrule" class="form-control" />
</td>
<td>
  <select name="cate" class="form-control select">
    <option value="archive">内容</option>
    <option value="category">栏目</option>
  </select>
  </td>
  <td align="center"><input name="submit" type="submit" value="添加" class="btn btn-primary" /></td>
</tr>
        </tbody>
    </table>
</div>
</form>
<div class="blank10"></div>