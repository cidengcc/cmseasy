<script type="text/javascript" src="{$base_url}/common/js/ajaxfileupload.js"></script>
<script type="text/javascript" src="{$base_url}/common/js/ThumbAjaxFileUpload.js"></script>

<ul class="nav nav-tabs" role="tablist">
<li role="presentation" class="active"><a href="#tag1" aria-controls="#tag1" role="tab" data-toggle="tab">基本信息</a></li>
<li role="presentation"><a href="#tag2" aria-controls="#tag2" role="tab" data-toggle="tab">自定义信息</a></li>
</ul>


<form method="post" name="form1" action="<?php if(front::$act=='edit') $id="/id/".$data[$primary_key]; else $id=''; echo modify("/act/".front::$act."/table/".$table.$id);?>"  onsubmit="return checkform();">
<input type="hidden" name="onlymodify" value=""/>
      
<div class="tab-content">

<!-- 基本信息 -->
<div role="tabpanel" class="tab-pane active" id="tag1">

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">用户名</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('username',$form,$field,$data)}
</div>
</div>


<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">密码</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('passwordnew',$form,$field,$data)}
</div>
</div>
<div class="clearfix blank30"></div>

    
<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">昵称</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('nickname',$form,$field,$data)} 
</div>
</div>
<div class="clearfix blank30"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">安全问题</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('question',$form,$field,$data)}
</div>
</div>
<div class="clearfix blank30"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">您的答案</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('answer',$form,$field,$data)}
</div>
</div>
<div class="clearfix blank30"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">用户组</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('groupid',$form,$field,$data)}
</div>
</div>
<div class="clearfix blank30"></div>

    
<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">QQ号码</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('qq',$form,$field,$data)}
</div>
</div>
<div class="clearfix blank30"></div>

    
<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">E-Mail</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('e_mail',$form,$field,$data)}
</div>
</div>
<div class="clearfix blank30"></div>

    
<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">电话</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('tel',$form,$field,$data)}
</div>
</div>
<div class="clearfix blank30"></div>

</div>

<!--自定义信息 -->
<div role="tabpanel" class="tab-pane" id="tag2">
    

{loop $field $f}
<?php
$name=$f['name'];
if(!preg_match('/^my_/',$name)) {
unset($field[$name]);
continue;
}
if(!isset($data[$name])) $data[$name]='';
?>
<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo setting::$var['user'][$name]['cname']; ?></div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<?php echo form::getform($name,$form,$field,$data); ?>
</div>
</div>
<div class="clearfix blank30"></div>
{/loop}
        
</div>
</div>

<div class="blank30"></div>
<div class="line"></div>
<div class="blank30"></div>
<input type="hidden" name="token" value="{$token}" />
<input type="submit" name="submit" value="提交" class="btn btn-primary" />
</form>