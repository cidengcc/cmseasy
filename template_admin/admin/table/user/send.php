<ul class="nav nav-tabs" role="tablist">
<li class="active"><a href="{$base_url}/index.php?case=table&act=send&table=user&admin_dir={get('admin_dir')}&site=default">发送邮件</a></li>
<li><a href="{$base_url}/index.php?case=table&act=mail&table=user&admin_dir={get('admin_dir')}&site=default">注册会员群发</a></li>
<li><a href="{$base_url}/index.php?case=table&act=send&table=user&type=subscription&admin_dir={get('admin_dir')}&site=default">订阅会员群发</a></li>
</ul>
<div class="clearfix blank30"></div>
<?php
$st=$_GET['st'];
if(front::get('type')=='subscription'){
	
	
	if($_GET['site']!='default'){
		$path = config::get('site_url').'/data/subscriptionmail.txt';
	}else{
		$path = ROOT.'/data/subscriptionmail.txt';
	}
	
	
	$maillist = file_get_contents($path);
	$maillist = preg_match_all('/\[(.*?)\]/is',$maillist,$out);
	$out[1] = array_unique($out[1]);
	$maillist = implode(',',$out[1]);
	if($maillist[strlen($maillist)-1] == ',') $maillist = substr($maillist,0,-1);
}
?>

<form method="post" name="mail_form1" action=""  onsubmit="return checkform();">
<input type="hidden" name="onlymodify" value=""/>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">用户名</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<textarea name="mail_address" id="mail_address" class="form-control textarea"><?php if($st) {?>{table_user::mail_before()}<?php }?><?php if(front::get('type')=='subscription'){ echo $maillist; }?></textarea>
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="发送格式示例: username1@cmseasy.cn,<br>username2@cmseasy.cn,<br>....usernameN@cmseas.cn"></span>
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">邮件标题</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<input name="title" type="text" value="" class="form-control" />
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">发送内容</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<textarea name="content" id="sendmail" class="form-control textarea"></textarea>
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="可以输入合法的html代码"></span>
</div>
</div>
<div class="clearfix blank20"></div>

<div class="blank30"></div>
<div class="line"></div>
<div class="blank30"></div>
<input type="submit" name="submit" value="发送" class="btn btn-primary" />
</form>