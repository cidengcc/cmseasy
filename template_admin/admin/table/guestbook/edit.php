

<form method="post" name="form1" action="<?php if(front::$act=='edit') $id="/id/".$data[$primary_key]; else $id=''; echo modify("/act/".front::$act."/table/".$table.$id);?>"  onsubmit="return checkform();">
<input type="hidden" name="onlymodify" value=""/>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">内容</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('content',$form,$field,$data)} 
</div>
</div>

                       
<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">回复</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('reply',$form,$field,$data)}
</div>
</div>


<div class="blank30"></div>
<div class="line"></div>
<div class="blank30"></div>
<input type="submit" name="submit" value=" 提交 " class="btn btn-primary"/>
</form>