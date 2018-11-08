function isMobile(mobile){
	return /^1([0-9]+){5,}$/g.test(mobile);
}

function sendMobileCode(url,obj){
	
	if(isMobile(obj.val())){
		$('#btm_sendMobileCode').attr('disabled',true);
		$('#btm_sendMobileCode').val("短信已发送");
		$.post(url,{'mobile':obj.val()},function(data){
			$('#btm_sendMobileCode').val(data);
		},'text');
	}else{
		alert("手机号码格式有误");
		console.log(obj);
		obj.focus();	
	}
}
