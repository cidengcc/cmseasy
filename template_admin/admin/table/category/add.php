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
url: '<?php echo url('tool/deleteattachment/site/'.front::get('site'),false)?>&id='+id,
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
<script type="text/javascript">
function stob(type){
if(type == 'single'){
$("#batch").css('display','none');
$("#single").css('display','block');
return;
}
if(type == 'batch'){
$("#single").css('display','none');
$("#batch").css('display','block');
return;
}
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
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">添加方式</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<input name="addtype" value="single"  type="radio" checked="checked" onclick="stob(this.value)" /> 
单条添加&nbsp;&nbsp;&nbsp;&nbsp;
<input name="addtype" value="batch" type="radio" onclick="stob(this.value)"  > 
批量添加
</div>
</div>
<div class="clearfix blank30"></div>

<div id="single" style="display:block;">
<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">所属栏目</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">{form::getform('parentid',$form,$field,$data)}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="如果为一级栏目，不需选择！"></span>
</div>
</div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">栏目名称</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left"><input type="text" class="form-control" name="catname" id="catname" />
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="请填写栏目名称！"></span>
</div>
</div>
<div class="clearfix blank20"></div>


<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">栏目副标题</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left"><input type="text" class="form-control" name="subtitle" id="subtitle" />
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="栏目自定义副标题！"></span>
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">目录名称</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left"><input type="text" class="form-control" onkeyup="value=value.replace(/[^0-9a-zA-Z-]/g,'') " onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))" name="htmldir" id="htmldir" />
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="目录必须是英文名，留空则自动使用拼音名，请勿夹杂符号！"></span>
</div>
</div>
<div class="clearfix blank20"></div>
</div>

<div id="batch" style="display:none;">
<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">栏目名称</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">

<div class="row">
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5"><textarea name="batch_add" maxlength="255" class="form-control textarea"></textarea></div>
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2">例如：<br />栏目1|lanmu1<br />
栏目2|lanmu2
</div>
</div>

</div>
</div>
</div>




<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">在导航中显示</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('isnav',$form,$field,$data)}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="是否在导航中显示栏目！"></span>
</div>
</div>
<div class="clearfix blank20"></div>


<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">在手机版中显示</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">{form::getform('ismobilenav',$form,$field,$data)}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="是否在导航中显示栏目！"></span>
</div>
</div>
<div class="clearfix blank20"></div>


</div>

<!-- SEO信息 -->
<div role="tabpanel" class="tab-pane" id="tag2">

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">网页标题</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">{form::getform('meta_title',$form,$field,$data,'class="form-control"')}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="可填写不同于内容名称的关键词，有利于搜索优化！"></span>
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">关键词</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">{form::getform('keyword',$form,$field,$data,'class="form-control"')}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="网页META信息中的keywords信息，可填写与内容相关的关键词，以英文逗号相隔，有利于搜索优化！"></span>
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">页面描述</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">{form::getform('description',$form,$field,$data,'')}
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
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">当前栏目列表</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left form-group has-error"><input name="htmlrule1" type="text" class="form-control" value="{$data['htmlrule']}" />
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="<strong>默&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;认：</strong>&#123;$caturl&#125;/&#123;$page&#125;.html <br /><strong>短&nbsp;&nbsp;目&nbsp;&nbsp;录：</strong>&#123;$dir&#125/&#123;$page&#125;.html<br /><strong>自&nbsp;&nbsp;定&nbsp;&nbsp;义：</strong>自定义（英文或拼音）/&#123;$page&#125;.html<br /><strong>栏目目录：</strong>&#123;$caturl&#125;<br /><strong>当前目录：</strong>&#123;$dir&#125;<br /><strong>注&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;意：</strong>&#123;$page&#125;必须存在URL内且为最后！"></span>

</div>
</div>




<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"></div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left form-group has-error">
{form::getform('htmlrule',$form,$field,$data,'')}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="<strong>默&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;认：</strong>&#123;$caturl&#125;/&#123;$page&#125;.html <br /><strong>短&nbsp;&nbsp;目&nbsp;&nbsp;录：</strong>&#123;$dir&#125/&#123;$page&#125;.html<br /><strong>自&nbsp;&nbsp;定&nbsp;&nbsp;义：</strong>自定义（英文或拼音）/&#123;$page&#125;.html<br /><strong>栏目目录：</strong>&#123;$caturl&#125;<br /><strong>当前目录：</strong>&#123;$dir&#125;<br /><strong>注&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;意：</strong>&#123;$page&#125;必须存在URL内且为最后！"></span>
</div>
</div>
<div class="clearfix blank20"></div>


<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">所属子栏目</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left form-group has-success"><input name="listhtmlrule1" type="text" class="form-control" value="{$data['listhtmlrule']}" />
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="<strong>默&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;认：</strong>&#123;$caturl&#125;/&#123;$page&#125;.html <br /><strong>短&nbsp;&nbsp;目&nbsp;&nbsp;录：</strong>&#123;$dir&#125/&#123;$page&#125;.html<br /><strong>自&nbsp;&nbsp;定&nbsp;&nbsp;义：</strong>自定义（英文或拼音）/&#123;$page&#125;.html<br /><strong>栏目目录：</strong>&#123;$caturl&#125;<br /><strong>当前目录：</strong>&#123;$dir&#125;<br /><strong>注&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;意：</strong>&#123;$page&#125;必须存在URL内且为最后！"></span>
</div>
</div>




<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"></div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left form-group has-success">
{form::getform('listhtmlrule',$form,$field,$data,'')}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="<strong>默&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;认：</strong>&#123;$caturl&#125;/&#123;$page&#125;.html <br /><strong>短&nbsp;&nbsp;目&nbsp;&nbsp;录：</strong>&#123;$dir&#125/&#123;$page&#125;.html<br /><strong>自&nbsp;&nbsp;定&nbsp;&nbsp;义：</strong>自定义（英文或拼音）/&#123;$page&#125;.html<br /><strong>栏目目录：</strong>&#123;$caturl&#125;<br /><strong>当前目录：</strong>&#123;$dir&#125;<br /><strong>注&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;意：</strong>&#123;$page&#125;必须存在URL内且为最后！"> </span></span>
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">所属内容页</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left form-group has-warning"><input name="showhtmlrule1" type="text" class="form-control" value="{$data['showhtmlrule']}" />
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="<strong>默&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;认：</strong>&#123;$caturl&#125;/show_&#123;$aid&#125;(_&#123;$page&#125;).html<br /><strong>短&nbsp;&nbsp;目&nbsp;&nbsp;录：</strong>&#123;$dir&#125/show_&#123;$aid&#125;(_&#123;$page&#125;).html<br /><strong>自&nbsp;&nbsp;定&nbsp;&nbsp;义：</strong>自定义（英文或拼音）/&#123;$page&#125;.html<br /><strong>栏目目录：</strong>&#123;$caturl&#125;<br /><strong>当前目录：</strong>&#123;$dir&#125;<br /><strong>注&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;意：</strong>&#123;$page&#125;必须存在URL内且为最后！"></span></span>
</div>
</div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"></div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left form-group has-warning">
{form::getform('showhtmlrule',$form,$field,$data,'class=""')}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="<strong>默&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;认：</strong>&#123;$caturl&#125;/show_&#123;$aid&#125;(_&#123;$page&#125;).html<br /><strong>短&nbsp;&nbsp;目&nbsp;&nbsp;录：</strong>&#123;$dir&#125/show_&#123;$aid&#125;(_&#123;$page&#125;).html<br /><strong>自&nbsp;&nbsp;定&nbsp;&nbsp;义：</strong>自定义（英文或拼音）/&#123;$page&#125;.html<br /><strong>栏目目录：</strong>&#123;$caturl&#125;<br /><strong>当前目录：</strong>&#123;$dir&#125;<br /><strong>注&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;意：</strong>&#123;$page&#125;必须存在URL内且为最后！"></span>
</div>
</div>
<div class="clearfix blank20"></div>

</div>

<!-- 属性设置 -->
<div role="tabpanel" class="tab-pane" id="tag3">

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">当前使用模板</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('template',$form,$field,$data)}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="当前栏目使用的模板样式！" onmouseout="tooltip.hide();"></span>
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">所属列表模板</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('listtemplate',$form,$field,$data)}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="栏目下属子级栏目应用模板样式！" onmouseout="tooltip.hide();"></span>
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">所属内容模板</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('showtemplate',$form,$field,$data)}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="栏目下属内容页模板样式！" onmouseout="tooltip.hide();"></span>
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">手机版当前使用模板</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('templatewap',$form,$field,$data)}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="当前栏目应用的模板样式！" onmouseout="tooltip.hide();"></span>
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">手机版所属列表模板</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('listtemplatewap',$form,$field,$data)}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="栏目下属子级栏目应用模板样式！" onmouseout="tooltip.hide();"></span>
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">手机版所属内容模板</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('showtemplatewap',$form,$field,$data)}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="栏目下属内容页模板样式！" onmouseout="tooltip.hide();"></span>
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">内容绑定表单</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('showform',$form,$field,$data)}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="栏目下属内容页绑定表单！" onmouseout="tooltip.hide();"></span>
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">是否启用</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('isshow',$form,$field,$data)}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="选择栏目是否启用！" onmouseout="tooltip.hide();"></span>
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">动静态设置</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('ishtml',$form,$field,$data)}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="选择栏目是否生成静态，如设置了浏览与下载权限，栏目必须为动态显示！<br />默认为继承网站动静态设置！" onmouseout="tooltip.hide();"></span>
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">分页设置</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<td>{form::getform('ispages',$form,$field,$data)}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="选择栏目是否分页显示！" onmouseout="tooltip.hide();"></span>
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">分页值</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('attr3',$form,$field,$data,'class="input_c"')}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="留空按全局设置数量显示！" onmouseout="tooltip.hide();"></span>
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">防伪码前缀</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<td>{form::getform('ecoding',$form,$field,$data,'class="form-control"')}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="防伪码前缀！" onmouseout="tooltip.hide();"></span>
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">子内容设置</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('includecatarchives',$form,$field,$data)}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="选择栏目列表中是否包含下属栏目中的内容！" onmouseout="tooltip.hide();"></span>
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">外部链接</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('linkto',$form,$field,$data,'class="form-control"')}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="填写外部链接地址后，访问栏目将跳转到填写的地址！" onmouseout="tooltip.hide();"></span>
</div>
</div>
<div class="clearfix blank20"></div>

</div>


<!-- 扩展信息 -->
<div role="tabpanel" class="tab-pane" id="tag4">

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">封面内容</div>
<div class="col-xs-8 col-sm-8 col-md-7 col-lg-5 text-left">


{form::getform('categorycontent',$form,$field,$data)} 
<img src="{$skin_path}/images/remind.gif"  data-toggle="tooltip" data-html="ture" data-placement="left" title="如使用设置栏目封面，请在模板处选择本栏目应用list_page.html模板！" onmouseout="tooltip.hide();">
<div style="max-width: 575px;margin-top: 0px;">
<div class="fieldset flash" id="fsUploadProgress">
<span class="legend"></span>
</div>
<div id="divStatus"></div>

</div>
<div class="blank30"></div>

</div>
</div>
<div class="clearfix blank20"></div>
<style type="text/css">
	#categorycontent {min-height:500px;}
</style>
<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">栏目说明图片</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('image',$form,$field,$data)}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="栏目banner功能,需在模板中调用显示！" onmouseout="tooltip.hide();"></span>
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">栏目列表缩略图宽</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::input('thumb_width',$data['thumb_width'])}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="仅限于模板中使用该参数时有效！<br >默认: {type::getwidthofthumb(get('id'))} px × {type::getheightofthumb(get('id'))} px！" onmouseout="tooltip.hide();"></span>
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">栏目列表缩略图高</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::input('thumb_height',$data['thumb_height'])}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="仅限于模板中使用该参数时有效！<br >默认: {type::getwidthofthumb(get('id'))} px × {type::getheightofthumb(get('id'))} px！" onmouseout="tooltip.hide();"></span>
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
<th>用户组</th>
<th>浏览</th>
<th>下载</th>
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
  <span class="glyphicon glyphicon-warning-sign"></span>	 勾选为该用户组禁止浏览或下载
</div>

</div>

</div>

<div class="line"></div>
<div class="blank30"></div>
<input type="submit" name="submit" value=" 提交 " class="btn btn-primary" />
</form>
<script>
	$(function(){
		$("input[name='ispages']").change(function(){
			if($(this).val() == '0'){
				//console.log($(this).val());
				$('#template').val('archive/list_page.html');
				$('#htmlrule').val('<?php echo chr(123).'$dir'.chr(125);?>.html');
				$('#listhtmlrule').val('<?php echo chr(123).'$dir'.chr(125);?>.html');
			}
		});
	});
</script>