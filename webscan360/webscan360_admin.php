<?php
$ptime = $_POST['ptime'];
if(!empty($ptime)){
	require_once 'lib/webscan360_db.class.php';
	$webscan360db = new Webscan360_db();
	$res = $webscan360db->rec_getRow(array('var'=>'key'));
	if(!empty($res) && !empty($res['value'])){
		echo md5("webscan360:".$res['value'].":".$ptime);
	}
}
    	
