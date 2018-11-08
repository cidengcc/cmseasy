<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>图片库</title>
<link href="js/upimg/dialog.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="js/upimg/jquery.js"></script>
<script type="text/javascript" src="js/upimg/dialog.js"></script>
<script type="text/javascript" language="JavaScript">
	var filemanage_filecheck_select_allno = "相册选择为空，请重新选择";
	var filemanage_filecheck_select_max = "抱歉：选择失败，已超过当前允许选择的最大数量！";
	var filemanage_js_album_select_err = "抱歉：未选择相关文件，请返回重新选择！";
	var fheight="405";
	var loadurl="index.php?case=file&act=piclist";
	$(document).ready(function(){
		var h = parseInt(fheight);
		$('#mainbodybottonauto').css({height:h-39});
		$("#fileloading").ajaxStart(function(){
			$(this).show();
		}).ajaxStop(function() {
			$(this).hide();
		});
	})

	function refile(){

		var albumlist=$('input:[name="albumlist"]').val();
		var albumiswidthlist=$('input:[name="albumiswidthlist"]').val();
		if(albumlist){
			filename=albumlist.substring(0,albumlist.length-1);
			iswidtharray=albumiswidthlist.substring(0,albumiswidthlist.length-1);
			parent.refile(filename,iswidtharray);
		}else{
			alert(filemanage_js_album_select_err);
			return false;
		}
	}

	function picload(amid,page){
		if (amid=='0') {
			$('#albumlist').html(filemanage_filecheck_select_allno);
			return false;
		}
		var loadingurl=loadurl + '&amid=' + amid + '&page=' + page + '&freshid=' + Math.random();
		$.get(loadingurl, function(data){
			$('#albumlist').html(data);
			var albumidlist=$('input:[name="albumidlist"]').val();
			if (albumidlist){

				var albumlist=$('input:[name="albumlist"]').val();

				var albumiswidthlist=$('input:[name="albumiswidthlist"]').val();
				var albumidarray = albumidlist.split('|');
				var albumarray = albumlist.split('|');
				var albumiswidtharray = albumiswidthlist.split('|');
				var gidstr=null;
				var htmlse=null;
				var htmlvol=null;
				for (var i = 0; i < albumidarray.length; i++){

					if (albumidarray[i]){

						gidstr="#"+albumidarray[i]+" .panel_checkbox";

						htmlvol=$("#"+albumidarray[i]).html();

						htmlse="<li id=\""+albumidarray[i]+"\" onclick=\"alselected('"+albumidarray[i]+"','"+albumarray[i]+"','undefined',"+albumiswidtharray[i]+");\">"+htmlvol+"</li>";
						$(htmlse).replaceAll("#"+albumidarray[i]);
						$(gidstr).show();
					}
				}
			}
		});
	}

	function alselected(gid,imgpath,setype,iswidth){
		var gidstr="#"+gid+" .panel_checkbox";

		var maxs=$('input:[name="max"]').val();

		var albumlist=$('input:[name="albumlist"]').val();

		var albumidlist=$('input:[name="albumidlist"]').val();

		var albumiswidthlist=$('input:[name="albumiswidthlist"]').val();

		var htmlvol=$("#"+gid).html();
		if (setype=='selected'){

			if (maxs<1){
				alert(filemanage_filecheck_select_max);
				return false;
			}

			var htmlse="<li id=\""+gid+"\" onclick=\"alselected('"+gid+"','"+imgpath+"','undefined',"+iswidth+");\">"+htmlvol+"</li>";
			$(htmlse).replaceAll("#"+gid);
			$(gidstr).show();

			var nowid=Number(maxs)-1;
			$('input:[name="max"]').val(nowid);

			var albumlist=albumlist+imgpath+'|';
			$('input:[name="albumlist"]').val(albumlist);

			var albumidlist=albumidlist+gid+'|';
			$('input:[name="albumidlist"]').val(albumidlist);

			var albumiswidthlist=albumiswidthlist+iswidth+'|';
			$('input:[name="albumiswidthlist"]').val(albumiswidthlist);

		}else{

			var htmlse="<li id=\""+gid+"\" onclick=\"alselected('"+gid+"','"+imgpath+"','selected',"+iswidth+");\">"+htmlvol+"</li>";
			$(htmlse).replaceAll("#"+gid);
			$(gidstr).hide();

			var maxnowid=Number(maxs)+1;
			$('input:[name="max"]').val(maxnowid);

			var albumlist=albumlist.replace(imgpath+"|","");
			$('input:[name="albumlist"]').val(albumlist);

			var albumidlist=albumidlist.replace(gid+"|","");
			$('input:[name="albumidlist"]').val(albumidlist);

			var albumiswidthlist=albumiswidthlist.replace(iswidth+"|","");
			$('input:[name="albumiswidthlist"]').val(albumiswidthlist);
		}
	}
</script>
</head>

<body>
<input type="hidden" name="max" value="{front::get('max')}"/>
<input type="hidden" name="albumlist" value=""/>
<input type="hidden" name="albumidlist" value=""/>
<input type="hidden" name="albumiswidthlist" value=""/>
<div id="select" class="windowselecttop">
	<span id="amidlist">
	图库列表：<select size="1" name="amid" id="amid"  onchange="picload(this.value,1)">
		<option value="0">请选择图库</option>
                     <?php foreach($image_dir as $k => $v) { ?>
  <option value="<?php echo $v;?>"><?php echo $v;?></option>
  <?php } ?>
			</select>

	</span>
	<span id="fileloading" class="fileloading">相册正在加载中...</span>
</div>
<div id="mainbodybottonauto" class="managebottonadd">
	<div class="albumlist" id="albumlist">请从上面的下拉菜单里选择已有的目录<br/>
		如您的目录还没有文件，建议先到"上传文件"栏目下，上传文件后再使用该功能<br/>
		提示：单击图片选中，可选择不同目录、多张图片。<br/></div>
</div>
<div id="downbotton">
	<div id="subbotton">
		<table border="0" width="100%">
			<tr id="bottonsubmit">
				<td id="center">
					<table border="0" style="margin: 0 auto;">
						<tr >
							<td><input type="submit" name="Submit" id="submitbotton" onclick="javascript:refile();" value="确认添加" class="buttonface" title="确认添加"/>&nbsp;&nbsp;</td>
							
							<td>&nbsp;&nbsp;<input type="reset" name="reset" onClick="javascript:parent.resetwindow();" id="release" value="返回编辑窗口" class="buttonface2"  title="返回编辑窗口" /></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</div>
</div>
<!-- Powered by <a href="http://www.cmseasy.cn" title="CmsEasy企业网站系统" target="_blank">CmsEasy</a> -->
</body>
</html>