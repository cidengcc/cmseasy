{$tips}


<a class="hover">添加	[	<strong>{if config::get('lang_type')=='cn'}中文{elseif config::get('lang_type')=='en'}英文{else}{config::get('lang_type')}{/if}</strong>		]	语言包</a>





<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">


<div class="table-responsive">
<table class="table table-hover">
<thead>
 
        <tr>
          <th>中文备注</th>
          <th>调用项</th>
          <th>前台显示值</th>
        </tr>
        </thead>

<tbody id="myList" >
        

     <tr>
           <td align="center">
           <input type="text" name="cnnote" value="" class="form-control" />
           </td>
           <td align="center">
           <input type="text" name="key" value="" class="form-control" />
          </td>
           <td align="center">
           <input type="text" name="val" value="" class="form-control" />
           </td>
        </tr>
        
      </tbody>
    </table>




</div>
</div>

 
<div class="blank20"></div>
<input type="submit" value=" 增加 " name="submit" class="btn btn-primary" />


</form></div>