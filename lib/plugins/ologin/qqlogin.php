<?php

if (!defined('ROOT'))
    exit('Can\'t Access !');
$ologin_lang = ROOT . '/lang/' . config::get('lang_type') . '/ologin/qqlogin.php';
if (file_exists($ologin_lang)) {
    global $_LANG;
    include_once($ologin_lang);
}
if (isset($set_modules) && $set_modules == TRUE) {
    $i = isset($modules) ? count($modules) : 0;
    $modules[$i]['code'] = basename(__FILE__, '.php');
    $modules[$i]['desc'] = 'qqlogin_desc';
    $modules[$i]['is_cod'] = '0';
    $modules[$i]['is_online'] = '1';
    $modules[$i]['author'] = 'CmsEasy';
    $modules[$i]['website'] = 'http://www.qq.com';
    $modules[$i]['version'] = '1.0.0';
    $modules[$i]['config'] = array(
        array('name' => 'qq_appid', 'type' => 'text', 'value' => ''),
        array('name' => 'qq_key', 'type' => 'text', 'value' => ''),
    );
    return;
}

class qqlogin {

    function get_code($ologin) {
        $state = md5(uniqid(rand(), TRUE)); //CSRF protection
        session::set('qq_state', $state);
        //echo $ologin['qq_appid'];exit;
        $login_url = "https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id=" . $ologin['qq_appid'] . "&redirect_uri=" . urlencode(ologin::url(basename(__FILE__, '.php'))) . "&state=" . $state . "&scope=get_user_info";
        return $login_url;
    }

    function respond() {
        $logintype = front::$get['ologin_code'];
        $where = array('ologin_code' => $logintype);
        $ologins = ologin::getInstance()->getrows($where);
        $ologin_cfg = unserialize_config($ologins[0]['ologin_config']);
        $this->qq_callback($ologin_cfg);
        return $this->get_openid($ologin_cfg);
    }

    function qq_callback($ologin_cfg) {
        if (front::$get['state'] == session::get('qq_state')) { //csrf
            $token_url = "https://graph.qq.com/oauth2.0/token?grant_type=authorization_code&" . "client_id=" . $ologin_cfg["qq_appid"] . "&redirect_uri=" . urlencode(ologin::url(basename(__FILE__, '.php'))) . "&client_secret=" . $ologin_cfg["qq_key"] . "&code=" . front::$get["code"];
            $response = file_get_contents($token_url);
            //var_dump($response);exit;
            if (strpos($response, "callback") !== false) {
                $lpos = strpos($response, "(");
                $rpos = strrpos($response, ")");
                $response = substr($response, $lpos + 1, $rpos - $lpos - 1);
                $msg = json_decode($response);
                if (isset($msg->error)) {
                    echo "<h3>error:</h3>" . $msg->error;
                    echo "<h3>msg  :</h3>" . $msg->error_description;
                    exit;
                }
            }
            $params = array();
            parse_str($response, $params);
            session::set('access_token', $params["access_token"]);
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