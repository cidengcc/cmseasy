<div class="table-responsive">
<table class="table table-hover">
<thead>
<tr class="th">
 <th class="s_out">名称(记录数)</th>
        <th>表名</th>
        <th class="manage">操作</th>
    </tr>
</thead>
<tbody>
{loop $tables $t}
<tr >
<td class="s_out" align="center">{=@setting::$var[$t]['myform']['cname']}
&nbsp;(&nbsp;<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="点击查看内容！"><a href="{url('table/list/table/'.$t)}" class="j"><font color="red"><?php  $_table=new defind($t); echo $_table->rec_count();?></font></a></span>&nbsp;)
</td>
<td class="catname">{$t}</td>
<td class="manage" align="center">

<a  href="{url('table/list/table/'.$t)}"  >查看</a></span>

<a  href="{url('form/add/form/'.$t,false)}" target="_blank">添加</a>
</td>
</tr>
{/loop}

</tbody>
</table>
    
</div>