<?php
define('ADMIN_DIR',preg_replace("%.*[\\\\/]%","",dirname(__FILE__)));
?>
<meta http-equiv="refresh" content="0;url=../index.php?admin_dir=<?php echo ADMIN_DIR;?>">
