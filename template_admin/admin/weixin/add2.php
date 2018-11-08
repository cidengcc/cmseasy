
<style type="text/css">
	.alert span {font-weight:bold; color:red;}
</style>


<div class="alert alert-warning alert-danger" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
<span class="glyphicon glyphicon-warning-sign"></span>	<strong>添加公众号：</strong><div class="blank10"></div>


<form method="post" name="form1" action="<?php if(front::$act=='edit') $id="/id/".$data[$primary_key]; else $id=''; echo modify("/act/".front::$act."/table/".$table.$id);?>"  onsubmit="return checkform();">
<p>登录微信公众平台配置接口信息，配置成功后会自动跳转！</p>
<p><span>URL: </span><?php echo config::get('site_url');?>index.php?case=weixin&act=interface&wid={$data['oldid']}</p>
<p><span>TOKEN: </span>{$data['token']}</p>
</form>
</div>
<script type="text/javascript">
$(document).ready(function () { 
	setInterval("startRequest()",1000); 
}); 

function startRequest() 
{ 
	$.ajax({
		url: '<?php echo url('weixin/chktest/id/'.$data['id']);?>',
		type: 'GET',
		cache: false,
		success: function(data) {
			if(data==2){
				//alert('验证成功');
				location.href="<?php echo url('weixin/add3/id/'.$data['id']);?>";
			}
		}
	});
} 
</script>