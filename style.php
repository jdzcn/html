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
	
	
	
	switch ($_SERVER['REQUEST_METHOD']) {
		
		case 'GET':

			
			$sql = "SELECT * from style";
		  	$ret = $db->query($sql);
		  	$category=array();
			while($row = $ret->fetchArray(SQLITE3_ASSOC)) $category[]=$row;
			echo json_encode($category);
			break;

		case 'POST':
			
			echo 'insert product ';
			break;	

		case 'DELETE':
			
			echo 'delete * from product where id='.$id;
			break;	

		case 'PUT':
			
			echo 'update * from product where id='.$id;
			break;	

		default:

			break;
	}

	$db->close();



?>
