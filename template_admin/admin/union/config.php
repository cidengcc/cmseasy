<ul class="nav nav-tabs" role="tablist">
<li class="active"><a href="{$base_url}/index.php?case=table&act=list&table=friendlink&admin_dir={get('admin_dir')}&site=default">联盟配置</a></li>
<li><a href="{$base_url}/index.php?case=union&act=visit&table=union&admin_dir={get('admin_dir')}&site=default">访问统计</a></li>
<li><a href="{$base_url}/index.php?case=union&act=reguser&table=union&admin_dir={get('admin_dir')}&site=default">注册统计</a></li>
<li><a href="{$base_url}/index.php?case=union&act=pay&table=union&admin_dir={get('admin_dir')}&site=default">结算记录</a></li>
</ul>

<div class="blank30"></div>


<form method="post" name="form1" action="<?php if(front::$act=='edit') $id="/id/".$data[$primary_key]; else $id=''; echo modify("/act/".front::$act."/table/".$table.$id);?>"  onsubmit="return checkform();">



<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">推广联盟开关</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<select name="setting[enabled]" class="form-control select"> 
<option value="1" {if $data['enabled']==1}selected{/if}>开</option> 
<option value="0" {if $data['enabled']==0}selected{/if}>关</option> 
</select> 
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">Cookie保存时间</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<select name="setting[keeptime]" class="form-control select"> 
<option value="86400" {if $data['keeptime']==86400}selected{/if}>一天</option> 
<option value="604800" {if $data['keeptime']==604800}selected{/if}>一周</option> 
<option value="2592000" {if $data['keeptime']==2592000}selected{/if}>一月</option> 
<option value="7776000" {if $data['keeptime']==7776000}selected{/if}>一季度</option> 
<option value="15552000" {if $data['keeptime']==15552000}selected{/if}>半年</option> 
<option value="31536000" {if $data['keeptime']==31536000}selected{/if}>一年</option> 
</select> 
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">初始利润率</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<div class="row">
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5">
<input name='setting[profitmargin]' type='text' id='profitmargin' value='{$data['profitmargin']}' class="form-control">
</div>
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2">
%
</div>
</div>
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">访客默认跳转地址</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<input name='setting[forward]' type='text' id='forward' value='{$data['forward']}' class="form-control">
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">有效IP赠送点数</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<div class="row">
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5">
<input name='setting[rewardnumber]' type='text' id='rewardnumber' value='{$data['rewardnumber']}' class="form-control"> 
</div>
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2">
<select name="setting[rewardtype]" class="form-control select"> 
<option value="point" >点</option> 
</select> 
</div>
</div>
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">注册用户赠送点数</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<div class="row">
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5">
<input name='setting[regrewardnumber]' type='text' value='{$data['regrewardnumber']}' class="form-control"> 
</div>
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2">
<select name="setting[regrewardtype]" class="form-control select"> 
<option value="point" >点</option> 
</select> 
</div>
</div>
</div>
</div>
<div class="clearfix blank20"></div>

<div class="blank30"></div>
<div class="line"></div>
<div class="blank30"></div>
<input type="submit" name="submit" value="提交" class="btn btn-primary" />

</form>
