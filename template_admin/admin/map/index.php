<?php if (!defined('ADMIN')) exit('Can\'t Access !'); ?>
<style type="text/css">
body {
margin: 0px;
padding: 0px; 
border: 0px;
color:#1B4670;
font-size:14px;
line-height:150%;
text-align: left;
background:white url(bg.gif) repeat-y left top;
background-attachment:fixed;
font-family: '微软雅黑','Lucida Grande','Lucida Sans Unicode','宋体','新宋体',arial,verdana,sans-serif;
}
/************* 首页右边内容 */
.homecon{ height:auto; width:100%; }
#homecon_left{ width:32.5%; float:left; height:auto; background:#f7fcff; border:1px solid #e0ecf4; margin:2px;}
.homecon_lefttit{ line-height:30px; height:30px; background:#e0ecf4; padding-left:10px; border:1px solid #fff;}
.homecon_leftcon{ line-height:30px; height:auto;  padding:10px; font-size:12px;}


#btn{ margin-top:15px;}
#btn li{ width:auto; margin-right:10px; background:#e8f3f8; border:1px solid #c8dde8; color:#133366; height:30px; padding:0px 20px; line-height:30px; float:left; display:block;}
#btn li a{ color:#133366;}
#btn li a:hover{ color:#5b8b09; }

a {margin: 0px;padding:0px;border:0px;color:#27394F;text-decoration:none;}
a:link {color:#333;text-decoration:none;}
a:visited{color:#666;text-decoration: none;}
a:hover{color:#3399FF;text-decoration:none;}
li{list-style-type:none; margin-left:5px;}

</style>
<link href="{get('site_url')}/js/artDialog/skin/default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{$base_url}/js/jquery.min.js"></script>
<script type="text/javascript" src="{get('site_url')}/js/artDialog/artDialog.min.js"></script>
<script>
function checkver(){
	art.dialog({
		id:'lastver',
		iframe:'http://info.cmseasy.cn/help/checkver.php?ver=<?php echo _VERNUM;?>',
		title:'最新程序',
		width: 500,
		height: 160,
		lock:true
	});
}
</script>

 <div class="homecon">
 
 <?php $menu=admin_menu::allmenu(); ?>

{loop $menu $ns $ms}
 
    <div id="homecon_left">
        <div class="homecon_lefttit">{$ns}</div>
        <div class="homecon_leftcon">
        {loop $ms $n $m}
        <li>{if $m}<a href="{$m}" target="_blank">{$n}</a>{else}{$n}{/if}</li>
        {/loop}
        </div>  
    </div>

{/loop}

    <div class="clear"></div>
  </div>
