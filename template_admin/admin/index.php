<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo get('sitename');?> - 后台管理中心</title>
    <link href="{$skin_path}/css/bootstrap.min.css" rel="stylesheet">
	<link href="{$skin_path}/css/admin.css" rel="stylesheet" type="text/css" />
	<script src="{$skin_path}/js/jquery.min.js"></script>
	<script src="{$skin_path}/js/jquery-browser.js"></script>
	<script type="text/javascript">
	<!--
		if (navigator.userAgent.indexOf('Firefox') >= 0) {
			alert('请勿使用Firefox浏览器进行后台操作！')
			} else {
		}
	//-->
	</script>
  </head>
<body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
	  <div class="row">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar" aria-expanded="false" aria-controls="sidebar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="logo col-sm-3 col-md-2" href="{$base_url}/index.php?admin_dir={get('admin_dir')}&site=default"><img src="{$skin_path}/images/logo.png" alt="logo" /></a>
		  <div id="sideNav" href=""><i class="glyphicon glyphicon-th-list"></i></div>
        </div>
        <div id="navbar" class="navbar-collapse collapse col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 pull-right">
           <ul class="nav navbar-top-links navbar-right"> 
			<li><a href="{$base_url}/"  target="_blank">预览</a></li>
			<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">静态
				<span class="caret"></span></a>
				<ul class="dropdown-menu tasks">
					<li><a href="{$base_url}/index.php?case=cache&act=make_show&admin_dir={get('admin_dir')}&site=default">电脑版静态</a></li>
					<li><a href="{$base_url}/index.php?case=wapcache&act=make_show&admin_dir={get('admin_dir')}&site=default">手机版静态</a></li>
				</ul>
			</li>

			<li><a href="{$base_url}/index.php?case=table&act=add&table=archive&admin_dir={get('admin_dir')}">添加</a>
			<li><a href="{url::create('config/remove')}" class="on">缓存</a></li>
			<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-bell"></i>
				<span class="caret"></span></a>
				<ul id="information" class="dropdown-menu envelope">    
				</ul>
			</li>
			<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-tasks"></i>
				<span class="caret"></span></a>
				<ul class="dropdown-menu tasks">
					<li><a href="http://www.cmseasy.cn/" target="_blank">软件官网</a></li>
					<li><a href="http://www.cmseasy.cn/service/" target="_blank">购买授权</a></li>
					<li><a href="http://www.cmseasy.org/" target="_blank">问题交流</a></li>
					<li><a href="http://www.cmseasy.cn/chm/quick/" target="_blank">快速入门</a></li>
					<li><a href="http://www.cmseasy.cn/chm/" target="_blank">在线教程？</a></li>
				</ul>
			</li>
			<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-globe"></i>
				<span class="caret"></span></a>
				<ul class="dropdown-menu tasks">
				{loop getwebsite() $d}
					<li><a href="{$d[addr]}">{$d[name]}</a></li>
				{/loop}
				</ul>
			</li>
			<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-user"></i> {$user.username}<span class="caret"></span></a>
				<ul class="dropdown-menu user">
					<li><a href="{$base_url}/index.php?case=user&act=edit&table=user"><i class="fa fa-user fa-fw"></i> 编辑资料</a></li>
					<li><a href="{$base_url}/index.php?case=index&act=logout&admin_dir={config::get('admin_dir')}"><i class="fa fa-sign-out fa-fw"></i> 退出</a></li>
				</ul>
			</li>
		</ul>
      </div>
    </div>
	</div>
  </nav>

    <div class="container-fluid">
      <div class="row">
	  <!-- 左侧 ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------>
        <div id="sidebar" class="sidebar navbar-side">
         <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
			<ul class="nav" id="main-menu">
			<?php $menu=admin_menu::allmenu(); $i=0; $class1 = '';?>
			{if $menu}
			{loop $menu $ns $ms}
			<?php
			if($ns == '设置' && !chkpower('config')){
				continue;
			}
			if($ns == '内容' && !chkpower('content')){
				continue;
			}
			if($ns == '用户' && !chkpower('user')){
				continue;
			}
			if($ns == '订单' && !chkpower('order')){
				continue;
			}
			if($ns == '功能' && !chkpower('func')){
				continue;
			}
			if($ns == '模板' && !chkpower('template')){
				continue;
			}
			if($ns == '营销' && !chkpower('seo')){
				continue;
			}
			if($ns == '自定义' && !chkpower('defined')){
				continue;
			}
			?>
                        <li><a class="active-menu waves-effect waves-dark" href="#">
{if $i==1}<span class="glyphicon glyphicon-list-alt"></span> 
			{elseif $i==2}<span class="glyphicon glyphicon-user"></span> 
			{elseif $i==3}<span class="glyphicon glyphicon-shopping-cart"></span> 
			{elseif $i==4}<span class="glyphicon glyphicon-th-list"></span> 
			{elseif $i==5}<span class="glyphicon glyphicon-th"></span> 
			{elseif $i==6}<span class="glyphicon glyphicon-signal"></span> 
			{elseif $i==7}<span class="glyphicon glyphicon-edit"></span> 
			{else}
			<span class="glyphicon glyphicon-cog"></span> 
			{/if}
			{$ns}</a>
                            <ul class="nav nav_{$i} nav-second-level">
				{loop $ms $n $m}
				<?php
					if($n == '网站配置' && !chkpower('system_site')){
						continue;
					}
					if($n == '水印设置' && !chkpower('system_image')){
					   continue;
					}
					if($n == '附件设置' && !chkpower('system_upload')){
					   continue;
					}
	if($n == '字符过滤' && !chkpower('system_security')){
	   continue;
	}
	if($n == '邮件发送' && !chkpower('system_mail')){
	   continue;
	}
	if($n == '热门标签' && !chkpower('hottag')){
	   continue;
	}
	if($n == '语言包编辑' && !chkpower('language')){
	   continue;
	}
	if($n == '短信设置' && !chkpower('system_sms')){
	   continue;
	}
	if($n == '地图设置' && !chkpower('system_ditu')){
	   continue;
	}
	if($n == '站点列表' && !chkpower('website')){
		continue;
	}

	
	if($n == '栏目管理' && !chkpower('category')){
		continue;
	}
	if($n == '分类管理' && !chkpower('mtype')){
		continue;
	}
	if($n == '专题管理' && !chkpower('special')){
		continue;
	}
	if($n == '内容管理' && !chkpower('archive')){
		continue;
	}
	if($n == '批量导入' && !chkpower('archive_import')){
		continue;
	}
	if($n == 'URL规则' && !chkpower('category_htmlrule')){
		continue;
	}
	if($n == '推荐位' && !chkpower('archive_setting')){
		continue;
	}
	if($n == '热搜关键词' && !chkpower('archive_hotsearch')){
		continue;
	}
	if($n == '图片库' && !chkpower('archive_image')){
		continue;
	}
	if($n == '标签管理' && !chkpower('archive_tag')){
		continue;
	}
								
								
	if($n == '用户管理' && !chkpower('user_list')){
		continue;
	}
	if($n == '用户组管理' && !chkpower('usergroup_list')){
		continue;
	}
								
	if($n == '登录配置' && !chkpower('user_ologin')){
		continue;
	}
	if($n == '添加用户' && !chkpower('user_invite')){
		continue;
	}
								
	if($n == '订单列表' && !chkpower('order_list')){
		continue;
	}
	if($n == '支付配置' && !chkpower('order_pay')){
		continue;
	}
	if($n == '配货配置' && !chkpower('order_logistics')){
		continue;
	}
								
	if($n == '公告管理' && !chkpower('func_announc_list')){
		continue;
	}
	if($n == '留言管理' && !chkpower('func_book_list')){
		continue;
	}
	if($n == '评论管理' && !chkpower('func_comment_list')){
		continue;
	}
	if($n == '投票管理' && !chkpower('func_ballot_list')){
		continue;
	}
	if($n == '数据管理' && !chkpower('func_data')){
		continue;
	}
	if($n == '安全防护' && !chkpower('func_data_safe')){
		continue;
	}
								
	if($n == '选择模板' && !chkpower('func_announc_list')){
		continue;
	}
	if($n == '模版结构标注' && !chkpower('func_book_list')){
		continue;
	}
	if($n == '查看模板源码' && !chkpower('func_comment_list')){
		continue;
	}
	if($n == '更多模板' && !chkpower('func_ballot_list')){
		continue;
	}
	if($n == '幻灯' && !chkpower('func_data')){
		continue;
	}
								
	if($n == '内容标签' && !chkpower('templatetag_list_content')){
		continue;
	}
	if($n == '栏目标签' && !chkpower('templatetag_list_category')){
		continue;
	}
	if($n == '自定义标签' && !chkpower('templatetag_list_define')){
		continue;
	}
								
	if($n == '手机内容标签' && !chkpower('templatetag_list_content')){
		continue;
	}
	if($n == '手机栏目标签' && !chkpower('templatetag_list_category')){
		continue;
	}
	if($n == '手机自定义标签' && !chkpower('templatetag_list_define')){
		continue;
	}


	if($n == '公众号管理' && !chkpower('seo_weixin_list')){
		continue;
	}
	if($n == '链接管理' && !chkpower('seo_linkword_list')){
		continue;
	}
	if($n == '友情链接管理' && !chkpower('seo_friendlink_list')){
		continue;
	}
	if($n == '推广联盟' && !chkpower('union_list')){
		continue;
	}
	if($n == '发送邮件' && !chkpower('seo_mail_send')){
		continue;
	}
								
	if($n == '内容字段' && !chkpower('defined_field_content')){
		continue;
	}
	if($n == '用户字段' && !chkpower('defined_field_user')){
		continue;
	}
	if($n == '管理表单' && !chkpower('defined_form_list')){
		continue;
	}


	
	$rm = preg_quote($m);
    if(preg_match("@$rm@i",$_SERVER['REQUEST_URI'])){
	    $curr_ns = $ns;
	    $curr_n = $n;
	    $curr_i = $i;
	    ?><li><a href="{$m}">{$n}</a></li>
                            <?php
    }else{
        ?>
                                <li><a href="{$m}">{$n}</a></li>
                                <?php
    }
	?>

				{/loop}
			</ul></li>
			<?php $i++;?>
			<?php $j++;?>
			<?php $k++;?>
			{/loop}
			{else}
			无可用操作
			{/if} 
		</ul>
	</div>
</div>

<script>$(function(){
    $('.nav_<?php echo $curr_i;?>').addClass('in');
    });</script>
<!-- 右侧 --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
<div id="page-wrapper" class="main">
	<div class="container-fluid">

		<div class="row">

		<ol class="breadcrumb">
  <li><a href="{$base_url}/index.php?admin_dir={get('admin_dir')}&site=default" title="后台首页">首页</a></li>
            {if $curr_ns}
            <li><?php echo $curr_ns;?></li>
            {/if}
            {if $curr_n}
            <li class="active"><a href="<?php echo $menu[$curr_ns][$curr_n];?>"><?php echo $curr_n;?></a></li>
            {/if}
  <?php if(front::get('deletestate')) echo ' ><li class="active">回收站</li>'; if(front::get('needcheck')) echo ' ><li class="active">待审核内容</li>'; ?>
</ol>

			<?php
			$this->render();
			?>
		</div>

		<div class="blank30"></div>
		<div class="copy">{getCopyRight()}</div>
		<div class="clearfix"></div>
	</div>
</div>

</div>
<div class="blank30"></div>
</div>


<script type="text/javascript">
<!--

//标签页
$('#myTabs a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
})

//去掉虚线框
function bluring(){
if(event.srcElement.tagName=="A"||event.srcElement.tagName=="IMG") document.body.focus();
}
document.onfocusin=bluring;

//点击关闭提示信息层
function turnoff(obj){
document.getElementById(obj).style.display="none";
}

//信息提示框
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

//-->
</script>

<?php if(hasflash()) { ?>
<div id='message'>
<div class="alert alert-danger alert-dismissible fade in" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
      <span class="glyphicon glyphicon-warning-sign"></span>	  <?php echo showflash(); ?>
    </div>
</div>
<script type="text/javascript">
<!--
function lick(){
$("#message").hide();
}
window.setTimeout("lick()",3000);
//-->
</script>
<?php } ?>



    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="{$skin_path}/js/bootstrap.min.js"></script>
	<!-- Metis Menu Js -->
    <script src="{$skin_path}/js/jquery.metisMenu.js"></script>
    <!-- Custom Js -->
    <script src="{$skin_path}/js/custom-scripts.js"></script> 
	<script language="javascript" type="text/javascript" src="{$skin_path}/js/admin.js"></script>
	<script src="{$skin_path}/js/jquery.nicescroll.min.js"></script> 

<script type="text/javascript">
<!--
$('.sidebar').niceScroll({
    cursorcolor: "#152944",//#CC0071 光标颜色
    cursoropacitymax: 0, //改变不透明度非常光标处于活动状态（scrollabar“可见”状态），范围从1到0
    touchbehavior: false, //使光标拖动滚动像在台式电脑触摸设备
    cursorwidth: "0px", //像素光标的宽度
    cursorborder: "0", // 游标边框css定义
    cursorborderradius: "0px",//以像素为光标边界半径
    autohidemode: true //是否隐藏滚动条
});
//-->
</script>
<script>
	   $(document).ready(function(){
	      $.get('./lib/tool/getinf.php?type=officialinf',function(data){
	          $("#information").append(data);
	      });
	   });
</script>
<!--[if lt IE 9]><!-->
<script src="{$skin_path}/js/ie/html5shiv.min.js"></script>
<script src="{$skin_path}/js/ie/respond.min.js"></script>
<![endif]-->
<style type="text/css">
	html,body{background:#152944;}
</style>
</body>
</html>