<ul class="nav nav-tabs" role="tablist">
<li><a href="{$base_url}/index.php?case=database&act=baker&admin_dir={get('admin_dir')}&site=default">备份数据库</a></li>
<li><a href="{$base_url}/index.php?case=database&act=restore&admin_dir={get('admin_dir')}&site=default">还原数据库</a></li>
<li><a href="{$base_url}/index.php?case=adminlogs&act=manage&admin_dir={get('admin_dir')}&site=default">日志管理</a></li>
<li class="active"><a href="{$base_url}/index.php?case=database&act=str_replace&admin_dir={get('admin_dir')}&site=default">替换字符串</a></li>
<li><a href="{$base_url}/index.php?case=database&act=phpwebinsert&admin_dir={get('admin_dir')}&site=default">导入PHPweb数据</a></li>
<li><a href="{$base_url}/index.php?case=database&act=backAll&admin_dir={get('admin_dir')}&site=default">备份整站</a></li>
</ul>

<div class="blank30"></div>

<script>

    $(document).ready(function() {

        $('#stable').change(function() {
            showfield($('#stable').val());
        });

    });


    function showfield(table) {
        $.ajax({
            url: '<?php echo url('database/dbfield_select',true);?>',
            data:'&stable='+table,
            type: 'POST',
            dataType: 'json',
            timeout: 1000,
            error: function(){

            },
            success: function(data){
                $('#'+data.id).html(data.content);
            }
        });
    }
</script>

<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">
<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">数据表</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::select('stable',0,$tables,'style="font-size:12px"')}
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">把</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::textarea('replace1','','cols="50" rows="3"')}
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">替换成</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::textarea('replace2','','cols="50" rows="3"')}
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">条件</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::input('where','','size="60"')}</div>
</div>


</div>
<div class="blank30"></div>
<div class="line"></div>
<div class="blank30"></div>

{form::submit()}
</form>