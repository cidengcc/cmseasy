<?php if(!defined('ROOT'))
    exit('Can\'t Access !'); ?>

<?php if(count($_POST) == 0) { ?>
    <div>
        说明：
    </div>
<?php } ?>

<div class="blank10"></div>

<?php if(count($_POST) == 0) { ?>
    <?php if($check->check_time != false) { ?>
        <form class="checkform" method="post" action="">
            <input class="btn_a" name="check" type="submit" value="扫描文件">
            <span class="wait">正在扫描文件，请耐心等待...</span>
        </form>
    <?php } ?>

    <div class="blank10"></div>

    <form class="checkform" method="post" action="<?php echo FileCheck::GetUrl(array('action'=>'backup')) ?>">
        <input class="btn_a" name="check" type="submit" value="备份文件并生成校验信息">
        <span class="wait">正在备份文件，请耐心等待...</span>
    </form>
<?php } ?>

<?php if(count($_POST) > 0) { ?>

    <?php if($check->pass == true) { ?>
        <span class="message">扫描结果： 共扫描文件<?php echo $check->count; ?>个。文件与目录安全！</span>
    <?php } ?>

    <?php if($check->pass == false) { ?>
<span class="message">
        扫描结果：
        共扫描文件<?php echo $check->count; ?>个。
        其中被更改文件(<span><?php echo $check->changed_count; ?></span>)个,
        被添加文件(<span><?php echo $check->created_count; ?></span>)个,
        丢失文件(<span><?php echo $check->lost_count; ?></span>)个。
    </span>
    <?php } ?>

    <ul class="message">
        <?php
        if($check->changed_count > 0) {
            echo '<h5>被更改的文件</h5>';
            foreach($check->changed as $file) {
                echo '<li>'.$file.'</li>';
            }
        }
        if($check->created_count > 0) {
            echo '<h5>被增加的文件</h5>';
            foreach($check->created as $file) {
                echo '<li>'.$file.'</li>';
            }
        }
        if($check->lost_count > 0) {
            echo '<h5>丢失的文件</h5>';
            foreach($check->lost as $file) {
                echo '<li>'.$file.'</li>';
            }
        }
        ?>
    </ul>

    <?php if($check->pass == false) { ?>
        <form class="checkform" method="post" action="<?php echo FileCheck::GetUrl(array('action'=>'recover')) ?>">
            <input class="btn_a" name="check" type="submit" value="还原文件" onclick="return confirm('此操作涉及文件删除与替换操作，确定需要还原到此前状态吗?');">
            <span class="wait">正在还原文件，请耐心等待...</span>
        </form>
    <?php } ?>

<div class="blank30"></div>
<div class="line"></div>
<div class="blank30"></div>
<a class="btn btn-steeblue" href="<?php echo FileCheck::GetUrl(array('action'=>'check')) ?>">返回</a>

<?php
}
?>
