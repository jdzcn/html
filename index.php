<?php
	include("header.php");


	$cid = isset($_GET['cid'])? htmlspecialchars($_GET['cid']) : '';
	$key = isset($_GET['key'])? htmlspecialchars($_GET['key']) : '';

	// $sql="select id,name,images,price from product ";

	$find= array("where cid=".$cid,"where name like '%".$key."%'","order by id desc ");
			

	$sql = "SELECT COUNT(*) as total FROM product ";

	if($cid) $fstyle=0;
	elseif ($key) $fstyle=1; 
	else $fstyle=2;

	$sql=$sql.$find[$fstyle];



$perPage = 12;
$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
$startAt = $perPage * ($page - 1);

$r = mysqli_fetch_assoc(mysqli_query($conn,$sql));
$total=$r['total'];
$totalPages = ceil($total / $perPage);

$link = 'index.php?page=%d';
$pagerContainer = '<div class="row" style="text-align:right">';   
$pagerContainer .= $total.'件商品'; 
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



	$sql = "SELECT id,name,images,price FROM product ";
	$sql=$sql.$find[$fstyle]." limit $startAt,$perPage";

  	$result = mysqli_query($conn, $sql);
	echo '<div class="main">';
    while($row = mysqli_fetch_assoc($result)) {
    	$img=explode('|',$row["images"]);
?>

	<div class="responsive">
	  <div class="img">
	    <a target="_blank" href="view.php?pid=<?=$row['id']?>">
	      <img src="<?="thumbnail/".$img[0]?>" alt="<?=$row['name']?>"></a>
		  <div class="desc"><?=$row['name']?></div>
		  <span style="color:red"><?="￥".$row['price']?></span>

	  </div>
	</div>	

<?php
	}
	echo "</div>";
	echo $pagerContainer;
	
	include("footer.php");
?>