<?php if (!defined('ROOT')) exit('Can\'t Access !');?>

<?php if(count($_POST) == 0) { ?>
    <form class="checkform" method="post" action="">
        <input class="btn btn-primary" name="recover" type="submit" value="还原">
        <span class="wait">正在还原文件，请耐心等待...</span>
    </form>
<?php } ?>

<?php if(count($_POST) > 0) { ?>
        <span class="message">还原成功。</span>

    <div class="blank10"></div>

    <form  class="checkform" method="post" action="<?php echo FileCheck::GetUrl(array('action'=>'check')) ?>">
        <input class="btn_a" name="check" type="submit" value="重新扫描文件">
        <span class="wait">正在重新扫描文件，请耐心等待...</span>
    </form>
<?php } ?>


<div class="line"></div>
<div class="blank30"></div>
<a class="btn btn-primary" href="<?php echo FileCheckApp::GetUrl(array('action'=>'check')) ?>">返回</a>
