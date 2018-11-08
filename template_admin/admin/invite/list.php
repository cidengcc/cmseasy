
<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">
<div class="row">
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5">
<input name="ctname" type="text" id="ctname" placeholder="请输入用户名" class="form-control" value="<?php echo front::$get['ctname'];?>" />
<input name="num" type="hidden" id="num" value="1" /></div>
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2">
<input id="btn_add" type="button" value=" 获取邀请码 " class="btn btn-primary" />
</div>
</div>
<div class="clearfix blank30"></div>

  <div class="table-responsive">
<table class="table table-hover">
<thead>
<tr class="th">
<th class="s_out"><input title="点击可全选本页的所有项目"  onclick="CheckAll(this.form)" type="checkbox" name="chkall" class="checkbox" /> </th>
          <th class="htmldir" align="center"><!--id-->编号</th>
          <th align="center" class="catname"><!--name-->邀请码</th>
          <th class="htmldir" align="center">生成人</th>
          <th class="htmldir" align="center"><!--url-->生成时间</th>
          <th align="center" class="catname"><!--url-->注册人</th>
          <th class="htmldir" align="center"><!--url-->注册时间</th>
          <th align="center" class="catname"><!--url-->是否使用</th>
          <th align="center" class="manage">操作</th>
        </tr>

</thead>
<tbody>
{loop $data $d}
<tr onmouseover="m_over(this)" onmouseout="m_out(this)" lang="0">
<td class="s_out" align="center"><input onclick="c_chang(this)" type="checkbox" value="{$d['inviteid']}" name="select[]" class="checkbox" /> </td>
<td class="htmldir" align="center" >{$d['inviteid']}</td>
<td align="center" class="catname">{$d['invitecode']}</td>
<td class="htmldir" align="center">{$d['ctname']}</td>
<td class="htmldir" align="center">{$d['cttime']}</td>
<td align="center" class="catname">{$d['regname']}</td>
<td class="htmldir" align="center">{$d['regtime']}</td>
<td align="center" class="catname"><?php echo $d['isuse']?'是':'否';?></td>
<td align="center" class="manage"><a onclick="javascript: return confirm('确实要删除吗?');" href="<?php echo url('invite/del/id/'.$d['inviteid']);?>">删除</td>
</tr>
{/loop}
      </tbody>
    </table>
</div>



<div class="line"></div>
<div class="blank30"></div>
<input type="hidden" name="batch" value="" />
<input  class="btn btn-primary" type="button" value=" 删除 " name="delete" onclick="if(getSelect(this.form) && confirm('确实要删除ID为('+getSelect(this.form)+')的记录吗?')){this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='delete'; this.form.submit();}"/>
</form>
<script>
$(function(){
	$('#btn_add').click(function(e) {
        $('#listform').attr('action','<?php echo url('invite/add',true);?>');
		$('#listform').submit();
    });
});
</script>