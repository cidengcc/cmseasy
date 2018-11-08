<?php

define('API_ENDPOINT','https://api-3t.paypal.com/nvp');
define('USE_PROXY',FALSE);
define('PROXY_HOST','127.0.0.1');
define('PROXY_PORT','808');
define('PAYPAL_URL','https://www.paypal.com/cgi-bin/webscr&cmd=_express-checkout&token=');
$API_Endpoint =API_ENDPOINT;
$version=VERSION;
if (!defined('ROOT')) exit('Can\'t Access !');
$payment_lang = ROOT.'/lang/'.config::get('lang_type').'/pay/paypal_ec.php';
if (file_exists($payment_lang)) {
    global $_LANG;
    include_once($payment_lang);
}
if (isset($set_modules) &&$set_modules == TRUE) {
    $i = isset($modules) ?count($modules) : 0;
    $modules[$i]['payname']  = 'paypal快速结帐';
    $modules[$i]['code']    = basename(__FILE__,'.php');
    $modules[$i]['desc']    = 'paypal_ec_desc';
    $modules[$i]['is_cod']  = '0';
    $modules[$i]['is_online']  = '1';
    $modules[$i]['author']  = 'ECSHOP TEAM';
    $modules[$i]['website'] = 'http://www.paypal.com';
    $modules[$i]['version'] = '1.0.0';
    $modules[$i]['config'] = array(
            array('name'=>'paypal_ec_username','type'=>'text','value'=>''),
            array('name'=>'paypal_ec_password','type'=>'text','value'=>''),
            array('name'=>'paypal_ec_signature','type'=>'text','value'=>''),
            array('name'=>'paypal_ec_currency','type'=>'select','value'=>'USD')
    );
    return;
}
class paypal_ec {
    function paypal_ec() {
    }
    function __construct() {
        $this->paypal_ec();
    }
    function get_code($order,$payment) {
        $token = '';
        $serverName = $_SERVER['SERVER_NAME'];
        $serverPort = $_SERVER['SERVER_PORT'];
        $url=dirname('http://'.$serverName.':'.$serverPort.$_SERVER['REQUEST_URI']);
        $paymentAmount=$order['order_amount'];
        $currencyCodeType=$payment['paypal_ec_currency'];
        $paymentType='Sale';
        $data_order_id      = $order['log_id'];
        $_SESSION['paypal_username']=$payment['paypal_ec_username'];
        $_SESSION['paypal_password']=$payment['paypal_ec_password'];
        $_SESSION['paypal_signature']=$payment['paypal_ec_signature'];
        $returnURL =urlencode($url.'/respond.php?code=paypal_ec&currencyCodeType='.$currencyCodeType.'&paymentType='.$paymentType.'&paymentAmount='.$paymentAmount.'&invoice='.$data_order_id);
        $cancelURL =urlencode("$url/SetExpressCheckout.php?paymentType=$paymentType");
        $nvpstr="&Amt=".$paymentAmount."&PAYMENTACTION=".$paymentType."&ReturnUrl=".$returnURL."&CANCELURL=".$cancelURL ."&CURRENCYCODE=".$currencyCodeType ."&ButtonSource=ECSHOP_cart_EC_C2";
        $resArray=$this->hash_call("SetExpressCheckout",$nvpstr);
        $_SESSION['reshash']=$resArray;
        if(isset($resArray["ACK"])) {
            $ack = strtoupper($resArray["ACK"]);
        }
        if (isset($resArray["TOKEN"])) {
            $token = urldecode($resArray["TOKEN"]);
        }
        $payPalURL = PAYPAL_URL.$token;
        $button = '<div style="text-align:center"><input type="button" onclick="window.open(\''.$payPalURL.'\')" value="'.$GLOBALS['_LANG']['pay_button'].'"/></div>';
        return $button;
    }
    function respond() {
        $order_sn = $_REQUEST['invoice'];
        $token =urlencode( $_REQUEST['token']);
        $nvpstr="&TOKEN=".$token;
        $resArray=$this->hash_call("GetExpressCheckoutDetails",$nvpstr);
        $_SESSION['reshash']=$resArray;
        $ack = strtoupper($resArray["ACK"]);
        if($ack=="SUCCESS") {
            $_SESSION['token']=$_REQUEST['token'];
            $_SESSION['payer_id'] = $_REQUEST['PayerID'];
            $_SESSION['paymentAmount']=$_REQUEST['paymentAmount'];
            $_SESSION['currCodeType']=$_REQUEST['currencyCodeType'];
            $_SESSION['paymentType']=$_REQUEST['paymentType'];
            $resArray=$_SESSION['reshash'];
            $token =urlencode( $_SESSION['token']);
            $paymentAmount =urlencode ($_SESSION['paymentAmount']);
            $paymentType = urlencode($_SESSION['paymentType']);
            $currCodeType = urlencode($_SESSION['currCodeType']);
            $payerID = urlencode($_SESSION['payer_id']);
            $serverName = urlencode($_SERVER['SERVER_NAME']);
            $nvpstr='&TOKEN='.$token.'&PAYERID='.$payerID.'&PAYMENTACTION='.$paymentType.'&AMT='.$paymentAmount.'&CURRENCYCODE='.$currCodeType.'&IPADDRESS='.$serverName ;
            $resArray=$this->hash_call("DoExpressCheckoutPayment",$nvpstr);
            $ack = strtoupper($resArray["ACK"]);
            if($ack=="SUCCESS") {
                order_paid($order_sn,2);
                return true;
            }
            else {
                return false;
            }
        }
        else {
            return false;
        }
    }
    function hash_call($methodName,$nvpStr) {
        global $API_Endpoint;
        $version='53.0';
        $API_UserName=$_SESSION['paypal_username'];
        $API_Password=$_SESSION['paypal_password'];
        $API_Signature=$_SESSION['paypal_signature'];
        $nvp_Header;
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$API_Endpoint);
        curl_setopt($ch,CURLOPT_VERBOSE,1);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,FALSE);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_POST,1);
        if(USE_PROXY) {
            curl_setopt ($ch,CURLOPT_PROXY,PROXY_HOST.":".PROXY_PORT);
        }
        $nvpreq="METHOD=".urlencode($methodName)."&VERSION=".urlencode($version)."&PWD=".urlencode($API_Password)."&USER=".urlencode($API_UserName)."&SIGNATURE=".urlencode($API_Signature).$nvpStr;
        curl_setopt($ch,CURLOPT_POSTFIELDS,$nvpreq);
        $response = curl_exec($ch);
        $nvpResArray=$this->deformatNVP($response);
        $nvpReqArray=$this->deformatNVP($nvpreq);
        $_SESSION['nvpReqArray']=$nvpReqArray;
        if (curl_errno($ch)) {
            $_SESSION['curl_error_no']=curl_errno($ch) ;
            $_SESSION['curl_error_msg']=curl_error($ch);
        }
        else {
            curl_close($ch);
        }
        return $nvpResArray;
    }
    function deformatNVP($nvpstr) {
        $intial=0;
        $nvpArray = array();
        while(strlen($nvpstr)) {
            $keypos= strpos($nvpstr,'=');
            $valuepos = strpos($nvpstr,'&') ?strpos($nvpstr,'&'): strlen($nvpstr);
            $keyval=substr($nvpstr,$intial,$keypos);
            $valval=substr($nvpstr,$keypos+1,$valuepos-$keypos-1);
            $nvpArray[urldecode($keyval)] =urldecode( $valval);
            $nvpstr=substr($nvpstr,$valuepos+1,strlen($nvpstr));
        }
        return $nvpArray;
    }
}