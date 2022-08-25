<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
//主要为跨域CORS配置的两大基本信息,Origin和headers


	include('conn.php');
	
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
			$pid=$_POST['pid'];
			$name= $_POST['name'];
			$craft= $_POST['craft'];
			$graph= $_POST['graph'];
			$style= $_POST['style'];

			$imgstr= $_POST['imgstr'];
			$spec= $_POST['spec'];
			$price= $_POST['price'];

			$filename=$_FILES['images']['name'];
			if(!empty($filename)) {
	        $newFilePath = "../images/".$filename;
	        $thumbnail="../thumbnail/".$filename;

	        	if(move_uploaded_file($_FILES['images']['tmp_name'], $newFilePath)) {
	          		exec("convert ".$newFilePath." -resize 1000x1000 ".$newFilePath);
	          		exec("convert ".$newFilePath." -resize 300x300 ".$thumbnail);

	          	}
          	}
				$sql="insert into product (name,image,cid,gid,sid,spec,price) values ('".$name."','";
            	$sql.=$imgstr."',".$craft.",".$graph.",".$style.",'".$spec."',";
            	$sql.=$price.")";
			if($pid!="0") {
				$sql="update product set name='".$name."',cid=".$craft.",image='".$imgstr."',gid=".$graph.",sid=".$style.",spec='".$spec."',price=".$price;
            	$sql.=" where pid=".$pid;
			}




        	echo $sql;
            if ($db->exec($sql)) echo "update successful.";
          	else echo "Error: ".$db->lastErrorMsg();
           
			

			break;	

		case 'DELETE':


			$sql="delete from product where pid=".$pid;

			$img=$_GET['img'];

            if ($db->exec($sql)) {
            	exec("rm -f ../images/".$img);
            	exec("rm -f ../thumbnail/".$img);

            }
          				

			break;	

		case 'PUT':
			echo 'update * from product where id='.$id;
			break;	

		default:

			break;
	}

	$db->close();



?>
