<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
//主要为跨域CORS配置的两大基本信息,Origin和headers


	include('conn.php');
	
	$id = isset($_GET['pid'])? htmlspecialchars($_GET['pid']) : '';
	$cid = isset($_GET['cid'])? htmlspecialchars($_GET['cid']) : '';
	$key = isset($_GET['key'])? htmlspecialchars($_GET['key']) : '';



	switch ($_SERVER['REQUEST_METHOD']) {
		
		case 'GET':

			
			$sql = "SELECT * FROM product ";
			if($id) $sql.="where id=".$id;
			elseif ($cid) {
				$sql.="where cid=".$cid;
			}
			elseif ($key) {
				$sql.="where name like '%".$key."%'";
			}
			else $sql.="order by id desc limit 24";

			$result = mysqli_query($conn, $sql);
			$dbdata = array();
			while($row = mysqli_fetch_assoc($result)) {
				$dbdata[]=$row;
			}
			echo json_encode($dbdata);
			break;

		case 'POST':
			$pid=$_POST['pid'];
			$name= $_POST['name'];
			$craft= $_POST['craft'];
			$graph= $_POST['graph'];
			$style= $_POST['style'];

			$imgstr= $_POST['imgstr'];
			$spec= $_POST['spec'];
			$price= $_POST['price'];

			$filename=$_FILES['file']['name'];
	        $newFilePath = "../images/".$filename;
	        $thumbnail="../thumbnail/".$filename;

        	if(move_uploaded_file($_FILES['file']['tmp_name'], $newFilePath)) {
          		exec("convert ".$newFilePath." -resize 1000x1000 ".$newFilePath);
          		exec("convert ".$newFilePath." -resize 300x300 ".$thumbnail);

          	}

			if($pid) {
				$sql="update product set name='".$name."',cid=".$craft.",image='".$imgstr."',gid=".$graph.",sid=".$style.",spec='".$spec."',price=".$price;
            	$sql.=" where id=".$pid;
			}
			else {
				$sql="insert into product (name,image,cid,gid,sid,spec,price) values ('".$name."','";
            	$sql.=$imgstr."',".$craft.",".$graph.",".$style.",'".$spec."',";
            	$sql.=$price.")";
        	}

        	echo $sql;
           //  if ($db->exec($sql)) echo "update successful.";
          	// else echo "Error: ".$sql;
           
			

			break;	

		case 'DELETE':


			$sql="delete from product where id=".$pid;

			$img=$_GET['img'];

            if ($db->exec($sql)) {
            	exec("rm -f ../images/".$img);
            	exec("rm -f ../thumbnail/".$img);

            }
          	else echo "Error: ".$sql."<br>".mysqli_error($conn);			

			break;	

		case 'PUT':
			echo 'update * from product where id='.$id;
			break;	

		default:

			break;
	}

	$db->close();



?>
