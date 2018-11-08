<script type="text/javascript" src="{$base_url}/common/swfupload/swfupload.js"></script>
<script type="text/javascript" src="{$base_url}/common/swfupload/swfupload.queue.js"></script>
<script type="text/javascript" src="{$base_url}/common/swfupload/fileprogress.js"></script>
<script type="text/javascript" src="{$base_url}/common/swfupload/system_handlers.js"></script>
<script type="text/javascript">
var base_url = '{config::get('site_url')}';
</script>
<div class="tags" style="margin-bottom:20px;">
<form method="post" name="form1" action="<?php if(front::$act=='edit') $id="/id/".$data[$primary_key]; else $id=''; echo modify("/act/".front::$act."/table/".$table.$id);?>"  onsubmit="return checkform();">
<input type="hidden" name="wid" id="wid" value="<?php echo intval(front::get('wid'));?>" />
<input type="hidden" name="pid" id="pid" value="<?php echo intval(front::get('pid'));?>" />
  <div id="tagscontent" class="right_box">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="table1">
      <tr class="s_out" >
        <td width="19%" align="right">类型</td>
        <td width="1%">&nbsp;</td>
        <td width="70%" id="caidanbox"><select name="typeid" id="typeid" onchange="changetype()" class="select">
          <option value="3" {if $data['typeid']==3}selected{/if}>文字回复</option>
          <option value="4" {if $data['typeid']==4}selected{/if}>图文回复</option>
          <option value="5" {if $data['typeid']==5}selected{/if}>网站内容推送</option>
        </select>
		<div class="caidantype_3" style="display:{if $data['typeid']!=3 && $data['typeid']}none{/if};">
		<dl>
			
			<dd><div class="blank10"></div>
				<textarea name="txt" class="textarea gens nonull" value="{$data['txt']}" onfocus="if(this.value=='请填写回复内容！') {this.value=''}" onblur="if(this.value=='') this.value='请填写回复内容！'">{$data['txt']}</textarea><span class="hotspot" onmouseover="tooltip.show('微信能够识别电话号码，支持点击电话号码直接拨打！');" onmouseout="tooltip.hide();"><img src="{$base_url}/images/admin/remind.gif" alt="" width="14" height="20" style="margin-left:10px; margin-right:5px; /"></span>
				
			</dd>
		</dl>
		</div>
		<div class="caidantype_5" style="display:{if $data['typeid']!=5}none{/if}">
		<dl>
			<dt><div class="blank10"></div></dt>
			<dd>
			
		<select name="catid" id="catid" class="select">
        <?php
			$option = array(0=>'所有栏目');
			$catids = category::option(0,'tolast',$option);
			if (is_array($catids) && !empty($catids)){
            foreach ($catids as $catid=>$catname){
			?>
            <option {if $data['catid']==$catid}selected{/if} value="{$catid}">{$catname}</option>
		<?php
		}
			}
			?>
		</select>
			</dd>
		</dl>
		<dl>
			<div class="blank10"></div>
			<dd>
				<input name='num' type='text' value='{$data['num']}' class="form-control" onfocus="if(this.value=='填写推送内容条数，最多10条！') {this.value=''}" onblur="if(this.value=='') this.value='填写推送内容条数，最多10条！'" /><span class="hotspot" onmouseover="tooltip.show('填写推送内容条数，最多10条！');" onmouseout="tooltip.hide();"><img src="{$base_url}/images/admin/remind.gif" alt="" width="14" height="20" style="margin-left:10px; margin-right:5px; /"></span>
			</dd>
		</dl>
		</div>
        
        <?php
        $tmparr = explode('|',$data['imgtext']);
		$i = 1;
		if(is_array($tmparr) && !empty($tmparr)){
			foreach($tmparr as $str){
				$tmp = explode('*',$str);
		?>
		<div id="tuwen{$i}" class="caidantype_4" style="display:{if $data['typeid']!=4}none{/if}">
			<div class="blank30"></div>
			<h3 class="" sliding="1">图文内容[{$i}]</h3>
			<dl>
					<div class="blank10"></div>
				<dd style='position:relative;'>
                  <script type="text/javascript">
                 $(function(){
					var swfu_{$i};
					var settings_{$i} = {
						callback_data_des: 'pic{$i}',
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
						button_placeholder_id: "spanButtonPlaceHolder_{$i}",
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
					swfu_{$i} = new SWFUpload(settings_{$i});
							 });
                </script>
<div class="img_upload">
                <input type="text" name="pic[]" id="pic{$i}"  class="form-control"  value='{$tmp[2]}' class="form-control" onfocus="if(this.value=='请填写图片调用地址') {this.value=''}" onblur="if(this.value=='') this.value='请填写图片调用地址'" /><a href='javascript:deletdisplayimg({$i});' class='displayimg_del'><img src="{$skin_path}/images/no.gif" width="12" height="12" style="margin:2px 20px 0px 10px;" /></a><span class="hotspot" onmouseover="tooltip.show('填写图片调用地址！');" onmouseout="tooltip.hide();"><img src="{$base_url}/images/admin/remind.gif" alt="" width="14" height="20" style="margin: -3px 5px 0px 0px; /"></span>
                <span style="float:left;" id="spanButtonPlaceHolder_{$i}"></span>
                <input id="btnCancel{$i}" type="button" value="取消" disabled="disabled" style="display:none;" />
</div>
           
           		
				</dd>
			</dl>
            <div style="clear:both;"></div>
			<dl>
				<div class="blank10"></div>
				<dd style='position:relative;'>
					<input name='twname[]' type='text'  class="form-control"  value='{$tmp[0]}' class="form-control" onfocus="if(this.value=='请填写内容标题！') {this.value=''}" onblur="if(this.value=='') this.value='请填写内容标题！'" /><span class="hotspot" onmouseover="tooltip.show('填写内容标题！');" onmouseout="tooltip.hide();"><img src="{$base_url}/images/admin/remind.gif" alt="" width="14" height="20" style="margin-left:10px; margin-right:5px; /"></span>
				</dd>
			</dl>
			<dl>
				<div class="blank10"></div>
				<dd style='position:relative;'>
				<input name='twurl[]' type='text' value='{$tmp[1]}'  class="text nonull input" onfocus="if(this.value=='请填写内容链接地址！地址！') {this.value=''}" onblur="if(this.value=='') this.value='请填写内容链接地址！地址！'" /><span class="hotspot" onmouseover="tooltip.show('填写内容链接！');" onmouseout="tooltip.hide();"><img src="{$base_url}/images/admin/remind.gif" alt="" width="14" height="20" style="margin-left:10px; margin-right:5px; /"></span>
				</dd>
			</dl>
            <?php
			if($i == 1){
			?>
			<dl>
				<div class="blank10"></div>
				<dd style='position:relative;'>
					<textarea name="intro" class="textarea"  value="{$data['intro']}" onfocus="if(this.value=='请填写描述内容') {this.value=''}" onblur="if(this.value=='') this.value='请填写描述内容'">{$data['intro']}</textarea><span class="hotspot" onmouseover="tooltip.show('多图文内容展示时候，将不会显示描述内容！');" onmouseout="tooltip.hide();"><img src="{$base_url}/images/admin/remind.gif" alt="" width="14" height="20" style="margin-left:10px; margin-right:5px; /"></span>
				</dd>
			</dl>
            <?php
			}
			?>
		</div>
        <?php
		$i++;
        }
		}
		?>
        <div id="moreimg"></div>
		<div class="caidantype_4" style="display:{if $data['typeid']!=4}none{/if}">
			<dl>
				<dt><div class="blank10"></div>
				</dt>
				<dd>
				<a href="javascript:void();" onclick="return weixin_adddisplayimg();">添加图文内容</a>
				<span id="loadtxt"></span>
				<span class='tips'>&nbsp;&nbsp;&nbsp;最多添加8个图文内容</span>
				</dd>
			</dl>
		</div>
        
		</td>
      </tr>
    </table>
</div>

    <input type="submit" name="submit" value="提交" class="btn btn-primary" />
 
</form>
</div>
<script type="text/javascript">
var num = <?php echo count($tmparr)?count($tmparr):1;?>;
function weixin_adddisplayimg(){
	var i=0;
	$("input[name*='displayimg']").each(function(){
		i++;
	});
	if(i>7){
		alert('&nbsp;&nbsp;最多添加8个图文内容');
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