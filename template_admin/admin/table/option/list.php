<form method="post" name="form1" action="<?php if(front::$act=='edit') $id="/id/".$data[$primary_key]; else $id=''; echo modify("/act/add/table/".$table.$id."/bid/".$ballot['id']);?>"  onsubmit="return checkform();">
<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">添加选项</div>
<div class="col-xs-6 col-sm-6 col-md-5 col-lg-4 text-left">
{form::getform('name',$form,$field,$data)}
</div>
<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 text-left">
<input type="submit" name="submit" value="	添加	" class="btn btn-steeblue"/>
</div>
</div>
</form>

<div class="blank30"></div>

<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">
<div class="table-responsive">
<table class="table table-hover">
<thead>
<tr class="th">
<th class="s_out"><input title="点击可全选本页的所有项目"  onclick="CheckAll(this.form)" type="checkbox" name="chkall" class="checkbox" /></th>
<th class="catid" align="center"><!--id-->编号</th>
<th class="catname" align="center"><!--title-->选项名字</th>
<th class="catid" align="center"><!--content-->票数</th>
<th class="manage" align="center">操作</th>
</tr>
</thead>
<tbody>
    {loop $data $d}
    <tr>
      <td class="s_out" align="center" ><input onclick="c_chang(this)" type="checkbox" value="{$d.$primary_key}" name="select[]" class="checkbox" /></td>
      <td class="catid" align="center">{cut($d['id'])}</td>
      <td class="catname" align="left">{cut($d['name'])}</td>
      <td class="catid" align="center">{cut($d['num'])}</td>
      <td class="manage" align="center">
	  <a href="<?php echo modify("act/edit/table/$table/id/$d[$primary_key]/bid/".front::$get['bid']);?>">编辑投票项</a>
	  <a onclick="javascript: return confirm('确实要删除吗?');" href="<?php echo modify("/act/delete/table/$table/id/$d[$primary_key]/token/$token"."/bid/".$ballot['id']);?>">删除</a>
	  </td>
    </tr>
    {/loop}
    </tbody>
    
  </table>
</div>

<div class="page">
  <?php if(get('table')!='type' && front::get('case')!='field') echo pagination::html($record_count); ?>
</div>
  
<div class="blank30"></div>
<div class="line"></div>
<div class="blank30"></div>

  <input type="hidden" name="batch" value="">
  <input class="btn btn-primary" type="button" value="删除" name="delete" onclick="if(getSelect(this.form) && confirm('确实要删除ID为('+getSelect(this.form)+')的记录吗?')){this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='delete'; this.form.submit();}"/>
</form>


<div class="blank30"></div>
<div class="line"></div>
<div class="blank30"></div>




