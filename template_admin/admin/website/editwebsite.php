
<form method="post" name="form1" action="<?php if(front::$act=='edit') $id="/id/".$data[$primary_key]; else $id=''; echo modify("/act/".front::$act."/table/".$table.$id);?>"  onsubmit="return checkform();">

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">站点名称</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<input type="text" name="name" id="name" value="{$data['website']['name']}" class="form-control" /> <span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="请填写站点的名称，例如：“香港网站”"></span>
</div>
</div>
<div class="clearfix blank30"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">配置文件</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<input type="text" name="path" id="path" value="{front::get('id')}" class="form-control" /> <span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="请填写站点的配置文件名称，例如：'hk"></span>
</div>
</div>
<div class="clearfix blank30"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">站点URL</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<input type="text" name="site_url" id="site_url" value="{$data['site_url']}" class="form-control" /> <span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="请填写站点的完整URL，结尾必须有“/”，例如：;http://hk.cmseasy.com/"></span>
</div>
</div>
<div class="clearfix blank30"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">站点用户名</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<input type="text" name="site_username" id="site_username" value="{$data[site_username]}" class="form-control" /> <span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="站点用户名"></span>
</div>
</div>
<div class="clearfix blank30"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">站点密码</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<input type="password" name="site_password" id="site_password" value="{$data['site_password']}" class="form-control" /> 
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="站点密码"></span>
</div>
</div>
<div class="clearfix blank30"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">站点后台目录</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<input type="text" name="site_admindir" id="site_admindir" value="{$data['site_admindir']}" class="form-control" /> 
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="站点后台目录 例如:admin"></span>
</div>
</div>
<div class="clearfix blank30"></div>

<!--<div class="blank10"></div>
<div style="width:100%; height:1px; border-bottom:1px solid #D9E6F4"></div>
<div class="blank10"></div>

<div class="hid_box">
<strong>数据库服务器：</strong>
<div class="hbox" style="background:none;">
<input type="text" name="hostname" id="hostname" value="{$data['database'][hostname]}" class="form-control" /> <span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="请填写站点的数据库主机，例如："192.168.0.88"</span> <br /><br />
</div>
</div>

<div class="hid_box">
<strong>数据库用户：</strong>
<div class="hbox" style="background:none;">
<input type="text" name="user" id="user" value="{$data['database'][user]}" class="form-control" /> <span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="请填写站点的数据库用户，例如："root"</span><br /><br />
</div>
</div>

<div class="hid_box">
<strong>数据库密码：</strong>
<div class="hbox" style="background:none;">
<input type="text" name="password" id="password" value="{$data['database'][password]}" class="form-control" /> <span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="请填写站点的数据库密码，例如："123456"</span><br /><br />
</div>
</div>

<div class="hid_box">
<strong>数据库名称：</strong>
<div class="hbox" style="background:none;">
<input type="text" name="database" id="database" value="{$data['database'][database]}" class="form-control" /> <span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="请填写站点的数据库名称，例如："hkcmseasy"</span><br /><br />
</div>
</div>

<div class="hid_box">
<strong>数据库表前缀：</strong>
<div class="hbox" style="background:none;">
<input type="text" name="prefix" id="prefix" value="{$data['database'][prefix]}" class="form-control" /> <span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="请填写站点的数据库表前缀，例如："cmseasy_"</span><br /><br />
</div>
</div>
<input type="button" class="button" value="检查数据库" onclick="checkmysql()" /><span id="checkloading" style="display:none"><font color="blue">	检查中...	</font></span><span id="returnmessage"></span>

<div class="blank10"></div>
<div style="width:100%; height:1px; border-bottom:1px solid #D9E6F4"></div>
<div class="blank10"></div>


<div class="hid_box">
<strong>FTP IP地址：</strong>
<div class="hbox" style="background:none;">
<input type="text" name="ftpip" id="ftpip" value="{$data['website'][ftpip]}" class="form-control" /> <span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="请填写站点的FTP ip地址，例如："192.168.0.88"</span><br /><br />
</div>
</div>

<div class="hid_box">
<strong>FTP 端口：</strong>
<div class="hbox" style="background:none;">
<input type="text" name="ftpport" id="ftpport" value="{$data['website'][ftpport]}" class="form-control" /> <span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="请填写站点的FTP端口，例如："21"</span><br /><br />
</div>
</div>

<div class="hid_box">
<strong>FTP 用户名称：</strong>
<div class="hbox" style="background:none;">
<input type="text" name="ftpuser" id="ftpuser" value="{$data['website'][ftpuser]}" class="form-control" /> <span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="请填写站点的FTP用户，例如："hkftp"</span><br /><br />
</div>
</div>

<div class="hid_box">
<strong>FTP 用户密码：</strong>
<div class="hbox" style="background:none;">
<input type="text" name="ftppwd" id="ftppwd" value="{$data['website'][ftppwd]}" class="form-control" /> <span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="请填写站点的FTP登陆密码，例如："123456"</span><br /><br />
</div>
</div>

<div class="hid_box">
<strong>FTP 文件目录：</strong>
<div class="hbox" style="background:none;">
<input type="text" name="ftppath" id="ftppath" value="{$data['website'][ftppath]}" class="form-control" /> <span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="请填写站点的FTP根目录，例如："/"</span><br /><br />
</div>
</div>
<input type="button" value="检查FTP" class="button" onclick="checkftp()" />
<span id="checkftploading" style="display:none"><font color="blue">检查中...</font></span><span id="returnftpmessage"></span>	-->	

<div class="blank10"></div>

</div>
<div class="blank30"></div>

    <input type="submit" name="submit" value="提交" class="btn btn-primary" />
    </form>
  
   <div class="blank10"></div>
<script type="text/javascript">
function checkmysql(){
	$('#checkloading').show();
	var host = $("#hostname").val();
	var user = $("#user").val();
	var pwd = $("#password").val();
	$.ajax({
		url: '<?php echo url('website/checkmysql',true);?>',
		data:'host='+host+'&user='+user+'&pwd='+pwd+'&request='+Math.random()*5,
		type: 'GET',
		dataType: 'html',
		timeout: 30000,
		success: function(data){
			$('#checkloading').hide();
			$('#returnmessage').html(data);
		},
		error: function(data){
			$('#checkloading').hide();
			$('#returnmessage').html('请重试！');
		}		
	});
}
function checkftp(){
	$('#checkftploading').show();
	var ftpip = $("#ftpip").val();
	var ftpuser = $("#ftpuser").val();
	var ftppwd = $("#ftppwd").val();
	$.ajax({
		url: '<?php echo url('website/checkftp',true);?>',
		data:'ftpip='+ftpip+'&ftpuser='+ftpuser+'&ftppwd='+ftppwd+'&request='+Math.random()*5,
		type: 'GET',
		dataType: 'html',
		timeout: 30000,
		success: function(data){
			$('#checkftploading').hide();
			$('#returnftpmessage').html(data);
		},
		error: function(data){
			$('#returnftpmessage').html('请重试！');
		}		
	});
}
</script>