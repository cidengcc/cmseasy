


<form action="<?php if(front::$act=='edit') $id="/id/".$data[$primary_key]; else $id=''; echo modify("/act/".front::$act."/table/".$table.$id);?>" method="post" enctype="multipart/form-data" name="form1"  onsubmit="return checkform();">
<input type="hidden" name="onlymodify" value=""/>
<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">批量导入内容</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">

<input type="file" name="excelFile" class="btn btn-default" id="excelFile">

<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="仅兼容Excel2003文件格式，默认批量导入模板文件在官网系统包内！"></span>
</div>
</div>

<div class="blank30"></div>
<div class="line"></div>
<div class="blank30"></div>
<input type="submit" name="submit" value="提交" class="btn btn-primary" />
</form>
