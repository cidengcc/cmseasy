

<form method="post" name="form1" action="<?php if(front::$act=='edit') $id="/id/".$data[$primary_key]; else $id=''; echo modify("/act/".front::$act."/table/".$table.$id);?>"  onsubmit="return checkform();">
<input type="hidden" name="onlymodify" value=""/>
<input class="btn btn-primary" type="button" value=" 返航标签列表 " onclick="javascript:window.location.href='index.php?case=table&act=list&table=tag&admin_dir={get('admin_dir')}'" />

<div class="blank30"></div>


<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">标签名</div>
<div class="col-xs-6 col-sm-6 col-md-6 col-lg-4 text-left">{form::getform('tagname',$form,$field,$data)}</div>
<div class="col-xs-2 col-sm-2 col-md-3 col-lg-2 text-left">
<input type="submit" name="submit" value="提交" class="btn btn-primary"/>
</div>
<div class="blank30"></div>
<div class="line"></div>
<div class="blank30"></div>
</form>