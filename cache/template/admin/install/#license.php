<?php defined('ROOT') or exit('Can\'t Access !'); ?>
<style type="text/css">
#info {padding:10px; background:#eee;border:1px solid #CCC;line-height:200%;}
.go {background:url(<?php echo $skin_path;?>/images/go_1.gif) center top no-repeat;}
.agreement {height:198px;overflow-y:auto; color:#555;}
.agreement strong {color:#000;}
</style>

<div id="info">
<div style="padding:10px 10px 10px 15px;background:white;">
<div class="agreement">
<div class="padding10">
<p style="font-size:14px;font-weight:bold;margin-bottom:10px;">嗨，您好！欢迎使用	CmsEasy	易通企业网站系统。</p>
<p>在开始前，我们需要您数据库的一些信息，请准备好如下信息：</p>
<p><strong>数据库名</strong>、<strong>数据库用户名</strong>、<strong>数据库密码</strong>、<strong">数据库主机地址</strong>。</p>
<p>我们会使用这些信息来创建一个config.php文件。	如果自动创建未能成功，不用担心，您要做的只是将数据库信息填入配置文件。您也可以在文本编辑器中打开config文件夹中的config.php，填入您的信息，并将其另存为utf-8编码格式。</p>
<p>以上信息您的网站空间服务提供商会给您这些信息。如果您没有这些信息，在继续之前您将需要联系他们。</p>
<p>如果您准备好了，可以勾选同意软件许可协议后，点击安装按钮开始安装。</p>

</div>
</div>
</div>
<div class="clear"></div>
</div>
<div class="blank20"></div>
<center><input type="checkbox" value="1" id="readpact" name="license_pass"  checked><label for="readpact">&nbsp;&nbsp;<a style="color:#0066cc;font-weight:bold;" href="http://www.cmseasy.cn/service/" target="_blank" title="查看许可协议">我已经阅读并同意此协议</a></label>


<input class="btn btn_a" style="margin-left:20px;" type="button" onclick="if(!document.getElementById('readpact').checked) {alert('您必须同意软件许可协议才能安装！'); return false;}else{window.location.href='<?php echo url('install/index/step/1',true); ?>';}" value="开始安装" />
</center>
<div class="blank10"></div>
