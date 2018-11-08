<?php

/**
 * 表单令牌(防止表单恶意提交)
 */

class Phpox_token {
	
    const SESSION_KEY = 'PHPOX_KEY';
    
    /**
     * 生成一个当前的token
     * @param string $form_name
     * @return string
     */
    
    public static function grante_token($form_name){
        $key = self::grante_key();
        //var_dump($key);
        $_SESSION[self::SESSION_KEY.$form_name] = $key;
        $token = md5(substr(time(), 0, 3).$key.$form_name);
        return $token;
    }
 
    /**
     * 验证一个当前的token
     * @param string $form_name
     * @return string
     */
    public static function is_token($form_name,$token){
        $key = $_SESSION[self::SESSION_KEY.$form_name];
        //var_dump($key);
        $old_token = md5(substr(time(), 0, 3).$key.$form_name);
        if($old_token == $token){
            return true;
        } else {
            return false;
        }
    }
 
    /**
     * 删除一个token
     * @param string $form_name
     * @return boolean
     */
    public static function drop_token($form_name){
        $_SESSION[self::SESSION_KEY.$form_name] = null;
        return true;
    }
 
    /**
     * 生成一个密钥
     * @return string
     */
    public static function grante_key(){
        $encrypt_key = md5(((float) date("YmdHis") + rand(100,999)).rand(1000,9999));
        return $encrypt_key;
    }
}