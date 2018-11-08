<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<title>易通CMS-免费企业建站程序-{if $pass}填写数据库信息{else}检测数据库链接{/if}</title>
<link rel="shortcut icon" href="{$base_url}/favicon.ico" type="image/x-icon" />
<!-- 调用样式表 -->
<script src="{$skin_path}/js/jquery.min.js"></script>
<link type="text/css" rel="stylesheet" media="all" href="{$skin_path}/css/install.css" />
</head>
<body>
<div id="header">
<div class="box">
<img src="{$skin_path}/images/logo.png" class="logo" />
</div>
<div class="top_right">
<ul>
<li><span>您好<strong>！</strong></li>
<li><a href="http://www.cmseasy.cn" target="_blank">官方网站</a> | <a href="http://www.cmseasy.cn/service_1.html" target="_blank">商业授权</a> | <a href="http://www.cmseasy.org" target="_blank">问题交流</a> | <a href="http://www.cmseasy.cn/chm/" target="_blank">在线教程？</a></li>
</ul>
</div>
</div>
<div id="nav">
欢迎使用 CmsEasy！
</div>
<div class="box">
<div class="blank10"></div>
<div class="blank30"></div>
<div class="go"></div>
<div class="blank30"></div>
<div class="blank10"></div>
<form name="form1" method="post" action="<?php echo uri();?>">
<?php  if(!get('step')) $this->render('install/license.php'); else { ?>
<input type="hidden" value="1" id="license_pass" name="license_pass"/>
<?php
  $pass=true;
  if(PHP_VERSION<5)    $pass=false;
   if(!$mysql_pass)  $pass=false;
   if(isset($adminerror))  $pass=false;
  ?>
 {if isset($install)}
<style type="text/css">
.go {background:url({$skin_path}/images/go_4.gif) center top no-repeat;}
</style>
<div class="result">
<h1>恭喜您，CmsEasy已经成功安装完成！</h1>
<h5>（基于安全考虑，请在安装后修改后台登陆目录名称！！！）</h5>
</div>
<div class="blank20"></div>
<center>
<input onclick="javascrtpt:window.location.href='{$base_url}/'" class="btn_b" style="margin-right:20px;" value=" 访问网站首页 " />
<input onclick="javascrtpt:window.location.href='{$base_url}/index.php?case=admin&act=login&admin_dir={get('admin_dir')}&site=default'" class="btn_a" value=" 登陆网站后台 " />
</center>
 {else}
<div class="table_box">
<table border="0"  cellspacing="1" cellpadding="4" id="table" width="100%">
<!--start-->
{if front::$get['step']==1}
<style type="text/css">
.go {background:url({$skin_path}/images/go_2.gif) center top no-repeat;}
</style>

 <thead>
 <tr bgcolor="Silver">
 <th>项目</th>
<th>推荐要求</th> <th>系统环境</th> <th>是否通过</th>
 </tr>
 <tr>
 <td>PHP版本</td>
<td>5.2以上</td>
<td><?php echo PHP_VERSION; ?></td>
<td align="center"><?php echo helper::yes(PHP_VERSION>=5.0); ?></td>
 </tr>
  <tr>
 <td>MySQL版本</td>
<td>5.0以上</td>
<td>{=@$mysql_verion}</td>
<td align="center"></td>
 </tr>
 </thead>

 <tbody>
  <tr>
 <th>目录</th><th colspan="4">可写</th>
 </tr>
 <tr>
 <td><?php echo 'cache';?></td> <td colspan="4"><?php echo helper::yes(front::file_mode_info(ROOT.'/cache')>=2);  ?></td>
 </tr>
 <tr>
 <td><?php echo 'config';?></td> <td colspan="4"><?php echo helper::yes(front::file_mode_info(ROOT.'/config')>=2);  ?></td>
 </tr><tr>
 <td><?php echo 'config/config.php';?></td> <td colspan="4"><?php echo helper::yes(front::file_mode_info(ROOT.'/config/config.php')>=2);  ?></td>
 </tr>
<tr>
 <td><?php echo 'data';?></td> <td colspan="4"><?php echo helper::yes(front::file_mode_info(ROOT.'/data')>=2);  ?></td>
 </tr>
<tr>
 <td><?php echo 'install';?></td> <td colspan="4"><?php echo helper::yes(front::file_mode_info(ROOT.'/install')>=2);  ?></td>
 </tr>
 <tr>
 <td><?php echo 'template';?></td> <td colspan="4"><?php echo helper::yes(front::file_mode_info(ROOT.'/template')>=2);  ?></td>
 </tr>
 <tr>
 <td><?php echo 'upload';?></td> <td colspan="4"><?php echo helper::yes(front::file_mode_info(ROOT.'/upload')>=2);  ?></td>
 </tr>
 </tbody>
 </table>

 <div class="blank20"></div>

<center>
<input type="button" onclick="window.location.href='<?php echo url('install/index',true);?>';"  class="btn_b" value=" 上一步 " style="margin-right:20px;" />
<input type="button" onclick="window.location.href='<?php echo url('install/index/step/2',true);?>';"  class="btn_a" value=" 下一步 " />
</center>
 {elseif front::$get['step']==2}
  {if isset($connerror)}
 <script>alert('<?php echo addslashes($connerror);?>');</script>
{/if}
 {if isset($dberror)}
 <script>alert('指定数据库不存在！如果确定使用指定数据库，请勾选 “新建数据库”! ');</script>
{/if}
<style type="text/css">
.go {background:url({$skin_path}/images/go_3.gif) center top no-repeat;}
</style>
<tbody>
 <tr>
 <th colspan="5"><strong>MySQL设置</strong></th>
 </tr>

 <tr>
 <td class="left">数据库地址</td><td colspan="4"><?php echo form::input('hostname',/*get('hostname') ? get('hostname'): */config::get('database','hostname'),$input_disable);?></td>
 </tr>

  <tr>
 <td class="left">MySQL用户名</td><td colspan="4"><?php echo form::input('user',/*get('user') ?get('user'):*/config::get('database','user'),$input_disable);?></td>
 </tr>
   <tr>
 <td class="left">MySQL密码</td><td colspan="4"><?php echo form::input('password',/*get('password') ? get('password') :*/config::get('database','password'),$input_disable);?></td>
 </tr>
  <tr>
 <td class="left">MySQL数据库名</td><td colspan="4"><?php echo form::input('database',/*front::post('database') ?front::post('database') : */config::get('database','database'),$input_disable);?>&nbsp;&nbsp;
 <input type="checkbox" value="1" style="width:15px;height:15px;background:none;border:none;" name="createdb" {$input_disable}/>&nbsp;&nbsp;新建数据库&nbsp;&nbsp;<input type="checkbox" value="1" style="width:15px;height:15px;background:none;border:none;" name="testdata" {if front::$post['database'] && !front::$post['testdata']}
 {else}
 checked
 {/if} />&nbsp;&nbsp;安装初始数据
 </td>
 </tr>
<tr>
 <td class="left">表前缀</td><td colspan="4"><?php echo form::input('prefix',config::get('database','prefix'),'placeholder="cmseasy_"');?> &nbsp;&nbsp;&nbsp;&nbsp;<font color="red">推荐使用&nbsp;&nbsp;cmseasy_</font></td>
 </tr>
<tr>
 <td align="center" colspan="5">
<input type="button" onclick="window.location.href='<?php echo url('install/index/step/1',true);?>';"  class="btn_b" value=" 上一步 "style="margin-right:20px;" />
<input type="submit" name="dosubmit"  class="btn_a" value=" 保存数据库信息 " /></td>
 </tr></tbody>
 </table>
  {elseif front::$get['step']==3}
  <style type="text/css">
.go {background:url({$skin_path}/images/go_3.gif) center top no-repeat;}
	.step3{display: none;}
</style>
   {if isset($adminerror)}
 <script>alert('请设置好管理帐号! ');$('.step3').show('slow');$('.step2').hide('slow');</script>
 {/if}
<tbody>
 <tr>
 <th colspan="5">管理帐号设置</th>
 </tr>
 <tr>
 <td class="left">管理员</td><td colspan="4"><?php echo form::input('admin_username',get('admin_username') ? get('admin_username'):'');?></td>
 </tr>
  <tr>
 <td class="left">密码</td><td colspan="4"><?php echo form::password('admin_password',get('admin_password') ?get('admin_password'): '');?></td>
 </tr>
   <tr>
 <td class="left">重复密码</td><td colspan="4"><?php echo form::password('admin_password2',get('admin_password2') ? get('admin_password2') :'');?></td>
 </tr>
 
<tr>
 <td align="center" colspan="5"><input type="button" onclick="window.location.href='<?php echo url('install/index/step/2',true);?>';"  class="btn_b" value=" 上一步 "style="margin-right:20px;" />
<input type="hidden" name="install" value="1"/>
<input type="submit" id="installbutton" name="dosubmit" value=" 安装 " class="btn_a" onclick="changebutton();if(!confirm('你确实要把数据安装在数据库 [ '+this.form.database.value+' ] 吗？')) return false;"/></td>
 </tr>
 </tbody>
 </table>
 <?php
 $_PHP_SELF = isset($_SERVER['PHP_SELF']) ? $_SERVER['PHP_SELF'] : (isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : $_SERVER['ORIG_PATH_INFO']);
 $_ROOTPATH = str_replace("\\","/",dirname($_PHP_SELF));
 $_ROOTPATH = strlen($_ROOTPATH)>1 ? $_ROOTPATH."/" : "/";
 $_site_url = 'http://'.$_SERVER['HTTP_HOST'].$_ROOTPATH; 
 ?>
 <input type="hidden" value="<?php echo $_site_url?>" name="site_url" />
 <div class="blank20"></div>
 {/if}
 <div class="blank10"></div>
</div>
 {/if}
<?php } ?>
</form>




<div class="clear"></div>
</div>
</div>
</div>
<div class="right_bottom">
</div>
</div>

<div id="footer">
</div>
</div>
<div class="clear"></div>
</div>

<div class="blank30"></div>
<div class="copy">{getCopyRight()}</div>
</div>

 <div class="blank30"></div>

<script language="javascript" type="text/javascript">
function changebutton(){
	document.getElementById('installbutton').value="安装中...";
}
</script>
<script language='JavaScript'>
//去掉虚线框
function bluring(){
if(event.srcElement.tagName=="A"||event.srcElement.tagName=="IMG") document.body.focus();
}
document.onfocusin=bluring;
</script>


</body>
</html>