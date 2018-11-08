<input class="btn btn-primary" type="button" value=" 添加公众号 " onclick="javascript:window.location.href='{$base_url}/index.php?case=weixin&act=add&admin_dir={get('admin_dir')}&site=default'" />
<div class="blank30"></div>
<div id="tagscontent" class="right_box">
<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">


  <div class="table-responsive">
<table class="table table-hover">
<thead>
<tr class="th">
<th class="catid" align="center"><!--id-->编号</th>
          <th class="catname" align="center"><!--name-->公众号名称</th>
          <th class="catid" align="center">原始ID</th>
          <th class="htmldir" align="center"><!--url-->微信号</th>
          <th class="manage" align="center">操作</th>
        </tr>

</thead>
<tbody>
{loop $data $d}
<tr class="s_out" onmouseover="m_over(this)" onmouseout="m_out(this)" lang="0">

<td class="catid" align="center" >{$d['id']}</td>
<td class="catname" align="left">{$d['name']}</td>
<td class="catid" align="left">{$d['oldid']}</td>
<td class="htmldir" align="left">{$d['weixinid']}</td>
<td class="manage" align="center">
<a  href="<?php echo url('weixin/add2/id/'.$d['id']);?>">设置</a>
<a href="<?php echo url('weixinmenu/list/id/'.$d['id']);?>">菜单</a>
<a href="<?php echo url('weixinreply/list/id/'.$d['id']);?>">回复</a><a onclick="javascript: return confirm('确实要删除吗?');" href="<?php echo url('weixin/del/id/'.$d['id']);?>">删除</a>
</td>
</tr>
{/loop}
      </tbody>
    </table>
	</div>
</form>
