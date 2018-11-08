<?php $root = config::get('base_url').'/ueditor';?>
    <script type="text/javascript" charset="utf-8" src="{$root}/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="{$root}/ueditor.all.js"> </script>
    <script type="text/javascript" charset="utf-8" src="{$root}/lang/zh-cn/zh-cn.js"></script>
    <script type="text/javascript" charset="utf-8" src="{$root}/addCustomizeButton.js"></script>

<form method="post" name="form1" action="<?php if(front::$act=='edit') $id="/id/".$data[$primary_key]; else $id=''; echo modify("/act/".front::$act."/table/".$table.$id);?>"  onsubmit="return checkform();">
<input type="hidden" name="onlymodify" value=""/>


    <script type="text/javascript" src="{$base_url}/js/upimg/dialog.js"></script>
    <link href="{$base_url}/images/admin/dialog.css" rel="stylesheet" type="text/css" />

    
    
    
<script>
var base_url = '{$base_url}';
function attachment_delect(id) {
$.ajax({
url: '{url('tool/deleteattachment/site/'.front::get('site'),false)}&id='+id,
type: 'GET',
dataType: 'text',
timeout: 1000,
error: function(){
//	alert('Error loading XML document');
},
success: function(data){
document.form1.attachment_id.value=0;
get('attachment_path').innerHTML='';
get('file_info').innerHTML='';
}
});
}
</script>


<ul class="nav nav-tabs" role="tablist">
<li role="presentation" class="active"><a href="#tag1" aria-controls="#tag1" role="tab" data-toggle="tab">基本信息</a></li>
<li role="presentation"><a href="#tag2" aria-controls="#tag2" role="tab" data-toggle="tab">SEO信息</a></li>
<li role="presentation"><a href="#tag3" aria-controls="#tag3" role="tab" data-toggle="tab">属性设置</a></li>
<li role="presentation"><a href="#tag4" aria-controls="#tag4" role="tab" data-toggle="tab">扩展信息</a></li>
<li role="presentation"><a href="#tag5" aria-controls="#tag5" role="tab" data-toggle="tab">权限审核</a></li>
</ul>



<div class="tab-content">


<!-- 基本信息 -->
<div role="tabpanel" class="tab-pane active" id="tag1">

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">上级分类</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('parentid',$form,$field,$data)}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="顶级分类可跳过！">
</span>
</div>
</div>
<div class="clearfix"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">分类名称</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('typename',$form,$field,$data)}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="填写分类名称！">
</span>
</div>
</div>
<div class="clearfix"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">分类副标题</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('subtitle',$form,$field,$data)}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="分类自定义副标题！"></span>
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">目录名称</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('htmldir',$form,$field,$data)}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="目录必须是英文名，留空则自动使用拼音名！">
</span>
</div>
</div>
    
</div>







<!-- SEO信息 -->
<div role="tabpanel" class="tab-pane" id="tag2">

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">网页标题</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('meta_title',$form,$field,$data)}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="可填写不同于内容名称的关键词，有利于搜索优化！"></span>
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">关键词</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('keyword',$form,$field,$data)}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="网页META信息中的keywords信息，可填写与内容相关的关键词，以英文逗号相隔，有利于搜索优化！"></span>
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">页面描述</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('description',$form,$field,$data)}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="网页META信息中的description信息，可填写与内容相关的简介，有利于搜索优化！"></span>
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"></div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<div class="alert alert-warning alert-danger" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
	<span class="glyphicon glyphicon-warning-sign"></span>	<strong>URL规则</strong> 	[	以下选项如不熟悉操作，请勿修改！]	
    </div>
</div>
</div>

<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">当前分类</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left form-group has-error">
<input name="htmlrule1" type="text" class="form-control" value="{$data['htmlrule']}" />
<div class="blank30"></div>
{form::getform('htmlrule',$form,$field,$data)}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="默认：<b>{</b>$caturl<b>}</b>/type_<b>{</b>$page<b>}</b>.html！"></span>
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">列表页</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left form-group has-error">
<input name="listhtmlrule1" type="text" class="form-control" value="{$data['listhtmlrule']}" />
<div class="blank30"></div>
{form::getform('listhtmlrule',$form,$field,$data)}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="默认：<b>{</b>$caturl<b>}</b>/type_<b>{</b>$page<b>}</b>.html！"></span>
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">标记</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left form-group has-success">
{form::getform('stype',$form,$field,$data)}

<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="被调用的格式：type<b>(</b>$typeid,&prime;标记&prime;<b>)</b>;！"></span>
</div>
</div>
<div class="clearfix blank20"></div>
    
</div>


<!-- 属性设置 -->
<div role="tabpanel" class="tab-pane" id="tag3">
    
<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">是否启用</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('isshow',$form,$field,$data)}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="选择栏目是否启用！');" onmouseout="tooltip.hide();">

</span>
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">当前使用模板</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('template',$form,$field,$data)}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="当前栏目应用的模板样式！');" onmouseout="tooltip.hide();">

</span>
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">所属下级列表页模板</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('listtemplate',$form,$field,$data)}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="栏目下属子级栏目应用模板样式！');" onmouseout="tooltip.hide();">

</span>
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">动静态设置</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('ishtml',$form,$field,$data)}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="选择栏目是否生成静态，如设置了浏览与下载权限，栏目必须为动态显示！<br />默认为继承网站动静态设置！');" onmouseout="tooltip.hide();">

</span>
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">分页设置</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('ispages',$form,$field,$data)}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="选择栏目是否分页显示！');" onmouseout="tooltip.hide();">

</span>
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">子分类内容设置</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('includecatarchives',$form,$field,$data)}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="选择栏目列表中是否包含下属栏目中的内容！');" onmouseout="tooltip.hide();">

</span>
</div>
</div>
<div class="clearfix blank20"></div>


<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">外部链接</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('linkto',$form,$field,$data)}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="填写外部链接地址后，访问栏目将跳转到填写的地址！');" onmouseout="tooltip.hide();">

</span>
</div>
</div>
<div class="clearfix blank20"></div>

</div>

<!-- 扩展信息 -->
<div role="tabpanel" class="tab-pane" id="tag4">

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">封面内容</div>
<div class="col-xs-8 col-sm-8 col-md-7 col-lg-5 text-left">
{form::getform('typecontent',$form,$field,$data)}

<div class="fieldset flash" id="fsUploadProgress">
<span class="legend"></span>
</div>
<div id="divStatus"></div>

<div class="blank30"></div>
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="如使用设置栏目封面，请在模板处选择本栏目应用list_page.html模板！');" onmouseout="tooltip.hide();"></span>
</div>
</div>
<div class="clearfix blank20"></div>
<style type="text/css">
	#typecontent {min-height:500px;}
</style>
<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">分类说明图片</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('image',$form,$field,$data)} 
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="栏目banner功能,需在模板中调用显示！');" onmouseout="tooltip.hide();">

</span>
</div>
</div>
<div class="clearfix blank20"></div>
    
</div>


<!-- 权限设置 -->

<div role="tabpanel" class="tab-pane" id="tag5">
<div class="table-responsive">
<table class="table table-hover">
<thead>
<tr class="th">
<th align="center" width="20%">用户组</th>
<th align="center"  width="35%">浏览</th>
<th align="center"  width="35%">下载附件</th>
</tr>
<thead>
<tbody>
{loop usergroup::getInstance()->group $group}
<?php if($group['groupid']=='888') continue; ?>
<tr>
<td align="center">{$group.name}</td>
<td align="center">{form::checkbox("_ranks[".$group['groupid']."][view]",-1, @$data['_ranks'][$group['groupid']]['view'])}</td>
<td align="center">{form::checkbox("_ranks[".$group['groupid']."][down]",-1, @$data['_ranks'][$group['groupid']]['down'])}</td>
</tr>
{/loop}
</tbody>
</table>
</div>
<div class="blank30"></div>

<div class="alert alert-warning alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <span class="glyphicon glyphicon-warning-sign"></span>	 勾选为该用户组禁止浏览或下载</a>
</div>
    

</div>
</div>

<div class="line"></div>
<div class="blank30"></div>
<input type="submit" name="submit" value=" 提交 " class="btn btn-primary" />
</form>