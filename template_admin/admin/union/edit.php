
<form method="post" name="form1" action="<?php if(front::$act=='edit') $id="/id/".$data[$primary_key]; else $id=''; echo modify("/act/".front::$act."/table/".$table.$id);?>"  onsubmit="return checkform();">


<div class="blank20"></div>
<div id="tagscontent" class="right_box">

<table border="0" cellspacing="0" cellpadding="0" name="table1" id="table1" width="100%">

<tbody>

<tr>
<td width="19%" align="right">用户名</td>
<td width="1%">&nbsp;</td>
<td width="70%">
{$data['username']} 
</td>
</tr>

<tr>
<td width="19%" align="right">点数结算利率</td>
<td width="1%">&nbsp;</td>
<td width="70%">
{form::getform('profitmargin',$form,$field,$data)}&nbsp;%
</td>
</tr>
</table>
</div>

<div class="blank20"></div>
<input type="submit" name="submit" value="提交" class="btn btn-primary" />

</form>