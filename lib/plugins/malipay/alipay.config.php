<?php

$alipay_config['partner'] = $payment['alipay_partner'];

//收款支付宝账号，一般情况下收款账号就是签约账号
$alipay_config['seller_id'] = $alipay_config['partner'];

//商户的私钥（后缀是.pen）文件相对路径
$alipay_config['private_key_path'] = ROOT . '/lib/plugins/malipay/key/rsa_private_key.pem';

//支付宝公钥（后缀是.pen）文件相对路径
$alipay_config['ali_public_key_path'] = ROOT . '/lib/plugins/malipay/key/alipay_public_key.pem';


//↑↑↑↑↑↑↑↑↑↑请在这里配置您的基本信息↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑


//签名方式 不需修改
$alipay_config['sign_type'] = strtoupper('RSA');

//字符编码格式 目前支持 gbk 或 utf-8
$alipay_config['input_charset'] = strtolower('utf-8');

//ca证书路径地址，用于curl中ssl校验
//请保证cacert.pem文件在当前文件夹目录中
$alipay_config['cacert'] = ROOT . '/lib/plugins/malipay/cacert.pem';

//访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
$alipay_config['transport'] = 'http';