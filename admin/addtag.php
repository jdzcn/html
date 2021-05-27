<?php

	include('header.php');
	include('test.php');

	$id = htmlspecialchars($_GET['id']);
	$name = htmlspecialchars($_GET['name']);
	$desc = htmlspecialchars($_GET['desc']);

	if($id==0) $sql="insert into tag (name,description) values ('".$name."','".$desc."')";
	else $sql="update tag set name='".$name."',description='".$desc."' where id=".$id;

	// echo $sql;
	  if (mysqli_query($conn, $sql)) {
	      echo "标签变更成功！<br><br>";
	      echo "<a href='tag.php'>继续变更</a>&nbsp; <a href='../index.php'>回到首页</a><br><br>";
	      echo "sql:".$sql;
	  } else {
	      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	  }

	  include('footer.php');
?>