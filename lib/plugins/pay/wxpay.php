<?php

if (!defined('ROOT')) exit('Can\'t Access !');
$payment_lang = ROOT . '/lang/' . config::get('lang_type') . '/pay/wxpay.php';
if (file_exists($payment_lang)) {
    global $_LANG;
    include_once($payment_lang);
}
if (isset($set_modules) && $set_modules == TRUE) {
    $i = isset($modules) ? count($modules) : 0;
    $modules[$i]['code'] = basename(__FILE__, '.php');
    $modules[$i]['desc'] = 'wxpay_desc';
    $modules[$i]['is_cod'] = '0';
    $modules[$i]['is_online'] = '1';
    $modules[$i]['author'] = 'CmsEasy';
    $modules[$i]['website'] = 'http://mp.weixin.qq.com';
    $modules[$i]['version'] = '1.0.0';
    $modules[$i]['config'] = array(
        array('name' => 'APPID', 'type' => 'text', 'value' => ''),
        array('name' => 'MCHID', 'type' => 'text', 'value' => ''),
        array('name' => 'KEY', 'type' => 'text', 'value' => ''),
        array('name' => 'APPSECRET', 'type' => 'text', 'value' => ''),
    );
    return;
}
require_once(ROOT . "/lib/plugins/wxpay/lib/WxPay.Config.php");
require_once(ROOT . "/lib/plugins/wxpay/lib/WxPay.Api.php");
require_once(ROOT . "/lib/plugins/wxpay/lib/WxPay.JsApiPay.php");



class wxpay
{

    function get_code($order, $payment)
    {

        $logHandler= new CLogFileHandler(ROOT."/cache/data/wxpay_".date('Y-m-d').'.log');
        Log::Init($logHandler, 15);

        WxPayConfig::$APPID = $payment['APPID'];
        WxPayConfig::$MCHID = $payment['MCHID'];
        WxPayConfig::$KEY = $payment['KEY'];
        WxPayConfig::$APPSECRET = $payment['APPSECRET'];

        $tools = new JsApiPay();
        $openId = $tools->GetOpenid();

        $input = new WxPayUnifiedOrder();
        $input->SetBody($order['title']);
        $input->SetAttach($order['ordersn']);
        $input->SetOut_trade_no($order['ordersn'] . $order['id']);
        $input->SetTotal_fee(intval($order['orderamount']*100));
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 600));
        $input->SetGoods_tag("test");
        $input->SetNotify_url(pay::url(basename(__FILE__, '.php')));
        $input->SetTrade_type("JSAPI");
        $input->SetOpenid($openId);

        $order1 = WxPayApi::unifiedOrder($input);
        $jsApiParameters = $tools->GetJsApiParameters($order1);
        $editAddress = $tools->GetEditAddressParameters();

        $rerun_url = url::create('archive/respond/subject/'.$order['ordersn'].'/oid/'.$order['ordersn']. $order['id']);
        $str = <<<EOT
<script type="text/javascript">
	//调用微信JS api 支付
	function jsApiCall()
	{
		WeixinJSBridge.invoke(
			'getBrandWCPayRequest',
			{$jsApiParameters},
			function(res){
				WeixinJSBridge.log(res.err_msg);
				//alert(res.err_code+res.err_desc+res.err_msg);
				if(res.err_msg == 'get_brand_wcpay_request:ok'){
				    window.location.href = '{$rerun_url}';
				}
			}
		);
	}

	function callpay()
	{
		if (typeof WeixinJSBridge == "undefined"){
		    if( document.addEventListener ){
		        document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
		    }else if (document.attachEvent){
		        document.attachEvent('WeixinJSBridgeReady', jsApiCall);
		        document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
		    }
		}else{
		    jsApiCall();
		}
	}
	</script>
	<script type="text/javascript">
	//获取共享地址
	function editAddress()
	{
		WeixinJSBridge.invoke(
			'editAddress',
			{$editAddress},
			function(res){
				var value1 = res.proviceFirstStageName;
				var value2 = res.addressCitySecondStageName;
				var value3 = res.addressCountiesThirdStageName;
				var value4 = res.addressDetailInfo;
				var tel = res.telNumber;

				//alert(value1 + value2 + value3 + value4 + ":" + tel);
			}
		);
	}

	window.onload = function(){
		if (typeof WeixinJSBridge == "undefined"){
		    if( document.addEventListener ){
		        document.addEventListener('WeixinJSBridgeReady', editAddress, false);
		    }else if (document.attachEvent){
		        document.attachEvent('WeixinJSBridgeReady', editAddress);
		        document.attachEvent('onWeixinJSBridgeReady', editAddress);
		    }
		}else{
			editAddress();
		}
	};

	</script>
EOT;
        $str .= '<div style="text-align:center"><button style="width:210px; height:50px; border-radius: 15px;background-color:#FE6714; border:0px #FE6714 solid; cursor: pointer;  color:white;  font-size:16px;" type="button" onclick="callpay()" >立即支付</button></div>';
        return $str;
    }

    function respond()
    {
        if($_GET['subject']){
            $order_sn = str_replace($_GET['subject'], '', $_GET['oid']);
            $order_sn = intval($order_sn);
            $_GET['trade_no'] = $_GET['oid'];
            pay::changeorders($order_sn, $_GET);

            return true;
        }
    }
}
