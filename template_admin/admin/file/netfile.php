<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>网络图片</title>
<link href="js/upimg/dialog.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="js/upimg/jquery.js"></script>
<script type="text/javascript" src="js/upimg/dialog.js"></script>
<script type="text/javascript" language="JavaScript">
	var filemanage_js_upfile_zoomsize  = "抱歉：图片尺寸无效或填写错误，请填写整数型";
	var filemanage_js_upfile_driname_err  = "抱歉：未填写文件网址，请返回重新选择！";
	var filemanage_js_upfile_ok = "恭喜：文件添加成功!";
	var filemanage_js_upfile_no = "抱歉：文件添加失败!";
	var fheight="405";
	$(window).load(function(){
		var h = parseInt(fheight);
		$('#mainbodybottonauto').css({height:h-39});
		var options = {
			beforeSubmit: formverify,
			success:saveResponse
		}
		$('#upfile').submit(function() {
			$(this).ajaxSubmit(options);
			return false;
		});
	});

	function formverify(formData, jqForm, options) {
		var queryString = $.param(formData);
		var get=urlarray(queryString);
		if(get['upfilepath']=='') {
			document.upfile.upfilepath.focus();
			alert(filemanage_js_upfile_driname_err);
			return false;
		}
	}

	function saveResponse(options){
		var inputstr='<td class="trtitle02" id="upfilepath"><input type="text" name="upfilepath" maxlength="200" size="50" class="infoInput"> 必须以http://开头</td>';
		$("#upfilepath").replaceWith(inputstr);

		var strarray = options.split('|');
		if (strarray[1]!=undefined){
			$("#resulttable").removeClass('displaynone');
			if (strarray[1]=='img'){
				if (strarray[2]=='1'){
					var upresult='<td class="trtitle02" id="upresult"><a onclick="javascript:refile(\''+strarray[0]+'\',\''+strarray[2]+'\',\''+strarray[3]+'\',\''+strarray[4]+'\',\''+strarray[5]+'\');" href="#body" hidefocus="true"><img src="'+ strarray[0] + '" width="100"></a></td>';	
				}else{
					var upresult='<td class="trtitle02" id="upresult"><a onclick="javascript:refile(\''+strarray[0]+'\',\''+strarray[2]+'\',\''+strarray[3]+'\',\''+strarray[4]+'\',\''+strarray[5]+'\');" href="#body" hidefocus="true"><img src="'+ strarray[0] + '" height="100"></a></td>';		
				}
				$("#upresult").replaceWith(upresult);
			}else{
				var upresult='<td class="trtitle02" id="upresult"><a class="lnglist" onclick="javascript:refile(\''+strarray[0]+'\',\''+strarray[2]+'\',\''+strarray[3]+'\',\''+strarray[4]+'\',\''+strarray[5]+'\');" href="#body" hidefocus="true">' + strarray[0] + '</a></td>';
				$("#upresult").replaceWith(upresult);
			}
			$("#title").val("");
			alert(filemanage_js_upfile_ok);
		}else{
			alert(strarray[0]);
		}
	}
	function refile(filename,iswidth,alt,width,height){
		parent.refile(filename,iswidth,alt,width,height);
	}
</script>
</head>

<body class="bodyflow">
<form name="upfile" id="upfile" method="post" action="index.php?case=file&act=netfilesave&admin_dir={get('admin_dir')}">
<div id="mainbodybottonauto" class="managebottonadd">
	<div class="maindobycontent">
		<div class="maneditcontent">
			<table class="formtablewin">
				<tr class="trstyle2">
					<td class="trtitle01">请填写网址</td>
					<td class="trtitle02" id="upfilepath"><input type="text" name="upfilepath" maxlength="200" size="50" class="infoInput">
				    必须以http://开头</td>
				</tr>
                 <tr class="trstyle2">
				  <td class="trtitle01">图片信息</td>
					<td class="trtitle02" id="upfilepath">说明
				    <input type="text" name="alt" id="alt" />
				    宽
				    <input name="width" type="text" id="width" size="10" />
				    高
				    <input name="height" type="text" id="height" size="10" /></td>
				</tr>
				<tr class="trstyle2">
					<td class="trtitle01"></td>
					<td class="trtitle02">允许的文件格式有jpg、png、gif；</td>
				</tr>
			</table>
			<table class="formtablewin displaynone" id="resulttable">
				<tr class="trstyle3">

					<td class="trtitle01">添加成功</td>
					<td class="trtitle02" id="upresult"><img src="images/pic.png" width="100px" height="100px"></td>
				</tr>
				<tr class="trstyle2">
					<td class="trtitle01"></td>
					<td class="trtitle02">提示：点击以上结果，选择该文件并关闭此窗口！</td>
				</tr>
			</table>

		</div>
	</div>
</div>
<div id="downbotton">
	<div id="subbotton">
		<table border="0" width="100%">
			<tr id="bottonsubmit">
				<td id="center">
					<table border="0" style="margin: 0 auto;">
						<tr >
							<td><input type="submit" name="Submit" id="submitbotton" value="确认添加文件" class="buttonface" title="确认添加文件"/>&nbsp;&nbsp;</td>
							
							<td>&nbsp;&nbsp;<input type="reset" name="reset" onClick="javascript:parent.resetwindow();" id="release" value="返回编辑窗口" class="buttonface2"  title="返回编辑窗口" /></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</div>
</div>
</form>
<!-- Powered by <a href="http://www.cmseasy.cn" title="CmsEasy企业网站系统" target="_blank">CmsEasy</a> -->
</body>
</html>