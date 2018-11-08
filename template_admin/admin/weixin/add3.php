
<form method="post" name="form1" action="<?php if(front::$act=='edit') $id="/id/".$data[$primary_key]; else $id=''; echo modify("/act/".front::$act."/table/".$table.$id);?>"  onsubmit="return checkform();">
<input type="hidden" name="id" id="id" value="<?php echo $data['id'];?>" class="form-control" />

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">名称</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left"><input type="text" name="name" id="name" value="<?php echo $data['name']; ?>" class="form-control" /></div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">原始ID</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left"><input type="text" name="oldid" id="oldid" value="<?php echo $data['oldid']; ?>" class="form-control" /></div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">微信号</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left"><input type="text" name="weixinid" id="weixinid" value="<?php echo $data['weixinid']; ?>" class="form-control" /></div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">AppId</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left"><input type="text" name="appid" id="appid" value="<?php echo $data['appid']; ?>" class="form-control" /></div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">AppSecret</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left"><input type="text" name="appsecret" id="appsecret" value="<?php echo $data['appsecret']; ?>" class="form-control" /></div>
</div>

<div class="blank30"></div>
<div class="line"></div>
<div class="blank30"></div>

<input type="submit" name="submit" value="提交" class="btn btn-primary" />
</form>
