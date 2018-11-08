<?php

if (!defined('ROOT')) exit('Can\'t Access !');
$payment_lang = ROOT.'/lang/'.config::get('lang_type').'/pay/tenpay.php';
if (file_exists($payment_lang)) {
    global $_LANG;
    include_once($payment_lang);
}
if (isset($set_modules) &&$set_modules == TRUE) {
    $i = isset($modules) ?count($modules) : 0;
    $modules[$i]['code']    = basename(__FILE__,'.php');
    $modules[$i]['desc']    = 'tenpay_desc';
    $modules[$i]['is_cod']  = '0';
    $modules[$i]['is_online']  = '1';
    $modules[$i]['author']  = 'CmsEasy';
    $modules[$i]['website'] = 'http://www.tenpay.com';
    $modules[$i]['version'] = '1.0.0';
    $modules[$i]['config']  = array(
            array('name'=>'tenpay_account','type'=>'text','value'=>''),
            array('name'=>'tenpay_key','type'=>'text','value'=>''),
    );
    return;
}
class tenpay {
    function alipay() {
    }
    function __construct() {
        $this->alipay();
    }
    function get_code($order,$payment) {
        require_once ("tenpay/PayRequestHandler.class.php");
        $strReq = date("His") . rand(1000, 9999);
        $transaction_id = $payment['tenpay_account'] . date("Ymd") . $strReq;
        $reqHandler = new PayRequestHandler();
        $reqHandler->init();
        $reqHandler->setKey($payment['tenpay_key']);
        $reqHandler->setParameter("bargainor_id", $payment['tenpay_account']);			//商户号
        $reqHandler->setParameter("sp_billno",$order['ordersn']);					//商户订单号
        $reqHandler->setParameter("transaction_id", $transaction_id);		//财付通交易单号
        $reqHandler->setParameter("total_fee", $order['orderamount']*100);					//商品总金额,以分为单位
        $reqHandler->setParameter("return_url", pay::url(basename(__FILE__,'.php')));				//返回处理地址
        $reqHandler->setParameter("desc", $order['ordersn']);	//商品名称
        $reqHandler->setParameter("spbill_create_ip", front::ip());
        $reqUrl = $reqHandler->getRequestURL();
        $button = '<div style="text-align:center"><input type="button" onclick="window.open(\''.$reqUrl.'\')" value="财付通网上支付" /></div>';
        return $button;
    }
    function respond() {
        require_once ("tenpay/PayResponseHandler.class.php");
        $resHandler = new PayResponseHandler();
        $sp_billno = $resHandler->getParameter("sp_billno");
        if(preg_match('/(select|union|and|\'|"|\))/i',$sp_billno)){
        	exit('非法参数');
        }
        preg_match_all("/-(.*)-(.*)-(.*)/isu",$sp_billno,$oidout);
        $paytype = $where['pay_code'] = $oidout[3][0];
        include_once ROOT.'/lib/plugins/pay/'.$paytype.'.php';
        $pay = pay::getInstance()->getrows($where);
        $payconfig = unserialize($pay[0]['pay_config']);
        $resHandler->setKey($payconfig[1]['value']);
        
        $where = array();
        $where['oid']=$sp_billno;
        $orders=orders::getInstance()->getrow($where);

        if($resHandler->isTenpaySign()) {
            $transaction_id = $resHandler->getParameter("transaction_id");
            $total_fee = $resHandler->getParameter("total_fee");
            $pay_result = $resHandler->getParameter("pay_result");
            if("0" == $pay_result) {
                if (!pay::check_money($orders['id'],$total_fee/100)) {
                    echo "<br/>" . "金额不符" . "<br/>";
                    return false;
                }
                pay::changeorders($orders['id'],$_GET);
                $show = config::get('site_url');
                $resHandler->doShow($show);
            } else {
                echo "<br/>" . "支付失败" . "<br/>";
                 return false;
            }
        } else {
            echo "<br/>" . "认证签名失败" . "<br/>";
             return false;
        }
    }
}