<?php
if(file_exists('index.html')){
	$url = 'index.html';
}else{
	$url = '../index.php?t=wap';
}
?>
<meta http-equiv="refresh" content="0;url=<?php echo $url;?>">