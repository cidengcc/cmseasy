<style type="text/css">
.img-container {
  margin-bottom: 50px;
  text-align:center;
}
.img-container .img-box {
  display: inline-block;
  position: relative;
}
.img-container .img-box:hover span {
  visibility: visible;
}
.img-container img {
  border: 4px solid #dff0fd;
  border-radius: 3px;
  cursor: pointer;
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
  left: 39%;
  top:33%;
  border-radius: 100%;
  cursor: pointer;
  text-align: center;
  color:white;line-height:48px;
}
@media(max-width:468px) {
.img-container .glyphicon {left: 27%;
  top:20%;}
}



</style>
<div class="row">

{loop $dir_arr $t}
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-3 img-container">
<div class="img-box">
    <span class="icon">
        <a data-toggle="modal" href="{url('image/listimg/dir/'.$t)}"><span class="glyphicon glyphicon-eye-open"></span></a>
    </span>
   <img src="{$skin_path}/images/new-gallery-img.png" class="img-responsive">
   <p class="title">
       {$t}
   </p>
</div>
</div>
{/loop}

</div>





