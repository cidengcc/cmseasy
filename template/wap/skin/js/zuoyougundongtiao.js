function myEvent(obj, ev, fu){
	obj.attachEvent ? obj.attachEvent('on' + ev, fu) : obj.addEventListener(ev, fu, false);
}
window.onload = function(){
	var oBox = document.getElementById('ztbox');
	var oLeft = document.getElementById('left');
	var oRight = document.getElementById('right');
	var oConter = document.getElementById('conter');
	var oUl = oConter.getElementsByTagName('ul')[0];
	var oLi = oConter.getElementsByTagName('li');
	var oScroll = document.getElementById('scroll');
	var oSpan = oScroll.getElementsByTagName('span')[0];
	var i = 0;
	oUl.style.width = oLi.length * (oLi[0].offsetWidth + 30)+'px';
	//var iWidth = oScroll.offsetWidth/(oUl.offsetWidth / oConter.offsetWidth - 1)
	var iWidth=130;
	oLeft.onmouseover = oRight.onmouseover = function(){
		this.className = 'hover';
		//点击左侧按钮
		oLeft.onclick = function(){
			var butscroll = oSpan.offsetLeft - iWidth;
			oscroll(butscroll);
		};
		//点击右侧按钮
		oRight.onclick = function(){
			var butscroll = oSpan.offsetLeft + iWidth;

			oscroll(butscroll);
		};
	};
	//点击滚动条
	oScroll.onclick = function(e){
		var oEvent = e || event;
		var butscroll = oEvent.clientX - oBox.offsetLeft - 53 - oSpan.offsetWidth / 2;
		oscroll(butscroll);
	};
	oSpan.onclick = function(e){
		var oEvent = e || event;
		oEvent.cancelBubble=true;
	}
	oLeft.onmouseout = oRight.onmouseout = function(){
		this.className = '';
	};
	//拖拽滚动条
	var iX = 0;
	oSpan.onmousedown = function(e){
		var oEvent = e || event;
		iX = oEvent.clientX - oSpan.offsetLeft;
		document.onmousemove = function(e){
			var oEvent = e || event;
			var l = oEvent.clientX - iX;
			td(l);
			return false;
		};
		document.onmouseup = function(){
			document.onmousemove = null;
			document.onmouseup = null;
		};
		return false;
	};
	//滚轮事件
	function fuScroll(e){
		var oEvent = e || event;
		var l = oSpan.offsetLeft;
		oEvent.wheelDelta ? (oEvent.wheelDelta > 0 ? l-=iWidth : l+=iWidth) : (oEvent.detail ? l+=iWidth : l-=iWidth);
		oscroll(l)
		if(oEvent.PreventDefault){
			oEvent.PreventDefault();
		}
	}
	myEvent(oConter, 'mousewheel', fuScroll);
	myEvent(oConter, 'DOMMouseScroll', fuScroll);
	//滚动事件
	function oscroll(l){
		if(l < 0){
			l = 0;
		}else if(l > oScroll.offsetWidth - oSpan.offsetWidth){
			l = oScroll.offsetWidth - oSpan.offsetWidth;
		}
		var scrol = l / (oScroll.offsetWidth - oSpan.offsetWidth);
		sMove(oSpan, 'left', Math.ceil(l));
		sMove(oUl, 'left', '-'+Math.ceil((oUl.offsetWidth - (oConter.offsetWidth + 15)) * scrol));
	}

	function td(l){
		if(l < 0){
			l = 0;
		}else if(l > oScroll.offsetWidth - oSpan.offsetWidth){
			l = oScroll.offsetWidth - oSpan.offsetWidth;
		}
		var scrol = l / (oScroll.offsetWidth - oSpan.offsetWidth);
		oSpan.style.left = l+'px';
		oUl.style.left = '-'+(oUl.offsetWidth - (oConter.offsetWidth + 15)) * scrol +'px';
	}
};
//运动框架
function getStyle(obj, attr){
	return obj.currentStyle ? obj.currentStyle[attr] : getComputedStyle(obj, false)[attr];
}
function sMove(obj, attr, iT, onEnd){
	clearInterval(obj.timer);
	obj.timer = setInterval(function(){
		dMove(obj, attr, iT, onEnd);
	},30);
}
function dMove(obj, attr, iT, onEnd){
	var iCur = 0;
	attr == 'opacity' ? iCur = parseInt(parseFloat(getStyle(obj, attr)*100)) : iCur = parseInt(getStyle(obj, attr));
	var iS = (iT - iCur) / 5;
	iS = iS > 0 ? Math.ceil(iS) : Math.floor(iS);
	if(iCur == iT){
		clearInterval(obj.timer);
		if(onEnd){
			onEnd();
		}
	}else{
		if(attr == 'opacity'){
			obj.style.ficter = 'alpha(opacity:'+(iCur + iS)+')';
			obj.style.opacity = (iCur + iS) / 100;
		}else{
			obj.style[attr] = iCur + iS +'px';
		}
	}
}