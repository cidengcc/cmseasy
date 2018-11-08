<ul class="nav nav-tabs" role="tablist">
<li><a href="{$base_url}/index.php?case=database&act=baker&admin_dir={get('admin_dir')}&site=default">备份数据库</a></li>
<li><a href="{$base_url}/index.php?case=database&act=restore&admin_dir={get('admin_dir')}&site=default">还原数据库</a></li>
<li><a href="{$base_url}/index.php?case=adminlogs&act=manage&admin_dir={get('admin_dir')}&site=default">日志管理</a></li>
<li><a href="{$base_url}/index.php?case=database&act=str_replace&admin_dir={get('admin_dir')}&site=default">替换字符串</a></li>
<li><a href="{$base_url}/index.php?case=database&act=phpwebinsert&admin_dir={get('admin_dir')}&site=default">导入PHPweb数据</a></li>
<li class="active"><a href="{$base_url}/index.php?case=database&act=backAll&admin_dir={get('admin_dir')}&site=default">备份整站</a></li>
</ul>

<div class="blank30"></div>
<script>
$(function(){
	$('#btn_zip').click(function(){
		//$(this).attr('disabled',true);
		$(this).addClass("btn_b").removeClass("btn_c");
		$('#resinfo').html('<div class="blank30"></div><img src="images/admin/loading.gif" /> 正在压缩...'); 
		$.get("{url('database/dobackAll',true)}", function(data){
		  if(data == 'ok'){
			  $('#resinfo').html('压缩完成');
			  window.location.reload();
		  }else{
			  $('#resinfo').html(data);  
		  }
		});
	});	
});
</script>
<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">

<input id="btn_zip" type="button" name="submit" value=" 开始备份 " class="btn btn-lightslategray" />
<div id="resinfo"></div>
<div class="blank30"></div>

<div class="table-responsive">
<table class="table table-hover">
<thead>
<tr class="th">
<th class="s_out"><input title="点击可全选本页的所有项目"  onclick="CheckAll(this.form)" type="checkbox" name="chkall" class="checkbox" /></th>
          <th align="left" class="catname">档案</th>
          <th class="manage">操作</th>
        </tr>
		</thead>
<tbody>
        {loop $db_dirs $dir}
      <tr class="s_out">
           <td class="catid"  align="center"><input onclick="c_chang(this)" type="checkbox" value="{$dir}" name="select[]" class="checkbox" /> </td>
          <td align="left" class="catname">{$dir}</td>
           <td class="manage" align="center">
            <a href="<?php echo 'data/backup/'.$dir;?>" target="_blank"  class="btn_d">下 载</a>
           </td>
        </tr>
       {/loop}

      </tbody>
    </table>
</div>

<div class="blank30"></div>
<div class="line"></div>
<div class="blank30"></div>

<input type="submit" name="submit" value=" × 删除 " onclick="return getSelect(this.form) && confirm('确实要 【删除】 备份档案 ( '+getSelect(this.form)+' ) 吗?');" class="btn btn-primary" />

</form>