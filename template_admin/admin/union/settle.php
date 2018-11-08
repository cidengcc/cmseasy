<div class="blank20"></div>
<div id="tagscontent" class="right_box">

<table border="0" cellspacing="0" cellpadding="0" name="table1" id="table1" width="100%">
<thead>
<tr class="th">
<th colspan=6>本期结算信息</th> 
</tr> 
</thead>
<tbody>
<tr align="center"> 
<td class="tablerowhighlight">用户名</td> 
<td class="tablerowhighlight">本期累计点数</td> 
<td class="tablerowhighlight">利润率</td> 
<td class="tablerowhighlight">本期结算金额</td> 
<td class="tablerowhighlight">支付帐号</td> 
<td class="tablerowhighlight">操作</td> 
</tr> 
<form method="post" name="myform" action="<?php echo uri();?>"> 
<tr align="center"> 
<td class="tablerow" width="15%">{$data['username']}</td> 
<td class="tablerow" width="17%">{$data['point']}</td> 
<td class="tablerow" width="19%">{$data['profitmargin']}%</td> 
<td class="tablerow" width="13%"><font color="red"><?php echo $data['point']*($data['profitmargin']/100);?>元</font></td> 
<td class="tablerow" width="30%">{$data['payaccount']}</td> 
<td class="tablerow" width="15%"> 
<input type="hidden" name="settleexpendamount" value="{$data['point']}"> 
<input type="hidden" name="profitmargin" value="{$data['profitmargin']}"> 
<input type="hidden" name="payaccount" value="{$data['payaccount']}"> 
<input type="submit" name="submit" value="确认结算" <?php if($data['point']*($data['profitmargin']/100)==0){?> disabled="disabled" <?php }?> /> 
</td> 
</tr> 
</body>
</form> 
</table> 

<table border="0" cellspacing="0" cellpadding="0" name="table1" id="table1" width="100%">
<thead>
<tr class="th"> 
<th colspan=4>用户详细信息</th> 
</tr> 
</thead>
<tbody>
<tr> 
<td colspan=2 align="center" class="tablerowhighlight">统计信息</td> 
<td colspan=2 align="center" class="tablerowhighlight">用户资料</td> 
</tr> 
<tr> 
<td class="tablerow" width="20%">来访次数</td> 
<td class="tablerow" width="20%">{$data['visits']} 次</td> 
<td class="tablerow" width="20%">用户名</td> 
<td class="tablerow" width="40%">{$data['username']}</td> 
</tr> 
<tr> 
<td class="tablerow">注册用户数</td> 
<td class="tablerow">{$data['registers']} 个</td> 
<td class="tablerow">姓名</td> 
<td class="tablerow">{$data['nickname']}</td> 
</tr> 
<tr> 
<td class="tablerow">用户累计总点数</td> 
<td class="tablerow"><?php echo $data['totalexpendamount'] + $data['point'];?></td> 
<td class="tablerow">支付帐号</td> 
<td class="tablerow"><font color="red">{$data['payaccount']}</font></td> 
</tr> 
<tr> 
<td class="tablerow">已结算用户点数总额</td> 
<td class="tablerow">{$data['totalexpendamount']}</td> 
<td class="tablerow">电话</td> 
<td class="tablerow">{$data['tel']}</td> 
</tr> 
<tr> 
<td class="tablerow">已结算总额</td> 
<td class="tablerow">{$data['totalpayamount']} 元</td> 
<td class="tablerow">网站</td> 
<td class="tablerow">{$data['website']}</td> 
</tr> 
<tr> 
<td class="tablerow">本期用户累计点数</td> 
<td class="tablerow">{$data['point']}</td> 
<td class="tablerow">E-MAIL</td> 
<td class="tablerow">{$data['e_mail']}</td> 
</tr> 
<tr> 
<td class="tablerow">本期应结算金额</td> 
<td class="tablerow"><?php echo $data['point']*($data['profitmargin']/100);?> 元</td> 
<td class="tablerow">QQ</td> 
<td class="tablerow">{$data['qq']}</td> 
</tr> 
<tr> 
<td class="tablerow">本期利润率</td> 
<td class="tablerow">{$data['profitmargin']}%</td> 
<td class="tablerow">注册IP/时间</td> 
<td class="tablerow">{$data['regip']} / {date('Y-m-d H:i:s',$data['regtime'])}</td> 
</tr> 
<tr> 
<td class="tablerow">上期结算金额</td> 
<td class="tablerow">{$data['lastpayamount']} 元</td> 
<td class="tablerow">地址</td> 
<td class="tablerow">{$data['address']}</td> 
</tr> 
<tr> 
<td class="tablerow">上期结算时间</td> 
<td class="tablerow">{if $data['lastpaytime']}{date('Y-m-d H:i:s',$data['lastpaytime'])}{/if}</td> 
<td class="tablerow"></td> 
<td class="tablerow"></td> 
</tr> 
</tbody>
</table> 

</div>