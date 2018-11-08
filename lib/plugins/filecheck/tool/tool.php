<?php

if (!defined('ROOT'))
    exit('Can\'t Access !');

class FileCheckApp
{
    static function GetUrl($params = array())
    {
        $url = 'http://';
        $url .= isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : getenv('HTTP_HOST');
        $url .= isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : getenv('SCRIPT_NAME');
        return $url . '?' . http_build_query(array_merge($_GET, $params));
    }
}

class FileCheckData
{
    static $DataDir;

    static function MakeData($files, $name = null)
    {
        $time = time();
        $name = $name ? $name : $time;
        $dataFile = self::$DataDir . '/' . $name;

        $make = new stdClass();
        $make->DataFile = $dataFile;
        $make->Time = $time;
        $make->Count = 0;

        $data = md5($time) . '.';
        $dirList = array();
        $fileList = array();
        foreach ($files as $file) {
            if (preg_match(FileBackup::FileNameMath, basename($file)) == 0)
                continue;
            $file4 = $file;
            $file = FROOT . DS . $file;
            $files2 = array();
            if (is_dir($file)) {
                $files2 = GetFileList($file);
                $dirList[] = $file4;
            }
            elseif (is_file($file)) {
                $files2 = array($file);
                $fileList[] = $file4;
            }
            foreach ($files2 as $file2) {
                $file3 = substr($file2, strlen(FROOT) + 1);
                $data .= StrToHex($file3) . '.' . filesize($file2) . '.' . filemtime($file2) . '.';
                $make->Count++;
            }
        }
        $data = StrToHex($time . ';' . implode(',', $dirList) . ';' . implode(',', $fileList)) . "\n" . $data;
        $data .= md5($data);
        file_put_contents($dataFile, $data);
        $make->Success = true;
        return $make;
    }

    static function CheckData($name)
    {
        $dataFile = self::$DataDir . DS . $name;

        $check = new stdClass();
        $check->name = $name;
        $check->pass = false;
        $check->message = null;
        $check->changed_count = 0;
        $check->created_count = 0;
        $check->lost_count = 0;
        $check->changed = array();
        $check->created = array();
        $check->lost = array();
        $check->count = 0;

        if (empty($name) || file_exists($dataFile) == false) {
            $check->message = '数据文件不存在！';
            return $check;
        }

        $fileData = file_get_contents($dataFile);
        if (md5(substr($fileData, 0, -32)) != substr($fileData, -32)) {
            $check->message = '文件校验数据被更改！';
            return $check;
        }
        $fileData = preg_replace('/^.*\n/', '', $fileData);

        $info = self::GetDataFileInfo($dataFile);
        $check->check_time = $info['time'];
        $dirs = explode(',', $info['dir']);
        $files = explode(',', $info['file']);
        $files = array_merge($dirs, $files);

        $files_check = array();

        foreach ($files as $file) {
            if (empty($file))
                continue;
            if (preg_match(FileBackup::FileNameMath, basename($file)) == 0)
                continue;
            $file4 = $file;
            $file = FROOT . DS . $file;
            $files2 = array();
            if (is_dir($file)) {
                $files2 = GetFileList($file);
            }
            elseif (is_file($file)) {
                $files2 = array($file);
            }
            foreach ($files2 as $file) {
                $file4 = substr($file, strlen(FROOT) + 1);
                $files_check[] = $file4;
                $hex = StrToHex($file4);
                $match = preg_match('/\.' . $hex . '\.(\d+)\.(\d+)./', $fileData, $match2);
                if ($match == 0) {
                    $check->created[] = $file4;
                    $check->created_count++;
                    continue;
                }
                $file0 = new stdClass();
                $file0->size = $match2[1];
                $file0->mtime = $match2[2];
                if (filesize($file) != $file0->size || filemtime($file) != $file0->mtime) {
                    $check->changed[] = $file4;
                    $check->changed_count++;
                }
            }
        }
        $check->count = count($files_check);
        //
        $match = preg_match_all('/(?<=\.)(\w{20,})\.\d+\.\d+\./', $fileData, $matches, PREG_SET_ORDER);
        foreach ($matches as $i => $match2) {
            $file3 = HexToStr($match2[1]);
            if (in_array($file3, $files_check) == false) {
                $check->lost[] = $file3;
                $check->lost_count++;
            }
        }
        //
        $check->pass = $check->count > 0 && $check->changed_count == 0 && $check->created_count == 0 && $check->lost_count == 0;
        return $check;
    }

    public static function DeleteData($name)
    {
        $dataFile = self::$DataDir . '/' . $name;
        if (file_exists($dataFile))
            unlink($dataFile);
    }

    //把第一行数据还原成文件列表
    private static function GetDataFileInfo($dataFile)
    {
        $files = new stdClass();
        $fileListData = HexToStr(GetFileLine($dataFile, 1));
        $files = explode(';', $fileListData);
        return array('time' => $files[0], 'dir' => $files[1], 'file' => $files[2]);
    }

    //取得数据文件相对路径列表
    private static function GetDataFileList()
    {
        $files = GetFileList(FileCheckData::$DataDir);
        $files2 = array();
        foreach ($files as $file) {
            if (preg_match('/^(\d+|system)$/', basename($file))) {
                $files2[] = substr($file, strlen(FileCheckData::$DataDir) + 1);
            }
        }
        return $files2;
    }

    //取得数据文件汇总信息
    static function GetDataFilesInfo()
    {
        $info = array();
        foreach (self::GetDataFileList() as $file) {
            $fileInfo = new stdClass();
            $fileInfo->dataFile = $filePath = FileCheckData::$DataDir . DS . $file;
            $fileInfo->name = basename($file);
            $backupFileList = self::GetDataFileInfo($filePath);
            $fileInfo->time = $backupFileList['time'];
            $fileInfo->date = date('Y-m-d H:i:s', $fileInfo->time);
            $fileInfo->dir = $backupFileList['dir'];
            $fileInfo->file = $backupFileList['file'];
            $info[] = $fileInfo;
        }
        return $info;
    }
}

class FileBackup
{
    static $SafeRecover = true;
    const FileNameMath = '/^\w[\w\.\-]+$/';

    static function BackupFile($files, $name)
    {
        $zipFile = FileCheckData::$DataDir . DS . $name . '.zip';

        include_once 'pclzip.lib.php';
        $zip = new PclZip($zipFile);

        $backup = new stdClass();
        $backup->Success = false;

        foreach ($files as $file) {
            $file4 = $file;
            $file = FROOT . DS . $file;
            $files2 = array();
            if (is_dir($file)) {
                $files2 = GetFileList($file);
            }
            elseif (is_file($file)) {
                $files2 = array($file);
            }
            foreach ($files2 as $file2) {
                $list = $zip->add($file2, PCLZIP_OPT_REMOVE_PATH, FROOT);
                if ($list == 0) {
                    die("Zip Error: " . $zip->errorInfo(true));
                }
            }
        }

        $backup->Success = true;
        return $backup;
    }

    static function RecoverFile($name, $check)
    {
        $zipFile = FileCheckData::$DataDir . DS . $name . '.zip';
        $delFile = FileCheckData::$DataDir . DS . $name . '.deleted.zip';
        $deleteDate = date('YmdHis');

        include_once 'pclzip.lib.php';
        $zip = new PclZip($zipFile);

        if (self::$SafeRecover == true) {
            $del = new PclZip($delFile);
        }

        $recover = new stdClass();
        $recover->count = 0;

        foreach ($check->changed as $file) {
            $file2 = str_replace('\\', '/', $file);
            if (self::$SafeRecover == true) {
                $list = $del->add(FROOT . DS . $file, PCLZIP_OPT_REMOVE_PATH, FROOT, PCLZIP_OPT_ADD_PATH, $deleteDate);
                if (empty($list) == false)
                    unlink(FROOT . DS . $file);
            }
            else
                unlink(FROOT . DS . $file);
            $list = $zip->extract(PCLZIP_OPT_BY_NAME, $file2, PCLZIP_OPT_PATH, FROOT . DS);
            if ($list == 0) {
                echo 'Zip Error: ' . $zip->errorInfo(true) . '<br/>';
            }
            else
                $recover->count++;
        }

        foreach ($check->created as $file) {
            if (self::$SafeRecover == true) {
                $list = $del->add(FROOT . DS . $file, PCLZIP_OPT_REMOVE_PATH, FROOT, PCLZIP_OPT_ADD_PATH, $deleteDate);
                if (empty($list) == false)
                    unlink(FROOT . DS . $file);
            }
            else
                unlink(FROOT . DS . $file);
            $recover->count++;
        }

        foreach ($check->lost as $file) {
            $file2 = str_replace('\\', '/', $file);
            $list = $zip->extract(PCLZIP_OPT_BY_NAME, $file2, PCLZIP_OPT_PATH, FROOT . DS);
            if (empty($list) == false)
                $recover->count++;
        }
        return $recover;
    }

    public static function DeleteData($name)
    {
        $zipFile = FileCheckData::$DataDir . '/' . $name . '.zip';
        if (file_exists($zipFile))
            unlink($zipFile);
    }
}

class TrojanScan
{
    static $TrojanDir;

    static function Scan(array $files)
    {
        $scan = new stdClass();
        $scan->pass = false;
        $scan->fail = array();
        $scan->code = array();

        foreach ($files as $file) {
            $file = FROOT . DS . $file;
            $files2 = array();
            if (is_file($file))
                $files2 = array($file);
            elseif (is_dir($file))
                $files2 = GetFileList($file);
            foreach ($files2 as $file2) {
                $data = file_get_contents($file2);
                $file3 = substr($file2, strlen(FROOT) + 1);

                $codes = array();

                if (preg_match("/\.php$/i", basename($file2))) {
                    $code = new stdClass();
                    $code->name = 'php文件';
                    $code->code = basename($file2);
                    $codes[] = $code;
                }

                if (preg_match("/<(\?(php)?|%|script)\s.*(\?|%|script)>/i", $data, $match)) {
                    $code = new stdClass();
                    $code->name = '脚本特征';
                    $code->code = $match[0];
                    $codes[] = $code;
                }

                //if (empty($codes))
                foreach (self::getCode() as $key => $value) {
                    if (preg_match("/($value)/i", $data, $match) > 0) {
                        $code = new stdClass();
                        $code->name = $key;
                        $code->code = $match[0];
                        $codes[] = $code;
                        break;
                    }
                }

                if (empty($codes) == false) {
                    $fail = new stdClass();
                    $fail->file = $file3;
                    $fail->codes = $codes;
                    $scan->fail[] = $fail;
                }

            }
        }
        $scan->pass = empty($scan->fail);
        return $scan;
    }

    static function Remove(array $files, $type = 'remove|replace')
    {
        $remove = new stdClass();
        $remove->count = 0;

        $removeDate = date('YmdHis');
        include_once 'pclzip.lib.php';

        $scan = self::Scan($files);
        if ($scan->pass == false)
            foreach ($scan->fail as $i => $fail) {
                $file = FROOT . DS . $fail->file;
                if (file_exists($file)) {
                    $trojanFile = self::$TrojanDir . DS . $removeDate . '.' . $i . '.deleted.zip';
                    $del = new PclZip($trojanFile);
                    $list = $del->add($file, PCLZIP_OPT_REMOVE_PATH, FROOT);
                    if ($type == 'remove')
                        unlink($file);
                    elseif ($type == 'replace') {
                        $data = file_get_contents($file);
                        $code = $fail->codes[0]->code;
                        $replace = '{' . str_pad('', strlen($code) - 2, '0') . '}';
                        $data = str_replace($code, $replace, $data);
                        file_put_contents($file, $data);
                    }
                    $remove->count++;
                }
            }
        return $remove;
    }

    static function getCode()
    {
        return array(
            '后门特征->cha88.cn' => 'cha88\.cn',
            '后门特征->c99shell' => 'c99shell',
            '后门特征->phpspy' => 'phpspy',
            '后门特征->Scanners' => 'Scanners',
            '后门特征->cmd.php' => 'cmd\.php',
            '后门特征->str_rot13' => 'str_rot13',
            '后门特征->webshell' => 'webshell',
            '后门特征->EgY_SpIdEr' => 'EgY_SpIdEr',
            '后门特征->tools88.com' => 'tools88\.com',
            '后门特征->SECFORCE' => 'SECFORCE',
            '后门特征->eval("?>' => 'eval\((\'|")\?>',
            '可疑代码特征->system(' => 'system\(',
            '可疑代码特征->passthru(' => 'passthru\(',
            '可疑代码特征->shell_exec(' => 'shell_exec\(',
            '可疑代码特征->exec(' => 'exec\(',
            '可疑代码特征->popen(' => 'popen\(',
            '可疑代码特征->proc_open' => 'proc_open',
            '可疑代码特征->eval($' => 'eval\((\'|"|\s*)\\$',
            '可疑代码特征->assert($' => 'assert\((\'|"|\s*)\\$',
            '危险MYSQL代码->returns string soname' => 'returnsstringsoname',
            '危险MYSQL代码->into outfile' => 'intooutfile',
            '危险MYSQL代码->load_file' => 'select(\s+)(.*)load_file',
            '加密后门特征->eval(gzinflate(' => 'eval\(gzinflate\(',
            '加密后门特征->eval(base64_decode(' => 'eval\(base64_decode\(',
            '加密后门特征->eval(gzuncompress(' => 'eval\(gzuncompress\(',
            '加密后门特征->eval(gzdecode(' => 'eval\(gzdecode\(',
            '加密后门特征->eval(str_rot13(' => 'eval\(str_rot13\(',
            '加密后门特征->gzuncompress(base64_decode(' => 'gzuncompress\(base64_decode\(',
            '加密后门特征->base64_decode(gzuncompress(' => 'base64_decode\(gzuncompress\(',
            '一句话后门特征->eval($_' => 'eval\((\'|"|\s*)\\$_(POST|GET|REQUEST|COOKIE)',
            '一句话后门特征->assert($_' => 'assert\((\'|"|\s*)\\$_(POST|GET|REQUEST|COOKIE)',
            '一句话后门特征->require($_' => 'require\((\'|"|\s*)\\$_(POST|GET|REQUEST|COOKIE)',
            '一句话后门特征->require_once($_' => 'require_once\((\'|"|\s*)\\$_(POST|GET|REQUEST|COOKIE)',
            '一句话后门特征->include($_' => 'include\((\'|"|\s*)\\$_(POST|GET|REQUEST|COOKIE)',
            '一句话后门特征->include_once($_' => 'include_once\((\'|"|\s*)\\$_(POST|GET|REQUEST|COOKIE)',
            '一句话后门特征->call_user_func("assert"' => 'call_user_func\(("|\')assert("|\')',
            '一句话后门特征->call_user_func($_' => 'call_user_func\((\'|"|\s*)\\$_(POST|GET|REQUEST|COOKIE)',
            '一句话后门特征->$_POST/GET/REQUEST/COOKIE[?]($_POST/GET/REQUEST/COOKIE[?]' => '\$_(POST|GET|REQUEST|COOKIE)\[([^\]]+)\]\((\'|"|\s*)\\$_(POST|GET|REQUEST|COOKIE)\[',
            '一句话后门特征->echo(file_get_contents($_POST/GET/REQUEST/COOKIE' => 'echo\(file_get_contents\((\'|"|\s*)\\$_(POST|GET|REQUEST|COOKIE)',
            '上传后门特征->file_put_contents($_POST/GET/REQUEST/COOKIE,$_POST/GET/REQUEST/COOKIE' => 'file_put_contents\((\'|"|\s*)\\$_(POST|GET|REQUEST|COOKIE)\[([^\]]+)\],(\'|"|\s*)\\$_(POST|GET|REQUEST|COOKIE)',
            '上传后门特征->fputs(fopen("?","w"),$_POST/GET/REQUEST/COOKIE[' => 'fputs\(fopen\((.+),(\'|")w(\'|")\),(\'|"|\s*)\\$_(POST|GET|REQUEST|COOKIE)\[',
            '.htaccess插马特征->SetHandler application/x-httpd-php' => 'SetHandlerapplication\/x-httpd-php',
            '.htaccess插马特征->php_value auto_prepend_file' => 'php_valueauto_prepend_file',
            '.htaccess插马特征->php_value auto_append_file' => 'php_valueauto_append_file',
        );
    }

    static function GetHistory()
    {
        include_once 'pclzip.lib.php';
        $history = new stdClass();
        $history->packages = array();
        $files = GetFileList(self::$TrojanDir);
        $files = array_reverse($files);
        $files2 = array();
        foreach ($files as $file) {
            if (preg_match('/\d+\.deleted\.zip/', basename($file)) == 0)
                continue;
            $del = new PclZip($file);
            $list = $del->listContent();
            $package = new stdClass();
            $package->file = substr($file, strlen(FROOT) + 1);
            $package->date = date('Y-m-d H:i:s', filemtime($file));
            $package->files = array();
            foreach ($list as $file3) {
                $file4 = new stdClass();
                $file4->file = $file3['filename'];
                $file4->size = $file3['size'];
                $package->files[] = $file4;
            }
            $history->packages[] = $package;
        }
        return $history;
    }

    static function DeletePackage($package)
    {
        $file = FROOT . DS . $package;
        if (file_exists($file))
            unlink($file);
    }

    static function RestorePackageFile($package, $file)
    {
        self::RestoreFile($package, $file);
        self::DeletePackage($package);
    }

    static function RestoreFile($package, $file2)
    {
        $file = FROOT . DS . $package;
        if (file_exists($file)) {
            include_once 'pclzip.lib.php';
            $del = new PclZip($file);
            $file3 = FROOT . DS . $file2;
            if (file_exists($file3)) {
                unlink($file3);
            }
            $list = $del->extract(PCLZIP_OPT_BY_NAME, $file2, PCLZIP_OPT_PATH, FROOT . DS);
        }
    }
}

function StrToHex($string)
{
    $hex = "";
    for ($i = 0; $i < strlen($string); $i++)
        $hex .= dechex(ord($string[$i]));
    return $hex;
}

function HexToStr($hex)
{
    $string = "";
    for ($i = 0; $i < strlen($hex) - 1; $i += 2)
        $string .= chr(hexdec($hex[$i] . $hex[$i + 1]));
    return $string;
}

function GetFileList($dir, $recursive = true, $typeFormat = false)
{
    static $results = array();
    if (isset($results[$dir]))
        return $results[$dir];
    $result = array();
    $dirs = $files = array();
    if (is_dir($dir) && $handle = opendir($dir)) {
        while (($file = readdir($handle)) !== false) {
            if ($file == '.' || $file == '..')
                continue;
            $real_path = realpath($dir . DIRECTORY_SEPARATOR . $file);

            if (is_dir($real_path)) {
                if ($recursive)
                    $files = array_merge($files, GetFileList($real_path));
                else
                    $dirs[] = $real_path;
            }
            elseif (is_file($real_path)) {
                $files[] = $real_path;
            }

        }
        closedir($handle);
    }
    if ($typeFormat && $recursive == false)
        $result = array('dir' => $dirs, 'file' => $files);
    else
        $result = array_merge($dirs, $files);
    $results[$dir] = $result;
    return $result;
}

function GetFileLine($file, $line)
{
    $fp = fopen($file, "r");
    if ($fp) {
        for ($i = 1; !feof($fp); $i++) {
            if ($i == $line) {
                $get = fgets($fp);
                fclose($fp);
                return $get;
            }
        }
    }
    fclose($fp);
    return false;
}
