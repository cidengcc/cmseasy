<style>
.tbl{margin:8px 0px 0px;border:1px solid #ddd;border-top:0;overflow:hidden;text-align:left;}
.tbl_tbmax{ margin:5px 0; background:#fff; }
.tbl_tbbox{ margin:5px 5px; padding:5px 0px;}
	
	.tbl_hr{padding:2px 0px;color:#666;font-weight:normal;}
.tbl_hr{border-top:1px solid #ddd;margin:0px 0px 0px;padding:5px 5px 5px 15px;font-weight:bold;color:#333;font-size:14px;background:#f7f7f7;line-height:2;}
.tbl_hr .hr_right{float:right;}
.tbl_hr .tips{font-weight:normal;padding-left:20px;color:#999;}
.tbl h3.v52fmbx_hr:first-child{border-top:1px solid #ddd;}
.tbl_submit{ border-bottom:1px solid #ddd;border-top:1px solid #ddd;padding:5px 5px 5px 10px;}
.showmoreset-btn{float: right;}
.showmoreset-content{display: none;}
	
.product_index{overflow:visible!important;}
.tbl dl:after{display:block;clear:both;content:"";visibility:hidden;height:0;}
.tbl dl{width:100%;zoom:1;background:#fff;}
.tbl dl{border-top:1px solid #ddd;margin:0px 0px;display:-webkit-box;display:-moz-box;display:box;display:-ms-flexbox;position:relative;padding:5px 0px;}
.tbl dl dt{margin:15px 15px 10px 15px;width:105px;color:#333;text-align:left;font-weight:normal;overflow:hidden;line-height:1.2;}
.tbl dl dd{color:#aaa;-moz-box-flex:1.0;-webkit-box-flex:1.0;box-flex:1.0;-ms-flex:1;padding:2px 0px 0px 15px;margin:10px 0px;}
.tbl dl dd label input{position:relative;top:1px;margin-right:3px;}
.tbl dl dd .fbox{color:#aaa;color:#656565;}
.tbl dl dd .tips{color:#aaa;}
.tbl dl dd .tips:hover{color:#f00;}
.tbl dl dd.labelinline label{display:inline;}
.tbl dl dt.addimgdt{padding:10px 5px 10px;}
.tbl dl dt.addimgdt p{height:30px;line-height:30px;margin-bottom:8px;}
.tbl dl.noborder{border-bottom:0;}
.formerror{margin-top:6px;height:20px;line-height:20px;}
.formerror .fa-times{color:#fff;border-radius:3px;padding:1px 2px;font-size:16px;margin-right:5px;background:red;}
.formerror .fa-check{color:#fff;border-radius:3px;padding:2px;font-size:14px;margin-right:5px;background:#10aa00;}
.formerrorbox{border:2px solid #f00!important;}
.tbl dl dd.ftype_description{color:#fff;padding:8px;margin:0px 5px;background:#6c6fbf;}
.noborder a.lsblogin{display:inline-block;float:left;margin-left:200px;width:100px;white-space:nowrap;text-indent:-12px;line-height:34px;margin-top:-35px;}
.noborder a.lsblogin:hover{color:#fff;}
.lsbwarning{color:red;line-height:34px;}
.newver {color:#3ca1ef;}
.tbl a {color:#aaa;}
</style>
{if $row['err'] == 0}
<!-- Button trigger modal -->
<script>
    var patch_size = 0;
    var i = 0;

    function repeat(str, num){
        return new Array( num + 1 ).join( str );
    }

    function getsize(){
        /*$.get('{url('update/getsize')}',function(res){
            console.log(res);
        });*/
        $('.newver').html('下载中'+repeat('.',i));
        i++;
        if(i > 3) i = 0;
    }
    function start_down(url){
        var ct = window.setInterval('getsize()',1000);
        $.getJSON('{url('update/downfile')}',{'url':url},function(res){
            clearInterval(ct);
            if(res['err'] == '0'){
                $('.newver').html(res['data']);
                window.location.href = window.location.href;
            }else {
                $('.newver').html(res['data']);
            }
        });
    }

    $(function () {
        $('#btn_update').click(function(){
            $('#myModal').modal('hide');
            $('.newver').html('准备开始更新');
            $.getJSON('{url('update/getfile')}',{code:{$row['data']['code']}},function(res){
                if(res['err'] == '2' || res['err'] == '1' || res['err'] == '3'){
                    $('.newver').html(res['data']);
                }else if(res['err'] == '0'){
                    patch_size = res['size'];
                    start_down(res['data']['url']);
                }else{
                    $('.newver').html('未知错误');
                }
            });
        });
    });

</script>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">立即更新</h4>
            </div>
            <div class="modal-body">
                <h5><?php echo $row['data']['name'];?></h5>
                <p><?php echo nl2br($row['data']['content']);?></p>
                <h8>发布时间 <?php echo $row['data']['addtime'];?></h8>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">暂不更新</button>
                <button type="button" id="btn_update" class="btn btn-primary">立即更新</button>
            </div>
        </div>
    </div>
</div>

{/if}
<div class="tbl" data-version="6.0.0">
	<h3 class="tbl_hr">程序信息</h3>
	<dl>
		<dt>检测更新</dt>
		<dd>
			<span class="newver">
                <?php
                if($row['err'] == '0'){
                    echo '可更新到'.$row['data']['name'];
                    echo ' <span style="cursor: pointer;padding:3px 10px;background:#3ca1ef;color:white;" id="target"  data-toggle="modal" data-target="#myModal" class="upload_download btn btn-steeblue btn-xs">检测更新</span>';
                }elseif ($row['err'] == '2' || $row['err'] == '1' || $row['err'] == '3'){
                    echo $row['data'];
                }else{
                    echo '未知错误';
                }
                ;?></span>
		</dd>
	</dl>
	<dl>
		<dt>程序名称</dt>
		<dd>CmsEasy企业网站管理系统</dd>
	</dl>
	<dl>
		<dt>当前版本</dt>
		<dd><?php echo _VERSION;?></dd>
	</dl>
	<dl>
		<dt>更新日志</dt>
		<dd>
			<a href="https://www.cmseasy.cn/log/" target="_blank">查看</a>
		</dd>
	</dl>
	<dl>
		<dt>版权所有</dt>
		<dd>
			<a href="https://www.cmseasy.cn/" target="_blank">四平市九州易通科技有限公司</a>
		</dd>
	</dl>

	<h3 class="tbl_hr">服务器信息</h3>
	<dl>
		<dt>操作系统</dt>
		<dd><?php echo php_uname('s');?> <?php echo php_uname('v');?></dd>
	</dl>
	<dl>
		<dt>WEB服务器</dt>
		<dd><?php echo $_SERVER['SERVER_SOFTWARE'];?></dd>
	</dl>
	<dl>
		<dt>PHP版本</dt>
		<dd><?php echo PHP_VERSION;?></dd>
	</dl>
	<dl>
		<dt>数据库版本</dt>
		<dd><?php echo config::get('database','type').':'.$dbversion;?></dd>
	</dl>
</div>