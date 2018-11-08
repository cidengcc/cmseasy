<?php

if (!defined('ROOT')) exit('Can\'t Access !');
class cnzz {
    var $checkcode = 'KsjLiq0H';
    var $cms = 'cmseasy';
    function getinfo() {
        $domain = $_SERVER['HTTP_HOST'];
        $key = md5($domain.$this->checkcode);
        $cms = 'cmseasy';
        $url = "http://intf.cnzz.com/user/companion/cmseasy.php?domain=$domain&key=$key&cms={$this->cms}";
        $str = @file_get_contents($url);
        return explode('@',$str);
    }
    function getcount($code) {
        return "<script src='http://pw.cnzz.com/c.php?id=$code&l=2' language='JavaScript' charset='utf-8'></script>";
    }
    function autologin($code,$pass) {
        return "http://intf.cnzz.com/user/companion/cmseasy_login.php?site_id=$code&password=$pass&cms={$this->cms}";
    }
}