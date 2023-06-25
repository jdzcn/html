<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
//主要为跨域CORS配置的两大基本信息,Origin和headers


	include('conn.php');
	$key = isset($_GET['key'])? htmlspecialchars($_GET['key']) : '';
	$pid = isset($_GET['pid'])? htmlspecialchars($_GET['pid']) : '';
	$start_date = isset($_GET['start_date'])? htmlspecialchars($_GET['start_date']) : '';
	$end_date = isset($_GET['end_date'])? htmlspecialchars($_GET['end_date']) : '';
	$fs = isset($_GET['fs'])? htmlspecialchars($_GET['fs']) : 0;

		// echo $start_date.$end_date.$fs;



	switch ($_SERVER['REQUEST_METHOD']) {
		
		case 'GET':

			
			$sql = "select id,date,product.name as name,category.name as category,number,sale.price,amount,hex(img) as img,sale.cost,remark from sale,product,category where sale.pid=product.pid and category.cid=product.cid ";

			if($key) $sql=$sql." and remark like '%".$key."%'"." order by id desc";
			elseif($start_date) $sql=$sql." and date>='".$start_date."' and date<='".$end_date."'"." order by id desc";
			else $sql=$sql." order by id desc limit 10";
			// else $sql=$sql." and date> (SELECT DATETIME('now', '-3 day'))";

			// $sql.=;
			// echo $sql;

			$ret = $db->query($sql);

			$dbdata = array();
			while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
				$dbdata[]=$row;
			}
			echo json_encode($dbdata);
			break;

		case 'POST':
			$pid=$_POST['pid'];
			$date= $_POST['date'];
			$number= $_POST['number'];
			$price= $_POST['price'];
			$amount= $_POST['amount'];
			$cost= $_POST['cost'];
			$remark= $_POST['remark'];

			$sql="insert into sale (date,pid,price,number,amount,cost,remark) values ('".$date."',".$pid.",".$price.",".$number.",".$amount.",".$cost.",'".$remark."')";
			echo $sql;
			if ($db->exec($sql)) echo $sql;

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


			$sql="delete from sale where id=".$pid;

			// $img=$_GET['img'];

            if ($db->exec($sql)) echo "delete successful.";
          				

			break;	

		case 'PUT':
			echo 'update * from product where id='.$id;
			break;	

		default:

			break;
	}

	$db->close();



?>
