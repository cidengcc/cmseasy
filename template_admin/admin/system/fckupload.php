<html>
<head>
<title>插入图片</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style>
td{font-size:10pt;}
</style>

<script>


function $(id) {
	return document.getElementById(id);
}


/*var E = frameElement._DialogArguments.Editor ;
var FCK	= E.FCK ;
var FCKTools		= E.FCKTools ;
var FCKDomTools		= E.FCKDomTools ;
var FCKDialog		= E.FCKDialog ;
var FCKBrowserInfo	= E.FCKBrowserInfo ;
var FCKConfig		= E.FCKConfig ;*/

/*var oEditor= window.parent.InnerDialogLoaded() ;
var oDOM= oEditor.FCK.EditorDocument ;
var FCK = oEditor.FCK;
var FCKDialog	=  oEditor.FCKDialog ;
*/
var oEditor= window.parent.InnerDialogLoaded() ;
var FCKeditorAPI=oEditor.FCKeditorAPI;
<?php
$fcid=session::get('fcid');
if(!$fcid || time()>session::get('fcid_life')) $fcid='content';
session::del('fcid');
session::del('fcid_life');
?>
var FCKoEditor = FCKeditorAPI.GetInstance('{$fcid}');

function ImageOK(img)
{
	inImg  = '<img src="'+img+'"/>';
	FCKoEditor.InsertHtml(inImg) ;
	window.parent.Cancel();

/*	//获得焦点,否则图片会飞出去~
	FCKoEditor.Focus();
	if(document.all) oDOM.selection.createRange().pasteHTML(inImg);
	else FCK.InsertHtml(inImg);
	window.parent.Cancel();*/

}


function UploadOK()
{
	inImg  = "<b style=\"color:red\">【这里处理结果，哈哈~】</b>";

	//获得焦点,否则图片会飞出去~
	//FCK.Focus();

	if(document.all) oDOM.selection.createRange().pasteHTML(inImg);
	else FCK.InsertHtml(inImg);

	//	FCKeditorAPI.GetInstance('FCKeditor1').InsertHtml(inImg);
	//	oDOM.selection.createRange().pasteHTML(inImg);

	//获取内容
	//alert(FCK.GetXHTML());

	//	window.parent.Cancel();
}

function SeePic(img) {
	$('preview').innerHTML='<img src="'+img+'"/>';
}
</script>


</head>
<body>

<form enctype="multipart/form-data" name="form1" id="form1" method="post" action="">
<input type="hidden" name="dopost" value="upload">

  <table width="100%" border="0">
    <tr height="20">
      <td colspan="3">
        </td>
    </tr>

    <tr height="25">
      <td colspan="3" nowrap> <fieldset>
        <legend>上传图片</legend>

        <table width="100%" border="0" cellspacing="0" cellpadding="0" id="table1">
          <tr height="30">
            <td align="right" nowrap>&nbsp;</td>
            <td colspan="2" nowrap>
            <input name="imgfile1" type="file" id="imgfile1" style="height:22;width:300px" class="binput" onchange="SeePic(this.value);">
            <br><br>
              &nbsp; <input type="submit" name="picSubmit" id="picSubmit" value=" 上 传  " style="height:22;" class="binput">
          </tr>
        </table>

        {loop $uploads $up}
          <table width="100%" border="0" cellspacing="0" cellpadding="0" id="table1">
          <tr height="30">
            <td align="right" nowrap>&nbsp;</td>
            <td colspan="2" nowrap>
            <script>ImageOK('{$up}');</script>
              </td>
          </tr>
        </table>
        {/loop}


        </fieldset></td>
    </tr>

  </table>
</form>


        <div id="preview" style="padding:10px;">
        </div>


</body>
</html>
