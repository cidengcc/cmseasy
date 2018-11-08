var pi1=1;
var pi2=1;
var pi3=1;
var pi4=1;
function uppi()
{	
	var q1=$("#q1-s1-s").text();
	var q2=$("#q1-s2-s").text();
	var q3=$("#q1-s3-s").text();
	
	//第一个价格
	var q1p=q1*pi1+q2*pi2;
	$("#q1-p").text(q1p);
	//完成期限
	var q2r=(15-q3)*(q1p*0.01);
	$("#q2-p").text(q2r);
	//服务选择
	//var fws=$("input[name='fw']").val();
	var va=$("div[class*='ofw ok']").attr("id");
	var q3r=q1p*0.1;
	//alert(va);
	if(va=="oa"){
	$("#q3-p").text(q3r);
	}else{
	$("#q3-p").text(0);
	}
	//------------ 是否为公司网站
	var q2p=(q1*pi3+q2*pi4)-q1p;
	var va=$("div[class*='oqy ok']").attr("id");
	if(va=="oa"){
		$("#q4-p").text(0);
	}else{
		$("#q4-p").text(q2p);
	}
	//------------ 品质
	var q3p=(q1p+q2p)*0.1;
	var va=$("div[class*='opz ok']").attr("id");
	if(va=="oa"){
		$("#q5-p").text(0);
	}else{
		$("#q5-p").text(q3p);
	}
	
	//------------ 整合程序
	var q4p=(q1p+q2p);
	var va=$("div[class*='ocx ok']").attr("id");
	if(va=="oa"){
		$("#q6-p").text(0);
	}else if(va=="ob"){
		$("#q6-p").text(q4p*0.4);
	}else if(va=="oc"){
		$("#q6-p").text(q4p*0.2);
	}else{
		$("#q6-p").text(q4p*0.3);
	}
	
	//------------ js效果
	var p5p=0;
	$(".p2 .ok").each(function(){
		p5p=p5p+$(this).find("h3 em").text()*1;
	});
	$("#q7-p").text(p5p);
	
	
//---------最终合计价格
var okp=0;

   var oi=$("h2 span").length;
	for(i=0;i<oi-1;i++){
		okp=okp+$("h2 span:eq("+ i +")").text()*1;
	}
	$("#qok-p").text(okp);


//------------ 订单信息
var ocd='';
	$("div.ok").each(function(){
		ocd=ocd+$(this).find("h3").text()+" /*/ ";
	});
ocd="一级页面"+q1+"页，二级页面"+q2+"页 /*/ 期限"+q3+"天 /*/ "+ocd+"最后价格"+okp
$("#okc").val(ocd);

}


$(function(){

$(".fli").hover(function(){
	$(this).find("h3").css("color","#ff6600");
},function(){
	$(this).find("h3").css("color","#000");
});

$(".sub-bnt").hover(function(){
	$(this).css({"background-position":"left bottom"});
},function(){
	$(this).css({"background-position":"left top"});
});

	$(".p1 .fli").click(function(){
		$(this).parent(".p1").find(".fli").removeClass("ok"); 
		$(this).addClass("ok");
				//$(this).addClass("fhover");
				//alert($(this).find("input").attr("checked"));
		uppi();
	});
	
	$(".p2 .fli").click(function(){
		$(this).toggleClass("ok"); 
				//$(this).addClass("fhover");
				//alert($(this).find("input").attr("checked"));
		uppi();
	});
	
		$( "#q1-s1" ).slider({
			range: "min",
			value: 1,
			min: 0,
			max: 99,
			slide: function( event, ui ) {
				$("#q1-s1-s").text( ui.value );
				uppi();
			}
		});
		
		
		
  uppi();
});
