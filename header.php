<?php
    define("Title","御雅堂");
    // define("WEBSITE","https://jdztao.com/store/");
	include("conn.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/default.css">
	<link rel="stylesheet" type="text/css" href="css/img.css">


  <title><?=Title?></title>

</head>
<body>
<header>

	<a href="index.php">
		<h2 style="display: inline">御雅堂</h2>
		<!-- <img src="logo.png" width="60"> -->
	</a>
	<form class="search" action='index.php' method="get">
	<input type="search" id="query" name="key" placeholder="Search...">
	<button>GO</button>
	</form>	<hr>
</header>
<main>
<aside>

	<?php
	$sql = "SELECT sub_category.id as subid,category.name as cname,sub_category.name as sname FROM category,sub_category where category.id=sub_category.cid";
  	$result = mysqli_query($conn, $sql);
  	$category='';
	while($row = mysqli_fetch_assoc($result)) {
	  if($category !=$row['cname']) { 
		  if($category!='') {echo "</ul><br>";}
		  echo "<b>".$row['cname']."</b>&nbsp;<ul>";
		  $category=$row['cname'];
	  }
	  echo "<li><a href='index.php?cid=".$row["subid"]."'>".$row['sname']."</a>&nbsp;</li>";
	}
	?>

  </aside><article>