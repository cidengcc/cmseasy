<?php
/*
  $tag_info=templatetag::id(get('id'));
  $tag_config=$tag_info['setting'];

  if(isset($tag_config['subcat'])){
  $subcatchecked = 'checked';
  }else{
  $subcatchecked = '';
  }
  if(isset($tag_config['catname'])){
  $catnamechecked = 'checked';
  }else{
  $catnamechecked = '';
  }
  if(isset($tag_config['categorycontent'])){
  $categorycontentchecked = 'checked';
  }else{
  $categorycontentchecked = '';
  }
  if(isset($tag_config['catimage'])){
  $catimagechecked = 'checked';
  }else{
  $catimagechecked = '';
  }

  $tag_config['length'] = 20;
  $tag_config['limit'] = 10;
  $tag_config['thumb'] = 0;
 */
$tplarray=include(ROOT.'/template/'.config::get('template_mobile_dir').'/tpltag/tag.config.php');
$tplarray=$tplarray['category'];
$tag_config=$data['setting'];
?>


        <?php
        echo '<div class="row"><div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">';
        echo '栏目</div><div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">'.form::select('catid', $tag_config['catid'], category::option()).'<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="默认所有栏目!"></span>';
       echo '</div></div><div class="clearfix blank20"></div>';
	   echo '<div class="row"><div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">';
        echo '子栏目</div><div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">';
        echo '<input type="checkbox" name="subcat" id="subcat" class="radio" '.$subcatchecked.'  /><span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="默是否调用栏目下级子栏目!"></span>';
        echo '</div></div><div class="clearfix blank20"></div>';
		echo '<div class="row"><div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">';
        echo '栏目名称</div><div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">';
        echo '<input type="checkbox" name="catname" class="radio" id="cat_name" '.$catnamechecked.'  /><span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="默是否调用栏目名称!"></span>';
        echo '</div></div><div class="clearfix blank20"></div>';
		echo '<div class="row"><div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">';
        echo '封面内容</div><div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">';
        echo '<input type="checkbox" class="radio" name="categorycontent" id="categorycontent" '.$categorycontentchecked.'  /><span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="是否调用栏目封面内容!"></span>';
        echo '</div></div><div class="clearfix blank20"></div>';
		echo '<div class="row"><div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">';
        echo '栏目图片</div><div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">';
        echo '<input type="checkbox" class="radio" name="catimage" id="catimage" '.$catimagechecked.'  /><span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="是否调用栏目说明图片!"></span>';
        echo '</div></div><div class="clearfix blank20"></div>';
		echo '<div class="row"><div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">';
        echo '标签模板</div><div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">';
        echo form::select('tagtemplate', $tag_config['tagtemplate'], $tplarray);
        echo '<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="标签模板文件存放在&nbsp;template/当前使用模板目录/tpltag/tag_category_*.html!"></span><div style="display:none">';
        //echo form::getform('tagcontent',$form,$field,$data);
        echo form::textarea('tagcontent', 'null', 'cols="70" rows="20"');
        echo '</div></div></div>';
        echo '';
        ?>
