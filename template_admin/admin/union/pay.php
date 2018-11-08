<ul class="nav nav-tabs" role="tablist">
<li><a href="{$base_url}/index.php?case=table&act=list&table=friendlink&admin_dir={get('admin_dir')}&site=default">联盟配置</a></li>
<li><a href="{$base_url}/index.php?case=union&act=visit&table=union&admin_dir={get('admin_dir')}&site=default">访问统计</a></li>
<li><a href="{$base_url}/index.php?case=union&act=reguser&table=union&admin_dir={get('admin_dir')}&site=default">注册统计</a></li>
<li class="active"><a href="{$base_url}/index.php?case=union&act=pay&table=union&admin_dir={get('admin_dir')}&site=default">结算记录</a></li>
</ul>

<div class="blank30"></div>
<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">


<div class="table-responsive">
<table class="table table-hover">
<thead>
<tr class="th">
          <th class="catname" align="center">联盟用户</th>
          <th align="center" class="htmldir">结算日期</th>
          <th align="center" class="htmldir">结算金额</th>
          <th align="center" class="htmldir">支付账号</th>
          <th align="center" class="htmldir">操作人员</th>
        </tr>

</thead>


<tbody>
{loop $data $d}
<tr>

<td class="catname" align="left">{$d['username']}</td>
<td align="center" class="htmldir">{date('Y-m-d H:i:s',$d['addtime'])}</td>
<td align="center" class="htmldir">{$d['amount']} 元</td>
<td align="center" class="htmldir"><font color="red">{$d['payaccount']}</font></td>
<td align="center" class="htmldir">{$d['inputer']}</td>

</tr>
{/loop}


</tbody>
</table>
</div>

<div class="page"><?php echo pagination::html($record_count); ?></div>
<div class="blank30"></div>
<div class="line"></div>
<div class="blank30"></div>

<input type="hidden" name="batch" value="">
<input  class="btn btn-primary" type="button" value=" 删除 " name="delete" onclick="if(getSelect(this.form) && confirm('确实要删除ID为('+getSelect(this.form)+')的记录吗?')){this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='delete'; this.form.submit();}"/>

</form>