<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
//主要为跨域CORS配置的两大基本信息,Origin和headers


	include('conn.php');

	switch ($_SERVER['REQUEST_METHOD']) {
		
		case 'GET':

			
			$sql = "select * from category ";

			$ret = $db->query($sql);

			$dbdata = array();
			while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
				$dbdata[]=$row;
			}
			echo json_encode($dbdata);
			break;

		case 'POST':
			$name=$_GET['name'];

			$sql="insert into category (name) values ('".$name."')";
			echo $sql;
			if ($db->exec($sql)) echo "Update successful.";

			// $imgstr= $_POST['imgstr'];
			// $spec= $_POST['spec'];
			// $price= $_POST['price'];

			// $filename=$_FILES['images']['name'];
			// if(!empty($filename)) {
	  //       $newFilePath = "../images/".$filename;
	  //       $thumbnail="../thumbnail/".$filename;

	  //       	if(move_uploaded_file($_FILES['images']['tmp_name'], $newFilePath)) {
	  //         		exec("convert ".$newFilePath." -resize 1000x1000 ".$newFilePath);
	  //         		exec("convert ".$newFilePath." -resize 300x300 ".$thumbnail);

	  //         	}
   //        	}
			// 	
   //          	$sql.=$imgstr."',".$craft.",".$graph.",".$style.",'".$spec."',";
   //          	$sql.=$price.")";
			// if($pid!="0") {
			// 	$sql="update product set name='".$name."',cid=".$craft.",image='".$imgstr."',gid=".$graph.",sid=".$style.",spec='".$spec."',price=".$price;
   //          	$sql.=" where pid=".$pid;
			// }




        	// echo $sql;
           //  
          	// else echo "Error: ".$db->lastErrorMsg();
           
			

			break;	

		case 'DELETE':


/*			$sql="delete from sale where id=".$pid;

			// $img=$_GET['img'];

            if ($db->exec($sql)) echo "delete successful.";*/
          				

			break;	

		case 'PUT':
			echo 'update * from product where id='.$id;
			break;	

		default:

			break;
	}

	$db->close();



?>
