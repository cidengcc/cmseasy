<div class="row">
<div class="padding10">
<div class="padding10">
<form name="settingform" id="settingform"  action="<?php echo uri();?>" method="post">

 {form::textarea('attr1',get('attr1')?get('attr1'):$settings['attr1'],'style="height:150px;"')}


<div class="blank30"></div>

<div class="alert alert-warning alert-danger" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
	<span class="glyphicon glyphicon-warning-sign"></span>	<strong>推荐位规则</strong> 	[	每行一项，格式： (值)项！]	
    </div>


<div class="alert alert-warning alert-dismissible fade in" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
	<span class="glyphicon glyphicon-blackboard"></span>	<strong>例如</strong> 	<br/>
						<br/>(0)无
                        <br/>(1)推荐位一
                        <br/>(2)推荐位二
                        <br/>(3)推荐位三
                        <br/>(4)推荐位四
                        <br/>(5)推荐位五	
    </div>




      
<span class="tips" data-toggle="tooltip" data-html="ture" data-placement="left" title="仅限于模板中使用该参数时有效！<br >默认: {type::getwidthofthumb(get('id'))} px × {type::getheightofthumb(get('id'))} px！" onmouseout="tooltip.hide();"></span>
</div>


<div class="blank30"></div>
<input type="submit" name="submit" value="提交" class="btn btn-primary"/>

 </form>
</div>
</div>
</div>