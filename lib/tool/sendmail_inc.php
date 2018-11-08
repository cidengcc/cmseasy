<?php

if (!defined('ROOT')) exit('Can\'t Access !');
$mail['email']=config::get('email');
$mail[sitename]=config::get('sitename');
$charset='utf-8';
$cmsname=$mail['sitename'];
$adminemail=$mail['email'];
$mail['smtp_host']=config::get('smtp_host');
$mail['send_type']=config::get('send_type');
$mail['header_var']=config::get('header_var');
$mail['kill_error']=config::get('kill_error');
$mail['smtp_port']=config::get('smtp_port');
$mail['smtp_auth']=config::get('smtp_auth');
$mail['smtp_user_add']=config::get('smtp_user_add');
$mail['smtp_mail_username']=config::get('smtp_mail_username');
$mail['smtp_mail_password']=config::get('smtp_mail_password');
$mail['smtp_mail_if_user']=1;
function mailerror ($type='',$info='') {
    $data = '['.$type.']'.$info ."\n";
    file_put_contents( ROOT.'data/log/mail.txt',$data ,FILE_APPEND  );
}
if($mail['kill_error']) {
    error_reporting(0);
}
$header_var = $mail['header_var'] == 1 ?"\r\n": ($mail['header_var'] == 2 ?"\r": "\n");
$smtp_mail_if_user = isset($mail['smtp_mail_if_user']) ?$mail['smtp_mail_if_user'] : 1;
$email_subject = '=?'.$charset.'?B?'.base64_encode(str_replace("\r",'',str_replace("\n",'','['.$cmsname.'] '.$email_subject))).'?=';
$email_message=stripcslashes($email_message);
$email_message = chunk_split(base64_encode(str_replace("\r\n."," \r\n..",str_replace("\n","\r\n",str_replace("\r","\n",str_replace("\r\n","\n",str_replace("\n\r","\r",$email_message)))))));
$email_from = $email_from == ''?'=?'.$charset.'?B?'.base64_encode($cmsname)."?= <$adminemail>": (preg_match('/^(.+?) \<(.+?)\>$/',$email_from,$from) ?'=?'.$charset.'?B?'.base64_encode($from[1])."?= <$from[2]>": $email_from);
foreach(explode(',',$email_to) as $touser) {
    $tousers[] = preg_match('/^(.+?) \<(.+?)\>$/',$touser,$to) ?($smtp_mail_if_user ?'=?'.$charset.'?B?'.base64_encode($to[1])."?= <$to[2]>": $to[2]) : $touser;
}
$email_to = implode(',',$tousers);
$headers = "From: $email_from{$header_var}X-Priority: 3{$header_var}X-Mailer: Cmseasy{$header_var}MIME-Version: 1.0{$header_var}Content-type: text/html; charset=$charset{$header_var}Content-Transfer-Encoding: base64{$header_var}";
$mail['smtp_port'] = $mail['smtp_port'] ?$mail['smtp_port'] : 25;
if($mail['send_type'] == 1 &&function_exists('mail')) {
    @mail($email_to,$email_subject,$email_message,$headers);
}elseif($mail['send_type'] == 2) {
    if(!$fp = fsockopen($mail['smtp_mail_host'],$mail['smtp_mail_port'],$errno,$errstr,30)) {
        mailerror('SMTP',"($mail[smtp_mail_host]:$mail[smtp_mail_port]) CONNECT - Unable to connect to the SMTP server",0);
    }
    stream_set_blocking($fp,true);
    $lastmessage = fgets($fp,512);
    if(substr($lastmessage,0,3) != '220') {
        mailerror('SMTP',"$mail[smtp_mail_host]:$mail[smtp_mail_port] CONNECT - $lastmessage",0);
    }
    fputs($fp,($mail['smtp_mail_auth'] ?'EHLO': 'HELO')." cmseasy\r\n");
    $lastmessage = fgets($fp,512);
    if(substr($lastmessage,0,3) != 220 &&substr($lastmessage,0,3) != 250) {
        mailerror('SMTP',"($mail[smtp_mail_host]:$mail[smtp_mail_port]) HELO/EHLO - $lastmessage",0);
    }
    while(1) {
        if(substr($lastmessage,3,1) != '-'||empty($lastmessage)) {
            break;
        }
        $lastmessage = fgets($fp,512);
    }
    if($mail['smtp_mail_auth']) {
        fputs($fp,"AUTH LOGIN\r\n");
        $lastmessage = fgets($fp,512);
        if(substr($lastmessage,0,3) != 334) {
            mailerror('SMTP',"($mail[smtp_mail_host]:$mail[smtp_mail_port]) AUTH LOGIN - $lastmessage",0);
        }
        fputs($fp,base64_encode($mail['smtp_mail_username'])."\r\n");
        $lastmessage = fgets($fp,512);
        if(substr($lastmessage,0,3) != 334) {
            mailerror('SMTP',"($mail[smtp_mail_host]:$mail[smtp_mail_port]) USERNAME - $lastmessage",0);
        }
        fputs($fp,base64_encode($mail['smtp_mail_password'])."\r\n");
        $lastmessage = fgets($fp,512);
        if(substr($lastmessage,0,3) != 235) {
            mailerror('SMTP',"($mail[smtp_mail_host]:$mail[smtp_mail_port]) PASSWORD - $lastmessage",0);
        }
        $email_from = $mail['smtp_user_add'];
    }
    fputs($fp,"MAIL FROM: <".preg_replace("/.*\<(.+?)\>.*/","\\1",$email_from).">\r\n");
    $lastmessage = fgets($fp,512);
    if(substr($lastmessage,0,3) != 250) {
        fputs($fp,"MAIL FROM: <".preg_replace("/.*\<(.+?)\>.*/","\\1",$email_from).">\r\n");
        $lastmessage = fgets($fp,512);
        if(substr($lastmessage,0,3) != 250) {
            mailerror('SMTP',"($mail[smtp_mail_host]:$mail[smtp_mail_port]) MAIL FROM - $lastmessage",0);
        }
    }
    $email_tos = array();
    foreach(explode(',',$email_to) as $touser) {
        $touser = trim($touser);
        if($touser) {
            fputs($fp,"RCPT TO: <".preg_replace("/.*\<(.+?)\>.*/","\\1",$touser).">\r\n");
            $lastmessage = fgets($fp,512);
            if(substr($lastmessage,0,3) != 250) {
                fputs($fp,"RCPT TO: <".preg_replace("/.*\<(.+?)\>.*/","\\1",$touser).">\r\n");
                $lastmessage = fgets($fp,512);
                mailerror('SMTP',"($mail[smtp_mail_host]:$mail[smtp_mail_port]) RCPT TO - $lastmessage",0);
            }
        }
    }
    fputs($fp,"DATA\r\n");
    $lastmessage = fgets($fp,512);
    if(substr($lastmessage,0,3) != 354) {
        mailerror('SMTP',"($mail[smtp_mail_host]:$mail[smtp_mail_port]) DATA - $lastmessage",0);
    }
    $headers .= 'Message-ID: <'.gmdate('YmdHs').'.'.substr(md5($email_message.microtime()),0,6).rand(100000,999999).'@'.$_SERVER['HTTP_HOST'].">{$header_var}";
    fputs($fp,"Date: ".gmdate('r')."\r\n");
    fputs($fp,"To: ".$email_to."\r\n");
    fputs($fp,"Subject: ".$email_subject."\r\n");
    fputs($fp,$headers."\r\n");
    fputs($fp,"\r\n\r\n");
    fputs($fp,"$email_message\r\n.\r\n");
    $lastmessage = fgets($fp,512);
    if(substr($lastmessage,0,3) != 250) {
        mailerror('SMTP',"($mail[smtp_mail_host]:$mail[smtp_mail_port]) END - $lastmessage",0);
    }
    fputs($fp,"QUIT\r\n");
}elseif($mail['send_type'] == 3) {
    ini_set('SMTP',$mail['smtp_host']);
    ini_set('smtp_port',$mail['smtp_port']);
    ini_set('sendmail_from',$email_from);
    @mail($email_to,$email_subject,$email_message,$headers);
}