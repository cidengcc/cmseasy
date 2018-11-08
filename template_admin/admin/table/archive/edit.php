
<style type="text/css">
	select#catid,select#typeid {width:100%;}
	input#title {width:80%;margin:0px;}
	span.hotspot {float:right; padding-left:10px;}
</style>

<script type="text/javascript">
    function checkform() {
        if(document.form1.catid.value=="0") {
            alert('请选择栏目');
            document.form1.catid.focus();
            return false;
        }
        if(!document.form1.title.value) {
            alert('请填写标题');
            document.form1.title.focus();
            return false;
        }
        {loop $field $f}
<?php
if (!preg_match('/^my_/', $f['name']) || !$f['notnull']) {
    //unset($field[$f['name']]);
    continue;
}

?>
        if(!document.form1.{$f['name']}.value){
            alert("请填写<?php echo setting::$var['archive'][$f['name']]['cname']; ?>");
            setTab('one',6,6);
            document.form1.{$f['name']}.focus();
            return false;
        }
        {/loop}
        return true;
    }
</script>
<form method="post" name="form1" action="<?php if (front::$act == 'edit')
    $id="/id/".$data[$primary_key]; else
    $id='';
echo modify("/act/".front::$act."/table/".$table.$id."/deletestate/".front::get('deletestate')); ?>" enctype="multipart/form-data" onsubmit="return checkform();">
    <input type="hidden" name="onlymodify" value=""/>
    <script type="text/javascript" src="{$base_url}/common/js/ajaxfileupload.js"></script>
    <script type="text/javascript" src="{$base_url}/common/js/jquery.imgareaselect.min.js"></script>
    <script type="text/javascript" src="{$base_url}/common/js/ThumbAjaxFileUpload.js"></script>
	<link rel="stylesheet" href="{$base_url}/common/js/jquery/ui/ui.datepicker.css" type="text/css" />
    <script language="javascript" src="{$base_url}/common/js/jquery/ui/ui.datepicker.js"></script>
    <script type="text/javascript" src="{$skin_path}/js/jquery.colorpicker.js"></script>

<?php $root = config::get('base_url').'/ueditor';?>
    <script type="text/javascript" charset="utf-8" src="{$root}/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="{$root}/ueditor.all.js"> </script>
    <script type="text/javascript" charset="utf-8" src="{$root}/lang/zh-cn/zh-cn.js"></script>
    <script type="text/javascript" charset="utf-8" src="{$root}/addCustomizeButton.js"></script>
    
    <script>
        $(function(){
            $("#catid").change( function(){
				get_field($("#catid").val());
            });
			$("#tag_option").change( function(){
				if($("#tag_option").find('option:selected').val() != '0'){
					if($("#tag").val() != ''){
						var sp = ',';	
					}else{
						sp = '';	
					}
					$("#tag").val($("#tag").val()+sp+$("#tag_option").find('option:selected').text());
					//$("#tagids").val($("#tagids").val()+sp+$("#tagid").find('option:selected').val());
				}
            });
			$("#color_btn").colorpicker({
				fillcolor:true,
				success:function(o,color){
					$("#title").css("color",color);
					$("#color").val(color);
				},
				reset:function(o,color){
					$("#title").css("color","");
					$("#color").val("");
				}
			});
			$("#title").css("color","{$data['color']}");
        });
        function attachment_delect(id) {
            $.ajax({
url: '{url('tool/deleteattachment/site/'.front::get('site'),false)}&id='+id,
type: 'GET',
dataType: 'text',
timeout: 10000,
error: function(){
    //	alert('Error loading XML document');
},
success: function(data){
    document.form1.attachment_id.value=0;
    get('attachment_path').value='';
	get('attachment_intro').value='';
	get('attachment_path_i').innerHTML='';
    get('file_info').innerHTML='';
}
            });
        }

        function get_field(catid) {
            $.ajax({
url: '<?php echo url('table/getfield/table/archive/aid/'.$data['aid'],true);?>&catid='+catid,
type: 'GET',
dataType: 'text',
timeout: 10000,
error: function(){
    //alert('Error loading XML document');
},
success: function(data){
    $("#con_one_6").html(data);
}
            });
        }
    </script>
    <link rel="stylesheet" href="{$base_url}/common/js/jquery/ui/ui.datepicker.css" type="text/css" media="screen" title="core css file" charset="utf-8" />
<script language="javascript" src="{$base_url}/common/js/jquery/ui/ui.datepicker.js"></script>
    <script type="text/javascript" src="{$base_url}/js/upimg/dialog.js"></script>
    <link href="{$skin_path}/css/dialog.css" rel="stylesheet" type="text/css" />



<ul class="nav nav-tabs" role="tablist">
<li role="presentation" class="active"><a href="#tag1" aria-controls="#tag1" role="tab" data-toggle="tab">基本信息</a></li>
<li role="presentation"><a href="#tag2" aria-controls="#tag2" role="tab" data-toggle="tab">SEO信息</a></li>
<li role="presentation"><a href="#tag3" aria-controls="#tag3" role="tab" data-toggle="tab">属性设置</a></li>
<li role="presentation"><a href="#tag4" aria-controls="#tag4" role="tab" data-toggle="tab">扩展信息</a></li>
<li role="presentation"><a href="#tag5" aria-controls="#tag5" role="tab" data-toggle="tab">权限审核</a></li>
<li role="presentation"><a href="#tag6" aria-controls="#tag6" role="tab" data-toggle="tab">自定义字段</a></li>
</ul>

<div class="tab-content">

<!-- 基本信息 -->
<div role="tabpanel" class="tab-pane active" id="tag1">

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">栏目</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('catid',$form,$field,$data)}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="选择内容所在栏目，如果栏目有子级栏目，请选择子级栏目！"></span>
</div>
</div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">分类</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">{form::getform('typeid',$form,$field,$data)}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="选择内容所在分类，如果分类有子级分类，请选择子级分类！"></span>
</div>
</div>


<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">专题</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<?php echo form::select('spid',$data['spid'], special::option()); ?>
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="将内容划分到不同专题内，可对不同内容进行区分！"></span>
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">置顶</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('toppost',$form,$field,$data)}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="文章置顶,可按栏目或全站置顶！"></span>
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">标题</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<span class="hotspot"><img id="color_btn" width="14" height="14" src="{$base_url}/images/admin/colorpicker.png" style="cursor:pointer;" /><input id="color" name="color" type="hidden" /></span>  <span class="hotspot"><input name="strong" type="checkbox" value="1" {if $data['strong']==1}checked{/if} /></span>{form::getform('title',$form,$field,$data,'class="form-control"')}
</div>
</div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">副标题</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('subtitle',$form,$field,$data,'class="form-control"')}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="内容自定义副标题！"></span>
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">正文</div>
<div class="col-xs-8 col-sm-8 col-md-9 col-lg-10 text-left">
{form::getform('content',$form,$field,$data)}

<div class="fieldset flash" id="fsUploadProgress">
<span class="legend"></span>
</div>
<div id="divStatus"></div>
</div>

</div>
<div class="clearfix blank20"></div>
<style type="text/css">
	#content {min-height:500px;}
</style>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"></div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<input name="savehttppic" type="checkbox" value="1" id="pic1" />&nbsp;保存远程图片&nbsp;&nbsp;<input name="autothumb" type="checkbox" value="1" id="pic2" />&nbsp;第一张图片自动保存为缩略图
</div>
</div>
<div class="clearfix blank20"></div>
<script type="text/javascript">
<!--
	$('#pic2').on('change',function(){
    if ($(this).is(':checked')) {
        $('#pic1').prop('checked','checked');
    }else{
        $('#pic1').removeProp('checked');
    }
})
//-->
</script>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">内容简介</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('introduce',$form,$field,$data)}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="填写内容简介，如留空将自动截取内容中字符作为简介！"></span>
</div>
</div>
<div class="clearfix blank20"></div>


<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">Tag标签</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('tag',$form,$field,$data)}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="选择内容所属Tag标签！"></span>
</div>
</div>
<div class="clearfix blank20"></div>


<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"></div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('tag_option',$form,$field,$data)}
</div>
</div>
<div class="clearfix blank20"></div>
    

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">发布时间</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<input type="text" name="adddate" id="adddate" value="<?php echo date('Y-m-d H:i:s'); ?>" class="skey form-control" /><span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="内容发布时间，可自定义，格式：2010-08-08 08:08:08！"></span>
</div>
</div>
<div class="clearfix blank20"></div>
	
<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">过期时间</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('outtime',$form,$field,$data)}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="过期内容会被删除到回收站！"></span>
</div>
</div>
<div class="clearfix blank20"></div>
    
<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">发布作者</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<input type="text" name="author" id="author" value="<?php echo $user['username'] ?>"   class="form-control skey" />
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="内容发布作者名，可自定义！"></span>
</div>
</div>
<div class="clearfix blank20"></div>
   
<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">来源</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('attr3',$form,$field,$data)}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="内容发布来源，可自定义，默认为本站网址！"></span>
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">审核</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('checked',$form,$field,$data)}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="设置内容是否发布，勾选未审核，不在前台显示，内容在后台列表可继续编辑！<br />默认：为审核状态！"></span>
</div>
</div>
<div class="clearfix blank20"></div>

</div>



<!-- SEO信息 -->
<div role="tabpanel" class="tab-pane" id="tag2">

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">网页标题</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('mtitle',$form,$field,$data)}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="可填写不同于内容名称的关键词，有利于搜索优化！"></span>
</div>
</div>
<div class="clearfix blank20"></div>


<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">网页关键词</div>
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
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">URL规则</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left form-group has-error">
<input name="htmlrule1" type="text" class="form-control" value="{$data['htmlrule']}" />
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="你可以自定生成文件名称<br /><br />例如：abc.html<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>{</b>$caturl<b>}</b>/abc.html<br />默认：<b>{</b>$caturl<b>}</b>/show_<b>{</b>$aid<b>}</b>(_<b>{</b>$page<b>}</b>).html<br /><b>{</b>$caturl<b>}</b> = 栏目目录<br /><b>{</b>$aid<b>}</b> = 内容ID<br /><b>{</b>$page<b>}</b> = 内容分页值！"></span>
<div class="clearfix blank20"></div>
{form::getform('htmlrule',$form,$field,$data)}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="你可以选择系统默认的URL规则<br />例如：abc.html<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>{</b>$caturl<b>}</b>/abc.html<br />默认：<b>{</b>$caturl<b>}</b>/show_<b>{</b>$aid<b>}</b>(_<b>{</b>$page<b>}</b>).html<br /><b>{</b>$caturl<b>}</b> = 栏目目录<br /><b>{</b>$aid<b>}</b> = 内容ID<br /><b>{</b>$page<b>}</b> = 内容分页值！"></span>
</div>
</div>
<div class="clearfix blank20"></div>
    

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">生成HTML</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('ishtml',$form,$field,$data)}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="选择内容是否生成静态，如设置了浏览与下载权限，内容必须为动态显示！<br />默认为继承栏目动静态设置！"></span>
</div>
</div>
<div class="clearfix blank20"></div>

</div>


<!-- 属性设置 -->
<div role="tabpanel" class="tab-pane" id="tag3">

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">内容页模板</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('template',$form,$field,$data)}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="选择内容模板样式，可区别栏目设置的其他内容样式，以便拥有独立的外观！<br />默认为继承栏目模板设置！"></span>
</div>
</div>
<div class="clearfix blank20"></div>
    
<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">手机内容页模板</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('templatewap',$form,$field,$data)}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="选择内容模板样式，可区别栏目设置的其他内容样式，以便拥有独立的外观！<br />默认为继承栏目模板设置！"></span>
</div>
</div>
<div class="clearfix blank20"></div>
    
<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">内容绑定表单</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('showform',$form,$field,$data)}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="栏目下属内容页绑定表单！"></span>
</div>
</div>
<div class="clearfix blank20"></div>

    
<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">内容推荐位</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('attr1',$form,$field,$data)}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="勾选不同内容推荐位后，结合内容标签中的推荐位，可区分调用不同内容！"></span>
</div>
</div>
<div class="clearfix blank20"></div>


<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">价格</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('attr2',$form,$field,$data)}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="请填写大于0的数字型字符！"></span>
</div>
</div>
<div class="clearfix blank20"></div>


<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">链接跳转到</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('linkto',$form,$field,$data)}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="填写后，点击标题后，将连接到链接地址！"></span>
</div>
</div>
<div class="clearfix blank20"></div>


<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">内容的评级</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('grade',$form,$field,$data)}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="对内容进行评级，将以五角星显示级别！"></span>
</div>
</div>
<div class="clearfix blank20"></div>


<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">防伪码</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('isecoding',$form,$field,$data)}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="此篇文章是否开启防伪码！"></span>
</div>
</div>
<div class="clearfix blank20"></div>




</div>


<!-- 扩展信息 -->
<div role="tabpanel" class="tab-pane" id="tag4">

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">缩略图</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('thumb',$form,$field,$data)}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="缩略图用于图片列表页显示！"></span>
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"></div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<div class="alert alert-warning alert-danger" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
<span class="glyphicon glyphicon-warning-sign"></span>	<strong>内容页多图</strong> 	[	仅在show_products.html 和 show_pic.html 内容页模板中展示！]	
</div>
</div>
</div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">内容页多图</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">

<div id=uploadarea>
<div id="pvpics">
<?php
$ic=0;if(is_array($data['pics'])){foreach($data['pics'] as $k => $v){
//if(preg_match('/^pics([\d]+)$/',$k,$out) && $v){
$ic++;
if(!isset($v['url'])) continue;
?>
<div id="pics{$ic}_up" style="clear:both;">
<span id="pics{$ic}_preview"><img width="150" style="width:150px;" src="{$v['url']}" border="0" /></span>
<div class="blank10"></div>
<div class="row">
<div class="col-xs-8 col-sm-8 col-md-9 col-lg-10 text-right">
<input id="pics{$ic}" value="{$v['url']}" class="form-control" name="pics[{$ic}][url]" /></div>
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-left">
<input style="float:left;" id="pics{$ic}_del" onclick="pics_delete('{$ic}','pics');" value="删除" type="button" name="delbutton" class="btn btn-primary" />
</div>
</div>
<div class="blank10"></div>
<div class="row">
<div class="col-xs-8 col-sm-8 col-md-9 col-lg-10 text-right"><input id="pics{$ic}alt" value="{$v['alt']}" class="form-control" name="pics[{$ic}][alt]" /></div>
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-left">
文字说明
</div>
</div>
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="内页多图图片文字说明！"></span>
<div class="blank20"></div>
</div>
<?php 
}
}?>
</div>
<input type="hidden" name="ic" id="ic" value="{$ic}" />
<div class="blank10"></div>
<a title="选择文件" onclick="javascript:windowsdig('选择文件','iframe:index.php?case=file&act=updialog&fileinputid=pics&getbyid=pvpics&max=99&checkfrom=piclistshow','900px','480px','iframe')" href="#body"><p><img src="images/admin/add_pic.gif" width="150" /></p></a>
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="当内容页模板选择：<br /> [ 图片内容页 - archive/show_pic.html ] <br />用于图片幻灯显示效果展示！"></span>
</div>


</div>
</div>
<div class="clearfix blank20"></div>



<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">附件</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<span id="file_info" style="color:red"></span><br>
附件路径：<input type="text" name="attachment_path" class="form-control"  id="attachment_path" value="{$data['attachment_path']}" />
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="填写此项无须再上传附件，请填写完整的url地址，例如：http://www.cmseasy.cn/upload/attachment.rar！"></span>
<div class="blank10"></div>

<input type="hidden" name="attachment_id"  id="attachment_id" value="{=archive_attachment(@$data['aid'],'id')}"  class="form-control" />
附件名称：<input type="text" name="attachment_intro"  id="attachment_intro" value="{=archive_attachment(@$data['aid'],'intro')}" class="form-control" />
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="填附件的下载提示名称！"></span>

<div class="blank10"></div>
保存地址：<span id="attachment_path_i">{=archive_attachment(@$data['aid'],'path')}</span>
<input class="btn btn-primary" value="删除" type="button" name="delbutton"  onclick="attachment_delect(get('attachment_id').value)" />
<div class="blank10"></div>
<?php if (front::$act == 'edit' && $data['attachment_id']) { ?>
更改：<?php } ?>
<input type="file" name="fileupload" id="fileupload" style="width:400px" />
<div class="blank30"></div>

<input type="button"  name="filebuttonUpload"  id="filebuttonUpload" onclick="return ajaxFileUpload('fileupload','{url("tool/uploadfile",false)}','#uploading');" value="上传" class="btn btn-primary" />
<img id="uploading" src="{$base_url}/common/js/loading.gif" style="display:none;">

</div>
</div>
<div class="clearfix blank20"></div>





<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"></div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<div class="alert alert-warning alert-danger" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
<span class="glyphicon glyphicon-warning-sign"></span>	<strong>内容投票</strong> 	[	可在内容页显示对该内容投票结果！]
</div>
</div>
</div>
<div class="clearfix blank10"></div>


<?php for ($i=1; $i <= 8; $i++) { ?>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">投票标题</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">

{form::input("vote[$i]",vote::title(@$data['aid'],$i),'class="form-control" ')}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="填写内容中投票内容名称！"></span>
</div>
</div>
<div class="clearfix blank20"></div>


<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">图片url</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::input("vote_image[$i]",vote::img(@$data['aid'],$i),'class="form-control" ')}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="填写内容中投票内容图片地址！"></span>
</div>
</div>
<div class="clearfix blank20"></div>

<?php } ?>



</div>




<!-- 权限设置 -->

<div role="tabpanel" class="tab-pane" id="tag5">


<div class="table-responsive">
<table class="table table-hover">
<thead>
<tr class="th">
<th align="center" width="38%">会员组</th>
<th align="center"  width="30%">浏览</th>
<th align="center"  width="30%">下载</th>
</tr>
{loop usergroup::getInstance()->group $group}
<?php if ($group['groupid'] == '888') continue; ?>
<tr>
<td align="center">{$group.name}</td>
<td align="center">{form::checkbox("_ranks[".$group['groupid']."][view]",-1, @$data['_ranks'][$group['groupid']]['view'])}</td>
<td align="center">{form::checkbox("_ranks[".$group['groupid']."][down]",-1, @$data['_ranks'][$group['groupid']]['down'])}</td>
</tr>
{/loop}
</table>
</div>

<div class="blank30"></div>

<div class="alert alert-warning alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <span class="glyphicon glyphicon-warning-sign"></span>	 勾选为该用户组禁止浏览或下载
</div>


</div>

<!-- 自定义字段 -->

<div role="tabpanel" class="tab-pane" id="tag6">



<div id="con_one_6">

{loop $field $f}
<?php
$name=$f['name'];
if (!preg_match('/^my_/', $name)) {
    unset($field[$name]);
    continue;
}
$category = category::getInstance();
$sonids = $category->sons(setting::$var['archive'][$name]['catid']);
if(setting::$var['archive'][$name]['catid'] != $data['catid'] && !in_array($data['catid'],$sonids) && (setting::$var['archive'][$name]['catid'])){
	unset($field[$name]);
    continue;
}
if (!isset($data[$name]))
    $data[$name]='';
?>
<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"><?php echo setting::$var['archive'][$name]['cname']; ?></div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left" id="con_one_6"><?php echo form::getform($name,$form, $field, $data); ?></div>
</div>
<div class="clearfix blank20"></div>
{/loop}



</div>
</div>


{if front::get('catid')}<script type="text/javascript">get_field({front::get('catid')});</script>{/if}</div>
<input type="submit" name="submit" value=" 提交 " class="btn btn-primary" />

</form>