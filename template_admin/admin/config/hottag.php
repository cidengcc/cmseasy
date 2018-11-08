<div class="blank20"></div>

<div id="tagscontent" class="right_box">

  <form name="settingform" id="settingform"  action="<?php echo uri();?>" method="post">


<table border="0" cellspacing="2" cellpadding="4" class="list" name="table1" id="table1" width="100%">
<tbody>
            <tr>
                <td>
                <div  style="margin-left:10px; margin-top:10px;">
				       {form::textarea('hottag',$hottags['hottag'],'cols=50 rows=50 style="height:150px;"')}
				 <div class="blank20"></div>
                    <span>
                        <br/>每行为一个标签
						<br/><br/>
						<strong>如：</strong><br/>
                        <br/>(1)热门标签一
                        <br/>(2)热门标签二
                        <br/>(3)热门标签三
                        <br/>(4)热门标签四
                        <br/>(5)热门标签五
                    </span>
                  </div>
                </td>
            </tr>

        </tbody>
    </table>
</div>

<div class="blank20"></div>
<input type="submit" name="submit" value="提交" class="btn btn-primary"/>
</form>


