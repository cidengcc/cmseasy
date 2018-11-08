
  <form name="listform" id="listform"  action="<?php echo uri();?>" method="post">
  <input type="hidden" name="wid" id="wid" value="<?php echo intval(front::get('id'));?>" />

  <div class="table-responsive">
<table class="table table-hover">
<thead>
<tr class="th">
<th align="center">编号</th>
          <th align="center">排序</th>
          <th align="center">名称</th>
          <th align="center">类型</th>
          <th align="center">操作</th>
        </tr>
      </thead>
      <tbody>
      {loop $data $d}
      <tr class="s_out" onmouseover="m_over(this)" onmouseout="m_out(this)" lang="0">
        <td align="center">{$d['id']}</td>
        <td align="center"><input type="text" name="sort[{$d['id']}]" value="{$d['sort']}" class="form-control" /></td>
        <td align="left"><input type="text" name="name[{$d['id']}]" value="{$d['name']}"class="form-control" /></td>
        <td align="left">{weixinmenu::getTypeName($d['typeid'])}</td>
        <td class="manage" align="center">
<a  href="<?php echo url('weixinmenu/edit/id/'.$d['id']);?>">编辑</a>
<a onclick="javascript: return confirm('确实要删除吗?');" href="<?php echo url('weixinmenu/del/wid/'.intval(front::$get['id']).'/id/'.$d['id']);?>">删除</a>
<a href="<?php echo url('weixinmenu/add/wid/'.intval(front::$get['id']).'/pid/'.$d['id']);?>">子菜单</a>
		</td>
      </tr>
      <?php
	  $weixinmenu = new weixinmenu();
	  $submenus = $weixinmenu->getsubmenu($d['id']);
	  if(is_array($submenus) && !empty($submenus)){
		  foreach($submenus as $submenu){
	  ?>
      <tr onmouseover="m_over(this)" onmouseout="m_out(this)" lang="0">
        <td align="center" >{$submenu['id']}</td>
        <td align="center"><input type="text" name="sort[{$submenu['id']}]" value="{$submenu['sort']}" class="form-control" /></td>
        <td align="left" class="htmldir">&nbsp;└&nbsp;<input type="text" name="name[{$submenu['id']}]" value="{$submenu['name']}" class="form-control" /></td>
        <td align="left">{weixinmenu::getTypeName($submenu['typeid'])}</td>
        <td class="manage" align="center">
<a  href="<?php echo url('weixinmenu/edit/id/'.$submenu['id']);?>">编辑</a>
<a onclick="javascript: return confirm('确实要删除吗?');" href="<?php echo url('weixinmenu/del/wid/'.intval(front::$get['id']).'/id/'.$submenu['id']);?>">删除</a>
		</td>
      </tr>
      <?php
		  }
	  }
	  ?>
      {/loop}
</tbody>
</table>
</div>

<div class="blank30"></div>
<div class="line"></div>
<div class="blank30"></div>

<input name="submit" value=" 保 存 " type="submit" class="btn btn-lightslategray" /> 
<input type="button" name="button" id="button" value=" 添加一级菜单 " onclick="window.location.href='<?php echo url('weixinmenu/add/wid/'.front::get('id').'/pid/0');?>';" class="btn btn-primary" />
<input type="button" name="button" id="button" value=" 发 布 " class="btn btn-steeblue" onclick="window.location.href='<?php echo url('weixinmenu/push/wid/'.intval(front::$get['id']));?>';" /> 

<div class="blank30"></div>
<div class="alert alert-warning alert-danger" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
<span class="glyphicon glyphicon-warning-sign"></span>	<strong>特别提示：</strong> 	[	由于微信有缓存,发布后要先取消公众号的关注,然后再重新关注公众号才会立刻看到结果	]	
</div>

</form>

