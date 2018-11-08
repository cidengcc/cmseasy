
$(document).ready(function(){
	//移动像素的图像
	var move = -15;
	//缩放比例，1.2 =120％
	var zoom = 1.2;
	//在对这些缩略图的鼠标滑过事件
	$('.list_cp li').hover(function(){
		//根据缩放百分比设置宽度和高度
		width = $('.list_cp li').width() * zoom;
		height = $('.list_cp li').height() * zoom;
		//移动和缩放图像
		$(this).find('img').stop(false,true).animate({'width':width, 'height':height, 'top':move, 'left':move}, {duration:200});
		//显示标题
		$(this).find('.list_cp_info').stop(false,true).fadeIn(200);
	},function(){
		//复位图像
		$(this).find('img').stop(false,true).animate({'width':$('.list_cp li').width(), 'height':$('.list_cp li').height(), 'top':'0', 'left':'0'}, {duration:100});	
		//隐藏标题
		$(this).find('.list_cp_info').stop(false,true).fadeOut(200);
	});
});