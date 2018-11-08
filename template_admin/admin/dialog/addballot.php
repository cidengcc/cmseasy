<style type="text/css">
.tags{height:auto; width:96%; float:left; border: solid 1px #d9e6f4; font-size:12px; }
#tagstitle{ background: #eff4fa; height:32px; border-bottom:1px solid #d9e6f4; }
#tagstitle li{ border-right:1px solid #d9e6f4; width:auto; padding:0px 20px; text-align:center; float:left; list-style:none; height:33px; line-height:32px; font-size:12px; color:#3b73ac; font-weight:bold;}
#tagstitle li.hover{ background:#fff; display:block; }
#tagscontent{   border-top:none; padding:20px; height:auto; font-size:12px; color:#666;}
#tagscontent ul{ width:auto; border-bottom:1px solid #e8eef6; height:38px; line-height:38px;}
#tagscontent li{ width:auto; float:left; margin-right:20px;}
.skey{ border:1px solid #c4d9e9; width:300px; line-height:20px; height:20px; background:#fbfdff;}
.select1{ border:1px solid #c4d9e9; width:auto; height:20px; line-height:24px; margin-top:4px;}
.textarea1{ border:1px solid #c4d9e9; width:300px; height: 100px; margin-top:10px; margin-bottom:10px; }
#tagscontent tr{line-height:36px; height:auto; clear:both;}
#tagscontent td{border-bottom:1px solid #e8eef6;}
#submit{ width:50px; height:25px; background:#e0e8f3; border:1px solid #a9bdd8; color:#133366; margin:5px 10px 5px 0px; font-size:14px;}

.tips{color:#CCC;}



.table_td th {background:#dae6f1;border-top:1px solid #C3CED8;line-height:32px; border-left:1px solid #edf4f9; text-align:center; font-size:12px}
.table_td{ width:auto; height:auto; font-size:12px}
.table_td tr td{
line-height:32px;
border:1px solid #edf4f9;
font-size:12px
}
/*按钮*/
.button {
	 width:auto; height:24px; background:#e0e8f3; border:1px solid #a9bdd8; color:#133366; margin:5px 10px 5px 0px; font-size:12px; padding:1px;
}
</style>

<div class="tags">
 <div id="tagscontent"> 
 <div id="con_one_1">
 <div class="table_td" style="margin-top:10px; ">  

<form method="post" name="form1" action="<?php if(front::$act=='edit') $id="/id/".$data[$primary_key]; else $id=''; echo modify("/act/add/table/".$table.$id."/bid/".front::get('bid')."/type/dialog");?>"  onsubmit="return checkform();">
<table border="0" cellspacing="2" cellpadding="4" class="list" name="table" id="table" width="100%">
<thead>
      <tr onmouseover="this.bgColor='#FFFFF0';" onmouseout="this.bgColor='';" bgcolor="">
        <th colspan="2" align="center">添加选项</th>
      </tr>
	  </thead>
    <tbody>
      <tr onmouseover="this.bgColor='#FFFFF0';" onmouseout="this.bgColor='';" bgcolor="">
        <td class="left">选项名字</td>
        <td> {form::getform('name',$form,$field,$data)} </td>
      </tr>
    </tbody>
  </table>
  <div class="blank20"></div>
  <input type="submit" name="submit" value="提交" class="button"/>
</form>

</div>
</div>
</div>
</div>
