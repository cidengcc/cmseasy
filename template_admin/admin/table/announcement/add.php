<?php $root = config::get('base_url').'/ueditor';?>
    <script type="text/javascript" charset="utf-8" src="{$root}/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="{$root}/ueditor.all.js"> </script>
    <script type="text/javascript" charset="utf-8" src="{$root}/lang/zh-cn/zh-cn.js"></script>
    <script type="text/javascript" charset="utf-8" src="{$root}/addCustomizeButton.js"></script>
<form method="post" name="form1" action="<?php if(front::$act=='edit') $id="/id/".$data[$primary_key]; else $id=''; echo modify("/act/".front::$act."/table/".$table.$id);?>"  onsubmit="return checkform();">






<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">公告标题</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('title',$form,$field,$data)} 
</div>
</div>
<div class="clearfix blank30"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">公告内容</div>
<div class="col-xs-8 col-sm-8 col-md-7 col-lg-5 text-left">
{form::getform('content',$form,$field,$data)}
</div>
</div>
<div class="clearfix blank30"></div>
</div>
<style type="text/css">
	#content {min-height:500px;}
</style>
<div class="line"></div>
<div class="blank30"></div>
<input type="submit" name="submit" value="提交" class="btn btn-primary"/>
</form>