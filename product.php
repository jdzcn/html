<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
//主要为跨域CORS配置的两大基本信息,Origin和headers

include "conn.php";

	
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
