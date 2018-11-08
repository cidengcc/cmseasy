<!-- 木马恢复区 -->
<div class="alert alert-warning alert-danger" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
<span class="glyphicon glyphicon-warning-sign"></span>	恢复可疑文件，请谨慎操作！
</div>

    
 <div class="table-responsive">
<table class="table table-hover">
<thead>
<tr class="th">
<th class="htmldir">位置</th>
<th class="htmldir" align="center">检测时间</th>
<th class="manage" align="center">操作</th>
</tr>
</thead>
<tbody>
<?php foreach ($history->packages as $package) { ?>
            <form class="checkform" action="" method="post">
			<tr>
                <?php foreach ($package->files as $file) { ?>
                        <td class="catname" align="left"><?php echo $file->file; ?></td>
                        <input type="hidden" name="file" value="<?php echo $file->file; ?>"/>
                <?php } ?>
              
                <td class="htmldir" align="center"><?php echo $package->date; ?></td>
                <td class="manage" align="center">
                <input type="hidden" name="package" value="<?php echo $package->file; ?>"/>
                <input class="btn btn-steeblue" name="delete" type="submit" value="删除"/>
                <span class="wait">正在删除文件...</span>
                <input class="btn btn-steeblue" name="restore" type="submit" value="恢复" onclick="return confirm('确定要恢复可疑文件吗?');"/>
                <span class="wait">正在恢复文件...</span>
</td>
				</tr>
            </form>
 <?php } ?>
 </tbody>
  </table>
</div>    




<div class="line"></div>
<div class="blank30"></div>
<a class="btn btn-primary" href="<?php echo FileCheckApp::GetUrl(array('action' => 'trojan_scan')) ?>">返回</a>
