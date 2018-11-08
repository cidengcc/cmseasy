
<div class="alert alert-warning alert-danger" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
<span class="glyphicon glyphicon-warning-sign"></span>	您可以编辑模板注释，这样在分类和内容选择模板时会更方便。
</div>




<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">
<div class="page">{$link_str}</div>
<div class="blank30"></div>
<div class="line"></div>
<div class="blank30"></div>
<div class="table-responsive">
<table class="table table-hover">
<thead>
        <tr class="th">
          <th align="center">档案</th>
          <th align="center">名称</th>
          <th align="center">简短描述</th>
        </tr>
</thead>
<tbody>
        {loop $tps $tpl $tp}
        {php $_tp=str_replace('_html','.html',$tp);}
        {php $_tp=str_replace('_css','.css',$_tp);}
        {php $_tp=str_replace('_js','.js',$_tp);}
      <tr class="s_out">
          <td align="left" style="padding-left:10px;">{$_tp}</td>
           <td align="left" style="padding-left:10px;">
           <input type="text" name="{$tpl}_name" class="form-control" value="{=@help::$var['template_note'][$tpl.'_name']}">
           </td>
           <td align="left" style="padding-left:10px;">
           <input type="text" name="{$tpl}_note" class="form-control" value="{=@help::$var['template_note'][$tpl.'_note']}">
           </td>
        </tr>
       {/loop}

      </tbody>
    </table>

</div>

<div class="page">{$link_str}</div>

<div class="blank30"></div>
<div class="line"></div>
<div class="blank30"></div>
<input type="submit" value=" 修改 " name="submit" class="btn btn-primary" />

</form>