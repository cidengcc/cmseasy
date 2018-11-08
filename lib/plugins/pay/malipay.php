<?php

if (!defined('ROOT')) exit('Can\'t Access !');
$payment_lang = ROOT . '/lang/' . config::get('lang_type') . '/pay/malipay.php';
if (file_exists($payment_lang)) {
    global $_LANG;
    include_once($payment_lang);
}
if (isset($set_modules) && $set_modules == TRUE) {
    $i = isset($modules) ? count($modules) : 0;
    $modules[$i]['code'] = basename(__FILE__, '.php');
    $modules[$i]['desc'] = 'alipay_desc';
    $modules[$i]['is_cod'] = '0';
    $modules[$i]['is_online'] = '1';
    $modules[$i]['author'] = 'CmsEasy';
    $modules[$i]['website'] = 'http://www.alipay.com';
    $modules[$i]['version'] = '2.0.0';
    $modules[$i]['config'] = array(
        array('name' => 'alipay_appid', 'type' => 'text', 'value' => ''),
        array('name' => 'alipay_partner', 'type' => 'text', 'value' => ''),
        array('name' => 'alipay_private', 'type' => 'textarea', 'value' => ''),
        array('name' => 'alipay_public', 'type' => 'textarea', 'value' => ''),
    );
    return;
}
//require_once(ROOT . "/lib/plugins/malipay/lib/alipay_submit.class.php");
define("AOP_SDK_WORK_DIR", ROOT .'/cache/tmp');
require_once ROOT . '/lib/plugins/malipay/aop/AopClient.php';
require_once ROOT . '/lib/plugins/malipay/aop/request/AlipayTradeWapPayRequest.php';
require_once ROOT . '/lib/plugins/malipay/wappay/service/AlipayTradeService.php';
require_once ROOT . '/lib/plugins/malipay/wappay/buildermodel/AlipayTradeWapPayContentBuilder.php';

class malipay
{

    function __construct()
    {

    }

    function get_code($order, $payment)
    {



        $config['app_id'] = $payment['alipay_appid'];
        $config['merchant_private_key'] = $payment['alipay_private'];
        $config['notify_url'] = pay::url(basename(__FILE__, '.php'));
        $config['return_url'] = pay::url(basename(__FILE__, '.php'));
        $config['charset'] = 'UTF-8';
        $config['sign_type'] = 'RSA2';
        $config['gatewayUrl'] = 'https://openapi.alipay.com/gateway.do';
        $config['alipay_public_key'] = $payment['alipay_public'];

        //var_dump($config);exit;
        $result = '参数错误';
        if (!empty($order['ordersn']) && trim($order['id'])!="") {
            //商户订单号，商户网站订单系统中唯一订单号，必填
            $out_trade_no = $order['ordersn'];

            //订单名称，必填
            $subject = $order['ordersn'];

            //付款金额，必填
            $total_amount = $order['orderamount'];

            //商品描述，可空
            $body = $order['body'];

            //超时时间
            $timeout_express = "1d";

            $payRequestBuilder = new AlipayTradeWapPayContentBuilder();
            $payRequestBuilder->setBody($body);
            $payRequestBuilder->setSubject($subject);
            $payRequestBuilder->setOutTradeNo($out_trade_no);
            $payRequestBuilder->setTotalAmount($total_amount);
            $payRequestBuilder->setTimeExpress($timeout_express);

            $payResponse = new AlipayTradeService($config);
            $result = $payResponse->wapPay($payRequestBuilder, $config['return_url'], $config['notify_url']);
            $result = '<div style="text-align:center">'.$result.'</div>';
        }
        //var_dump($result);exit;
        return $result;
    }

    function respond()
    {
        /*@file_put_contents('logs_post.txt',var_export($_POST,true));*/
        if (!empty($_POST)) {
            //@file_put_contents('logs_post.txt',var_export($_POST,true));
            foreach ($_POST as $key => $data) {
                $_GET[$key] = $data;
            }
        }

        $payment  = pay::get_payment('malipay');
        $config['app_id'] = $payment['alipay_appid'];
        $config['merchant_private_key'] = $payment['alipay_private'];
        $config['notify_url'] = pay::url(basename(__FILE__, '.php'));
        $config['return_url'] = pay::url(basename(__FILE__, '.php'));
        $config['charset'] = 'UTF-8';
        $config['sign_type'] = 'RSA2';
        $config['gatewayUrl'] = 'https://openapi.alipay.com/gateway.do';
        $config['alipay_public_key'] = $payment['alipay_public'];

        //var_dump($config);exit;
        //@file_put_contents('logs.txt',var_export($_GET,true));

        require_once ROOT . '/lib/plugins/malipay/wappay/service/AlipayTradeService.php';

        $alipaySevice = new AlipayTradeService($config);
        //unset($_GET['case']);
        $result = $alipaySevice->check($_GET);
        //@file_put_contents('logs.txt',var_export($result,true));
        //var_dump($result);
        if($result) {
            //@file_put_contents('logs_yan.txt',var_export($_POST,true));
            //$order_sn = str_replace($_GET['subject'], '', $_GET['out_trade_no']);
            require_once ROOT . '/lib/table/orders.php';
            require_once ROOT . '/lib/table/logistics.php';
            require_once ROOT . '/lib/table/archive.php';
            $order_sn = $_GET['out_trade_no'];

            $orders = orders::getInstance()->getrow(array('oid'=>$order_sn));
            //var_dump($orders);
            //exit;
            if($orders['s_status'] == '1'){
                return false;
            }
            //var_dump($vvv);
            //$a = pay::check_money2($order_sn, $_GET['total_amount']);
            //file_put_contents('logs_b.txt',var_export($a,true));
        //var_dump(pay::check_money2($orders, $_GET['total_amount']));
            if (!pay::check_money2($orders, $_GET['total_amount'])) {
                return false;
            }
            //var_dump($_GET);
            if ($_GET['trade_status'] == "TRADE_FINISHED" || $_GET['trade_status'] == "TRADE_SUCCESS") {
                //@file_put_contents('logs_c.txt',var_export($_POST,true));
                pay::changeorders2($order_sn, $_GET);
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}