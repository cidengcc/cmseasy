<div id="tagscontent" class="right_box">

<form name="typeform" method="post" action="<?php echo front::$uri;?>">
<table border="0" cellspacing="0" cellpadding="0" name="table1" id="table1" width="100%">
<tbody>
<tr>
	<td width="19%" align="right">地区</span></td>
	<td width="1%">&nbsp;</td>
                        <td width="70%"><?php echo form::select('province_id',
    get('province_id') ? get('province_id') : 0, area::province_option()); ?>
<?php echo form::select('city_id', get('city_id') ? get('scity_id') : 0,
        area::city_option()); ?>
<?php echo form::select('section_id', get('section_id') ? get('section_id') : 0, area::section_option()); ?>
	&nbsp;&nbsp;
	<?php echo form::submit('更新');
	?>
    </td></tr></tbody>
</table>
</form>
</div>