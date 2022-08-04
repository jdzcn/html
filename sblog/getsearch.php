<?php
include('read_line.php');

$k = isset($_GET['k'])? htmlspecialchars(strtolower($_GET['k'])) : '';


$files = array_filter(scandir('_posts',1), function($item) {return $item[0] !== '.';});
$title=array();
foreach($files as $file) {
    #$file=str_replace('_posts','',$file);
    if(strpos($file,$k)!=false) 
      $title[]= array(read_line('_posts/'.$file),$file);

}
#$list=array($files,$title);
echo json_encode($title);

?>
