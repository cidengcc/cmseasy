<?php  //echo('【待续】');return;?>
<div id="position">
<a href="javascript:history.back(-1)" title="返回上一页"><img alt="返回上一页" src="{$skin_path}/undo.gif" style="float:right;" /></a>当前位置：模板注释
</div>



<div class="padding10">
<img src="{$skin_path}/wj.gif" style="margin-right:10px;" />欢迎来到编辑模板注释页面。您可以编辑模板注释，这样在分类和内容选择模板时会更方便。
</div>

<div class="blank10"></div>

<script type="text/javascript" src="{$base_url}/js/list.js"></script>

<script src="{$base_url}/common/js/jquery/jquery-latest.js"></script>
<script src="{$base_url}/common/js/jquery/ui/ui.core.js"></script>
<script src="{$base_url}/common/js/jquery/ui/ui.sortable.js"></script>

  <script>
  $(document).ready(function() {
    $("#myList").sortable({});
  });
  </script>

  <style>
  #myList tr{
   	cursor:move;
  }
  </style>

<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">


<input type="submit" value="修改" name="submit"  style="float:right;" class="button" />

<div class="blank10"></div>

<table border="0" cellspacing="2" cellpadding="4" class="list" name="table1" id="table1">
<thead>
 
        <tr>
          <th>名称</th>
          <th>格式</th>
          <th>描述</th>
        </tr>
        </thead>

<tbody id="myList" >
        
       {loop $tags $i $tag}
       {if @help::$var['tag_note2']['name'][$i] || @help::$var['tag_note2']['format'][$i] || @help::$var['tag_note2']['note'][$i]}
      <tr class="s_out">
           <td>
           <input type="text" name="tag[name][]" size="15" value="{=@help::$var['tag_note2']['name'][$i]}">
           </td>
           <td>
            <textarea rows="3" cols="30" name="tag[format][]" wrap="hard">{=@help::$var['tag_note2']['format'][$i]}</textarea>
          </td>
           <td>
           <textarea rows="5" cols="45" name="tag[note][]">{=@help::$var['tag_note2']['note'][$i]}</textarea>
           </td>
        </tr>
        {/if}
       {/loop}


     <tr class="s_out">
           <td>
           <input type="text" name="tag[name][]" size="10" value="">
           </td>
           <td>
            <textarea rows="3" cols="30" name="tag[format][]" wrap="hard"></textarea>
          </td>
           <td>
           <textarea rows="5" cols="45" name="tag[note][]"></textarea>
           </td>
        </tr>
        
      </tbody>
    </table>



<div class="blank10"></div>
    <input type="submit" value=" 修改 " name="submit" class="btn btn-primary" />



</form> 

