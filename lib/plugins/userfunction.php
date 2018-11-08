<?php

if (!defined('ROOT'))
    exit('Can\'t Access !');

function randomkeys($length){
    $key = '';
    $pattern='1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLOMNOPQRSTUVWXYZ';
    for($i=0;$i<$length-3;$i++){
        $key .= $pattern{mt_rand(0,61)};    //生成php随机数
    }
    $key = $key.mt_rand(100,999);
    return $key;
}

function getParentCid($cid){
    $category = category::getInstance();
    return $category->getparent($cid);
}

function callGuestbook(){
    include(ROOT.'/data/guestbook.php');
}

function getCustSearch(){
	
}

function getArchiveTitle($aid = 0){
	$aid = intval($aid);
	if($aid){
		$archive = new archive();
		$row = $archive->getrow($aid,'1 DESC','title');
		return $row['title'];
	}
	return '';
}

function getDescription($archive,$category,$catid,$type){
	if($archive['description']) {
		echo $archive['description'];return;
	} else {
		if($type['description']) {
			echo $type['description'];return;
		} elseif ($cat = getPCD($category,$catid)) {
			echo $cat;return;
		} else {
			echo get('site_description');return;
		}
	}
}

function getPCD($category,$catid){
	if($category[$catid]['description']){
		return $category[$catid]['description'];
	}else if($category[$catid]['parentid']){
		return getPCD($category,$category[$catid]['parentid']);
	}
	return '';
}

function getPCK($category,$catid){
	if($category[$catid]['keyword']){
		return $category[$catid]['keyword'];
	}else if($category[$catid]['parentid']){
		return getPCK($category,$category[$catid]['parentid']);
	}
	return '';
}

function getKeywords($archive,$category,$catid,$type){
	//var_dump($category);
	if($archive['keyword']) {
		echo $archive['keyword'];return;
	} else {
		if($type['keyword']) {
			echo $type['keyword'];return;
		} else if ($cat = getPCK($category,$catid)) {
			echo $cat;return;
		}else {
			echo get('site_keyword');return;
		}
	}
}

function getTitle($archive,$category,$catid,$type){
	if(!empty($archive['mtitle'])) {
		echo $archive['mtitle'];return;
	} elseif ($category[$catid]['meta_title'] and !$archive['title']) {
		echo $category[$catid]['meta_title'];return;
	} else {
		if(!empty($archive['title'])) {
			echo $archive['title'];return;
		}
		if($type['meta_title']) {
			echo $type['meta_title'];return;
		} elseif (typename($type['typeid'])) {
			echo typename($type['typeid']);return;
		}
		if($category[$catid]['meta_title']) {
			echo $category[$catid]['meta_title'];return;
		} elseif (!empty($catid)) {
			echo catname($catid);return;
		}
		echo get('fullname');return;
	}
}

function array_to_hashmap($arr, $keyField, $valueField = null) {
	$ret = array();
	if ($valueField) {
		foreach ($arr as $row) {
			$ret[$row[$keyField]] = $row[$valueField];
		}
	} else {
		foreach ($arr as $row) {
			$ret[$row[$keyField]] = $row;
		}
	}
	return $ret;
}

function getform($name){
	session::set('table', $name);
	$_table=new defind($name);
	$field=$_table->getFields();
	if(empty($field)){
		return '表格没有找到';
	}
	$fieldlimit=$_table->getcols('user_modify');
	helper::filterField($field,$fieldlimit);
	front::$view->field = $field;
	front::$view->archive['showform'] = $name;
	return front::$view->fetch(@setting::$var[$name]['myform']['template']);
}



function _base64_encode($t,$str) {
	return $t.'"'.base64_encode($str).'"';
}

function _base64_decode($t,$str) {
	return $t.'"'.base64_decode($str).'"';
}
function keyReplace($out){
    return _base64_encode('ori_a=',$out[0]);
}

function keyReplace_a($out){
    //var_dump($out);
    return _base64_encode($out[1],$out[3]);
}

function keyReplace_b($out){
    //var_dump($out);
    return stripslashes(base64_decode($out[1]));
}

function keyReplace_c($out){
    //var_dump($out);
    return _base64_decode($out[1],$out[3]);
}

function _keylinks($txt,$word,$link, $replacenum=0,$link_mode = 1) {
    //var_dump($txt);
	//$replace_a = "_base64_encode('ori_a=','\\0')";

	$search_a = "/<a.*?>.*?<\/a>/isx";

	//$txt = preg_replace($search_a, $replace_a, $txt);
    $txt = preg_replace_callback($search_a,'keyReplace',$txt);
    //var_dump($txt);

	$search = "/(alt\s*=\s*|title\s*=\s*|src\s*=\s*)([\"\'])?(.*?)(?(2)\\2|\s+?)/isx";
	$replace = "_base64_encode('\\1','\\3')";
	$replace1 = "_base64_decode('\\1','\\3')";
	//$txt = preg_replace($search, $replace, $txt);
    $txt = preg_replace_callback($search,'keyReplace_a',$txt);

    //var_dump($txt);

	//$txt= preg_replace("/" . preg_quote($word) . "/", $link, $txt,$replacenum);

    $txt= preg_replace("/" . preg_quote($word) . "/i", $link, $txt,$replacenum);

    $search1_a = "/ori_a=(\".*?\")/isx";
    $replace1_a = "stripslashes(base64_decode('\\1'))";
	//$txt = preg_replace($search1_a, $replace1_a, $txt);
    $txt = preg_replace_callback($search1_a,'keyReplace_b',$txt);
	//$txt = preg_replace($search, $replace1, $txt);
    $txt = preg_replace_callback($search,'keyReplace_c',$txt);

	return $txt;
}

function chkpw($str){
	if(!chkpower($str))
		front::alert('无操作权限!');
}

function chkpower($str){
	$roles = session::get('roles');
	//var_dump($roles);//当前用户的权限
	return $roles[$str];
}

function chkpwf($str,$groupid){
	if(!chkfpw($str,$groupid))
		front::alert('无操作权限!');
}

function chkfpw($str,$groupid){
	$obj = usergroup::getInstance();
	$row = $obj->getrow($groupid);
	if($row['fpwlist']){
		$fpwlist = explode(',',$row['fpwlist']);
		return in_array($str,$fpwlist);
	}
	return false;
}

function getfchk($data,$str){
	if(is_array($data))
		if(in_array($str,$data)) echo 'checked';
}

function getchecked($data,$str){
	if(isset($data[$str]) && $data[$str]) echo 'checked';
}


function dfopen($url, $limit = 0, $post = '', $cookie = '', $bysocket = FALSE, $ip = '', $timeout = 3, $block = TRUE) {
	$return = '';
	$matches = parse_url($url);
	$host = $matches['host'];
	$path = $matches['path'] ? $matches['path'].($matches['query'] ? '?'.$matches['query'] : '') : '/';
	$port = !empty($matches['port']) ? $matches['port'] : 80;

	if($post) {
		$out = "POST $path HTTP/1.0\r\n";
		$out .= "Accept: */*\r\n";
		//$out .= "Referer: $boardurl\r\n";
		$out .= "Accept-Language: zh-cn\r\n";
		$out .= "Content-Type: application/x-www-form-urlencoded\r\n";
		$out .= "User-Agent: $_SERVER[HTTP_USER_AGENT]\r\n";
		$out .= "Host: $host\r\n";
		$out .= 'Content-Length: '.strlen($post)."\r\n";
		$out .= "Connection: Close\r\n";
		$out .= "Cache-Control: no-cache\r\n";
		$out .= "Cookie: $cookie\r\n\r\n";
		$out .= $post;
	} else {
		$out = "GET $path HTTP/1.0\r\n";
		$out .= "Accept: */*\r\n";
		//$out .= "Referer: $boardurl\r\n";
		$out .= "Accept-Language: zh-cn\r\n";
		$out .= "User-Agent: $_SERVER[HTTP_USER_AGENT]\r\n";
		$out .= "Host: $host\r\n";
		$out .= "Connection: Close\r\n";
		$out .= "Cookie: $cookie\r\n\r\n";
	}
	$fp = fsockopen(($ip ? $ip : $host), $port, $errno, $errstr, $timeout);
	if(!$fp) {
		return '';
	} else {
		stream_set_blocking($fp, $block);
		stream_set_timeout($fp, $timeout);
		fwrite($fp, $out);
		$status = stream_get_meta_data($fp);
		if(!$status['timed_out']) {
			while (!feof($fp)) {
				if(($header = fgets($fp)) && ($header == "\r\n" ||  $header == "\n")) {
					break;
				}
			}

			$stop = false;
			while(!feof($fp) && !$stop) {
				$data = fread($fp, ($limit == 0 || $limit > 8192 ? 8192 : $limit));
				$return .= $data;
				if($limit) {
					$limit -= strlen($data);
					$stop = $limit <= 0;
				}
			}
		}
		fclose($fp);
		return $return;
	}
}


function getPrices($price) {
    $obj = new usergroup();
    $roles = $obj->getrow(array('groupid' => 1000));
    if (cookie::get('login_username') && cookie::get('login_password')) {
        $user = new user();
        $user = $user->getrow(array('username' => cookie::get('login_username')));
        if (is_array($user) && cookie::get('login_password') == front::cookie_encode($user['password'])) {
            $roles = $obj->getrow(array('groupid' => $user['groupid']));
        }
    }
    if ($roles['discount'] != 0) {
        $newprice = $price * $roles['discount'] * 0.1;
    }else{
        $newprice = $price;
    }
    return array('oldprice'=>$price,'price'=>$newprice,'groupname'=>$roles['name']);
}

function get_my_tables_list() {
    $tables = array('继承', '不绑定');
    $tdatabase = new tdatabase();
    $forms = $tdatabase->getTables();
    foreach ($forms as $form) {
        if (preg_match('/^' . config::get('database', 'prefix') . '(my_\w+)/xi', $form['name'], $res))
            $tables[$res[1]] = setting::$var[$res[1]]['myform']['cname'];
    }
    return $tables;
}

function array_col_values($arr, $col) {
    $ret = array();
    foreach ($arr as $row) {
        if (isset($row[$col])) {
            $ret[] = $row[$col];
        }
    }
    return $ret;
}

function _highlight($string, $words, $links, $pre, $times) {
	//var_dump($string);
    $string = str_replace('\"', '"', $string);
    if ($words) {
        foreach ($words as $key => $word) {
            if (session::get($word) < $times[$key]) {
                $string = preg_replace("/" . preg_quote($word) . "/", $links[$key], $string,$times[$key]);
                if (strpos($string, $word) !== false) {
                    session::set($word,session::get($word)+1);
                }
            }
        }
    }
    return $pre . $string;
}

function getHtmlRule($cate) {
    $filename = ROOT . '/data/htmlrule.php';
    $arr = include $filename;
    $htmlrulearr[''] = '请选择';
    foreach ($arr as $v) {
        if ($cate == $v['cate'])
            $htmlrulearr[$v['htmlrule']] = $v['hrname'];
    }
    return $htmlrulearr;
}

function getTypeHtmlRule($cate) {
    $filename = ROOT . '/data/typehtmlrule.php';
    $arr = include $filename;
    $htmlrulearr[''] = '请选择';
    foreach ($arr as $v) {
        if ($cate == $v['cate'])
            $htmlrulearr[$v['htmlrule']] = $v['hrname'];
    }
    return $htmlrulearr;
}

function savepic($out) {
    $domain = front::domain();
    preg_match('@http://([^/|\s]*)@is', $out[2], $out1);
    $opts = array(
        'http' => array(
            'method' => "GET",
            'timeout' => 30,
        )
    );
    $ext = end(explode('.', basename($out[2])));
    $arr = array('jpg', 'gif', 'png'); //自动保存的图片类型
    if (in_array($ext, $arr)) {  //是否图片
        if ($domain != $out1[1] && $out1[1]) {  //是否外站图片
            $context = stream_context_create($opts);
            $content = @file_get_contents($out[2], false, $context);
            if ($content) {  //读取是否成功
                $dir = 'upload/images/' . date('Ym') . '/';
                tool::mkdir($dir);
                $name = $dir . time().mt_rand(10, 99) .'.' . $ext;
                $newname = config::get('site_url') . $name;
                if (file_put_contents($name, $content)) { //写入是否成功
                    return $out[1] . $newname;
                } else {
                    return '';
                }
            } else {
                return '';
            }
        } else {
            return $out[0];
        }
    }
    return '';
}

function savepic1($out) {
	$domain = front::domain();
	preg_match('@http://([^/|\s]*)@is', $out[2], $out1);
	$opts = array(
			'http' => array(
					'method' => "GET",
					'timeout' => 30,
			)
	);
	$ext = end(explode('.', basename($out[2])));
	$arr = array('jpg', 'gif', 'png'); //自动保存的图片类型
	if (in_array($ext, $arr)) {  //是否图片
		if ($domain != $out1[1] && $out1[1]) {  //是否外站图片
			$context = stream_context_create($opts);
			$content = @file_get_contents($out[2], false, $context);
			if ($content) {  //读取是否成功
				$dir = 'upload/images/' . date('Ym') . '/';
				tool::mkdir($dir);
				$name = $dir . time().mt_rand(10, 99) .'.' . $ext;
				$newname = config::get('site_url') . $name;
				if (file_put_contents($name, $content)) { //写入是否成功
					return $out[1] . $newname;
				} else {
					return '';
				}
			} else {
				return '';
			}
		} else {
			return $out[2];
		}
	}
	return '';
}

function getcategoryparentsid($catid) {
    $p = category::getparentsid($catid);
    $n = count($p);
    $c = $p[$n - 1];
    return $c;
}

function gettypeparentsid($catid) {
    $p = type::getparentsid($catid);
    $n = count($p);
    $c = $p[$n - 1];
    return $c;
}

function index_archive($catid) {
    $index_archive = new archive();
    $index_category = category::getInstance();
    $index_view_category = $index_category->category;
    if (front::get('page'))
        $page = front::get('page');
    else
        $page = 1;
    $index_view_page = $page;
    front::check_type($page);
    $_catpage = category::categorypages($catid);
    if ($_catpage) {
        $index_pagesize = $_catpage;
    } else {
        $index_pagesize = config::get('list_pagesize');
    }
    front::check_type($index_pagesize);
    $index_view_categorys = category::getpositionlink2($catid);
    $topid = category::gettopparent($catid);
    if (!isset($index_category->category[$catid]) ||
            !isset($index_category->category[$topid])) {
        $this->out('message/error.html');
    }
    $limit = (($index_view_page - 1) * $index_pagesize) . ',' . $index_pagesize;
    $categories = array();
    if (@$index_category->category[$catid]['ispages'])
        $categories = $index_category->sons($catid);
    $categories[] = $catid;
    $index_view_pages = @$index_category->category[$catid]['ispages'];
    if (!rank::catget($catid, $index_view_usergroupid))
        $this->out('message/error.html');
    $order = "`listorder` asc,`adddate` DESC";
    if (@$index_category->category[$catid]['includecatarchives'])
        $articles = $index_archive->getrows('catid in (' . implode(',', $categories) . ') and checked=1', $limit, $order);
    else
        $articles = $index_archive->getrows('catid=' . $catid . ' and checked=1', $limit, $order);
    if (!is_array($articles)) {
        $this->out('message/error.html');
    }
    foreach ($articles as $order => $arc) {
        $articles[$order]['url'] = archive::url($arc);
        $articles[$order]['catname'] = category::name($arc['catid']);
        $articles[$order]['caturl'] = category::url($arc['catid']);
        $articles[$order]['adddate'] = sdate($arc['adddate']);
        $articles[$order]['stitle'] = strip_tags($arc['title']);
        $articles[$order]['strgrade'] = archive::getgrade($arc['grade']);
    }
    $index_view_archives = $articles;
    if (@$index_category->category[$catid]['includecatarchives'])
        $index_view_record_count = $index_archive->rec_count('catid in(' . implode(',', $categories) . ')');
    else
        $index_view_record_count = $index_archive->rec_count('catid=' . $catid);
    front::$record_count = $index_view_record_count;
    return $index_view_archives;
}

function index_pagination($catid, $tpl = 'system/index_pagination.html') {
    front::$view->_var->catid = $catid;
    return template($tpl);
}

function user_cb_item($table, $field, $value) {
    return user_select_option($field, setting::$var[$table][$field], $value);
}

function user_cb_data(&$data, $table = 'archive') {
    foreach ($data as $key => $value) {
        if (preg_match('/^my_/', $key) && isset(setting::$var[$table][$key]) && @setting::$var[$table][$key]['selecttype']) {
            $data[$key] = user_cb_item($table, $key, $value);
        }
    }
}

function user_select_option($name, $form, $value) {
    $num = $value - 1;
    preg_match_all('/\(([\d\w]+)\)(\S+)/im', $form['select'], $result, PREG_SET_ORDER);
    $tmp = array();
    foreach ($result as $rs) {
        $tmp[$rs[1]] = $rs[2];
    }
    $values = explode(',', trim($value, ','));
    $res = array();
    foreach ($values as $key => $value) {
        $res[$key] = $tmp[$value];
    }
    return implode(',', $res);
}

function formatPath($path) {
    $path = str_replace('\\', '/', $path);
    if (substr($path, -1) != '/') {
        $path = $path . '/';
    }
    return $path;
}

function createtDir($path, $mode = 0777) {
    if (is_dir($path)) {
        return true;
    }
    $path = formatPath($path);
    $temp = explode('/', $path);
    $curDir = '';
    $max = count($temp) - 1;
    for ($i = 0; $i < $max; $i++) {
        $curDir .= $temp[$i] . '/';
        if (is_dir($curDir))
            continue;
        if (!@mkdir($curDir, 0777)) {
            @mkdir($curDir, 0777);
        }
        @chmod($curDir, 0777);
    }
    return is_dir($path);
}

function deleteDir($dir) {
    $dir = formatPath($dir);
    if (!is_dir($dir)) {
        return false;
    }
    if (substr($dir, 0, 1) == '.') {
        exit("Cannot remove dir $dir !");
    }
    $list = glob($dir . '*');
    foreach ($list as $v) {
        is_dir($v) ? deleteDir($v) : @unlink($v);
    }
    return @rmdir($dir);
}

function listDirOne($path, $exts = '') {
    $list = array();
    $path = formatPath($path);
    $files = glob($path . '*');
    foreach ($files as $v) {
        $fileext = fileext($v);
        if (!$exts || preg_match("/\.($exts)/i", $v)) {
            $list[] = $v;
        }
    }
    return $list;
}

function fileext($filename) {
    return strtolower(trim(substr(strrchr($filename, '.'), 1, 10)));
}



    if (!function_exists('http_response_code')) {
        function http_response_code($code = NULL) {

            if ($code !== NULL) {

                switch ($code) {
                    case 100: $text = 'Continue'; break;
                    case 101: $text = 'Switching Protocols'; break;
                    case 200: $text = 'OK'; break;
                    case 201: $text = 'Created'; break;
                    case 202: $text = 'Accepted'; break;
                    case 203: $text = 'Non-Authoritative Information'; break;
                    case 204: $text = 'No Content'; break;
                    case 205: $text = 'Reset Content'; break;
                    case 206: $text = 'Partial Content'; break;
                    case 300: $text = 'Multiple Choices'; break;
                    case 301: $text = 'Moved Permanently'; break;
                    case 302: $text = 'Moved Temporarily'; break;
                    case 303: $text = 'See Other'; break;
                    case 304: $text = 'Not Modified'; break;
                    case 305: $text = 'Use Proxy'; break;
                    case 400: $text = 'Bad Request'; break;
                    case 401: $text = 'Unauthorized'; break;
                    case 402: $text = 'Payment Required'; break;
                    case 403: $text = 'Forbidden'; break;
                    case 404: $text = 'Not Found'; break;
                    case 405: $text = 'Method Not Allowed'; break;
                    case 406: $text = 'Not Acceptable'; break;
                    case 407: $text = 'Proxy Authentication Required'; break;
                    case 408: $text = 'Request Time-out'; break;
                    case 409: $text = 'Conflict'; break;
                    case 410: $text = 'Gone'; break;
                    case 411: $text = 'Length Required'; break;
                    case 412: $text = 'Precondition Failed'; break;
                    case 413: $text = 'Request Entity Too Large'; break;
                    case 414: $text = 'Request-URI Too Large'; break;
                    case 415: $text = 'Unsupported Media Type'; break;
                    case 500: $text = 'Internal Server Error'; break;
                    case 501: $text = 'Not Implemented'; break;
                    case 502: $text = 'Bad Gateway'; break;
                    case 503: $text = 'Service Unavailable'; break;
                    case 504: $text = 'Gateway Time-out'; break;
                    case 505: $text = 'HTTP Version not supported'; break;
                    default:
                        exit('Unknown http status code "' . htmlentities($code) . '"');
                    break;
                }

                $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');

                header($protocol . ' ' . $code . ' ' . $text);

                $GLOBALS['http_response_code'] = $code;

            } else {

                $code = (isset($GLOBALS['http_response_code']) ? $GLOBALS['http_response_code'] : 200);

            }

            return $code;

        }
    }


function read_modules($directory = '.') {
    global $_LANG;
    $dir = opendir($directory);
    $set_modules = true;
    $modules = array();
    while (false !== ($file = @readdir($dir))) {
        if (preg_match("/^.*?\.php$/", $file)) {
            include_once($directory . '/' . $file);
        }
    }
    @closedir($dir);
    unset($set_modules);
    foreach ($modules AS $key => $value) {
        ksort($modules[$key]);
    }
    ksort($modules);
    return $modules;
}

function unserialize_config($cfg) {
    if (is_string($cfg) && ($arr = unserialize($cfg)) !== false) {
        $config = array();
        foreach ($arr AS $key => $val) {
            $config[$val['name']] = $val['value'];
        }
        return $config;
    } else {
        return false;
    }
}

function getwebsite($site = null) {
    $path = ROOT . '/config/website';
    if (!$site) {
        $dir = opendir($path);
        $website_num = 0;
        $website = array();
        while ($file = readdir($dir)) {
            if (!($file == '..')) {
                if (!($file == '.')) {
                    if (!is_dir($path . '/' . $file)) {
                        $tmparr = include $path . '/' . $file;
                        $website_num++;
                        $tmparr['website']['id'] = $website_num;
                        $tmparr['website']['url'] = $tmparr['site_url'];
                        $tmparr['website']['path'] = substr($file, 0, -4);
                        $args = array('username' => $tmparr['site_username'], 'password' => md5($tmparr['site_password']));
                        $tmparr['website']['admindir'] = $tmparr['site_admindir'];
                        $tmparr['website']['args'] = urlencode(base64_encode(xxtea_encrypt(serialize($args), $tmparr['cookie_password'])));
                        $tmparr['website']['addr'] = $tmparr['site_url'] . 'index.php?case=admin&act=remotelogin&admin_dir=' . $tmparr['website']['admindir'] . '&args=' . $tmparr['website']['args'] . '&submit=1';
                        $website[] = $tmparr['website'];
                    }
                }
            }
        }
    } else {
        $tmparr = include $path . '/' . $site . '.php';
        $website[] = $tmparr['website'];
    }
    return $website;
}

function sendMsg($mobile, $content) {
    $tc = file_get_contents('config/sms.tmp.php');
    $tmp = explode('@', $tc);
    if ($tmp[0] >= config::get('sms_maxnum') && $tmp[1] == date('Y-m-d')) {
    	front::flash('发送失败,请检查用户名、密码或剩余条数');
        return -200;
    }
    include_once("phprpc/phprpc_client.php");
    $client = new PHPRPC_Client();
    $client->setProxy(NULL);
    $client->useService('http://pay.cmseasy.cn/sms.php');
    $client->setKeyLength(128);
    $client->setEncryptMode(3);
    $keys = config::get('sms_keyword');
    if ($keys != '') {
        $keys = explode(',', $keys);
        $content = str_ireplace($keys, '*', $content);
    }
    //var_dump($mobile);
    $rs = $client->sendMsg($mobile, $content, config::get('sms_username'), md5(config::get('sms_password')));
    //var_dump($rs);
    if ($rs == '0') {
        $num = $tmp[0] + 1;
        file_put_contents('config/sms.tmp.php', $num . '@' . date('Y-m-d'));
    }
    return $rs;
}

//特殊功能的explode函数，专为导入phpweb数据服务的
function super_explode($str) {
    //最终截取完后得到的数组
    $result = array();
    //临时存储每一个数组元素
    $tmp = '';
    //用来判断是否到字符串末尾
    $i = 0;
    //用来记录是否已经匹配到一对单引号
    $j = 0;

    while (1) {
        //当到了字符串尾部的时候跳出循环
        if (!isset($str[$i])) {
            $result[] = $tmp;
            break;
        }
        //echo $str[$i];
        if ($str[$i] == "'") {
            $j++;
            if ($j == 2)
                $j = 0;
        }elseif ($str[$i] == ",") {
            if ($j == 0) {
                $result[] = $tmp;
                $tmp = '';
            } elseif ($j == 1) {
                $tmp .= $str[$i];
            }
        } else {
            $tmp .= $str[$i];
        }
        $i++;
    }
    return $result;
}

//将获取的数据插入到数据库中
function put_into_db($tbname, $data) {
    $fields = "";
    $values = "";
    foreach ($data as $k => $v) {
        $fields .= empty($fields) ? "`{$k}`" : ",`{$k}`";
        $values .= empty($values) ? "'{$v}'" : ",'{$v}'";
    }
    $sql = "INSERT INTO `{$tbname}`({$fields}) VALUES({$values})";
    @mysql_query($sql);
    return mysql_insert_id();
}

function listPageJs($total_page, $num, $current) {//依次传入，总数，每页显示条目，显示链接总数,当前所在页
    $link = array();
    $link_str = '';
    if ($total_page == 0) {
        return '';
    }
    if ($total_page == 1) {
        return '<a>1</a>';
    }
    if ($current < 1)
        $current = 1;
    if ($current > $total_page)
        $current = $total_page;

    if ($total_page <= 10) {
        $link = range(1, $total_page);
    } else {
        if ($current < 8) {
            $link = range(1, 10);
        } elseif ($current > $total_page - 6) {
            $link = range($total_page - 9, $total_page);
        } else {
            $link = range($current - 5, $current + 4);
        }
    }

    foreach ($link as $v) {
        if ($v == $current) {
            $link_str .= '<a href="javascript:picload(' . front::get('amid') . ',' . $v . ');" style="color:red">' . $v . '</a>';
        } else {
            $link_str .= '<a href="javascript:picload(' . front::get('amid') . ',' . $v . ');">' . $v . '</a>';
        }
    }
    if ($total_page > 10) {
        if (!in_array(1, $link))
            $link_str = '<a href="javascript:picload(' . front::get('amid') . ',1);">1...</a>' . $link_str;
        if (!in_array($total_page, $link))
            $link_str .= '<a href="javascript:picload(' . front::get('amid') . ',' . $total_page . ');">...' . $total_page . '</a>';
    }
    return $link_str;
}

function listPage($total_page, $num, $current) {//依次传入，总数，每页显示条目，显示链接总数,当前所在页
    $link = array();
    $link_str = '';
    //$total_page = ceil($total/$num);
    if ($total_page == 0) {
        return '';
    }
    if ($total_page == 1) {
        return '<a>1</a>';
    }
    if ($current < 1)
        $current = 1;
    if ($current > $total_page)
        $current = $total_page;

    if ($total_page <= 10) {
        $link = range(1, $total_page);
    } else {
        if ($current < 8) {
            $link = range(1, 10);
        } elseif ($current > $total_page - 6) {
            $link = range($total_page - 9, $total_page);
        } else {
            $link = range($current - 5, $current + 4);
        }
    }
    $url = preg_replace('/&page=[0-9]*/', '', $_SERVER['REQUEST_URI']);
    foreach ($link as $v) {
        if ($v == $current) {
            $link_str .= '<a href="' . $url . '&page=' . $v . '" style="color:red">' . $v . '</a>';
        } else {
            $link_str .= '<a href="' . $url . '&page=' . $v . '">' . $v . '</a>';
        }
    }
    if ($total_page > 10) {
        if (!in_array(1, $link))
            $link_str = '<a href="' . $url . '&page=1">1...</a>' . $link_str;
        if (!in_array($total_page, $link))
            $link_str .= '<a href="' . $url . '&page=' . $total_page . '">...' . $total_page . '</a>';
    }
    return $link_str;
}