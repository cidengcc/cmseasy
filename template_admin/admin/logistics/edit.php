
<input class="btn btn-primary" type="button" value=" 配货列表 " name="add" onclick="javascript:window.location.href='<?php echo modify("act/list/table/$table");?>'"/> 

<div class="blank30"></div>

<form method="post" action="" name="form1" id="form1" onsubmit="checkform1()">

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">配货方式</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<input type="text" name="title" id="title" value="{$data['title']}" class="form-control" />
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">配货方式描述</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::textarea('content',$data['content'],'class="textarea"')}
</div>
</div>
<div class="clearfix blank20"></div>


<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">配送价格</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<input type="text" name="price" id="price" value="{$data['price']}" class="form-control" />
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">超重价格</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<input type="text" name="overweight" id="overweight" value="{$data['overweight']}" class="form-control" />
</div>
</div>
<div class="clearfix blank20"></div>


<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">货到付款</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">

<label class="checkbox-inline">
<input type="radio" class="radio" value="1" name="cashondelivery" <?php if($data['cashondelivery']==1){?>checked="checked" <?php }?>  />
</label>
启用
<label class="checkbox-inline">
<input type="radio" class="radio" value="0" name="cashondelivery" <?php if($data['cashondelivery']==0){?>checked="checked" <?php }?> />
</label>
关闭
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="如果启用，则此配送方式费用不算入在线支付！"></span>
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">是否保价</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<label class="checkbox-inline">
  <input type="radio" value="1" name="insure" onclick="javascript:document.getElementById('insureproportion_box').style.display='';" <?php if($data['insure']==1){?>checked="checked" <?php }?>> 
</label>

 启用

 <label class="checkbox-inline">
<input type="radio" value="0" name="insure"  <?php if($data['insure']==0){?>checked="checked" <?php }?> onclick="javascript:document.getElementById('insureproportion_box').style.display='none';">
</label>

关闭

</div>
</div>
<div class="clearfix blank20"></div>
	

<div class="row" style="display:<?php if($data['insure']==0){?>none<?php }?>">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">保价比例</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">
<input type="text" name="insureproportion" id="insureproportion" value="{$data['insureproportion']}" class="form-control" />
</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">%</div>
</div>
</div>
</div>
<div class="clearfix blank20"></div>


</div>

<input type="hidden"  name="pay_id"       value="{$data['pay']['pay_id']}" />
<input type="hidden"  name="pay_code"     value="{$data['pay']['pay_code']}" />
<input type="hidden"  name="is_cod"       value="{$data['pay']['is_cod']}" />
<input type="hidden"  name="is_online"    value="{$data['pay']['is_online']}" />


<div class="line"></div>
<div class="blank30"></div>

<input type="submit" name="submit" value=" 提交 " class="btn btn-primary" />

</form>