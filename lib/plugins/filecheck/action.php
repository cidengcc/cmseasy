<?php
if (!defined('ROOT')) exit('Can\'t Access !');

$FileDataDir = '.filedata';  //文件指纹备份目录
$TrojanDir = '.trojan';  //木马恢复区
$UploadDirs = 'upload,celive/uploadfiles';  //上传目录


header("content-Type: text/html; charset=utf-8");

//+-
//define('ROOT', dirname(dirname(__FILE__)));

define('FROOT', ROOT);
define('FDIR', dirname(__FILE__));
define('DS', DIRECTORY_SEPARATOR);

require FDIR . DS . 'tool' . DS . 'tool.php';

//+-
//FileData::$DataDir = FDIR . DS . '#data';
FileCheckData::$DataDir = FROOT . DS . $FileDataDir;
TrojanScan::$TrojanDir = FROOT . DS . $TrojanDir;
if (is_dir(FileCheckData::$DataDir) == false)
    mkdir(FileCheckData::$DataDir, 0777, true);
if (is_dir(TrojanScan::$TrojanDir) == false)
    mkdir(TrojanScan::$TrojanDir, 0777, true);

$action = isset($_GET['action']) && preg_match('/^\w+$/', $_GET['action']) > 0 ? $_GET['action'] : 'trojan_scan'; //'experience';
//$time = isset($_GET['time']) && preg_match('/^\d{10}$/', $_GET['time']) > 0 ? $_GET['time'] : null; //'experience';

//if ($action == 'protect') {
//    require FDIR . DS . 'view/protect.php';
//}
//else

if ($action == 'file_backup') {
    if (empty($_POST)) {
        $fileList = GetFileList(FROOT, false, true);
        $file_list = new stdClass();
        $file_list->dirs = $file_list->files = array();
        if (is_array($fileList['dir']))
            foreach ($fileList['dir'] as $dir) {
                if (preg_match(FileBackup::FileNameMath, basename($dir)) > 0)
                    $file_list->dirs[] = basename($dir);
            }
        if (is_array($fileList['file']))
            foreach ($fileList['file'] as $file) {
                if (preg_match(FileBackup::FileNameMath, basename($file)) > 0)
                    $file_list->files[] = basename($file);
            }
    }

    if (count($_POST) > 0) {
        $backup = new stdClass();
        $backup->Success = null;
        //TODO array_walk
        $files = $_POST['files'];
        if (empty($files) == false) {
            $make = FileCheckData::MakeData($files);
            $backup = FileBackup::BackupFile($files, $make->Time);
        }
    }
    require FDIR . DS . 'view/file_backup.php';
}

elseif ($action == 'file_check') {
    if (count($_POST) > 0) {
        $name = isset($_POST['name']) && preg_match('/^[\w-\.]+$/', $_POST['name']) > 0 ? $_POST['name'] : null;
        if ($name != null) {
            if (empty($_POST['check']) == false)
                $check = FileCheckData::CheckData($name);
            elseif (empty($_POST['delete']) == false) {
                $delete1 = FileCheckData::DeleteData($name);
                $delete2 = FileBackup::DeleteData($name);
                $_POST = array();
            }
        }
    }
    if (empty($_POST)) {
        $datafiles = FileCheckData::GetDataFilesInfo();
    }
    require FDIR . DS . 'view/file_check.php';
}

elseif ($action == 'file_recover') {
    if (count($_POST) > 0) {
        //TODO array_walk
        $name = isset($_POST['name']) && preg_match('/^[\w-\.]+$/', $_POST['name']) > 0 ? $_POST['name'] : null;
        $check = new stdClass();
        function DSPost(&$value)
        {
            $value = str_replace(DS . DS, DS, $value);
        }

        $check->changed = isset($_POST['changed']) ? $_POST['changed'] : array();
        $check->created = isset($_POST['created']) ? $_POST['created'] : array();
        $check->lost = isset($_POST['lost']) ? $_POST['lost'] : array();
        array_walk($check->changed, 'DSPost');
        array_walk($check->created, 'DSPost');
        array_walk($check->lost, 'DSPost');
        $recover = FileBackup::RecoverFile($name, $check);
    }
    require FDIR . DS . 'view/file_recover.php';
}

elseif ($action == 'trojan_scan') {
    if (count($_POST) > 0) {
        $scan = TrojanScan::Scan(explode(',', $UploadDirs));
    }
    require FDIR . DS . 'view/trojan_scan.php';
}

elseif ($action == 'trojan_remove') {
    if (count($_POST) > 0) {
        //TODO array_walk
        $files = $_POST['files'];
        $type = isset($_POST['remove']) ? 'remove' : 'replace';

        $remove = new stdClass();
        $remove->count = 0;
        if (empty($files) == false)
            $remove = TrojanScan::Remove($files, $type);
    }
    require FDIR . DS . 'view/trojan_remove.php';
}

elseif ($action == 'trojan_history') {
    if (count($_POST) > 0) {
        //array_walk
        $_POST['package'] = str_replace(DS . DS, DS, $_POST['package']);
        if (isset($_POST['delete'])) {
            TrojanScan::DeletePackage($_POST['package']);
        }
        if (isset($_POST['restore'])) {
            //TrojanScan::RestoreFile($_POST['package'],$_POST['file']);
            TrojanScan::RestorePackageFile($_POST['package'], $_POST['file']);
        }
    }

    $history = TrojanScan::GetHistory($files, $type);
    require FDIR . DS . 'view/trojan_history.php';
}