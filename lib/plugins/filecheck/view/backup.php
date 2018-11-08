<?php if (!defined('ROOT')) exit('Can\'t Access !');?>

<?php if(count($_POST) == 0) { ?>
    <form class="checkform" method="post" action="">
        <input class="btn btn-primary" name="backup" type="submit" value="备份文件并生成校验信息">
        <span class="wait">正在备份文件，请耐心等待...</span>
    </form>
<?php } ?>

<?php if(count($_POST) > 0) {
    if($check->pass) { ?>
        所有文件均与备份文件一致，无需重复备份。
    <?php }
    if($check->pass==false) {
        if($backup->Success) { ?>
            文件已备份。
        <?php }
        if($make->Success) { ?>
            文件校验信息已保存。
        <?php }
    }
} ?>

<div class="blank30"></div>
<div class="line"></div>
<div class="blank30"></div>
<a  class="btn btn-primary" href="<?php echo FileCheck::GetUrl(array('action'=>'check')) ?>">返回</a>