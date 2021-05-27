<?php
	include('../conn.php');

  	// echo $_GET['id'];

  	$sql = "SELECT * FROM sub_category where id=".$_GET['id'];
  	$result = mysqli_query($conn, $sql);	

  	$row = mysqli_fetch_assoc($result);

  	echo json_encode($row);
	mysqli_close($conn);	

?>