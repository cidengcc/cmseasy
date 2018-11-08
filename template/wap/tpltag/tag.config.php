<?php
$path = ROOT.'/template/'.config::get('template_mobile_dir').'/tpltag/';
$tagfileList = listDirOne($path, 'html');
$categoryarray = $contentarray = array();
foreach($tagfileList as $value){
	$path = str_replace('\\', '/', $path);
	$value = str_replace($path, '', $value);
	if(substr($value,0,11)=='tag_content'){
		$contentarray[$value] = $value;
	}
	if(substr($value,0,12)=='tag_category'){
		$categoryarray[$value] = $value;
	}
}
return array('content'=>$contentarray,
		     'category'=>$categoryarray);
?>