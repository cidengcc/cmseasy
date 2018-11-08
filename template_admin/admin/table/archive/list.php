
<div class="row archive-list">
<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
     <form name="searchform" id="searchform"  action="<?php echo uri();?>" method="post">

            栏目&nbsp;
            <?php echo form::select('search_catid',get('search_catid')?get('search_catid'):0,category::option()); ?><div class="linebreak"><div class="blank10"></div></div>
            分类&nbsp;
            <?php echo form::select('search_typeid',get('search_typeid')?get('search_typeid'):0,type::option()); ?><div class="linebreak"><div class="blank10"></div></div>
			专题&nbsp;
            <?php echo form::select('search_spid',get('search_spid')?get('search_spid'):0,special::option()); ?>
<div class="blank5"></div>
            标题
            <input type="text" class="form-control" name="search_title" id="search_title" value="" />

            <input type="submit" value="搜索" name="submit"  onclick="this.form.action='{url::modify('table/'.get('table').'/type/search')}'" class="btn btn-steeblue search-btn" />
        </form>
		</div>
<div class="linebreak"><div class="blank10"></div></div>
<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 text-right">

<input type="button" value="添加内容" onClick="javascript:location.href='{$base_url}/index.php?case=table&act=add&table=archive&admin_dir={get('admin_dir')}'"  class="btn btn-primary" />
<input type="button" value="审核内容" onclick="javascript:window.location.href='{url::create('table/list/table/archive/needcheck/1')}'"  class="btn btn-steeblue" />
<input type="button" value="回收站" onclick="javascript:window.location.href='{url::modify("table/".get('table')."/deletestate/1/page/1")}'"  class="btn btn-navy" />
</div>

</div>
<div class="blank30"></div>
<form name="listform" id="listform"  action="<?php echo uri();?>" method="post">




<div class="table-responsive">
<table class="table table-hover">
<thead>
<tr class="th">
<th class="s_out"><input title="点击可全选本页的所有项目"  onclick="CheckAll(this.form)" type="checkbox" name="chkall" class="checkbox" /> </th>
                <th class="sort">排序</th>
                <th class="sort"><!--aid-->编号</th>
                <th class="htmldir"><!--catid-->栏目</th>
                <th class="catname"><!--title-->标题</th>
                <th class="htmldir"><!--attr1-->推荐位</th>
                <!-- <th>作者</th> -->
                <th class="htmldir"><!--view-->浏览</th>
                <th class="htmldir"><!--adddate-->添加时间</th>
                <th class="htmldir"><!--adddate-->防伪码</th>
                <th class="htmldir"><!--checked-->审核</th>

                <th class="manage" align="center">操作</th>
            </tr>

        </thead>
        <tbody>
            {loop $data $d}
            <tr>

                <td class="s_out" align="center"><input onclick="c_chang(this)" type="checkbox" value="{$d.$primary_key}" name="select[]" class="checkbox" /> </td>
                <td class="sort" align="center" class="table_input_c">{form::input("listorder[$d[$primary_key]]",$d['listorder'],'class="input_c"')}</td>

                <td class="sort" align="center">{cut($d['aid'])}</td>
                <td class="htmldir" align="center" style="width:100px;"><span class="hotspot" onmouseover="tooltip.show('查看内容所属栏目');" onmouseout="tooltip.hide();"><a href="<?php echo url("archive/list/catid/".$d['catid'],false);?>" target="_blank">{catname($d['catid'])}</a></span></td>
                <td align="left" class="catname">{cut($d['title'])}</td>
                <td class="htmldir" align="center">{if !empty($d['attr1'])}<span onmouseover="tooltip.show('{attr1($d['attr1'])}');" onmouseout="tooltip.hide();">{helper::yes($d['checked'])}</span>{/if}</td>
                <!-- <td align="center">{cut($d['username'])}</td> -->
                <td class="htmldir" align="center">{cut($d['view'])}</td>
                <td class="htmldir" align="center">{cut($d['adddate'])}</td>
                <td class="htmldir" align="center"><?php 
				if((config::get('isecoding') == 1 && $d['isecoding'] == '0') || $d['isecoding']=='1'){
					echo $d['ecoding'];	
				}
				?></td>
                <td class="htmldir" align="center">{helper::yes($d['checked'])}</td>

                <td class="manage" align="center">
                    <a href='<?php if($d['linkto']){echo $d['linkto'];}elseif(front::get('site')!='default'){echo config::get('site_url').'index.php?case=archive&act=show&aid='.$d[$primary_key];}else{echo url("archive/show/aid/$d[$primary_key]",false);}?>' target="_blank">查看</a>
                    <a href="<?php echo modify("act/edit/table/$table/id/$d[$primary_key]/deletestate/".front::get('deletestate'));?>">编辑</a>
                </td>
            </tr>
            {/loop}


        </tbody>
    </table>
</div>


    <input type="hidden" name="batch" value="">
    <input  class="btn btn-navy" type="button" value=" 排序 " name="order" onclick="this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='listorder'; this.form.submit();"/>

    <?php  if(!front::get('deletestate')) {?>
    <input type="button" value=" 审核 " name="check" onclick="if(getSelect(this.form)  && confirm('确实要审核ID为('+getSelect(this.form)+')的记录吗?')){ this.form.action='<?php echo modify('act/batch',true);?>';this.form.batch.value='check';this.form.submit();}" class="btn btn-dodgerblue" />
        <?php } ?>

    <?php if(!front::get('deletestate')) {?>
    <input type="button" value="删除" name="delete" onclick="if(getSelect(this.form) && confirm('确实要把ID为('+getSelect(this.form)+')的记录放到回收站吗?')){this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='deletestate'; this.form.submit();}" class="btn btn-lightslategray"/>


        <?php } ?>

    <input type="button" value="<?php if(get('table')=='archive') {?>彻底<?php } ?>删除" name="delete" onclick="if(getSelect(this.form) && confirm('确实要删除ID为('+getSelect(this.form)+')的记录吗?')){this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='delete'; this.form.submit();}" class="btn btn-steeblue" />

    <?php if(get('table')=='archive') {?>
    <input type="button" value=" 还原 " name="restore" onclick="if(getSelect(this.form) && confirm('确实要把ID为('+getSelect(this.form)+')的已删除记录还原吗?')){this.form.action='<?php echo modify('act/batch',true);?>'; this.form.batch.value='restore'; this.form.submit();}" class="btn btn-default" />
        <?php } ?>

      <div class="blank10"></div>
      设置推荐位：<?php
		preg_match_all('/\(([\d\w]+)\)(\S+)/im', $settings['attr1'], $result, PREG_SET_ORDER);
		foreach($result as $val){
			$result[$val[1]]=$val[2];
		}
		$result[0]='请选择...';
		echo form::select('attr1',0,$result);
	  ?>
      <input  class="btn btn-primary" type="button" value="设置" name="recommend" onclick="if(getSelect(this.form)  && confirm('确实要设置ID为('+getSelect(this.form)+')的推荐位吗?')){ this.form.action='<?php echo modify('act/batch',true);?>';this.form.batch.value='recommend';this.form.submit();}"/>
<div class="linebreak"><div class="blank10"></div></div>
       移动内容到：<?php echo form::select('catid',0,category::option()); ?>
       <input  class="btn btn-steeblue" type="button" value="移动" name="movelist" onclick="if(getSelect(this.form)  && confirm('确实要移动ID为('+getSelect(this.form)+')的记录吗?')){ this.form.action='<?php echo modify('act/batch',true);?>';this.form.batch.value='movelist';this.form.submit();}"/>

<div class="blank30"></div>
<div class="line"></div>

	<div class="page"><?php if(get('table')!='type' && front::get('case')!='field') echo pagination::html($record_count); ?></div>
	<div class="blank10"></div>

</form>

