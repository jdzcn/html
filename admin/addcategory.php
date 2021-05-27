<?php

	include('header.php');
	include('test.php');

	// $id = htmlspecialchars($_GET['id']);
	$id = htmlspecialchars($_GET['category']);
	$name = htmlspecialchars($_GET['name']);
	// $cid = htmlspecialchars($_GET['cid']);
	// $desc = htmlspecialchars($_GET['desc']);

	if($id==0) $sql="insert into category (name) values ('".$name."')";
	else $sql="update category set name='".$name."' where id=".$id;

	// echo $sql;
	  if (mysqli_query($conn, $sql)) {
	      echo "一级分类变更成功！<br><br>";
	      echo "<a href='category.php'>继续变更</a>&nbsp; <a href='../index.php'>回到首页</a><br><br>";
	      echo "sql:".$sql;
	  } else {
	      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	  }

	  include('footer.php');
?>