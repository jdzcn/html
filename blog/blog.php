<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
//主要为跨域CORS配置的两大基本信息,Origin和headers


	include('conn.php');

	$id= isset($_GET['id'])? htmlspecialchars($_GET['id']) : '';
	$cid= isset($_GET['cid'])? htmlspecialchars($_GET['cid']) : '';
	$key= isset($_GET['key'])? htmlspecialchars($_GET['key']) : '';

	switch ($_SERVER['REQUEST_METHOD']) {
		
		case 'GET':

			
			$sql = "select id,title from blog ";
			if($key) $sql=$sql."where title like '%".base64_encode($key)."%'";
			elseif($cid) $sql.="where cid=".$cid;
			$sql.=" order by id desc";

			if($id) $sql="select * from blog where id=".$id;
			// echo $sql;
			$ret = $db->query($sql);

			$dbdata = array();
			while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
				$dbdata[]=$row;
			}
			echo json_encode($dbdata);
			break;

		case 'POST':
			$id=$_POST['id'];
			$cid=$_POST['cid'];
			$title= base64_encode($_POST['title']);
			$blog= base64_encode($_POST['blog']);

			$sql="insert into blog (title,blog,cid) values ('".$title."','".$blog."',".$cid.")";
			if($id!="0") $sql="update blog set title='".$title."',blog='".$blog."',cid=".$cid." where id=".$id;
			echo $sql;
			if ($db->exec($sql)) echo "Update successful.";

			break;	

		case 'DELETE':


			$sql="delete from blog where id=".$id;

			// $img=$_GET['img'];

            if ($db->exec($sql)) echo "delete successful.";
          				

			break;	

		case 'PUT':
			// echo 'update * from product where id='.$id;
			break;	

		default:

			break;
	}

	$db->close();



?>
