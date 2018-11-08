<div class="blank10"></div>
<div id="tagscontent" class="right_box">
  <form name="listform" id="listform"  action="<?php echo uri();?>" method="post">
    <table border="0" cellspacing="0" cellpadding="2" name="table1" id="table1" width="100%">
      <thead>
        <tr class="th">
          <th colspan="4" align="left" style="padding-left:20px;">被添加自动回复</th>
        </tr>
      </thead>
      <tbody>
      <tr class="s_out" onmouseover="m_over(this)" onmouseout="m_out(this)">
        <td colspan="4" align="left" ><a class="btn_b" href="<?php echo url('weixinreply/added/wid/'.intval(front::$get['id']));?>" >进入设置</a></td>
        </tr>
        </tbody>
    
      <thead>
        <tr class="th">
          <th colspan="4" align="left" style="padding-left:20px;">默认消息自动回复</th>
        </tr>
      </thead>
      <tbody>
      <tr class="s_out" onmouseover="m_over(this)" onmouseout="m_out(this)">
        <td colspan="4" align="left" ><a class="btn_b" href="<?php echo url('weixinreply/msged/wid/'.intval(front::$get['id']));?>">进入设置</a></td>
        </tr>
       </tbody>
   
      <thead>
        <tr class="th">
          <th align="center">编号</th>
          <th align="center">关键词</th>
          <th align="center">完整词</th>
          <th align="center">操作</th>
        </tr>
      </thead>
      <tbody>
      {loop $data $d}
      <tr class="s_out" onmouseover="m_over(this)" onmouseout="m_out(this)">
        <td align="center" >{$d['id']}</td>
        <td align="left" style="padding-left:10px;">{$d['keyword']}</td>
        <td align="left" style="padding-left:10px;">{$d['word']}</td>
        <td align="left" style="padding-left:10px;">
		<span class="hotspot" onmouseover="tooltip.show('点击编辑设置！');" onmouseout="tooltip.hide();"><a  href="<?php echo url('weixinreply/edit/id/'.$d['id']);?>"></a></span>
		<span class="hotspot" onmouseover="tooltip.show('确定要删除吗？');" onmouseout="tooltip.hide();"><a onclick="javascript: return confirm('确实要删除吗?');" href="<?php echo url('weixinreply/del/wid/'.intval(front::$get['id']).'/id/'.$d['id']);?>"></a></span>
		</td>
      </tr>
      {/loop}
        </tbody>
         </table>
          </div>
          <input type="button" class="btn btn-primary" name="button" id="button" value=" 添 加 新 词 " onclick="window.location.href='<?php echo url('weixinreply/add/wid/'.intval(front::$get['id']));?>';" />
  </form>

