{if config::get('template_view')=='0'}

<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="glyphicon glyphicon-warning-sign"></span>	无更多模板！<a href="javascript:history.back(-1)" class="register_btn">返回</a>
</div>
{else}
<div class="div_tpllist"><?php echo $tpllist;?></div>
<div id="info_res"></div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4 class="modal-title">提示：</h4></div><div class="modal-body"><p>正在下载安装。。。不要刷新本页！！！</p></div></div></div></div>
<script>
    var isdownloading = false;
    $(function(){
        $('#template-list a.btn_template').click(function(e) {
            var a = $(this).data('rel');
            //console.log(a);
            if(!isdownloading) {
                isdownloading = true;
                //$('#info_res').html('');
				$('#myModal').modal('show');
                $.post('{url('template/down',true)}', {'f': a}, function (res) {
                    isdownloading = false;
					$('#myModal').modal('hide');
                    $('#info_res').html(res.msg);
                }, 'json');
                return false;
            }else{
                alert('请等待下载完成!');
                return false;
            }
        });
    });
</script>

<div class="blank30"></div>

<style type="text/css">
    .page_box {padding-right:50px;}
</style>
<div class="page_btn clear">
<span class="page_box">
<a class="prev">上一页</a><span class="num"><span class="current_page">1</span><!-- <span style="padding:0 3px;">/</span><span class="total"></span> --></span><a class="next">下一页</a>
</span>
</div>


<div class="blank30"></div>
{/if}

