<?php

if (!defined('ROOT')) exit('Can\'t Access !');
$payment_lang = ROOT.'/lang/'.config::get('lang_type').'/pay/paypal.php';
if (file_exists($payment_lang)) {
    global $_LANG;
    include_once($payment_lang);
}
if (isset($set_modules) &&$set_modules == TRUE) {
    $i = isset($modules) ?count($modules) : 0;
    $modules[$i]['payname']  = 'PayPal支付';
    $modules[$i]['code']    = basename(__FILE__,'.php');
    $modules[$i]['desc']    = 'paypal_desc';
    $modules[$i]['is_cod']  = '0';
    $modules[$i]['is_online']  = '1';
    $modules[$i]['author']  = 'CmsEasy';
    $modules[$i]['website'] = 'http://www.paypal.com';
    $modules[$i]['version'] = '1.0.0';
    $modules[$i]['config'] = array(
            array('name'=>'paypal_account','type'=>'text','value'=>''),
            array('name'=>'paypal_currency','type'=>'select','value'=>'USD')
    );
    return;
}
class paypal {
    function paypal() {
    }
    function __construct() {
        $this->paypal();
    }
    function get_code($order,$payment) {
        $data_order_id      = $order['id'];
        $data_amount        = $order['orderamount'];
        $data_return_url    = pay::url(basename(__FILE__,'.php'));
        $data_pay_account   = $payment['paypal_account'];
        $currency_code      = $payment['paypal_currency'];
        $data_notify_url    = pay::url(basename(__FILE__,'.php'));
        define('SERVER_HTTP',$_SERVER['SERVER_PORT'] == '443'?'https://': 'http://');
        define('SITE_URL',SERVER_HTTP.$_SERVER['HTTP_HOST']);
        $cancel_return      = SITE_URL.config::get('base_url');
        $def_url  = '<br /><form style="text-align:center;" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">'.
                "<input type='hidden' name='cmd' value='_xclick'>".
                "<input type='hidden' name='business' value='$data_pay_account'>".
                "<input type='hidden' name='item_name' value='$order[order_sn]'>".
                "<input type='hidden' name='amount' value='$data_amount'>".
                "<input type='hidden' name='currency_code' value='$currency_code'>".
                "<input type='hidden' name='return' value='$data_return_url'>".
                "<input type='hidden' name='invoice' value='$data_order_id'>".
                "<input type='hidden' name='charset' value='utf-8'>".
                "<input type='hidden' name='no_shipping' value='1'>".
                "<input type='hidden' name='no_note' value=''>".
                "<input type='hidden' name='notify_url' value='$data_notify_url'>".
                "<input type='hidden' name='rm' value='2'>".
                "<input type='hidden' name='cancel_return' value='$cancel_return'>".
                "<input type='submit' value='".$GLOBALS['_LANG']['paypal_button'] ."'>".
                "</form><br />";
        return $def_url;
    }
    function respond() {
        $payment        = get_payment('paypal');
        $merchant_id    = $payment['paypal_account'];
        $req = 'cmd=_notify-validate';
        foreach ($_POST as $key =>$value) {
            $value = urlencode(stripslashes($value));
            $req .= "&$key=$value";
        }
        $header = "POST /cgi-bin/webscr HTTP/1.0\r\n";
        $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
        $header .= "Content-Length: ".strlen($req) ."\r\n\r\n";
        $fp = fsockopen ('www.paypal.com',80,$errno,$errstr,30);
        $item_name = $_POST['item_name'];
        $item_number = $_POST['item_number'];
        $payment_status = $_POST['payment_status'];
        $payment_amount = $_POST['mc_gross'];
        $payment_currency = $_POST['mc_currency'];
        $txn_id = $_POST['txn_id'];
        $receiver_email = $_POST['receiver_email'];
        $payer_email = $_POST['payer_email'];
        $order_sn = $_POST['invoice'];
        $memo = !empty($_POST['memo']) ?$_POST['memo'] : '';
        $action_note = $txn_id .'（'.$GLOBALS['_LANG']['paypal_txn_id'] .'）'.$memo;
        if (!$fp) {
            fclose($fp);
            return false;
        }
        else {
            fputs($fp,$header .$req);
            while (!feof($fp)) {
                $res = fgets($fp,1024);
                if (strcmp($res,'VERIFIED') == 0) {
                    if ($payment_status != 'Completed'&&$payment_status != 'Pending') {
                        fclose($fp);
                        return false;
                    }
                    if ($receiver_email != $merchant_id) {
                        fclose($fp);
                        return false;
                    }
                    if (!pay::check_money($order_sn,$payment_amount)) {
                        fclose($fp);
                        return false;
                    }
                    if ($payment['paypal_currency'] != $payment_currency) {
                        fclose($fp);
                        return false;
                    }
                    pay::changeorders($order_sn,$action_note);
                    fclose($fp);
                    return true;
                }
                elseif (strcmp($res,'INVALID') == 0) {
                    fclose($fp);
                    return false;
                }
            }
        }
    }
}