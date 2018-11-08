<?php


class SmsCode {
    public $code;

    public function getCode(){
        $this->code = mt_rand(123456,987654);
        $_SESSION['smscode'] = $this->code;
    }

    public function getTemplate($func,$argv=null){
        $str = '';
        switch($func){
            case 'chkcode':
                $str = '您好!您的本次操作验证码为:'.$_SESSION['smscode'].'。';
                break;
            case 'reg':
                $str = '您好！欢迎你注册'.config::get('sitename').'网站，账号已生成，用户名：'.$argv[0].'，密码：'.$argv[1].'，请登录会员中心完善您的信息。';
                break;
            case 'guestbook':
                $str = '感谢您在'.config::get('sitename').'的留言！我们已经收到，谢谢您的支持和参与。';
                break;
            case 'order':
                $str = '（'.$argv[0].'）您好，您的订单已经提交完成，订单编号为'.$argv[1].'。'.config::get('sitename').'网站，联系电话：'.config::get('site_mobile').'。';
                break;
            case 'form':
                $str = '您好！（'.$argv[0].'）内容已经提交，感谢您的参与和支持。';
            default :
                break;
        }
        return $str;
    }

    public function chkcode($code){
        if(!$_SESSION['smscode'] || !$code){
            return false;
        }
        return $code == $_SESSION['smscode'];
    }

    public function clear(){
        $_SESSION['smscode'] = null;
    }
}