<?php

function read_line($fileName) {
        $fp = fopen($fileName, 'r');
        fseek($fp, 23);
        $data = fread($fp, 100);
        fclose($fp);
        return explode("\n",$data)[0];
}


include('header.php');

$q = isset($_GET['key'])? htmlspecialchars($_GET['key']) : '';
if($q) {
    exec("grep -lr '$q' ".DIR,$files);

    // exec("find ".DIR." -name '*$q*'",$files);
    #foreach($result as $line)
    #echo "<a href='view.php?name=$line'>".read_line($line)."</a><br>";
}
else {
    // $files = scandir(DIR,1);
    $files = array_filter(scandir(DIR,1), function($item) {return $item[0] !== '.';});
    /*foreach ($files as $file) {
        if ($file != '.' && $file != '..') {
            echo "<p class='datestr'>".substr($file,0,10).'</p>';
            echo "<p class='title'><a href='view.php?name=".DIR."$file'>".read_line(DIR.$file)."</a></p>";
        }
    }
    */
}
$page = !empty( $_GET['page'] ) ? (int) $_GET['page'] : 1;
$total = count($files); //total items in array    
$limit = 10; //per page    
$totalPages = ceil( $total/ $limit ); //calculate total pages
$page = max($page, 1); //get 1 page when $_GET['page'] <= 0
$page = min($page, $totalPages); //get last page when $_GET['page'] > $totalPages
$offset = ($page - 1) * $limit;
if( $offset < 0 ) $offset = 0;

$files= array_slice( $files, $offset, $limit );

foreach($files as $file) {
    $file=str_replace(DIR,'',$file);
    if ($file != '.' && $file != '..') {
        echo "<p class='datestr'>".substr($file,0,10).'</p>';
        echo "<p class='title'><a href='view.php?name=".DIR."$file'>".read_line(DIR.$file)."</a></p>";
    }
}

$link = 'index.php?page=%d';
$pagerContainer = '<div style="text-align:right">';   
if( $totalPages != 0 ) 
{
  if( $page == 1 ) 
  { 
    $pagerContainer .= ''; 
  } 
  else 
  { 
    $pagerContainer .= sprintf( '<a href="' . $link . '" style="color: #c00"> &#171; 上一页</a>', $page - 1 ); 
  }
  $pagerContainer .= ' <span>第<strong>' . $page . '</strong>页共' . $totalPages . '页</span>'; 
  if( $page == $totalPages ) 
  { 
    $pagerContainer .= ''; 
  }
  else 
  { 
    $pagerContainer .= sprintf( '<a href="' . $link . '" style="color: #c00"> 下一页 &#187; </a>', $page + 1 ); 
  }           
}                   
$pagerContainer .= '</div>';

echo $pagerContainer;


include('footer.php');
?>