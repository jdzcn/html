<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
//主要为跨域CORS配置的两大基本信息,Origin和headers

include "conn.php";
   // if(!$db){
   //    echo $db->lastErrorMsg();
   // } else {
   //    echo "Opened database successfully<br>";
   // }

	
	$pid = isset($_GET['pid'])? htmlspecialchars($_GET['pid']) : '';
	$sid = isset($_GET['sid'])? htmlspecialchars($_GET['sid']) : '';
	$key = isset($_GET['key'])? htmlspecialchars($_GET['key']) : '';
	
	switch ($_SERVER['REQUEST_METHOD']) {
		
		case 'GET':

			
			$sql = "SELECT * FROM product ";
			if($pid) $sql.="where pid=".$pid;
			elseif ($sid) {
				$sql.="where sid=".$sid;
			}
			elseif ($key) {
				$sql.="where name like '%".$key."%'";
			}
			
			$sql.=" order by pid desc limit 27";

			$ret = $db->query($sql);

			$dbdata = array();
			while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
				$dbdata[]=$row;
			}
			echo json_encode($dbdata);
			break;

		case 'POST':

		/*
		if ($_FILES["file"]["error"] > 0)
		{
		    echo "错误：" . $_FILES["file"]["error"] . "<br>";
		}
		else
		{
		    echo "上传文件名: " . $_FILES["file"]["name"] . "<br>";
		    echo "文件类型: " . $_FILES["file"]["type"] . "<br>";
		    echo "文件大小: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
		    echo "文件临时存储的位置: " . $_FILES["file"]["tmp_name"];
		}
			$name= $_POST['name'];
			$cid= $_POST['cid'];

			$imgstr= $_POST['imgstr'];
			$tags= $_POST['tags'];
			$spec= $_POST['spec'];
			$price= $_POST['price'];

			if($id) {
				$sql="update product set name='".$name."',cid=".$cid.",images='".$imgstr."',tags='".$tags."',spec='".$spec."',price=".$price;
            	$sql.=" where id=".$id;
			}
			else {
				$sql="insert into product (name,cid,images,tags,spec,price) values ('".$name."',";
            	$sql.=$cid.",'".$imgstr."','".$tags."','".$spec."',";
            	$sql.=$price.")";
        	}

            if (mysqli_query($conn, $sql)) echo "update successful.";
          	else echo "Error: ".$sql."<br>".mysqli_error($conn);
           */
			

			break;	

		case 'DELETE':

			/*
			$sql="delete from product where id=".$id;

            if (mysqli_query($conn, $sql)) echo "update successful.";
          	else echo "Error: ".$sql."<br>".mysqli_error($conn);			
			*/
			break;	

		case 'PUT':
			echo 'update * from product where id='.$id;
			break;	

		default:

			break;
	}

	$db->close();



?>
