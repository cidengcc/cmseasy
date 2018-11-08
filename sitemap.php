<?php 
######################################## 
# 
# PHP版的Google Sitemap 生成器 ver 0.1 
# 注意：必须对当前目录有写的权限 
# 
######################################## 

$PHP_SELF = isset($_SERVER['PHP_SELF']) ? $_SERVER['PHP_SELF'] : (isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : $_SERVER['ORIG_PATH_INFO']);
$root = str_replace("\\","/",dirname($PHP_SELF));
$root = strlen($root)>1 ? $root."/" : "/";
$siteUrl = $_SERVER['HTTP_HOST'].$root;


#网站根域名 
$WebRoot = (" http://".$_SERVER['SERVER_NAME']."/");

#XML文件名称 
$XMLFile = "sitemaps.xml"; 
#要建虑的目录[区分大小写]，注意：前面加号是因为0在PHP中表示假，这样取子串位置时就不会返回假 
#以本程序所在的目录为当前目录，即扫描的根目录，所以目录前面不用加上"/" 
$FilterDir = "+|admin|celive|cache|common|config|fckeditor|editor|htaccess|images|install|js|lib|template|upload"; 
#要索引的文件扩展名[小写] 
$IndexFileExt = "+|htm|html|"; 
#XML头部 
$XMLText = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<urlset xmlns=\"http://www.google.com/schemas/sitemap/0.84\">\n"; 
#XML尾部 
$XMLEndText = "</urlset>"; 

echo "<div id=\"message\" style=\"position:absolute;top:25%;left:32%;width:255px;height:58px;line-height:46px;text-align:center;background:url(images/admin/message.gif);font-size:12px;color:#333;vertical-align:middle;\">构建文件XML索引..."; 
DealFP("."); 
$XMLText .= $XMLEndText; 
makeFile($XMLFile,$XMLText); 
echo "完成!</div>"; 
//$url = $WebRoot.$XMLFile; 
//echo "<a href='http://".$siteUrl.$XMLFile."' target='_blank'>打开</a>:http://".$siteUrl.$XMLFile; 

#公用函数库： 

#新建文件 
function makeFile($fileName, $text){ 
  $fp = fopen($fileName, "w+"); 
  fwrite($fp, $text); 
  fclose($fp); 
} 

/** 
* 将指定内容添加到XML中 
* $f 含相对路径的文件名称 
* $dt 日期时间型 
*/ 
function addToXML($f, $dt){ 
  $s = "<url><loc>".$GLOBALS["WebRoot"].$f."</loc><lastmod>".$dt."</lastmod></url>\n"; 
   
  $GLOBALS["XMLText"] .= $s; 
} 

/** 
* 遍历指定的目录以及子目录，将符合条件的文件加入XML 
* $p 指定的目录 
*/ 
function DealFP($p){ 
  $FilterDir = $GLOBALS["FilterDir"]; 
  $IndexFileExt = $GLOBALS["IndexFileExt"]; 
   
  $handle=opendir($p); 
  if ($p==".") $path = ""; 
  else $path = $p."/"; 
  while ($file = readdir($handle)) 
  { 
    $d = filetype($path.$file); 
    if ((($d=='file')||($d=='dir'))&&($file!='.')&&($file!='..')) 
    { 
        $pf = $path.$file; 
        //echo "[".$d."]".$pf."<br>"; 
        if ($d=='dir') 
        { 
          if (!(strpos($FilterDir, "|".$pf."|"))) 
          { 
            DealFP($pf); 
          } 
        }else{ 
          $ext = "|".strtolower(substr($file, strrpos($file, ".")+1))."|"; 
           
          if (strpos($IndexFileExt, $ext)) 
          { 
            $d = filemtime($pf); 
            $dt = date("Y-m-d",$d)."T".date("H:i:s",$d)."+00:00"; 
            addToXML($pf, $dt); 
          } 
        } 
    } 
  } 
  closedir($handle);  
} 
?> 
