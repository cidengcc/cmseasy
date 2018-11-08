<?php
/*
  $id = get('id');
  $path=ROOT.'/config/tag/content_'.$id.'.php';
  $tag_config = array();
  $tag_config_content = @file_get_contents($path);
  if($tag_config_content){
  $tag_config = unserialize($tag_config_content);
  if(isset($tag_config['thumb'])){
  $checked = 'checked';
  }else{
  $checked = '';
  }
  }else{
  $tag_config['length'] = 20;
  $tag_config['limit'] = 10;
  $tag_config['thumb'] = 0;
  }
 */
$tplarray=include(ROOT.'/template/'.config::get('template_dir').'/tpltag/tag.config.php');
$tplarray=$tplarray['content'];
$tag_config=$data['setting'];
?>


        <?php
        echo '<div class="row"><div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">';
		echo '栏目</div><div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">'.form::select('catid', $tag_config['catid'], category::option());
        echo '</div></div><div class="clearfix blank20"></div>';
        echo '<div class="row"><div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">';
		echo '子栏目</div><div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">'.form::select('son', $tag_config['son'], array("否","是"));
		echo '</div></div><div class="clearfix blank20"></div>';
        echo '<div class="row"><div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">';
		echo '分类</div><div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">'.form::select('typeid', $tag_config['typeid'], type::option());
        echo '</div></div><div class="clearfix blank20"></div>';
       echo '<div class="row"><div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">';
		echo '专题</div><div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">'.form::select('spid', $tag_config['spid'], special::option());
        echo '</div></div><div class="clearfix blank20"></div>';
        echo '<div class="row"><div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">';
		echo '标题截取字数</div><div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">';
        echo form::input('length', $tag_config['length'], 'class="input_c"');
		echo '</div></div><div class="clearfix blank20"></div>';
		echo '<div class="row"><div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">';
		echo '简介截取字数</div><div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">';
        echo form::input('introduce_length', $tag_config['introduce_length'], 'class="input_c"').'<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="-1：不限制 0：不调用"></span>';
        echo '</div></div><div class="clearfix blank20"></div>';
        echo '<div class="row"><div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">';
		echo '排序方式</div><div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">';
        echo form::select('ordertype', $tag_config['ordertype'],
                array(
			'adddate-desc'=>'最新(按发布时间倒序)',
            'aid-desc'=>'最新(按aid倒序)',
            'aid-asc'=>'最早(按按aid顺序)',
            'view-desc'=>'最热(按view倒序)',
            'comment_num-desc'=>'热评(按comment_num倒序)',
            'rand()'=>'随机',
        ));
       echo '</div></div><div class="clearfix blank20"></div>';
        echo '<div class="row"><div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">';
		echo '调用置顶内容</div><div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">';
        echo form::select('istop', $tag_config['istop'],
                array(
			'1'=>'是',
            '0'=>'否',
        ));
       echo '</div></div><div class="clearfix blank20"></div>';
        echo '<div class="row"><div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">';
		echo '调用记录条数</div><div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">';
        echo form::input('limit', $tag_config['limit'], 'class="input_c"');
       echo '</div></div><div class="clearfix blank20"></div>';
        echo '<div class="row"><div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">';
		echo '缩略图</div><div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">';
		if($tag_config['thumb'] == 'on') $checked = 'checked';
        echo '<input type="checkbox" name="thumb" id="thumb" '.$checked.' />';
        echo '</div></div><div class="clearfix blank20"></div>';
        echo '<div class="row"><div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">';
		echo '推荐位</div><div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">';
		$set=settings::getInstance();
        $sets=$set->getrow(array('tag'=>'table-archive'));
        $ds=unserialize($sets['value']);
		preg_match_all('%\(([\d\w\/\.-]+)\)(\S+)%s',$ds['attr1'],$result,PREG_SET_ORDER);
        $sdata=array();
        foreach ($result as $res) $sdata[$res[1]]=$res[2];
        echo form::select('attr1', $tag_config['attr1'], $sdata);
        echo '</div></div><div class="clearfix blank20"></div>';
        echo '<div class="row"><div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">';
		echo '标签模板</div><div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">';
        echo form::select('tagtemplate', $tag_config['tagtemplate'], $tplarray);
        echo '<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="标签模板文件存放在&nbsp;template/当前使用模板目录/tpltag/tag_content_*.html!"></span><div style="display:none">';

        //echo form::getform('tagcontent',$form,$field,$data);
        echo form::textarea('tagcontent', 'null', 'cols="70" rows="20"');
		echo '</div></div></div>';
        
        ?>
