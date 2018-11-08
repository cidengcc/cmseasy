<?php if (!defined('ROOT')) exit('Can\'t Access !'); ?>

<script type="text/javascript">
    function selectAll(check) {
        var checkboxs = $(check.form).find(":input[name='files[]']");
        if ($(check).attr("checked") == 'checked')
            checkboxs.attr("checked", 'checked');
        else
            checkboxs.attr("checked", false);
    }

    $(document).ready(function() {
        var checkboxs = $('form.checkform').find(":input[name='files[]']");
        var check_all=$('form.checkform').find(":input.check_all");
        checkboxs.change(function () {
            if(this.checked != 'checked')
                check_all.attr("checked", false);
        });
    });
</script>


<ul class="nav nav-tabs" role="tablist">
<li class="active"><a href="index.php?case=filecheck&act=filecheck&action=file_check&admin_dir=<?php echo get('admin_dir');?>&site=default">文件校对</a></li>
<li><a href="index.php?case=filecheck&act=filecheck&action=trojan_scan&admin_dir=<?php echo get('admin_dir');?>&site=default">木马查杀</a></li>
<!-- <li><a href="index.php?case=safe&act=webshell&admin_dir=<?php echo get('admin_dir');?>&site=default">后门查杀</a></li>
<li><a href="index.php?case=safe&act=protect&admin_dir=<?php echo get('admin_dir');?>&site=default">攻击防护</a></li> -->
</ul>

<div class="blank30"></div>



<?php if (count($_POST) == 0) { ?>
    <form class="checkform" method="post" action="">
     
       
       <div class="table-responsive">
<table class="table table-hover">
<thead>
<tr class="th">
<th class="s_out"><input type="checkbox" class="check_all" value="全选"  onclick="CheckAll(this.form)" name="chkall" class="checkbox" /></th>
                <th class="catname">名称</th>
             </tr>

        </thead>
        <tbody>
		
            <?php foreach ($file_list->dirs as $dir) { ?>
            <tr>
                <td class="s_out" align="center">
                    <input type="checkbox" name="files[]" value="<?php echo $dir; ?>"/>
                </td>
                <td class="catname" align="left">
                    <?php echo $dir; ?>
                </td>
                </tr>
            <?php } ?>

            <?php foreach ($file_list->files as $file) { ?>
                <tr>
                <td class="s_out" align="center">
                    <input type="checkbox" name="files[]" value="<?php echo $file; ?>"/>
                 </td>
                <td class="catname" align="left">
                    <?php echo $file; ?>
                </td>
                </tr>
            <?php } ?>
            
           </tbody>
    </table>
</div>

<div class="blank30"></div>
<div class="line"></div>
<div class="blank30"></div>

        <input class="btn btn-primary" name="backup" type="submit" value="备份文件并生成校验信息">
        <span class="wait">正在备份文件，请耐心等待...</span>

		<a class="btn btn-steeblue" href="<?php echo FileCheckApp::GetUrl(array('action' => 'file_check')) ?>">返回</a>

    </form>
<?php } ?>

<?php if (count($_POST) > 0) {
    if ($backup->Success == true) { ?>
	<div class="alert alert-warning alert-danger" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
<span class="glyphicon glyphicon-warning-sign"></span>	文件和校验信息已备份 ! </strong>
</div>

<div class="line"></div>
<div class="blank30"></div>
		<a class="btn btn-steeblue" href="<?php echo FileCheckApp::GetUrl(array('action' => 'file_check')) ?>">返回</a>
    <?php }
} ?>


