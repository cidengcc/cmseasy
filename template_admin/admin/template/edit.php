
<script>
    function hide_edit(id) {
        $(id+'_save_button').css('display','none');
        $(id).hide('fast');
        $(id+'_textarea').html('');
        //$(id+'_content').resizable('destroy')
    }

    function show_edit(id) {
        $.ajax({
            url: '<?php echo url('template/fetch',true);?>',
            data:'&id='+id,
            type: 'POST',
            dataType: 'json',
            timeout: 3000,
            error: function(){
            },
            success: function(data){
                $(id+'_textarea').html(data.content);
                if(data.content)
                    $(id+'_save_button').css('display','block');
            }
        });

        $(id).show('fast');
        //$(id+'_content').resizable();
    }


    function show_fckedit(id) {
        $.ajax({
            url: '<?php echo url('template/fckedit',true);?>',
            data:'&id='+id,
            type: 'POST',
            dataType: 'json',
            timeout: 3000,
            error: function(){
            },
            success: function(data){
                $(id+'_textarea').html(data.content);
                if(data.content)
                    $(id+'_save_button').css('display','block');
            }
        });

        $(id).show('fast');
        //$(id+'_content').resizable();
    }

    function toggle_edit(id,fck) {
        if($(id).css('display')=='none') {
            show_edit(id);
            $(id+'_state_toggle').html('[收起]');
        }
        else {
            if(fck)  show_fckedit(id);
            else{
                hide_edit(id);
                $(id+'_state_toggle').html('[查看]');
            }
        }
    }


    function edit_save(id,content) {
        $('#sid').val(id);
        $('#slen').val(content.length);
        $('#scontent').val(content);
        $('#editform').ajaxSubmit(function(data) {
            if(data=='ok') alert("保存成功!");
            else alert("保存失败!");
        });
    }


    function helper() {
        $("#example").dialog({ modal: true });
    }
</script>






<form name="form1" id="form1" method="post" action="">


<div class="page">{$link_str}</div>


<div class="table-responsive">

<table class="table table-hover">
<thead>
<tr class="th">
                <th>档案</th>
                <th>名称</th>
                <th>简短描述</th>
            </tr>
        </thead>
    </table>

  
    {loop $tps $tpl $tp}
    <?php if (preg_match('/#/',$tp)) continue; ?>
    {php $_tp=str_replace('_html','.html',$tp);}
    {php $_tp=str_replace('_css','.css',$_tp);}
    {php $_tp=str_replace('_js','.js',$_tp);}
    {php $tpt=str_replace('/','_d_',$tpl);}

    {php $cs=preg_replace('%\/.*%', '', $tpl);}


    <div {if preg_match('/\.|└/',$tp)}class="{$cs}_li" style="display:none" {else} id="{$tpt}_div"  style="margin-top:10px"{/if}>
        <table border="0" cellspacing="0" cellpadding="0" name="table1" id="table1" width="100%">
            <tbody>
                <tr class="s_out">
                    <td width="38%" style="padding-left:10px;"><span style="float:left;">
                            {$_tp}</span>
                        {if preg_match('/.(html|css|js)/',$tp)}
                        <span style="cursor:pointer;padding-left:10px" onclick="toggle_edit('#{$tpt}')" id="{$tpt}_state_toggle">[查看]</span>
                        {elseif !preg_match('/└/',$_tp)}
                        <span style="float:left;cursor:pointer;" onclick="$('.{$tpt}_li').toggle()" id="{$tpt}_dir_state_toggle">&nbsp;<img src="{$skin_path}/images/folder.gif" /></span>
                        {/if}
                    </td>
                    <td  width="31%" style="padding-left:10px;">
                        <input type="text" name="{$tpl}_name" class="form-control" value="{=@help::tpl_name($tpl)}">
                    </td>
                    <td width="31%" style="padding-left:10px;">
                        <input type="text" name="{$tpl}_note" class="form-control" value="{=@help::tpl_note($tpl)}">
                    </td>
                </tr>
            </tbody>
        </table>

        <!--dir-->
        <div  id="{$tpt}" style="display:none">
            <div class="blank10"></div>
                            <div id="{$tpt}_textarea" style="width:680px;"><img src="{$skin_path}/images/loading.gif" />
                                <textarea id="{$tpt}_content"  style="width:100%;height:50%" name="{$tpt}_content"></textarea>
                            </div>

                            <!-- <div class="padding10">
                                <div id="{$tpt}_save_button" style="display:none">
                                    <input type="button" value="保存" name="{$tpt}_edit" class="btn_d" onclick="if(get('{$tpt}_fck')) content=getContent('{$tpt}_content'); else content=this.form.{$tpt}_content.value;  edit_save('{$tpt}',content);"/>
                                </div>
                            </div> -->
                       
        </div>
<div class="blank10"></div>
    </div>
    {/loop}
</div>

    <div class="blank20"></div>
    <!-- <input type="submit" value=" 修改 " name="submit" class="btn btn-primary" /> -->




</form>
<div class="page">{$link_str}</div>


<form name="editform" id="editform" method="post" action="<?php echo url('template/save');?>">
    <input type="hidden" value="" name="sid" id="sid" />
    <input type="hidden" value="" name="slen" id="slen" />
    <input type="hidden" value="" name="scontent" id="scontent" />
</form>