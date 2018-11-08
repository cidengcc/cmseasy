<?php

if (!defined('ROOT')) exit('Can\'t Access !');
$payment_lang = ROOT.'/lang/'.config::get('lang_type').'/pay/alipay.php';
if (file_exists($payment_lang)) {
    global $_LANG;
    include_once($payment_lang);
}
if (isset($set_modules) &&$set_modules == TRUE) {
    $i = isset($modules) ?count($modules) : 0;
    $modules[$i]['code']    = basename(__FILE__,'.php');
    $modules[$i]['desc']    = 'alipay_desc';
    $modules[$i]['is_cod']  = '0';
    $modules[$i]['is_online']  = '1';
    $modules[$i]['author']  = 'CmsEasy';
    $modules[$i]['website'] = 'http://www.alipay.com';
    $modules[$i]['version'] = '1.0.0';
    $modules[$i]['config']  = array(
            array('name'=>'alipay_account','type'=>'text','value'=>''),
            array('name'=>'alipay_key','type'=>'text','value'=>''),
            array('name'=>'alipay_partner','type'=>'text','value'=>''),
            array('name'=>'alipay_pay_method','type'=>'select','value'=>'')
    );
    return;
}
class alipay {
    function alipay() {
    }
    function __construct() {
        $this->alipay();
    }
    function get_code($order,$payment) {
        $charset = 'utf-8';
        $real_method = $payment['alipay_pay_method'];
        switch ($real_method) {
            case '0':
                $service = 'trade_create_by_buyer';
                break;
            case '1':
                $service = 'create_partner_trade_by_buyer';
                break;
            case '2':
                $service = 'create_direct_pay_by_user';
                break;
        }
        $parameter = array(
                'service'=>$service,
                'partner'=>$payment['alipay_partner'],
                'return_url'=>pay::url(basename(__FILE__,'.php')),
                'notify_url'=>pay::url(basename(__FILE__,'.php')),
                '_input_charset'=>$charset,
                'subject'=>$order['ordersn'],
                'body'=>$order['title'],
                'out_trade_no'=>$order['ordersn'].$order['id'],
                'price'=>$order['orderamount'],
                'payment_type'=>1,
                'quantity'=>1,
                'logistics_fee'=>0,
                'logistics_payment'=>'BUYER_PAY_AFTER_RECEIVE',
                'logistics_type'=>'EXPRESS',
                'seller_email'=>$payment['alipay_account']
        );
        ksort($parameter);
        reset($parameter);
        $param = '';
        $sign  = '';
        foreach ($parameter AS $key =>$val) {
            $param .= "$key=".urlencode($val)."&";
            $sign  .= "$key=$val&";
        }
        $param = substr($param,0,-1);
        $sign  = substr($sign,0,-1).$payment['alipay_key'];
        $button = '<div style="text-align:center"><input type="button" onclick="window.open(\'https://mapi.alipay.com/gateway.do?'.$param.'&sign='.md5($sign).'&sign_type=MD5\')" value="支付宝网上支付" /></div>';
        return $button;
    }
    function respond() {
        if (!empty($_POST)) {
            foreach($_POST as $key =>$data) {
                if(preg_match('/(=|<|>|\')/', $data)){
                    return false;
                }
                $_GET[$key] = $data;
            }
        }
        $payment  = pay::get_payment($_GET['code']);
        $seller_email = rawurldecode($_GET['seller_email']);
        $order_sn = str_replace($_GET['subject'],'',$_GET['out_trade_no']);
        $order_sn = trim($order_sn);
        if (!pay::check_money($order_sn,$_GET['total_fee'])) {
            return false;
        }
        if($_GET['trade_status'] == "WAIT_SELLER_SEND_GOODS"||$_GET['trade_status'] == "TRADE_FINISHED" || $_GET['trade_status'] == "TRADE_SUCCESS") {
            pay::changeorders($order_sn,$_GET);
            return true;
        }else {
            return false;
        }
    }
}