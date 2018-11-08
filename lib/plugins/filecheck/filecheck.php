<?php
if (!defined('ROOT')) exit('Can\'t Access !');

define('FROOT', ROOT);
define('FDIR', dirname(__FILE__));
define('DS', DIRECTORY_SEPARATOR);

require FDIR.DS.'tool'.DS.'tool.php';

FileCheck::$SafeRecover=true; //替换文件前先备份

//FileCheck::$DataDir=FDIR.DS.'#data'; //文件数据目录
//FileCheck::$CheckDirs[]=FileCheck::$DataDir.DS.'system'; //要备份的目录

FileCheck::$DataDir=FROOT.DS.'cache'.DS.'filedata';
FileCheck::$CheckDirs=array(
    FROOT.DS.'lib',
//    FROOT.DS.'template',
//    FROOT.DS.'bbs',
);

$action=isset($_GET['action']) && preg_match('/^\w+$/', $_GET['action']) > 0 ? $_GET['action'] : 'check'; //'experience';
$time=isset($_GET['time']) && preg_match('/^\d{10}$/', $_GET['time']) > 0 ? $_GET['time'] : null; //'experience';

//if($action == 'make') {
//    if(count($_POST) > 0)
//        $make=FileCheck::MakeData();
//    require FDIR.DS.'view/make.php';
//}
//else
if($action == 'check') {
    if(count($_POST) > 0) {
        $check=FileCheck::CheckData($time);
    }
    else
        $check=FileCheck::CheckDataFile();
    require FDIR.DS.'view/check.php';
}
elseif($action == 'backup') {
    if(count($_POST) > 0) {
        $check=FileCheck::CheckData($time);
        if($check->pass==false) {
            $time=time();
            $make=FileCheck::MakeData($time);
            $backup=FileCheck::BackupFile($time);
        }
    }
    require FDIR.DS.'view/backup.php';
}
elseif($action == 'recover') {
    if(count($_POST) > 0) {
        $recover=FileCheck::RecoverFile($time);
    }
    require FDIR.DS.'view/recover.php';
}