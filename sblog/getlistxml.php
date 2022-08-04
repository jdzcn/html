<?php
include('read_line.php');

#$k = isset($_GET['k'])? htmlspecialchars(strtolower($_GET['k'])) : '';

$xml = new SimpleXMLElement('<xml/>');
$files = array_filter(scandir('_posts',1), function($item) {return $item[0] !== '.';});
#$title=array();
foreach($files as $file) {
    #$file=str_replace('_posts','',$file);
    #if(strpos($file,$k)!=false) 
    #$title[]= array(read_line('_posts/'.$file),$file);
    $blog = $xml->addChild('blog');
    $blog->addChild('title', read_line('_posts/'.$file));
    $blog->addChild('file', $file);      

}

Header('Content-type: text/xml');
print($xml->asXML());

?>
