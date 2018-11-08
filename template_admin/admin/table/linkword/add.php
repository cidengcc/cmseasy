

<form method="post" name="form1" action="<?php if(front::$act=='edit') $id="/id/".$data[$primary_key]; else $id=''; echo modify("/act/".front::$act."/table/".$table.$id);?>"  onsubmit="return checkform();">
<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">链接词</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('linkword',$form,$field,$data)}
</div>
</div>


<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">URL</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('linkurl',$form,$field,$data)}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="留空为搜索链接"></span>
</div>
</div>
<div class="clearfix blank30"></div>

    
<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">链接权重值</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('linkorder',$form,$field,$data)}
</div>
</div>
<div class="clearfix blank30"></div>

    
<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">链接次数</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('linktimes',$form,$field,$data)}
</div>
</div>
<div class="clearfix blank30"></div>

<div class="blank30"></div>
<div class="line"></div>
<div class="blank30"></div>
<input type="submit" name="submit" value=" 提交 " class="btn btn-primary" />
</form>