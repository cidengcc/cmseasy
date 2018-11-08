<script language="javascript" src="{$base_url}/common/js/common.js"></script>

<form method="post" name="form1" action="<?php
if (front::$act == 'edit')
    $id="/id/".$data[$primary_key]."/tagfrom/".$_GET['tagfrom']; else
    $id=''; echo modify("/act/".front::$act."/table/".$table.$id);
?>"  onsubmit="return checkform();">
<input type="hidden" name="onlymodify" value=""/>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">标签名称</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('name',$form,$field,$data)}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="标签名不能为纯数字"></span>
</div>
</div>


<input type="hidden" name="tagfrom" value="{get('tagfrom')}" class="form-control" />

{if get('tagfrom')=='category'}

{template 'table/templatetagwap/listtag_helper_edit_cat.php'}

{elseif get('tagfrom')=='content'}

{template 'table/templatetagwap/listtag_helper_edit.php'}

{else}



<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">标签内容</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('tagcontent',$form,$field,$data)}
</div>
</div>
<div class="clearfix blank20"></div>

{/if}

 

<div class="blank30"></div>
<div class="line"></div>
<div class="blank30"></div>
<input type="submit" name="submit" value="提交" class="btn btn-primary" />
</form>