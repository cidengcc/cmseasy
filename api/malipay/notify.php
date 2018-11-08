<?php
if (!empty($_POST)) {
    file_put_contents('wlog.txt',var_export($_POST,true));
    $str = '';
    foreach ($_POST as $key => $data) {
        $str .= '&'.$key.'='.$data;
    }
    file_put_contents('wwlog.txt','index.php?case=archive&act=respond&code=malipay'.$str);
    header('Location: '.'../../index.php?case=archive&act=respond&code=malipay'.$str);
}