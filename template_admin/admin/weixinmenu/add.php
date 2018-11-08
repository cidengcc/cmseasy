<script type="text/javascript" src="{$base_url}/common/swfupload/swfupload.js"></script>
<script type="text/javascript" src="{$base_url}/common/swfupload/swfupload.queue.js"></script>
<script type="text/javascript" src="{$base_url}/common/swfupload/fileprogress.js"></script>
<script type="text/javascript" src="{$base_url}/common/swfupload/system_handlers.js"></script>
<script type="text/javascript">
var base_url = '{config::get('site_url')}';
</script>

<form method="post" name="form1" action="<?php if(front::$act=='edit') $id="/id/".$data[$primary_key]; else $id=''; echo modify("/act/".front::$act."/table/".$table.$id);?>"  onsubmit="return checkform();">
<input type="hidden" name="wid" id="wid" value="<?php echo intval(front::get('wid'));?>" />
<input type="hidden" name="pid" id="pid" value="<?php echo intval(front::get('pid'));?>" />
 
<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">名称</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left"><input type="text" name="name" id="name" value="" class="form-control" />
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">排序</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left"><input type="text" name="sort" id="sort" value="" class="form-control" /></td>
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">类型</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<select name="typeid" id="typeid" onchange="changetype()" class="form-control select">
          {if !intval(front::$get['pid'])}
          <option value="1">菜单</option>
          {/if}
          <option value="2">打开网址</option>
          <option value="3">文字回复</option>
          <option value="4">图文回复</option>
          <option value="5">网站内容推送</option>
</select>
       
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="设置为菜单则可以用于添加二级菜单，点击此菜单将会展开二级菜单！"></span>
	

<div class="caidantype_3" style="display:none">
		<dl>
			
			<dd><div class="blank10"></div>
				<textarea name="txt" class="textarea gens nonull"  value="请填写回复内容" onfocus="if(this.value=='请填写回复内容') {this.value=''}" onblur="if(this.value=='') this.value='请填写回复内容'">请填写回复内容</textarea><span class="hotspot" onmouseover="tooltip.show('微信能够识别电话号码，支持点击电话号码直接拨打！');" onmouseout="tooltip.hide();"><img src="{$base_url}/images/admin/remind.gif" alt="" width="14" height="20" style="margin-left:10px; margin-right:5px; /"></span>

			</dd>
		</dl>
</div>

<div class="caidantype_5" style="display:none">
		<dl>
			
			<dd>
			<div class="blank10"></div>
		<select name="catid" id="catid" class="select">
        <?php
			$option = array(0=>'所有栏目');
			$catids = category::option(0,'tolast',$option);
			if (is_array($catids) && !empty($catids)){
            foreach ($catids as $catid=>$catname){
			?>
            <option value="{$catid}">{$catname}</option>
		<?php
		}
			}
			?>
		</select>
			</dd>
		</dl>
		<dl>

			<dd><div class="blank10"></div>
				<input name='num' type='text' value='填写推送内容条数，最多10条！' class="form-control" onfocus="if(this.value=='填写推送内容条数，最多10条！') {this.value=''}" onblur="if(this.value=='') this.value='填写推送内容条数，最多10条！'" /><span class="hotspot" onmouseover="tooltip.show('填写推送内容条数，最多10条！');" onmouseout="tooltip.hide();"><img src="{$base_url}/images/admin/remind.gif" alt="" width="14" height="20" style="margin-left:10px; margin-right:5px; /"></span>
			</dd>
		</dl>
</div>

<div name="imgtext" class="caidantype_4" style="display:none">

		<div class="blank30"></div>
			<h3 class="v52fmbx_hr metsliding" sliding="1">图文内容[1]</h3>
			<dl>
				
				<dd style='position:relative;'>
                  <script type="text/javascript">
                 $(function(){
					var swfu_1;
					var settings_1 = {
						callback_data_des: 'pic1',
						flash_url : "{$base_url}/common/swfupload/swfupload.swf",
						upload_url: "{url('tool/uploadimage2/site/'.front::get('site'),false)}",
						post_params: {"PHPSESSID" : "<?php echo session_id();?>"},
						file_size_limit : "{ini_get('upload_max_filesize')}B",
						file_types : "*.jpg;*.gif;*.png;*.bmp",
						file_types_description : "图片", //All Files
						file_upload_limit : 100,
						file_queue_limit : 0,
						custom_settings : {
			                progressTarget : "fsUploadProgress",
			                cancelButtonId : "btnCancel1"
			            },
						debug: false,
			
						// Button settings
						//button_image_url: "/cmseasy/common/swfupload/botton.png",
						button_width: "39",
						button_height: "18",
						button_placeholder_id: "spanButtonPlaceHolder_1",
						//button_text: '<span class="theFont">上传</span>',
						//button_text_style: ".theFont{float:left;display:block;color:#529fd0;font-size:14px;width:160px;height:40px;line-height:22px;font-weight:bold;}",
						//button_text_left_padding: 7,
						//button_text_top_padding: 5,
						button_disabled : false,
						button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
						button_cursor: SWFUpload.CURSOR.HAND,
			
						// The event handler functions are defined in handlers.js
						file_queued_handler : fileQueued,
						file_queue_error_handler : fileQueueError,
						file_dialog_complete_handler : fileDialogComplete,
						upload_start_handler : uploadStart,
						upload_progress_handler : uploadProgress,
						upload_error_handler : uploadError,
						upload_success_handler : uploadSuccess,
						upload_complete_handler : uploadComplete,
						queue_complete_handler : queueComplete	// Queue plugin event
					};
					swfu_1 = new SWFUpload(settings_1);
							 });
                </script>
<div class="img_upload">
<div class="blank10"></div>
                <input type="text" name="pic[]" id="pic1" class="form-control"  value='请填写图片调用地址' class="form-control" onfocus="if(this.value=='请填写图片调用地址') {this.value=''}" onblur="if(this.value=='') this.value='请填写图片调用地址'" /><span class="hotspot" onmouseover="tooltip.show('填写图片调用地址！');" onmouseout="tooltip.hide();"><img src="{$base_url}/images/admin/remind.gif" alt="" width="14" height="20" style="margin-left:10px; margin-right:5px; /"></span>
                <span style="float:left;" id="spanButtonPlaceHolder_1"></span>
                <input id="btnCancel1" type="button" value="取消" disabled="disabled" style="display:none;" />
</div>
           
           
				</dd>
			</dl>
            <div style="clear:both;"></div>
			<dl>
			<div class="blank10"></div>
				<dd style='position:relative;'>
					<input name='twname[]' type='text' class="form-control"  value='请填写内容标题' class="form-control" onfocus="if(this.value=='请填写内容标题') {this.value=''}" onblur="if(this.value=='') this.value='请填写内容标题'" /><span class="hotspot" onmouseover="tooltip.show('填写内容标题！');" onmouseout="tooltip.hide();"><img src="{$base_url}/images/admin/remind.gif" alt="" width="14" height="20" style="margin-left:10px; margin-right:5px; /"></span>
				</dd>
			</dl>
			<dl>
				<div class="blank10"></div>
				<dd style='position:relative;'>
				<input name='twurl[]' type='text' class='text nonull input'  class="form-control"  value='请填写内容链接' class="form-control" onfocus="if(this.value=='请填写内容链接') {this.value=''}" onblur="if(this.value=='') this.value='请填写内容链接'" /><span class="hotspot" onmouseover="tooltip.show('填写内容链接！');" onmouseout="tooltip.hide();"><img src="{$base_url}/images/admin/remind.gif" alt="" width="14" height="20" style="margin-left:10px; margin-right:5px; /"></span>
				</dd>
			</dl>
			<dl>
				<div class="blank10"></div>
				<dd style='position:relative;'>
					<textarea name="intro" class="textarea"  value="请填写描述内容" onfocus="if(this.value=='请填写描述内容') {this.value=''}" onblur="if(this.value=='') this.value='请填写描述内容'">请填写描述内容</textarea><span class="hotspot" onmouseover="tooltip.show('多图文内容展示时候，将不会显示描述内容！');" onmouseout="tooltip.hide();"><img src="{$base_url}/images/admin/remind.gif" alt="" width="14" height="20" style="margin-left:10px; margin-right:5px; /"></span>
					
				</dd>
			</dl>
            <div id="moreimg"></div>
</div>

<div class="v52fmbx_dlbox caidantype_4" style="display:none">
			<dl>
				<dt><div class="blank10"></div>
				</dt>
				<dd>
				<input href="javascript:void();" onclick="return weixin_adddisplayimg();" class="btn_b" value="添加图文内容" />
				<span id="loadtxt"></span>
				<span class='tips'>最多添加9个图文内容</span>
				</dd>
			</dl>
		</div>
        
		<div class="v52fmbx_dlbox caidantype_2" style="{if !intval(front::$get['pid'])}display:none{/if}">
		<dl>
			
			<dd>
			<div class="blank10"></div>
				<input class="text nonull input" name="url"  value="请填写链接地址" onfocus="if(this.value=='请填写链接地址') {this.value=''}" onblur="if(this.value=='') this.value='请填写链接地址'" /><span class="hotspot" onmouseover="tooltip.show('填写菜单点击后跳转地址，格式为http://地址/！');" onmouseout="tooltip.hide();"><img src="{$base_url}/images/admin/remind.gif" alt="" width="14" height="20" style="margin-left:10px; margin-right:5px; /"></span>
			</dd>
		</dl>
		</div>
</div>
</div>



<div class="blank30"></div>
<div class="line"></div>
<div class="blank30"></div>

<input type="submit" name="submit" value="提交" class="btn btn-primary" />

</form>
</div>
<script type="text/javascript">
var num = 1;
function weixin_adddisplayimg(){
	var i=0;
	$("input[name*='displayimg']").each(function(){
		i++;
	});
	if(i>7){
		alert('最多添加9个图文内容');
		return false;
	}
	return adddisplayimg();
}

function adddisplayimg() {
	$('#loadtxt').html('正在加载...');
	num++;
	$.ajax({
		url: '<?php echo url('weixinmenu/addtuwen');?>',
		type: "POST",
		data: 'num=' + num,
		success: function(data) {
			//alert(data);
			$('#moreimg').append(data);
			$('#loadtxt').html('');
		}
	});
	return false;
}

function deletdisplayimg(i){
	//alert($('#tuwen'+i));
	$('#tuwen'+i).remove();
	num--;
}

function changetype(){
	var type=$('#typeid').val();
	$("[class*=caidantype_]").hide();
	$(".caidantype_"+type).show();
}
</script>