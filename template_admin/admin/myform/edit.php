<div class="blank20"></div>



<?php helper::filterField($field,$fieldlimit); ?>


<form method="post" name="form1" action="">

<div id="tagscontent" class="right_box">

<table border="0" cellspacing="0" cellpadding="0" name="table1" id="table1" width="100%">
<tbody>

{loop $field $f}
<?php
$name=$f['name'];
if(!isset($data[$name])) $data[$name]='';
if($name==$primary_key) continue; ?>
 
<tr>
<td width="19%" align="right">{$name|lang}</td>
<td width="1%">&nbsp;</td>
<td width="70%">
{form::getform($name,$form,$field,$data)}
</td>
</tr>
 
{/loop}

</tbody>
</table>
</div>

<div class="blank20"></div>
<input type="submit" name="submit" value=" 提交 " class="btn btn-primary" />

</form>