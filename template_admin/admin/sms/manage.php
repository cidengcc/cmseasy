</form>
<div style="padding:0px 20px;">
<div class="alert alert-danger" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
<span class="glyphicon glyphicon-warning-sign"></span>	注意</span> 
充值前请先&nbsp;&nbsp;<a href="http://pay.cmseasy.cn/reg.php" target="_blank" class="btn btn-steeblue">注册用户</a>&nbsp;&nbsp;！并将短信设置里面账户和密码修改为注册用户和密码！在&nbsp;&nbsp;<a href="#tag2" class="btn btn-lightslategray">短信管理</a>&nbsp;&nbsp;内充值短信后方可正常使用！
</div>

<div class="alert alert-warning" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
<span class="glyphicon glyphicon-warning-sign"></span>	注意</span> 
你已发送&nbsp;<font color="#009900"><strong>{$info[1]}</strong></font>&nbsp;条短信,还有&nbsp;<font color="#CC0000"><strong>{$info[0]}</strong></font>&nbsp;条短信未使用！
</div>


<span style="float:right">
<a href="http://pay.cmseasy.cn/reg.php" target="_blank" class="btn btn-navy">注册</a>
<a href="{$base_url}/index.php?case=config&act=system&set=sms&admin_dir={get('admin_dir')}&site=default" class="btn btn-dodgerblue">设置</a>
<a target="_blank" href="http://pay.cmseasy.cn/list.php?username=<?php echo config::get('sms_username');?>&password=<?php echo md5(config::get('sms_password'));?>" class="btn btn-lightslategray">发送详情</a>
<a target="_blank" href="http://pay.cmseasy.cn/plist.php?username=<?php echo config::get('sms_username');?>&password=<?php echo md5(config::get('sms_password'));?>" class="btn btn-steeblue">充值详情</a>
<a href="http://pay.cmseasy.cn/rule.php" target="_blank" class="btn btn-default">查看许可协议</a>
</span>
</div>


<div class="tab-content">

<!-- 基本信息 -->
<div role="tabpanel" class="tab-pane active" id="tag1">
	
<form id="frmPay" name="frmPay" method="post" action="http://pay.cmseasy.cn/pay.php" target="_blank">
<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">充值条数</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<div class="row">
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
 <select name="num" id="num" class="form-control select">
  	<option value="10">10条	=	1.0 元（人民币）</option>
    <option value="100" selected>100条	=	 10 元（人民币）</option>
    <option value="200">200条	=	20 元（人民币）</option>
    <option value="300">300条	=	30 元（人民币）</option>
    <option value="500">500条	=	50 元（人民币）</option>
    <option value="1000">1000条	=	100 元（人民币）</option>
    <option value="5000">5000条	=	500 元（人民币）</option>
  </select>
 </div>

<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-left">
<input type="submit" value="充值" class="btn btn-steeblue" />
<input name="sms_username" type="hidden" value="<?php echo config::get('sms_username');?>">
 </div>

 </div>
</div>
</div>
<div class="clearfix blank20"></div>
</form>


<form method="post" action="{url('sms/manage')}">
<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">测试短信</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<div class="row">
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<input type="text" placeholder="接收号码" name="mobile" id="mobile" class="form-control" />
</div>
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-left">
<input type="submit" name="submit" id="submit" value="发送" class="btn btn-lightslategray" />
<input name="act" type="hidden" value="test">
</div>
</div>
</div>
</div>
<div class="clearfix blank20"></div>

</form>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">特别注意</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
						1、由于运营商业务量巨大，短信发送可能会有延时；<br />
						2、每周日的短信将保存后由下周一同意发送；<br />
						3、短信每条0.10元，如有价格变动见CmsEasy官网通知。<br />
</div>
</div>
<div class="clearfix blank20"></div>


<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">使用说明</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">

						1、首先，在网站后台的 [ 设置 ] － 填写好网站管理员的手机号码，随后<a href="http://pay.cmseasy.cn/reg.php" target="_blank" style="color:#009900">注册</a>短信平台用户；</br>
						2、注册用户后，将用户名和密码，填写在<a href="{$base_url}/index.php?case=config&act=system&set=sms&admin_dir={get('admin_dir')}&site=default" target="_blank" style="color:#009900">短信设置</a>的账户和密码里面；</br>
						3、然后进入<a href="{$base_url}/index.php?case=sms&act=manage&admin_dir={get('admin_dir')}&site=default" target="_blank" style="color:#009900">短信管理</a>界面，点击充值，可以按自己需要选择充值数量，最低充值人民币8角；</br>
						4、最后进入<a href="{$base_url}/index.php?case=config&act=system&set=sms&admin_dir={get('admin_dir')}&site=default" target="_blank" style="color:#009900">短信设置</a>，设置好短信发送的条件；</br>
						5、提交后，完成短信配置，网站可正常向访客发送短信。</br>
</div>
</div>
<div class="clearfix blank20"></div>


</div>
</div>
<div style="display:none;">
	{getCopyRight()}
</div>