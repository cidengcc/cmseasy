<style type="text/css">
.img-container {
  margin-bottom: 50px;
}
.img-container .img-box {
  display: inline-block;
  position: relative;
  height:250px;
  display: table-cell;
        vertical-align: middle;
		text-align:center;
}
.img-container .img-box:hover span {
  visibility: visible;
}
.img-container img {
  border: 4px solid #dff0fd;
  border-radius: 3px;
  cursor: pointer;
  max-height:150px;
}
.img-container .title {
  margin-top: 5px;
  font-size: 13px;
}
.img-container .glyphicon {
  position: absolute;
  background: rgba(56, 156, 240, 0.8);
  height: 48px;
  width: 48px;
  visibility: hidden;
  left: 41%;
  border-radius: 100%;
  cursor: pointer;
  text-align: center;
  color:white;line-height:48px;
}
.img-container span {
  display: inline-block;
  margin-top: 14px;
}
.img-container span.glyphicon-eye-open {
  top: 28%;
}
.img-container span.glyphicon-trash {
  top: 52%;
}
</style>
<div class="padding10">
<input type="button" name="button1" class="btn btn-primary" value="返回图片库" onclick="location.href='{$base_url}/index.php?case=image&act=listdir&admin_dir={get('admin_dir')}&site=default'"> 


<div class="page">{$link_str}</div>
<div class="blank30"></div>
<div class="line"></div>
<div class="blank10"></div>

<div class="row">


{loop $list_img_arr $i $t}
{if $i%4==0}<div class="clearfix"></div>{else}{/if}
<?php $info = getimagesize("upload/images/".front::get('dir')."/$t");?>
<div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 img-container">

<div class="img-box">
<span class="icon">
<a href="upload/images/{front::get('dir')}/{$t}" target="_blank" title="查看原图"><span class="glyphicon glyphicon-eye-open"></span></a>
</span>
<span class="icon trash">
<a href="{url('image/deleteimg/dir/'.front::get('dir').'/imgname/'.str_replace('.','___',$t))}"><span class="glyphicon glyphicon-trash"></span></a>
</span>
<center><img src="upload/images/{front::get('dir')}/{$t}" class="img-responsive"></center>
<p>分辨率:<?php echo($info[0].'x'.$info[1])?></p>
</div>

</div>
{/loop}

<div class="line"></div>
<div class="page">{$link_str}</div>
</div>