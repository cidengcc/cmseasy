
<div class="alert alert-warning alert-danger" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
<span class="glyphicon glyphicon-warning-sign"></span>	欢迎来到数据库备份页面。您可以对网站数据备份，数据将保存在<strong style="color:red;">data</strong>文件夹中。	
</div>

<div class="blank30"></div>

<ul class="nav nav-tabs" role="tablist">
<li class="active"><a href="{$base_url}/index.php?case=database&act=baker&admin_dir={get('admin_dir')}&site=default">备份数据库</a></li>
<li><a href="{$base_url}/index.php?case=database&act=restore&admin_dir={get('admin_dir')}&site=default">还原数据库</a></li>
<li><a href="{$base_url}/index.php?case=adminlogs&act=manage&admin_dir={get('admin_dir')}&site=default">日志管理</a></li>
<li><a href="{$base_url}/index.php?case=database&act=str_replace&admin_dir={get('admin_dir')}&site=default">替换字符串</a></li>
<li><a href="{$base_url}/index.php?case=database&act=phpwebinsert&admin_dir={get('admin_dir')}&site=default">导入PHPweb数据</a></li>
<li><a href="{$base_url}/index.php?case=database&act=backAll&admin_dir={get('admin_dir')}&site=default">备份整站</a></li>
</ul>

<div class="blank30"></div>

<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">
<div class="table-responsive">
<table class="table table-hover">
<thead>
<tr class="th">
<th class="s_out"><input title="点击可全选本页的所有项目"  onclick="CheckAll(this.form)" type="checkbox" name="chkall" class="checkbox" /></th>
          <th class="catname" align="left">表名</th>
           <th class="catid" align="center">记录数</th>
           <th class="catid" align="center">大小</th>
        </tr>
</thead>
<tbody>
        {loop tdatabase::getInstance()->getTables() $table}
      <tr>
           <td class="s_out" align="center"><input onclick="c_chang(this)" type="checkbox" value="{$table.name}" name="select[]" class="checkbox" /></td>
          <td class="catname" align="left">{$table.name}</td>
          <td align="center" class="catid">{$table.count}</td>
          <td align="center" class="catid">{=ceil($table['size']/1024)}K</td>
        </tr>
       {/loop}

      </tbody>
    </table>
</div>

<div class="blank30"></div>

    <?php /*兼容MySQL4<input type="checkbox" name="mysql4" value="1"> */ ?>
{form::select('bagsize',0,array(0=>'请选择分卷大小...',1=>'1M',2=>'2M',5=>'5M',10=>'10M'))}

<div class="blank30"></div>
<div class="line"></div>
<div class="blank30"></div>

<input type="submit" name="submit" value=" 备份 " class="btn btn-primary" />
</form>
