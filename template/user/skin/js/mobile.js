//浏览器检测
(function (window) {
    /**  
    浏览器版本信息
    * @type {Object} 
    * @return {Boolean}  返回布尔值     
    */
    var browser = function () {
        var u = navigator.userAgent.toLowerCase();
        var app = navigator.appVersion.toLowerCase();
        return {
            txt: u, // 浏览器版本信息
            version: (u.match(/.+(?:rv|it|ra|ie)[\/: ]([\d.]+)/) || [])[1], // 版本号       
            msie: /msie/.test(u) && !/opera/.test(u), // IE内核
            mozilla: /mozilla/.test(u) && !/(compatible|webkit)/.test(u), // 火狐浏览器
            safari: /safari/.test(u) && !/chrome/.test(u), //是否为safair
            chrome: /chrome/.test(u), //是否为chrome
            opera: /opera/.test(u), //是否为oprea
            presto: u.indexOf('presto/') > -1, //opera内核
            webKit: u.indexOf('applewebkit/') > -1, //苹果、谷歌内核
            gecko: u.indexOf('gecko/') > -1 && u.indexOf('khtml') == -1, //火狐内核
            //mobile: !!u.match(/applewebkit.*mobile.*/), //是否为移动终端
            mobile: !!u.match(/applewebkit.*mobile.*/) || u.indexOf('ucbrowser/') != -1, //是否为移动终端含UC
            ios: !!u.match(/\(i[^;]+;( u;)? cpu.+mac os x/), //ios终端
            android: u.indexOf('android') > -1, //android终端
            iPhone: u.indexOf('iphone') > -1, //是否为iPhone
            iPad: u.indexOf('ipad') > -1, //是否iPad
            webApp: !!u.match(/applewebkit.*mobile.*/) && u.indexOf('safari/') == -1, //是否web应该程序，没有头部与底部
            fixed: !!u.match(/applewebkit.*mobile.*/) && (u.match(/\(i[^;]+;( u;)? cpu.+mac os x/) ? 5 > /\d/ig.exec(/os\s\d/ig.exec(u) + "") ? !1 : !0 : 3 > parseFloat(/\d.\d/ig.exec(/android\s\d.\d/ig.exec(u))) ? !1 : !0) //是否支持fixed
        };
    }()
    window.browser = browser;
})(window)
function cmseasy_mobile_prefix(){
	mobile_prefix+=mobile_prefix.indexOf('?')==-1?'?':'&';
	mobile_prefix+='cmseasy_mobileok=1';
	if(mobile_prefix.indexOf('lang=')==-1)mobile_prefix+='&lang='+mobile_lang;
	return mobile_prefix;
}
var hrefValue = window.location.href;
if(window.browser.mobile&&cmseasy_wap_tpa==1){
	if(cmseasy_wap_tpb==1&&cmseasy_wap_url!=''&&String(hrefValue).indexOf(cmseasy_wap_url)==-1){
		window.location.href = cmseasy_wap_url;
	}else{
		//window.location.href = mobile_prefix+'?cmseasy_mobileok=1&lang='+mobile_lang;
		window.location.href = cmseasy_mobile_prefix();
	}
}
if(cmseasy_wap_tpb==1){
	if(String(hrefValue).indexOf(cmseasy_wap_url)!=-1){
		//window.location.href = 'index.php?cmseasy_mobileok=1&lang='+mobile_lang;
		window.location.href = cmseasy_mobile_prefix();
	}
}