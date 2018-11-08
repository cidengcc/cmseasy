<?php if (!defined('ROOT'))exit('Can\'t Access !'); ?>

<style type="text/css">
	.alert span {font-weight:bold;color:red;}
</style>


<?php if (count($_POST) == 0) { ?>
<div class="alert alert-warning alert-danger" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
<span class="glyphicon glyphicon-warning-sign"></span>	强烈推荐安装后，<strong style="color:red">备份文件并生成校验信息 ! </strong>
</div>
<?php } ?>



<ul class="nav nav-tabs" role="tablist">
<li class="active"><a href="index.php?case=filecheck&act=filecheck&action=file_check&admin_dir=<?php echo get('admin_dir');?>&site=default">文件校对</a></li>
<li><a href="index.php?case=filecheck&act=filecheck&action=trojan_scan&admin_dir=<?php echo get('admin_dir');?>&site=default">木马查杀</a></li>
<!-- <li><a href="index.php?case=safe&act=webshell&admin_dir=<?php echo get('admin_dir');?>&site=default">后门查杀</a></li>
<li><a href="index.php?case=safe&act=protect&admin_dir=<?php echo get('admin_dir');?>&site=default">攻击防护</a></li> -->
</ul>

<div class="blank30"></div>





<?php if (empty($_POST)) { ?>
<?php if (empty($datafiles) == false) { ?>

<div class="table-responsive">
<table class="table table-hover">
<thead>
<tr class="th">
<th class="htmldir" align="center">时间</th>
<th class="catname" align="center">目录</th>
<th class="manage" align="center">操作</th>
</tr>
</thead>
<tbody>
            <?php foreach ($datafiles as $dfile) { ?>
                <tr>
                    <form class="checkform" method="post" action="">
                        <td class="htmldir" align="center">
                            <?php echo $dfile->date; ?>
                            <?php if (empty($dfile->dir) == false) { ?>
                        </td>
                        <td class="catname" align="center">
                                <?php echo $dfile->dir; ?>
                            <?php } ?>
                            <?php if (empty($dfile->file) == false) { ?>
                                文件:
                                <?php echo $dfile->file; ?>
                            <?php } ?>
                        </td>
                        <td class="manage" align="center">
                        <input name="name" type="hidden" value="<?php echo $dfile->name; ?>">
                        <input class="btn btn-steeblue" name="check" type="submit" value="扫描文件改动">
                        <span class="wait">正在扫描文件，请耐心等待...</span>
                        <?php if ($dfile->name != 'system') { ?>
                        <input class="btn btn-steeblue" name="delete" type="submit" value="删除备份" onclick="return confirm('确定要删除此备份吗?');">
                        <?php } ?>
                        <?php if ($dfile->name == 'system') { ?>
                            (系统备份)
                        <?php } ?>
                        <span class="wait">正在删除备份...</span>
                    </td>
                    </form>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</div>

<?php } ?>
<div class="blank30"></div>
<div class="line"></div>
<div class="blank30"></div>
<a class="btn btn-primary" href="<?php echo FileCheckApp::GetUrl(array('action' => 'file_backup')) ?>">选择生成文件校验信息</a>
<?php } ?>



<?php if (count($_POST) > 0) { ?>

<?php if ($check->pass == true) { ?>
<div class="alert alert-warning alert-danger" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
<span class="glyphicon glyphicon-warning-sign"></span>	<strong>扫描结果：</strong> 	[	共扫描文件<?php echo $check->count; ?>个，没有发现异常。	]	
</div>
<?php } ?>

<?php if ($check->pass == false) { ?>
<div class="alert alert-warning alert-danger" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
<span class="glyphicon glyphicon-warning-sign"></span>	<strong>扫描结果：</strong> 
<div class="blank10"></div>
共扫描文件：<span><?php echo $check->count; ?></span>个。
        <div class="blank10"></div>
        被更改文件（<span><?php echo $check->changed_count; ?></span>）个,
        <div class="blank10"></div>
        被新增文件（<span><?php echo $check->created_count; ?></span>）个,
        <div class="blank10"></div>
        被删除文件（<span><?php echo $check->lost_count; ?></span>）个。
</div>
<?php } ?>

    <div class="blank10"></div>

    <form class="checkform" method="post"
          action="<?php echo FileCheckApp::GetUrl(array('action' => 'file_recover')) ?>">
        <?php if ($check->changed_count > 0) { ?>
           <table border="0" cellspacing="0" cellpadding="0" id="table1" width="100%">
<thead>
<tr class="th">
<th colspan="2" algin="center">被更改文件</th>
</tr>
</thead>
<tbody id="listtable">
                
                    <?php foreach ($check->changed as $file) { ?>
                        <tr>
<td algin="center" width="10">
                        <input type="checkbox" name="changed[]" value="<?php echo $file; ?>"/>
                               </td>
                               <td algin="left">
                                <?php echo $file; ?>
                            </td>
                            </tr>
                    <?php } ?>
                </tbody>
    </table>
            <div class="blank10"></div>
        <?php } ?>


<?php if ($check->created_count > 0) { ?>
 <div class="table-responsive">
<table class="table table-hover">
<thead>
<tr class="th">
<th class="s_out" colspan="2" algin="center">被新增文件</th>
</tr>
</thead>
<tbody id="listtable">
<?php foreach ($check->created as $file) { ?>
<tr>
<td align="center"><input type="checkbox" name="created[]" value="<?php echo $file; ?>"/></td>
<td algin="left"><?php echo $file; ?></td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
<?php } ?>

<?php if ($check->lost_count > 0) { ?>
<table border="0" cellspacing="0" cellpadding="0" id="table1" width="100%">
<thead>
<tr class="th">
<th colspan="2" algin="center">被删除文件</th>
</tr>
</thead>
<tbody id="listtable">
                    <?php foreach ($check->lost as $file) { ?>
                         <tr>
<td algin="center" width="10">
    <input type="checkbox" name="lost[]" value="<?php echo $file; ?>"/>
                                    </td>
                               <td algin="left">
                                <?php echo $file; ?>
                            </td>
                                    </tr>
                    <?php } ?>
                </tbody>
    </table>
            <div class="blank10"></div>
        <?php } ?>

        </ul>

        <div class="blank10"></div>

        <?php if ($check->pass == false) { ?>
		<div class="line"></div>
<div class="blank30"></div>
            <input name="name" type="hidden" value="<?php echo $check->name; ?>">
            <input class="btn btn-primary" name="check" type="submit" value="还原文件"
                   onclick="return confirm('确定需要处理选中的文件吗?');">
            <span class="wait">正在还原文件，请耐心等待...</span>

			<a class="btn btn-steeblue" href="<?php echo FileCheckApp::GetUrl(array('action' => 'file_check')) ?>">返回</a>

<div class="blank30"></div>
<?php } ?>
</form>


<?php } ?>


