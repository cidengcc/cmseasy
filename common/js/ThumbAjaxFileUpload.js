function ajaxFileUpload(fid,purl,did)
{
    $(did).show();

    $.ajaxFileUpload
    (
    {
        url:purl,
        data: 'catid='+$('#catid'),
        secureuri:false,
        fileElementId:fid,
        dataType: 'json',
        type: 'POST',
        success: function (data, status)
        {

            if(typeof(data.error) != 'undefined')
            {
                if(data.error != '')
                {
                    alert(data.error);
                }else
                {
                    alert(data.msg);
                }
            }

            for(key in data) {

                if(data[key].code) {
                    code=data[key].code.replace(/&lt;/mg, "<");
                    eval(code);
                }
            }

        },
        error: function (data, status, e)
        {
            /*alert(allPrpos(data));
            alert(status);
            alert(allPrpos(e));*/
			if(e.number > -1 )
            alert('上传失败！'); //请检查附件大小、格式！'); ？
        },

        complete: function () {
            $(did).hide();
        }
    }
    )

    return false;

}

function get(id) {
	return document.getElementById(id);
}

function pics_delete(i,name){
    $("#"+name+i).val("");
    image_preview(name+i,"",1);
    $("#"+name+i+"_up").remove();
}

function pics_delete1(name){
    $("#pics"+name).val("");
    image_preview(name,"",1);
    $("#pics"+name+"_up").css("display","none");
}

function getuploadhtml(i,name,purl){
    cname = name;
    name = name+i;
    var code = '<div id="'+name+'_up"><span id="'+name+'_preview"></span><br><br>地址：<input name="'+name+'" id="'+name+'" value="" size="50"/> <input id="'+name+i+'_del" type="button" name="delbutton" value="删除" onclick="pics_delete("'+name+i+'").value)" style="display:none;"><br><br>'
    code += '上传：<input type="file" name="'+name+'_upload" id="'+name+'_upload" style="width:400px" onchange="image_preview(\''+name+'\',this.value,1)"/>&nbsp;&nbsp;<input type="button" name="'+name+'upload" id="'+name+'upload'+i+'" onclick="return ajaxFileUpload2(\''+name+'_upload\',\''+purl+'\',\'#'+cname+'_loading\');" value="上传" /></div>';
    return code;
}
function getuploadhtml1(i,name,purl){
    //i=Integer.valueOf(i).intValue();
    //name=Integer.valueOf(name).intValue();
    cname = name;
    name = name+1;
    var code = '<div id="pics'+cname+'_up"><span id="pics'+cname+'_preview"></span><br>地址：<input name="pics'+cname+'" id="pics'+cname+'" value="" size="50"/> <input id="pics'+cname+'_del" type="button" name="delbutton" value="删除" onclick="pics_delete1('+cname+')" style="display:none;"><br>'
    code += '上传：<input type="file" name="pics'+cname+'_upload" id="pics'+cname+'_upload" style="width:400px" onchange="image_preview(\'pics'+cname+'\',this.value,1)"/>&nbsp;&nbsp;<input type="button" name="pics'+cname+'upload" id="pics'+cname+'upload'+i+'" onclick="return ajaxFileUpload3(\'pics'+cname+'_upload\',\''+purl+'\',\'#pics'+cname+'_loading\','+name+');" value="上传" /></div>';
    return code;
}
var filecount =1;
function ajaxFileUpload2(fid,purl,did,name)//批量上传
{
    $(did)
    .ajaxStart(function(){
        $(this).show();
    })
    .ajaxComplete(function(){
        $(this).hide();
    });

    $.ajaxFileUpload
    (
    {
        url:purl,
        secureuri:false,
        fileElementId:fid,
        dataType: 'json',
        type: 'POST',
        success: function (data, status)
        {

            if(typeof(data.error) != 'undefined')
            {
                if(data.error != '')
                {
                    alert(data.error);
                }else
                {
                    alert(data.msg);
                }
            }

            for(key in data) {

                if(data[key].code) {
                    code=data[key].code.replace(/&lt;/mg, "<");
                    eval(code);
                }
            }
            $(getuploadhtml(filecount,name,purl)).appendTo("#uploadarea");
            filecount++;
        },
        error: function (data, status, e)
        {
            alert('上传失败！请检查附件大小、格式！');
        },

        complete: function () {

        }
    }
    )

    return false;

}

function ajaxFileUpload3(fid,purl,did,name)//批量上传
{
    $(did)
    .ajaxStart(function(){
        $(this).show();
    })
    .ajaxComplete(function(){
        $(this).hide();
    });

    $.ajaxFileUpload
    (
    {
        url:purl,
        secureuri:false,
        fileElementId:fid,
        dataType: 'json',
        type: 'POST',
        success: function (data, status)
        {

            if(typeof(data.error) != 'undefined')
            {
                if(data.error != '')
                {
                    alert(data.error);
                }else
                {
                    alert(data.msg);
                }
            }

            for(key in data) {

                if(data[key].code) {
                    code=data[key].code.replace(/&lt;/mg, "<");
                    eval(code);
                }
            }
            $(getuploadhtml1(filecount,name,purl)).appendTo("#uploadarea");
            filecount++;
        },
        error: function (data, status, e)
        {
            alert('上传失败！请检查附件大小、格式！');
        },

        complete: function () {

        }
    }
    )

    return false;

}


function image_preview(name,pic,limit) {
    if(pic) {
        $("#"+name+"_del").css("display","");
        if(limit)
            get(name+'_preview').innerHTML='<img src="'+pic+'" width="150">';
        else
            get(name+'_preview').innerHTML='<img src="'+pic+'">';
    }
    else get(name+'_preview').innerHTML='';
}


function image_cut(pid,pic,width,height) {
    if(!pic) {
        alert('没有图片可以裁剪！请先上传图片。');
        return false;
    }

    $('#'+pid).children('img').imgAreaSelect({
        aspectRatio: width+':'+height,
        onSelectChange: cut_preview,
        width: $('#'+pid).children('img').attr('width'),
        height: $('#'+pid).children('img').attr('height'),
        width2: width,
        height2: height
    });
    $('#cut_preview').attr('src',pic);
    $('#cut_preview').parent().css('width',width+'px');
    $('#cut_preview').parent().css('height',height+'px');

}

function cut_preview(img, selection,width,height,width2,height2) {
    var scaleX = width2 / selection.width;
    var scaleY = height2 / selection.height;

    $('#cut_preview').css({
        width: Math.round(scaleX * width) + 'px',
        height: Math.round(scaleY * height) + 'px',
        marginLeft: '-' + Math.round(scaleX * selection.x1) + 'px',
        marginTop: '-' + Math.round(scaleY * selection.y1) + 'px'
    });
    $('#x1').val(selection.x1);
    $('#y1').val(selection.y1);
    $('#x2').val(selection.x2);
    $('#y2').val(selection.y2);
    $('#w').val(width2);
    $('#h').val(height2);
}

function image_cut_save(url,pic,x1,y1,x2,y2,w,h) {
    $.ajax({
        url: url,
        type: 'POST',
        data: 'pic='+pic+'&x1='+x1+'&y1='+y1+'&x2='+x2+'&y2='+y2+'&w='+w+'&h='+h,
        dataType: 'json',
        timeout: 10000,
        error: function(){
        alert('Error loading XML document');
        },
        success: function(data){
            eval(data.code);
        }
    });
}

function addfiletoconent() {
    var FCKoEditor = FCKeditorAPI.GetInstance('content');
    inImg  = '<p><a target="_blank" href="'+get('attachment_path').value+'">附件：'+get('attachment_intro').value+'</a></p>';
    FCKoEditor.InsertHtml(inImg) ;
}

