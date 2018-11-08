<input type="button" name="Submit" value="返回列表" class="btn btn-primary" onclick="javascript:window.history.back(-1);">

<div class="blank30"></div>

<script>
    function checktovarchar() {
        if($("#selecttype").val()=='0') {
            $(".varchar2").show("slow");
            $(".select2").hide("slow");
            $("#type").attr('value','varchar');
        }
    }
    function checktoselect() {
        $("#issearch").attr('checked',false);
        if($("#type").val()=='varchar'){
            $("#issearch").attr('disabled',false);
        }
        else
        {
            $("#issearch").attr('disabled',true);
        }
        if($("#type").val()=='0') {
            $(".select2").show("slow");
            $(".varchar2").hide("slow");
            $("#selecttype").attr('value','select');
        }
    }

    function form_preview() {
        if($("#type").val()=='0') {
            //$('#form_preview').html(get('form1').cname.value+'：<input name="'+get('form1').name.value+'" size="'+get('form1').len.value+'">');

            if($("#selecttype").val()=='select') {
                select='<select name="'+get('form1').name.value+ '">';
                subject=get('form1').select.value;
                var myregexp = /\(([\d\w]+)\)(\S+)/mg;
                var match = myregexp.exec(subject);
                while (match != null) {
                    select += '<option value="'+match[1]+'">'+match[2]+'</option>';
                    match = myregexp.exec(subject);
                }
                select +='</select>';
            }
            else {
                select='';
                subject=get('form1').select.value;
                var myregexp = /\(([\d\w]+)\)(\S+)/mg;
                var match = myregexp.exec(subject);
                while (match != null) {

                    if($("#selecttype").val()=='checkbox')
                        select += match[2]+'<input type="checkbox" value="'+match[1]+'" name="'+get('form1').name.value+ '[]">&nbsp;&nbsp;';
                    else
                        select += match[2]+'<input type="radio" value="'+match[1]+'" name="'+get('form1').name.value+ '">&nbsp;&nbsp;';
                    match = myregexp.exec(subject);
                }
            }

            $('#form_preview').html(select);
            $('#form_preview_title').html(get('form1').cname.value);
            $('#form_preview_tips').html(get('form1').tips.value);
        }
    }

    function checkform1() {
        $('#select_preview').html('');
    }


</script>


<form method="post" action="" name="form1" id="form1" onsubmit="checkform1()">

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">字段名</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{if front::$act=='edit'}
<b>{$field.name}</b>
<input type="hidden" class="form-control"  name="name" id="name" value="{$field.name}" onkeyup="value=value.replace(/[\W]/g,'') " onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))" />
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="必填！"></span>
{else}
<input class="form-control" name="name" id="name" value="my_" onblur="form_preview()" onkeyup="value=value.replace(/[\W]/g,'') " onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))" />
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="必填！"></span>
{/if}
</div>
</div>
<div class="clearfix blank20"></div>
			

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">字段中文名</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<input class="form-control" name="cname" id="cname" value="{$data['cname']}"   onblur="form_preview()"/>
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="必填！"></span>
</div>
</div>
<div class="clearfix blank20"></div>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">提示信息</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<input class="form-control" name="tips" id="tips" value="<?php echo @setting::$var[$table][$field['name']]['tips'];?>"   onblur="form_preview()"/>
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="输入框右侧说明文字！"></span>
</div>
</div>
<div class="clearfix blank20"></div>


<?php
if($table == 'archive') {
?>
<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">绑定栏目</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::getform('catid',$form,$field,$data)}
</div>
</div>
<div class="clearfix blank20"></div>
<?php } ?>

<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">是否必填</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<input type="checkbox" name="isnotnull" id="isnotnull" value="1" <?php echo @setting::$var[$table][$field['name']]['isnotnull']=='1'?'checked':''?>  onblur="form_preview()"/>
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="是否为必填项！"></span>
</div>
</div>
<div class="clearfix blank20"></div>


<div  class="varchar2" >
<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">类型</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<select name="type" id="type" onchange="checktoselect(); form_preview();" class="form-control select">
<option value="int" <?php echo @setting::$var[$table][$field['name']]['type']=='int'?'selected':''?>>整数</option>
<option value="varchar" <?php echo @setting::$var[$table][$field['name']]['type']=='varchar'?'selected':''?>>单行文本</option>
<option value="text" <?php echo @setting::$var[$table][$field['name']]['type']=='text'?'selected':''?>>多行文本</option>
<option value="mediumtext" <?php echo @setting::$var[$table][$field['name']]['type']=='mediumtext'?'selected':''?>>超文本</option>
<option value="datetime" <?php echo @setting::$var[$table][$field['name']]['type']=='datetime'?'selected':''?>>日期</option>
<option value="_image" <?php echo @setting::$var[$table][$field['name']]['filetype']=='image'?'selected':''?>>图片</option>
<option value="_file" <?php echo @setting::$var[$table][$field['name']]['filetype']=='file'?'selected':''?>>附件</option>
<option value="0">[选择类...]</option>
 </select>
 </div>
</div>
<div class="clearfix blank20"></div>


<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">长度</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<input class="form-control" name="len" id="len" value="{$field['len']}"  onblur="form_preview()"/>
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="请输入数值！"></span>
</div>
</div>
<div class="clearfix blank20"></div>
               
<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">允许搜索</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<input <?php echo @setting::$var[$table][$field['name']]['type']!='varchar'?'disabled':''?> type="checkbox" size="10" name="issearch" id="issearch" value="1" <?php echo @setting::$var[$table][$field['name']]['issearch']=='1'?'checked':''?>  onblur="form_preview()"/>
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="是否允许搜索关键词,<br />只在字段类型为单行文本时有效！"></span>
</div>
</div>
<div class="clearfix blank20"></div>

</div>

<div class="select2" style="display:none">
 <div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">类型</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<select name="selecttype"  id="selecttype" onchange="checktovarchar(); form_preview();" class="form-control select">
<option value="radio" <?php echo @setting::$var[$table][$field['name']]['selecttype']=='radio'?'selected':''?>>单选</option>
<option value="checkbox" <?php echo @setting::$var[$table][$field['name']]['selecttype']=='checkbox'?'selected':''?>>多选</option>
<option value="select" <?php echo @setting::$var[$table][$field['name']]['selecttype']=='select'?'selected':''?>>下拉选择</option>
<option value="0">[非选择类...]</option>
</select>
</div>
</div>
<div class="clearfix blank20"></div>


<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">选项</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
{form::textarea('select',@setting::$var[$table][$field['name']]['select'],' rows="6" cols="40" onblur="form_preview();" ')}
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="每行一项，格式： (值)项，如：(1)非常好<div class="blank10"></span>
</div>
</div>
<div class="clearfix blank20"></div>
</div>


<div class="select2" style="display:none" id="select_preview">
<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">预览</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<span id="form_preview_title">
</span>&nbsp;
<span id="form_preview">
</span>
<span id="form_preview_tips">&nbsp;&nbsp;
</span>
</div>
</div>
<div class="clearfix blank20"></div>
</div>



    <script>
        {if @setting::$var[$table][$field['name']]['selecttype']}
        $(".select2").show("fast");
        $(".varchar2").hide("fast");
        $("#selecttype").attr('value','{=@setting::$var[$table][$field['name']]['selecttype']}');
        $("#type").val('0');
        form_preview();
        {else}
        $("#selecttype").val('0');
        {/if}
    </script>

  

<?php if($table == 'user') { ?>
<div class="row">
<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-right">是否注册页显示</div>
<div class="col-xs-8 col-sm-7 col-md-7 col-lg-5 text-left">
<?php echo form::checkbox('showinreg', 1,@setting::$var[$table][$field['name']]['showinreg']);?>
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="用户自定义字段是否在注册页面显示！"></span>
</div>
</div>
<div class="clearfix blank20"></div>
</div>
<?php } ?>


</div>

<div class="blank30"></div>
<div class="line"></div>
<div class="blank30"></div>
<input type="submit" name="submit" value=" 提交 " class="btn btn-primary" />

</form>


