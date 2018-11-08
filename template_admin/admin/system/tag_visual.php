
<script type="text/javascript" src="{$base_url}/common/js/jquery-1.2.6.min.js"></script>
<script src="{$base_url}/common/js/jquery/jquery-latest.js"></script>
<script>
    $('.tagedit').attr('style','BORDER-RIGHT: #ffcc99 1px solid; MARGIN:3px;PADDING: 6px; BORDER-TOP: #ffcc99 1px solid;BORDER-LEFT: #ffcc99 1px solid; COLOR: #ff9900; BORDER-BOTTOM: #ffcc99 1px solid; BACKGROUND-COLOR: #ffffcc; ');
//    $('.tagedit').click(function() {
//        //alert($(this).attr('tagid'));
//        $('#tageditframe').attr('src','{url('table/edit/onlymodify/1/table/templatetag/main/1/id/')}+$(this).attr('tagid')+'&prefix=<?php //echo $front::get('prefix');  ?>');
//        $("#example").css('display','block');
//        $("#example").dialog({height:570,width:730});
//    });
</script>

<script  src="{$base_url}/common/js/jquery/ui/ui.core.js"></script>
<!--script  src="{$base_url}/common/js/jquery/ui/ui.resizable.js"></script-->
<script  src="{$base_url}/common/js/jquery/ui/ui.draggable.js"></script>
<script  src="{$base_url}/common/js/jquery/ui/ui.dialog.js"></script>
<script src="{$base_url}/common/js/jquery/jquery.form.js"></script>
<link rel="stylesheet" href="{$base_url}/common/js/jquery/ui/themes/flora/flora.all.css" type="text/css"/>


<div id="example" class="flora" title="自定义标签管理"  style="display:none;">
    <iframe src="" id="tageditframe" width="700" height="500">
    </iframe>
</div>