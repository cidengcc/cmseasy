
<form method="post" action="" name="form1" id="form1" onsubmit="checkform1()">

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">支付方式</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<input type="text" name="pay_name" id="pay_name" value="{$data['pay']['pay_name']}" class="form-control" />
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">支付方式描述</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::textarea('pay_desc',$data['pay']['pay_desc'],'class="textarea"')}
</div>
</div>
<div class="clearfix blank20"></div>

{loop $data['pay']['pay_config'] $pay_config}
<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{$pay_config.label}</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<?php if ($pay_config['type'] == "text") {?> 
<input name="cfg_value[]" type="{$pay_config.type}" value="{$pay_config.value}" class="form-control" />
<?php }elseif ($pay_config['type'] == "textarea") {?> 
<textarea name="cfg_value[]" class="form-control textarea">{$pay_config.value}</textarea>
<?php }elseif ($pay_config['type'] == "select") {?>
{form::select('cfg_value[]', $pay_config['value'], $pay_config['range'])}
<?php } ?>  
<input name="cfg_name[]" type="hidden" value="{$pay_config.name}" class="form-control" />
<input name="cfg_type[]" type="hidden" value="{$pay_config.type}" class="form-control" />
<input name="cfg_lang[]" type="hidden" value="{$pay_config.lang}" class="form-control" />
</div>
</div>
<div class="clearfix blank20"></div>
{/loop}



<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">支付费率</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2">
<input size="3" name="pay_fee" id="pay_fee" value="{$data['pay']['pay_fee']}" class="form-control" /></div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
%
</div>
</div>
</div>
</div>
<div class="clearfix blank20"></div>


</div>

<input type="hidden"  name="pay_id" value="{$data['pay']['pay_id']}" />
<input type="hidden"  name="pay_code"     value="{$data['pay']['pay_code']}" />
<input type="hidden"  name="is_cod" value="{$data['pay']['is_cod']}" />
<input type="hidden"  name="is_online"    value="{$data['pay']['is_online']}" />

<div class="blank20"></div>
<input type="submit" name="submit" value=" 提交 " class="btn btn-primary" />

</form>