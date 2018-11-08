<input type="button" name="Submit" value="返回列表" class="btn btn-primary" onclick="javascript:window.history.back(-1);">

<div class="blank30"></div>
<form method="post" action="" name="form1" id="form1" onsubmit="checkform1()">

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">表单名称</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<input name="cname" id="cname" value="{get('cname')}" class="form-control">
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">表名</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<input name="name" id="name" value="{=get('name')?get('name'):'my_'}" class="form-control">
</div>
</div>
<div class="clearfix blank20"></div>


<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">模板</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::select('template','',front::$view->myform_tpl_list())}
</div>
</div>
<div class="clearfix blank20"></div>

<div class="blank30"></div>
<div class="line"></div>
<div class="blank30"></div>
<input type="submit" name="submit" value=" 提交 " class="btn btn-primary" />

</form>