<?php

if (!defined('ROOT'))
    exit('Can\'t Access !');
$ologin_lang = ROOT . '/lang/' . config::get('lang_type') . '/ologin/wechatlogin.php';
if (file_exists($ologin_lang)) {
    global $_LANG;
    include_once($ologin_lang);
}
if (isset($set_modules) && $set_modules == TRUE) {
    $i = isset($modules) ? count($modules) : 0;
    $modules[$i]['code'] = basename(__FILE__, '.php');
    $modules[$i]['desc'] = 'wechatlogin_desc';
    $modules[$i]['is_cod'] = '0';
    $modules[$i]['is_online'] = '1';
    $modules[$i]['author'] = 'CmsEasy';
    $modules[$i]['website'] = 'http://open.weixin.qq.com';
    $modules[$i]['version'] = '1.0.0';
    $modules[$i]['config'] = array(
        array('name' => 'wechat_appid', 'type' => 'text', 'value' => ''),
        array('name' => 'wechat_key', 'type' => 'text', 'value' => ''),
    );
    return;
}

class wechatlogin {

    function get_code($ologin) {
        //var_dump($ologin);exit;
        $state = md5(uniqid(rand(), TRUE)); //CSRF protection
        session::set('wechat_state', $state);
        //echo ologin::url(basename(__FILE__, '.php'));exit;
        //echo $ologin['qq_appid'];exit;
        $login_url = "https://open.weixin.qq.com/connect/qrconnect?appid=" . $ologin['wechat_appid'] . "&redirect_uri=" . urlencode(ologin::url(basename(__FILE__, '.php'))) . "&state=" . $state . "&scope=snsapi_login&response_type=code#wechat_redirect";
        return $login_url;
    }

    function respond() {

        $logintype = front::$get['ologin_code'];
        //var_dump($logintype);exit;
        $where = array('ologin_code' => $logintype);
        $ologins = ologin::getInstance()->getrows($where);
        $ologin_cfg = unserialize_config($ologins[0]['ologin_config']);
        $this->wechat_callback($ologin_cfg);
        //return $this->get_openid($ologin_cfg);
        return ;
    }

    //https请求
    public function https_request($url, $data = null)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (!empty($data)){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }

    public function get_user_info($openid,$access_token)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$access_token."&openid=".$openid."&lang=zh_CN";
        $res = $this->https_request($url);
        return json_decode($res, true);
    }



    function wechat_callback($ologin_cfg) {
        if (front::$get['state'] == session::get('wechat_state')) { //csrf
            $token_url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=" . $ologin_cfg['wechat_appid'] . "&secret=" . $ologin_cfg['wechat_key'] . "&code=".front::$get["code"]."&grant_type=authorization_code";
            $response = $this->https_request($token_url);
            $response = json_decode($response,true);
            if($response['access_token']) {
                session::set('access_token', $response["access_token"]);
            }
            if($response['openid']){
                session::set('openid',$response['openid']);
            }
            if($response['unionid']){
                session::set('unionid',$response['unionid']);
            }
            if($response['errmsg']){
                exit($response['errmsg']);
            }
        }
    }

    function get_openid($ologin_cfg) {
        $token = session::get('access_token');
        //var_dump($token);exit;
        $graph_url = "https://graph.qq.com/oauth2.0/me?access_token=" . session::get('access_token');
        $str = file_get_contents($graph_url);
        if (strpos($str, "callback") !== false) {
            $lpos = strpos($str, "(");
            $rpos = strrpos($str, ")");
            $str = substr($str, $lpos + 1, $rpos - $lpos - 1);
        }
        $user = json_decode($str);
        if (isset($user->error)) {
            echo "<h3>error:</h3>" . $user->error;
            echo "<h3>msg  :</h3>" . $user->error_description;
            exit;
        }

        //set openid to session
        session::set("openid", $user->openid);
        $get_user_info = 'https://graph.qq.com/user/get_user_info?access_token=' . session::get('access_token') . '&oauth_consumer_key=' . $ologin_cfg["qq_appid"] . '&openid=' . session::get('openid') . '&format=json';
        $info = file_get_contents($get_user_info);
        $arr = json_decode($info, true);
        return $arr;

        /* echo "<p>";
          echo "Gender:".$arr["gender"];
          echo "</p>";
          echo "<p>";
          echo "NickName:".$arr["nickname"];
          echo "</p>";
          echo "<p>";
          echo "<img src=\"".$arr['figureurl']."\">";
          echo "<p>";
          echo "<p>";
          echo "<img src=\"".$arr['figureurl_1']."\">";
          echo "<p>";
          echo "<p>";
          echo "<img src=\"".$arr['figureurl_2']."\">";
          echo "<p>"; */
    }

}