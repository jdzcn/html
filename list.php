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
	
	
	$table=$_GET['table'];
	switch ($_SERVER['REQUEST_METHOD']) {
		
		case 'GET':

			
			$sql = "SELECT * from ".$table;
			// echo $sql;
		  	$ret = $db->query($sql);
		  	$record=array();
			while($row = $ret->fetchArray(SQLITE3_ASSOC)) $record[]=$row;
			echo json_encode($record);
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
