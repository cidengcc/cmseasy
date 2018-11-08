<?php

if (!defined('ROOT')) exit('Can\'t Access !');
$payment_lang = ROOT . '/lang/' . config::get('lang_type') . '/pay/wxscanpay.php';
if (file_exists($payment_lang)) {
    global $_LANG;
    include_once($payment_lang);
}
if (isset($set_modules) && $set_modules == TRUE) {
    $i = isset($modules) ? count($modules) : 0;
    $modules[$i]['code'] = basename(__FILE__, '.php');
    $modules[$i]['desc'] = 'wxscanpay_desc';
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

require_once(ROOT . "/lib/plugins/wxpay/lib/log.php");
require_once(ROOT . "/lib/plugins/wxpay/lib/WxPay.Config.php");
require_once(ROOT . "/lib/plugins/wxpay/lib/WxPay.Api.php");
require_once(ROOT . "/lib/plugins/wxpay/lib/WxPay.NativePay.php");
require_once(ROOT . "/lib/plugins/wxpay/lib/WxPay.Notify.php");


class wxscanpay
{
    function __construct()
    {
        $logHandler= new CLogFileHandler(ROOT."/cache/data/wxscan_".date('Y-m-d').'.log');
        Log::Init($logHandler, 15);

        $pay = pay::getInstance()->getrow(array('pay_code'=>'wxscanpay'));
        //Log::DEBUG('pay:'.var_export($pay,true));
        $payment = unserialize_config($pay['pay_config']);

        WxPayConfig::$APPID = $payment['APPID'];
        WxPayConfig::$MCHID = $payment['MCHID'];
        WxPayConfig::$KEY = $payment['KEY'];
        WxPayConfig::$APPSECRET = $payment['APPSECRET'];
    }

    function get_code($order, $payment)
    {


        /**
         * 模式一 无效 改测模式2
         *
        $notify = new NativePay();
        //var_dump($notify);exit;
        $url1 = $notify->GetPrePayUrl($order['ordersn']);
        //var_dump($url1);
        $str = '<img alt="扫码支付" src="'.url('tool/wxqrcode/data/'.urlencode($url1)).'" style="width:150px;height:150px;"/>';
        return $str;
         * */

        $notify = new NativePay();
        $input = new WxPayUnifiedOrder();
        $input->SetBody($order['title']);
        $input->SetAttach($order['ordersn']);
        $input->SetOut_trade_no($order['ordersn'] . $order['id']);
        $input->SetTotal_fee(intval($order['orderamount']*100));
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 600));
        $input->SetGoods_tag("test");
        $input->SetNotify_url(pay::url(basename(__FILE__, '.php')));
        $input->SetTrade_type("NATIVE");
        $input->SetProduct_id($order['ordersn']);
        $result = $notify->GetPayUrl($input);
        $str = '';
        if($result['return_code'] != 'SUCCESS'){
            $str .= 'return_code:'.$result['return_msg'].' return_msg:'.$result['return_msg'];
        }
        if($result['result_code'] != 'SUCCESS'){
            $str .= 'err_code:'.$result['err_code'].' err_code_des:'.$result['err_code_des'];
        }
        if($result['return_code'] == 'SUCCESS' && $result['result_code'] == 'SUCCESS') {
            $url2 = $result["code_url"];
            $str = '<img title="' . pay::url(basename(__FILE__, '.php')) . '" alt="扫码支付" src="' . url('tool/wxqrcode/data/' . urlencode($url2)) . '" style="width:150px;height:150px;"/>';
        }
        return $str;
    }

   /* public function Queryorder($ordersn)
    {
        $input = new WxPayOrderQuery();
        $input->SetOut_trade_no($ordersn);
        //var_dump($input);
        $result = WxPayApi::orderQuery($input);
        Log::DEBUG("query:" . json_encode($result));
        if(array_key_exists("return_code", $result)
            && array_key_exists("result_code", $result)
            && $result["return_code"] == "SUCCESS"
            && $result["result_code"] == "SUCCESS")
        {
            return true;
        }
        return false;
    }*/

    function notify(){

        //file_put_contents('logs_post.txt',var_export($_POST,true));
        //file_put_contents('xml.txt',var_export($xml,true));
        $notify = new PayNotifyCallBack();
        //$notify->xml = $xml;
        $notify->Handle(false);
        //file_put_contents('rlogs.txt',file_get_contents('rlogs.txt')."\n".var_export($notify,true));
    }

    function respond()
    {
        //file_put_contents('logs_post.txt',var_export($_POST,true));
        //file_put_contents('logs_get.txt',var_export($_GET,true));
        if($_GET['subject']){
            $order_sn = str_replace($_GET['subject'], '', $_GET['oid']);
            $order_sn = intval($order_sn);
            $_GET['trade_no'] = $_GET['oid'];
            pay::changeorders($order_sn, $_GET);

            return true;
        }
    }
}
