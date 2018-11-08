<?php $this->render('field/edit.php'); return;?>

<input type="button" name="Submit" value="返回列表" class="btn btn-primary" onclick="javascript:window.history.back(-1);">

<div class="blank30"></div>


<form name="fieldform" method="post" action="<?php echo modify("case/field/act/".front::$act."/table/".$table);?>">

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">名称</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<input name="name" value="my_" class="form-control">
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">类型</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<select name="type" class="form-control select">
<option value="int">整数</option>
<option value="varchar">单行文本</option>
<option value="text" onclick="document.fieldform.len.hidden='hidden'">多行文本</option>
<option value="mediumtext">超文本</option>
	
<option value="datetime">日期</option>
<option value="radio">[单选]</option>
<option value="checkbox">[多选]</option>
	
</select>
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">长度</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<input name="len" value="100" class="form-control">
</div>
</div>
<div class="clearfix blank20"></div>


<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">字段中文名</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<input name="cname" value="" class="form-control">
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">单选/多选  选项</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::textarea('select','',' rows="6" cols="40" ')}
</div>
</div>
<div class="clearfix blank20"></div>

<div class="blank30"></div>
<div class="line"></div>
<div class="blank30"></div>
<input type="submit" name="submit" value=" 提交 " class="btn btn-primary" />

</form>

