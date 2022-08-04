<?php
include('config.php');
include('read_line.php');

$k = isset($_GET['k'])? htmlspecialchars(strtolower($_GET['k'])) : '';

if ($k) {
	$files=scandir(DIR,1);
	foreach($files as $file) {
		if(strpos($file,$k)===false) echo '';
		else echo '<p><a href=view.php?name='.DIR.$file.'>'.read_line(DIR.$file).'</a></p>';	
	}
}

?>