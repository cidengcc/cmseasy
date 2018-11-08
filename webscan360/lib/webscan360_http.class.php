<?php
class webscan360_http {
  var $method;
  var $post;
  var $header;
  var $ContentType;


  function __construct() {
    $this->method = '';
    $this->cookie = '';
    $this->post = '';
    $this->header = '';
    $this->errno = 0;
    $this->errstr = '';
	$this->ContentType='';
  }
  function  http_request($url , $postdata = array()){
  	if(function_exists('curl_init')) {
  		$return = $this->webscan_curl($url , $postdata);
  	}else{
  		$return = $this->webscan_fsockopen($url , $postdata);
  	}
  	return  $return;	
  }
  function webscan_curl($url , $postdata = array()){
	  $ch = curl_init();
	  curl_setopt($ch, CURLOPT_URL, $url);
	  curl_setopt($ch, CURLOPT_HEADER, 0);
	  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	  curl_setopt($ch, CURLOPT_TIMEOUT, 15);
	  curl_setopt($ch, CURLOPT_POST, 1);
	  curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
	  $response = curl_exec($ch);
	  $httpcode = curl_getinfo($ch,CURLINFO_HTTP_CODE);
	  curl_close($ch);
	  return array('httpcode'=>$httpcode,'response'=>$response);
  }
  function webscan_fsockopen($url, $data = array(), $referer = '', $limit = 0, $timeout = 15, $block = TRUE) {
    $this->method = 'POST';
    $this->ContentType = "Content-Type: application/x-www-form-urlencoded\r\n";
    if($data) {
      $post = '';
      foreach($data as $k=>$v) {
        $post .= $k.'='.rawurlencode($v).'&';
      }
      $this->post .= substr($post, 0, -1);
    }
    return $this->fsockopen_base($url, $referer, $limit, $timeout, $block);
  }

  function fsockopen_base($url, $referer = '', $limit = 0, $timeout = 30, $block = TRUE) {
    $matches = parse_url($url);
    $host = $matches['host'];
    $path = $matches['path'] ? $matches['path'].($matches['query'] ? '?'.$matches['query'] : '') : '/';
    $port = $matches['port'] ? $matches['port'] : 80;
    if($referer == '') $referer = URL;
    $out = "$this->method $path HTTP/1.1\r\n";
    $out .= "Accept: */*\r\n";
    $out .= "Referer: $referer\r\n";
    $out .= "Accept-Language: zh-cn\r\n";
    $out .= "User-Agent: ".$_SERVER['HTTP_USER_AGENT']."\r\n";
    $out .= "Host: $host\r\n";
    if($this->method == 'POST') {
      $out .= $this->ContentType;
      $out .= "Content-Length: ".strlen($this->post)."\r\n";
      $out .= "Cache-Control: no-cache\r\n";
      $out .= "Connection: Close\r\n\r\n";
      $out .= $this->post;
    } else {
      $out .= "Connection: Close\r\n\r\n";
    }
    if($timeout > ini_get('max_execution_time')) @set_time_limit($timeout);
	if(function_exists('fsockopen')) {
		$fp = @fsockopen($host, $port, $errno, $errstr, $timeout);
	}else if(function_exists('pfsockopen')) {
		$fp = @pfsockopen($host, $port, $errno, $errstr, $timeout);
	}else{
		$fp = stream_socket_client($host.":".$port, $errno, $errstr, $timeout);
	}
    $this->post = '';
    if(!$fp) {
      return false;
    } else {
      stream_set_blocking($fp, $block);
      stream_set_timeout($fp, $timeout);
      fwrite($fp, $out);
      $this->data = '';
      $status = stream_get_meta_data($fp);
      if(!$status['timed_out']) {
        $maxsize = min($limit, 1024000);
        if($maxsize == 0) $maxsize = 1024000;
        $start = false;
        while(!feof($fp)) {
          if($start) {
            $line = fread($fp, $maxsize);
            if(strlen($this->data) > $maxsize) break;
            $this->data .= $line;
          } else {
            $line = fgets($fp);
            $this->header .= $line;
            if($line == "\r\n" || $line == "\n") $start = true;
          }
        }
      }
      fclose($fp);
	  if(!empty($this->header)){
		  $header_info=preg_replace("/\r\n\r\n.*\$/",'',$this->header);
		  $headers=explode("\r\n",$header_info);
		  $httpcode = substr($headers[0], 9, 3);
	  }
	  $response = $this->data;
	  return array('httpcode'=>$httpcode,'response'=>$response);
    }
  }

}