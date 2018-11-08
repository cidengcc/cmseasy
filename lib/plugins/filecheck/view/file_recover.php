<?php if (!defined('ROOT')) exit('Can\'t Access !');?>

<style type="text/css">
	.alert span {font-weight:bold;color:red;}
</style>

<?php if(count($_POST) == 0) { ?>
    <form class="checkform" method="post" action="">
        <input class="btn btn-steeblue" name="check" type="submit" value="还原文件" onclick="return confirm('此操作涉及文件删除与替换操作，确定需要还原到此前状态吗?');">
        <span class="wait">正在还原文件，请耐心等待...</span>
    </form>
<?php } ?>

<?php if(count($_POST) > 0) { ?>
<div class="alert alert-warning alert-danger" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
<span class="glyphicon glyphicon-warning-sign"></span>	共处理文件<strong>调用方法：</strong> 	[	<span class=""><?php echo $recover->count; ?></span>	]	个，还原成功！
</div>
<?php } ?>


<div class="line"></div>
<div class="blank30"></div>

<a class="btn btn-primary" href="<?php echo FileCheckApp::GetUrl(array('action'=>'file_check')) ?>">返回</a>
