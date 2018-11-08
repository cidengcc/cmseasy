<input type="button" name="Submit" value="返回列表" class="btn btn-primary" onclick="javascript:window.history.back(-1);">

<div class="blank30"></div>

<form method="post" action="" name="form1" id="form1" onsubmit="checkform1()">

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">表单名称</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<input class="form-control" name="cname" id="cname" value="{=@setting::$var[$table]['myform']['cname']?setting::$var[$table]['myform']['cname']:get('cname')}" />
</div>
</div>
<div class="clearfix blank20"></div>


<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">表名</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<b>{$table}</b>
<input type="hidden"  name="name" id="name" value="{$table}" class="form-control" />
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">模板</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::select('template',@setting::$var[$table]['myform']['template']?setting::$var[$table]['myform']['template']:get('template'),front::$view->myform_tpl_list())}
</div>
</div>
<div class="clearfix blank20"></div>


<div class="blank30"></div>
<div class="line"></div>
<div class="blank30"></div>
<input type="submit" name="submit" value=" 提交 " class="btn btn-primary" />

</form>