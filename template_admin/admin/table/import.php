<div class="blank20"></div>

<div id="tagscontent" class="right_box">

<form action="<?php if(front::$act=='edit') $id="/id/".$data[$primary_key]; else $id=''; echo modify("/act/".front::$act."/table/".$table.$id);?>" method="post" enctype="multipart/form-data" name="form1"  onsubmit="return checkform();">
<input type="hidden" name="onlymodify" value=""/>
<table width="100%" border="0" cellspacing="0" cellpadding="0" id="table1">
<thead>
<tr class="th">
<th colspan="3">批量导入内容</th>
</tr>
</thead>
<tbody>
<tr>
  <td width="29%" align="right">请选择Excel2003文件</td>
  <td width="1%">&nbsp;</td>
  <td width="70%"><input type="file" name="excelFile" id="excelFile">&nbsp;<input type="submit" name="submit" value="提交" class="btn_d"/></td>
</tr>
</tbody>
</table>
<div class="blank20"></div>

</form>
</div>