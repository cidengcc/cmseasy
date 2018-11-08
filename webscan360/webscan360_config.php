<?php
if (!defined('WEBSCAN360')) exit('no access!');
define('ROOT', dirname(dirname(__FILE__)));
if(is_file(ROOT."/config/config.php")){
	$dbconfig = include(ROOT."/config/config.php");
}
return array(
	'DB_HOST'	=>	$dbconfig['database']['hostname'],
	'DB_USER'	=>	$dbconfig['database']['user'],
	'DB_PWD'	=>	$dbconfig['database']['password'],
	'DB_NAME'	=>	$dbconfig['database']['database'],
	'DB_PREFIX'	=>	$dbconfig['database']['prefix'],
	'port'		=>	'3306',
	'DB_TYPE'	=>	'mysql',
	'MID'		=>	'360webscan_cmseasy',	//webscan360
	'WRITABLE_PATH'	=>'',
	'SITE_URL'	=>	'',
	
);
