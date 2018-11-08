<?php if(count($_POST) == 0) { ?>
    <form ckass="checkform" method="post" action="">
         <input class="btn btn-steeblue" name="make" type="submit" value="保存当前文件指纹信息">
    </form>
<?php } ?>

<?php if(count($_POST) > 0) {
    if($make->Success) { ?>
		<div class="alert alert-warning alert-danger" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
<span class="glyphicon glyphicon-warning-sign"></span>	文件指纹信息已保存！	
</div>
        <form method="get" action="">
            <input  class="btn btn-steeblue" name="submit" type="hidden" value="返回">
        </form>
    <?php }
} ?>