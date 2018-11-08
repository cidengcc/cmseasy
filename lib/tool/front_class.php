<?php

if (!defined('ROOT'))
    exit('Can\'t Access !');

class cache
{

    public static function get($id, $life = 3600)
    {
        $path = ROOT . '/cache/data/' . $id . '.php';
        if (config::get('list_cache') && file_exists($path) && time() - filemtime($path) < config::get('list_cache_time')) {
            $var = include $path;
            return $var;
        }
        return null;
    }

    public static function set($id, $data)
    {
        $path = ROOT . '/cache/data/' . $id . '.php';
        if (is_array($data)) {
            $string = var_export($data, true);
        } else {
            $data = str_replace("'", "\'", $data);
            $string = "'$data'";
        }
        $string = "<?php  return " . $string . ';';
        tool::mkdir(dirname($path));
        file_put_contents($path, $string);
    }

}

class compat
{

    static function main()
    {
        $compat = new compat;
        if (!function_exists('json_encode')) {
            $compat->load_json();
        }
    }

    function load_json()
    {
        function json_encode($array)
        {
            return json::encode($array);
        }

        function json_decode($string)
        {
            return json::decode($string);
        }

    }
}

include(ROOT . '/lib/plugins/xxtea.php');
compat::main();
run::_start();

class systemfind
{
    public static $file;

    static function find($file)
    {
        if (file_exists(ROOT . '/cache/data/' . $file)) {
            $_string = file_get_contents(ROOT . '/cache/data/' . $file);
            $_string = $_string + 1;
            $_string = file_put_contents(ROOT . '/cache/data/' . $file, $_string);
            if ($_string)
                return true;
        }
        return false;
    }
}

class config
{
    public static $path;
    static $modify_state;
    static $var = array();

    static function setPath($path)
    {
        self::$path = $path;
    }

    static function modify($var, $key = null, $value = null)
    {

        if (@$_GET['site'] != '') {
            if (!file_exists(ROOT . '/config/website/' . $_GET['site'] . '.php')) {
                self::setPath(ROOT . '/config/config.php');
            } else {
                if (@$_GET['site'] == 'default') {
                    self::setPath(ROOT . '/config/config.php');
                } else {
                    self::setPath(ROOT . '/config/website/' . $_GET['site'] . '.php');
                }
            }
        } else {
            self::setPath(ROOT . '/config/config.php');
        }
        $config_code = file_get_contents(self::$path);
        $siteconfig = include self::$path;
        if (is_array($var))
            foreach ($var as $key => $value) {
                $value = str_replace("'", "\'", $value);
                $value = str_replace(array("\n", "\r"), "", $value);
                $config_code = preg_replace("%(\'$key\'=>)\'.*?\'(,\s*//)%i", "$1'$value'$2", $config_code);
                //var_dump($config_code);
            }
        else {
            if (!$key || !$value)
                return;
            $config_code = preg_replace("/(\'$var\'=>array.+?\'$key\'=>)\'.*?\',/i", "$1'$value',", $config_code);
        }
        //var_dump($config_code);exit;
        file_put_contents(self::$path, $config_code);
        if ($_GET['site'] != 'default') {
            set_time_limit(0);
            $ftp = new nobftp();
            $ftp->connect($siteconfig['website']['ftpip'], $siteconfig['website']['ftpuser'], $siteconfig['website']['ftppwd'], $siteconfig['website']['ftpport']);
            $ftperror = $ftp->returnerror();
            if ($ftperror) {
                exit($ftperror);
            } else {
                $ftp->nobchdir($siteconfig['website']['ftppath']);
                $ftp->nobput($siteconfig['website']['ftppath'] . '/config/config.php', ROOT . '/config/website/' . $_GET['site'] . '.php');
            }
        }
        self::$modify_state = 1;
    }

    static function modifymod($var, $mod = null)
    {
        self::setPath(ROOT . '/' . $mod . '/include/config.inc.php');
        $config_code = file_get_contents(self::$path);
        if (is_array($var))
            foreach ($var as $key => $value) {
                $value = str_replace("'", "\'", $value);
                $config_code = preg_replace("/\['" . $key . "'\] = '.*';/", '[\'' . $key . '\'] = \'' . $value . '\';', $config_code);
            }
        file_put_contents(self::$path, $config_code);
        self::$modify_state = 1;
    }

    static function get($var, $key = null)
    {
        static $config;
        if (!isset($config))
            if (@$_GET['site'] != '') {
                if (!file_exists(ROOT . '/config/website/' . $_GET['site'] . '.php')) {
                    self::setPath(ROOT . '/config/config.php');
                } else {
                    if (@$_GET['site'] == 'default') {
                        self::setPath(ROOT . '/config/config.php');
                    } else {
                        self::setPath(ROOT . '/config/website/' . $_GET['site'] . '.php');
                    }
                }
            } else {
                self::setPath(ROOT . '/config/config.php');
            }
        if (!isset($config) || self::$modify_state)
            $config = include self::$path;
        self::$modify_state = 0;
        $config = array_merge($config, self::$var);
        if (isset($config[$var])) {
            $var = $config[$var];
            if (is_string($var))
                return $var;
            if ($key) {
                if (isset($var[$key]))
                    return $var[$key];
                else
                    return false;
            }
            return $var;
        } else
            return false;
    }

    static function set($var, $value)
    {
        if (@$_GET['site'] != '') {
            if (!file_exists(ROOT . '/config/website/' . $_GET['site'] . '.php')) {
                self::setPath(ROOT . '/config/config.php');
            } else {
                if (@$_GET['site'] == 'default') {
                    self::setPath(ROOT . '/config/config.php');
                } else {
                    self::setPath(ROOT . '/config/website/' . $_GET['site'] . '.php');
                }
            }
        } else {
            self::setPath(ROOT . '/config/config.php');
        }
        self::$var[$var] = $value;
    }
}

if (@$_GET['site'] != '') {
    if (!file_exists(ROOT . '/config/website/' . $_GET['site'] . '.php')) {
        config::setPath(ROOT . '/config/config.php');
    } else {
        if (@$_GET['site'] == 'default') {
            config::setPath(ROOT . '/config/config.php');
        } else {
            config::setPath(ROOT . '/config/website/' . $_GET['site'] . '.php');
        }
    }
} else {
    config::setPath(ROOT . '/config/config.php');
}

class cookie
{
    static function get($name)
    {
        if (isset($_COOKIE[$name]))
            return $_COOKIE[$name];
        else
            return false;
    }

    static function csize()
    {
        return '14720';
    }

    static function ssize()
    {
        return '7644';
    }

    static function set($name, $value, $expire = null, $path = '/', $domain = '')
    {
        if (!$expire)
            $expire = front::post('expire') ? time() + front::post('expire') : null;
        @setcookie($name, $value, $expire, $path, $domain);
        $_COOKIE[$name] = $value;
    }

    static function cword()
    {
        $_str = ':`a`b`c`d`e`f`g`h`i`j`k`l`m`n`o`p`q`r`s`t`u`v`w`x`y`z`/`.';
        return explode('`', $_str);
    }

    static function del($name)
    {
        setcookie($name, '', time() - 3600, '/');
    }
}

/*function exception_handler($exception) {
    var_dump($exception->code);
  echo "Uncaught exception: " , $exception->getMessage(), "\n";
  exit;
}*/


final class front
{
    static $case;
    static $act;
    static $view;
    static $admin;
    static $debug;
    static $ca;
    static $get;
    static $post;
    static $from;
    static $uri;
    static $domain;
    static $host;
    static $html = false;
    static $pages;
    static $record_count;
    static $query = array();
    static $rewrite = false;
    static $user;
    static $isadmin;
    static $htmldir = '';
    static $args = '';
    static $ismobile = false;

    function __construct()
    {
        $admin = 0;
        require_once(ROOT . '/lib/tool/functions.php');
        if (preg_match('/(\'|")/', $_POST['username']) || preg_match('/(\'|")/', $_GET['username']) || preg_match('/(\'|")/', $_COOKIE['login_username'])) {
            exit('非法参数');
        }
        self::$args = $_GET['args'];
        unset($_GET['args']);
        if ($_GET['case'] == 'file') {
            @$_GET['admin_dir'] = config::get('admin_dir');
        }
        if (@$_GET['admin_dir'] == config::get('admin_dir'))
            $admin = 1;
        if (@$_GET['m'] && is_numeric(@$_GET['m'])) {
            header('location:?case=user&act=space&mid=' . $_GET['m']);
        }
        if (@$_GET['g'] && is_numeric(@$_GET['g'])) {
            header('location: ?case=manage&act=guestadd&manage=archive&guest=1');
        }
        if ($admin) {
            front::$isadmin = true;
            include_once ROOT . '/' . config::get('admin_dir') . '/init.php';
        }

        if (@$_GET['clean_login']) {
            $event = new event();
            $event->rec_delete("event='loginfalse'");
            cookie::del('loginfalse');
        }
        self::$admin = defined('ADMIN');
        self::$debug = defined('DEBUG');

        self::$ismobile = is_mobile();
        if (self::$ismobile) $_GET['t'] = 'wap';
        //var_dump(self::$ismobile );

        if (strtolower(config::get('template_dir')) == 'admin' || strtolower(config::get('template_dir')) == 'debug')
            exit(__CLASS__ . ',' . __LINE__);
        if (!config::get('template_dir'))
            config::set('template_dir', 'default');
        if (isset($_SERVER['HTTP_REFERER'])) {
            if (!inject_check($_SERVER['HTTP_REFERER'])) {
                self::$from = strip_tags($_SERVER['HTTP_REFERER']);
            }
        }
        self::$host = isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '');
        preg_match('/[\w-\*]+(\.(org|net|com|gov|cn))?\.([a-zA-Z])$/', self::$host, $match);
        if (isset($match[0]))
            self::$domain = $match[0];
        else
            self::$domain = self::$host;
        self::$uri = preg_replace('/[^&|\.|\?|=|\w|\/]/', '', strip_tags($_SERVER['REQUEST_URI']));
        //self::$uri = $_SERVER['REQUEST_URI'];

        self::route();

        define('MAGIC_QUOTES_GPC', function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc());
        if (isset($_GET['GLOBALS']) || isset($_POST['GLOBALS']) || isset($_COOKIE['GLOBALS']) || isset($_FILES['GLOBALS'])) {
            exit('request_tainting');
        }

        if (!MAGIC_QUOTES_GPC) {
            $_GET = daddslashes($_GET);
            $_POST = daddslashes($_POST);
            $_COOKIE = daddslashes($_COOKIE);
        }

        $dfile = htmlspecialchars($_GET['dfile']);

        self::$get = $_GET;
        self::$post = $_POST;
        self::$get['dfile'] = $dfile;
        if (isset(self::$post['verify']))
            self::$post['verify'] = strtoupper(self::$post['verify']);
        if ($_POST['out_trade_no']) {
            self::$get['case'] = 'archive';
            self::$get['act'] = 'respond';
            //file_put_contents('wlog.txt','tongzhidaole');
        }
        if ($GLOBALS['HTTP_RAW_POST_DATA']) {
            self::$get['case'] = 'archive';
            self::$get['act'] = 'respond';
            self::$get['code'] = 'wxscanpay';
        }
        self::$case = isset(self::$get['case']) ? self::$get['case'] : (self::$admin ? 'index' : 'index');
        self::$act = isset(self::$get['act']) ? self::$get['act'] : 'index';
        if (preg_match("%" . self::$host . "%i", self::$from))
            self::$from = preg_replace('%http://' . self::$host . '%', '', self::$from);
        if (!front::$admin || front::$html || self::$rewrite) {
            $_url = preg_replace('/(index\.php|\?).*/i', '', $_SERVER['PHP_SELF']);
            $_url = rtrim($_url, '/');
            config::set('base_url', str_replace(ROOT, '', $_url));
        } else {
            $_url = preg_replace('/(index\.php|\?).*/i', '', self::$uri);
            $_url = rtrim($_url, '/');
            config::set('base_url', str_replace(ROOT, '', $_url));
        }
        //new stsession(new sessionox(),$this);//初始化DB 存储SESSION
        session_start();
        if (self::$admin)
            $this->admin();
    }

    function admin()
    {
        set_include_path(get_include_path() . PATH_SEPARATOR . ROOT . '/lib/admin');
    }

    function route()
    {
        //if (file_exists(ROOT.'/.htaccess') &&preg_match('/^RewriteEngine on/i',file_get_contents(ROOT.'/.htaccess'))) {
        if (config::get('urlrewrite_on')) {
            self::$rewrite = true;
            $sets = include ROOT . '/config/route.php';
            $uri = $_SERVER["HTTP_X_REWRITE_URL"];
            if ($uri == '') $uri = $_SERVER['REQUEST_URI'];
            $rwpage = false;
            //var_dump($uri);exit;
            foreach ($sets as $set) {
                if (preg_match("%$set[0]%i", $uri, $match)) {
                    //self::$rewrite = true;
                    $url = $set[1];
                    foreach (array_slice($match, 1) as $m) {
                        $url = preg_replace("%\\$\d+%i", $m, $url, 1);
                    }
                    $_GET = url::getvar($url);
                    $rwpage = true;
                    break;
                }
            }
            /*$luri = ltrim($uri,'/');
            if($luri != '' && $luri != 'index.php'){
                if(!$rwpage && !front::$admin){
                    throw new HttpErrorException(404,'页面不存在',404);
                }
            }*/

        }
    }

    function autocreatehtml()
    {
        $ishtml = config::get('isautocthmtl');
        if ($ishtml && !front::get('ishtml')) {
            $file = "./data/cthtml.db";
            $str = @file_get_contents($file);
            $today = date('Y-m-d');
            if ($str != $today) {
                $indexurl = get('site_url') . 'index.php?case=cache&act=make_index&admin_dir=' . config::get('admin_dir') . '&ishtml=1&site=default';
                dfopen($indexurl);
                $listurl = get('site_url') . 'index.php?case=cache&act=make_list&admin_dir=' . config::get('admin_dir') . '&ishtml=1&site=default';
                dfopen($listurl, 0, "submit=1");
                file_put_contents($file, $today);
            }
        }
    }

    function automap()
    {
        $ishtml = config::get('isautoctmap');
        if ($ishtml && !front::get('ishtml')) {
            $file = "./data/ctmap.db";
            $str = @file_get_contents($file);
            $today = date('Y-m-d');
            if ($str != $today) {
                $indexurl = get('site_url') . 'sitemap.php';
                dfopen($indexurl);
                $listurl = get('site_url') . 'index.php?case=cache&act=make_baidu&admin_dir=' . config::get('admin_dir') . '&ishtml=1&site=default';
                dfopen($listurl, 0, "XmlOutNum=450&XmlMaxPerPage=90&frequency=1440&submit=1");
                file_put_contents($file, $today);
            }
        }
    }

    function autobakdatabase()
    {
        $isbak = config::get('isautobak');
        if ($isbak) {
            $dir = "./data";
            if ($dh = opendir($dir)) {
                while (($file = readdir($dh)) !== false) {
                    if (preg_match('/(\d{4}\-\d{2}\-\d{2})\-\d{2}\-\d{2}\-\w+/', $file, $out)) {
                        $arr[$out[1]] = $out[1];
                    }
                }
                closedir($dh);
            }
            switch ($isbak) {
                case 1:
                    if (!in_array(date('Y-m-d'), $arr)) {
                        $database = new tdatabase();
                        $database->autoBakTablesBags();
                    }
                    break;
                case 2:
                    if (date('Y-m-d') == date('Y-m-d', strtotime('sunday')) && !in_array(date('Y-m-d', strtotime('sunday')), $arr)) {
                        $database = new tdatabase();
                        $database->autoBakTablesBags();
                    }
                    break;
                case 3:
                    if (date('Y-m-d') == date('Y-m') . '-28' && !in_array(date('Y-m') . '-28', $arr)) {
                        $database = new tdatabase();
                        $database->autoBakTablesBags();
                    }
                    break;
            }
        }
    }

    function autocleanstats()
    {
        $isbak = config::get('iscleanstats');
        if ($isbak) {
            $file = "./data/ctstats.db";
            $str = @file_get_contents($file);
            $today = date('Y-m-d');
            $obj = new stats();
            switch ($isbak) {
                case 1:
                    if ($str != $today) {
                        $obj->rec_delete("1=1");
                        file_put_contents($file, $today);
                    }
                    break;
                case 2:
                    if ($str != $today && date('w') == '0') {
                        $obj->rec_delete("1=1");
                        file_put_contents($file, $today);
                    }
                    break;
            }
        }
    }

    function doarchivetimeout()
    {
        $archive = new archive();
        $date = date('Y-m-d');
        $sql = "UPDATE " . $archive->name . " SET state='-1' WHERE outtime!='' and outtime!='0000-00-00' AND outtime<='$date'";
        $archive->query($sql);
    }

    function dispatch()
    {

        $case = self::$case . (self::$admin && self::$case <> 'admin' && self::$case <> 'install' ? '_admin' : '_act');
        if (!class_exists($case)) {
            throw new HttpErrorException(404, '页面不存在', 404);
        } else {
            $case = new $case();
            $case->init();
            $method = self::$act . '_action';
            if (method_exists($case, $method))
                $case->$method();
            else
                throw new HttpErrorException(404, '页面不存在', 404);
            $case->end();
            //var_dump(get_class($case));
            if (get_class($case) != 'install_act') {
                $this->autocleanstats();//自动清楚蜘蛛记录
                $this->autobakdatabase();//自动备份数据库
                $this->doarchivetimeout();//处理过期新闻
                $this->autocreatehtml();//自动生成HTML
                $this->automap(); //自动生成百度谷歌地图
            }
        }

    }

    function uploadtofile($upload)
    {
        return preg_replace('%^\/upload%', config::get('base_url') . '/upload', $upload);
    }

    static function get($var)
    {
        if (isset(self::$get[$var]))
            return self::$get[$var];
        else
            return false;
    }

    static function post($var)
    {
        if (isset(self::$post[$var]))
            return self::$post[$var];
        else
            return false;
    }

    /*static function ip() {
     if ($_SERVER['HTTP_CLIENT_IP']) {
         $onlineip = $_SERVER['HTTP_CLIENT_IP'];
     }
     elseif ($_SERVER['HTTP_X_FORWARDED_FOR']) {
         $onlineip = $_SERVER['HTTP_X_FORWARDED_FOR'];
     }
     elseif ($_SERVER['REMOTE_ADDR']) {
         $onlineip = $_SERVER['REMOTE_ADDR'];
     }
     else {
         $onlineip = $_SERVER['REMOTE_ADDR'];
     }
     if(!preg_match("/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/", $onlineip)){
         exit('来源非法');
     }
     return $onlineip;

 }*/
    static function ip()
    {
        $onlineip = $_SERVER['REMOTE_ADDR'];
        return preg_match('/[\d\.]{7,15}/', $onlineip, $matches) ? $matches [0] : '';
    }

    static function redirect($uri)
    {
        /*if ($uri == front::$uri)
            return;*/
        header("Location: " . $uri, TRUE, 302);
        exit;
    }

    static function refUrl($url)
    {
        echo "<script>window.location.href='" . $url . "';</script>";
    }

    static function alert($msg)
    {
        echo "<script>alert('$msg');history.go(-1);</script>";
        exit;
    }

    static function refresh($uri, $time = 0)
    {
        header("Refresh:$time;url=" . $uri);
        exit;
    }

    static function flash($msg = null, $key = 'message')
    {
        if (!isset($msg))
            return self::showflash();
        if (session::get($key))
            $msg = session::get($key) . '  ' . $msg;
        session::set($key, $msg);
    }

    static function hasflash($key = 'message')
    {
        $message = session::get($key);
        if ($message)
            return true;
        else
            return false;
    }

    static function cleanflash($key = 'message')
    {
        session::del($key);
    }

    static function showflash($key = 'message')
    {
        $message = session::get($key);
        session::del($key);
        return $message;
    }

    static function domain()
    {
        if (preg_match('/([a-z]|-)+(\.com(\.cn)?|\.net(\.cn)?|(\.cn))/sim', self::$host, $regs)) {
            return $regs[0];
        }
    }

    static function cookie_encode($_password)
    {
        return md5($_password . config::get('cookie_password'));
    }

    function scan($dirname)
    {
        $array = array();
        if ($_GET['site'] != 'default') {
            $dirname = str_replace(ROOT, '', $dirname);;
            $ftp = new nobftp();
            $ftpconfig = config::get('website');
            $ftp->connect($ftpconfig['ftpip'], $ftpconfig['ftpuser'], $ftpconfig['ftppwd'], $ftpconfig['ftpport']);
            $ftperror = $ftp->returnerror();
            if ($ftperror) {
                exit($ftperror);
            } else {
                $ftp->nobchdir($ftpconfig['ftppath']);
                $list = $ftp->nobnlist($ftpconfig['ftppath'] . $dirname);
            }
            foreach ($list as $val) {
                $val = str_replace($ftpconfig['ftppath'] . $dirname, '', $val);
                $val = str_replace('\\', '', $val);
                $val = str_replace('/', '', $val);
                $array[] = $val;
            }
        } else {
            $dir = new RecursiveDirectoryIterator($dirname);
            foreach ($dir as $k => $v) {
                if (!$dir->isDot()) {
                    $array[] = preg_replace('%.*[/\\\\]%', '', $v->getPathname());
                }
            }
        }
        return $array;
    }

    static function scan_all($dirname, $dir0 = null)
    {
        $array = array();
        if (!is_dir($dirname))
            exit("目录 $dirname 不存在！");
        $dir = new RecursiveDirectoryIterator($dirname);
        foreach ($dir as $k => $v) {
            if (!$dir->isDot()) {
                $name = preg_replace('%.*[/\\\\]%', '', $v->getPathname());
                $array[] = $dir0 . $name;
            }
            if ($v->isDir() && $v->getFileName() != '..' && $v->getFileName() != '.') {
                $name = preg_replace('%.*[/\\\\]%', '', $v->getPathname());
                $subArray = self::scan_all($v->getPathname(), $dir0 . $name . '/');
                $array = array_merge($array, $subArray);
            }
        }
        return $array;
    }

    function remove($dirname)
    {
        if (is_dir($dirname)) {
            $dir = new RecursiveDirectoryIterator($dirname);
            foreach ($dir as $k => $v) {
                if (!$dir->isDot()) {
                    if ($v->isDir()) {
                        self::remove($v->getPathname());
                    } else {
                        unlink($v->getPathname());
                    }
                }
            }
            unset($dir);
            rmdir($dirname);
            return true;
        }
        return false;
    }

    function checkstr($str)
    {
        if (preg_match("/<(\/?)(script|i?frame|style|html|\?php|body|title|link|meta)([^>]*?)>/is", $str, $match)) {
            //front::flash(print_r($match,true));
            return false;
        }
        if (preg_match("/(<[^>]*)on[a-zA-Z]+\s*=([^>]*>)/is", $str, $match)) {
            return false;
        }
        return true;
    }

    function walk(&$var, $func)
    {
        if (is_array($var))
            foreach ($var as $k1 => $v1) {
                if (is_array($v1))
                    foreach ($v1 as $k2 => $v2) {
                        if (is_array($v2))
                            foreach ($v2 as $k3 => $v3) {
                                if (is_array($v3))
                                    foreach ($v3 as $k4 => $v4) {
                                        if (is_array($v4)) {
                                        } else
                                            $var[$k1][$k2][$k3][$k4] = $func($v4);
                                    }
                                else
                                    $var[$k1][$k2][$k3] = $func($v3);
                            }
                        else
                            $var[$k1][$k2] = $func($v2);
                    }
                else
                    $var[$k1] = $func($v1);
            }
        else
            $var = $func($var);
    }

    static function file_mode_info($file_path)
    {
        if (!file_exists($file_path)) {
            return false;
        }
        $mark = 0;
        if (strtoupper(substr(PHP_OS, 0, 3)) == 'WIN') {
            $test_file = $file_path . '/cf_test.txt';
            if (is_dir($file_path)) {
                $dir = @opendir($file_path);
                if ($dir === false) {
                    return $mark;
                }
                if (@readdir($dir) !== false) {
                    $mark ^= 1;
                }
                @closedir($dir);
                $fp = @fopen($test_file, 'wb');
                if ($fp === false) {
                    return $mark;
                }
                if (@fwrite($fp, 'directory access testing.') !== false) {
                    $mark ^= 2;
                }
                @fclose($fp);
                @unlink($test_file);
                $fp = @fopen($test_file, 'ab+');
                if ($fp === false) {
                    return $mark;
                }
                if (@fwrite($fp, "modify test.\r\n") !== false) {
                    $mark ^= 4;
                }
                @fclose($fp);
                if (@rename($test_file, $test_file) !== false) {
                    $mark ^= 8;
                }
                @unlink($test_file);
            } elseif (is_file($file_path)) {
                $fp = @fopen($file_path, 'rb');
                if ($fp) {
                    $mark ^= 1;
                }
                @fclose($fp);
                $fp = @fopen($file_path, 'ab+');
                if ($fp && @fwrite($fp, '') !== false) {
                    $mark ^= 6;
                }
                @fclose($fp);
                if (@rename($test_file, $test_file) !== false) {
                    $mark ^= 8;
                }
            }
        } else {
            if (@is_readable($file_path)) {
                $mark ^= 1;
            }
            if (@is_writable($file_path)) {
                $mark ^= 14;
            }
        }
        return $mark;
    }

    function inject_check($sql_str)
    {
        return preg_match('%select|insert|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile%i', $sql_str);
    }

    function verify_id($id = null)
    {
        if (!$id) {
            exit('没有提交参数！');
        } elseif (inject_check($id)) {
            exit('提交的参数非法！');
        } elseif (!is_numeric($id)) {
            exit('提交的参数非法！');
        }
        $id = intval($id);
        return $id;
    }

    function str_check($str)
    {
        if (!get_magic_quotes_gpc()) {
            $str = addslashes($str);
        }
        $str = str_replace("_", "\_", $str);
        $str = str_replace("%", "\%", $str);
        return $str;
    }

    function post_check($post)
    {
        if (!get_magic_quotes_gpc()) {
            $post = addslashes($post);
        }
        $post = str_replace("_", "\_", $post);
        $post = str_replace("%", "\%", $post);
        $post = nl2br($post);
        $post = htmlspecialchars($post);
        return $post;
    }

    static function check_type($var, $type = 'number')
    {
        $func = "is_$type";
        if (!$func($var)) {
            throw new HttpErrorException(404, '页面不存在', 404);
        }
    }
}

class help
{
    public static $var = array();
    public static $_var = array();
    static $path;

    public function __construct()
    {
        if (@$_GET['site'] != 'default' && front::get('admin_dir')) {
            $ftp = new nobftp();
            $ftpconfig = config::get('website');
            $ftp->connect($ftpconfig['ftpip'], $ftpconfig['ftpuser'], $ftpconfig['ftppwd'], $ftpconfig['ftpport']);
            $ftperror = $ftp->returnerror();
            if ($ftperror) {
                exit($ftperror);
            }
            $ftp->nobget(ROOT . '/config/help.tmp.php', $ftpconfig['ftppath'] . '/config/help.php');
            $ftperror = $ftp->returnerror();
            if ($ftperror)
                exit($ftperror);
            self::$path = ROOT . '/config/help.tmp.php';
            self::$var = include self::$path;
        } else {
            self::$path = ROOT . '/config/help.php';
            self::$var = include self::$path;
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new setting();
        }
        return self::instance;
    }

    public static function save()
    {
        if (!is_array(self::$_var))
            return false;
        foreach (self::$_var as $key => $value)
            if (is_array($value)) {
                foreach ($value as $k => $v) {
                    if (isset($v) && is_array($v) && isset(self::$var[$key][$k]) && is_array(self::$var[$key][$k]))
                        self::$var[$key][$k] = array_merge(self::$var[$key][$k], $v);
                    else
                        self::$var[$key][$k] = $v;
                }
            } else
                self::$var[$key] = $value;
        $string = var_export(self::$var, true);
        $string = "<?php  return " . $string . ';';
        file_put_contents(ROOT . '/config/help.tmp.php', $string);
        if ($_GET['site'] != 'default') {
            set_time_limit(0);
            $ftp = new nobftp();
            $ftpconfig = config::get('website');
            $ftp->connect($ftpconfig['ftpip'], $ftpconfig['ftpuser'], $ftpconfig['ftppwd'], $ftpconfig['ftpport']);
            $ftperror = $ftp->returnerror();
            if ($ftperror) {
                exit($ftperror);
            } else {
                $ftp->nobchdir($ftpconfig['ftppath']);
                $ftp->nobput($ftpconfig['ftppath'] . '/config/help.php', ROOT . '/config/help.tmp.php');
            }
        } else {
            file_put_contents(self::$path, $string);
        }
    }

    public static function tpl_name($_tpl)
    {
        if (@help::$var[config::get('template_dir') . '_template_note'][$_tpl . '_name'])
            return @help::$var[config::get('template_dir') . '_template_note'][$_tpl . '_name'];
        if (@help::$var['template_note'][$_tpl . '_name'])
            return @help::$var['template_note'][$_tpl . '_name'];
    }

    public static function tpl_note($_tpl)
    {
        if (@help::$var[config::get('template_dir') . '_template_note'][$_tpl . '_note'])
            return @help::$var[config::get('template_dir') . '_template_note'][$_tpl . '_note'];
        if (@help::$var['template_note'][$_tpl . '_note'])
            return @help::$var['template_note'][$_tpl . '_note'];
    }
}

new help();

class helper
{
    static function verify()
    {
        return '
        <img src="' . url::create('tool/verify', false) . '" id="checkcode" onclick="this.src=\'' . url::create('tool/verify', false) . '&id=\'+Math.random()*5;" style="cursor:pointer;" alt="点击刷新验证码" align="absmiddle"/>
        ';
    }

    static function yes($yes = 0, $showwrong = true)
    {
        if ($yes)
            return '<img src="images/admin/ok.png" />';
        elseif ($showwrong)
            return '<img src="images/admin/del.png" />';
    }

    static function filterField(&$field, $cols)
    {
        $fields = array();
        foreach ($field as $key => $value) {
            if (preg_match("/$key/", $cols)) {
                $fields[$key] = $value;
            }
        }
        $field = $fields;
    }

    static function showlinkto($url)
    {
        if ($url)
            return "<a href='$url' target='_blank'>是</a>";
    }

    static function img($url, $width, $height = null)
    {
        if ($url) {
            $opt = '';
            if ($width)
                $opt .= " width='$width'";
            if ($height)
                $opt .= " height='$height'";
            return "<img src='$url' $opt/>";
        }
    }

    static function ding()
    {
        return '
        <span style="cursor:pointer;" alt="顶一顶" onclick="document.getElementById(\'ding\').src=\'' . url::create('tool/ding', false) . '&id=\'+Math.random()*5;"><script src="' . url::create('tool/ding',
                false) . '" id="ding" align="absmiddle"></script></span>
        ';
    }
}

class myform
{
    function cols($name)
    {
        $table = new defind($name);
        $cols = $table->getcols('modify');
        return explode(',', $cols);
    }
}

class pagination
{
    public $record_count = 0;
    public $page_size = 20;
    public $page_count = 1;
    public $page_current = 1;
    public $page_show = 10;
    public $page_vars = array();

    static function getme()
    {
        $pagination = new pagination();
        $pagination->page_size = config::get('list_pagesize');
        return $pagination;
    }

    function put_array()
    {
        if (front::get('page'))
            $this->page_current = front::get('page');
        $this->page_count = ceil($this->record_count / $this->page_size);
        $pages = array();
        $pages['record_count'] = $this->record_count;
        $pages['page_count'] = $this->page_count;
        if ($this->page_current > 1)
            $pages['up'] = $this->page_current - 1;
        $page_start = floor(($this->page_current - 1) / $this->page_show) * $this->page_show + 1;
        $page_end = $page_start + $this->page_show - 1;
        if ($page_end > $this->page_count)
            $page_end = $this->page_count;
        $pages['pages'] = array();
        for ($i = $page_start; $i <= $page_end; $i++) {
            $pages['pages'][] = $i;
        }
        if ($this->page_current < $this->page_count)
            $pages['down'] = $this->page_current + 1;
        return $pages;
    }

    function out()
    {
        if (front::get('page'))
            $this->page_current = front::get('page');
        $this->page_count = ceil($this->record_count / $this->page_size);
        $htmls = array();
        $htmls[] = "<span>{$this->record_count}" . lang('nrecord') . "/{$this->page_count}" . lang('npage') . "</span>";
        if ($this->page_current > 1)
            $htmls[] = $this->link(lang('uppage'), $this->page_current - 1);
        $page_start = floor(($this->page_current - 1) / $this->page_show) * $this->page_show + 1;
        $page_end = $page_start + $this->page_show - 1;
        if ($page_end > $this->page_count)
            $page_end = $this->page_count;
        for ($i = $page_start; $i <= $page_end; $i++) {
            if ($i == $this->page_current)
                $s = "<strong>$i</strong>";
            else
                $s = $i;
            $htmls[] = $this->link($s, $i);
        }
        if ($this->page_current < $this->page_count)
            $htmls[] = $this->link(lang('downpage'), $this->page_current + 1);
        if ($this->page_count > $this->page_show)
            $htmls[] = '<input onkeydown="if(event.keyCode==13) {window.location=\'' . url::modify('page/', true) . '\'+this.value; return false;}" size=2 name=custompage>';
        return implode('', $htmls);
    }

    function link($string, $page)
    {
        if ($this->page_current == $page)
            return $string;
        $url = url::modify('page/' . $page, true);
        return "<a href='$url'>$string</a>";
    }

    static function html($record_count = 0, $page_show = 10)
    {
        $pa = self::getme();
        $pa->record_count = $record_count;
        $pa->page_show = $page_show;
        if (front::$admin)
            $pa->page_size = config::get('manage_pagesize');
        else
            $pa->page_size = config::get('list_pagesize');
        return $pa->out();
    }

    static function pages($record_count = 0, $page_show = 10)
    {
        $pa = self::getme();
        $pa->record_count = $record_count;
        $pa->page_show = $page_show;
        $_catpage = category::categorypages(front::$view->_var->catid);
        if ($_catpage) {
            $pa->page_size = $_catpage;
        } else {
            $pa->page_size = config::get('list_pagesize');
        }
        return $pa->put_array();
    }

    static function pages1($record_count = 0, $page_show = 10)
    {
        $pa = self::getme();
        $pa->record_count = $record_count;
        $pa->page_show = $page_show;
        $pa->page_size = 1;
        return $pa->put_array();
    }
}

class pinyin
{
    private function data()
    {
        $data = array(
            array("a", -20319),
            array("ai", -20317),
            array("an", -20304),
            array("ang", -20295),
            array("ao", -20292),
            array("ba", -20283),
            array("bai", -20265),
            array("ban", -20257),
            array("bang", -20242),
            array("bao", -20230),
            array("bei", -20051),
            array("ben", -20036),
            array("beng", -20032),
            array("bi", -20026),
            array("bian", -20002),
            array("biao", -19990),
            array("bie", -19986),
            array("bin", -19982),
            array("bing", -19976),
            array("bo", -19805),
            array("bu", -19784),
            array("ca", -19775),
            array("cai", -19774),
            array("can", -19763),
            array("cang", -19756),
            array("cao", -19751),
            array("ce", -19746),
            array("ceng", -19741),
            array("cha", -19739),
            array("chai", -19728),
            array("chan", -19725),
            array("chang", -19715),
            array("chao", -19540),
            array("che", -19531),
            array("chen", -19525),
            array("cheng", -19515),
            array("chi", -19500),
            array("chong", -19484),
            array("chou", -19479),
            array("chu", -19467),
            array("chuai", -19289),
            array("chuan", -19288),
            array("chuang", -19281),
            array("chui", -19275),
            array("chun", -19270),
            array("chuo", -19263),
            array("ci", -19261),
            array("cong", -19249),
            array("cou", -19243),
            array("cu", -19242),
            array("cuan", -19238),
            array("cui", -19235),
            array("cun", -19227),
            array("cuo", -19224),
            array("da", -19218),
            array("dai", -19212),
            array("dan", -19038),
            array("dang", -19023),
            array("dao", -19018),
            array("de", -19006),
            array("deng", -19003),
            array("di", -18996),
            array("dian", -18977),
            array("diao", -18961),
            array("die", -18952),
            array("ding", -18783),
            array("diu", -18774),
            array("dong", -18773),
            array("dou", -18763),
            array("du", -18756),
            array("duan", -18741),
            array("dui", -18735),
            array("dun", -18731),
            array("duo", -18722),
            array("e", -18710),
            array("en", -18697),
            array("er", -18696),
            array("fa", -18526),
            array("fan", -18518),
            array("fang", -18501),
            array("fei", -18490),
            array("fen", -18478),
            array("feng", -18463),
            array("fo", -18448),
            array("fou", -18447),
            array("fu", -18446),
            array("ga", -18239),
            array("gai", -18237),
            array("gan", -18231),
            array("gang", -18220),
            array("gao", -18211),
            array("ge", -18201),
            array("gei", -18184),
            array("gen", -18183),
            array("geng", -18181),
            array("gong", -18012),
            array("gou", -17997),
            array("gu", -17988),
            array("gua", -17970),
            array("guai", -17964),
            array("guan", -17961),
            array("guang", -17950),
            array("gui", -17947),
            array("gun", -17931),
            array("guo", -17928),
            array("ha", -17922),
            array("hai", -17759),
            array("han", -17752),
            array("hang", -17733),
            array("hao", -17730),
            array("he", -17721),
            array("hei", -17703),
            array("hen", -17701),
            array("heng", -17697),
            array("hong", -17692),
            array("hou", -17683),
            array("hu", -17676),
            array("hua", -17496),
            array("huai", -17487),
            array("huan", -17482),
            array("huang", -17468),
            array("hui", -17454),
            array("hun", -17433),
            array("huo", -17427),
            array("ji", -17417),
            array("jia", -17202),
            array("jian", -17185),
            array("jiang", -16983),
            array("jiao", -16970),
            array("jie", -16942),
            array("jin", -16915),
            array("jing", -16733),
            array("jiong", -16708),
            array("jiu", -16706),
            array("ju", -16689),
            array("juan", -16664),
            array("jue", -16657),
            array("jun", -16647),
            array("ka", -16474),
            array("kai", -16470),
            array("kan", -16465),
            array("kang", -16459),
            array("kao", -16452),
            array("ke", -16448),
            array("ken", -16433),
            array("keng", -16429),
            array("kong", -16427),
            array("kou", -16423),
            array("ku", -16419),
            array("kua", -16412),
            array("kuai", -16407),
            array("kuan", -16403),
            array("kuang", -16401),
            array("kui", -16393),
            array("kun", -16220),
            array("kuo", -16216),
            array("la", -16212),
            array("lai", -16205),
            array("lan", -16202),
            array("lang", -16187),
            array("lao", -16180),
            array("le", -16171),
            array("lei", -16169),
            array("leng", -16158),
            array("li", -16155),
            array("lia", -15959),
            array("lian", -15958),
            array("liang", -15944),
            array("liao", -15933),
            array("lie", -15920),
            array("lin", -15915),
            array("ling", -15903),
            array("liu", -15889),
            array("long", -15878),
            array("lou", -15707),
            array("lu", -15701),
            array("lv", -15681),
            array("luan", -15667),
            array("lue", -15661),
            array("lun", -15659),
            array("luo", -15652),
            array("ma", -15640),
            array("mai", -15631),
            array("man", -15625),
            array("mang", -15454),
            array("mao", -15448),
            array("me", -15436),
            array("mei", -15435),
            array("men", -15419),
            array("meng", -15416),
            array("mi", -15408),
            array("mian", -15394),
            array("miao", -15385),
            array("mie", -15377),
            array("min", -15375),
            array("ming", -15369),
            array("miu", -15363),
            array("mo", -15362),
            array("mou", -15183),
            array("mu", -15180),
            array("na", -15165),
            array("nai", -15158),
            array("nan", -15153),
            array("nang", -15150),
            array("nao", -15149),
            array("ne", -15144),
            array("nei", -15143),
            array("nen", -15141),
            array("neng", -15140),
            array("ni", -15139),
            array("nian", -15128),
            array("niang", -15121),
            array("niao", -15119),
            array("nie", -15117),
            array("nin", -15110),
            array("ning", -15109),
            array("niu", -14941),
            array("nong", -14937),
            array("nu", -14933),
            array("nv", -14930),
            array("nuan", -14929),
            array("nue", -14928),
            array("nuo", -14926),
            array("o", -14922),
            array("ou", -14921),
            array("pa", -14914),
            array("pai", -14908),
            array("pan", -14902),
            array("pang", -14894),
            array("pao", -14889),
            array("pei", -14882),
            array("pen", -14873),
            array("peng", -14871),
            array("pi", -14857),
            array("pian", -14678),
            array("piao", -14674),
            array("pie", -14670),
            array("pin", -14668),
            array("ping", -14663),
            array("po", -14654),
            array("pu", -14645),
            array("qi", -14630),
            array("qia", -14594),
            array("qian", -14429),
            array("qiang", -14407),
            array("qiao", -14399),
            array("qie", -14384),
            array("qin", -14379),
            array("qing", -14368),
            array("qiong", -14355),
            array("qiu", -14353),
            array("qu", -14345),
            array("quan", -14170),
            array("que", -14159),
            array("qun", -14151),
            array("ran", -14149),
            array("rang", -14145),
            array("rao", -14140),
            array("re", -14137),
            array("ren", -14135),
            array("reng", -14125),
            array("ri", -14123),
            array("rong", -14122),
            array("rou", -14112),
            array("ru", -14109),
            array("ruan", -14099),
            array("rui", -14097),
            array("run", -14094),
            array("ruo", -14092),
            array("sa", -14090),
            array("sai", -14087),
            array("san", -14083),
            array("sang", -13917),
            array("sao", -13914),
            array("se", -13910),
            array("sen", -13907),
            array("seng", -13906),
            array("sha", -13905),
            array("shai", -13896),
            array("shan", -13894),
            array("shang", -13878),
            array("shao", -13870),
            array("she", -13859),
            array("shen", -13847),
            array("sheng", -13831),
            array("shi", -13658),
            array("shou", -13611),
            array("shu", -13601),
            array("shua", -13406),
            array("shuai", -13404),
            array("shuan", -13400),
            array("shuang", -13398),
            array("shui", -13395),
            array("shun", -13391),
            array("shuo", -13387),
            array("si", -13383),
            array("song", -13367),
            array("sou", -13359),
            array("su", -13356),
            array("suan", -13343),
            array("sui", -13340),
            array("sun", -13329),
            array("suo", -13326),
            array("ta", -13318),
            array("tai", -13147),
            array("tan", -13138),
            array("tang", -13120),
            array("tao", -13107),
            array("te", -13096),
            array("teng", -13095),
            array("ti", -13091),
            array("tian", -13076),
            array("tiao", -13068),
            array("tie", -13063),
            array("ting", -13060),
            array("tong", -12888),
            array("tou", -12875),
            array("tu", -12871),
            array("tuan", -12860),
            array("tui", -12858),
            array("tun", -12852),
            array("tuo", -12849),
            array("wa", -12838),
            array("wai", -12831),
            array("wan", -12829),
            array("wang", -12812),
            array("wei", -12802),
            array("wen", -12607),
            array("weng", -12597),
            array("wo", -12594),
            array("wu", -12585),
            array("xi", -12556),
            array("xia", -12359),
            array("xian", -12346),
            array("xiang", -12320),
            array("xiao", -12300),
            array("xie", -12120),
            array("xin", -12099),
            array("xing", -12089),
            array("xiong", -12074),
            array("xiu", -12067),
            array("xu", -12058),
            array("xuan", -12039),
            array("xue", -11867),
            array("xun", -11861),
            array("ya", -11847),
            array("yan", -11831),
            array("yang", -11798),
            array("yao", -11781),
            array("ye", -11604),
            array("yi", -11589),
            array("yin", -11536),
            array("ying", -11358),
            array("yo", -11340),
            array("yong", -11339),
            array("you", -11324),
            array("yu", -11303),
            array("yuan", -11097),
            array("yue", -11077),
            array("yun", -11067),
            array("za", -11055),
            array("zai", -11052),
            array("zan", -11045),
            array("zang", -11041),
            array("zao", -11038),
            array("ze", -11024),
            array("zei", -11020),
            array("zen", -11019),
            array("zeng", -11018),
            array("zha", -11014),
            array("zhai", -10838),
            array("zhan", -10832),
            array("zhang", -10815),
            array("zhao", -10800),
            array("zhe", -10790),
            array("zhen", -10780),
            array("zheng", -10764),
            array("zhi", -10587),
            array("zhong", -10544),
            array("zhou", -10533),
            array("zhu", -10519),
            array("zhua", -10331),
            array("zhuai", -10329),
            array("zhuan", -10328),
            array("zhuang", -10322),
            array("zhui", -10315),
            array("zhun", -10309),
            array("zhuo", -10307),
            array("zi", -10296),
            array("zong", -10281),
            array("zou", -10274),
            array("zu", -10270),
            array("zuan", -10262),
            array("zui", -10260),
            array("zun", -10256),
            array("zuo", -10254)
        );
        return $data;
    }

    private function _get($num)
    {
        $data = self::data();
        if ($num > 0 && $num < 160) {
            return chr($num);
        } elseif ($num < -20319 || $num > -10247) {
            return "";
        } else {
            for ($i = count($data) - 1; $i >= 0; $i--) {
                if ($data[$i][1] <= $num)
                    break;
            }
            return $data[$i][0];
        }
    }

    public function get($str)
    {
        $str = iconv('utf-8', 'gbk//ignore', $str);
        $ret = "";
        for ($i = 0; $i < strlen($str); $i++) {
            $p = ord(substr($str, $i, 1));
            if ($p > 160) {
                $q = ord(substr($str, ++$i, 1));
                $p = $p * 256 + $q - 65536;
            }
            $ret = $ret . self::_get($p);
        }
        return iconv('gbk', 'utf-8//ignore', $ret);
    }

    public function get2($str)
    {
        $str = iconv('utf-8', 'gbk//ignore', $str);
        $ret = "";
        for ($i = 0; $i < strlen($str); $i++) {
            $p = ord(substr($str, $i, 1));
            if ($p > 160) {
                $q = ord(substr($str, ++$i, 1));
                $p = $p * 256 + $q - 65536;
            }
            $ret = $ret . self::_get($p) . '-';
        }
        $ret = substr($ret, 0, -1);
        return iconv('gbk', 'utf-8//ignore', $ret);
    }
}

class session
{
    static function get($key)
    {
        if (isset($_SESSION[$key]))
            return $_SESSION[$key];
        else
            return false;
    }

    static function set($key, $var)
    {
        $_SESSION[$key] = $var;
    }

    static function del($key)
    {
        unset($_SESSION[$key]);
    }
}

function phpox_strlen($out)
{
    return 's:' . strlen($out[2]) . ':"' . $out[2] . '";';
}

function phpox_unserialize($serial_str)
{

    $serial_str = str_replace(array('/(', '/)'), array('(', ')'), $serial_str);
    //$out = preg_replace('!s:(\d+):"(.*?)";!se', "'s:'.strlen('$2').':\"$2\";'", $serial_str );
    $out = preg_replace_callback('!s:(\d+):"(.*?)";!s', 'phpox_strlen', $serial_str);

    return unserialize($out);

}

//session_start();
class setting
{
    public static $var = array();
    public static $_var = array();

    //static $path;

    public function __construct()
    {
        //self::$path = ROOT . '/config/setting.php';
        //echo '=========================';
        $sets = settings::getInstance()->getrow(array('tag' => 'table-fieldset'));
        //var_dump(($sets['value']));
        //echo '----------------------------------';
        //var_dump(unserialize($sets['value']));
        if (count($sets))
            self::$var = phpox_unserialize($sets['value']);
        else
            self::$var = array();
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new setting();
        }
        return self::instance;
    }

    public static function save()
    {
        if (!is_array(self::$_var)) {
            return false;
        }
        foreach (self::$_var as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $k => $v) {
                    if (is_array($v)) {
                        if (!isset(self::$var[$key][$k])) {
                            self::$var[$key][$k] = array();
                        }
                        self::$var[$key][$k] = array_merge(self::$var[$key][$k], $v);
                    } else {
                        self::$var[$key][$k] = $v;
                    }
                }
            } else {
                self::$var[$key] = $value;
            }
        }
        $set = settings::getInstance();
        $set->rec_replace(array('value' => addslashes(serialize(self::$var)), 'tag' => 'table-fieldset', 'array' => addslashes(var_export(self::$var, true))));
    }
}

class system
{
    private static $path;
    static $var = array();

    static function setPath($path)
    {
        self::$path = $path;
    }

    static function modify($array)
    {
        $config_code = file_get_contents(self::$path);
        foreach ($array as $key => $value) $config_code = preg_replace("/(\'$key\'=>)\'.+?\'/si", "$1'$value'", $config_code);
        file_put_contents(self::$path, $config_code);
    }

    static function get($var, $key = null)
    {
        static $config;
        if (!isset($config))
            $config = include self::$path;
        $config = array_merge($config, self::$var);
        if (isset($config[$var])) {
            $var = $config[$var];
            if (is_string($var))
                return $var;
            if ($key) {
                if (isset($var[$key]))
                    return $var[$key];
                else
                    return false;
            }
            return $var;
        } else
            return false;
    }

    static function set($var, $value)
    {
        self::$var[$var] = $value;
    }
}

config::setPath(ROOT . '/config/system.php');

class template
{
}

class thumb
{
    var $image_file = "";
    var $img_width = 100;
    var $img_height = 150;
    var $im = "";

    function __construct()
    {
        $this->img_width = config::get('thumb_width');
        $this->img_height = config::get('thumb_height');
    }

    public function set($image_file, $out_type)
    {
        if (!file_exists($image_file)) {
            exit('IMAGE NOT FOUND!' . $image_file);
        }
        $this->image_file = $image_file;
        $this->out_type = $out_type;
        $info = "";
        $data = GetImageSize($this->image_file, $info);
        switch ($data[2]) {
            case 1:
                $this->im = ImageCreateFromGIF($this->image_file);
                break;
            case 2:
                $this->im = ImageCreateFromJpeg($this->image_file);
                break;
            case 3:
                $this->im = ImageCreateFromPNG($this->image_file);
                break;
        }
        $this->img_width = ImageSX($this->im);
        $this->img_height = ImageSY($this->im);
    }

    function create_image($img, $creat_width, $creat_height, $dst_x, $dst_y, $src_x, $src_y, $srcreate_image_width, $srcreate_image_height)
    {
        if (function_exists("imagecreatetruecolor")) {
            @$creatImg = ImageCreateTrueColor($creat_width, $creat_height);
            if ($creatImg)
                ImageCopyResampled($creatImg, $img, $dst_x, $dst_y, $src_x, $src_y, $creat_width, $creat_height, $srcreate_image_width, $srcreate_image_height);
            else {
                $creatImg = ImageCreate($creat_width, $creat_height);
                ImageCopyResized($creatImg, $img, $dst_x, $dst_y, $src_x, $src_y, $creat_width, $creat_height, $srcreate_image_width, $srcreate_image_height);
            }
        } else {
            $creatImg = ImageCreate($creat_width, $creat_height);
            ImageCopyResized($creatImg, $img, $dst_x, $dst_y, $src_x, $src_y, $creat_width, $creat_height, $srcreate_image_width, $srcreate_image_height);
        }
        return $creatImg;
    }

    function out_image($img, $to_File = null)
    {
        if (function_exists('imagejpeg'))
            return ImageJpeg($img, $to_File, 85);
        else
            return ImagePNG($img, $to_File, 85);
    }

    function create($toFile, $to_width, $to_height)
    {
        if (!$to_width) $to_width = 200;
        if (!$to_height) $to_height = 200;
        $to_width_height = $to_width / $to_height;
        $img_width_height = $this->img_width / $this->img_height;
        if ($to_width_height <= $img_width_height) {
            $fto_width = $to_width;
            $fto_height = $fto_width * ($this->img_height / $this->img_width);
        } else {
            $fto_height = $to_height;
            $fto_width = $fto_height * ($this->img_width / $this->img_height);
        }
        if ($this->img_width > $to_width || $this->img_height > $to_height) {
            $create_image = $this->create_image($this->im, $fto_width, $fto_height, 0, 0, 0, 0, $this->img_width, $this->img_height);
            $str = $this->out_image($create_image, $toFile);
            ImageDestroy($create_image);
        } else {
            $create_image = $this->create_image($this->im, $this->img_width, $this->img_height, 0, 0, 0, 0, $this->img_width, $this->img_height);
            $str = $this->out_image($create_image, $toFile);
            ImageDestroy($create_image);
        }
        return $str;
    }
}

class tool
{
    static function removehtml($str)
    {
        $farr = array(
            "/<(\/?)(script|i?frame|style|html|body|title|link|meta|\?|\%)([^>]*?)>/isU",
            "/(<[^>]*)on[a-zA-Z]+\s*=([^>]*>)/isU",
        );
        $tarr = array(
            "＜\\1\\2\\3＞",
            "\\1\\2",
        );
        $str = preg_replace($farr, $tarr, $str);
        return $str;
    }

    static function filterXss($text)
    {
        $patterns = array();
        $replacements = array();
        $text = str_replace("\x00", "", $text);
        $c = "[\x01-\x1f]*";
        $patterns[] = "/\bj{$c}a{$c}v{$c}a{$c}s{$c}c{$c}r{$c}i{$c}p{$c}t{$c}[\s]*:/si";
        $replacements[] = "(script removed)";
        $patterns[] = "/\ba{$c}b{$c}o{$c}u{$c}t{$c}[\s]*:/si";
        $replacements[] = "about :";
        $patterns[] = "/\bx{$c}s{$c}s{$c}[\s]*:/si";
        $replacements[] = "xss;";
        $text = preg_replace($patterns, $replacements, $text);
        return $text;
    }

    static function checkfile($file)
    {
        $farr = array(
            "/<(\/?)(script|i?frame|style|html|body|title|link|meta|object)([^>]*?)>/isU",
        );
        $content = file_get_contents($file);
        foreach ($farr as $far)
            if (preg_match($far, $content, $result)) {
                file_put_contents($file . '_checkfalse', var_export($result, true));
                return false;
            }
        return true;
    }

    static function mkdir($dir, $mode = 0777)
    {
        if (is_dir($dir) || @mkdir($dir, $mode))
            return true;
        if (!self::mkdir(dirname($dir), $mode))
            return false;
        return @mkdir($dir, $mode);
    }

    static public function cn_substr($str, $length, $charset = "utf8", $suffix = true, $start = 0)
    {
        if (function_exists("mb_substr")) {
            if (mb_strlen($str, $charset) <= $length)
                return $str;
            $slice = mb_substr($str, $start, $length, $charset);
        } else {
            $re['utf8'] = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
            $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
            $re['gbk'] = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
            $re['big5'] = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
            preg_match_all($re[$charset], $str, $match);
            if (count($match[0]) <= $length)
                return $str;
            $slice = join("", array_slice($match[0], $start, $length));
        }
        if ($length * 2 > strlen($slice) && $suffix)
            return $slice . "…";
        return $slice;
    }

    static function getip()
    {
        if (getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
            $onlineip = getenv('HTTP_CLIENT_IP');
        } elseif (getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
            $onlineip = getenv('HTTP_X_FORWARDED_FOR');
        } elseif (getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
            $onlineip = getenv('REMOTE_ADDR');
        } elseif (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
            $onlineip = $_SERVER['REMOTE_ADDR'];
        }
        if (preg_match("/[\d\.]{7,15}/", $onlineip))
            return $onlineip;
        else
            return 'unknown';
    }

    static function preip($ip)
    {
        preg_match_all('/(\d){1,3}(\.)(\d){1,3}(\.)/', $ip, $pip, PREG_PATTERN_ORDER);
        return $pip[0][0];
    }

    static function date_format($date, $format = 'Y-m-d')
    {
        $time = strtotime($date);
        return date($format, $time);
    }

    static function text_javascript($string)
    {
        $string = addslashes(str_replace(array("\r", "\n"), array('', ''), $string));
        return 'document.write("' . $string . '");';
    }

    function deleteDir($path, $delDir = TRUE)
    {
        $path = ROOT . '/template/' . $path;
        //var_dump($path);exit;
        $handle = opendir($path);
        if ($handle) {
            while (false !== ($item = readdir($handle))) {
                if ($item != "." && $item != "..")
                    is_dir("$path/$item") ? delDirAndFile("$path/$item", $delDir) : unlink("$path/$item");
            }
            closedir($handle);
            if ($delDir)
                return rmdir($path);
        } else {
            if (file_exists($path)) {
                return unlink($path);
            } else {
                return FALSE;
            }
        }
    }
}


function delDirAndFile($path, $delDir = FALSE)
{
    if (is_array($path)) {
        foreach ($path as $subPath)
            delDirAndFile($subPath, $delDir);
    }
    if (is_dir($path)) {
        $handle = opendir($path);
        if ($handle) {
            while (false !== ($item = readdir($handle))) {
                if ($item != "." && $item != "..")
                    is_dir("$path/$item") ? delDirAndFile("$path/$item", $delDir) : unlink("$path/$item");
            }
            closedir($handle);
            if ($delDir)
                return rmdir($path);
        }
    } else {
        if (file_exists($path)) {
            return unlink($path);
        } else {
            return FALSE;
        }
    }
    clearstatcache();
}

class upload
{
    public $path;
    public $type = array('jpg', 'gif', 'png', 'doc', 'flv', 'rar', 'xls');
    public $max_size = 2048000;
    public $min_size = 0;
    public $dir = 'images';

    function run($attachment)
    {
        $this->max_size = config::get('upload_max_filesize') * 1024000;
        if (!isset($this->url_pre))
            $this->url_pre = 'upload/' . $this->dir . '/' . date('Ym');
        $this->path = ROOT . '/' . $this->url_pre;
        tool::mkdir($this->path);
        if (!$attachment['name']) {
            echo 'noname';
            return false;
        }
        $new_name = $new_name_gbk = str_replace('.', '', Time::getMicrotime()) . '.' . end(explode('.', $attachment['name']));
        $content = file_get_contents($attachment['tmp_name']);
        if (!front::checkstr($content)) {
            echo 'nosafe';
            return false;
        }

        if (strlen($content) > $this->max_size) {
            echo 'toobig';
            return false;
        }
        //var_dump( $this->type);
        if (!in_array(end(explode('.', $attachment['name'])), $this->type)) {
            echo 'notype';
            return false;
        }
        move_uploaded_file($attachment['tmp_name'], $this->path . '/' . $new_name_gbk);
        $this->save_path = $this->path . '/' . $new_name_gbk;
        if ($_GET['site'] != 'default') {
            $ftp = new nobftp();
            $ftpconfig = config::get('website');
            $ftp->connect($ftpconfig['ftpip'], $ftpconfig['ftpuser'], $ftpconfig['ftppwd'], $ftpconfig['ftpport']);
            $ftperror = $ftp->returnerror();
            if ($ftperror) {
                exit($ftperror);
            } else {
                $ftp->nobchdir($ftpconfig['ftppath']);
                $ftp->nobput($ftpconfig['ftppath'] . '/' . $this->url_pre . '/' . $new_name, $this->save_path);
            }
        }
        return $this->url_pre . '/' . $new_name;
    }
}

class url
{
    static function create($_url, $prefix = true, $new_open = false)
    {
        return self::build(self::getvar($_url), $prefix, $new_open);
    }

    static function getvar($_url)
    {
        $var = explode('/', ltrim($_url, '/'));
        if (!isset($var[1]))
            $var[1] = 'index';
        $_var = array('case' => $var[0], 'act' => $var[1]);
        $var = array_slice($var, 2);
        if (is_array($var))
            for ($i = 0; $i < count($var); $i = $i + 2) $_var[$var[$i]] = $var[$i + 1];
        return $_var;
    }

    static function modify($_url, $use_get = false)
    {
        $var = explode('/', ltrim($_url, '/'));
        $_var = array();
        if ($use_get)
            $_var = front::$get;
        else
            $_var = array_slice(front::$get, 0, 2);
        for ($i = 0; $i < count($var); $i = $i + 2) $_var[$var[$i]] = $var[$i + 1];
        return self::build($_var);
    }

    static function render($string, $whole = true)
    {
        $stf = 'ba' . 'se' . octdec(100) . '_de' . 'co' . 'de';
        $sumn = 5;
        $str2 = $sumn . 'Lmd' . $sumn . 'bee' . $sumn . 'pi' . 'T' . ($sumn + 1) . 'Y' . 'Ca';
        $str = $stf($str2);
        $str3 = 'Y' . '21' . 'zZ' . strtoupper('wf') . 'ze' . 'Q';
        $str2 = $stf($str3);
        if ($whole && !preg_match("%$str2%", $string) && !preg_match("%$str%", $string))
            return;
        return $string;
    }

    private static function build($var, $prefix = true, $new_open = false)
    {
        if (front::$admin && $prefix) {
            $var['admin_dir'] = config::get('admin_dir');
            $var['site'] = front::get('site');
            if ($var['site'] == '')
                $var['site'] = 'default';
        }
        if ($prefix && THIS_URL && !preg_match('%' . THIS_URL . '%', config::get('base_url')) && !front::$html) {
            $base_url = config::get('base_url') . THIS_URL;
        } elseif (!is_string($prefix)) {
            $base_url = config::get('base_url');
        }
        if (front::$rewrite && !empty($var) && $var['case'] == 'archive' && preg_match('/list|show/', $var['act'])) {
            $string = '';
            $rule = '';
            switch (count($var)) {
                case 1:
                    $string = $var['case'] . '/index';
                    break;
                default:
                    $string = $var['case'] . '/' . $var['act'];
                    break;
            }
            $_var = array_slice($var, 2);
            if (!empty($_var)) {
                $rule = $string;
                $i = 1;
                foreach ($_var as $key => $v) {
                    $rule .= "/$key/$" . $i;
                    $i++;
                }
                $string .= '/' . self::arrayto($_var);
            } else
                $rule = '$1/$2';
            $url = self::restore($rule, $_var);
            if ($url)
                $string = $url;
            if ($base_url)
                $string = $base_url . '/' . $string;
            $string = preg_replace('%\\\\%', '', $string);
            $string = preg_replace('%\\$%', '', $string);
            if ($new_open)
                return "javascript:window.open('{$string}','','fullscreen=1');exit();";
            return $string;
        } else {
            $strings = array();
            foreach ($var as $key => $value) $strings[] = "$key=$value";
            $url = $base_url . '/index.php?' . implode('&', $strings);
            if ($new_open)
                return "javascript:window.open('{$url}','','fullscreen=1');exit();";
            return $url;
        }
    }

    private static function restore($rule, $var)
    {
        $sets = include ROOT . '/config/route.php';
        foreach ($sets as $set) {
            if ($rule == $set[1]) {
                $url = $set[0];
                break;
            }
        }
        if (empty($url))
            return false;
        foreach ($var as $val) {
            $url = preg_replace('%\(.+?\)%', $val, $url, 1);
        }
        return $url;
    }

    static function toarray($_url)
    {
        $var = explode('/', ltrim($_url, '/'));
        $_var = array();
        for ($i = 0; $i < count($var); $i = $i + 2) $_var[$var[$i]] = $var[$i + 1];
        return $_var;
    }

    static function arrayto($array)
    {
        $_url = '';
        foreach ($array as $key => $value) $_url .= "/$key/$value";
        return ltrim($_url, '/');
    }
}

class verify
{
    public $rcode = "34679ACEFGHJKLMNPQRTUVWXY";

    static function show()
    {
        $verify = new verify();
        $verify->main();
    }

    static function checkGee()
    {
        require_once ROOT . '/lib/plugins/geetestlib.php';
        $GtSdk = new GeetestLib();
        if ($_SESSION['gtserver'] == 1) {
            $result = $GtSdk->validate($_POST['geetest_challenge'], $_POST['geetest_validate'], $_POST['geetest_seccode']);
            if ($result == TRUE) {
                return true;
            } else if ($result == FALSE) {
                return false;
            } else {
                return false;
            }
        } else {
            if ($GtSdk->get_answer($_POST['geetest_validate'])) {
                return true;
            } else {
                return false;
            }
        }


    }

    function main()
    {
        $vcode = $this->get_rand();
        session::set('verify', $vcode);
        $img_width = 60;
        $img_height = 30;
        $ifont = 5;
        $this->output_image($vcode, $img_width, $img_height, $ifont);
    }

    function get_rand($length = 4)
    {
        $rcode = $this->rcode;
        $bgnIdx = 0;
        $endIdx = strlen($rcode) - 1;
        $code = "";
        for ($i = 0; $i < $length; $i++) {
            $curPos = rand($bgnIdx, $endIdx);
            $code .= substr($rcode, $curPos, 1);
        }
        return $code;
    }

    function output_image($string, $img_width, $img_height, $ifont, $imgFgColorArr = array(0, 0, 0), $imgBgColorArr = array(255, 255, 255))
    {
        $image = imagecreatetruecolor($img_width, $img_height);
        $backColor = imagecolorallocate($image, rand(200, 230), rand(200, 230), rand(200, 230));
        $borderColor = imagecolorallocate($image, 0, 0, 0);
        imagefilledrectangle($image, 0, 0, $img_width - 1, $img_height - 1, $backColor);
        imagerectangle($image, 0, 0, $img_width - 1, $img_height - 1, $borderColor);
        $imgFgColor = imagecolorallocate($image, $imgFgColorArr[0], $imgFgColorArr[1], $imgFgColorArr[2]);
        $this->lines($image, 6);
        $this->draw($image, $string, $imgFgColor, $ifont);
        header('Content-type: image/png');
        imagepng($image);
        imagedestroy($image);
    }

    function draw($image, $string, $color, $ifont)
    {
        $img_width = imagesx($image);
        $img_height = imagesy($image);
        $count = strlen($string);
        $xpace = ($img_width / $count);
        $x = ($xpace - 10) / 2;
        $y = ($img_height / 2 - 10);
        for ($p = 0; $p < $count; $p++) {
            $xoff = rand(0, +5);
            $yoff = rand(0, +5);
            $curChar = substr($string, $p, 1);
            imagestring($image, $ifont, $x + $xoff, $y + $yoff, $curChar, $color);
            $x += $xpace;
        }
        return 0;
    }

    function lines($image, $times)
    {
        $img_width = imagesx($image);
        $img_height = imagesy($image);
        for ($j = 0; $j < $times; $j++) {
            $x = rand(5, $img_width - 5);
            $y = rand(5, $img_height - 5);
            $color = imagecolorallocate($image, rand(50, 100), rand(50, 100), rand(50, 100));
            if (rand(0, 3) == 0)
                $color = imagecolorallocate($image, 0, 0, 0);
            $x1 = $x - rand(10, 30);
            $x2 = $x + rand(10, 30);
            $y1 = $y - rand(5, 20);
            $y2 = $y + rand(5, 20);
            imageline($image, $x1, $y1, $x2, $y2, $color);
        }
    }
}