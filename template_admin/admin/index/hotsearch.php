<div class="alert alert-info" role="alert">
<ul class="nav nav-pills" role="tablist">
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
                        echo '<li role="presentation" class="active"><a href="'.config::get('site_url').'?case=archive&act=search&keyword='.str_replace('%', '-', urlencode($keyword)).'&ule=1" target="_blank">'.$keyword.'&nbsp;<span class="badge">'.$keywordcount.')</span></a>';
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
                        $keywordcount = @file_get_contents($path.'/'.$file);
                        echo '<li role="presentation" class="active"><a href="'.config::get('site_url').'?case=archive&act=search&keyword='.str_replace('%', '-', urlencode($keyword)).'&ule=1" target="_blank">'.$keyword.'&nbsp;<span class="badge">'.$keywordcount.'</span></a></li><li><a onclick="return confirm(\'确定要删除吗\')" href="'.url::create('index/hotdel/key/'.$keyword).'" class="search-del" title="删除">x</a></li> ';
                        $koption .= '<option value="'.$file.'">'.$keyword.'</option>';
                    }
                }
            }
            ?>
			</ul>
</div>

<div class="blank30"></div>

<form action="{url::create('index/hotsearch/change/1')}" method="post" name="form2">
<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">关键词</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<select name="kfile" value="" class="form-control select"><?php echo $koption; ?></select>
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">搜索次数修改为</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<input name="keywordcount" type="text" class="form-control" value=""  />
<div class="clearfix blank20"></div>
<input name="确定" type="submit" value="确定" class="btn btn-primary" />
</div>
</div>
<div class="clearfix blank20"></div>
</form>
<form action="{url::create('index/hotsearch/save/1')}" method="post" name="form2">

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">关键词</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<input name="keyword" class="form-control" type="text" />
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">搜索次数</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<input name="keywordcount" type="text" value="" class="form-control" />
<div class="clearfix blank20"></div>
<input name="添加" type="submit" value="添加" class="btn btn-steeblue" />
</div>
</div>
<div class="clearfix blank20"></div>
</form>


