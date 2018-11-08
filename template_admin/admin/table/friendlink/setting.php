
<form name="settingform" id="settingform"  action="<?php echo uri();?>" method="post">
<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">分类</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::textarea('types',get('types')?get('types'):$settings['types'],'class="textarea"')}
</div>
</div>
<div class="clearfix blank30"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">例如</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
(1)网站首页<br />(2)链接首页
</div>
</div>


<div class="blank30"></div>
<div class="line"></div>
<div class="blank30"></div>
<input type="submit" name="submit" value=" 提交 " class="btn btn-primary" />
</form>