<?php

if (!defined('ROOT')) exit('Can\'t Access !');
$payment_lang = ROOT.'/lang/'.config::get('lang_type').'/pay/nopay.php';
if (file_exists($payment_lang)) {
    global $_LANG;
    include_once($payment_lang);
}
if (isset($set_modules) &&$set_modules == TRUE) {
    $i = isset($modules) ?count($modules) : 0;
    $modules[$i]['code']    = basename(__FILE__,'.php');
    $modules[$i]['desc']    = 'nopay_desc';
    $modules[$i]['is_cod']  = '0';
    $modules[$i]['is_online']  = '1';
    $modules[$i]['author']  = 'CmsEasy';
    $modules[$i]['website'] = 'http://www.cmseasy.cn';
    $modules[$i]['version'] = '1.0.0';
    return;
}