<?php
	include('header.php');

	$pid = isset($_GET['pid'])? htmlspecialchars($_GET['pid']) : '';

	$sql = "SELECT * FROM product where id=";

	if($pid) $sql.=$pid;

	$r = mysqli_fetch_assoc(mysqli_query($conn,$sql));
	$id=$r['id'];
	$cid=$r['cid'];
	$imgs=explode('|',$r["images"]);
?>
	<main>
		<aside>
			<div>
			<a href='images/<?=$imgs[0]?>'><img src='thumbnail/<?=$imgs[0]?>'></a>

	
			</div>
	


	</aside><article><div style='margin:10px;'>
	<h3><?=$r['name']?></h3>
	<h4>编号：<?=$id?></h4>
	<h4>规格：<?=$r['spec']?></h4>
	<h3 style='color:red'>￥<?=$r['price']?></h3>
	</div>
	<div style="overflow: auto">
	<?php
		foreach ($imgs as $img) {
	?>
			<a href='images/<?=$img?>'><img class="thumbnail" src='thumbnail/<?=$img?>' ></a>
	<?php		
		}
	?>
	</div>
	</article>
	
	</main>

	<div class='row'>
	<h3>商品简介</h3>

<?php
	$tags=explode(',',$r['tags']);

	foreach ($tags as $tag) {
		$sql="select * from tag where id=".$tag;
		$r = mysqli_fetch_assoc(mysqli_query($conn,$sql));
		echo "<h4>".$r['name']."</h4>";
		echo "<p>".$r['description']."</p>";
	}
	echo "<h3>推荐商品</h3></div>";

	$sql = "SELECT id,name,images,price FROM product where id<>".$id." and cid=".$cid." limit 4";
	// echo $sql;
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

	include('footer.php');
?>