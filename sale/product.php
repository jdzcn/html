<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
//主要为跨域CORS配置的两大基本信息,Origin和headers

include "conn.php";

	
	$pid = isset($_GET['pid'])? htmlspecialchars($_GET['pid']) : '';
	
	switch ($_SERVER['REQUEST_METHOD']) {
		
		case 'GET':

			
			$sql = "SELECT pid,name,price,cost,hex(img) as img FROM product ";

			if($pid) $sql.="where pid=".$pid;

			$ret = $db->query($sql);

			$dbdata = array();
			while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
				$dbdata[]=$row;
			}
			echo json_encode($dbdata);
			break;

		case 'POST':

			$pid=$_POST['prod_id'];
			$name= $_POST['prod_name'];
			$cost= $_POST['prod_cost'];
			$price= $_POST['prod_price'];

			$filename=$_FILES['image']['name'];



			if(!empty($filename)) {
	        	$thumbnail="_".$filename;

	        	if(move_uploaded_file($_FILES['image']['tmp_name'], $filename)) {
	          		exec("convert ".$filename." -resize 100x100 ".$thumbnail);
	          		echo $thumbnail." create sccessful.<br>";
	          	}
          	}

			$sql="insert into product (name,cost,price,img) values ('".$name."',".$cost.",".$price.",:photo)";

			if($pid!="0") {
				$sql="update product set name='".$name."',cost=".$cost.",price=".$price.",img=:photo where pid=".$pid;
			}

			echo $sql+"<br>";

			$photo = file_get_contents($thumbnail);



	        $query = $db->prepare($sql);
	        $query->bindValue(':photo',$photo,SQLITE3_BLOB);
	        $result = $query->execute();
			exec("rm -rf ".$filename);
			echo $filename." delete sccessful.<br>";
			exec("rm -rf ".$thumbnail);
			echo $thumbnail." delete sccessful.<br>";
        	
            if ($result) echo "update successful.";
          	else echo "Error: ".$db->lastErrorMsg();

			break;	

		case 'DELETE':


			break;	

		case 'PUT':
			echo 'update * from product where id='.$id;
			break;	

		default:

			break;
	}

	$db->close();



?>
