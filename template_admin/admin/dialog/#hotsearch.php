<?php if (!defined('ADMIN')) exit('Can\'t Access !'); ?>
<style type="text/css">
    body {
        margin: 0px;
        padding: 0px;
        border: 0px;
        color:#1B4670;
        font-size:14px;
        line-height:150%;
        text-align: left;
        background:white url(bg.gif) repeat-y left top;
        background-attachment:fixed;
        font-family: '微软雅黑','Lucida Grande','Lucida Sans Unicode','宋体','新宋体',arial,verdana,sans-serif;
    }
    /************* 首页右边内容 */
    .homecon{ height:auto; width:100%; }
    #homecon_left{ width:102%; float:left; height:auto; background:#f7fcff; border:1px solid #e0ecf4; margin:2px;}
    .homecon_lefttit{ line-height:30px; height:30px; background:#e0ecf4; padding-left:10px; border:1px solid #fff;}
    .homecon_leftcon{ line-height:30px; height:auto;  padding:10px; font-size:12px;}


    #btn{ margin-top:15px;}
    #btn li{ width:auto; margin-right:10px; background:#e8f3f8; border:1px solid #c8dde8; color:#133366; height:30px; padding:0px 20px; line-height:30px; float:left; display:block;}
    #btn li a{ color:#133366;}
    #btn li a:hover{ color:#5b8b09; }

    a {margin: 0px;padding:0px;border:0px;color:#27394F;text-decoration:none;float:left; white-space: nowrap;}
    a:link {color:#333;text-decoration:none;}
    a:visited{color:#666;text-decoration: none;}
    a:hover{color:#3399FF;text-decoration:none;}
	a span {color:#214FA3;}
    li{list-style-type:none; margin-left:5px;}

</style>




<div class="homecon">


    <div id="homecon_left">
        <div class="homecon_lefttit">热门关键词列表</div>
        <div class="homecon_leftcon">

            <?php
            if (front::get('change')) {
                $path=ROOT.'/data/hotsearch/'.front::post('kfile');
                $keywordcount=intval(front::post('keywordcount'));
                file_put_contents($path, $keywordcount);
                if ($_GET['site'] != 'default') {
                    $ftp=new nobftp();
                    $ftpconfig=config::get('website');
                    $ftp->connect($ftpconfig['ftpip'], $ftpconfig['ftpuser'], $ftpconfig['ftppwd'], $ftpconfig['ftpport']);
                    $ftperror=$ftp->returnerror();
                    if ($ftperror) {
                        exit($ftperror);
                    }
                    else {
                        $ftp->nobchdir($ftpconfig['ftppath']);
                        $ftp->nobput($ftpconfig['ftppath'].'/data/hotsearch/'.front::post('kfile'), $path);
                    }
                }
                front::redirect(url::create('index/hotsearch/save/1'));
            }
            else {
                if (front::get('keyword') && !front::post('keyword'))
                    front::$post['keyword']=front::get('keyword');

                front::check_type(front::post('keyword'), 'safe');

                if (front::post('keyword')) {
                    $_keyword=trim(front::post('keyword'));
                    session::set('keyword', $_keyword);
                }
                else {
                    session::set('keyword', null);
                    $_keyword=session::get('keyword');
                }


                if (front::get('keywordcount') && !front::post('keywordcount'))
                    front::$post['keywordcount']=front::get('keywordcount');

                front::check_type(front::post('keywordcount'), 'safe');

                if (front::post('keywordcount')) {
                    $_keywordcount=trim(front::post('keywordcount'));
                    session::set('keywordcount', $_keywordcount);
                }
                else {
                    session::set('keywordcount', null);
                    $_keywordcount=session::get('keywordcount');
                }
            }




            if ($_GET['site'] != 'default') {
                $ftp=new nobftp();
                $ftpconfig=config::get('website');
                $ftp->connect($ftpconfig['ftpip'], $ftpconfig['ftpuser'], $ftpconfig['ftppwd'], $ftpconfig['ftpport']);
                $ftperror=$ftp->returnerror();
                if ($ftperror) {
                    exit($ftperror);
                }
                else {
                    $ftp->nobchdir($ftpconfig['ftppath']);
                    $hotkeywordlist=$ftp->nobnlist($ftpconfig['ftppath'].'/data/hotsearch');
                }
                if (is_array($hotkeywordlist)) {
                    foreach ($hotkeywordlist as $val) {
                        $val=str_replace($ftpconfig['ftppath'], config::get('site_url'), $val);
                        $keywordcount=@file_get_contents($val);
                        $valtmp=str_replace(config::get('site_url'), '', $val);
                        $valtmp=str_replace('/data/hotsearch', '', $valtmp);
                        $valtmp=str_replace('/', '', $valtmp);
                        $valtmp=str_replace('\\', '', $valtmp);
                        $keyword=urldecode(substr($valtmp, 0, -4));
                        if ($_keyword) {
                            if ($_keyword != $keyword) {
                                $path1=ROOT.'/data/hotsearch/'.urlencode($_keyword).'.txt';
                                file_put_contents($path1, $_keywordcount);

                                $ftp->nobchdir($ftpconfig['ftppath']);
                                $ftp->nobput($ftpconfig['ftppath'].'/data/hotsearch/'.urlencode($_keyword).'.txt', $path1);

                                front::redirect(url::create('index/hotsearch/post/1'));
                            }
                        }
                        echo '<a href="'.config::get('site_url').'?case=archive&act=search&keyword='.str_replace('%', '-', urlencode($keyword)).'&ule=1" target="_blank"><span>'.$keyword.'</span> ('.$keywordcount.')&nbsp;&nbsp;</a>';
                        $koption .= '<option value="'.$valtmp.'">'.$keyword.'</option>';
                    }
                }
            }
            else {



                $path=ROOT.'/data/hotsearch';
                $dir=opendir($path);
                $i=0;

                $files=-2;
                $dir2=opendir($path);
                while ($file=readdir($dir2)) {
                    $files++;
                }
                $koption='<option value="">选择关键词...</option>';
                while ($file=readdir($dir)) {
                    if ($file != '..' && $file != '.' && !is_dir($path.'/'.$file) || $files == 0) {
                        if ($files == 0)
                            $keyword=null;
                        else
                            $keyword=urldecode(substr($file, 0, -4));
                        if ($_keyword) {
                            if ($_keyword != $keyword) {
                                $path1=ROOT.'/data/hotsearch/'.urlencode($_keyword).'.txt';
                                file_put_contents($path1, $_keywordcount);
                                front::redirect(url::create('index/hotsearch/post/1'));
                            }
                        }
                        $keywordcount=file_get_contents($path.'/'.$file);
                        echo '<a href="'.config::get('site_url').'?case=archive&act=search&keyword='.str_replace('%', '-', urlencode($keyword)).'&ule=1" target="_blank"><span>'.$keyword.'</span> ('.$keywordcount.')&nbsp;&nbsp;</a>';
                        $koption .= '<option value="'.$file.'">'.$keyword.'</option>';
                    }
                }
            }
            ?>

        </div>  
    </div>

    <div id="homecon_left">
        <div class="homecon_lefttit">修改热门关键词</div>
        <div class="homecon_leftcon">
            <form action="{url::create('index/hotsearch/change/1')}" method="post" name="form2">
                关键词：<select name="kfile" value=""><?php echo $koption; ?></select> 搜索次数：<input name="keywordcount" type="text" value="" /><input name="确定" type="submit" value="确定" />
            </form>
        </div>
    </div>


    <div id="homecon_left">
        <div class="homecon_lefttit">添加热门关键词</div>
        <div class="homecon_leftcon">
            <form action="{url::create('index/hotsearch/')}" method="post" name="form1">
                关键词：<input name="keyword" type="text" /> 搜索次数：<input name="keywordcount" type="text" value="" /><input name="确定" type="submit" value="确定" />
            </form>
        </div>
    </div>

    <div class="clear"></div>
</div>
