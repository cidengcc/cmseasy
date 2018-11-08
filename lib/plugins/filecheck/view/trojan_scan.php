<?php if (!defined('ROOT')) exit('Can\'t Access !'); ?>

<?php if (count($_POST) == 0) { ?>

<ul class="nav nav-tabs" role="tablist">
<li><a href="index.php?case=filecheck&act=filecheck&action=file_check&admin_dir=<?php echo get('admin_dir');?>&site=default">文件校对</a></li>
<li class="active"><a href="index.php?case=filecheck&act=filecheck&action=trojan_scan&admin_dir=<?php echo get('admin_dir');?>&site=default">木马查杀</a></li>
<!-- <li><a href="index.php?case=safe&act=webshell&admin_dir=<?php echo get('admin_dir');?>&site=default">后门查杀</a></li>
<li><a href="index.php?case=safe&act=protect&admin_dir=<?php echo get('admin_dir');?>&site=default">攻击防护</a></li> -->
</ul>

<div class="blank30"></div>



    <form class="checkform" method="post" action="">
        <input class="btn btn-primary" name="scan" type="submit" value="查杀木马">
        <span class="wait">正在扫描文件，请耐心等待...</span>

		<a class="btn btn-steeblue" href="<?php echo FileCheckApp::GetUrl(array('action' => 'trojan_history')) ?>">木马恢复区</a>

    </form>

    

<?php } ?>

<?php if (count($_POST) > 0) { ?>
<?php if ($scan->pass == false) { ?>
<div class="alert alert-warning alert-danger" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
<span class="glyphicon glyphicon-warning-sign"></span>	发现可疑文件！
</div>

<div class="table-responsive">
<table class="table table-hover">
<thead>
<tr class="th">
<th class="s_out">选择</th>
<th class="catid" align="center">位置</th>
<th class="catname" align="center">类型</th>
<th class="catname" align="center">文件名</th>
</tr>
</thead>
<tbody>
<form class="checkform" method="post" action="<?php echo FileCheckApp::GetUrl(array('action' => 'trojan_remove')) ?>">
            <?php foreach ($scan->fail as $fail) { ?>
			<tr>
<td><input type="checkbox" name="files[]" value="<?php echo $fail->file; ?>" checked="checked"></td>
<td><?php echo $fail->file; ?></td>

                <?php foreach ($fail->codes as $code) { ?>
                    <td><?php echo $code->name; ?></td>
                    <td><?php highlight_string($code->code); ?></td>
       
                <?php } ?>
     </tr>
            <?php } ?>

            

			</tbody>
  </table>
</div>

<div class="line"></div>
<div class="blank30"></div>

            <input class="btn btn-steeblue" name="remove" type="submit" value="清除可疑文件">
            <!--input class="btn_a" name="replace" type="submit" value="清除可疑代码，保留文件"-->
            <span class="wait">正在清除，请耐心等待...</span>
			<a class="btn btn-primary" href="<?php echo FileCheckApp::GetUrl(array('action' => 'trojan_scan')) ?>">返回</a>
</form>

</div>
<?php } ?>

<?php if ($scan->pass) { ?>
<div class="alert alert-warning alert-danger" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
<span class="glyphicon glyphicon-warning-sign"></span>	<strong>扫描结果：</strong> 	[	没有发现可疑文件！	]	
</div>
<div class="line"></div>
<div class="blank30"></div>
<a class="btn btn-primary" href="<?php echo FileCheckApp::GetUrl(array('action' => 'trojan_scan')) ?>">返回</a>
<?php } ?>



<?php } ?>


