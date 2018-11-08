
<script type="text/javascript">
jQuery(function($){
	$("#demo_btn").click(function(){
		$("#demo_div").attr("src",
			"demo.php?pattern="+$("#ifocus_pattern").val()+"&width="+$("#ifocus_width").val()+"&height="+$("#ifocus_height").val()+
			"&number="+$("#ifocus_number").val()+"&time="+$("#ifocus_time").val());
	});
	$('#sms_manage').load('<?php echo url('sms/manage');?>');
});
var base_url = '{config::get('site_url')}';


</script>

    <script type="text/javascript" src="{$base_url}/common/js/ajaxfileupload.js"></script>
    <script type="text/javascript" src="{$base_url}/common/js/jquery.imgareaselect.min.js"></script>
    <script type="text/javascript" src="{$base_url}/common/js/ThumbAjaxFileUpload.js"></script>
	<script type="text/javascript" src="{$base_url}/js/upimg/dialog.js"></script>
    <link href="{$base_url}/images/admin/dialog.css" rel="stylesheet" type="text/css" />

<form method="post" action="<?php echo uri();?>" name="config_form">

 <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
  <?php $i=1;?>
      {loop $units $key $unit}
    <li role="presentation"{if $i==1} class="active"{/if}><a href="#tag{$i}" aria-controls="#tag{$i}" role="tab" data-toggle="tab">{$unit}</a></li>
	<?php $i++;?>
      {/loop}
  </ul>

<?php unset($i);?>

   <div class="tab-content">
     <?php $onei=1;?>
     {loop $units $key $unit}
     {if isset($items[$key])}
<div role="tabpanel" class="tab-pane{if $onei==1} active{/if}" id="tag{$onei}">

{loop $items[$key] $item}
<div class="row">

{if $item['name']=='sms_explain'}
<div style="padding:0px 20px;">
<div class="alert alert-danger" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
<span class="glyphicon glyphicon-warning-sign"></span>	注意</span> 
充值前请先&nbsp;&nbsp;<a href="http://pay.cmseasy.cn/reg.php" target="_blank" class="btn btn-steeblue">注册用户</a>&nbsp;&nbsp;！并将短信设置里面账户和密码修改为注册用户和密码！在&nbsp;&nbsp;<a href="#tag2" aria-controls="#tag2" role="tab" data-toggle="tab" class="btn btn-lightslategray">短信管理</a>&nbsp;&nbsp;内充值短信后方可正常使用！
</div>
</div>
<style>
#sms_explain {display:none;}
</style>

{elseif $item['name']=='urlrewrite_info'}



<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right"></div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<div class="alert alert-danger" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
<span class="glyphicon glyphicon-warning-sign"></span>	<strong>注意！</strong></span> 
如对伪静态不了解，请关闭！如必须开启需安装补丁&nbsp;&nbsp;<a class="btn btn-steeblue" href="https://www.cmseasy.cn/plus/show-275.html" target="_blank">下载补丁</a>
</div>
</div>
<style>
.alert {margin:0px;}
#urlrewrite_info {display:none;}
</style>

{elseif $item['name']=='sms_manage'}
<!-- 短信管理页面 -->
<div id="sms_manage">
</div>
<style>
input#sms_manage {display:none;}
</style>
<!-- 短信管理页面 -->
{else}
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">{$item.title}：</div>
{/if}

{if $item['name']=='mobilechk_explain'}
<div style="padding:0px 20px;">
<div class="alert alert-danger" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
<span class="glyphicon glyphicon-warning-sign"></span>	<strong>注意！</strong></span> 
开启手机验证码后，需同时配置&nbsp;&nbsp;<a class="btn btn-steeblue">短信设置</a>&nbsp;&nbsp;！且在&nbsp;&nbsp;<a href="#tag2" aria-controls="#tag2" role="tab" data-toggle="tab" class="btn btn-lightslategray">短信管理</a>&nbsp;&nbsp;内充值短信后方可正常使用！
</div>
</div>
<style>
#mobilechk_explain {display:none;}
</style>
{/if}

{if $item['name']=='ditu_explain'}
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">

<span class="glyphicon glyphicon-warning-sign"></span>	
使用说明：<br />
1、首先，点击	<a href="http://api.map.baidu.com/lbsapi/getpoint/index.html" class="btn btn-steeblue" target="_blank">&nbsp;按钮&nbsp;</a>	，获取地图数值；<br />
2、数据包含：当前层级、当前坐标点；<br />
3、坐标点逗号前为经度值；<br />
4、坐标点逗号后为纬度值；<br />
5、将经纬度值复制到后台中的经纬度输入框，提交即可。<br />
6、地图调用代码为 {&nbsp;template 'ditu.html'&nbsp;} ,复制后，请将里面空格删除 。
<style>
#ditu_explain {display:none;}
</style>
{/if}


{if $item['name']=='template_dir'}
<div class="col-xs-8 col-sm-8 col-md-9 col-lg-10 text-left">

<div id="template">
{loop $item['select'] $key2 $val}
<div class="template_box">
<div class="t_box">
<div class="img-wrap">
<a><img src="{$base_url}/template/{$key2}/skin/thumbnails.jpg" /></a>
</div>
</div>
{$val}<div class="blank10"></div>
<input name="template_dir_select[]" type="radio" value="{$key2}" {if get($item['name'])==$key2} checked="checked" {/if} onclick="this.form.template_dir.value=this.value" />&nbsp;选择&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo url('template/del/tplname/'.$val,1);?>" onClick="return confirm('确定要删除吗?')"><img src="{$skin_path}/images/no.gif" /></a>
</div>
{/loop}
<div class="blank10"></div>
</div>


{form::hidden($item['name'],get($item['name']))}

{elseif $item['name']=='template_mobile_dir'}
<div class="col-xs-8 col-sm-8 col-md-9 col-lg-10 text-left">
    <div id="template">
        {loop $mobiletpllist $key2 $val}
        <div class="template_box">
            <div class="t_box">
                <div class="img-wrap">
                    <a><img src="{$base_url}/template/{$key2}/skin/thumbnails.jpg" /></a>
                </div>
            </div>
            {$val}<div class="blank10"></div>
            <input name="template_mobile_dir" type="radio" value="{$key2}" {if get($item['name'])==$key2} checked="checked" {/if} />&nbsp;选择&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo url('template/del/tplname/'.$val,1);?>" onClick="return confirm('确定要删除吗?')"><img src="{$skin_path}/images/no.gif" /></a>
        </div>
        {/loop}
        <div class="blank10"></div>

    </div>

{elseif $item['name']=='admin_template_dir'}
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<div id="template" style="float:left;">
{form::select($item['name'],get($item['name']),$admintpllist,'class="select"')}

</div>
    {elseif $item['name']=='user_template_dir'}
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
    <div id="template" style="float:left;">
        {form::select($item['name'],get($item['name']),$usertpllist,'class="select"')}

    </div>
 
			  {else}
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
                {if isset($item['select']) && is_array($item['select'])}
                {form::select($item['name'],get($item['name']),$item['select'],'class="select"')}
                {elseif strlen(get($item['name']))>50}
                {form::textarea($item['name'],get($item['name']),' class="textarea"')}
                {elseif isset($item['image'])}
                {form::upload_image($item['name'],get($item['name']))}
                {else}
				{form::input($item['name'],get($item['name']))}
                {/if}




                {if $item['name']=='watermark_pos'}
                {template 'config/watermark_pos_select.php'}
                {/if}

           {/if}
    {if strlen($item['intro'])>1}{$item['intro']}{/if}


         


</div>
</div>
<div class="clearfix blank20"></div>
    {/loop}

	


    <?php $onei++;?>

   </div>

  {/loop}
  {/if}
  </div>
</div>
<div class="blank30"></div>
<div class="line"></div>
<div class="blank30"></div>
<input name="submit" type="submit" value="提交" class="btn btn-primary">
</form>